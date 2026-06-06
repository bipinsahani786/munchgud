<?php
/**
 * ─── Shiprocket Webhook Local Tester ────────────────────────────
 * Run: php test_webhook.php [status]
 *
 * Examples:
 *   php test_webhook.php                     → "Picked Up"
 *   php test_webhook.php transit             → "In Transit"
 *   php test_webhook.php out                 → "Out For Delivery"
 *   php test_webhook.php delivered           → "Delivered"
 *
 * This sends a fake Shiprocket webhook payload to your local server.
 * No ngrok needed!
 * ─────────────────────────────────────────────────────────────────
 */

// ── Config — Change AWB to your actual order's AWB ──────────────
$AWB        = '80092215884';           // ← tumhara actual AWB yahan daalo
$LOCAL_URL  = 'http://munchgud-web/delivery/tracking-update';

// ── Status presets ───────────────────────────────────────────────
$arg = $argv[1] ?? 'pickup';

$statuses = [
    'pickup'    => ['current_status' => 'Picked Up',        'sr-status-label' => 'PICKED UP'],
    'transit'   => ['current_status' => 'In Transit',       'sr-status-label' => 'IN TRANSIT'],
    'out'       => ['current_status' => 'Out For Delivery', 'sr-status-label' => 'OUT FOR DELIVERY'],
    'delivered' => ['current_status' => 'Delivered',        'sr-status-label' => 'DELIVERED'],
    'cancelled' => ['current_status' => 'Cancelled',        'sr-status-label' => 'CANCELLED'],
];

$preset = $statuses[$arg] ?? $statuses['pickup'];

// ── Build fake Shiprocket webhook payload ────────────────────────
$payload = [
    'awb'                  => $AWB,
    'courier_name'         => 'Delhivery Surface',
    'current_status'       => $preset['current_status'],
    'current_status_id'    => 18,
    'shipment_status'      => $preset['current_status'],
    'shipment_status_id'   => 18,
    'current_timestamp'    => date('d m Y H:i:s'),
    'order_id'             => 'MG-2026-00003',
    'sr_order_id'          => 1384408982,
    'awb_assigned_date'    => date('Y-m-d H:i:s', strtotime('-1 hour')),
    'is_return'            => 0,
    'channel_id'           => 0,
    'scans'                => [
        [
            'date'            => date('Y-m-d H:i:s', strtotime('-30 minutes')),
            'status'          => 'X-PPOM',
            'activity'        => 'Shipment ' . $preset['current_status'],
            'location'        => 'Pune Hub (Maharashtra)',
            'sr-status'       => '42',
            'sr-status-label' => $preset['sr-status-label'],
        ],
        [
            'date'            => date('Y-m-d H:i:s', strtotime('-1 hour')),
            'status'          => 'X-UCI',
            'activity'        => 'Manifested - Manifest uploaded',
            'location'        => 'Pune Warehouse (Maharashtra)',
            'sr-status'       => '5',
            'sr-status-label' => 'MANIFEST GENERATED',
        ],
    ],
];

// ── Send the fake webhook ────────────────────────────────────────
echo "\n";
echo "══════════════════════════════════════════════\n";
echo "  🚀 Shiprocket Webhook Local Tester\n";
echo "══════════════════════════════════════════════\n";
echo "  AWB    : {$AWB}\n";
echo "  Status : {$preset['current_status']}\n";
echo "  URL    : {$LOCAL_URL}\n";
echo "══════════════════════════════════════════════\n\n";

$ch = curl_init($LOCAL_URL);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($payload),
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 15,
]);

$response   = curl_exec($ch);
$httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError  = curl_error($ch);
curl_close($ch);

if ($curlError) {
    echo "❌ cURL Error: {$curlError}\n";
    exit(1);
}

echo "HTTP Status : {$httpCode}\n";
echo "Response    : {$response}\n\n";

if ($httpCode === 200) {
    $data = json_decode($response, true);
    if (($data['status'] ?? '') === 'ok') {
        echo "✅ SUCCESS! Webhook processed.\n";
        echo "   → Check your order's tracking page to see the update.\n";
    } else {
        echo "⚠️  Got 200 but response: {$response}\n";
    }
} else {
    echo "❌ Failed! HTTP {$httpCode}\n";
    echo "   → Check Laravel logs: docker compose exec app tail -f storage/logs/laravel.log\n";
}

echo "\n";
