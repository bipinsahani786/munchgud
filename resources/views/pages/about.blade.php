@extends('storefront.layout')

@section('title', isset($page) && $page->meta_title ? $page->meta_title : 'About Us - MunchGud')
@section('meta_description', isset($page) && $page->meta_description ? $page->meta_description : 'Learn about MunchGud — how we source premium makhana directly from Bihar farms, our mission to make healthy snacking delicious, and the team behind the brand.')
@section('meta_keywords', isset($page) && $page->meta_keywords ? $page->meta_keywords : 'about munchgud, our mission, roasted makhana, healthy snacks')

@section('content')
<article>
    <div class="bg-mg-cream min-h-screen py-16 sm:py-24 grain">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="text-center mb-16 sm:mb-20 reveal">
                <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4 border border-mg-green/20">
                    MunchGud, Feel Gud
                </span>
                <h1 class="font-heading text-5xl sm:text-7xl font-black text-mg-dark mb-6 tracking-tight">
                    About Us
                </h1>
                <p class="text-mg-muted text-xl sm:text-2xl font-light max-w-3xl mx-auto leading-relaxed">
                    At <span class="text-mg-green font-bold">MunchGud</span>, we believe healthy snacking should never be boring. Our mission is simple: to transform the traditional goodness of makhana into a delicious, crunchy, and flavorful snack that people can enjoy anytime, anywhere.
                </p>
            </div>

            <!-- Two Column Content: Bihar & Our Story -->
            <div class="grid md:grid-cols-2 gap-8 mb-16 reveal">
                <!-- Left Card: Bihar Connection -->
                <div class="bg-white rounded-[2rem] border border-mg-dark/5 p-8 sm:p-10 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-mg-orange/10 flex items-center justify-center text-2xl mb-6">📍</div>
                        <h2 class="font-heading text-2xl sm:text-3xl font-black text-mg-dark mb-4">Born in the Heart of Bihar</h2>
                        <p class="text-mg-dark/80 leading-relaxed font-light mb-4 text-base">
                            Born in the heart of Bihar—the land renowned for producing the world's finest makhana—we are passionate about bringing this ancient superfood to modern consumers in a convenient and exciting way.
                        </p>
                        <p class="text-mg-dark/80 leading-relaxed font-light text-base">
                            Bihar remains the center of India's makhana cultivation and is globally recognized for its premium-quality fox nuts.
                        </p>
                    </div>
                </div>

                <!-- Right Card: Our Story -->
                <div class="bg-white rounded-[2rem] border border-mg-dark/5 p-8 sm:p-10 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-mg-green/10 flex items-center justify-center text-2xl mb-6">📖</div>
                        <h2 class="font-heading text-2xl sm:text-3xl font-black text-mg-dark mb-4">Our Story</h2>
                        <p class="text-mg-dark/80 leading-relaxed font-light mb-4 text-base">
                            MunchGud started with a vision to create a snack that combines health, taste, and quality. We noticed that while makhana is packed with nutritional benefits, many people still considered it a traditional or occasional snack. We wanted to change that.
                        </p>
                        <p class="text-mg-dark/80 leading-relaxed font-light text-base">
                            By carefully sourcing premium-quality makhana and crafting unique flavors, we created a range of roasted snacks that deliver the perfect balance of crunch, nutrition, and taste. Every pack of MunchGud is made for today's health-conscious consumers who don't want to compromise on flavor.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission, Vision, Promise Grid -->
            <div class="grid md:grid-cols-3 gap-6 mb-16 reveal">
                <!-- Mission Card -->
                <div class="bg-mg-green/5 rounded-[2rem] border border-mg-green/10 p-8 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-10 h-10 rounded-xl bg-mg-green text-white flex items-center justify-center text-xl mb-6 shadow-md shadow-mg-green/20">🎯</div>
                    <h3 class="font-heading text-xl font-bold text-mg-green mb-3">Our Mission</h3>
                    <p class="text-mg-dark/75 text-sm leading-relaxed font-light">
                        To make healthy snacking enjoyable by offering delicious roasted makhana products that support better lifestyle choices while promoting the rich agricultural heritage of Bihar.
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="bg-mg-orange/5 rounded-[2rem] border border-mg-orange/10 p-8 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-10 h-10 rounded-xl bg-mg-orange text-white flex items-center justify-center text-xl mb-6 shadow-md shadow-mg-orange/20">👁️</div>
                    <h3 class="font-heading text-xl font-bold text-mg-orange mb-3">Our Vision</h3>
                    <p class="text-mg-dark/75 text-sm leading-relaxed font-light">
                        To become one of India's most trusted healthy snack brands and introduce the goodness of makhana to households across the country and beyond.
                    </p>
                </div>

                <!-- Promise Card -->
                <div class="bg-mg-green/5 rounded-[2rem] border border-mg-green/10 p-8 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-10 h-10 rounded-xl bg-mg-green text-white flex items-center justify-center text-xl mb-6 shadow-md shadow-mg-green/20">🤝</div>
                    <h3 class="font-heading text-xl font-bold text-mg-green mb-3">Our Promise</h3>
                    <p class="text-mg-dark/75 text-sm leading-relaxed font-light">
                        Every MunchGud pack is crafted with care, using quality ingredients and strict hygiene standards. Whether it's our Cream & Onion, Peri Peri, or other exciting flavors, we ensure every bite delivers a wholesome and memorable snacking experience.
                    </p>
                </div>
            </div>

            <!-- What Makes Us Different -->
            <div class="bg-white rounded-[2rem] border border-mg-dark/5 p-8 sm:p-12 reveal">
                <h2 class="font-heading text-3xl sm:text-4xl font-black text-mg-dark mb-8 text-center font-serif">What Makes MunchGud Different?</h2>
                
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Feature 1 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">🌾</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Premium Quality</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">Makhana sourced directly from trusted growers in Bihar.</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">🔥</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Roasted, Not Fried</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">No unhealthy trans fats. Slow-roasted for perfect crunch.</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">💨</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Light & Crunchy</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">A perfectly light, airy, and satisfying snacking companion.</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">😋</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Zero Taste Compromise</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">Bold, exciting flavors like Cream & Onion and Peri Peri.</p>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">🎒</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Snack Anywhere</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">Perfect for work, travel, fitness sessions, and everyday munching.</p>
                        </div>
                    </div>

                    <!-- Feature 6 -->
                    <div class="flex items-start gap-4">
                        <span class="text-2xl mt-1">🧼</span>
                        <div>
                            <h4 class="font-bold text-mg-dark text-base mb-1">Hygienically Packed</h4>
                            <p class="text-mg-muted text-sm leading-relaxed">Carefully processed and packed tightly to preserve maximum freshness.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Call-to-Action -->
            <div class="text-center mt-16 reveal">
                <p class="font-heading text-2xl font-black text-mg-dark mb-6">MunchGud – Smart Snacking, Full of Flavor.</p>
                <a href="{{ route('products.index') }}" class="inline-flex btn-primary py-3.5 px-8 text-base">
                    Shop Our Makhana
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="ml-2">
                        <path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</article>
@endsection
