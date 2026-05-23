@extends('storefront.layout')

@section('title', 'Contact Us — MunchGud')
@section('meta_description', 'Get in touch with the MunchGud team. We love hearing from our snackers! Reach us via email, WhatsApp, or our contact form.')

@section('content')
<div class="bg-munch-cream min-h-screen">

    {{-- ── Hero ────────────────────────────────────────── --}}
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">We're Here For You</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Get In Touch</h1>
            <p class="text-munch-200 font-light text-lg max-w-xl mx-auto">Whether it's a question, feedback, or just saying hi — we'd love to hear from you!</p>
        </div>
    </div>

    {{-- ── Contact Grid ─────────────────────────────────── --}}
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-16">
        <div class="grid lg:grid-cols-3 gap-10 xl:gap-14">

            {{-- Contact Info Cards --}}
            <div class="space-y-5">
                <h2 class="text-2xl font-serif font-bold text-munch-900 mb-6">Our Details</h2>

                {{-- Email --}}
                <div class="bg-white rounded-2xl border border-munch-100 p-6 premium-shadow flex items-start gap-4 hover:border-mg-green/20 transition group">
                    <div class="w-12 h-12 bg-mg-green/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-mg-green/15 transition">
                        <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-munch-500 mb-1">Email Us</p>
                        <a href="mailto:support@munchgud.com" class="text-munch-900 font-semibold text-sm hover:text-mg-green transition">support@munchgud.com</a>
                        <p class="text-xs text-munch-500 mt-1">We respond within 24 hours</p>
                    </div>
                </div>

                {{-- WhatsApp --}}
                <div class="bg-white rounded-2xl border border-munch-100 p-6 premium-shadow flex items-start gap-4 hover:border-[#25D366]/30 transition group">
                    <div class="w-12 h-12 bg-[#25D366]/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#25D366]/15 transition">
                        <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-munch-500 mb-1">WhatsApp Chat</p>
                        <a href="https://wa.me/919999999999" target="_blank" rel="noopener" class="text-munch-900 font-semibold text-sm hover:text-[#25D366] transition">+91 99999 99999</a>
                        <p class="text-xs text-munch-500 mt-1">Mon–Sat, 10am – 6pm IST</p>
                    </div>
                </div>

                {{-- Location --}}
                <div class="bg-white rounded-2xl border border-munch-100 p-6 premium-shadow flex items-start gap-4 hover:border-mg-green/20 transition group">
                    <div class="w-12 h-12 bg-mg-green/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-mg-green/15 transition">
                        <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-munch-500 mb-1">Our Base</p>
                        <p class="text-munch-900 font-semibold text-sm">Darbhanga, Bihar</p>
                        <p class="text-xs text-munch-500 mt-1">India — 846 004</p>
                    </div>
                </div>

                {{-- Support Hours --}}
                <div class="bg-mg-green/[0.05] border border-mg-green/15 rounded-2xl p-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-mg-green mb-3">Support Hours</p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-munch-700">Monday – Friday</span>
                            <span class="text-munch-900 font-semibold">10am – 6pm</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-munch-700">Saturday</span>
                            <span class="text-munch-900 font-semibold">10am – 2pm</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-munch-700">Sunday</span>
                            <span class="text-munch-400 font-medium">Closed</span>
                        </div>
                    </div>
                </div>

                {{-- Quick links --}}
                <div class="bg-white rounded-2xl border border-munch-100 p-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-munch-500 mb-3">Quick Help</p>
                    <div class="space-y-2">
                        <a href="{{ route('faq') }}" class="flex items-center gap-2.5 text-sm text-munch-700 hover:text-mg-green font-medium transition group">
                            <svg class="w-4 h-4 text-mg-green/50 group-hover:text-mg-green transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Browse FAQs
                        </a>
                        <a href="{{ route('shipping') }}" class="flex items-center gap-2.5 text-sm text-munch-700 hover:text-mg-green font-medium transition group">
                            <svg class="w-4 h-4 text-mg-green/50 group-hover:text-mg-green transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Shipping Policy
                        </a>
                        <a href="{{ route('refund') }}" class="flex items-center gap-2.5 text-sm text-munch-700 hover:text-mg-green font-medium transition group">
                            <svg class="w-4 h-4 text-mg-green/50 group-hover:text-mg-green transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Returns & Refunds
                        </a>
                        @auth
                        <a href="{{ route('account.tickets.create') }}" class="flex items-center gap-2.5 text-sm text-mg-green font-semibold hover:underline transition group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-linecap="round"/></svg>
                            Open Support Ticket
                        </a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-munch-100 premium-shadow p-8 md:p-10">
                    <h2 class="text-2xl font-serif font-bold text-munch-900 mb-2">Send Us a Message</h2>
                    <p class="text-sm text-munch-500 mb-8 font-light">Fill out the form and our team will get back to you within 24 hours.</p>

                    {{-- Success Message --}}
                    @if(session('success'))
                    <div class="flex items-start gap-3 bg-green-50 border border-green-200/70 text-green-800 rounded-2xl p-5 mb-6">
                        <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">Message sent successfully!</p>
                            <p class="text-xs text-green-700 mt-0.5 font-light">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf

                        {{-- Name + Email Row --}}
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" required
                                       value="{{ old('name') }}"
                                       class="w-full border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-munch-200' }} rounded-xl px-4 py-3.5 text-sm text-munch-900 placeholder-munch-400 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                                       placeholder="Your full name">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" required
                                       value="{{ old('email') }}"
                                       class="w-full border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-munch-200' }} rounded-xl px-4 py-3.5 text-sm text-munch-900 placeholder-munch-400 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                                       placeholder="hello@email.com">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Phone Number <span class="text-munch-400 normal-case font-normal">(optional)</span></label>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full border border-munch-200 rounded-xl px-4 py-3.5 text-sm text-munch-900 placeholder-munch-400 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                                   placeholder="+91 98765 43210">
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Subject *</label>
                            <select id="subject" name="subject" required
                                    class="w-full border {{ $errors->has('subject') ? 'border-red-400 bg-red-50' : 'border-munch-200' }} rounded-xl px-4 py-3.5 text-sm text-munch-900 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition appearance-none bg-white">
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a topic…</option>
                                <option value="Order Issue" {{ old('subject') == 'Order Issue' ? 'selected' : '' }}>Order Issue / Delay</option>
                                <option value="Product Query" {{ old('subject') == 'Product Query' ? 'selected' : '' }}>Product Query</option>
                                <option value="Return / Refund" {{ old('subject') == 'Return / Refund' ? 'selected' : '' }}>Return / Refund Request</option>
                                <option value="Bulk / Corporate Order" {{ old('subject') == 'Bulk / Corporate Order' ? 'selected' : '' }}>Bulk / Corporate Order</option>
                                <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership / Collaboration</option>
                                <option value="General Feedback" {{ old('subject') == 'General Feedback' ? 'selected' : '' }}>General Feedback</option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Order Number (optional) --}}
                        <div>
                            <label for="order_number" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Order Number <span class="text-munch-400 normal-case font-normal">(if applicable)</span></label>
                            <input type="text" id="order_number" name="order_number"
                                   value="{{ old('order_number') }}"
                                   class="w-full border border-munch-200 rounded-xl px-4 py-3.5 text-sm text-munch-900 placeholder-munch-400 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition"
                                   placeholder="e.g. MG-1092">
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-[11px] font-bold uppercase tracking-widest text-munch-600 mb-2">Your Message *</label>
                            <textarea id="message" name="message" required rows="5"
                                      class="w-full border {{ $errors->has('message') ? 'border-red-400 bg-red-50' : 'border-munch-200' }} rounded-xl px-4 py-3.5 text-sm text-munch-900 placeholder-munch-400 focus:border-mg-green focus:ring-2 focus:ring-mg-green/10 outline-none transition resize-none"
                                      placeholder="Tell us how we can help you…">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <button type="submit"
                                    :disabled="submitting"
                                    class="btn-primary py-3.5 px-8 text-[13px]"
                                    :class="submitting ? 'opacity-75 cursor-wait' : ''">
                                <svg x-show="submitting" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 2a10 10 0 110 20A10 10 0 0112 2zm0 4v4l3 3"/></svg>
                                <span x-show="!submitting">Send Message →</span>
                                <span x-show="submitting" x-cloak>Sending…</span>
                            </button>
                            <p class="text-xs text-munch-500 font-light">
                                <svg class="w-3.5 h-3.5 inline-block mr-1 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round"/></svg>
                                Your information is safe with us.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Map Section ──────────────────────────────────── --}}
    <div class="bg-munch-900/5 border-t border-munch-200 py-16">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 text-center">
            <span class="text-mg-green text-xs font-bold uppercase tracking-widest mb-3 block">Find Us</span>
            <h2 class="text-3xl font-serif font-bold text-munch-900 mb-4">Rooted in the Heart of Bihar</h2>
            <p class="text-munch-600 font-light mb-10 max-w-md mx-auto text-sm">Our makhanas are sourced, roasted, and packed in Darbhanga — the makhana capital of the world.</p>
            <div class="rounded-3xl overflow-hidden border border-munch-200 premium-shadow max-w-4xl mx-auto">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114958.96936453574!2d85.82003!3d26.15228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ee3ead7b22c451%3A0x9c62f94f2fd9e63f!2sDarbhanga%2C%20Bihar!5e0!3m2!1sen!2sin!4v1716300000000"
                    width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="MunchGud Location - Darbhanga, Bihar">
                </iframe>
            </div>
        </div>
    </div>

</div>
@endsection
