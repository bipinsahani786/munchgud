<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class SocialAuthController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(CartService $cartService) {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'is_active' => true,
                    'password' => bcrypt(uniqid()),
                    'avatar' => $googleUser->getAvatar()
                ]
            );
            
            Auth::login($user);
            $cartService->mergeGuestCart(session()->getId());
            
            return redirect()->intended('/account');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed.');
        }
    }
}
