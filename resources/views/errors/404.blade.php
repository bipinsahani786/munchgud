@extends('storefront.layout')

@section('title', 'Page Not Found - MunchGud')
@section('meta_description', 'The page you are looking for does not exist.')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">
    <h1 class="text-8xl md:text-9xl font-bold text-mg-green mb-4">404</h1>
    <h2 class="text-2xl md:text-3xl font-serif text-mg-dark mb-6">Oops! We couldn't find that page.</h2>
    <p class="text-mg-muted mb-8 max-w-md mx-auto">
        The page you're looking for might have been removed, had its name changed, or is temporarily unavailable.
    </p>
    <a href="{{ url('/') }}" class="btn-primary">
        Return to Homepage
    </a>
</div>
@endsection
