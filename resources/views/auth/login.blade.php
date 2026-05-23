@extends('storefront.layout')

@section('title', 'Login — MunchGud')

@section('content')
<div class="min-h-[92vh] flex items-center justify-center py-16 px-4" style="background: linear-gradient(135deg, #FAFAF5 0%, #F0F7F2 50%, #FAFAF5 100%);">
    
    <!-- Decorative blobs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-mg-green/[0.04] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-mg-orange/[0.04] rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Card -->
        <div class="bg-white rounded-[2rem] border border-black/[0.06] premium-shadow p-8 sm:p-10"
             x-data="{
                otpSent: false,
                contact: '',
                otp: '',
                sending: false,
                verifyError: '',
                sendOtp() {
                    if (!this.contact) return;
                    this.sending = true;
                    this.verifyError = '';
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
                        this.sending = false;
                        if (data.success) {
                            this.otpSent = true;
                        } else {
                            this.verifyError = data.message || 'Error sending OTP. Try again.';
                        }
                    })
                    .catch(() => {
                        this.sending = false;
                        this.verifyError = 'Something went wrong. Please try again.';
                    });
                }
             }">

            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block mb-5">
                    <img src="{{ asset('images/logo.jpg') }}" alt="MunchGud" class="h-14 w-auto mx-auto object-contain rounded-xl">
                </a>
                <h1 class="text-2xl font-serif font-bold text-mg-dark">Welcome to MunchGud</h1>
                <p class="text-mg-muted text-sm mt-1.5 font-light">Sign in or create your account in seconds</p>
            </div>

            <!-- Step 1: Send OTP -->
            <form x-show="!otpSent" @submit.prevent="sendOtp()" class="space-y-5">
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
                               :disabled="sending">
                    </div>
                </div>

                <!-- Error -->
                <div x-show="verifyError" x-cloak class="flex items-center gap-2 text-red-600 text-xs bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span x-text="verifyError"></span>
                </div>

                <button type="submit" :disabled="sending"
                        class="btn-primary w-full py-3.5 text-[13px] justify-center"
                        :class="sending ? 'opacity-75 cursor-wait' : ''">
                    <svg x-show="sending" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 2a10 10 0 110 20A10 10 0 0112 2zm0 4v4l3 3"/></svg>
                    <span x-show="!sending">Send OTP →</span>
                    <span x-show="sending" x-cloak>Sending...</span>
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

            <!-- Step 2: Enter OTP -->
            <form x-show="otpSent" x-cloak action="{{ route('otp.verify') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="contact" :value="contact">

                <!-- Back & Info -->
                <div class="flex items-center gap-3 bg-mg-green/[0.05] border border-mg-green/10 rounded-xl px-4 py-3">
                    <div class="w-9 h-9 bg-mg-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-mg-green font-semibold">OTP sent to</p>
                        <p class="text-sm text-mg-dark font-bold truncate" x-text="contact"></p>
                    </div>
                    <button type="button" @click="otpSent = false" class="text-xs text-mg-orange font-bold hover:underline uppercase tracking-wider flex-shrink-0">
                        Change
                    </button>
                </div>

                <!-- Error from server -->
                @error('otp')
                    <div class="flex items-center gap-2 text-red-600 text-xs bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        {{ $message }}
                    </div>
                @enderror

                <!-- OTP Input -->
                <div>
                    <label for="otp" class="block text-[11px] font-bold text-mg-dark/60 uppercase tracking-widest mb-2 text-center">
                        Enter 6-digit OTP
                    </label>
                    <input type="text" name="otp" id="otp" required x-model="otp" maxlength="6" inputmode="numeric" autocomplete="one-time-code"
                           class="w-full border border-black/[0.1] rounded-xl py-4 text-center text-3xl font-mono font-bold text-mg-green tracking-[0.35em] focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition placeholder-mg-muted/30 bg-mg-cream"
                           placeholder="• • • • • •">
                    <p class="text-center text-xs text-mg-muted mt-2">Valid for 10 minutes</p>
                </div>

                <button type="submit" class="btn-primary w-full py-3.5 text-[13px] justify-center">
                    Verify & Sign In →
                </button>

                <p class="text-center text-xs text-mg-muted">
                    Didn't receive the code?
                    <button type="button" @click="sendOtp()" class="text-mg-orange font-bold hover:underline ml-1">
                        Resend OTP
                    </button>
                </p>
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
                <svg class="w-3.5 h-3.5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3" stroke-linecap="round"/></svg>
                OTP valid 10 mins
            </div>
            <div class="flex items-center gap-1.5 text-[11px] text-mg-dark/50 font-medium">
                <svg class="w-3.5 h-3.5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round"/></svg>
                No password needed
            </div>
        </div>
    </div>
</div>
@endsection
