<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request) {
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : now()->subDays(30)->startOfDay();
        $endDate = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : now()->endOfDay();

        $metrics = [
            'total_revenue' => Order::whereBetween('created_at', [$startDate, $endDate])->where('payment_status', 'paid')->sum('total'),
            'total_orders' => Order::whereBetween('created_at', [$startDate, $endDate])->count(),
            'average_order_value' => Order::whereBetween('created_at', [$startDate, $endDate])->where('payment_status', 'paid')->avg('total') ?? 0,
            'cancelled_orders' => Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'cancelled')->count()
        ];

        $dailyRevenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->selectRaw('DATE(created_at) as date, SUM(total) as revenue, COUNT(*) as orders')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.reports.index', compact('metrics', 'dailyRevenue', 'startDate', 'endDate'));
    }

    public function export(Request $request) {
        // Placeholder for CSV export logic
        return back()->with('success', 'Report export started. You will be notified when it is ready.');
    }
}
