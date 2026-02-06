<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Print agent endpoint
Route::post('/print-agent/pending-orders', function () {
    // Verify secret key from Mac Mini
    $secret = request()->header('X-Print-Agent-Secret');
    if ($secret !== config('services.print_agent.secret')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Find pending orders
    $orders = \App\Models\Order::where('status', 'pending')
        ->orWhere(function ($query) {
            $query->where('status', 'completed')->whereNull('shipped_at');
        })
        ->orderBy('created_at', 'asc')
        ->get();

    // No orders
    if ($orders->isEmpty()) {
        return response()->json([
            'success' => true,
            'orders' => [],
            'message' => 'No pending orders'
        ]);
    }

    // Process each order
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
                    'label_pdf' => $result['label_url']
                ];
            } else {
                $results[] = [
                    'order_id' => $order->id,
                    'success' => false,
                    'error' => $result['error']
                ];
            }

            usleep(500000); // 0.5 second delay between orders
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
