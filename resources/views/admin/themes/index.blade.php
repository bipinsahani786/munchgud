@extends('admin.layouts.app')

@section('title', 'Theme Builder')
@section('header', 'Storefront Theme Builder')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Theme Settings Form -->
    <div class="lg:col-span-1 bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Global Design Tokens</h3>
        
        @if(session('success'))
            <div class="mb-4 bg-green-50 text-green-600 p-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.themes.update', $theme->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Theme Name</label>
                <input type="text" disabled value="{{ $theme->name }}" class="w-full px-3 py-2 border rounded-md bg-gray-50 text-gray-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Primary Color</label>
                <div class="flex items-center">
                    <input type="color" name="primary_color" value="{{ old('primary_color', $theme->primary_color) }}" class="h-10 w-14 border rounded-md cursor-pointer">
                    <input type="text" name="primary_color" value="{{ old('primary_color', $theme->primary_color) }}" class="ml-2 w-full px-3 py-2 border rounded-md" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Secondary Color</label>
                <div class="flex items-center">
                    <input type="color" name="secondary_color" value="{{ old('secondary_color', $theme->secondary_color) }}" class="h-10 w-14 border rounded-md cursor-pointer">
                    <input type="text" name="secondary_color" value="{{ old('secondary_color', $theme->secondary_color) }}" class="ml-2 w-full px-3 py-2 border rounded-md">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Background Color</label>
                <div class="flex items-center">
                    <input type="color" name="bg_color" value="{{ old('bg_color', $theme->bg_color) }}" class="h-10 w-14 border rounded-md cursor-pointer">
                    <input type="text" name="bg_color" value="{{ old('bg_color', $theme->bg_color) }}" class="ml-2 w-full px-3 py-2 border rounded-md">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Text Color</label>
                <div class="flex items-center">
                    <input type="color" name="text_color" value="{{ old('text_color', $theme->text_color) }}" class="h-10 w-14 border rounded-md cursor-pointer">
                    <input type="text" name="text_color" value="{{ old('text_color', $theme->text_color) }}" class="ml-2 w-full px-3 py-2 border rounded-md">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading Font Family</label>
                <select name="heading_font" class="w-full px-3 py-2 border rounded-md focus:ring focus:border-green-500">
                    <option value="Playfair Display" {{ $theme->heading_font == 'Playfair Display' ? 'selected' : '' }}>Playfair Display (Serif)</option>
                    <option value="Inter" {{ $theme->heading_font == 'Inter' ? 'selected' : '' }}>Inter (Sans Serif)</option>
                    <option value="Outfit" {{ $theme->heading_font == 'Outfit' ? 'selected' : '' }}>Outfit (Modern Sans)</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition">
                Save Theme Tokens
            </button>
        </form>
    </div>

    <!-- Live Preview -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="bg-gray-100 px-4 py-2 flex items-center border-b border-gray-200">
            <div class="flex space-x-2">
                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                <div class="w-3 h-3 rounded-full bg-green-400"></div>
            </div>
            <div class="mx-auto bg-white px-3 py-1 text-xs rounded text-gray-500 shadow-sm">munchgud.com</div>
        </div>
        
        <div class="flex-1 p-6" style="background-color: {{ $theme->bg_color }}; color: {{ $theme->text_color }};">
            <!-- Simulated Storefront -->
            <header class="flex justify-between items-center mb-10 pb-4 border-b border-opacity-20" style="border-color: {{ $theme->text_color }}">
                <div class="font-bold text-2xl" style="font-family: '{{ $theme->heading_font }}', serif; color: {{ $theme->primary_color }};">
                    MunchGud
                </div>
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="#" class="hover:opacity-75 transition">Shop</a>
                    <a href="#" class="hover:opacity-75 transition">Our Story</a>
                    <a href="#" class="hover:opacity-75 transition">Bulk Orders</a>
                </nav>
            </header>

            <div class="text-center py-16 px-4 rounded-xl mb-10 shadow-lg" style="background-color: {{ $theme->primary_color }}; color: {{ $theme->bg_color }};">
                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="font-family: '{{ $theme->heading_font }}', serif;">
                    Snack Guilt-Free. Feel Gud.
                </h1>
                <p class="mb-8 text-lg opacity-90 max-w-2xl mx-auto">
                    Premium roasted makhana straight from the farms of Bihar. High protein, gluten-free, and irresistibly crunchy.
                </p>
                <button class="px-8 py-3 rounded-full font-bold text-lg shadow-md hover:scale-105 transition transform duration-200" style="background-color: {{ $theme->secondary_color }}; color: white;">
                    Shop Now
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product Card 1 -->
                <div class="rounded-lg p-5 shadow-sm bg-white text-gray-800 transition hover:shadow-md border border-gray-100">
                    <div class="h-40 bg-gray-100 rounded mb-4 flex items-center justify-center text-gray-400">Image</div>
                    <h4 class="font-semibold text-lg" style="color: {{ $theme->primary_color }}">Peri Peri Makhana</h4>
                    <p class="text-sm text-gray-500 mb-3">Spicy & Tangy</p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold">₹199</span>
                        <button class="px-3 py-1 rounded text-sm text-white font-medium" style="background-color: {{ $theme->primary_color }}">Add to Cart</button>
                    </div>
                </div>
                
                <!-- Product Card 2 -->
                <div class="rounded-lg p-5 shadow-sm bg-white text-gray-800 transition hover:shadow-md border border-gray-100">
                    <div class="h-40 bg-gray-100 rounded mb-4 flex items-center justify-center text-gray-400">Image</div>
                    <h4 class="font-semibold text-lg" style="color: {{ $theme->primary_color }}">Cream & Onion</h4>
                    <p class="text-sm text-gray-500 mb-3">Classic Delight</p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold">₹199</span>
                        <button class="px-3 py-1 rounded text-sm text-white font-medium" style="background-color: {{ $theme->primary_color }}">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="rounded-lg p-5 shadow-sm bg-white text-gray-800 transition hover:shadow-md border border-gray-100">
                    <div class="h-40 bg-gray-100 rounded mb-4 flex items-center justify-center text-gray-400">Image</div>
                    <h4 class="font-semibold text-lg" style="color: {{ $theme->primary_color }}">Combo Pack (3)</h4>
                    <p class="text-sm text-gray-500 mb-3">Save 10%</p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold">₹549</span>
                        <button class="px-3 py-1 rounded text-sm text-white font-medium" style="background-color: {{ $theme->secondary_color }}">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to sync color inputs
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('input', function() {
            this.nextElementSibling.value = this.value;
        });
    });
    document.querySelectorAll('input[type="text"]').forEach(textInput => {
        if(textInput.previousElementSibling && textInput.previousElementSibling.type === 'color') {
            textInput.addEventListener('input', function() {
                if(/^#([0-9A-F]{3}){1,2}$/i.test(this.value)) {
                    this.previousElementSibling.value = this.value;
                }
            });
        }
    });
</script>
@endsection
