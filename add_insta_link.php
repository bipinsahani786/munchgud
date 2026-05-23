<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$page = Page::where('slug', 'home')->first();
if ($page) {
    $sections = is_array($page->sections) ? $page->sections : [];
    
    if (!isset($sections['instagram_video_link'])) {
        $sections['instagram_video_link'] = 'https://www.instagram.com/reel/DYob81csw8z/';
        $page->sections = $sections;
        $page->save();
        echo "Instagram video link added successfully.\n";
    } else {
        echo "Link already exists.\n";
    }
}
