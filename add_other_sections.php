<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

// --- STORY PAGE ---
$pageStory = Page::firstOrCreate(
    ['slug' => 'story'],
    ['name' => 'Our Story', 'content' => '', 'meta_title' => 'Our Story | MunchGud', 'sections' => []]
);

$storySections = is_array($pageStory->sections) ? $pageStory->sections : [];
$newStorySections = [
    // Hero & Origin & Discovery already seeded, but let's make sure
    'roots_badge' => '📍 Mithilanchal, Bihar',
    'roots_title' => 'Sourced from the Makhana Capital of the World.',
    'roots_desc' => 'Over 80% of the world\'s Makhana is grown in the pristine water bodies of Bihar, India. We bypassed the middlemen and established direct relationships with the generational farmers of the Mithilanchal region.',
    'roots_stat_1_num' => '200+',
    'roots_stat_1_label' => 'Partner Farmers',
    'roots_stat_2_num' => '100%',
    'roots_stat_2_label' => 'Traceable',
    
    'process_title' => 'The Seed to Snack Journey',
    'process_desc' => 'It takes meticulous care and traditional wisdom to craft the perfect crunch.',
    'process_step_1_title' => 'Harvesting',
    'process_step_1_desc' => 'Seeds are hand-collected from the bottom of water lily ponds by skilled divers.',
    'process_step_2_title' => 'Sun-Drying',
    'process_step_2_desc' => 'The raw seeds are cleaned and left to dry naturally under the Indian sun.',
    'process_step_3_title' => 'Popping',
    'process_step_3_desc' => 'Roasted in earthen pots and cracked open manually to reveal the white puff.',
    'process_step_4_title' => 'Flavoring',
    'process_step_4_desc' => 'Slow-air-roasted (never fried) and coated in our proprietary gourmet spice blends.',

    'values_badge' => 'Our DNA',
    'values_title' => 'Our Philosophy',
    'values_1_title' => 'Unapologetically Natural',
    'values_1_desc' => 'If an ingredient sounds like a science experiment, it doesn\'t go in our bags. No artificial colors, flavors, or preservatives. Ever.',
    'values_2_title' => 'Fair Trade Always',
    'values_2_desc' => 'We believe in shared prosperity. By partnering directly with farmers, we ensure they receive a premium price for their painstaking labor.',
    'values_3_title' => 'Flavor First',
    'values_3_desc' => 'Healthy shouldn\'t taste like cardboard. We spend months perfecting our spice blends to ensure every bite is an explosion of flavor.',

    'team_title' => 'The Faces Behind the Crunch',
    'team_desc' => 'A team of snack-enthusiasts, nutrition nerds, and flavor scientists.',
    'team_1_quote' => '"We wanted to build a brand that our own families could trust blindly."',
    'team_1_name' => 'Rahul Sharma',
    'team_1_role' => 'Co-Founder & CEO',
    'team_2_quote' => '"Creating guilt-free snacks that actually taste amazing was the ultimate puzzle."',
    'team_2_name' => 'Priya Patel',
    'team_2_role' => 'Co-Founder & Head of Product',

    'impact_title' => 'Snacking that gives back.',
    'impact_desc' => 'We are committed to leaving the planet better than we found it. From utilizing eco-friendly packaging materials to empowering rural farming communities, sustainability is baked into our DNA.',
    'impact_stat_1_num' => '100%',
    'impact_stat_1_label' => 'Recyclable Pouches',
    'impact_stat_2_num' => '0',
    'impact_stat_2_label' => 'Plastic Waste',
];

foreach ($newStorySections as $key => $value) {
    if (!isset($storySections[$key])) {
        $storySections[$key] = $value;
    }
}
$pageStory->sections = $storySections;
$pageStory->save();

// --- RECIPES PAGE ---
$pageRecipes = Page::firstOrCreate(
    ['slug' => 'recipes'],
    ['name' => 'Recipes', 'content' => '', 'meta_title' => 'Makhana Recipes | MunchGud', 'sections' => []]
);

$recipesSections = is_array($pageRecipes->sections) ? $pageRecipes->sections : [];
$newRecipesSections = [
    'hero_badge' => 'The Culinary Canvas',
    'hero_title' => 'MunchGud<br><span class="italic text-mg-orange">Recipes.</span>',
    'hero_desc' => 'Elevate your culinary game. Discover quick, healthy, and incredibly tasty makhana-based recipes.',
    'banner_title' => 'Got a unique recipe?',
    'banner_desc' => 'Share your own creative way to eat MunchGud. The best recipes will get featured on our website and social media, and you might just win a free box of snacks!',
];

foreach ($newRecipesSections as $key => $value) {
    if (!isset($recipesSections[$key])) {
        $recipesSections[$key] = $value;
    }
}
$pageRecipes->sections = $recipesSections;
$pageRecipes->save();

// --- PRODUCTS PAGE ---
$pageProducts = Page::firstOrCreate(
    ['slug' => 'products'],
    ['name' => 'Products', 'content' => '', 'meta_title' => 'Shop | MunchGud', 'sections' => []]
);

$productsSections = is_array($pageProducts->sections) ? $pageProducts->sections : [];
$newProductsSections = [
    'hero_title' => 'Our <span class="italic text-mg-green">Flavours</span>',
    'hero_desc' => 'Explore our premium range of roasted makhana, packed with protein and crunch.',
];

foreach ($newProductsSections as $key => $value) {
    if (!isset($productsSections[$key])) {
        $productsSections[$key] = $value;
    }
}
$pageProducts->sections = $productsSections;
$pageProducts->save();

echo "Sections seeded for Story, Recipes, and Products pages.\n";
