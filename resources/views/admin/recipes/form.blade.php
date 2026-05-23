@extends('admin.layouts.app')

@section('title', $recipe->exists ? 'Edit Recipe' : 'Add Recipe')
@section('header', 'Recipes')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.recipes.index') }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-mg-dark hover:border-gray-300 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-bold text-mg-dark tracking-tight">{{ $recipe->exists ? 'Edit Recipe' : 'Add New Recipe' }}</h1>
        </div>
        <p class="text-sm font-medium text-gray-500">Create beautiful, dynamic recipes for your blog.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <form action="{{ $recipe->exists ? route('admin.recipes.update', $recipe) : route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($recipe->exists)
            @method('PUT')
        @endif
        
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- Main Content Column --}}
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Recipe Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $recipe->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="e.g. Creamy Makhana Curry">
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">URL Slug <span class="text-red-500">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug', $recipe->slug) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="e.g. creamy-makhana-curry">
                        @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="A short catchy description for the recipe card...">{{ old('description', $recipe->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category', $recipe->category) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="e.g. Dessert">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Time</label>
                            <input type="text" name="time" value="{{ old('time', $recipe->time) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="e.g. 30 Mins">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Difficulty</label>
                            <select name="difficulty" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                <option value="Easy" {{ old('difficulty', $recipe->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ old('difficulty', $recipe->difficulty) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ old('difficulty', $recipe->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Ingredients <span class="text-gray-400 font-normal text-xs ml-2">(One ingredient per line)</span></label>
                        <textarea name="ingredients" rows="6" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="2 cups Makhana&#10;1 cup tomato puree&#10;Salt to taste">{{ old('ingredients', is_array($recipe->ingredients) ? implode("\n", $recipe->ingredients) : $recipe->ingredients) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Instructions <span class="text-gray-400 font-normal text-xs ml-2">(One step per line)</span></label>
                        <textarea name="steps" rows="8" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition" required placeholder="Dry roast the makhana for 2-3 minutes...&#10;In a pan, heat some oil or ghee...">{{ old('steps', is_array($recipe->steps) ? implode("\n", $recipe->steps) : $recipe->steps) }}</textarea>
                    </div>

                </div>

                {{-- Sidebar Column --}}
                <div class="space-y-6">
                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-5">
                        <label class="block text-sm font-bold text-gray-800 mb-4">Recipe Image</label>
                        
                        @if($recipe->image)
                            <div class="mb-4 aspect-[4/3] rounded-lg overflow-hidden border border-gray-200 bg-white">
                                <img src="{{ str_starts_with($recipe->image, 'http') ? $recipe->image : asset($recipe->image) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-mg-green/10 file:text-mg-green hover:file:bg-mg-green/20 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-2">Recommended size: 1200x800px. Max 2MB.</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-5 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Status</label>
                            <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                <option value="approved" {{ old('status', $recipe->status) == 'approved' ? 'selected' : '' }}>Published (Approved)</option>
                                <option value="pending" {{ old('status', $recipe->status) == 'pending' ? 'selected' : '' }}>Draft (Pending)</option>
                            </select>
                        </div>

                        <label class="flex items-center gap-3 cursor-pointer mt-4">
                            <input type="checkbox" name="featured" value="1" class="w-5 h-5 text-mg-green border-gray-300 rounded focus:ring-mg-green" {{ old('featured', $recipe->featured) ? 'checked' : '' }}>
                            <div>
                                <span class="block text-sm font-bold text-gray-800">Featured Recipe</span>
                                <span class="block text-xs text-gray-500">Show this recipe prominently on the index page.</span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="px-6 py-4 md:px-8 bg-gray-50/50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.recipes.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-mg-green text-white text-sm font-bold rounded-xl hover:bg-mg-green-dark transition shadow-sm">
                {{ $recipe->exists ? 'Update Recipe' : 'Publish Recipe' }}
            </button>
        </div>
    </form>
</div>

<script>
    // Auto-generate slug from title
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if(titleInput && slugInput && !slugInput.value) {
        titleInput.addEventListener('input', function() {
            slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        });
    }
</script>
@endsection
