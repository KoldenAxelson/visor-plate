<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

/**
 * Rollo Thermal Printer Service
 *
 * Integrates with ShipStation API for automated label generation and printing.
 * ShipStation was chosen over direct Rollo API or EasyPost because:
 * - Best integration with Rollo thermal printers
 * - Mature API with good documentation
 * - Batch operations support
 * - Only $9/month after trial (worth it for <50 orders/month)
 * - PHP SDK available: https://github.com/ShipStation/shipstation-php
 *
 * API Documentation: https://www.shipstation.com/docs/api/
 */
class RolloPrinter
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $storeId;
    protected string $baseUrl = "https://ssapi.shipstation.com";

    public function __construct()
    {
        $this->apiKey = config("services.shipstation.api_key");
        $this->apiSecret = config("services.shipstation.api_secret");
        $this->storeId = config("services.shipstation.store_id");
    }

    /**
     * Check if Rollo printer is online and ready to print
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        try {
            $response = $this->makeRequest("GET", "/carriers");

            if ($response->successful()) {
                Log::channel("rollo")->info(
                    "Printer connectivity check: ONLINE",
                );
                return true;
            }

            Log::channel("rollo")->warning(
                "Printer connectivity check: OFFLINE",
                [
                    "status" => $response->status(),
                ],
            );
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

            // Generate and print label
            $labelData = $this->createLabel($shipmentData["shipment_id"]);

            if ($labelData["success"]) {
                Log::channel("rollo")->info("Label printed successfully", [
                    "order_id" => $order->id,
                    "tracking" => $labelData["tracking"],
                ]);
            }

            return $labelData;
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
     * Create and print a label for a shipment
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
            "testLabel" => false, // Test labels in dev
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
                    "label_url" => $data["labelData"], // Base64 PDF
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
