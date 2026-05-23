<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ActivityLog;

class AdminSkuController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku_code' => 'required|string|unique:product_skus,sku_code',
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0|lte:mrp',
            'stock_qty' => 'required|integer|min:0',
            'is_default' => 'nullable|boolean'
        ]);

        $isDefault = $request->boolean('is_default', false);

        // If this is the first SKU, make it default automatically
        if ($product->skus()->count() === 0) {
            $isDefault = true;
        }

        // If making this default, unset others
        if ($isDefault) {
            $product->skus()->update(['is_default' => false]);
        }

        $sku = $product->skus()->create([
            'sku_code' => $validated['sku_code'],
            'name' => $validated['name'],
            'mrp' => $validated['mrp'],
            'sale_price' => $validated['sale_price'],
            'stock_qty' => $validated['stock_qty'],
            'low_stock_threshold' => 10,
            'is_active' => true,
            'is_default' => $isDefault
        ]);

        // Automatically create and link 'Weight' variant type and option based on the sku name.
        if (!empty($validated['name'])) {
            $variantType = \App\Models\VariantType::firstOrCreate(['name' => 'Weight']);
            $variantOption = \App\Models\VariantOption::firstOrCreate([
                'variant_type_id' => $variantType->id,
                'value' => trim($validated['name'])
            ]);
            
            \Illuminate\Support\Facades\DB::table('product_sku_options')->insert([
                'product_sku_id' => $sku->id,
                'variant_option_id' => $variantOption->id
            ]);
        }

        ActivityLog::log('Created SKU', "Added SKU {$sku->sku_code} to product {$product->name}");

        return redirect()->back()->with('success', 'Variant added successfully.');
    }

    public function update(Request $request, ProductSku $sku)
    {
        $validated = $request->validate([
            'mrp' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0|lte:mrp',
            'stock_qty' => 'required|integer|min:0',
        ]);
        $sku->update($validated);

        ActivityLog::log('Updated SKU', "Updated SKU {$sku->sku_code}");

        return redirect()->back()->with('success', 'Variant updated successfully.');
    }

    public function destroy(ProductSku $sku)
    {
        $product = $sku->product;
        
        // Prevent deleting the last SKU if product is active
        if ($product->skus()->count() <= 1 && $product->is_active) {
            return redirect()->back()->with('error', 'Cannot delete the last variant of an active product.');
        }

        $isDefault = $sku->is_default;
        
        $skuName = $sku->sku_code;
        $sku->delete();

        // If we deleted the default, assign a new default if there are other skus
        if ($isDefault && $product->skus()->count() > 0) {
            $product->skus()->first()->update(['is_default' => true]);
        }

        ActivityLog::log('Deleted SKU', "Deleted SKU {$skuName} from product {$product->name}");

        return redirect()->back()->with('success', 'Variant deleted.');
    }
}
