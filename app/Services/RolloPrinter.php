<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

/**
 * Rollo Thermal Printer Service
 *
 * Integrates with ShipStation API for automated label generation and printing.
 *
 * CRITICAL FIX: ShipStation API does NOT auto-print labels. The API only returns
 * base64 PDF data. We must decode and print it ourselves using system commands.
 */
class RolloPrinter
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $storeId;
    protected string $baseUrl = "https://ssapi.shipstation.com";
    protected string $printerName;

    public function __construct()
    {
        $this->apiKey = config("services.shipstation.api_key");
        $this->apiSecret = config("services.shipstation.api_secret");
        $this->storeId = config("services.shipstation.store_id");

        // IMPORTANT: Set your actual Rollo printer name from system
        // Run `lpstat -p -d` on Mac to see available printers
        $this->printerName = config("services.shipstation.printer_name", "Rollo_X1040");
    }

    /**
     * Check if Rollo printer is online and ready to print
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        try {
            // Check ShipStation API connectivity
            $response = $this->makeRequest("GET", "/carriers");
            if (!$response->successful()) {
                Log::channel("rollo")->warning("ShipStation API offline", [
                    "status" => $response->status(),
                ]);
                return false;
            }

            // Check if Rollo printer is available via system
            $printerCheck = shell_exec("lpstat -p " . escapeshellarg($this->printerName) . " 2>&1");

            if ($printerCheck && str_contains($printerCheck, 'enabled')) {
                Log::channel("rollo")->info("Printer connectivity check: ONLINE");
                return true;
            }

            Log::channel("rollo")->warning("Rollo printer not found or disabled", [
                "printer_name" => $this->printerName,
                "lpstat_output" => $printerCheck,
            ]);
            return false;
        } catch (\Exception $e) {
            Log::channel("rollo")->error("Printer connectivity check failed", [
                "error" => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Print a shipping label for a single order
     *
     * @param Order $order
     * @return array ['success' => bool, 'tracking' => string|null, 'error' => string|null]
     */
    public function printLabel(Order $order): array
    {
        try {
            Log::channel("rollo")->info("Starting label generation", [
                "order_id" => $order->id,
                "email" => $order->email,
            ]);

            // Create shipment in ShipStation
            $shipmentData = $this->createShipment($order);

            if (!$shipmentData["success"]) {
                return $shipmentData;
            }

            // Generate label (returns base64 PDF)
            $labelData = $this->createLabel($shipmentData["shipment_id"]);

            if (!$labelData["success"]) {
                return $labelData;
            }

            // 🆕 CRITICAL: Actually print the PDF to Rollo
            $printResult = $this->printPdfToRollo($labelData["label_url"], $order->id);

            if (!$printResult["success"]) {
                return [
                    "success" => false,
                    "tracking" => $labelData["tracking"],
                    "error" => "Label created but print failed: " . $printResult["error"],
                ];
            }

            Log::channel("rollo")->info("Label printed successfully", [
                "order_id" => $order->id,
                "tracking" => $labelData["tracking"],
            ]);

            return [
                "success" => true,
                "tracking" => $labelData["tracking"],
                "error" => null,
            ];
        } catch (\Exception $e) {
            Log::channel("rollo")->error("Label generation failed", [
                "order_id" => $order->id,
                "error" => $e->getMessage(),
                "trace" => $e->getTraceAsString(),
            ]);

            return [
                "success" => false,
                "tracking" => null,
                "error" => $e->getMessage(),
            ];
        }
    }

    /**
     * 🆕 NEW METHOD: Decode base64 PDF and print directly to Rollo
     *
     * @param string $base64Pdf Base64-encoded PDF from ShipStation API
     * @param int $orderId For logging/filename
     * @return array ['success' => bool, 'error' => string|null]
     */
    protected function printPdfToRollo(string $base64Pdf, int $orderId): array
    {
        try {
            // Decode base64 PDF
            $pdfData = base64_decode($base64Pdf);

            if (!$pdfData) {
                return [
                    "success" => false,
                    "error" => "Failed to decode PDF data",
                ];
            }

            // Save to temporary file
            $filename = "label_order_{$orderId}_" . time() . ".pdf";
            $tempPath = storage_path("app/temp/{$filename}");

            // Ensure temp directory exists
            if (!file_exists(storage_path("app/temp"))) {
                mkdir(storage_path("app/temp"), 0755, true);
            }

            file_put_contents($tempPath, $pdfData);

            Log::channel("rollo")->info("PDF saved to temp", [
                "path" => $tempPath,
                "size" => filesize($tempPath),
            ]);

            // Print using lp command (macOS/Linux)
            // -d: destination printer
            // -o media=Custom.4x6in: 4x6 label size for Rollo
            // -o fit-to-page: ensure label fits properly
            $command = sprintf(
                "lp -d %s -o media=Custom.4x6in -o fit-to-page %s 2>&1",
                escapeshellarg($this->printerName),
                escapeshellarg($tempPath)
            );

            $output = shell_exec($command);

            Log::channel("rollo")->info("Print command executed", [
                "command" => $command,
                "output" => $output,
            ]);

            // Verify print job was accepted
            if ($output && str_contains($output, 'request id')) {
                // Clean up temp file after successful print
                sleep(2); // Give print system time to read the file
                unlink($tempPath);

                return [
                    "success" => true,
                    "error" => null,
                ];
            } else {
                return [
                    "success" => false,
                    "error" => "Print command failed: " . ($output ?? "No output"),
                ];
            }
        } catch (\Exception $e) {
            Log::channel("rollo")->error("Print to Rollo failed", [
                "order_id" => $orderId,
                "error" => $e->getMessage(),
            ]);

            return [
                "success" => false,
                "error" => $e->getMessage(),
            ];
        }
    }

    /**
     * Batch print labels for multiple orders
     *
     * @param Collection $orders
     * @return array ['successful' => int, 'failed' => int, 'results' => array]
     */
    public function batchPrint(Collection $orders): array
    {
        $successful = 0;
        $failed = 0;
        $results = [];

        Log::channel("rollo")->info("Batch print started", [
            "order_count" => $orders->count(),
        ]);

        foreach ($orders as $order) {
            $result = $this->printLabel($order);

            $results[] = [
                "order_id" => $order->id,
                "success" => $result["success"],
                "tracking" => $result["tracking"] ?? null,
                "error" => $result["error"] ?? null,
            ];

            if ($result["success"]) {
                $successful++;
            } else {
                $failed++;
            }

            // Small delay between orders to avoid rate limiting
            usleep(500000); // 0.5 seconds
        }

        Log::channel("rollo")->info("Batch print completed", [
            "successful" => $successful,
            "failed" => $failed,
        ]);

        return [
            "successful" => $successful,
            "failed" => $failed,
            "results" => $results,
        ];
    }

    /**
     * Create a shipment in ShipStation
     *
     * @param Order $order
     * @return array
     */
    protected function createShipment(Order $order): array
    {
        $shippingAddress = $order->shipping_address;

        // Validate shipping address exists
        if (!$shippingAddress || !is_array($shippingAddress)) {
            return [
                "success" => false,
                "error" => "Order is missing shipping address",
            ];
        }

        // Validate required address fields
        $requiredFields = ["line1", "city", "state", "postal_code"];
        foreach ($requiredFields as $field) {
            if (empty($shippingAddress[$field])) {
                return [
                    "success" => false,
                    "error" => "Shipping address is missing required field: {$field}",
                ];
            }
        }

        $payload = [
            "orderNumber" => str_pad($order->id, 6, "0", STR_PAD_LEFT),
            "orderDate" => $order->created_at->toIso8601String(),
            "orderStatus" => "awaiting_shipment",
            "customerEmail" => $order->email,
            "customerName" => $order->name,
            "billTo" => [
                "name" => $order->name,
                "street1" => $shippingAddress["line1"],
                "street2" => $shippingAddress["line2"] ?? "",
                "city" => $shippingAddress["city"],
                "state" => $shippingAddress["state"],
                "postalCode" => $shippingAddress["postal_code"],
                "country" => "US",
            ],
            "shipTo" => [
                "name" => $shippingAddress["name"] ?? $order->name,
                "street1" => $shippingAddress["line1"],
                "street2" => $shippingAddress["line2"] ?? "",
                "city" => $shippingAddress["city"],
                "state" => $shippingAddress["state"],
                "postalCode" => $shippingAddress["postal_code"],
                "country" => "US",
            ],
            "items" => [
                [
                    "name" => "VisorPlate - Velcro License Plate Holder",
                    "sku" => "VP-001",
                    "quantity" => $order->quantity,
                    "unitPrice" =>
                        $order->amount_cents / 100 / $order->quantity,
                ],
            ],
            "carrierCode" => "stamps_com",
            "serviceCode" => "usps_first_class_mail",
            "packageCode" => "package",
            "confirmation" => "none",
            "weight" => [
                "value" => config("services.shipstation.package_weight", 12),
                "units" => "ounces",
            ],
            "dimensions" => [
                "length" => config("services.shipstation.package_length", 14),
                "width" => config("services.shipstation.package_width", 8),
                "height" => config("services.shipstation.package_height", 1),
                "units" => "inches",
            ],
        ];

        try {
            $response = $this->makeRequest(
                "POST",
                "/orders/createorder",
                $payload,
            );

            if ($response->successful()) {
                $data = $response->json();
                return [
                    "success" => true,
                    "shipment_id" => $data["orderId"],
                ];
            }

            return [
                "success" => false,
                "error" => "Failed to create shipment: " . $response->body(),
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "error" => "Exception creating shipment: " . $e->getMessage(),
            ];
        }
    }

    /**
     * Create label for a shipment (returns base64 PDF)
     *
     * @param int $shipmentId
     * @return array
     */
    protected function createLabel(int $shipmentId): array
    {
        $payload = [
            "orderId" => $shipmentId,
            "carrierCode" => "stamps_com",
            "serviceCode" => "usps_first_class_mail",
            "packageCode" => "package",
            "confirmation" => "none",
            "shipDate" => now()->format("Y-m-d"),
            "testLabel" => false,
        ];

        try {
            $response = $this->makeRequest(
                "POST",
                "/orders/createlabelfororder",
                $payload,
            );

            if ($response->successful()) {
                $data = $response->json();

                return [
                    "success" => true,
                    "tracking" => $data["trackingNumber"],
                    "label_url" => $data["labelData"], // Base64 PDF - we'll print this ourselves
                    "shipment_id" => $data["shipmentId"],
                ];
            }

            return [
                "success" => false,
                "tracking" => null,
                "error" => "Failed to create label: " . $response->body(),
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "tracking" => null,
                "error" => "Exception creating label: " . $e->getMessage(),
            ];
        }
    }

    /**
     * Make an authenticated request to ShipStation API
     *
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return \Illuminate\Http\Client\Response
     */
    protected function makeRequest(
        string $method,
        string $endpoint,
        array $data = [],
    ) {
        return Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->withHeaders([
                "Content-Type" => "application/json",
            ])
            ->timeout(30)
            ->$method($this->baseUrl . $endpoint, $data);
    }

    /**
     * Get USPS tracking URL from tracking number
     *
     * @param string $trackingNumber
     * @return string
     */
    public static function getTrackingUrl(string $trackingNumber): string
    {
        return "https://tools.usps.com/go/TrackConfirmAction?tLabels={$trackingNumber}";
    }
}
