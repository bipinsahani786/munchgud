<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'story')->first();
if ($page) {
    $s = is_array($page->sections) ? $page->sections : [];
    
    // Founder 1
    if (!isset($s['team_1_name'])) $s['team_1_name'] = 'Rahul Sharma';
    if (!isset($s['team_1_role'])) $s['team_1_role'] = 'Co-Founder & CEO';
    if (!isset($s['team_1_quote'])) $s['team_1_quote'] = '"We wanted to build a brand that our own families could trust blindly."';
    if (!isset($s['team_1_is_active'])) $s['team_1_is_active'] = '1';

    // Founder 2
    if (!isset($s['team_2_name'])) $s['team_2_name'] = 'Priya Patel';
    if (!isset($s['team_2_role'])) $s['team_2_role'] = 'Co-Founder & Head of Product';
    if (!isset($s['team_2_quote'])) $s['team_2_quote'] = '"Creating guilt-free snacks that actually taste amazing was the ultimate puzzle."';
    if (!isset($s['team_2_is_active'])) $s['team_2_is_active'] = '1';
    
    $page->sections = $s;
    $page->save();
    
    echo "Founders seeded successfully!\n";
} else {
    echo "Story page not found.\n";
}
