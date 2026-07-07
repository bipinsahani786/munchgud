<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\ShiprocketService;

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

    public function updateShipping(Request $request, Order $order) {
        $request->validate([
            'tracking_number' => 'nullable|string|max:255',
            'courier_name'    => 'nullable|string|max:255',
            'remark'          => 'nullable|string|max:500',
        ]);

        $order->tracking_number = $request->tracking_number;
        $order->courier_name = $request->courier_name;
        $order->remark = $request->remark;
        $order->save();

        return back()->with('success', 'Shipping & Invoice details updated successfully.');
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
        try {
            $this->orderService->cancelOrder($order->id, $request->refund_reason, auth('admin')->id());
            return back()->with('success', 'Refund processed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function invoice(Order $order) {
        $order->load(['items.sku.product', 'user']);
        return view('admin.orders.invoice-print', compact('order'));
    }

    public function printLabel(Order $order) {
        $order->load(['user', 'items.sku']);
        return view('admin.orders.label', compact('order'));
    }

    // -------------------------------------------------------------------------
    // Shiprocket: Push order to Shiprocket (Admin button)
    // -------------------------------------------------------------------------

    public function shiprocketPush(Request $request, Order $order) {
        if ($order->isPushedToShiprocket()) {
            return back()->with('error', 'Order already pushed to Shiprocket (ID: ' . $order->shiprocket_order_id . ')');
        }

        $autoAwb = $request->has('auto_awb');

        try {
            $shiprocket = app(ShiprocketService::class);
            $shiprocket->pushOrder($order, $autoAwb);

            \App\Models\ActivityLog::log(
                'Shiprocket Push',
                'Order pushed to Shiprocket. AWB: ' . ($order->fresh()->awb_code ?? 'Pending'),
                $order,
                auth('admin')->id()
            );

            $msg = 'Order pushed to Shiprocket successfully!';
            if ($order->fresh()->awb_code) {
                $msg .= ' AWB: ' . $order->fresh()->awb_code;
            } else {
                $msg .= ' AWB assignment in progress — click Sync Tracking in a few minutes.';
            }

            return back()->with('success', $msg);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Shiprocket push failed', [
                'order' => $order->order_number,
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Shiprocket push failed: ' . $e->getMessage());
        }
    }

    // -------------------------------------------------------------------------
    // Shiprocket: Sync tracking updates from Shiprocket via AWB
    // -------------------------------------------------------------------------

    public function shiprocketSync(Order $order) {
        $shiprocket = app(ShiprocketService::class);

        // Case 1: Order pushed but no AWB yet → try to assign AWB
        if ($order->isPushedToShiprocket() && !$order->awb_code) {
            try {
                $assigned = $shiprocket->retryAWBAssignment($order);

                if ($assigned) {
                    $order->refresh();
                    return back()->with('success', '✅ AWB assigned successfully! AWB: ' . $order->awb_code . ' via ' . $order->courier_name);
                } else {
                    // Show raw log hint
                    return back()->with('error',
                        'AWB not assigned yet. Shiprocket may still be processing. ' .
                        'Check Shiprocket Dashboard → Orders → ' . $order->order_number .
                        ' and retry in 1-2 minutes.'
                    );
                }
            } catch (\Exception $e) {
                return back()->with('error', 'AWB assignment failed: ' . $e->getMessage());
            }
        }

        // Case 2: AWB exists → sync tracking updates
        if (!$order->awb_code) {
            return back()->with('error', 'No AWB code found. Push order to Shiprocket first.');
        }

        try {
            $synced = $shiprocket->syncTracking($order);

            if ($synced) {
                return back()->with('success', '✅ Tracking synced from Shiprocket successfully!');
            } else {
                return back()->with('error', 'No new tracking data from Shiprocket yet. Try after pickup is done.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}
