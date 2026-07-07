<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // use Laravel\Socialite\Facades\Socialite;

public function redirect()
{
    /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
    $driver = Socialite::driver('google');
    return $driver->stateless()->redirect();
}

public function callback(Request $request)
{
    try {
        // If the user visits this page directly without a code from Google, 
        // automatically send them to the correct starting point.
        if (!$request->has('code')) {
            return redirect('/auth/google');
        }

        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');
        $driver->stateless();

        // Use custom cacert.pem only for local environment SSL workaround
        if (config('app.env') === 'local' && file_exists(storage_path('cacert.pem'))) {
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => storage_path('cacert.pem')]));
        }

        $googleUser = $driver->user();

        // Find or create the user
        $user = \App\Models\User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                // Generate a random password since they use Google
                'password' => bcrypt(\Illuminate\Support\Str::random(16))
            ]
        );

        // Log the user in
        \Illuminate\Support\Facades\Auth::login($user);

        // Redirect to home (or dashboard)
        return redirect()->route('home');
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Google Auth Callback Error', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'trace'   => $e->getTraceAsString()
        ]);
        // If they refresh the page or the code is already used, 
        // silently redirect them to start over again instead of crashing.
        return redirect('/auth/google')->with('error', 'Google authentication failed: ' . $e->getMessage());
    }
}
}
