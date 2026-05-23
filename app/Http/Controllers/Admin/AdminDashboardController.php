<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\ProductSku;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index() {
        $today = today();
        $yesterday = today()->subDay();
        
        $todayRevenue = Order::whereDate('created_at', $today)->where('payment_status','paid')->sum('total');
        $yesterdayRevenue = Order::whereDate('created_at', $yesterday)->where('payment_status','paid')->sum('total');
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $pendingOrders = Order::where('status','pending')->count();
        $totalCustomers = User::count();
        
        // Last 30 days revenue (for chart)
        $revenueChart = Order::where('payment_status','paid')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')->orderBy('date')->get();
        
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')->groupBy('status')->get();
        
        $topProducts = OrderItem::selectRaw('product_name, SUM(quantity) as total_sold')
            ->groupBy('product_name')->orderByDesc('total_sold')->take(5)->get();
            
        $recentOrders = Order::with('user')->latest()->take(10)->get();
        
        $lowStockSkus = ProductSku::where('stock_qty','<=',DB::raw('low_stock_threshold'))
            ->where('stock_qty','>',0)->with('product')->get();
        
        return view('admin.dashboard', compact(
            'todayRevenue','yesterdayRevenue','todayOrders','pendingOrders',
            'totalCustomers','revenueChart','ordersByStatus','topProducts',
            'recentOrders','lowStockSkus'
        ));
    }
}
