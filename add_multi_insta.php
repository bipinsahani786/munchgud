<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if ($page) {
    $sections = is_array($page->sections) ? $page->sections : [];
    
    $sections['instagram_video_1'] = 'https://www.instagram.com/reel/DYob81csw8z/';
    $sections['instagram_video_2'] = '';
    $sections['instagram_video_3'] = '';
    
    // remove the old one to avoid confusion
    if (isset($sections['instagram_video_link'])) {
        unset($sections['instagram_video_link']);
    }

    $page->sections = $sections;
    $page->save();
    echo "Multiple Instagram video links added successfully.\n";
}
