<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShiprocketService
{
    protected string $baseUrl;
    protected string $cacheKey = 'shiprocket_token';

    public function __construct()
    {
        $this->baseUrl = config('shiprocket.base_url', 'https://apiv2.shiprocket.in/v1/external');
    }

    // -------------------------------------------------------------------------
    // Authentication — JWT token (cached for 23 hours)
    // -------------------------------------------------------------------------

    public function authenticate(): ?string
    {
        // Return from cache if valid
        if ($token = Cache::get($this->cacheKey)) {
            return $token;
        }

        try {
            $response = Http::post("{$this->baseUrl}/auth/login", [
                'email'    => config('shiprocket.email'),
                'password' => config('shiprocket.password'),
            ]);

            if ($response->successful()) {
                $token = $response->json('token');
                // Cache for 23 hours (Shiprocket tokens last 24h)
                Cache::put($this->cacheKey, $token, now()->addHours(23));
                return $token;
            }

            Log::error('Shiprocket auth failed', ['response' => $response->json()]);
            return null;
        } catch (\Exception $e) {
            Log::error('Shiprocket auth exception', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Make authenticated API request
     */
    protected function request(string $method, string $endpoint, array $data = []): ?array
    {
        $token = $this->authenticate();

        if (!$token) {
            throw new \Exception('Shiprocket authentication failed. Check your email/password in .env');
        }

        $response = Http::withToken($token)
            ->timeout(30)
            ->{$method}("{$this->baseUrl}/{$endpoint}", $data);

        if ($response->status() === 401) {
            // Token expired — clear cache and retry once
            Cache::forget($this->cacheKey);
            $token = $this->authenticate();
            $response = Http::withToken($token)
                ->timeout(30)
                ->{$method}("{$this->baseUrl}/{$endpoint}", $data);
        }

        return $response->json();
    }

    // -------------------------------------------------------------------------
    // Create Order on Shiprocket
    // -------------------------------------------------------------------------

    public function createOrder(Order $order): array
    {
        $order->load(['items.sku.product', 'user']);

        $weight = $this->calculateOrderWeight($order);
        $length = config('shiprocket.default_length', 15);
        $breadth = config('shiprocket.default_breadth', 10);
        $height = config('shiprocket.default_height', 10);

        $payload = [
            'order_id'            => $order->order_number,
            'order_date'          => $order->created_at->format('Y-m-d H:i'),
            'pickup_location'     => config('shiprocket.pickup_location', 'Primary'),
            'channel_id'          => config('shiprocket.channel_id') ?: null,
            'comment'             => 'MunchGud Order',
            'billing_customer_name'   => $order->shipping_name,
            'billing_last_name'       => '',
            'billing_address'         => $order->shipping_line1,
            'billing_address_2'       => $order->shipping_line2 ?? '',
            'billing_city'            => $order->shipping_city,
            'billing_pincode'         => $order->shipping_pincode,
            'billing_state'           => $order->shipping_state,
            'billing_country'         => 'India',
            'billing_email'           => $order->user?->email ?? '',
            'billing_phone'           => $order->shipping_phone,
            'shipping_is_billing'     => true,
            'order_items'             => $this->formatOrderItems($order),
            'payment_method'          => $order->payment_method === 'cod' ? 'COD' : 'Prepaid',
            'shipping_charges'        => (float) $order->shipping_amount,
            'giftwrap_charges'        => 0,
            'transaction_charges'     => 0,
            'total_discount'          => (float) $order->discount_amount,
            'sub_total'               => (float) $order->subtotal,
            'length'                  => $length,
            'breadth'                 => $breadth,
            'height'                  => $height,
            'weight'                  => $weight,
        ];

        // Remove null channel_id
        if (is_null($payload['channel_id'])) {
            unset($payload['channel_id']);
        }

        $response = $this->request('post', 'orders/create/adhoc', $payload);

        Log::info('Shiprocket createOrder response', ['order' => $order->order_number, 'response' => $response]);

        return $response ?? [];
    }

    // -------------------------------------------------------------------------
    // Assign Best Courier + Generate AWB
    // -------------------------------------------------------------------------

    public function assignBestCourier(Order $order, string $shiprocketOrderId, string $shiprocketShipmentId): array
    {
        // 1. Get courier serviceability
        $couriers = $this->getRecommendedCouriers(
            $order->shipping_pincode,
            $this->calculateOrderWeight($order),
            $order->payment_method === 'cod'
        );

        if (empty($couriers['data']['available_courier_companies'])) {
            throw new \Exception('No couriers available for this pincode: ' . $order->shipping_pincode);
        }

        // Pick the recommended courier (Shiprocket recommends best)
        $recommendedId = $couriers['data']['shiprocket_recommended_courier_id']
            ?? $couriers['data']['available_courier_companies'][0]['courier_company_id'];

        // 2. Assign AWB
        $awbResponse = $this->request('post', 'courier/assign/awb', [
            'shipment_id'         => $shiprocketShipmentId,
            'courier_id'          => $recommendedId,
        ]);

        Log::info('Shiprocket assignAWB response', ['shipment' => $shiprocketShipmentId, 'response' => $awbResponse]);

        return $awbResponse ?? [];
    }

    // -------------------------------------------------------------------------
    // Get Available Couriers for Pincode
    // -------------------------------------------------------------------------

    public function getRecommendedCouriers(string $deliveryPincode, float $weight = 0.5, bool $cod = false): array
    {
        $pickupPincode = config('shiprocket.pickup_pincode', '110001');

        $response = $this->request('get', 'courier/serviceability/', [
            'pickup_postcode'   => $pickupPincode,
            'delivery_postcode' => $deliveryPincode,
            'weight'            => $weight,
            'cod'               => $cod ? 1 : 0,
        ]);

        return $response ?? [];
    }

    // -------------------------------------------------------------------------
    // Track by AWB Code
    // -------------------------------------------------------------------------

    public function trackByAWB(string $awb): array
    {
        $token = $this->authenticate();

        if (!$token) {
            return [];
        }

        $response = Http::withToken($token)
            ->get("{$this->baseUrl}/courier/track/awb/{$awb}");

        return $response->json() ?? [];
    }

    // -------------------------------------------------------------------------
    // Get all pickup locations from Shiprocket account
    // -------------------------------------------------------------------------

    public function getPickupLocations(): array
    {
        $response = $this->request('get', 'settings/company/pickup');
        return $response['data']['shipping_address'] ?? [];
    }

    // -------------------------------------------------------------------------
    // Cancel Shiprocket Order
    // -------------------------------------------------------------------------

    public function cancelOrder(string $shiprocketOrderId): array
    {
        $response = $this->request('post', 'orders/cancel', [
            'ids' => [$shiprocketOrderId],
        ]);

        return $response ?? [];
    }

    // -------------------------------------------------------------------------
    // Check Pincode Serviceability (for storefront)
    // -------------------------------------------------------------------------

    public function checkServiceability(string $deliveryPincode, float $weight = 0.5): array
    {
        try {
            $data = $this->getRecommendedCouriers($deliveryPincode, $weight);

            $couriers = $data['data']['available_courier_companies'] ?? [];

            if (empty($couriers)) {
                return ['serviceable' => false, 'couriers' => []];
            }

            // Get fastest ETA
            $etaDays = collect($couriers)->min('estimated_delivery_days') ?? 5;
            $etaDate = now()->addDays((int) $etaDays)->format('D, M j');
            $courierName = collect($couriers)->first()['courier_name'] ?? 'Our Courier';

            return [
                'serviceable'  => true,
                'delivery_date' => $etaDate,
                'courier_name'  => $courierName,
                'couriers'      => $couriers,
            ];
        } catch (\Exception $e) {
            Log::warning('Shiprocket serviceability check failed', ['error' => $e->getMessage()]);
            return ['serviceable' => null, 'error' => $e->getMessage()];
        }
    }

    // -------------------------------------------------------------------------
    // Full Push: Create Order + Assign Courier (admin button)
    // -------------------------------------------------------------------------

    public function pushOrder(Order $order, bool $autoAwb = false): array
    {
        // Step 1: Create order
        $createResponse = $this->createOrder($order);

        if (empty($createResponse['order_id'])) {
            $msg = $createResponse['message'] ?? 'Unknown error creating Shiprocket order';
            throw new \Exception("Shiprocket order creation failed: {$msg}");
        }

        $shiprocketOrderId   = (string) $createResponse['order_id'];
        $shiprocketShipmentId = (string) ($createResponse['shipment_id'] ?? '');

        // Update order with Shiprocket order ID
        $order->update([
            'shiprocket_order_id'   => $shiprocketOrderId,
            'shiprocket_shipment_id' => $shiprocketShipmentId,
            'shiprocket_pushed_at'  => now(),
            'shiprocket_status'     => $createResponse['status'] ?? 'NEW',
        ]);

        // Step 2: Assign best courier & get AWB (Only if autoAwb is true)
        if ($autoAwb && $shiprocketShipmentId) {
            try {
                $awbResponse = $this->assignBestCourier($order, $shiprocketOrderId, $shiprocketShipmentId);

                $awb         = $awbResponse['response']['data']['awb_code'] ?? null;
                $courierId   = $awbResponse['response']['data']['courier_company_id'] ?? null;
                $courierName = $awbResponse['response']['data']['courier_name'] ?? null;

                if ($awb) {
                    $order->update([
                        'awb_code'          => $awb,
                        'tracking_number'   => $awb,
                        'courier_company_id' => $courierId,
                        'courier_name'      => $courierName,
                        'shiprocket_status' => 'AWB_ASSIGNED',
                    ]);
                }
            } catch (\Exception $e) {
                Log::warning('Shiprocket AWB assignment failed (order pushed but no AWB)', [
                    'order'  => $order->order_number,
                    'error'  => $e->getMessage(),
                ]);
            }
        }

        $order->refresh();
        return $createResponse;
    }

    // -------------------------------------------------------------------------
    // Retry AWB Assignment (when order is pushed but no AWB yet)
    // -------------------------------------------------------------------------

    public function retryAWBAssignment(Order $order): bool
    {
        if (!$order->shiprocket_shipment_id) {
            throw new \Exception('No Shiprocket Shipment ID found. Order may not be fully created.');
        }

        $awbResponse = $this->assignBestCourier(
            $order,
            $order->shiprocket_order_id,
            $order->shiprocket_shipment_id
        );

        Log::info('Shiprocket retryAWB response', ['order' => $order->order_number, 'response' => $awbResponse]);

        // Try multiple response paths (Shiprocket API inconsistency)
        $awb         = $awbResponse['response']['data']['awb_code']
                    ?? $awbResponse['awb_code']
                    ?? null;
        $courierId   = $awbResponse['response']['data']['courier_company_id']
                    ?? $awbResponse['courier_company_id']
                    ?? null;
        $courierName = $awbResponse['response']['data']['courier_name']
                    ?? $awbResponse['courier_name']
                    ?? null;

        if ($awb) {
            $order->update([
                'awb_code'           => $awb,
                'tracking_number'    => $awb,
                'courier_company_id' => $courierId,
                'courier_name'       => $courierName,
                'shiprocket_status'  => 'AWB_ASSIGNED',
            ]);
            return true;
        }

        // Log the actual response for debugging
        Log::warning('Shiprocket AWB retry: no AWB in response', [
            'order'    => $order->order_number,
            'response' => $awbResponse,
        ]);

        return false;
    }

    // -------------------------------------------------------------------------
    // Sync tracking from Shiprocket via AWB
    // -------------------------------------------------------------------------

    public function syncTracking(Order $order): bool
    {
        if (!$order->awb_code) {
            return false;
        }

        $trackData = $this->trackByAWB($order->awb_code);
        $trackingData = $trackData['tracking_data'] ?? null;

        if (!$trackingData) {
            return false;
        }

        $shipmentTrackActivities = $trackingData['shipment_track_activities'] ?? [];
        $shipmentTrack = $trackingData['shipment_track'][0] ?? null;

        // Update order status based on Shiprocket status
        if ($shipmentTrack) {
            $srStatus = $shipmentTrack['current_status'] ?? '';
            $newOrderStatus = $this->mapShiprocketStatus($srStatus);

            if ($newOrderStatus && $newOrderStatus !== $order->status) {
                $order->update([
                    'status'            => $newOrderStatus,
                    'shiprocket_status' => $srStatus,
                ]);

                if ($newOrderStatus === 'shipped' && !$order->shipped_at) {
                    $order->update(['shipped_at' => now()]);
                }
                if ($newOrderStatus === 'delivered' && !$order->delivered_at) {
                    $order->update(['delivered_at' => now()]);
                }
            }
        }

        // Save tracking activities to OrderTracking table
        foreach (array_reverse($shipmentTrackActivities) as $activity) {
            $trackedAt = \Carbon\Carbon::parse($activity['date'] ?? now());
            $status    = $activity['sr-status-label'] ?? $activity['status'] ?? 'Update';
            $location  = $activity['location'] ?? '';
            $desc      = $activity['activity'] ?? '';

            // Skip if already exists (same status + time)
            $exists = \App\Models\OrderTracking::where('order_id', $order->id)
                ->where('status', $status)
                ->where('tracked_at', $trackedAt)
                ->exists();

            if (!$exists) {
                \App\Models\OrderTracking::create([
                    'order_id'   => $order->id,
                    'status'     => $status,
                    'location'   => $location,
                    'description' => $desc,
                    'tracked_at' => $trackedAt,
                ]);
            }
        }

        return true;
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    protected function formatOrderItems(Order $order): array
    {
        return $order->items->map(function ($item) {
            return [
                'name'     => $item->product_name . ' (' . $item->sku_name . ')',
                'sku'      => $item->sku_code,
                'units'    => $item->quantity,
                'selling_price' => (float) $item->unit_price,
                'discount' => 0,
                'tax'      => 0,
            ];
        })->toArray();
    }

    protected function calculateOrderWeight(Order $order): float
    {
        // Return a fixed overall weight to prevent high shipping charges 
        // when ordering multiple lightweight items.
        return (float) config('shiprocket.default_weight', 0.5);
    }

    protected function mapShiprocketStatus(string $srStatus): ?string
    {
        $map = [
            'Picked Up'             => 'processing',
            'PICKED UP'             => 'processing',
            'In Transit'            => 'shipped',
            'IN TRANSIT'            => 'shipped',
            'Out For Delivery'      => 'shipped',
            'OUT FOR DELIVERY'      => 'shipped',
            'Delivered'             => 'delivered',
            'DELIVERED'             => 'delivered',
            'Undelivered'           => 'shipped',
            'RTO Initiated'         => 'shipped',
            'RTO Delivered'         => 'cancelled',
            'Cancelled'             => 'cancelled',
            'CANCELLED'             => 'cancelled',
        ];

        return $map[$srStatus] ?? null;
    }
}
