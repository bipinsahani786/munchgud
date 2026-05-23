@extends('storefront.layout')

@section('title', 'Refund & Return Policy - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Orders & Returns</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Refund & Return Policy</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#overview" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Overview</a>
                <a href="#damages" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Damages & Issues</a>
                <a href="#cancellations" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. Order Cancellations</a>
                <a href="#refund-process" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Refund Process</a>
                <a href="#contact-us" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Contact Customer Support</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                
                <section id="overview" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">1. Overview</h2>
                    <p class="mb-4">Due to the perishable food nature of roasted makhana snack items, we generally **do not accept returns** on snacks once they have been delivered. This policy is in place to ensure absolute hygiene and product safety for all our customers.</p>
                    <p>However, your satisfaction is our top priority! If you receive a product that is damaged, defective, or incorrect, we will happily process a **free replacement or a full refund** within 7 days of delivery.</p>
                </section>

                <hr class="border-munch-100">

                <section id="damages" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">2. Damages & Issues</h2>
                    <p class="mb-4">Please inspect your order upon reception and contact us immediately (within 48 hours of delivery) if the item is defective, damaged, or if you receive the wrong item, so that we can evaluate the issue and make it right.</p>
                    <p class="mb-4">To speed up your claim, please provide:</p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li>Your Order Number (e.g. MG-1092).</li>
                        <li>Clear photos or a brief video showing the damaged packaging or incorrect product received.</li>
                        <li>A description of the issue.</li>
                    </ul>
                    <p>Once evaluated and approved, we will dispatch a brand-new replacement box at zero extra cost to you, or initiate a refund to your original payment method.</p>
                </section>

                <hr class="border-munch-100">

                <section id="cancellations" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">3. Order Cancellations</h2>
                    <p class="mb-4">You can cancel your order free of charge within **2 hours** of placing it. To cancel your order, please raise a ticket directly through the Account Dashboard or contact us at {{ $global_settings['store_email'] ?? 'support@munchgud.com' }} with your order details.</p>
                    <p>Once an order has been picked up by our shipping partners or dispatched from our central warehouse in Bihar, we cannot accept cancellations or offer refunds for that order.</p>
                </section>

                <hr class="border-munch-100">

                <section id="refund-process" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">4. Refund Process</h2>
                    <p class="mb-4">If a refund is approved, it will be automatically processed and credited back to your original payment method within **5-7 business days** (depending on your bank or credit card issuer). For Cash on Delivery (COD) orders, our support team will reach out to collect your UPI or bank details to securely transfer the refund amount.</p>
                    <p>Please note that shipping charges (if applicable) are non-refundable unless the return is due to our error (e.g. incorrect or damaged product shipped).</p>
                </section>

                <hr class="border-munch-100">

                <section id="contact-us" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">5. Contact Customer Support</h2>
                    <p class="mb-4">For any refund or replacement inquiries, feel free to contact us through any of the following channels:</p>
                    <ul class="list-disc pl-6 space-y-2 mb-6">
                        <li>Email: <a href="mailto:{{ $global_settings['store_email'] ?? 'support@munchgud.com' }}" class="text-mg-green hover:underline">{{ $global_settings['store_email'] ?? 'support@munchgud.com' }}</a></li>
                        <li>Support Tickets: <a href="{{ route('account.tickets.index') }}" class="text-mg-green hover:underline">Raise a Ticket in your Account Dashboard</a></li>
                        <li>Response Time: We aim to respond to all inquiries within 24 hours.</li>
                    </ul>
                </section>

            </article>
        </div>
    </div>
</div>
@endsection
