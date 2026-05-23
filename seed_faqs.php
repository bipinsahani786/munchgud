<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$faqs = [
    [
        'question' => 'Are MunchGud makhanas suitable for weight loss?', 
        'answer' => 'Absolutely! Air-roasted with zero oil, only 89 calories per 30g, high in fiber and protein — the perfect weight-loss snack.', 
        'category' => 'product'
    ], 
    [
        'question' => 'What is the shelf life?', 
        'answer' => '6 months from manufacturing. Best consumed within 15 days of opening for optimal crunch.', 
        'category' => 'product'
    ], 
    [
        'question' => 'Do you ship pan-India?', 
        'answer' => 'Yes! Free shipping on orders above 499. Standard delivery 3-5 business days across India.', 
        'category' => 'shipping'
    ]
];

if(\App\Models\Faq::count() == 0) {
    foreach($faqs as $i => $faq) { 
        $faq['sort_order'] = $i; 
        \App\Models\Faq::create($faq); 
    }
    echo "Seeded FAQs successfully.\n";
} else {
    echo "FAQs already exist.\n";
}
