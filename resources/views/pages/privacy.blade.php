@extends('storefront.layout')

@section('title', 'Privacy Policy - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Legal & Security</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Privacy Policy</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#intro" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Introduction</a>
                <a href="#info-collect" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Information We Collect</a>
                <a href="#info-use" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. How We Use Information</a>
                <a href="#info-share" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Sharing Your Data</a>
                <a href="#cookies" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Cookies & Tracking</a>
                <a href="#security" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">6. Security & Storage</a>
                <a href="#your-rights" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">7. Your Rights & Choices</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                
                <section id="intro" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">1. Introduction</h2>
                    <p class="mb-4">Welcome to MunchGud. We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us at support@munchgud.com.</p>
                    <p>When you visit our website and use our services, you trust us with your personal information. We take your privacy very seriously. In this privacy notice, we seek to explain to you in the clearest way possible what information we collect, how we use it and what rights you have in relation to it.</p>
                </section>

                <hr class="border-munch-100">

                <section id="info-collect" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">2. Information We Collect</h2>
                    <p class="mb-4">We collect personal information that you voluntarily provide to us when registering or logging in (via OTP), placing orders, or subscribing to our newsletters. The personal information that we collect includes:</p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li><strong>Contact details:</strong> Mobile number, email address, shipping and billing addresses.</li>
                        <li><strong>Order data:</strong> Products ordered, billing transaction history, and support tickets.</li>
                        <li><strong>Credentials:</strong> Passwordless login parameters and cached OTP states.</li>
                    </ul>
                    <p>We do not store credit card or payment information. All transaction routing is processed securely by Razorpay or Google Pay API interfaces directly, ensuring your financial data is fully encrypted.</p>
                </section>

                <hr class="border-munch-100">

                <section id="info-use" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">3. How We Use Information</h2>
                    <p class="mb-4">We use personal information collected via our Site for a variety of business purposes described below:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>To facilitate account creation and logon processes.</li>
                        <li>To fulfill and manage your orders, payments, returns, and exchanges.</li>
                        <li>To deliver the products to your designated addresses via our integrated logistics partners (e.g. Shiprocket).</li>
                        <li>To send product updates, custom discounts, and marketing communications (you can opt-out at any time).</li>
                        <li>To respond to user support tickets and resolve product inquiries.</li>
                    </ul>
                </section>

                <hr class="border-munch-100">

                <section id="info-share" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">4. Sharing Your Data</h2>
                    <p class="mb-4">We only share information with your consent, to comply with laws, to provide you with services, to protect your rights, or to fulfill business obligations. Specifically, we share data with the following categories of partners:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong>Payment Gateways:</strong> Razorpay for processing online payments.</li>
                        <li><strong>Logistics Providers:</strong> Shiprocket and associated courier partners for package routing.</li>
                        <li><strong>Communications:</strong> SMS & Email dispatch systems to deliver OTP and tracking alerts.</li>
                    </ul>
                </section>

                <hr class="border-munch-100">

                <section id="cookies" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">5. Cookies & Tracking</h2>
                    <p class="mb-4">We use cookies and similar tracking technologies (like Google Analytics) to access or store information. Cookies help us analyze user traffic patterns, keep items stored securely in your shopping cart across sessions, and save your preferred portal settings.</p>
                    <p>You can choose to disable cookies through your browser settings; however, please note that doing so may prevent certain interactive features of the storefront from operating correctly (e.g., persistent cart lists).</p>
                </section>

                <hr class="border-munch-100">

                <section id="security" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">6. Security & Storage</h2>
                    <p class="mb-4">We have implemented appropriate technical and organizational security measures designed to protect the security of any personal information we process. All server communications run strictly over secure HTTPS protocols, and sensitive tables are heavily shielded.</p>
                    <p>However, please also remember that we cannot guarantee that the internet itself is 100% secure. Although we will do our best to protect your personal information, transmission of personal information to and from our Site is at your own risk. You should only access the services within a secure environment.</p>
                </section>

                <hr class="border-munch-100">

                <section id="your-rights" class="scroll-mt-28">
                    <h2 class="text-2xl font-serif text-munch-900 font-bold mb-4">7. Your Rights & Choices</h2>
                    <p class="mb-4">In some regions, you have certain rights under applicable data protection laws. These may include the right:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>To request access and obtain a copy of your personal information.</li>
                        <li>To request rectification or erasure of your personal records.</li>
                        <li>To object to or restrict processing of your active data.</li>
                    </ul>
                    <p>To make such a request, please contact our support desk directly at support@munchgud.com. We will consider and act upon any request in accordance with applicable laws.</p>
                </section>

            </article>
        </div>
    </div>
</div>
@endsection
