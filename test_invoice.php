<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

try {
    $order = Order::first();
    if (!$order) {
        echo "No orders found.\n";
        exit;
    }
    echo "Generating invoice for order " . $order->order_number . "...\n";
    $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);
    $pdf->output();
    echo "Success!\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
