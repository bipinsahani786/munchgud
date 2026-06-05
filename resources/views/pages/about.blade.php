@extends('storefront.layout')

@section('title', isset($page) && $page->meta_title ? $page->meta_title : 'Our Story - MunchGud')
@section('meta_description', isset($page) && $page->meta_description ? $page->meta_description : 'Learn more about MunchGud, our mission to provide high quality healthy roasted makhana snacks.')
@section('meta_keywords', isset($page) && $page->meta_keywords ? $page->meta_keywords : 'about munchgud, our mission, roasted makhana, healthy snacks')

@section('content')
<div class="bg-munch-cream min-h-screen">
    
    {!! \Illuminate\Support\Facades\Blade::render($page->content ?? '', ['global_settings' => $global_settings ?? []]) !!}

</div>
@endsection
