@extends('storefront.layout')

@section('title', 'Shipping Policy - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Shipping Policy</h1>
            <p class="text-mg-muted text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <!-- Content Box -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-mg-dark/5 p-8 sm:p-12 reveal" style="transition-delay: 0.1s">
            
            <div class="prose prose-lg prose-emerald max-w-none prose-headings:font-heading prose-headings:font-black prose-headings:text-mg-dark prose-p:text-mg-dark/80 prose-p:leading-relaxed prose-li:text-mg-dark/80">
                
                <!-- 1. Order Processing -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">1</span>
                        Order Processing
                    </h2>
                    <p>All orders placed on MunchGud are processed within 1–3 business days after successful payment confirmation.</p>
                    <p>Orders are processed only on working days (Monday to Saturday).</p>
                </div>

                <!-- 2. Shipping Time -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">2</span>
                        Shipping Time
                    </h2>
                    <p>Delivery times may vary depending on your location. Generally:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li><strong>Metro Cities:</strong> 2–5 business days</li>
                        <li><strong>Other Cities/Towns:</strong> 3–7 business days</li>
                    </ul>
                    <p class="mt-4 text-mg-dark font-semibold">Delivery timelines may be affected due to weather conditions, courier delays, or other unforeseen circumstances.</p>
                </div>

                <!-- 3. Shipping Charges -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">3</span>
                        Shipping Charges
                    </h2>
                    <p>Shipping charges, if applicable, will be displayed during the checkout process before completing your order.</p>
                    <p>From time to time, MunchGud may offer free shipping promotions on selected orders or order values.</p>
                </div>

                <!-- 4. Order Tracking -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">4</span>
                        Order Tracking
                    </h2>
                    <p>Once your order is shipped, you will receive a tracking number via email or SMS so you can track your shipment.</p>
                </div>

                <!-- 5. Delivery Issues -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">5</span>
                        Delivery Issues
                    </h2>
                    <p>If your order is delayed, lost, or shows delivered but not received, please contact us within 48 hours so we can assist you.</p>
                </div>

                <!-- 6. Contact Us -->
                <div class="mb-4">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">6</span>
                        Contact Us
                    </h2>
                    <p>For shipping-related queries:</p>
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
