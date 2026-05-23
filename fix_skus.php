<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach(\App\Models\ProductSku::all() as $sku) {
    if(!\Illuminate\Support\Facades\DB::table('product_sku_options')->where('product_sku_id', $sku->id)->exists() && !empty($sku->name)) {
        $type = \App\Models\VariantType::firstOrCreate(['name' => 'Weight']);
        $opt = \App\Models\VariantOption::firstOrCreate(['variant_type_id' => $type->id, 'value' => trim($sku->name)]);
        \Illuminate\Support\Facades\DB::table('product_sku_options')->insert(['product_sku_id' => $sku->id, 'variant_option_id' => $opt->id]);
        echo "Fixed SKU: {$sku->id}\n";
    }
}
