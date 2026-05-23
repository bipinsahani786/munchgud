@extends('admin.layouts.app')

@section('title', 'Manage Recipes')
@section('header', 'Recipes')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-mg-dark tracking-tight">Manage Recipes</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Create, review, and manage recipes.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.recipes.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-mg-green text-white text-sm font-bold rounded-xl hover:bg-mg-green-dark transition shadow-sm border border-transparent">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Recipe
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Recipe</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Author</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Date</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($recipes as $recipe)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-bold text-mg-dark text-base">{{ $recipe->title }}</div>
                        <div class="text-xs text-gray-400 font-medium mt-0.5 flex items-center gap-1.5">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-mg-orange"></span> {{ $recipe->category }} 
                            <span class="text-gray-300 mx-1">•</span> 
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $recipe->time }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-mg-green font-bold text-xs border border-gray-200">
                                {{ substr($recipe->author_name ?? 'M', 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ $recipe->author_name ?? 'MunchGud Official' }}</div>
                                <div class="text-xs text-gray-400 font-medium">{{ $recipe->author_email ?? 'Internal' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500 font-medium text-sm">
                        {{ $recipe->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($recipe->status === 'approved')
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border bg-emerald-50 text-emerald-700 border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 mt-1.5"></span> Approved
                            </span>
                        @elseif($recipe->status === 'pending')
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border bg-amber-50 text-amber-700 border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 mt-1.5 animate-pulse"></span> Pending
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border bg-red-50 text-red-700 border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5 mt-1.5"></span> Rejected
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @if($recipe->status === 'pending')
                                <form action="{{ route('admin.recipes.approve', $recipe) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg transition-colors border border-transparent hover:border-emerald-100" title="Approve">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.recipes.reject', $recipe) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-2 text-amber-600 hover:bg-amber-50 hover:text-amber-700 rounded-lg transition-colors border border-transparent hover:border-amber-100" title="Reject">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.recipes.edit', $recipe) }}" class="p-2 text-blue-600 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No recipes found</h3>
                            <p class="text-gray-500 text-sm font-medium">There are no recipes submitted yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
