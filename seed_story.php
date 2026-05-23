<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p = App\Models\Page::where('slug', 'story')->first(); 
$s = $p->sections ?? []; 
$default = [
    'team_1_image' => '', 
    'team_1_name' => 'Rahul Sharma', 
    'team_1_role' => 'Co-Founder & CEO', 
    'team_1_quote' => 'We wanted to build a brand that our own families could trust blindly.', 
    'team_2_image' => '', 
    'team_2_name' => 'Priya Patel', 
    'team_2_role' => 'Co-Founder & Head of Product', 
    'team_2_quote' => 'Creating guilt-free snacks that actually taste amazing was the ultimate puzzle.'
]; 

foreach($default as $k => $v) { 
    if(!isset($s[$k])) {
        $s[$k] = $v; 
    }
} 
$p->sections = $s; 
$p->save(); 
echo 'Done';
