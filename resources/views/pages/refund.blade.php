@extends('storefront.layout')

@section('title', 'Return & Refund Policy - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Return & Refund Policy</h1>
            <p class="text-mg-muted text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <!-- Content Box -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-mg-dark/5 p-8 sm:p-12 reveal" style="transition-delay: 0.1s">
            
            <div class="prose prose-lg prose-emerald max-w-none prose-headings:font-heading prose-headings:font-black prose-headings:text-mg-dark prose-p:text-mg-dark/80 prose-p:leading-relaxed prose-li:text-mg-dark/80">
                
                <!-- 1. Returns -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">1</span>
                        Returns
                    </h2>
                    <p>Due to the perishable nature of food products, MunchGud does not accept returns once the product has been delivered.</p>
                    <p>However, we want you to have the best experience, so we will assist you in case of any issues.</p>
                </div>

                <!-- 2. Damaged or Incorrect Products -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">2</span>
                        Damaged or Incorrect Products
                    </h2>
                    <p>If you receive:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>A damaged product</li>
                        <li>A defective product</li>
                        <li>A wrong item</li>
                    </ul>
                    <p class="mt-4 font-semibold text-mg-dark">Please contact us within 48 hours of delivery with:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-2">
                        <li>Your order number</li>
                        <li>Photos of the product and packaging</li>
                    </ul>
                    <p class="mt-4">After verification, we may offer a replacement or refund.</p>
                </div>

                <!-- 3. Refund Process -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">3</span>
                        Refund Process
                    </h2>
                    <p>If your refund request is approved:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>The refund will be processed within 5–7 business days.</li>
                        <li>Refunds will be issued to the original payment method used during checkout.</li>
                    </ul>
                </div>

                <!-- 4. Order Cancellation -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">4</span>
                        Order Cancellation
                    </h2>
                    <p>Orders can be cancelled only before they are shipped.</p>
                    <p>Once the order has been shipped, cancellation is not possible.</p>
                </div>

                <!-- 5. Contact Us -->
                <div class="mb-4">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">5</span>
                        Contact Us
                    </h2>
                    <p>For return or refund requests:</p>
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
