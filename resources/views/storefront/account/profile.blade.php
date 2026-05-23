@extends('storefront.account.layout')

@section('account_content')
<h2 class="font-heading text-3xl font-bold text-mg-dark mb-8">Profile Settings</h2>

<div class="grid lg:grid-cols-3 gap-8">
    <!-- Profile Card (Read Only Visuals) -->
    <div class="bg-white rounded-3xl p-6 border border-mg-dark/5 shadow-xl shadow-mg-dark/5 h-fit text-center">
        <div class="relative w-32 h-32 mx-auto mb-6">
            @if(auth()->user()->avatar)
                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover border-4 border-mg-green/10 shadow-md">
            @else
                <div class="w-full h-full rounded-full bg-gradient-to-br from-mg-green to-emerald-500 text-white flex items-center justify-center font-bold text-4xl shadow-inner">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
        </div>
        <h3 class="font-heading text-xl font-bold text-mg-dark mb-1">{{ auth()->user()->name }}</h3>
        <p class="text-sm text-mg-muted mb-4">{{ auth()->user()->email }}</p>
        <span class="inline-block bg-mg-green/8 text-mg-green text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
            Verified Customer
        </span>
        <p class="text-[10px] text-mg-muted mt-4">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
    </div>

    <!-- Update Form -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
        <h3 class="font-bold text-mg-dark mb-6 text-lg border-b border-mg-dark/5 pb-4">Personal Details</h3>
        
        <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20" placeholder="e.g. +91 99999 99999">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-mg-dark mb-2">Email Address <span class="text-mg-muted text-xs font-normal">(Non-editable)</span></label>
                <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full bg-mg-cream/50 border border-mg-dark/5 text-mg-muted rounded-xl px-4 py-3 text-sm cursor-not-allowed">
            </div>

            <div>
                <label class="block text-sm font-bold text-mg-dark mb-2">Profile Avatar</label>
                <div class="flex items-center gap-4">
                    <input type="file" name="avatar" class="block w-full text-sm text-mg-muted file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-mg-green/10 file:text-mg-green hover:file:bg-mg-green/20 transition-all">
                </div>
                <p class="text-[10px] text-mg-muted mt-2">Maximum file size: 2MB. Supported formats: JPG, JPEG, PNG.</p>
                @error('avatar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-mg-dark/5">
                <button type="submit" class="bg-mg-green text-white font-bold px-8 py-3 rounded-xl hover:bg-mg-green-dark transition-all shadow-md shadow-mg-green/10">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
