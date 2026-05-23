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

    public function checkEmail(Request $request) {
        $request->validate(['contact' => 'required|email']);
        
        $user = User::where('email', $request->contact)->first();
        
        if ($user && $user->password) {
            return response()->json(['success' => true, 'exists' => true, 'has_password' => true]);
        }
        
        return response()->json(['success' => true, 'exists' => $user ? true : false, 'has_password' => false]);
    }

    public function loginWithPassword(Request $request) {
        $request->validate([
            'contact' => 'required|email',
            'password' => 'required'
        ]);

        $oldSessionId = session()->getId();

        if (Auth::attempt(['email' => $request->contact, 'password' => $request->password], true)) {
            $request->session()->regenerate();
            app(CartService::class)->mergeGuestCart($oldSessionId);
            return redirect()->intended('/products');
        }

        return back()->withErrors(['password' => 'Invalid password.'])->withInput(['contact' => $request->contact]);
    }

    public function register(Request $request) {
        $request->validate([
            'contact' => 'required|email',
            'otp' => 'required|numeric',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6'
        ]);

        $cached = Cache::get("otp:{$request->contact}");
        
        if (app()->environment('local') && $request->otp == '123456') {
            $cached = $request->otp;
        }

        if (!$cached || $cached != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }
        
        Cache::forget("otp:{$request->contact}");
        
        // Find existing guest user or create new
        $user = User::firstOrCreate(
            ['email' => $request->contact],
            ['name' => $request->name, 'is_active' => true]
        );

        $user->name = $request->name;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        
        $oldSessionId = session()->getId();
        Auth::login($user, true);
        $request->session()->regenerate();
        app(CartService::class)->mergeGuestCart($oldSessionId);
        
        return redirect()->intended('/products');
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'contact' => 'required|email',
            'otp' => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        $cached = Cache::get("otp:{$request->contact}");
        
        if (app()->environment('local') && $request->otp == '123456') {
            $cached = $request->otp;
        }

        if (!$cached || $cached != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }
        
        Cache::forget("otp:{$request->contact}");
        
        $user = User::where('email', $request->contact)->first();
        if ($user) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $user->save();
            $oldSessionId = session()->getId();
            Auth::login($user, true);
            $request->session()->regenerate();
            app(CartService::class)->mergeGuestCart($oldSessionId);
            return redirect()->intended('/products');
        }
        
        return back()->withErrors(['contact' => 'User not found.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
