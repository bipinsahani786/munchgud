@extends('storefront.layout')

@section('title', 'My Account — MunchGud')

@section('content')
<div class="min-h-screen bg-munch-cream py-10 lg:py-16">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
        
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs text-mg-muted mb-2">
                <a href="/" class="hover:text-mg-green transition">Home</a>
                <span>/</span>
                <span class="text-mg-dark font-medium">My Account</span>
            </div>
            <h1 class="text-3xl lg:text-4xl font-serif font-bold text-mg-dark">
                Welcome back, <span class="text-mg-green italic">{{ auth()->user()->name ?? 'Snacker' }}</span> 👋
            </h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 xl:gap-10 items-start">
            
            <!-- ═══ Sidebar ═══ -->
            <aside class="w-full lg:w-[260px] xl:w-[280px] flex-shrink-0 lg:sticky lg:top-[100px]">
                <div class="bg-white rounded-[1.75rem] overflow-hidden shadow-card border border-black/[0.04]">
                    
                    <!-- Profile Header -->
                    <div class="bg-gradient-to-br from-mg-green-dark to-mg-green p-6 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/[0.04] rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative z-10 flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-white/15 border-2 border-white/30 flex items-center justify-center font-black text-2xl shadow-inner flex-shrink-0 uppercase">
                                {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-base leading-tight truncate">{{ auth()->user()->name ?? 'Guest User' }}</p>
                                <p class="text-white/60 text-xs mt-0.5 truncate">{{ auth()->user()->email ?: auth()->user()->phone ?: '—' }}</p>
                                <span class="inline-block mt-1.5 text-[9.5px] font-bold bg-white/15 text-white/80 rounded-full px-2.5 py-0.5 uppercase tracking-wider">Premium Member</span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="p-3">
                        @php
                            $navs = [
                                ['label' => 'Dashboard', 'route' => 'account.index', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'badge' => null],
                                ['label' => 'Orders & Tracking', 'route' => 'account.orders', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'badge' => null],
                                ['label' => 'Support Tickets', 'route' => 'account.tickets.index', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'badge' => null],
                                ['label' => 'Wishlist', 'route' => 'account.wishlist', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'badge' => null],
                                ['label' => 'Addresses', 'route' => 'account.addresses', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'badge' => null],
                                ['label' => 'Profile Settings', 'route' => 'account.profile', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'badge' => null],
                            ];
                        @endphp

                        <div class="space-y-0.5 py-1">
                        @foreach($navs as $nav)
                            @php $isActive = request()->routeIs($nav['route'].'*'); @endphp
                            <a href="{{ route($nav['route']) }}" 
                               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 group
                                      {{ $isActive 
                                         ? 'bg-mg-green text-white shadow-sm shadow-mg-green/25' 
                                         : 'text-mg-muted hover:bg-mg-green/[0.06] hover:text-mg-green' }}">
                                <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isActive ? 'text-white' : 'text-mg-muted group-hover:text-mg-green transition' }}" 
                                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $nav['icon'] }}"/>
                                </svg>
                                <span class="flex-1">{{ $nav['label'] }}</span>
                                @if($nav['badge'])
                                <span class="text-[10px] font-bold bg-mg-orange text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $nav['badge'] }}</span>
                                @endif
                                @if($isActive)
                                <svg class="w-4 h-4 text-white/50 ml-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @endif
                            </a>
                        @endforeach
                        </div>

                        <div class="border-t border-black/[0.05] mt-2 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                                    <svg class="w-[18px] h-[18px] flex-shrink-0 text-red-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </nav>

                    <!-- Quick Help -->
                    <div class="mx-3 mb-3 p-4 bg-munch-50 rounded-xl border border-munch-100">
                        <p class="text-xs font-bold text-munch-900 mb-1">Need help?</p>
                        <p class="text-[11px] text-munch-600 mb-3 leading-relaxed">Our support team is available Mon–Sat, 10am–6pm IST.</p>
                        <a href="{{ route('account.tickets.create') }}" class="flex items-center justify-center gap-1.5 text-[11px] font-bold text-mg-green border border-mg-green/20 bg-mg-green/[0.04] rounded-lg py-2 hover:bg-mg-green hover:text-white transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Open Support Ticket
                        </a>
                    </div>
                </div>
            </aside>

            <!-- ═══ Main Content ═══ -->
            <main class="flex-1 min-w-0">
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200/60 text-green-800 rounded-2xl p-4 mb-6 text-sm font-medium flex items-center gap-3 shadow-sm">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200/60 text-red-800 rounded-2xl p-4 mb-6 text-sm font-medium flex items-center gap-3 shadow-sm">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('account_content')
            </main>

        </div>
    </div>
</div>
@endsection
