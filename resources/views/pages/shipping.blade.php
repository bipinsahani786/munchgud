@extends('storefront.layout')

@section('title', 'Shipping Policy - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Fulfillment</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Shipping Policy</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#charges" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Shipping Charges</a>
                <a href="#processing" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Processing & Delivery Times</a>
                <a href="#tracking" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. Order Tracking</a>
                <a href="#cod" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Cash on Delivery (COD)</a>
                <a href="#undelivered" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Undelivered Packages</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                
                <section id="charges" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">1. Shipping Charges</h2>
                    <p class="mb-4">We are thrilled to offer **FREE standard shipping** across India on all orders of **₹999 or more**.</p>
                    <p>For orders below ₹999, a flat shipping and handling fee of **₹49** is charged at checkout to cover transit and protective packaging costs.</p>
                </section>

                <hr class="border-munch-100">

                <section id="processing" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">2. Processing & Delivery Times</h2>
                    <p class="mb-4">Our makhana seeds are sourced fresh directly from local ponds in Bihar, roasted in controlled small batches, and dispatched directly from our central fulfillment facility.</p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li><strong>Order Processing:</strong> All orders are processed and prepared for shipping within 1-2 business days. Orders placed on Sundays or public holidays are processed the next business day.</li>
                        <li><strong>Transit Times (Metro Cities):</strong> 2-4 business days post-dispatch.</li>
                        <li><strong>Transit Times (Rest of India):</strong> 4-7 business days post-dispatch depending on local accessibility.</li>
                    </ul>
                    <p>Please note that delivery timelines are estimates and can occasionally be delayed by remote routes, weather conditions, or peak festive periods.</p>
                </section>

                <hr class="border-munch-100">

                <section id="tracking" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">3. Order Tracking</h2>
                    <p class="mb-4">Once your order is picked up by our logistics network (Shiprocket), you will immediately receive a dispatch notification via email and SMS containing your direct tracking URL and AWB number.</p>
                    <p>You can also check the real-time shipping status of your package at any time by logging into your account, navigating to **My Orders**, and selecting **Track Shipment**.</p>
                </section>

                <hr class="border-munch-100">

                <section id="cod" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">4. Cash on Delivery (COD)</h2>
                    <p class="mb-4">Cash on Delivery (COD) is supported across most pin codes in India. When checking out with the COD payment method, an additional **COD convenience charge of ₹30** is applied. This fee goes directly toward courier collection charges and cash routing handling.</p>
                    <p>To avoid this fee and enjoy contact-free delivery, we encourage using secure pre-paid UPI, Credit/Debit cards, or Netbanking options.</p>
                </section>

                <hr class="border-munch-100">

                <section id="undelivered" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">5. Undelivered Packages</h2>
                    <p class="mb-4">Our delivery partners will attempt to deliver your order up to **3 times** before initiating a Return-to-Origin (RTO). In the event of a failed delivery due to an incorrect shipping address, phone number, or unavailability of the recipient, our support desk will contact you to reschedule.</p>
                    <p>If you need to change your delivery address after placing an order, please contact us immediately at support@munchgud.com or raise a ticket. We cannot alter the address once the order has been handed over to the courier partners.</p>
                </section>

            </article>
        </div>
    </div>
</div>
@endsection
