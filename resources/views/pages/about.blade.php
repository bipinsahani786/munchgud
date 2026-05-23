@extends('storefront.layout')

@section('title', 'Our Story - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen">
    
    <!-- Hero -->
    <div class="relative bg-munch-900 py-32 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-serif text-white mb-6">Our Story</h1>
            <p class="text-xl text-munch-300 font-light leading-relaxed">It started with a simple belief: snacking should make you feel good, not guilty.</p>
        </div>
    </div>

    <!-- The Origin -->
    <div class="max-w-7xl mx-auto px-4 py-24 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-serif text-munch-900 mb-6">Rooted in Tradition</h2>
            <p class="text-lg text-munch-700 leading-relaxed font-light mb-6">For centuries, Makhana (Fox Nuts) has been an integral part of Indian heritage, revered for its nutritional profile and used in auspicious ceremonies.</p>
            <p class="text-lg text-munch-700 leading-relaxed font-light">MunchGud was born out of a desire to bring this ancient superfood to the modern world. We wanted to elevate the humble makhana from a traditional fasting food to a gourmet, everyday snack that fits perfectly into a contemporary, health-conscious lifestyle.</p>
        </div>
        <div class="md:w-1/2">
            <div class="aspect-square bg-munch-200 p-12 flex items-center justify-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="Origin" class="mix-blend-multiply opacity-60">
            </div>
        </div>
    </div>

    <!-- The Process -->
    <div class="bg-white py-24">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-sm mb-4 block">The Process</span>
            <h2 class="text-4xl font-serif text-munch-900 mb-12">From Pond to Packet</h2>
            
            <div class="space-y-16 text-left">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="text-5xl font-serif text-munch-300 md:w-24 flex-shrink-0">01</div>
                    <div>
                        <h3 class="text-2xl font-serif text-munch-900 mb-3">Ethical Sourcing</h3>
                        <p class="text-munch-600 font-light leading-relaxed">We work directly with the farmers in Bihar, India—the heartland of Makhana cultivation. By eliminating middlemen, we ensure fair compensation for their labor while securing the highest grade of lotus seeds.</p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="text-5xl font-serif text-munch-300 md:w-24 flex-shrink-0">02</div>
                    <div>
                        <h3 class="text-2xl font-serif text-munch-900 mb-3">Slow Roasting</h3>
                        <p class="text-munch-600 font-light leading-relaxed">Most commercial snacks are deep-fried, stripping them of nutrients and adding unhealthy fats. We slow-roast our makhana in small batches. This meticulous process ensures a perfect, light crunch without the greasy residue.</p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="text-5xl font-serif text-munch-300 md:w-24 flex-shrink-0">03</div>
                    <div>
                        <h3 class="text-2xl font-serif text-munch-900 mb-3">Gourmet Seasoning</h3>
                        <p class="text-munch-600 font-light leading-relaxed">We toss the roasted makhana in premium, cold-pressed olive oil (never palm oil) and coat them in our proprietary spice blends. No artificial colors, no MSG, no synthetic flavors. Just pure, unadulterated taste.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
