// Print agent endpoint
Route::post('/print-agent/pending-orders', function () {
    // Verify it's coming from your Mac Mini (simple security)
    $secret = request()->header('X-Print-Agent-Secret');
    if ($secret !== config('services.print_agent.secret')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $orders = \App\Models\Order::where('status', 'pending')
        ->orWhere(function ($query) {
            $query->where('status', 'completed')->whereNull('shipped_at');
        })
        ->orderBy('created_at', 'asc')
        ->get();

    if ($orders->isEmpty()) {
        return response()->json([
            'success' => true,
            'orders' => [],
            'message' => 'No pending orders'
        ]);
    }

    $results = [];
    $printer = app(\App\Services\RolloPrinter::class);

    foreach ($orders as $order) {
        try {
            // Create label via ShipStation
            $result = $printer->printLabel($order);

            if ($result['success']) {
                // Update order
                $order->update([
                    'tracking_number' => $result['tracking'],
                    'shipped_at' => now(),
                    'status' => 'shipped'
                ]);

                // Queue tracking email
                \App\Jobs\SendTrackingEmail::dispatch($order);

                $results[] = [
                    'order_id' => $order->id,
                    'success' => true,
                    'tracking' => $result['tracking'],
                    'label_pdf' => $result['label_url'] // Base64 PDF
                ];
            } else {
                $results[] = [
                    'order_id' => $order->id,
                    'success' => false,
                    'error' => $result['error']
                ];
            }
        } catch (\Exception $e) {
            $results[] = [
                'order_id' => $order->id,
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    return response()->json([
        'success' => true,
        'results' => $results
    ]);
});
