<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Page;

$home = Page::where('slug', 'home')->first();
if ($home) {
    $home->sections = [
        'hero_badge' => 'Direct from Bihar Farms',
        'hero_title' => 'Munch Gud.<br><span class="text-mg-green italic">Feel Gud.</span>',
        'hero_subtitle' => 'Premium roasted makhana — high protein, gluten-free, and irresistibly crunchy. Snack smarter with India\'s most loved fox nut brand.',
        'collections_badge' => 'Our Collection',
        'collections_title' => 'Our Star <span class="italic text-mg-green">Flavours</span>',
        'collections_subtitle' => 'Six uniquely crafted flavours. Popped, seasoned, and sealed at peak freshness.',
        'bestseller_badge' => '★ #1 Bestseller',
        'bestseller_title' => 'The One That<br><span class="italic text-mg-green">Started It All</span>',
        'bestseller_desc' => 'Our Peri Peri Makhana is where the MunchGud story began. Bold, spicy, and impossibly addictive — the flavour that launched a revolution.',
        'health_badge' => 'Science-Backed',
        'health_title' => 'Why <span class="italic text-mg-leaf">Makhana</span>?',
        'health_subtitle' => 'The ancient Indian superfood, now in flavours you\'ll actually crave.',
    ];
    $home->save();
}

$story = Page::where('slug', 'story')->first();
if ($story) {
    $story->sections = [
        'hero_badge' => 'Our Genesis',
        'hero_title' => 'Rooted in <span class="italic text-mg-green">Tradition.</span><br>Crafted for <span class="italic text-mg-orange">Today.</span>',
        'hero_subtitle' => 'We are on a mission to bring India\'s ancient superfood to the world, roasted to absolute perfection.',
        'problem_badge' => 'The Snacking Dilemma',
        'problem_desc' => 'Healthy meant boring. Tasty meant unhealthy. We refused to compromise.',
        'problem_title' => 'The spark that started it all.',
        'discovery_title' => 'Then, we looked back at our roots and rediscovered <span class="text-mg-gold italic">Makhana</span>.',
    ];
    $story->save();
}

echo "Sections seeded for Home and Story pages.";
