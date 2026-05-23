@extends('storefront.layout')

@section('title', 'Terms of Service - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Agreements</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Terms of Service</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#acceptance" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Acceptance of Terms</a>
                <a href="#accounts" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Customer Accounts</a>
                <a href="#purchases" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. Purchases & Payments</a>
                <a href="#intellectual" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Intellectual Property</a>
                <a href="#limitations" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Limitations of Liability</a>
                <a href="#governing" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">6. Governing Law</a>
                <a href="#changes" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">7. Changes to Terms</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                
                <section id="acceptance" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">1. Acceptance of Terms</h2>
                    <p class="mb-4">These Terms of Service constitute a legally binding agreement made between you, whether personally or on behalf of an entity, and MunchGud, concerning your access to and use of the munchgud.com website as well as any other media form, mobile website, or application related, linked, or otherwise connected thereto.</p>
                    <p>By accessing the Site, you agree that you have read, understood, and agree to be bound by all of these Terms of Service. If you do not agree with all of these Terms of Service, then you are expressly prohibited from using the Site and you must discontinue use immediately.</p>
                </section>

                <hr class="border-munch-100">

                <section id="accounts" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">2. Customer Accounts</h2>
                    <p class="mb-4">To place orders and manage wishlists or tickets on the storefront, you may be required to sign in. We utilize a secure, passwordless OTP (One-Time Password) system tied directly to your unique phone number or email address.</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>You are solely responsible for maintaining the confidentiality of your credentials and mobile access devices.</li>
                        <li>You agree to provide accurate, current, and complete details when checking out or managing addresses.</li>
                        <li>We reserve the right to suspend or terminate accounts that register with fraudulent credentials or engage in abusive platform behavior.</li>
                    </ul>
                </section>

                <hr class="border-munch-100">

                <section id="purchases" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">3. Purchases & Payments</h2>
                    <p class="mb-4">We accept various forms of payment including credit cards, debit cards, UPI, digital wallets, and Cash on Delivery (COD) via our integrated checkout process. All sales transactions are processed in Indian Rupees (INR).</p>
                    <p class="mb-4">You agree to provide current, complete, and accurate purchase and account information for all purchases made via the storefront. You further agree to promptly update account and payment information, including email address and payment method details, so that we can complete your transactions and contact you as needed.</p>
                    <p>We reserve the right to refuse or limit any order placed through the site. Prices for all products are subject to change without notice.</p>
                </section>

                <hr class="border-munch-100">

                <section id="intellectual" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">4. Intellectual Property</h2>
                    <p class="mb-4">Unless otherwise indicated, the Site is our proprietary property and all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics on the Site (collectively, the "Content") and the trademarks, service marks, and logos contained therein are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws.</p>
                    <p>Except as expressly provided in these Terms of Service, no part of the Site and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.</p>
                </section>

                <hr class="border-munch-100">

                <section id="limitations" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">5. Limitations of Liability</h2>
                    <p class="mb-4">In no event will we or our directors, employees, or agents be liable to you or any third party for any direct, indirect, consequential, exemplary, incidental, special, or punitive damages, including lost profit, lost revenue, loss of data, or other damages arising from your use of the site, even if we have been advised of the possibility of such damages.</p>
                </section>

                <hr class="border-munch-100">

                <section id="governing" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">6. Governing Law</h2>
                    <p class="mb-4">These Terms of Service and your use of the Site are governed by and construed in accordance with the laws of India, applicable to agreements made and to be entirely performed within the state of Bihar, without regard to its conflict of law principles.</p>
                </section>

                <hr class="border-munch-100">

                <section id="changes" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">7. Changes to Terms</h2>
                    <p class="mb-4">We reserve the right, in our sole discretion, to make changes or modifications to these Terms of Service at any time and for any reason. We will alert you about any changes by updating the "Last Updated" date of these Terms of Service, and you waive any right to receive specific notice of each such change.</p>
                    <p>It is your responsibility to periodically review these Terms of Service to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms of Service by your continued use of the Site after the date such revised Terms are posted.</p>
                </section>

            </article>
        </div>
    </div>
</div>
@endsection
