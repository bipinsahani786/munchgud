<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shiprocket API Configuration
    |--------------------------------------------------------------------------
    |
    | Shiprocket Dashboard → Settings → API → Add New API User
    | Email: The API user email you created (different from main login email)
    | Password: The password sent to your registered email
    |
    */

    'email'           => env('SHIPROCKET_EMAIL'),
    'password'        => env('SHIPROCKET_PASSWORD'),
    'channel_id'      => env('SHIPROCKET_CHANNEL_ID'),            // optional
    'pickup_location' => env('SHIPROCKET_PICKUP_LOCATION', 'Primary'),
    'pickup_pincode'  => env('SHIPROCKET_PICKUP_PINCODE', '110001'),
    'base_url'        => 'https://apiv2.shiprocket.in/v1/external',

    /*
    | Default weight (in kg) used when product weight is not set
    */
    'default_weight'  => env('SHIPROCKET_DEFAULT_WEIGHT', 0.5),

    /*
    | Default dimensions (in cm) used when not set
    */
    'default_length'  => env('SHIPROCKET_DEFAULT_LENGTH', 15),
    'default_breadth' => env('SHIPROCKET_DEFAULT_BREADTH', 10),
    'default_height'  => env('SHIPROCKET_DEFAULT_HEIGHT', 10),

    /*
    | Optional: Webhook security token (x-api-key header)
    | Set this in Shiprocket Dashboard → Settings → API → Webhooks → Security Token
    | And add same value to .env as SHIPROCKET_WEBHOOK_SECRET=your_token
    */
    'webhook_secret'  => env('SHIPROCKET_WEBHOOK_SECRET'),
];
