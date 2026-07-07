<?php
$app = require '/var/www/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$rows = \Illuminate\Support\Facades\DB::table('order_trackings')
    ->latest('id')
    ->limit(10)
    ->get(['id', 'order_id', 'status', 'location', 'tracked_at']);

echo "\n=== ORDER TRACKING RECORDS (Latest 10) ===\n\n";
foreach ($rows as $r) {
    echo "#{$r->id} | order_id={$r->order_id} | {$r->status} | {$r->location} | {$r->tracked_at}\n";
}
echo "\nTotal: " . count($rows) . " records shown\n";
