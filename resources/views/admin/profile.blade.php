@extends('admin.layouts.app')

@section('title', 'Profile Settings')
@section('header', 'Profile Settings')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Breadcrumb / Back button -->
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-900 flex items-center gap-1">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-xl shadow-gray-100/50">
        <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-6 border-b border-gray-100">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white flex items-center justify-center font-bold text-2xl shadow-lg shadow-emerald-500/20 shrink-0">
                {{ substr($admin->name, 0, 2) }}
            </div>
            <div class="text-center sm:text-left">
                <h3 class="text-xl font-bold text-gray-900">{{ $admin->name }}</h3>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-0.5">{{ ucfirst($admin->role) }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Last login: {{ $admin->last_login_at ? $admin->last_login_at->format('M d, Y h:i A') : 'Never' }}</p>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm font-medium">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition">
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Change Password (Optional)</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Leave blank to keep current"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md shadow-emerald-600/10 transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
