@extends('admin.layouts.app')

@section('title', 'Manage Blogs')
@section('header', 'Blogs')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-mg-dark tracking-tight">Manage Blogs</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Create and manage your blog posts.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-gray-800 transition shadow-sm border border-transparent">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Blog Post
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Blog Post</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Created At</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($blogs as $blog)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($blog->image)
                                <img src="{{ Storage::url($blog->image) }}" class="w-12 h-12 rounded-lg object-cover bg-gray-100">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-mg-dark text-base">{{ $blog->title }}</div>
                                <div class="text-xs text-gray-400 font-medium mt-0.5 flex items-center gap-1.5">
                                    By {{ $blog->author_name ?? 'Admin' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($blog->is_active)
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border bg-emerald-50 text-emerald-700 border-emerald-200">
                                Published
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border bg-gray-50 text-gray-700 border-gray-200">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500 font-medium text-sm">
                        {{ $blog->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="p-2 text-blue-600 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
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
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No blogs found</h3>
                            <p class="text-gray-500 text-sm font-medium">Create your first blog post to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection
