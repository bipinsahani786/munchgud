@extends('admin.layouts.app')

@section('title', 'Settings')
@section('header', 'Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-gray-900">Global Settings</h1>
    <p class="text-sm text-gray-500 font-medium mt-0.5">Manage store-wide configurations, delivery rates, and API keys.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="space-y-6">
        <!-- Company Branding -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Company Branding & Info</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Company Name</label>
                    <input type="text" name="company_name" value="{{ \App\Models\Setting::get('company_name', 'MunchGud Enterprises') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Company Logo</label>
                    @if(\App\Models\Setting::get('company_logo'))
                        <div class="mb-2">
                            <img src="{{ Storage::url(\App\Models\Setting::get('company_logo')) }}" alt="Logo" class="h-12 object-contain bg-gray-50 p-2 rounded border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="company_logo" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Favicon</label>
                    @if(\App\Models\Setting::get('company_favicon'))
                        <div class="mb-2">
                            <img src="{{ Storage::url(\App\Models\Setting::get('company_favicon')) }}" alt="Favicon" class="h-8 w-8 object-contain bg-gray-50 p-1 rounded border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="company_favicon" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
            </div>
        </div>

        <!-- Company Address -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Company Address</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Address Line 1</label>
                    <input type="text" name="company_address_1" value="{{ \App\Models\Setting::get('company_address_1', '123 Snack Avenue, Industrial Area') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Address Line 2 (Optional)</label>
                    <input type="text" name="company_address_2" value="{{ \App\Models\Setting::get('company_address_2') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">City</label>
                    <input type="text" name="company_city" value="{{ \App\Models\Setting::get('company_city', 'Patna') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">State & Pincode</label>
                    <div class="flex gap-3">
                        <input type="text" name="company_state" value="{{ \App\Models\Setting::get('company_state', 'Bihar') }}" placeholder="State" class="w-2/3 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                        <input type="text" name="company_pincode" value="{{ \App\Models\Setting::get('company_pincode', '800001') }}" placeholder="Pincode" class="w-1/3 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Social Media Links</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Facebook URL</label>
                    <input type="url" name="social_facebook" value="{{ \App\Models\Setting::get('social_facebook', '#') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Instagram URL</label>
                    <input type="url" name="social_instagram" value="{{ \App\Models\Setting::get('social_instagram', '#') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Twitter / X URL</label>
                    <input type="url" name="social_twitter" value="{{ \App\Models\Setting::get('social_twitter', '#') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">YouTube URL</label>
                    <input type="url" name="social_youtube" value="{{ \App\Models\Setting::get('social_youtube', '#') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
            </div>
        </div>
        <!-- Storefront Settings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Storefront</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Instagram Embed URL</label>
                    <input type="text" name="instagram_embed_url" value="{{ \App\Models\Setting::get('instagram_embed_url') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="https://www.instagram.com/p/.../embed">
                    <p class="text-[11px] text-gray-400 mt-1.5">Instagram post embed URL for the homepage.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Free Shipping Text</label>
                    <input type="text" name="free_shipping_text" value="{{ \App\Models\Setting::get('free_shipping_text', 'Free shipping above ₹999 ✦ Pan India') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <p class="text-[11px] text-gray-400 mt-1.5">Shown in menus and footer.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Announcement Marquee Messages</label>
                    <textarea name="announcement_messages" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="Message 1&#10;Message 2">{{ \App\Models\Setting::get('announcement_messages', "🌿 Free Shipping on orders above ₹999 — Pan India Delivery!\n✨ New customers get 10% off — Use code WELCOME10\n🔥 New Flavour Drop: Cheese & Herbs Makhana is LIVE!\n⭐ 5,000+ Happy Snackers — Join the MunchGud family today!") }}</textarea>
                    <p class="text-[11px] text-gray-400 mt-1.5">Enter one message per line. These will slide at the top of the website.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Store Phone</label>
                    <input type="text" name="store_phone" value="{{ \App\Models\Setting::get('store_phone') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Store Email</label>
                    <input type="email" name="store_email" value="{{ \App\Models\Setting::get('store_email') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Delivery & Tax Settings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Delivery & Tax</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Free Shipping Threshold (₹)</label>
                    <input type="number" step="0.01" name="free_shipping_threshold" value="{{ \App\Models\Setting::get('free_shipping_threshold', 499) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <p class="text-[11px] text-gray-400 mt-1.5">Orders above this value get free shipping.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Flat Shipping Rate (₹)</label>
                    <input type="number" step="0.01" name="flat_shipping_rate" value="{{ \App\Models\Setting::get('flat_shipping_rate', 50) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <p class="text-[11px] text-gray-400 mt-1.5">Shipping cost if order is below threshold.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Default GST Rate (%)</label>
                    <input type="number" step="0.01" name="gst_percent" value="{{ \App\Models\Setting::get('gst_percent', 18) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <p class="text-[11px] text-gray-400 mt-1.5">Default GST rate applied to all products (overridable per product).</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">COD (Cash on Delivery)</label>
                    <select name="cod_enabled" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        <option value="1" {{ \App\Models\Setting::get('cod_enabled', '1') == '1' ? 'selected' : '' }}>Enabled (Global)</option>
                        <option value="0" {{ \App\Models\Setting::get('cod_enabled', '1') == '0' ? 'selected' : '' }}>Disabled (Global)</option>
                    </select>
                    <p class="text-[11px] text-gray-400 mt-1.5">Globally enable/disable COD. Can also be controlled per product & per zone.</p>
                </div>
                <div class="md:col-span-2 mt-2">
                    <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-xs text-blue-800">For state-wise pincode management, use <a href="{{ route('admin.zones.index') }}" class="font-bold underline">Delivery Zones</a> instead. Zones allow per-state COD control, custom delivery days, and extra shipping charges.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Gateway -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Payment Gateway (Razorpay)</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Razorpay Key ID</label>
                    <input type="text" name="razorpay_key" value="{{ \App\Models\Setting::get('razorpay_key') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Razorpay Secret</label>
                    <input type="password" name="razorpay_secret" value="{{ \App\Models\Setting::get('razorpay_secret') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-mono">
                </div>
            </div>
        </div>

        <!-- Email / SMTP Settings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Email / SMTP Server</h2>
            </div>
            <div class="p-6 grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">SMTP Host</label>
                    <input type="text" name="mail_host" value="{{ \App\Models\Setting::get('mail_host', env('MAIL_HOST', 'smtp.mailtrap.io')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">SMTP Port</label>
                    <input type="text" name="mail_port" value="{{ \App\Models\Setting::get('mail_port', env('MAIL_PORT', 2525)) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">SMTP Username</label>
                    <input type="text" name="mail_username" value="{{ \App\Models\Setting::get('mail_username', env('MAIL_USERNAME')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">SMTP Password</label>
                    <input type="password" name="mail_password" value="{{ \App\Models\Setting::get('mail_password', env('MAIL_PASSWORD')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">From Address</label>
                    <input type="email" name="mail_from_address" value="{{ \App\Models\Setting::get('mail_from_address', env('MAIL_FROM_ADDRESS')) }}" placeholder="no-reply@munchgud.com" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">From Name</label>
                    <input type="text" name="mail_from_name" value="{{ \App\Models\Setting::get('mail_from_name', env('MAIL_FROM_NAME', 'MunchGud')) }}" placeholder="MunchGud Orders" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
            </div>
        </div>
    </div>

    <!-- Save -->
    <div class="flex justify-end mt-6">
        <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition shadow-sm">
            Save Settings
        </button>
    </div>
</form>
@endsection
