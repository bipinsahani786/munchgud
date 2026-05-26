@extends('admin.layouts.app')

@section('title', $blog->exists ? 'Edit Blog' : 'Create Blog')
@section('header', 'Blogs')

@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-mg-dark tracking-tight">{{ $blog->exists ? 'Edit Blog' : 'Create Blog' }}</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Fill in the details to {{ $blog->exists ? 'update' : 'publish' }} this post.</p>
    </div>
    <a href="{{ route('admin.blogs.index') }}" class="text-sm font-bold text-gray-500 hover:text-mg-dark">← Back to Blogs</a>
</div>

<form action="{{ $blog->exists ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
    @csrf
    @if($blog->exists) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-mg-dark mb-4">Post Content</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green focus:border-mg-green outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Content</label>
                        <div id="quill-editor" class="bg-gray-50 rounded-b-xl border-gray-200" style="min-height: 300px;">{!! old('content', $blog->content) !!}</div>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content', $blog->content) }}">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-mg-dark mb-4">SEO Details (Optional)</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green focus:border-mg-green outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green focus:border-mg-green outline-none transition">{{ old('meta_description', $blog->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-mg-dark mb-4">Publishing</h2>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Author Name</label>
                        <input type="text" name="author_name" value="{{ old('author_name', $blog->author_name ?? 'MunchGud') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green focus:border-mg-green outline-none transition">
                    </div>

                    <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $blog->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-mg-green rounded border-gray-300 focus:ring-mg-green">
                        <span class="text-sm font-bold text-mg-dark">Publish immediately</span>
                    </label>

                    <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-gray-800 transition shadow-sm">
                        {{ $blog->exists ? 'Update Blog Post' : 'Save Blog Post' }}
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-mg-dark mb-4">Featured Image</h2>
                
                @if($blog->image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($blog->image) }}" class="w-full rounded-xl border border-gray-200">
                    </div>
                @endif
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Upload New Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-mg-green/10 file:text-mg-green hover:file:bg-mg-green/20">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [2, 3, 4, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    document.getElementById('blogForm').onsubmit = function() {
        document.getElementById('content-input').value = quill.root.innerHTML;
    };
</script>
@endsection
