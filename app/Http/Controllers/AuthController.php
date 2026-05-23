<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\SendOtpJob;
use App\Services\CartService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return redirect()->route('login');
    }

    public function sendOtp(Request $request) {
        $request->validate(['contact' => 'required|email']);
        
        $otp = rand(100000, 999999);
        $key = "otp:{$request->contact}";
        
        Cache::put($key, $otp, now()->addMinutes(10));
        dispatch(new SendOtpJob($request->contact, $otp));
        
        return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }

    public function verifyOtp(Request $request) {
        $request->validate([
            'contact' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $cached = Cache::get("otp:{$request->contact}");
        
        // Temporarily bypass OTP for quick testing if 123456 provided in dev
        if (app()->environment('local') && $request->otp == '123456') {
            $cached = $request->otp;
        }

        if (!$cached || $cached != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }
        
        Cache::forget("otp:{$request->contact}");
        
        $isEmail = filter_var($request->contact, FILTER_VALIDATE_EMAIL);
        $user = User::firstOrCreate(
            $isEmail ? ['email' => $request->contact] : ['phone' => $request->contact],
            ['name' => 'Guest', 'is_active' => true]
        );
        
        Auth::login($user);
        
        app(CartService::class)->mergeGuestCart(session()->getId());
        
        return redirect()->intended('/account');
    }

    public function register(Request $request) {
        return redirect()->route('login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
