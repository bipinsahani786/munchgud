<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ShiprocketWebhookController extends Controller
{
    /**
     * Handle Shiprocket webhook events (auto tracking updates)
     *
     * ─── Shiprocket Dashboard Setup ──────────────────────────────────
     * 1. Login → Settings → API → Webhooks
     * 2. Add Webhook URL: https://yourdomain.com/delivery/tracking-update
     * 3. Enable the toggle
     * 4. (Optional) Add Security Token (x-api-key) → copy same to .env:
     *    SHIPROCKET_WEBHOOK_SECRET=your_secret_token
     *
     * NOTE: Shiprocket does NOT allow "shiprocket", "sr", "kr" in webhook URL
     * ─────────────────────────────────────────────────────────────────
     */
    public function handle(Request $request)
    {
        // ── Optional: Verify security token ──────────────────────────
        $webhookSecret = config('shiprocket.webhook_secret');

        if ($webhookSecret) {
            $incomingKey = $request->header('x-api-key');
            if ($incomingKey !== $webhookSecret) {
                Log::warning('Shiprocket webhook: invalid security token');
                return response()->json(['status' => 'unauthorized'], 401);
            }
        }

        $payload = $request->all();

        Log::info('Delivery webhook received', [
            'awb'    => $payload['awb'] ?? 'none',
            'status' => $payload['current_status'] ?? 'none',
        ]);

        $awb           = $payload['awb'] ?? null;
        $currentStatus = $payload['current_status'] ?? $payload['shipment_status'] ?? null;
        $timestamp     = $payload['current_timestamp'] ?? now()->toDateTimeString();
        $scans         = $payload['scans'] ?? [];

        // Must have AWB
        if (!$awb) {
            return response()->json(['status' => 'ok', 'reason' => 'no_awb'], 200);
        }

        // Find order by AWB
        $order = Order::where('awb_code', $awb)->first();

        if (!$order) {
            // Could be a test ping — return 200 so Shiprocket doesn't retry
            Log::info('Delivery webhook: no order found for AWB', ['awb' => $awb]);
            return response()->json(['status' => 'ok', 'reason' => 'order_not_found'], 200);
        }

        // ── Update order status ───────────────────────────────────────
        $order->shiprocket_status = $currentStatus;

        $mappedStatus = $this->mapToOrderStatus($currentStatus);

        if ($mappedStatus && $mappedStatus !== $order->status) {
            $order->status = $mappedStatus;

            if ($mappedStatus === 'processing' && !$order->shipped_at) {
                // Picked up — processing phase
            }
            if ($mappedStatus === 'shipped' && !$order->shipped_at) {
                $order->shipped_at = now();
            }
            if ($mappedStatus === 'delivered' && !$order->delivered_at) {
                $order->delivered_at = now();
            }
        }

        $order->save();

        // ── Save tracking events ──────────────────────────────────────
        if (!empty($scans)) {
            // Multiple scan events (full history)
            foreach ($scans as $scan) {
                $this->saveTrackingEvent(
                    $order->id,
                    $scan['sr-status-label'] ?? $scan['status'] ?? $currentStatus ?? 'Update',
                    $scan['location'] ?? '',
                    $scan['activity'] ?? '',
                    Carbon::parse($scan['date'] ?? $timestamp)
                );
            }
        } else {
            // Single status event
            $this->saveTrackingEvent(
                $order->id,
                $currentStatus ?? 'Update',
                $payload['location'] ?? '',
                '',
                Carbon::parse($timestamp)
            );
        }

        // Always return 200 — Shiprocket will retry on non-200
        return response()->json(['status' => 'ok'], 200);
    }

    // ── Save a tracking event (with duplicate check) ──────────────────

    protected function saveTrackingEvent(
        int $orderId,
        string $status,
        string $location,
        string $description,
        Carbon $trackedAt
    ): void {
        $exists = OrderTracking::where('order_id', $orderId)
            ->where('status', $status)
            ->where('tracked_at', $trackedAt)
            ->exists();

        if (!$exists) {
            OrderTracking::create([
                'order_id'    => $orderId,
                'status'      => $status,
                'location'    => $location,
                'description' => $description,
                'tracked_at'  => $trackedAt,
            ]);
        }
    }

    // ── Map Shiprocket status → our order status ──────────────────────

    protected function mapToOrderStatus(?string $srStatus): ?string
    {
        if (!$srStatus) return null;

        $map = [
            'Picked Up'        => 'processing',
            'PICKED UP'        => 'processing',
            'In Transit'       => 'shipped',
            'IN TRANSIT'       => 'shipped',
            'Out For Delivery' => 'shipped',
            'OUT FOR DELIVERY' => 'shipped',
            'Delivered'        => 'delivered',
            'DELIVERED'        => 'delivered',
            'Undelivered'      => 'shipped',
            'RTO Initiated'    => 'shipped',
            'RTO Delivered'    => 'cancelled',
            'Cancelled'        => 'cancelled',
            'CANCELLED'        => 'cancelled',
        ];

        return $map[$srStatus] ?? null;
    }
}
