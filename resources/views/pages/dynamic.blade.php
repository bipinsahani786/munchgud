@extends('storefront.layout')

@section('title', isset($page) && $page->meta_title ? $page->meta_title : ($page->name . ' — MunchGud'))
@section('meta_description', isset($page) && $page->meta_description ? $page->meta_description : 'Read ' . $page->name . ' on MunchGud. Premium roasted makhana and healthy snacks.')
@section('meta_keywords', isset($page) && $page->meta_keywords ? $page->meta_keywords : 'munchgud, makhana, healthy snacks')

@section('content')
<div class="bg-mg-cream min-h-screen py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12 sm:mb-16">
            <h1 class="font-heading text-4xl sm:text-6xl font-black text-mg-dark mb-4 tracking-tight">
                {{ $page->name }}
            </h1>
            <div class="w-16 h-1 bg-mg-green mx-auto rounded-full"></div>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-gray-100/80 prose prose-mg max-w-none">
            @if($page->content)
                {!! $page->content !!}
            @else
                <div class="text-center py-12 text-gray-400">
                    <p>Page content is currently being updated.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
