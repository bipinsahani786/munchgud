<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
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
            'cream-and-onion' => 'storefront.cream-and-onion',
            'peri-peri-makhana' => 'storefront.peri-peri',
        ];

        $page = Page::where('slug', $slug)->where('is_active', true)->first();
        
        if (!$page) {
            // If the page isn't in the database but we have a hardcoded view for it, render it anyway.
            if (isset($viewMap[$slug])) {
                return view($viewMap[$slug]);
            }
            abort(404);
        }

        // If the slug doesn't have a specific view, use a generic one
        $viewName = $viewMap[$slug] ?? 'pages.dynamic';

        return view($viewName, compact('page'));
    }
}
