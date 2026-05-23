<?php

namespace App\Services;

use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    private $razorpay;

    public function __construct()
    {
        $key = \App\Models\Setting::get('razorpay_key');
        $secret = \App\Models\Setting::get('razorpay_secret');
        
        if ($key && $secret) {
            $this->razorpay = new Api($key, $secret);
        }
    }

    public function createRazorpayOrder(float $amount, string $receipt): array
    {
        if (!$this->razorpay) {
            // Mock for local dev if no keys provided
            return ['id' => 'order_mock_' . uniqid(), 'amount' => $amount * 100];
        }

        try {
            $orderData = [
                'receipt'         => $receipt,
                'amount'          => round($amount * 100), // convert to paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            
            $razorpayOrder = $this->razorpay->order->create($orderData);
            return $razorpayOrder->toArray();
        } catch (\Exception $e) {
            Log::error('Razorpay create order failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function verifySignature(string $razorpayOrderId, string $paymentId, string $signature): bool
    {
        $secret = \App\Models\Setting::get('razorpay_secret');
        if (!$secret) {
            return false;
        }
        $expectedSignature = hash_hmac('sha256', $razorpayOrderId . '|' . $paymentId, $secret);
        
        return hash_equals($expectedSignature, $signature);
    }

    public function handleWebhook(array $payload, string $signature): void
    {
        // To be implemented in webhook controller logic
    }

    public function initiateRefund(string $paymentId, float $amount): array
    {
        if (!$this->razorpay) {
            return ['status' => 'mock_refunded'];
        }

        try {
            $refund = $this->razorpay->payment->fetch($paymentId)->refund([
                'amount' => round($amount * 100)
            ]);
            return $refund->toArray();
        } catch (\Exception $e) {
            Log::error('Razorpay refund failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
