@extends('storefront.layout')

@section('title', 'Our Story - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen">
    
    {!! \Illuminate\Support\Facades\Blade::render($page->content ?? '', ['global_settings' => $global_settings ?? []]) !!}

</div>
@endsection
