@extends('storefront.layout')

@section('title', 'Customer Reviews | MunchGud')

@section('content')
<div class="pt-32 pb-20 bg-mg-cream grain min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h1 class="font-heading text-5xl sm:text-7xl font-black text-mg-dark mb-6">Snackers <span class="italic text-mg-green">Speak</span></h1>
            <p class="text-mg-muted text-lg max-w-2xl mx-auto">Don't just take our word for it. Here is what thousands of healthy snackers are saying.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php 
                // Fetch reviews if available
                $reviews = \App\Models\Review::approved()->latest()->take(12)->get();
            @endphp
            
            @forelse($reviews as $i => $r)
                @php 
                    $colors = ['from-pink-400 to-rose-500', 'from-blue-400 to-indigo-500', 'from-green-400 to-emerald-500', 'from-orange-400 to-amber-500'];
                    $cl = $colors[$i % count($colors)];
                @endphp
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-mg-dark/5 hover:-translate-y-1 transition-transform">
                    <div class="text-mg-gold text-lg mb-4">
                        @for($k=0; $k<$r->rating; $k++)★@endfor
                    </div>
                    <p class="text-mg-dark/80 text-base leading-relaxed mb-6 font-medium">"{{ $r->review }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $cl }} flex items-center justify-center text-white text-sm font-bold">{{ substr($r->user->name ?? 'Guest',0,1) }}</div>
                        <div>
                            <p class="font-bold text-sm text-mg-dark">{{ $r->user->name ?? 'Guest' }}</p>
                            <p class="text-[11px] text-mg-muted">Verified Customer · <span class="text-mg-leaf">Verified</span></p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-mg-muted">No reviews yet. Check back soon!</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
