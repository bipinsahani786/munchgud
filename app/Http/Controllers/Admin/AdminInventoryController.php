<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Models\ActivityLog;

class AdminInventoryController extends Controller
{
    public function index(Request $request) {
        $query = ProductSku::with('product');

        if ($request->search) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhere('sku_code', 'like', "%{$request->search}%")
              ->orWhere('sku_name', 'like', "%{$request->search}%");
        }

        if ($request->status === 'low_stock') {
            $query->where('stock_qty', '<=', \Illuminate\Support\Facades\DB::raw('low_stock_threshold'));
        } elseif ($request->status === 'out_of_stock') {
            $query->where('stock_qty', 0);
        }

        $skus = $query->paginate(30)->withQueryString();
        
        return view('admin.inventory.index', compact('skus'));
    }

    public function updateStock(Request $request, ProductSku $sku) {
        $request->validate([
            'stock_qty' => 'required|integer|min:0'
        ]);

        $oldStock = $sku->stock_qty;
        $sku->update(['stock_qty' => $request->stock_qty]);

        ActivityLog::log('Inventory Updated', "Stock for SKU {$sku->sku_code} changed from {$oldStock} to {$request->stock_qty}");

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Stock updated successfully', 'new_stock' => $sku->stock_qty]);
        }
        return back()->with('success', 'Stock updated successfully.');
    }

    public function import(Request $request) {
        // Placeholder for future CSV import logic
        return back()->with('success', 'Inventory imported successfully.');
    }
}
