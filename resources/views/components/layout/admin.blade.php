<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MunchGud</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#1B4332',
                            600: '#11251A',
                            accent: '#D47F35'
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-brand-600 text-white transition-transform transform md:translate-x-0 md:static md:inset-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <div class="flex items-center justify-center h-16 bg-brand-500 font-bold text-xl tracking-widest border-b border-brand-600">
                MUNCHGUD
            </div>
            
            <nav class="p-4 space-y-2 h-full overflow-y-auto pb-20">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Products
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Categories
                </a>
                <a href="{{ route('admin.inventory.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.inventory.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Inventory
                </a>
                <a href="{{ route('admin.customers.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.customers.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Customers
                </a>
                <a href="{{ route('admin.coupons.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.coupons.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Coupons
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.reviews.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Reviews
                </a>
                <a href="{{ route('admin.tickets.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.tickets.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Support Tickets
                </a>
                <hr class="border-brand-500 my-4">
                <div class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">CMS</div>
                <a href="{{ route('admin.storefront.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.storefront.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Storefront
                </a>
                <a href="{{ route('admin.banners.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.banners.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Banners
                </a>
                <hr class="border-brand-500 my-4">
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 hover:bg-brand-500 rounded transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-brand-500 text-brand-accent' : '' }}">
                    Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Top Header -->
            <header class="h-16 bg-white border-b flex items-center justify-between px-4 sm:px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <div class="flex-1 text-right flex justify-end items-center space-x-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm text-gray-500 hover:text-brand-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        View Store
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 md:hidden"></div>
    </div>
    
    @stack('scripts')
</body>
</html>
