<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if ($page) {
    $sections = $page->sections ?? [];

    if (!isset($sections['ingredients_list'])) {
        $sections['ingredients_list'] = "Premium Makhana (Fox Nuts)\nHimalayan Pink Salt\nCold-pressed spice extracts\nNatural flavour powders\nLove & good vibes ✨";
    }

    if (!isset($sections['whats_not_list'])) {
        $sections['whats_not_list'] = "No MSG or Ajinomoto\nNo artificial colours\nNo trans fats or palm oil\nNo preservatives — ever\nNo refined sugar";
    }

    if (!isset($sections['bestseller_benefits'])) {
        $sections['bestseller_benefits'] = "Hand-picked lotus seeds from Bihar ponds\nAir-roasted at 180°C for maximum crunch\nBold peri peri seasoning — not for the faint-hearted\nSealed within 2 hours of roasting";
    }

    if (!isset($sections['health_benefits_json'])) {
        $sections['health_benefits_json'] = json_encode([
            ['n'=>'Protein Power', 'v'=>'15g', 'd'=>'Per 100g. Excellent for muscle recovery.'],
            ['n'=>'Antioxidant Rich', 'v'=>'High', 'd'=>'Fights free radicals and aging.'],
            ['n'=>'Glycemic Index', 'v'=>'Low', 'd'=>'Perfect for sustained energy levels.'],
            ['n'=>'Gluten Free', 'v'=>'100%', 'd'=>'Naturally free from gluten.'],
            ['n'=>'Fat Content', 'v'=>'Low', 'd'=>'Significantly lower than popcorn.'],
            ['n'=>'Minerals', 'v'=>'Iron+', 'd'=>'Rich in Magnesium & Potassium.']
        ]);
    }

    if (!isset($sections['combo_packs_json'])) {
        $sections['combo_packs_json'] = json_encode([
            ['n'=>'Starter Pack','it'=>'3 Flavours','p'=>399,'m'=>519,'s'=>120,'pop'=>false],
            ['n'=>'Snack Box','it'=>'6 Flavours','p'=>699,'m'=>999,'s'=>300,'pop'=>true],
            ['n'=>'Family Pack','it'=>'12 Units','p'=>1199,'m'=>1799,'s'=>600,'pop'=>false]
        ]);
    }

    $page->sections = $sections;
    $page->save();
    echo "Seed successful!\n";
} else {
    echo "Home page not found.\n";
}
