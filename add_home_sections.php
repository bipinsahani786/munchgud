<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if ($page) {
    $sections = is_array($page->sections) ? $page->sections : [];
    
    $newSections = [
        // Marquee
        'marquee_text' => '🌿 No Artificial Flavours✦✨ High Protein✦🔥 Air Roasted✦💚 Gluten Free✦⭐ 5,000+ Happy Snackers✦🇮🇳 Made in India✦🌱 100% Vegan✦♻️ Eco-Friendly Packaging',
        
        // Pillars
        'pillar_1_num' => '0g',
        'pillar_1_title' => 'Oil Used',
        'pillar_1_desc' => 'Pure hot-air roasting technology. Zero oil, maximum crunch, guilt-free snacking at its finest.',
        'pillar_2_num' => '100%',
        'pillar_2_title' => 'Natural',
        'pillar_2_desc' => 'What you see on the label is what\'s inside. No preservatives, no artificial colours, nothing hidden.',
        'pillar_3_num' => '15g',
        'pillar_3_title' => 'Protein per 100g',
        'pillar_3_desc' => 'The perfect post-workout or evening snack. Plant-based protein that actually tastes incredible.',
        
        // Timeline
        'process_badge' => 'The Process',
        'process_title' => 'From Pond <br/><span class="italic text-mg-green font-light">to Pouch</span>',
        'process_image' => '', // Assuming hardcoded image or they can upload
        'process_1_title' => 'Harvested',
        'process_1_desc' => 'Hand-harvested from pristine ponds in Mithilanchal, Bihar.',
        'process_2_title' => 'Sun-Dried',
        'process_2_desc' => 'Naturally sun-dried for 48 hours to lock in nutrients.',
        'process_3_title' => 'Air-Roasted',
        'process_3_desc' => 'Roasted at 180°C with zero oil. Maximum crunch guaranteed.',
        'process_4_title' => 'Seasoned',
        'process_4_desc' => 'Tossed in natural spice blends. No MSG, no artificial colours.',
        'process_5_title' => 'Sealed & Shipped',
        'process_5_desc' => 'Nitrogen-flushed and sealed fresh. Door delivery in 3-5 days.',
        
        // Ingredients Transparency
        'ingredients_title' => 'Know What\'s <span class="italic text-mg-green">Inside</span>',
        'ingredients_subtitle' => 'We believe in complete transparency. What you see on the label is exactly what goes into your body.',
        
        // Combo Packs
        'combo_title' => 'Mix, Match & <span class="italic text-mg-green">Save</span>',
        
        // Reviews
        'reviews_title' => 'Snackers <span class="italic text-mg-leaf">Speak</span>',
        'reviews_subtitle' => '4.9/5 from 2,847 reviews',
        
        // Instagram
        'instagram_badge' => '#MunchGudMoments',
        'instagram_title' => 'Tag Us <a href="https://instagram.com/munchgud" target="_blank" rel="noopener" class="italic text-mg-green hover:underline">@munchgud</a>',
        'instagram_subtitle' => 'Share your snack love and get featured! Join our premium snacking community.',
    ];

    foreach ($newSections as $key => $value) {
        if (!isset($sections[$key])) {
            $sections[$key] = $value;
        }
    }

    $page->sections = $sections;
    $page->save();
    echo "Home page sections updated successfully.\n";
} else {
    echo "Home page not found.\n";
}
