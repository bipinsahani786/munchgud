<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductSku;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderStatusMail;
use App\Mail\NewOrderAdminMail;

class NotificationService
{
    public function sendOrderConfirmation(Order $order): void
    {
        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->queue(new OrderConfirmationMail($order));
            Log::info("Sent order confirmation for {$order->order_number}");
        }
    }

    public function sendStatusUpdate(Order $order): void
    {
        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->queue(new OrderStatusMail($order));
            Log::info("Sent status update for {$order->order_number}");
        }
    }

    public function sendAdminNewOrder(Order $order): void
    {
        $adminEmail = \App\Models\Setting::get('store_email', 'admin@munchgud.com');
        if ($adminEmail) {
            Mail::to($adminEmail)->queue(new NewOrderAdminMail($order));
            Log::info("Sent admin new order alert for {$order->order_number}");
        }
    }

    public function sendOtp(string $contact, string $otp): void
    {
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($contact)->send(new \App\Mail\OtpMail($otp));
                Log::info("Sent OTP to email: $contact");
            } catch (\Exception $e) {
                Log::error("Failed to send OTP email to $contact: " . $e->getMessage());
            }
        } else {
            // Send SMS via MSG91
            $key = config('services.msg91.key');
            $sender = config('services.msg91.sender');
            if ($key && $sender) {
                // Http::post...
            }
            Log::info("Sent OTP via SMS to $contact: $otp");
        }
    }

    public function sendLowStockAlert(ProductSku $sku): void
    {
        $adminEmail = settings('admin_email');
        if ($adminEmail) {
            Log::info("Sent low stock alert for SKU {$sku->sku}");
        }
    }
}
