@extends('storefront.layout')

@section('title', 'Login / Sign Up — MunchGud')

@section('content')
<div class="min-h-[92vh] flex items-center justify-center py-16 px-4" style="background: linear-gradient(135deg, #FAFAF5 0%, #F0F7F2 50%, #FAFAF5 100%);">
    
    <!-- Decorative blobs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-mg-green/[0.04] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-mg-orange/[0.04] rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Card -->
        <div class="bg-white rounded-[2rem] border border-black/[0.06] premium-shadow p-8 sm:p-10"
             x-data="{
                state: 'email', // email, password, register_otp, forgot_otp
                contact: '{{ old('contact') ?? '' }}',
                password: '',
                name: '',
                otp: '',
                loading: false,
                errorMessage: '',
                
                checkEmail() {
                    if (!this.contact) return;
                    this.loading = true;
                    this.errorMessage = '';
                    fetch('{{ route('auth.check') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ contact: this.contact })
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.loading = false;
                        if (data.success) {
                            if (data.has_password) {
                                this.state = 'password';
                            } else {
                                this.sendOtp('register_otp');
                            }
                        } else {
                            this.errorMessage = data.message || 'Error checking email.';
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                        this.errorMessage = 'Something went wrong. Please try again.';
                    });
                },

                sendOtp(nextState) {
                    if (!this.contact) return;
                    this.loading = true;
                    this.errorMessage = '';
                    fetch('{{ route('otp.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ contact: this.contact })
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.loading = false;
                        if (data.success) {
                            this.state = nextState;
                        } else {
                            this.errorMessage = data.message || 'Error sending OTP. Try again.';
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                        this.errorMessage = 'Something went wrong. Please try again.';
                    });
                },

                resetState() {
                    this.state = 'email';
                    this.password = '';
                    this.name = '';
                    this.otp = '';
                    this.errorMessage = '';
                }
             }"
             x-init="
                @if($errors->has('password')) state = 'password'; @endif
                @if($errors->has('otp')) state = '{{ old('name') ? 'register_otp' : 'forgot_otp' }}'; @endif
             ">

            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block mb-5">
                    <img src="{{ \App\Models\Setting::get('company_logo') ? Storage::url(\App\Models\Setting::get('company_logo')) : asset('images/logo.jpg') }}" alt="MunchGud" class="h-14 w-auto mx-auto object-contain rounded-xl">
                </a>
                <h1 class="text-2xl font-serif font-bold text-mg-dark" x-text="
                    state === 'email' ? 'Welcome to MunchGud' :
                    state === 'password' ? 'Welcome Back!' :
                    state === 'register_otp' ? 'Create Account' : 'Reset Password'
                "></h1>
                <p class="text-mg-muted text-sm mt-1.5 font-light" x-text="
                    state === 'email' ? 'Sign in or create your account in seconds' :
                    state === 'password' ? 'Enter your password to sign in' :
                    state === 'register_otp' ? 'Verify email and complete setup' : 'Verify email to set a new password'
                "></p>
            </div>

            <!-- Error (JS) -->
            <div x-show="errorMessage" x-cloak class="flex items-center gap-2 text-red-600 text-xs bg-red-50 border border-red-100 rounded-xl px-4 py-3 mb-5">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span x-text="errorMessage"></span>
            </div>

            <!-- Error (Server) -->
            @if($errors->any())
                <div class="flex items-center gap-2 text-red-600 text-xs bg-red-50 border border-red-100 rounded-xl px-4 py-3 mb-5">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Step 1: Email -->
            <form x-show="state === 'email'" @submit.prevent="checkEmail()" class="space-y-5">
                <div>
                    <label for="contact" class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-mg-muted pointer-events-none flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" id="contact" x-model="contact" required
                               class="w-full pl-11 pr-4 py-3.5 border border-black/[0.1] rounded-xl text-sm text-mg-dark placeholder-mg-muted focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                               placeholder="hello@email.com"
                               :disabled="loading">
                    </div>
                </div>

                <button type="submit" :disabled="loading"
                        class="btn-primary w-full py-3.5 text-[13px] justify-center"
                        :class="loading ? 'opacity-75 cursor-wait' : ''">
                    <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 2a10 10 0 110 20A10 10 0 0112 2zm0 4v4l3 3"/></svg>
                    <span x-show="!loading">Continue →</span>
                    <span x-show="loading" x-cloak>Please wait...</span>
                </button>

                <!-- Divider -->
                <div class="relative flex items-center gap-4 py-2">
                    <div class="flex-1 h-px bg-black/[0.07]"></div>
                    <span class="text-xs text-mg-muted font-medium uppercase tracking-widest">or</span>
                    <div class="flex-1 h-px bg-black/[0.07]"></div>
                </div>

                <!-- Google Login -->
                <a href="{{ route('auth.google') }}"
                   class="w-full flex items-center justify-center gap-3 bg-white border border-black/[0.1] text-mg-dark text-sm font-semibold py-3.5 rounded-xl hover:bg-gray-50 hover:border-black/[0.15] transition-all shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continue with Google
                </a>
            </form>

            <!-- Step 2: Login with Password -->
            <form x-show="state === 'password'" x-cloak action="{{ route('login.password') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="contact" :value="contact">

                <div class="flex items-center gap-3 bg-mg-green/[0.05] border border-mg-green/10 rounded-xl px-4 py-3">
                    <div class="w-9 h-9 bg-mg-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-mg-dark font-bold truncate" x-text="contact"></p>
                    </div>
                    <button type="button" @click="resetState()" class="text-xs text-mg-orange font-bold hover:underline uppercase tracking-wider flex-shrink-0">
                        Change
                    </button>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label for="login_password" class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest">
                            Password
                        </label>
                        <button type="button" @click="sendOtp('forgot_otp')" class="text-[11px] font-bold text-mg-green hover:underline">
                            Forgot Password?
                        </button>
                    </div>
                    <div class="relative" x-data="{ showLoginPass: false }">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-mg-muted pointer-events-none flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        </div>
                        <input :type="showLoginPass ? 'text' : 'password'" id="login_password" name="password" required
                               class="w-full pl-11 pr-11 py-3.5 border border-black/[0.1] rounded-xl text-sm text-mg-dark placeholder-mg-muted focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                               placeholder="Enter your password">
                        <button type="button" @click="showLoginPass = !showLoginPass" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-mg-muted hover:text-mg-dark transition p-1 cursor-pointer focus:outline-none" :title="showLoginPass ? 'Hide password' : 'Show password'">
                            <svg x-show="!showLoginPass" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="showLoginPass" x-cloak class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-3.5 text-[13px] justify-center">
                    Sign In →
                </button>
            </form>

            <!-- Step 3: Register OTP + Setup -->
            <form x-show="state === 'register_otp'" x-cloak action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="contact" :value="contact">

                <div class="flex items-center gap-3 bg-mg-green/[0.05] border border-mg-green/10 rounded-xl px-4 py-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-mg-green font-semibold">OTP sent to</p>
                        <p class="text-sm text-mg-dark font-bold truncate" x-text="contact"></p>
                    </div>
                    <button type="button" @click="resetState()" class="text-xs text-mg-orange font-bold hover:underline uppercase tracking-wider flex-shrink-0">
                        Change
                    </button>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-1.5">Enter 6-digit OTP</label>
                    <input type="text" name="otp" required maxlength="6" inputmode="numeric" autocomplete="one-time-code"
                           class="w-full border border-black/[0.1] rounded-xl py-3 text-center text-xl font-mono font-bold tracking-[0.35em] focus:border-mg-green outline-none transition bg-mg-cream"
                           placeholder="••••••">
                    <div class="text-right mt-1">
                        <button type="button" @click="sendOtp('register_otp')" class="text-[10px] text-mg-orange font-bold hover:underline" :disabled="loading">Resend OTP</button>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-1.5">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-black/[0.1] rounded-xl text-sm focus:border-mg-green outline-none"
                           placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-1.5">Create Password</label>
                    <div class="relative" x-data="{ showRegPass: false }">
                        <input :type="showRegPass ? 'text' : 'password'" name="password" required minlength="6"
                               class="w-full pl-4 pr-11 py-3 border border-black/[0.1] rounded-xl text-sm focus:border-mg-green outline-none"
                               placeholder="At least 6 characters">
                        <button type="button" @click="showRegPass = !showRegPass" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-mg-muted hover:text-mg-dark transition p-1 cursor-pointer focus:outline-none" :title="showRegPass ? 'Hide password' : 'Show password'">
                            <svg x-show="!showRegPass" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="showRegPass" x-cloak class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-3.5 text-[13px] justify-center mt-2">
                    Create Account →
                </button>
            </form>

            <!-- Step 4: Forgot Password OTP + Reset -->
            <form x-show="state === 'forgot_otp'" x-cloak action="{{ route('password.reset') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="contact" :value="contact">

                <div class="flex items-center gap-3 bg-mg-orange/[0.05] border border-mg-orange/10 rounded-xl px-4 py-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-mg-orange font-semibold">Recovery OTP sent to</p>
                        <p class="text-sm text-mg-dark font-bold truncate" x-text="contact"></p>
                    </div>
                    <button type="button" @click="state = 'password'" class="text-xs text-mg-dark font-bold hover:underline uppercase tracking-wider flex-shrink-0">
                        Cancel
                    </button>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-1.5">Enter 6-digit OTP</label>
                    <input type="text" name="otp" required maxlength="6" inputmode="numeric" autocomplete="one-time-code"
                           class="w-full border border-black/[0.1] rounded-xl py-3 text-center text-xl font-mono font-bold tracking-[0.35em] focus:border-mg-green outline-none transition bg-mg-cream"
                           placeholder="••••••">
                    <div class="text-right mt-1">
                        <button type="button" @click="sendOtp('forgot_otp')" class="text-[10px] text-mg-orange font-bold hover:underline" :disabled="loading">Resend OTP</button>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-1.5">New Password</label>
                    <div class="relative" x-data="{ showResetPass: false }">
                        <input :type="showResetPass ? 'text' : 'password'" name="password" required minlength="6"
                               class="w-full pl-4 pr-11 py-3 border border-black/[0.1] rounded-xl text-sm focus:border-mg-green outline-none"
                               placeholder="At least 6 characters">
                        <button type="button" @click="showResetPass = !showResetPass" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-mg-muted hover:text-mg-dark transition p-1 cursor-pointer focus:outline-none" :title="showResetPass ? 'Hide password' : 'Show password'">
                            <svg x-show="!showResetPass" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="showResetPass" x-cloak class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-3.5 text-[13px] justify-center mt-2">
                    Reset & Sign In →
                </button>
            </form>

            <!-- Footer note -->
            <p class="text-center text-[11px] text-mg-muted mt-6 leading-relaxed">
                By continuing, you agree to MunchGud's 
                <a href="{{ route('terms') }}" class="hover:text-mg-green underline underline-offset-2">Terms of Service</a> 
                and 
                <a href="{{ route('privacy') }}" class="hover:text-mg-green underline underline-offset-2">Privacy Policy</a>.
            </p>
        </div>

        <!-- Trust badges below card -->
        <div class="flex items-center justify-center gap-6 mt-6 opacity-60">
            <div class="flex items-center gap-1.5 text-[11px] text-mg-dark/50 font-medium">
                <svg class="w-3.5 h-3.5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round"/></svg>
                256-bit encrypted
            </div>
            <div class="flex items-center gap-1.5 text-[11px] text-mg-dark/50 font-medium">
                <svg class="w-3.5 h-3.5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                Secure Login
            </div>
        </div>
    </div>
</div>
@endsection
