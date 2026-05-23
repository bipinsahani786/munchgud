<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Map known slugs to their specific blade files
        $viewMap = [
            'about' => 'pages.about',
            'faq' => 'pages.faq',
            'privacy-policy' => 'pages.privacy',
            'terms' => 'pages.terms',
            'refund-policy' => 'pages.refund',
            'shipping-policy' => 'pages.shipping',
            'story' => 'storefront.story',
            'health-benefits' => 'storefront.health',
        ];

        // If the slug doesn't have a specific view, use a generic one
        $viewName = $viewMap[$slug] ?? 'pages.dynamic';

        return view($viewName, compact('page'));
    }
}
