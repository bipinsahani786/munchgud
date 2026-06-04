<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\OrderService;

class AdminOrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function index(Request $request) {
        $query = Order::with('user');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->where('order_number', 'like', "%{$request->search}%");
        }
        
        $orders = $query->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $order->load(['items.sku', 'user', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order) {
        $request->validate(['status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled']);
        
        if ($request->status === 'cancelled') {
            if (!$request->filled('cancelled_reason')) {
                $request->merge(['cancelled_reason' => 'Cancelled by Admin']);
            }
            return $this->cancel($request, $order);
        }

        try {
            $this->orderService->updateStatus($order->id, $request->status, auth('admin')->id());
            return back()->with('success', 'Order status updated.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function markPayment(Request $request, Order $order) {
        $request->validate(['payment_status' => 'required|in:pending,paid,failed,refunded']);
        
        $order->payment_status = $request->payment_status;
        $order->save();
        
        \App\Models\ActivityLog::log('Payment Status Updated', "Marked payment as {$request->payment_status}", $order, auth('admin')->id());
        
        return back()->with('success', 'Payment status updated successfully.');
    }

    public function addTracking(Request $request, Order $order) {
        $request->validate([
            'status' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        \App\Models\OrderTracking::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'location' => $request->location,
            'description' => $request->description,
            'tracked_at' => now(),
        ]);
        
        return back()->with('success', 'Location tracking point added successfully.');
    }

    public function cancel(Request $request, Order $order) {
        $request->validate(['cancelled_reason' => 'required|string']);
        try {
            $this->orderService->cancelOrder($order->id, $request->cancelled_reason, auth('admin')->id());
            return back()->with('success', 'Order cancelled and refunded (if applicable).');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function refund(Request $request, Order $order) {
        $request->validate(['refund_amount' => 'required|numeric|min:0', 'refund_reason' => 'required|string']);
        // Simplified refund logic
        try {
            $this->orderService->cancelOrder($order->id, $request->refund_reason, auth('admin')->id());
            return back()->with('success', 'Refund processed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function invoice(Order $order) {
        $filename = 'invoices/INV-' . $order->order_number . '.pdf';
        
        if (!\Illuminate\Support\Facades\Storage::exists($filename)) {
            return back()->with('error', 'Invoice not generated yet.');
        }
        
        return \Illuminate\Support\Facades\Storage::download($filename);
    }

    public function printLabel(Order $order) {
        $order->load(['user', 'items.sku']);
        return view('admin.orders.label', compact('order'));
    }
}
