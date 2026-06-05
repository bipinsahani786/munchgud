<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['name' => 'Home', 'slug' => 'home', 'meta_title' => 'MunchGud - Premium Roasted Makhana', 'meta_description' => 'Premium roasted makhana from Bihar.'],
            ['name' => 'About Us', 'slug' => 'about', 'meta_title' => 'About MunchGud', 'meta_description' => 'Learn more about MunchGud.'],
            ['name' => 'Contact Us', 'slug' => 'contact', 'meta_title' => 'Contact MunchGud', 'meta_description' => 'Get in touch with us.'],
            ['name' => 'Our Story', 'slug' => 'story', 'meta_title' => 'Our Story', 'meta_description' => 'The journey of MunchGud.'],
            ['name' => 'Health Benefits', 'slug' => 'health-benefits', 'meta_title' => 'Health Benefits of Makhana', 'meta_description' => 'Why makhana is good for you.'],
            ['name' => 'FAQ', 'slug' => 'faq', 'meta_title' => 'Frequently Asked Questions', 'meta_description' => 'Answers to common questions.'],
            ['name' => 'Privacy Policy', 'slug' => 'privacy-policy', 'meta_title' => 'Privacy Policy', 'meta_description' => 'Our privacy policy.'],
            ['name' => 'Terms of Service', 'slug' => 'terms', 'meta_title' => 'Terms of Service', 'meta_description' => 'Our terms of service.'],
            ['name' => 'Refund Policy', 'slug' => 'refund-policy', 'meta_title' => 'Refund Policy', 'meta_description' => 'Our refund policy.'],
            ['name' => 'Shipping Policy', 'slug' => 'shipping-policy', 'meta_title' => 'Shipping Policy', 'meta_description' => 'Our shipping policy.'],
            ['name' => 'Cream & Onion Makhana', 'slug' => 'cream-and-onion', 'meta_title' => 'Premium Cream & Onion Roasted Makhana — MunchGud', 'meta_description' => 'Order MunchGud Cream & Onion Roasted Makhana online.'],
            ['name' => 'Peri Peri Makhana', 'slug' => 'peri-peri-makhana', 'meta_title' => 'Premium Spicy Peri Peri Roasted Makhana — MunchGud', 'meta_description' => 'Order MunchGud Spicy Peri Peri Roasted Makhana online.'],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'name' => $page['name'],
                    'meta_title' => $page['meta_title'],
                    'meta_description' => $page['meta_description'],
                    'sections' => [],
                ]
            );
        }
    }
}
