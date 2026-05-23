<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Page;

$pages = [
    'privacy-policy' => 'resources/views/pages/privacy.blade.php',
    'terms' => 'resources/views/pages/terms.blade.php',
    'refund-policy' => 'resources/views/pages/refund.blade.php',
    'shipping-policy' => 'resources/views/pages/shipping.blade.php',
    'about' => 'resources/views/pages/about.blade.php',
    'faq' => 'resources/views/pages/faq.blade.php',
];

foreach ($pages as $slug => $file) {
    $content = file_get_contents(base_path($file));
    
    // For pages with an <article> tag
    if (preg_match('/<article[^>]*>(.*?)<\/article>/s', $content, $matches)) {
        $html = trim($matches[1]);
        Page::where('slug', $slug)->update(['content' => $html]);
        echo "Updated $slug using <article> tag.\n";
    } 
    // Fallback for FAQ or others which might not use <article>
    elseif (preg_match('/<div class="max-w-3xl mx-auto[^>]*>(.*?)<\/div>\s*<\/div>\s*<\/div>\s*@endsection/s', $content, $matches)) {
        $html = trim($matches[1]);
        Page::where('slug', $slug)->update(['content' => $html]);
        echo "Updated $slug using fallback div regex.\n";
    }
}
