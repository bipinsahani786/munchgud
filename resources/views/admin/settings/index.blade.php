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
                <div x-data="{ 
                    previewUrl: '{{ \App\Models\Setting::get('company_logo') ? Storage::url(\App\Models\Setting::get('company_logo')) : '' }}',
                    isNew: false
                }" class="flex flex-col gap-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Company Logo</label>
                    
                    <div class="flex items-center gap-4">
                        <!-- Preview Box -->
                        <div class="relative h-20 w-44 border border-gray-200 rounded-2xl bg-gray-50/50 flex items-center justify-center overflow-hidden p-3 transition-all duration-300 hover:border-emerald-300">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" alt="Logo Preview" class="h-full w-full object-contain">
                            </template>
                            <template x-if="!previewUrl">
                                <div class="text-center flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"/></svg>
                                    <span class="text-[10px] text-gray-400 font-medium">No Logo Uploaded</span>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Status Info -->
                        <div class="flex flex-col gap-1.5">
                            <template x-if="previewUrl && !isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Currently Active
                                </span>
                            </template>
                            <template x-if="isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Selected (Unsaved)
                                </span>
                            </template>
                            <template x-if="!previewUrl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Not Set
                                </span>
                            </template>
                            <p class="text-[10px] text-gray-400 font-medium max-w-xs leading-normal">
                                <span x-show="!isNew">Select a new image below and click 'Save Settings' at the bottom.</span>
                                <span x-show="isNew" class="text-amber-600 font-semibold">Remember to click the 'Save Settings' button below!</span>
                            </p>
                        </div>
                    </div>

                    <input type="file" name="company_logo" accept="image/*" 
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                previewUrl = URL.createObjectURL(file);
                                isNew = true;
                            }
                        "
                        class="w-full max-w-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                
                <div x-data="{ 
                    previewUrl: '{{ \App\Models\Setting::get('company_favicon') ? Storage::url(\App\Models\Setting::get('company_favicon')) : '' }}',
                    isNew: false
                }" class="flex flex-col gap-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Favicon</label>
                    
                    <div class="flex items-center gap-4">
                        <!-- Preview Box -->
                        <div class="relative h-20 w-20 border border-gray-200 rounded-2xl bg-gray-50/50 flex items-center justify-center overflow-hidden p-3 transition-all duration-300 hover:border-emerald-300">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" alt="Favicon Preview" class="h-full w-full object-contain">
                            </template>
                            <template x-if="!previewUrl">
                                <div class="text-center flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"/></svg>
                                    <span class="text-[9px] text-gray-400 font-medium">No Favicon</span>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Status Info -->
                        <div class="flex flex-col gap-1.5">
                            <template x-if="previewUrl && !isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Currently Active
                                </span>
                            </template>
                            <template x-if="isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Selected (Unsaved)
                                </span>
                            </template>
                            <template x-if="!previewUrl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Not Set
                                </span>
                            </template>
                            <p class="text-[10px] text-gray-400 font-medium max-w-xs leading-normal">
                                <span x-show="!isNew">Select a new image below and click 'Save Settings' at the bottom.</span>
                                <span x-show="isNew" class="text-amber-600 font-semibold">Remember to click the 'Save Settings' button below!</span>
                            </p>
                        </div>
                    </div>

                    <input type="file" name="company_favicon" accept="image/*" 
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                previewUrl = URL.createObjectURL(file);
                                isNew = true;
                            }
                        "
                        class="w-full max-w-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                <div x-data="{ 
                    previewUrl: '{{ \App\Models\Setting::get('company_signature') ? Storage::url(\App\Models\Setting::get('company_signature')) : '' }}',
                    isNew: false
                }" class="flex flex-col gap-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Company Signature</label>
                    <p class="text-[10px] text-gray-400 mb-1">Transparent PNG recommended. Displays on invoice bills.</p>
                    
                    <div class="flex items-center gap-4">
                        <div class="relative h-20 w-32 border border-gray-200 rounded-2xl bg-gray-50/50 flex items-center justify-center overflow-hidden p-3 transition-all duration-300 hover:border-emerald-300">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" alt="Signature Preview" class="h-full w-full object-contain">
                            </template>
                            <template x-if="!previewUrl">
                                <div class="text-center flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"/></svg>
                                    <span class="text-[9px] text-gray-400 font-medium">No Signature</span>
                                </div>
                            </template>
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <template x-if="previewUrl && !isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Currently Active
                                </span>
                            </template>
                            <template x-if="isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Selected (Unsaved)
                                </span>
                            </template>
                            <template x-if="!previewUrl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Not Set
                                </span>
                            </template>
                        </div>
                    </div>

                    <input type="file" name="company_signature" accept="image/*" 
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                previewUrl = URL.createObjectURL(file);
                                isNew = true;
                            }
                        "
                        class="w-full max-w-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
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
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">GSTIN</label>
                    <input type="text" name="gstin" value="{{ \App\Models\Setting::get('gstin', '') }}" placeholder="e.g. 10AABCU9603R1Z1" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                    <p class="text-[10px] text-gray-400 mt-1">Appears on Tax Invoice</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">State Code</label>
                    <input type="text" name="state_code" value="{{ \App\Models\Setting::get('state_code', '') }}" placeholder="e.g. 10" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                    <p class="text-[10px] text-gray-400 mt-1">GST State Code for invoice</p>
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
                    <input type="url" name="social_facebook" value="{{ \App\Models\Setting::get('social_facebook', '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Instagram URL</label>
                    <input type="url" name="social_instagram" value="{{ \App\Models\Setting::get('social_instagram', '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Twitter / X URL</label>
                    <input type="url" name="social_twitter" value="{{ \App\Models\Setting::get('social_twitter', '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">YouTube URL</label>
                    <input type="url" name="social_youtube" value="{{ \App\Models\Setting::get('social_youtube', '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Instagram Reels URL</label>
                    <input type="url" name="social_reels" value="{{ \App\Models\Setting::get('social_reels', '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
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
                <div x-data="{ 
                    previewUrl: '{{ \App\Models\Setting::get('home_hero_image') ? Storage::url(\App\Models\Setting::get('home_hero_image')) : '' }}',
                    isNew: false
                }" class="md:col-span-2 flex flex-col gap-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Home Hero Image</label>
                    
                    <div class="flex items-center gap-4">
                        <div class="relative h-24 w-48 border border-gray-200 rounded-2xl bg-gray-50/50 flex items-center justify-center overflow-hidden p-3 transition-all duration-300 hover:border-emerald-300">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" alt="Hero Preview" class="h-full w-full object-cover rounded-xl">
                            </template>
                            <template x-if="!previewUrl">
                                <div class="text-center flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"/></svg>
                                    <span class="text-[10px] text-gray-400 font-medium">No Image</span>
                                </div>
                            </template>
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <template x-if="previewUrl && !isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Currently Active
                                </span>
                            </template>
                            <template x-if="isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Selected (Unsaved)
                                </span>
                            </template>
                            <template x-if="!previewUrl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Not Set
                                </span>
                            </template>
                        </div>
                    </div>

                    <input type="file" name="home_hero_image" accept="image/*" 
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                previewUrl = URL.createObjectURL(file);
                                isNew = true;
                            }
                        "
                        class="w-full max-w-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                
                <div x-data="{ 
                    previewUrl: '{{ \App\Models\Setting::get('default_product_image') ? Storage::url(\App\Models\Setting::get('default_product_image')) : '' }}',
                    isNew: false
                }" class="md:col-span-2 flex flex-col gap-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Default Product Image</label>
                    <p class="text-[11px] text-gray-400 mb-2">Used as a fallback when a product doesn't have an image uploaded.</p>
                    
                    <div class="flex items-center gap-4">
                        <div class="relative h-24 w-24 border border-gray-200 rounded-2xl bg-gray-50/50 flex items-center justify-center overflow-hidden p-3 transition-all duration-300 hover:border-emerald-300">
                            <template x-if="previewUrl">
                                <img :src="previewUrl" alt="Product Preview" class="h-full w-full object-cover rounded-xl">
                            </template>
                            <template x-if="!previewUrl">
                                <div class="text-center flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z"/></svg>
                                    <span class="text-[10px] text-gray-400 font-medium">No Image</span>
                                </div>
                            </template>
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <template x-if="previewUrl && !isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Currently Active
                                </span>
                            </template>
                            <template x-if="isNew">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Selected (Unsaved)
                                </span>
                            </template>
                            <template x-if="!previewUrl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    Not Set
                                </span>
                            </template>
                        </div>
                    </div>

                    <input type="file" name="default_product_image" accept="image/*" 
                        @change="
                            const file = $event.target.files[0];
                            if (file) {
                                previewUrl = URL.createObjectURL(file);
                                isNew = true;
                            }
                        "
                        class="w-full max-w-sm border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                </div>
                @php
                    $globalReelsText = \App\Models\Setting::get('instagram_reels_list', '');
                    if (empty(trim($globalReelsText))) {
                        $homePage = \App\Models\Page::where('slug', 'home')->first();
                        if ($homePage && is_array($homePage->sections)) {
                            if (!empty($homePage->sections['instagram_reels_list'])) {
                                $globalReelsText = $homePage->sections['instagram_reels_list'];
                            } else {
                                $oldLinks = [];
                                foreach(['instagram_video_1', 'instagram_video_2', 'instagram_video_3'] as $oldKey) {
                                    if (!empty($homePage->sections[$oldKey])) {
                                        $oldLinks[] = trim($homePage->sections[$oldKey]);
                                    }
                                }
                                $globalReelsText = implode("\n", $oldLinks);
                            }
                        }
                    }
                    $reelsArray = array_values(array_filter(array_map('trim', explode("\n", $globalReelsText))));
                @endphp
                <div class="md:col-span-2" x-data="{ 
                    reels: {{ json_encode(array_map(function($url) { return ['url' => $url]; }, $reelsArray)) }} 
                }" x-init="if (!reels || reels.length === 0) reels = [{ url: '' }]">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Instagram Reels / Posts List</label>
                    
                    <div class="space-y-3">
                        <template x-for="(reel, index) in reels" :key="index">
                            <div class="flex gap-2 items-center">
                                <input type="url" name="instagram_reels_list[]" x-model="reel.url" placeholder="e.g. https://www.instagram.com/reel/..." class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                                <button type="button" @click="if (reels.length > 1) reels.splice(index, 1); else reels = [{ url: '' }]" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition flex-shrink-0" title="Remove URL">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <button type="button" @click="reels.push({ url: '' })" class="mt-3 inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-xs rounded-xl hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        + Add Reel URL
                    </button>
                    <p class="text-[11px] text-gray-400 mt-2">Add as many Instagram Reel or Post URLs as you like. They will be rendered in a touch-friendly slider on the homepage.</p>
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
                    <div class="relative" x-data="{ showSecret: false }">
                        <input :type="showSecret ? 'text' : 'password'" name="razorpay_secret" value="{{ \App\Models\Setting::get('razorpay_secret') }}" class="w-full border border-gray-200 rounded-xl pl-4 pr-11 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-mono">
                        <button type="button" @click="showSecret = !showSecret" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700 transition p-1 cursor-pointer focus:outline-none" :title="showSecret ? 'Hide secret' : 'Show secret'">
                            <svg x-show="!showSecret" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="showSecret" x-cloak class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
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
                    <div class="relative" x-data="{ showSmtpPass: false }">
                        <input :type="showSmtpPass ? 'text' : 'password'" name="mail_password" value="{{ \App\Models\Setting::get('mail_password', env('MAIL_PASSWORD')) }}" class="w-full border border-gray-200 rounded-xl pl-4 pr-11 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        <button type="button" @click="showSmtpPass = !showSmtpPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-700 transition p-1 cursor-pointer focus:outline-none" :title="showSmtpPass ? 'Hide password' : 'Show password'">
                            <svg x-show="!showSmtpPass" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <svg x-show="showSmtpPass" x-cloak class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
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
