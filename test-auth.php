<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::firstOrCreate(
    ['email' => 'testauth@example.com'],
    ['name' => 'Test User', 'is_active' => true]
);

$user->password = 'secret123';
$user->save();

echo "DB Password Hash: " . $user->password . "\n";

$credentials = ['email' => 'testauth@example.com', 'password' => 'secret123'];
if (Illuminate\Support\Facades\Auth::attempt($credentials)) {
    echo "Auth successful!\n";
} else {
    echo "Auth failed!\n";
}
