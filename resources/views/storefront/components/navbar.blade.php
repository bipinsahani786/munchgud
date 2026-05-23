<nav id="main-navbar" class="navbar" x-data="{ mobileOpen: false }">
    <div class="container-xl" style="display: flex; align-items: center; justify-content: space-between;">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="nav-logo" style="font-family: var(--heading-font); font-weight: 900; font-size: 1.75rem; color: #fff; text-decoration: none; letter-spacing: -0.02em;">
            Munch<span style="color: var(--secondary);">Gud</span>
        </a>

        <!-- Desktop Nav Links -->
        <div style="display: none;" class="md-flex" id="desktop-nav">
            <a href="{{ route('home') }}" class="nav-link" style="color: rgba(255,255,255,0.85); text-decoration: none; font-weight: 500; font-size: 0.9375rem; margin: 0 1.25rem; transition: all 0.3s; position: relative;">Shop</a>
            <a href="#" class="nav-link" style="color: rgba(255,255,255,0.85); text-decoration: none; font-weight: 500; font-size: 0.9375rem; margin: 0 1.25rem; transition: all 0.3s;">Our Story</a>
            <a href="#" class="nav-link" style="color: rgba(255,255,255,0.85); text-decoration: none; font-weight: 500; font-size: 0.9375rem; margin: 0 1.25rem; transition: all 0.3s;">Bulk Orders</a>
            <a href="#" class="nav-link" style="color: rgba(255,255,255,0.85); text-decoration: none; font-weight: 500; font-size: 0.9375rem; margin: 0 1.25rem; transition: all 0.3s;">Contact</a>
        </div>

        <!-- Icons -->
        <div style="display: flex; align-items: center; gap: 1.25rem;">
            <!-- Search -->
            <button class="nav-icon" style="background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.85); transition: all 0.3s;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <!-- Wishlist -->
            <a href="#" class="nav-icon" style="color: rgba(255,255,255,0.85); text-decoration: none; position: relative; transition: all 0.3s;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <!-- Cart -->
            <a href="#" class="nav-icon" style="color: rgba(255,255,255,0.85); text-decoration: none; position: relative; transition: all 0.3s;">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6" stroke-width="2"/><path d="M16 10a4 4 0 01-8 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span style="position: absolute; top: -8px; right: -8px; background: var(--secondary); color: #fff; font-size: 0.625rem; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">0</span>
            </a>
            <!-- Account -->
            <a href="#" class="nav-icon" style="color: rgba(255,255,255,0.85); text-decoration: none; display: none; transition: all 0.3s;" id="account-icon-desktop">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke-width="2"/></svg>
            </a>
            <!-- Mobile Hamburger -->
            <button @click="mobileOpen = !mobileOpen" class="nav-icon" style="background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.85);" id="mobile-menu-btn">
                <svg x-show="!mobileOpen" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="mobileOpen = false" style="position: absolute; top: 100%; left: 0; right: 0; background: var(--primary); padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.9); text-decoration: none; font-size: 1.125rem; font-weight: 500; padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.08);">Shop</a>
            <a href="#" style="color: rgba(255,255,255,0.9); text-decoration: none; font-size: 1.125rem; font-weight: 500; padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.08);">Our Story</a>
            <a href="#" style="color: rgba(255,255,255,0.9); text-decoration: none; font-size: 1.125rem; font-weight: 500; padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.08);">Bulk Orders</a>
            <a href="#" style="color: rgba(255,255,255,0.9); text-decoration: none; font-size: 1.125rem; font-weight: 500; padding: 0.75rem 0;">Contact</a>
            <div style="padding-top: 0.75rem;">
                <a href="#" class="btn-primary" style="width: 100%; text-align: center;">Login / Register</a>
            </div>
        </div>
    </div>
</nav>

<style>
    @media (min-width: 768px) {
        #desktop-nav { display: flex !important; }
        #mobile-menu-btn { display: none !important; }
        #account-icon-desktop { display: block !important; }
    }
</style>
