@extends('storefront.layout')

@section('title', 'Terms & Conditions - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Terms & Conditions</h1>
            <p class="text-mg-muted text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <!-- Content Box -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-mg-dark/5 p-8 sm:p-12 reveal" style="transition-delay: 0.1s">
            
            <div class="prose prose-lg prose-emerald max-w-none prose-headings:font-heading prose-headings:font-black prose-headings:text-mg-dark prose-p:text-mg-dark/80 prose-p:leading-relaxed prose-li:text-mg-dark/80">
                
                <!-- 1. Introduction -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">1</span>
                        Introduction
                    </h2>
                    <p>Welcome to MunchGud. These Terms and Conditions govern your use of our website and services. By accessing or using our website and purchasing our products, you agree to comply with and be bound by these Terms.</p>
                    <p>If you do not agree with any part of these Terms, please do not use our website.</p>
                </div>

                <!-- 2. Use of Website -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">2</span>
                        Use of Website
                    </h2>
                    <p>By using this website, you agree that:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>You are at least 18 years old or using the website under parental supervision.</li>
                        <li>You will use the website only for lawful purposes.</li>
                        <li>You will not attempt to damage, hack, or misuse the website.</li>
                    </ul>
                </div>

                <!-- 3. Products & Pricing -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">3</span>
                        Products & Pricing
                    </h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>MunchGud sells roasted and flavored makhana snacks.</li>
                        <li>Product images are for illustration purposes only.</li>
                        <li>Actual packaging may vary slightly.</li>
                        <li>All prices are listed in Indian Rupees (₹) and may change without prior notice.</li>
                        <li>Products are subject to availability.</li>
                    </ul>
                </div>

                <!-- 4. Orders & Payment -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">4</span>
                        Orders & Payment
                    </h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Orders are confirmed only after successful payment.</li>
                        <li>Payments can be made through UPI, debit/credit cards, net banking, or other secure payment methods.</li>
                        <li>MunchGud reserves the right to cancel any order due to product unavailability or pricing errors.</li>
                    </ul>
                </div>

                <!-- 5. Shipping & Delivery -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">5</span>
                        Shipping & Delivery
                    </h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Orders will be processed and shipped within the estimated timeframe mentioned on the website.</li>
                        <li>Delivery times may vary depending on your location and courier services.</li>
                        <li>MunchGud is not responsible for delays caused by third-party courier partners or unforeseen circumstances.</li>
                    </ul>
                </div>

                <!-- 6. Return & Refund Policy -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">6</span>
                        Return & Refund Policy
                    </h2>
                    <p>Due to the nature of food products:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>Food items are generally non-returnable.</li>
                        <li>If you receive a damaged or incorrect product, please contact us within 48 hours of delivery with photos.</li>
                        <li>After verification, we may provide a replacement or refund.</li>
                    </ul>
                </div>

                <!-- 7. Intellectual Property -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">7</span>
                        Intellectual Property
                    </h2>
                    <p>All content on this website including:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>Logo</li>
                        <li>Images</li>
                        <li>Product descriptions</li>
                        <li>Website design</li>
                    </ul>
                    <p class="mt-4">belongs to MunchGud and may not be copied or used without written permission.</p>
                </div>

                <!-- 8. Limitation of Liability -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">8</span>
                        Limitation of Liability
                    </h2>
                    <p>MunchGud is not responsible for:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>Allergic reactions to ingredients</li>
                        <li>Improper product usage</li>
                        <li>Delays caused by courier or payment partners</li>
                    </ul>
                    <p class="mt-4 font-semibold">Customers should check product ingredients before consumption.</p>
                </div>

                <!-- 9. Changes to Terms -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">9</span>
                        Changes to Terms
                    </h2>
                    <p>MunchGud reserves the right to modify or update these Terms & Conditions at any time. Continued use of the website means you accept the updated terms.</p>
                </div>

                <!-- 10. Governing Law -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">10</span>
                        Governing Law
                    </h2>
                    <p>These Terms & Conditions are governed by the laws of India, and any disputes will be subject to the jurisdiction of Indian courts.</p>
                </div>

                <!-- 11. Contact Us -->
                <div class="mb-4">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">11</span>
                        Contact Us
                    </h2>
                    <p>If you have any questions about these Terms & Conditions, you can contact us:</p>
                    <div class="bg-mg-cream/50 rounded-xl p-6 mt-6 border border-mg-dark/5">
                        <p class="font-bold text-mg-dark text-lg mb-2">MunchGud</p>
                        <div class="flex items-center gap-3 text-mg-dark/80 mb-2">
                            <span>📧</span>
                            <a href="mailto:munchgud@gmail.com" class="hover:text-mg-green transition">munchgud@gmail.com</a>
                        </div>
                        <div class="flex items-center gap-3 text-mg-dark/80">
                            <span>📞</span>
                            <a href="tel:+918446274791" class="hover:text-mg-green transition">+91-8446274791</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
