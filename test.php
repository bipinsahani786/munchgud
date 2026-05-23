<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orderService = app(\App\Services\OrderService::class);
$addressData = ['name' => 'Test Name', 'phone' => '1234567890', 'line1' => 'Street', 'city' => 'City', 'state' => 'State', 'pincode' => '123456'];
dump($addressData);
