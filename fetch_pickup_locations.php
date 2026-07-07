<?php
// Run: docker compose exec app php artisan tinker < fetch_pickup_locations.php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = app(App\Services\ShiprocketService::class);

try {
    $locations = $service->getPickupLocations();

    if (empty($locations)) {
        echo "No pickup locations found or API error.\n";
        echo "Check your SHIPROCKET_EMAIL and SHIPROCKET_PASSWORD in .env\n";
    } else {
        echo "\n=== YOUR SHIPROCKET PICKUP LOCATIONS ===\n\n";
        foreach ($locations as $loc) {
            $name    = $loc['pickup_location'] ?? 'N/A';
            $address = $loc['address'] ?? '';
            $city    = $loc['city'] ?? '';
            $pin     = $loc['pin_code'] ?? '';
            echo "Location Name : " . $name . "\n";
            echo "Address       : " . $address . ", " . $city . " - " . $pin . "\n";
            echo "----------------------------------------------\n";
        }
        echo "\nCopy the EXACT 'Location Name' above and paste it in .env as SHIPROCKET_PICKUP_LOCATION=\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
