<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MunchGud - Premium Flavored Makhana')</title>
    <meta name="description" content="@yield('meta_description', 'Discover MunchGud - Premium Indian D2C brand for flavored makhana and healthy snacks.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN as requested) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        munch: {
                            50: '#F5F8F6',
                            100: '#E6EFE8',
                            200: '#CDE0D2',
                            300: '#A3C6AB',
                            400: '#75A581',
                            500: '#52865F',
                            600: '#3D6A48',
                            700: '#32543B',
                            800: '#2A4331',
                            900: '#1B4332', /* Main Deep Green from prompt analysis */
                            950: '#11251A',
                            accent: '#D47F35', /* Earthy Orange */
                            cream: '#FAF7F0', /* Premium Background */
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background-color: #FAF7F0;
            color: #1A1A1A;
            -webkit-font-smoothing: antialiased;
        }
        [x-cloak] { display: none !important; }
        .glass-header {
            background: rgba(250, 247, 240, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(27, 67, 50, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased flex flex-col min-h-screen">

    <!-- Announcement Bar -->
    <div class="bg-munch-900 text-munch-cream text-sm font-medium py-2 px-4 text-center tracking-wide" x-data="{ show: true }" x-show="show">
        Free Shipping on all orders above ₹499! <a href="/products" class="underline ml-2 hover:text-munch-accent transition-colors">Shop Now</a>
    </div>

    <!-- Header -->
    <header class="glass-header sticky top-0 z-50 border-b border-munch-200/50 transition-all duration-300" x-data="{ mobileMenuOpen: false, searchOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-munch-900 p-2 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation (Left) -->
                <nav class="hidden lg:flex space-x-8 items-center">
                    <a href="{{ route('products.index') }}" class="text-munch-900 font-medium hover:text-munch-accent transition-colors">Shop All</a>
                    <a href="{{ route('build-a-box') }}" class="text-munch-900 font-medium hover:text-munch-accent transition-colors">Build a Box</a>
                    <a href="{{ route('about') }}" class="text-munch-900 font-medium hover:text-munch-accent transition-colors">Our Story</a>
                </nav>

                <!-- Logo (Center) -->
                <div class="flex-shrink-0 flex items-center justify-center absolute left-1/2 transform -translate-x-1/2">
                    <a href="{{ route('home') }}" class="block">
                        <img src="{{ \App\Models\Setting::get('company_logo') ? Storage::url(\App\Models\Setting::get('company_logo')) : asset('images/logo.jpg') }}" alt="MunchGud Logo" class="h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Icons (Right) -->
                <div class="flex items-center space-x-5 lg:space-x-6">
                    <button @click="searchOpen = !searchOpen" class="text-munch-900 hover:text-munch-accent transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                    
                    @auth
                        <a href="{{ route('account.index') }}" class="text-munch-900 hover:text-munch-accent transition-colors hidden sm:block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-munch-900 hover:text-munch-accent transition-colors hidden sm:block">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </a>
                    @endauth
                    
                    <a href="{{ route('cart.index') }}" class="text-munch-900 hover:text-munch-accent transition-colors relative flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span class="absolute -top-1.5 -right-2 bg-munch-accent text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">
                            {{ App\Models\CartItem::where(Auth::check() ? ['user_id' => Auth::id()] : ['session_id' => Session::getId()])->sum('quantity') ?: 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden absolute top-20 left-0 w-full bg-munch-cream border-b border-munch-200 premium-shadow">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('products.index') }}" class="block px-3 py-4 text-base font-medium text-munch-900 border-b border-munch-200">Shop All</a>
                <a href="{{ route('build-a-box') }}" class="block px-3 py-4 text-base font-medium text-munch-900 border-b border-munch-200">Build a Box</a>
                <a href="{{ route('about') }}" class="block px-3 py-4 text-base font-medium text-munch-900 border-b border-munch-200">Our Story</a>
                @auth
                    <a href="{{ route('account.index') }}" class="block px-3 py-4 text-base font-medium text-munch-900 border-b border-munch-200">My Account</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-4 text-base font-medium text-munch-900 border-b border-munch-200">Sign In</a>
                @endauth
            </div>
        </div>

        <!-- Search Overlay -->
        <div x-show="searchOpen" x-cloak x-transition class="absolute top-20 left-0 w-full bg-white border-b border-munch-200 premium-shadow py-6">
            <div class="max-w-3xl mx-auto px-4">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Search for makhana, flavors..." class="w-full border-0 border-b-2 border-munch-900 bg-transparent py-3 pl-10 pr-4 text-lg focus:ring-0 focus:border-munch-accent transition-colors" autofocus>
                    <svg class="w-6 h-6 text-munch-900 absolute left-0 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-4 mt-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-4 mt-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-munch-950 text-white pt-20 pb-10 border-t border-munch-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                
                <div class="space-y-6">
                    <img src="{{ \App\Models\Setting::get('company_logo') ? Storage::url(\App\Models\Setting::get('company_logo')) : asset('images/logo.jpg') }}" alt="MunchGud" class="h-16 bg-white p-2 rounded">
                    <p class="text-munch-300 font-light leading-relaxed">
                        Elevating the humble fox nut to a gourmet experience. Rooted in tradition, perfected for the modern palate.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-serif mb-6 text-munch-cream">Shop</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('products.index') }}" class="text-munch-300 hover:text-munch-accent transition-colors">All Products</a></li>
                        <li><a href="{{ route('build-a-box') }}" class="text-munch-300 hover:text-munch-accent transition-colors">Build a Box</a></li>
                        <li><a href="{{ route('products.index', ['category'=>'roasted-makhana']) }}" class="text-munch-300 hover:text-munch-accent transition-colors">Roasted Makhana</a></li>
                        <li><a href="{{ route('products.index', ['category'=>'gourmet']) }}" class="text-munch-300 hover:text-munch-accent transition-colors">Gourmet Range</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-serif mb-6 text-munch-cream">About Us</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="text-munch-300 hover:text-munch-accent transition-colors">Our Story</a></li>
                        <li><a href="{{ route('contact') }}" class="text-munch-300 hover:text-munch-accent transition-colors">Contact</a></li>
                        <li><a href="{{ route('faq') }}" class="text-munch-300 hover:text-munch-accent transition-colors">FAQ</a></li>
                        <li><a href="/blog" class="text-munch-300 hover:text-munch-accent transition-colors">Journal</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-serif mb-6 text-munch-cream">Newsletter</h3>
                    <p class="text-munch-300 font-light mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form class="flex">
                        <input type="email" placeholder="Enter your email" class="bg-munch-900 border border-munch-800 text-white px-4 py-2 w-full focus:outline-none focus:border-munch-accent">
                        <button type="submit" class="bg-munch-accent px-4 py-2 font-medium hover:bg-munch-cream hover:text-munch-900 transition-colors">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="border-t border-munch-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-munch-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} MunchGud. All rights reserved. · Developed by <a href="https://startupwebsupport.com/" target="_blank" class="hover:text-white transition-colors underline">StartupWebSupport</a>
                </p>
                <div class="flex space-x-6 text-sm text-munch-400">
                    <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="{{ route('refund') }}" class="hover:text-white transition-colors">Refund Policy</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
