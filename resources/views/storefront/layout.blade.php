<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MunchGud — Munch Gud. Feel Gud.')</title>
    <meta name="description"
        content="@yield('meta_description', 'Buy premium roasted makhana online from MunchGud. Enjoy healthy, crunchy fox nuts in delicious flavors, made from Bihar farms with high protein and gluten-free goodness.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'makhana, roasted makhana, healthy snacks, fox nuts, gluten-free snacks, high protein snacks')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'MunchGud — Munch Gud. Feel Gud.')">
    <meta property="og:description"
        content="@yield('meta_description', 'Buy premium roasted makhana online from MunchGud. Enjoy healthy, crunchy fox nuts in delicious flavors, made from Bihar farms with high protein and gluten-free goodness.')">
    <meta property="og:image" content="@yield('meta_image', asset('images/hero_bg.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'MunchGud — Munch Gud. Feel Gud.')">
    <meta property="twitter:description"
        content="@yield('meta_description', 'Buy premium roasted makhana online from MunchGud. Enjoy healthy, crunchy fox nuts in delicious flavors, made from Bihar farms with high protein and gluten-free goodness.')">
    <meta property="twitter:image" content="@yield('meta_image', asset('images/hero_bg.png'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Structured Data: Organization -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "MunchGud",
        "url": "https://munchgud.com",
        "logo": "{{ asset('images/logo.jpg') }}",
        "description": "Premium roasted makhana snacks. Direct from Bihar farms. High protein, gluten-free, irresistibly crunchy.",
        "sameAs": [
            "https://instagram.com/munchgud"
        ],
        "contactPoint": {
            "@@type": "ContactPoint",
            "contactType": "customer service",
            "url": "https://munchgud.com/contact"
        }
    }
    </script>
    @yield('structured_data')

    <!-- Favicon -->
    @if(!empty($global_settings['company_favicon']))
        <link rel="icon" href="{{ Storage::url($global_settings['company_favicon']) }}" sizes="any">
        <link rel="apple-touch-icon" href="{{ Storage::url($global_settings['company_favicon']) }}">
    @else
        <link rel="icon" href="/images/favicon.png" type="image/png" sizes="1024x1024">
        <link rel="apple-touch-icon" href="/images/favicon.png">
    @endif

    <!-- Google Fonts (Optimized & Deferred) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap">
    </noscript>

    @yield('head')

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <noscript>
        <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
    </noscript>

    <!-- Alpine.js Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @php
        $theme = \App\Models\Theme::where('is_active', true)->first();
    @endphp

    <style>
        :root {
            --primary:
                {{ $theme->primary_color ?? '#2B6E2F' }}
            ;
            --primary-dark:
                {{ $theme->primary_color ?? '#1B4332' }}
            ;
            --secondary:
                {{ $theme->secondary_color ?? '#E07B2A' }}
            ;
            --bg:
                {{ $theme->bg_color ?? '#FAFAF5' }}
            ;
            --text:
                {{ $theme->text_color ?? '#1A1A1A' }}
            ;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
        }

        [x-cloak] {
            display: none !important;
        }

        html {
            font-size: 16px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        /* ─── Scrollbar ─────────────────────────────── */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2B6E2F;
            border-radius: 99px;
        }

        .scrollbar-hide {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* ─── Marquee ───────────────────────────────── */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-track {
            animation: marquee 35s linear infinite;
            will-change: transform;
        }

        .marquee-track:hover {
            animation-play-state: paused;
        }

        /* ─── Scroll Reveal ─────────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: 0.1s;
        }

        .reveal-delay-2 {
            transition-delay: 0.2s;
        }

        .reveal-delay-3 {
            transition-delay: 0.3s;
        }

        .reveal-delay-4 {
            transition-delay: 0.4s;
        }

        /* ─── Float ─────────────────────────────────── */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-14px);
            }
        }

        .float {
            animation: float 5s ease-in-out infinite;
        }

        /* ─── Pulse Dot ─────────────────────────────── */
        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.85);
            }
        }

        .pulse-dot {
            animation: pulse-dot 2s ease-in-out infinite;
        }

        /* ─── Navbar & Search Overlay ────────────────── */
        #mainNav {
            transition: background 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        }

        #mainNav.scrolled {
            background: rgba(250, 250, 245, 0.96) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 2px 40px rgba(27, 67, 50, 0.09);
        }

        /* ─── Dropdown ───────────────────────────────── */
        [x-cloak] {
            display: none !important;
        }

        .dropdown-enter {
            animation: dropIn 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes dropIn {
            from {
                opacity: 0;
                transform: translateY(-8px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ─── Mobile Drawer ──────────────────────────── */
        .drawer-slide {
            transition: transform 0.38s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        }

        .drawer-overlay {
            transition: opacity 0.3s ease;
        }

        /* ─── Footer ─────────────────────────────────── */
        .footer-link {
            transition: color 0.2s, padding-left 0.2s;
        }

        .footer-link:hover {
            color: #66BB6A;
            padding-left: 4px;
        }

        /* ─── Grain texture ──────────────────────────── */
        .grain-overlay {
            position: relative;
        }

        .grain-overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
        }

        /* ─── Counter ────────────────────────────────── */
        .parallax-hero {
            transition: transform 0.1s linear;
            will-change: transform;
        }

        /* ─── Buttons ────────────────────────────────── */
        .btn-primary:not(.hidden) {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #2B6E2F;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 28px;
            border-radius: 999px;
            transition: background 0.25s ease, transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 20px rgba(43, 110, 47, 0.22);
        }

        .btn-primary:hover {
            background: #1B4332;
            transform: scale(1.03);
            box-shadow: 0 8px 28px rgba(43, 110, 47, 0.32);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: transparent;
            color: #1A1A1A;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.05em;
            padding: 11px 28px;
            border-radius: 999px;
            border: 1.5px solid rgba(27, 67, 50, 0.18);
            transition: border-color 0.25s, color 0.25s, background 0.25s;
        }

        .btn-outline:hover {
            border-color: #2B6E2F;
            color: #2B6E2F;
            background: rgba(43, 110, 47, 0.04);
        }

        /* ─── Glassmorphism card ─────────────────────── */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 4px 32px rgba(27, 67, 50, 0.08);
        }

        /* ─── Premium shadow ─────────────────────────── */
        .premium-shadow {
            box-shadow: 0 4px 40px rgba(27, 67, 50, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        /* ─── Toast ──────────────────────────────────── */
        @keyframes slideInToast {
            from {
                transform: translateX(110%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast-in {
            animation: slideInToast 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
    @yield('styles')
</head>

<body class="antialiased overflow-x-hidden">

    {{-- ══════════════════════════════════════════
    ANNOUNCEMENT BAR
    ══════════════════════════════════════════ --}}
    @php
        $defaultMarquee = "🌿 Free Shipping on orders above ₹999 — Pan India Delivery!\n✨ New customers get 10% off — Use code WELCOME10\n🔥 New Flavour Drop: Cheese & Herbs Makhana is LIVE!\n⭐ 5,000+ Happy Snackers — Join the MunchGud family today!";
        $marqueeMsgs = array_values(array_filter(array_map('trim', explode("\n", $global_settings['announcement_messages'] ?? $defaultMarquee))));
    @endphp
    <div class="bg-mg-green-dark text-white relative overflow-hidden"
        x-data="{ msgs: {{ json_encode($marqueeMsgs) }}, i: 0 }"
        x-init="setInterval(() => i = (i + 1) % msgs.length, 4000)">
        <div class="py-2.5 text-center text-[11.5px] sm:text-xs font-medium tracking-[0.06em] relative z-10 px-4">
            <template x-for="(m, idx) in msgs" :key="idx">
                <span x-show="i === idx" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300 absolute"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2" x-text="m" class="inline-block w-full"></span>
            </template>
        </div>
        <!-- Subtle shimmer strip -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent pointer-events-none">
        </div>
    </div>

    {{-- ══════════════════════════════════════════
    NAVBAR
    ══════════════════════════════════════════ --}}
    <header id="mainNav" class="sticky top-0 z-[999] bg-mg-cream border-b border-black/[0.04]" x-data="{ 
            mobileOpen: false, 
            shopOpen: false, 
            searchOpen: false,
            searchQuery: '',
            suggestions: [],
            loading: false,
            scrolled: false,
            fetchSuggestions() {
                if(this.searchQuery.length < 2) {
                    this.suggestions = [];
                    return;
                }
                this.loading = true;
                fetch('/search-suggestions?q=' + encodeURIComponent(this.searchQuery))
                    .then(res => res.json())
                    .then(data => {
                        this.suggestions = data;
                        this.loading = false;
                    });
            }
        }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50; if(scrolled) $el.classList.add('scrolled'); else $el.classList.remove('scrolled'); })">

        <!-- Search Overlay -->
        <div x-show="searchOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click.self="searchOpen = false"
            @keydown.escape.window="searchOpen = false"
            class="fixed inset-0 z-[1000] bg-black/50 backdrop-blur-sm flex items-start justify-center pt-24 px-4">
            <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl p-2 border border-black/5"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0" @click.away="searchOpen = false">
                <div class="flex items-center gap-3 px-4 py-3">
                    <svg class="w-5 h-5 text-mg-green flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" stroke-linecap="round" />
                    </svg>
                    <input x-model="searchQuery" @input.debounce.300ms="fetchSuggestions()" type="text"
                        placeholder="Search makhana flavours, combos…" autofocus
                        class="flex-1 text-base text-mg-dark placeholder-mg-muted outline-none font-medium bg-transparent"
                        @keydown.enter="if(searchQuery) window.location.href='/products?q='+encodeURIComponent(searchQuery)">
                    <button @click="searchOpen = false"
                        class="p-1.5 text-mg-muted hover:text-mg-dark rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <div class="px-4 pb-3 pt-1 border-t border-black/5">
                    <!-- Quick Links -->
                    <div x-show="!searchQuery" x-cloak>
                        <p class="text-xs text-mg-muted font-medium mb-2 uppercase tracking-wider">Quick Links</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Classic Salted', 'Cheese & Herbs', 'Himalayan Pink Salt', 'Combo Pack'] as $q)
                                <a href="/products?q={{ urlencode($q) }}" @click="searchOpen = false"
                                    class="text-xs bg-mg-green/5 text-mg-green border border-mg-green/10 rounded-full px-3 py-1.5 font-medium hover:bg-mg-green/10 transition">{{ $q }}</a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Suggestions List -->
                    <div x-show="searchQuery" x-cloak class="mt-2">
                        <p class="text-xs text-mg-muted font-medium mb-2 uppercase tracking-wider"
                            x-text="loading ? 'Searching...' : 'Suggestions'"></p>
                        <div class="space-y-1">
                            <template x-for="item in suggestions" :key="item.url">
                                <a :href="item.url"
                                    class="flex items-center gap-3 p-2 hover:bg-mg-cream rounded-xl transition">
                                    <img :src="item.image"
                                        class="w-10 h-10 rounded-lg object-cover bg-gray-50 border border-black/5">
                                    <span class="font-bold text-sm text-mg-dark" x-text="item.name"></span>
                                </a>
                            </template>
                            <div x-show="suggestions.length === 0 && !loading"
                                class="p-2 text-sm text-mg-muted font-medium">
                                No products found matching your search.
                            </div>
                        </div>
                        <a :href="'/products?q=' + encodeURIComponent(searchQuery)"
                            class="block mt-2 text-center text-xs font-bold text-mg-green hover:underline">View all
                            results &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex items-center justify-between h-[72px] lg:h-[84px] gap-3 lg:gap-8">

                <!-- Logo -->
                <a href="/" class="flex-shrink-0 group">
                    @if(!empty($global_settings['company_logo']))
                        <img src="{{ Storage::url($global_settings['company_logo']) }}"
                            alt="{{ $global_settings['company_name'] ?? 'MunchGud' }}"
                            class="h-10 lg:h-[56px] w-auto max-w-[130px] sm:max-w-none object-contain transition-transform duration-300 group-hover:scale-105 rounded-md">
                    @else
                        <img src="/images/logo.jpg" alt="MunchGud"
                            class="h-10 lg:h-[56px] w-auto max-w-[130px] sm:max-w-none object-contain transition-transform duration-300 group-hover:scale-105 rounded-md">
                    @endif
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2 flex-1 justify-center">
                    <!-- Home -->
                    <a href="/"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300 {{ request()->is('/') ? 'text-mg-green bg-mg-green/[0.04]' : '' }}">Home</a>

                    <!-- Shop Mega Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="flex items-center gap-1 px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300 select-none"
                            :class="open ? 'text-mg-green bg-mg-green/[0.06]' : ''">
                            Shop
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <!-- Mega Menu Dropdown -->
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-1/2 -translate-x-1/2 mt-4 w-[480px] bg-white/95 backdrop-blur-xl rounded-3xl shadow-dropdown border border-mg-green/10 overflow-hidden z-50 premium-shadow">

                            <div class="grid grid-cols-2 p-4 gap-4">
                                <!-- Left Column: Catalog & Categories -->
                                <div class="border-r border-mg-green/5 pr-4 text-left">
                                    <!-- All Products Link -->
                                    <a href="{{ route('products.index') }}"
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-2xl hover:bg-mg-green/8 transition-colors group mb-2">
                                        <div
                                            class="w-9 h-9 bg-mg-green/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-mg-green/20 group-hover:scale-110 transition-all">
                                            <svg class="w-4 h-4 text-mg-green" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"
                                                    stroke-linecap="round" />
                                                <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"
                                                    stroke-linecap="round" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[14px] font-bold text-mg-dark group-hover:text-mg-green transition">
                                                All Products</p>
                                            <p class="text-[10px] text-mg-muted leading-none mt-0.5">Explore full range
                                            </p>
                                        </div>
                                    </a>

                                    @if(isset($global_categories) && $global_categories->count() > 0)
                                        <div class="pt-2 mt-1">
                                            <p
                                                class="px-3 py-1.5 text-[10px] font-black text-mg-muted uppercase tracking-widest">
                                                Categories</p>
                                            @foreach($global_categories as $cat)
                                                <a href="{{ route('products.category', $cat->slug) }}"
                                                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-mg-green/5 hover:text-mg-green text-[13.5px] font-bold text-mg-dark/85 transition-all group">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-mg-green/30 group-hover:bg-mg-green transition-all group-hover:scale-125"></span>
                                                    {{ $cat->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Right Column: Popular Flavours & Custom Box -->
                                <div class="pl-2 text-left">
                                    <p
                                        class="px-3 py-1.5 text-[10px] font-black text-mg-muted uppercase tracking-widest">
                                        Featured Flavours</p>
                                    <div class="space-y-1">
                                        <!-- Cream & Onion Link -->
                                        <a href="{{ route('cream-and-onion') }}"
                                            class="flex items-center gap-3 px-3 py-2.5 rounded-2xl hover:bg-mg-green/5 hover:text-mg-green transition group">
                                            <div
                                                class="w-8 h-8 bg-mg-green/10 rounded-xl flex items-center justify-center flex-shrink-0 text-base">
                                                🧅</div>
                                            <div>
                                                <p
                                                    class="text-[13.5px] font-bold text-mg-dark group-hover:text-mg-green">
                                                    Cream & Onion</p>
                                                <p class="text-[9.5px] text-mg-muted leading-none mt-0.5">Rich &
                                                    comforting</p>
                                            </div>
                                        </a>

                                        <!-- Peri Peri Link -->
                                        <a href="{{ route('peri-peri') }}"
                                            class="flex items-center gap-3 px-3 py-2.5 rounded-2xl hover:bg-mg-orange/5 hover:text-mg-orange transition group">
                                            <div
                                                class="w-8 h-8 bg-mg-orange/10 rounded-xl flex items-center justify-center flex-shrink-0 text-base">
                                                🌶️</div>
                                            <div>
                                                <p
                                                    class="text-[13.5px] font-bold text-mg-dark group-hover:text-mg-orange">
                                                    Spicy Peri Peri</p>
                                                <p class="text-[9.5px] text-mg-muted leading-none mt-0.5">Fiery & bold
                                                    taste</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="border-t border-mg-green/5 pt-3 mt-3">
                                        <a href="{{ route('build-a-box') }}"
                                            class="flex items-center gap-3 px-3 py-2.5 rounded-2xl hover:bg-mg-orange/8 transition-colors group">
                                            <div
                                                class="w-9 h-9 bg-mg-orange/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-mg-orange/20 group-hover:scale-110 transition-all">
                                                <svg class="w-4 h-4 text-mg-orange" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path
                                                        d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                                    <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-[13.5px] font-bold text-mg-dark group-hover:text-mg-orange transition">
                                                    Build a Box</p>
                                                <p class="text-[9.5px] text-mg-muted leading-none mt-0.5">Customize your
                                                    mix</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('story') }}"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300">Our
                        Story</a>
                    <a href="{{ route('blogs.index') }}"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300">Blog</a>
                    <!-- <a href="{{ route('health') }}"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300">Health</a> -->
                    <a href="{{ route('recipes') }}"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300">Recipes</a>
                    <a href="{{ route('contact') }}"
                        class="px-2 xl:px-3 2xl:px-5 py-2 text-[14px] xl:text-[15.5px] whitespace-nowrap font-bold tracking-wide text-mg-dark/80 hover:text-mg-green hover:bg-mg-green/[0.06] rounded-2xl transition-all duration-300">Contact</a>
                </nav>

                <!-- Right Side Actions -->
                <div class="flex items-center gap-0.5 sm:gap-1 ml-auto">
                    <!-- Search Button -->
                    <button @click="searchOpen = true" aria-label="Search"
                        class="p-2.5 rounded-xl text-mg-dark/55 hover:text-mg-green hover:bg-mg-green/[0.06] transition-all duration-200">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" stroke-linecap="round" />
                        </svg>
                    </button>

                    <!-- Wishlist (hidden on small mobile) -->
                    <a href="{{ route('account.wishlist') }}" aria-label="Wishlist"
                        class="hidden sm:flex p-2.5 rounded-xl text-mg-dark/55 hover:text-mg-green hover:bg-mg-green/[0.06] transition-all duration-200 relative"
                        x-data="{ count: {{ auth()->check() ? auth()->user()->wishlists()->count() : 0 }} }"
                        @wishlist-updated.window="count = $event.detail.count">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span x-show="count > 0" x-text="count" x-cloak
                            class="absolute top-1 right-1 w-[18px] h-[18px] bg-mg-orange text-white text-[9px] font-black rounded-full flex items-center justify-center leading-none shadow-sm transition-all"
                            x-transition:enter="transition scale-0" x-transition:enter-start="scale-0"
                            x-transition:enter-end="scale-100" x-transition:leave="transition scale-100"
                            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"></span>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" aria-label="Cart"
                        class="p-2.5 rounded-xl text-mg-dark/55 hover:text-mg-green hover:bg-mg-green/[0.06] transition-all duration-200 relative"
                        x-data="{ count: {{ $cart_count ?? 0 }} }" @cart-updated.window="count = $event.detail.count">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <path d="M16 10a4 4 0 01-8 0" stroke-linecap="round" />
                        </svg>

                        <span x-show="count > 0" x-text="count" x-cloak
                            class="absolute top-1 right-1 w-[18px] h-[18px] bg-mg-orange text-white text-[9px] font-black rounded-full flex items-center justify-center leading-none shadow-sm transition-all"
                            x-transition:enter="transition scale-0" x-transition:enter-start="scale-0"
                            x-transition:enter-end="scale-100" x-transition:leave="transition scale-100"
                            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"></span>
                    </a>

                    <!-- Account / Login (hidden on small mobile) -->
                    @auth
                        <div class="relative hidden sm:block" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open"
                                class="flex items-center gap-1.5 p-1.5 pr-3 rounded-full hover:bg-mg-green/[0.06] border border-transparent hover:border-mg-green/10 transition-all duration-200">
                                <div
                                    class="w-7 h-7 rounded-full bg-mg-green text-white flex items-center justify-center font-bold text-[11px] uppercase shadow-inner">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span
                                    class="text-[13px] font-bold text-mg-dark truncate max-w-[80px]">{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <svg class="w-3 h-3 text-mg-muted transition-transform duration-200"
                                    :class="{'rotate-180': open}" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak x-transition
                                class="absolute right-0 mt-2 w-48 bg-white border border-mg-dark/5 shadow-xl shadow-mg-dark/5 rounded-2xl py-2 z-50 premium-shadow">
                                <a href="{{ route('account.index') }}"
                                    class="block px-4 py-2.5 text-[13px] text-mg-dark hover:bg-mg-green/5 hover:text-mg-green font-bold transition">My
                                    Account</a>
                                <a href="{{ route('account.orders') }}"
                                    class="block px-4 py-2.5 text-[13px] text-mg-dark hover:bg-mg-green/5 hover:text-mg-green font-bold transition">Orders</a>
                                <form action="{{ route('logout') }}" method="POST"
                                    class="border-t border-mg-dark/5 mt-1 pt-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-[13px] text-red-500 hover:bg-red-50 font-bold transition">Sign
                                        Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden sm:flex items-center gap-1.5 px-4 py-2 rounded-xl text-[13px] font-bold text-mg-dark bg-mg-green/5 hover:bg-mg-green hover:text-white transition-all duration-200 ml-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Log In
                        </a>
                    @endauth

                    <!-- Shop CTA Button (desktop) -->
                    <a href="{{ route('products.index') }}"
                        class="hidden lg:inline-flex btn-primary text-xs ml-2 py-2.5 px-5">
                        Shop Now
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                    <!-- Hamburger (Mobile) -->
                    <button @click="mobileOpen = true" aria-label="Open menu"
                        class="lg:hidden p-2.5 rounded-xl text-mg-dark/70 hover:bg-mg-green/[0.06] transition ml-1">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h10" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- ═══ Mobile Drawer Overlay ═══ -->
        <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-[1001] lg:hidden"
            @keydown.escape.window="mobileOpen = false">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm drawer-overlay" x-show="mobileOpen"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="mobileOpen = false">
            </div>

            <!-- Dropdown Panel -->
            <div class="absolute top-0 left-0 right-0 w-full max-h-[85vh] bg-white shadow-2xl flex flex-col rounded-b-3xl overflow-hidden"
                x-show="mobileOpen" x-transition:enter="transition ease-out duration-350"
                x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-250" x-transition:leave-start="translate-y-0"
                x-transition:leave-end="-translate-y-full" style="transform-origin: top;">

                <!-- Drawer Header -->
                <div
                    class="flex items-center justify-between px-5 py-4 border-b border-black/[0.06] bg-mg-cream shrink-0">
                    <a href="/" @click="mobileOpen = false">
                        @if(!empty($global_settings['company_logo']))
                            <img src="{{ Storage::url($global_settings['company_logo']) }}"
                                alt="{{ $global_settings['company_name'] ?? 'MunchGud' }}"
                                class="h-9 w-auto object-contain rounded">
                        @else
                            <img src="/images/logo.jpg" alt="MunchGud" class="h-9 w-auto object-contain rounded">
                        @endif
                    </a>
                    <button @click="mobileOpen = false"
                        class="p-2 rounded-xl hover:bg-black/5 transition text-mg-dark/60">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Drawer Navigation -->
                <div class="flex-1 overflow-y-auto py-4 px-3">
                    <a href="/" @click="mobileOpen=false"
                        class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-dark font-semibold text-[14.5px] transition {{ request()->is('/') ? 'bg-mg-green/[0.06] text-mg-green' : '' }}">
                        <svg class="w-[18px] h-[18px] text-mg-green/70" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>

                    <!-- Shop Accordion -->
                    <div x-data="{ shopOpen: false }">
                        <button @click="shopOpen = !shopOpen"
                            class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-dark font-semibold text-[14.5px] transition">
                            <span class="flex items-center gap-3">
                                <svg class="w-[18px] h-[18px] text-mg-green/70" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Shop
                            </span>
                            <svg class="w-4 h-4 text-mg-muted transition-transform duration-250"
                                :class="shopOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div x-show="shopOpen" x-collapse x-cloak
                            class="ml-4 pl-4 border-l-2 border-mg-green/15 mt-1 mb-2 space-y-0.5">
                            <a href="{{ route('products.index') }}" @click="mobileOpen=false"
                                class="block py-2.5 px-3 text-sm text-mg-dark/70 font-medium hover:text-mg-green rounded-lg hover:bg-mg-green/[0.04] transition">All
                                Products</a>
                            @if(isset($global_categories))
                                @foreach($global_categories as $cat)
                                    <a href="{{ route('products.category', $cat->slug) }}" @click="mobileOpen=false"
                                        class="block py-2.5 px-3 text-sm text-mg-dark/70 font-medium hover:text-mg-green rounded-lg hover:bg-mg-green/[0.04] transition">{{ $cat->name }}</a>
                                @endforeach
                            @endif
                            <a href="{{ route('build-a-box') }}" @click="mobileOpen=false"
                                class="flex items-center gap-2 py-2.5 px-3 text-sm font-semibold text-mg-orange hover:bg-mg-orange/5 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                    <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                                </svg>
                                Build a Box
                            </a>
                        </div>
                    </div>

                    @foreach([['Our Story', route('story')], ['Blog', route('blogs.index')], ['Cream & Onion', route('cream-and-onion')], ['Peri Peri', route('peri-peri')], ['Recipes', route('recipes')], ['Reviews', route('reviews')], ['Contact Us', route('contact')]] as [$label, $href])
                        <a href="{{ $href }}" @click="mobileOpen=false"
                            class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-dark font-semibold text-[14.5px] transition">
                            {{ $label }}
                        </a>
                    @endforeach

                    <div class="border-t border-black/[0.05] mt-3 pt-3">
                        @auth
                            <a href="{{ route('account.index') }}" @click="mobileOpen=false"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-dark font-semibold text-[14.5px] transition">
                                <svg class="w-[18px] h-[18px] text-mg-green/70" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                My Account
                            </a>
                            <a href="{{ route('account.orders') }}" @click="mobileOpen=false"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-dark font-semibold text-[14.5px] transition">
                                <svg class="w-[18px] h-[18px] text-mg-green/70" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Track Order
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-red-50 text-red-500 font-semibold text-[14.5px] transition">
                                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" @click="mobileOpen=false"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-mg-green/[0.05] text-mg-green font-bold text-[14.5px] transition bg-mg-green/5">
                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                Log In / Register
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Drawer Footer CTA -->
                <div class="p-4 border-t border-black/[0.06] bg-mg-cream shrink-0">
                    <a href="{{ route('products.index') }}" @click="mobileOpen=false"
                        class="btn-primary w-full text-sm py-3.5">
                        Shop Now — From ₹199
                    </a>
                    <p class="text-center text-[11px] text-mg-muted mt-2">
                        {{ $global_settings['free_shipping_text'] ?? 'Free shipping above ₹999 ✦ Pan India' }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    {{-- ══════════════════════════════════════════
    PAGE CONTENT
    ══════════════════════════════════════════ --}}
    <main id="main-content">
        @yield('content')
    </main>

{{-- ══════════════════════════════════════════
     TRUST STRIP (before footer)
     ══════════════════════════════════════════ --}}
<!-- <div class="bg-munch-900 py-10">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
            @foreach([
                ['icon' => 'M20 12V22H4V12M22 7H2v5h20V7zM12 22V7M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z', 'label' => 'Free Gift Wrapping', 'sub' => 'On every order'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'label' => '100% Secure Payment', 'sub' => 'Razorpay encrypted'],
                ['icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'label' => 'Easy Returns', 'sub' => '7-day hassle-free'],
                ['icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4', 'label' => 'Pan India Delivery', 'sub' => '2-7 business days'],
            ] as $trust)
            <div class="flex items-start sm:items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-white/[0.07] border border-white/[0.08] flex items-center justify-center flex-shrink-0 mt-1 sm:mt-0">
                    <svg class="w-5 h-5 text-mg-leaf" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $trust['icon'] }}"/></svg>
                </div>
                <div>
                    <p class="text-white text-[14px] sm:text-[13px] font-semibold leading-tight">{{ $trust['label'] }}</p>
                    <p class="text-white/50 text-[12px] sm:text-[11px] mt-0.5">{{ $trust['sub'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> -->

    {{-- ══════════════════════════════════════════
    FOOTER
    ══════════════════════════════════════════ --}}
    <footer class="bg-[#0F1F16] text-white/60 relative overflow-hidden">
        <!-- Decorative background -->
        <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
            style="background-image: radial-gradient(circle at 20% 80%, #2B6E2F 0%, transparent 50%), radial-gradient(circle at 80% 20%, #E07B2A 0%, transparent 40%);">
        </div>

        <!-- Newsletter Band -->
        <!-- <div class="border-b border-white/[0.06]">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-10">
            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 justify-between">
                <div>
                    <h3 class="text-white font-serif text-2xl lg:text-xl font-bold">Get 10% off your first order</h3>
                    <p class="text-white/50 text-[15px] sm:text-sm mt-1 lg:max-w-md">Join 5,000+ health-conscious snackers on our mailing list.</p>
                </div>
                <form class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto lg:max-w-md" onsubmit="return false;">
                    <input type="email" placeholder="Enter your email address" class="flex-1 bg-white/[0.07] border border-white/[0.10] rounded-xl sm:rounded-full px-5 py-3.5 sm:py-3 text-[15px] sm:text-sm text-white placeholder-white/40 focus:outline-none focus:border-mg-leaf transition">
                    <button type="submit" class="btn-primary text-[15px] sm:text-sm font-bold tracking-wide whitespace-nowrap py-3.5 sm:py-3 px-6 rounded-xl sm:rounded-full flex-shrink-0 w-full sm:w-auto">Subscribe</button>
                </form>
            </div>
        </div>
    </div> -->

        <!-- Footer Main Grid -->
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-10 lg:gap-8">

                <!-- Brand Column -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-2">
                    <a href="/">
                        @if(!empty($global_settings['company_logo']))
                            <img src="{{ Storage::url($global_settings['company_logo']) }}"
                                alt="{{ $global_settings['company_name'] ?? 'MunchGud' }}"
                                class="h-11 w-auto object-contain rounded-md mb-5 brightness-125">
                        @else
                            <img src="/images/logo.jpg" alt="MunchGud"
                                class="h-11 w-auto object-contain rounded-md mb-5 brightness-125">
                        @endif
                    </a>
                    <p class="text-white/35 text-sm leading-relaxed max-w-[240px] mb-6">
                        {{ $global_settings['company_name'] ?? 'MunchGud Enterprises' }}<br>
                        {{ $global_settings['company_address_1'] ?? 'Premium roasted makhana snacks, sourced directly from Bihar\'s finest farms.' }}<br>
                        @if(!empty($global_settings['company_city'])) {{ $global_settings['company_city'] }}, @endif
                        @if(!empty($global_settings['company_state'])) {{ $global_settings['company_state'] }} @endif
                        @if(!empty($global_settings['company_pincode'])) {{ $global_settings['company_pincode'] }}
                        @endif
                    </p>

                    <!-- Social Links with actual SVGs -->
                    <div class="flex gap-2.5">
                        @if(!empty($global_settings['social_instagram']))
                            <a href="{{ $global_settings['social_instagram'] }}" target="_blank" aria-label="Instagram"
                                class="w-9 h-9 rounded-xl bg-white/[0.06] border border-white/[0.07] flex items-center justify-center text-white/40 hover:bg-[#E1306C] hover:text-white hover:border-transparent transition-all duration-200">
                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($global_settings['social_facebook']))
                            <a href="{{ $global_settings['social_facebook'] }}" target="_blank" aria-label="Facebook"
                                class="w-9 h-9 rounded-xl bg-white/[0.06] border border-white/[0.07] flex items-center justify-center text-white/40 hover:bg-[#1877F2] hover:text-white hover:border-transparent transition-all duration-200">
                                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($global_settings['social_twitter']))
                            <a href="{{ $global_settings['social_twitter'] }}" target="_blank" aria-label="X (Twitter)"
                                class="w-9 h-9 rounded-xl bg-white/[0.06] border border-white/[0.07] flex items-center justify-center text-white/40 hover:bg-black hover:text-white hover:border-transparent transition-all duration-200">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($global_settings['social_youtube']))
                            <a href="{{ $global_settings['social_youtube'] }}" target="_blank" aria-label="YouTube"
                                class="w-9 h-9 rounded-xl bg-white/[0.06] border border-white/[0.07] flex items-center justify-center text-white/40 hover:bg-[#FF0000] hover:text-white hover:border-transparent transition-all duration-200">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($global_settings['social_reels']))
                            <a href="{{ $global_settings['social_reels'] }}" target="_blank" aria-label="Reels"
                                class="w-9 h-9 rounded-xl bg-white/[0.06] border border-white/[0.07] flex items-center justify-center text-white/40 hover:bg-[#E1306C] hover:text-white hover:border-transparent transition-all duration-200">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H4zm1 2h3.5l-2 3H3V6a1 1 0 0 1 1-1zm6 0h3.5l-2 3H8L11 5zm6 0h3l1 1v2h-2.5l-1.5-3zm1 5h-12v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-8zm-8 1.5v5l4-2.5-4-2.5z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Shop Column -->
                <div>
                    <h5 class="text-white text-[11px] font-bold uppercase tracking-[0.12em] mb-5">Shop</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('products.index') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">All
                                Products</a></li>
                        <li><a href="{{ route('products.index') }}?sort=bestsellers"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Bestsellers</a>
                        </li>
                        <li><a href="{{ route('products.index') }}?sort=new"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">New
                                Arrivals</a></li>
                        <li><a href="{{ route('build-a-box') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Build a
                                Box</a></li>
                        @if(isset($global_categories))
                            @foreach($global_categories->take(3) as $cat)
                                <li><a href="{{ route('products.category', $cat->slug) }}"
                                        class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company Column -->
                <div>
                    <h5 class="text-white text-[11px] font-bold uppercase tracking-[0.12em] mb-5">Company</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('story') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Our Story</a>
                        </li>
                        <li><a href="{{ route('blogs.index') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Blog</a></li>
                        <li><a href="{{ route('cream-and-onion') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Cream &
                                Onion</a></li>
                        <li><a href="{{ route('peri-peri') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Peri Peri</a>
                        </li>
                        <li><a href="{{ route('health') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Health
                                Benefits</a></li>
                        <li><a href="{{ route('recipes') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Recipes</a>
                        </li>
                        <li><a href="{{ route('reviews') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Reviews</a>
                        </li>
                        <li><a href="{{ route('about') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">About Us</a>
                        </li>
                    </ul>
                </div>

                <!-- Help Column -->
                <div>
                    <h5 class="text-white text-[11px] font-bold uppercase tracking-[0.12em] mb-5">Help</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('faq') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">FAQ</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Contact Us</a>
                        </li>
                        <li><a href="{{ route('account.orders') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Track
                                Order</a></li>
                        <li><a href="{{ route('shipping') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Shipping
                                Policy</a></li>
                        <li><a href="{{ route('refund') }}"
                                class="footer-link text-sm text-white/40 hover:text-mg-leaf inline-block">Returns &
                                Refunds</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h5 class="text-white text-[11px] font-bold uppercase tracking-[0.12em] mb-5">Reach Us</h5>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-mg-leaf mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $global_settings['store_email'] ?? 'support@munchgud.com' }}"
                                class="text-sm text-white/40 hover:text-mg-leaf transition">{{
                                $global_settings['store_email'] ?? 'support@munchgud.com' }}</a>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-mg-leaf mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span
                                class="text-sm text-white/35 leading-snug">{{ $global_settings['company_city'] ?? 'Darbhanga' }},
                                {{ $global_settings['company_state'] ?? 'Bihar' }}<br>India —
                                {{ $global_settings['company_pincode'] ?? '846 004' }}</span>
                        </li>
                        <li>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $global_settings['store_phone'] ?? '919999999999') }}"
                                target="_blank" rel="noopener"
                                class="inline-flex items-center gap-2 text-xs font-semibold bg-[#25D366]/10 text-[#25D366] border border-[#25D366]/20 rounded-full px-3.5 py-2 hover:bg-[#25D366]/20 transition">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                WhatsApp Chat
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="border-t border-white/[0.05]">
            <div
                class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-6 pb-24 sm:pb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[11.5px] text-white/25 text-center sm:text-left">
                    © {{ date('Y') }} MunchGud Foods Pvt. Ltd.™ · All rights reserved · Made with ❤️ in Bihar, India · Developed by <a href="https://startupwebsupport.com/" target="_blank" class="hover:text-white/60 transition underline">StartupWebSupport</a>
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mt-4 sm:mt-0">
                    <a href="{{ route('privacy') }}"
                        class="text-[11.5px] text-white/30 hover:text-white/60 transition">Privacy</a>
                    <span class="text-white/15 hidden sm:inline">·</span>
                    <a href="{{ route('terms') }}"
                        class="text-[11.5px] text-white/30 hover:text-white/60 transition">Terms</a>
                    <span class="text-white/15 hidden sm:inline">·</span>
                    <div
                        class="flex flex-wrap items-center justify-center gap-1.5 w-full sm:w-auto sm:pl-2 mt-2 sm:mt-0">
                        <span
                            class="text-[10px] text-white/20 uppercase tracking-wider w-full sm:w-auto text-center sm:text-left mb-1 sm:mb-0">We
                            accept</span>
                        @foreach(['UPI', 'Visa', 'MC', 'COD', 'GPay'] as $pay)
                            <span
                                class="bg-white/[0.06] border border-white/[0.07] text-white/30 text-[9.5px] font-bold px-2 py-0.5 rounded-md tracking-wider">{{ $pay }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ═══ Floating WhatsApp Button ═══ -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $global_settings['store_phone'] ?? '919999999999') }}"
        target="_blank" rel="noopener"
        class="fixed bottom-6 right-6 z-[9999] w-[52px] h-[52px] bg-[#25D366] rounded-full flex items-center justify-center shadow-xl shadow-[#25D366]/30 hover:scale-110 hover:shadow-2xl hover:shadow-[#25D366]/40 active:scale-95 transition-all duration-300 group"
        aria-label="Chat on WhatsApp">
        <svg width="26" height="26" fill="#fff" viewBox="0 0 24 24">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
        <!-- Pulse ring -->
        <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-20"></span>
    </a>

    <!-- ═══ Back to Top ═══ -->
    <button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-24 right-6 z-[9998] w-11 h-11 bg-munch-900/85 backdrop-blur-sm text-white rounded-full flex items-center justify-center shadow-lg hover:bg-mg-green hover:scale-110 active:scale-95 transition-all duration-300 opacity-0 pointer-events-none"
        aria-label="Back to top" style="transform: translateY(16px);">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <!-- ═══ Global Toast Notification ═══ -->
    <div x-data="{ show: false, message: '', icon: '' }"
        @toast.window="show = true; message = $event.detail.message; icon = $event.detail.icon || 'success'; setTimeout(() => show = false, 3500)"
        class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[10000] flex items-center gap-3 px-5 py-3.5 bg-mg-dark/95 backdrop-blur text-white rounded-full transition-all duration-400 pointer-events-none"
        :class="show ? 'translate-y-0 opacity-100 scale-100' : 'translate-y-12 opacity-0 scale-95'"
        style="box-shadow: 0 10px 40px rgba(0,0,0,0.25);">
        <span x-show="icon === 'success'"
            class="w-6 h-6 rounded-full bg-mg-green flex items-center justify-center shrink-0">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <span x-show="icon === 'removed'"
            class="w-6 h-6 rounded-full bg-mg-muted/50 flex items-center justify-center shrink-0">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <p class="font-bold text-sm tracking-wide" x-text="message"></p>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => window.dispatchEvent(new CustomEvent('toast', { detail: { message: "{{ addslashes(session('success')) }}", icon: 'success' } })), 100);
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => window.dispatchEvent(new CustomEvent('toast', { detail: { message: "{{ addslashes(session('error')) }}", icon: 'removed' } })), 100);
            });
        </script>
    @endif
    @if($errors->any())
        <script>
            document.addEventListener('alpine:init', () => {
                setTimeout(() => window.dispatchEvent(new CustomEvent('toast', { detail: { message: "{{ addslashes($errors->first()) }}", icon: 'removed' } })), 100);
            });
        </script>
    @endif

    <script>
        window.addToCart = async function (skuId, qty = 1, btn = null) {
            if (!skuId || skuId === 0) {
                window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Product is currently unavailable', icon: 'removed' } }));
                return;
            }
            const originalText = btn ? btn.innerHTML : '';
            if (btn) {
                btn.classList.add('opacity-75', 'pointer-events-none');
                btn.innerHTML = '<svg class="w-5 h-5 animate-spin mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            }
            try {
                const res = await fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ sku_id: skuId, qty: qty })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.summary.items_count } }));
                    window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Added to Cart', icon: 'success' } }));
                } else {
                    let msg = data.message || 'Could not add to cart';
                    if (data.errors) msg = Object.values(data.errors)[0][0];
                    window.dispatchEvent(new CustomEvent('toast', { detail: { message: msg, icon: 'removed' } }));
                }
            } catch (e) {
                console.error(e);
                window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'An error occurred', icon: 'removed' } }));
            } finally {
                if (btn) {
                    btn.classList.remove('opacity-75', 'pointer-events-none');
                    btn.innerHTML = originalText;
                }
            }
        }

        // ─── Scroll Reveal ────────────────────────────
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
        }, { threshold: 0.07, rootMargin: '0px 0px -30px 0px' });
        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

        // ─── Counter Animation ────────────────────────
        function animateCounter(el) {
            const t = parseInt(el.dataset.target), s = el.dataset.suffix || '', p = el.dataset.prefix || '';
            const dur = 2000, start = performance.now();
            function update(now) {
                const prog = Math.min((now - start) / dur, 1);
                const eased = 1 - Math.pow(1 - prog, 3);
                el.textContent = p + Math.floor(t * eased).toLocaleString() + s;
                if (prog < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
        }
        const cObs = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { animateCounter(e.target); cObs.unobserve(e.target); } });
        }, { threshold: 0.5 });
        document.querySelectorAll('.counter-num').forEach(el => cObs.observe(el));

        // ─── Back to Top Button ───────────────────────
        const backToTopBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.style.opacity = '1';
                backToTopBtn.style.transform = 'translateY(0)';
                backToTopBtn.style.pointerEvents = 'auto';
            } else {
                backToTopBtn.style.opacity = '0';
                backToTopBtn.style.transform = 'translateY(16px)';
                backToTopBtn.style.pointerEvents = 'none';
            }
        }, { passive: true });

        // ─── Parallax Hero ────────────────────────────
        window.addEventListener('scroll', () => {
            const el = document.querySelector('.parallax-hero');
            if (el) el.style.transform = `translateY(${window.scrollY * 0.10}px)`;
        }, { passive: true });
    </script>
    @yield('scripts')
</body>

</html>