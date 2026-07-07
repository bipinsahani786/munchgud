@extends('storefront.layout')

@section('title', isset($page) && $page->meta_title ? $page->meta_title : 'Privacy Policy - MunchGud')
@section('meta_description', isset($page) && $page->meta_description ? $page->meta_description : 'Read the Privacy Policy of MunchGud to understand how we collect, use, and protect your personal data.')
@section('meta_keywords', isset($page) && $page->meta_keywords ? $page->meta_keywords : 'privacy policy, munchgud privacy, data protection')

@section('content')
<div class="bg-mg-cream min-h-screen py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Privacy Policy</h1>
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
                    <p>At MunchGud, we respect your privacy and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and protect your information when you visit our website or purchase our products.</p>
                    <p>By using our website, you agree to the terms of this Privacy Policy.</p>
                </div>

                <!-- 2. Information We Collect -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">2</span>
                        Information We Collect
                    </h2>
                    <p>We may collect the following types of information:</p>
                    
                    <h3 class="text-xl mt-6 mb-3 text-mg-dark">Personal Information</h3>
                    <p>When you place an order or contact us, we may collect:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-2">
                        <li>Name</li>
                        <li>Email address</li>
                        <li>Phone number</li>
                        <li>Shipping and billing address</li>
                        <li>Payment information (processed through secure payment gateways)</li>
                    </ul>

                    <h3 class="text-xl mt-6 mb-3 text-mg-dark">Non-Personal Information</h3>
                    <p>We may also collect information such as:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-2">
                        <li>Browser type</li>
                        <li>Device information</li>
                        <li>IP address</li>
                        <li>Pages visited on our website</li>
                    </ul>
                    <p class="mt-4">This helps us improve our website and services.</p>
                </div>

                <!-- 3. How We Use Your Information -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">3</span>
                        How We Use Your Information
                    </h2>
                    <p>The information we collect may be used to:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>Process and deliver your orders</li>
                        <li>Communicate order updates and customer support</li>
                        <li>Improve our website and services</li>
                        <li>Send promotional offers or updates (only if you choose to receive them)</li>
                    </ul>
                </div>

                <!-- 4. Payment Security -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">4</span>
                        Payment Security
                    </h2>
                    <p>All payments on our website are processed through secure third-party payment gateways.</p>
                    <p>MunchGud does not store your debit/credit card details on our servers.</p>
                </div>

                <!-- 5. Sharing of Information -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">5</span>
                        Sharing of Information
                    </h2>
                    <p>We do not sell, trade, or rent your personal information to third parties.</p>
                    <p>However, your information may be shared with trusted partners such as:</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li>Courier and delivery companies for shipping orders</li>
                        <li>Payment gateway providers for processing payments</li>
                        <li>Legal authorities if required by law</li>
                    </ul>
                </div>

                <!-- 6. Cookies -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">6</span>
                        Cookies
                    </h2>
                    <p>Our website may use cookies to enhance your browsing experience. Cookies help us understand user behavior and improve website functionality.</p>
                    <p>You can disable cookies in your browser settings if you prefer.</p>
                </div>

                <!-- 7. Data Protection -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">7</span>
                        Data Protection
                    </h2>
                    <p>We implement appropriate security measures to protect your personal information from unauthorized access, misuse, or disclosure.</p>
                    <p>However, no method of online transmission is 100% secure, and we cannot guarantee absolute security.</p>
                </div>

                <!-- 8. Changes to This Policy -->
                <div class="mb-10">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">8</span>
                        Changes to This Policy
                    </h2>
                    <p>MunchGud may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated date.</p>
                </div>

                <!-- 9. Contact Us -->
                <div class="mb-4">
                    <h2 class="text-2xl mb-4 text-mg-green flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 flex items-center justify-center text-sm">9</span>
                        Contact Us
                    </h2>
                    <p>If you have any questions regarding this Privacy Policy, please contact us:</p>
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
