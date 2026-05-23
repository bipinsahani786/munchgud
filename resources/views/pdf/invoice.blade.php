<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        body { 
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; 
            color: #333; 
            margin: 0;
            padding: 0;
        }
        .invoice-box { 
            max-width: 800px; 
            margin: auto; 
            padding: 40px; 
            font-size: 14px; 
            line-height: 24px; 
        }
        table { 
            width: 100%; 
            line-height: inherit; 
            text-align: left; 
            border-collapse: collapse; 
        }
        table td { 
            padding: 8px; 
            vertical-align: top; 
        }
        table tr td:nth-child(2) { 
            text-align: right; 
        }
        table tr.top table td { 
            padding-bottom: 30px; 
        }
        table tr.top table td.title { 
            font-size: 38px; 
            line-height: 45px; 
            color: #059669; /* emerald-600 */
            font-weight: 800; 
            letter-spacing: -1px;
        }
        table tr.information table td { 
            padding-bottom: 40px; 
        }
        .meta-data {
            color: #666;
            font-size: 13px;
        }
        .meta-data strong {
            color: #111;
        }
        table tr.heading td { 
            background: #f3f4f6; 
            border-bottom: 2px solid #e5e7eb; 
            font-weight: bold; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            color: #374151;
            padding: 12px 8px;
        }
        table tr.details td { 
            padding-bottom: 20px; 
        }
        table tr.item td { 
            border-bottom: 1px solid #f3f4f6; 
            padding: 15px 8px;
        }
        table tr.item.last td { 
            border-bottom: none; 
        }
        table tr.total td:nth-child(2) { 
            font-weight: bold; 
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .totals-table {
            width: 300px;
            float: right;
            margin-top: 20px;
        }
        .totals-table td {
            padding: 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        .totals-table tr:last-child td {
            border-bottom: none;
            border-top: 2px solid #111;
            font-size: 18px;
            font-weight: bold;
            color: #111;
        }
        .label {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 80px; 
            text-align: center; 
            color: #9ca3af; 
            font-size: 12px;
            border-top: 1px solid #f3f4f6;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">{{ \App\Models\Setting::get('company_name', 'MUNCHGUD') }}</td>
                            <td class="meta-data">
                                <strong>Invoice #{{ $order->order_number }}</strong><br>
                                Date: {{ $order->created_at->format('M d, Y') }}<br>
                                Status: <span class="label">{{ $order->payment_status }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong style="color:#111; font-size:16px;">From:</strong><br>
                                <span style="color:#4b5563;">
                                    {{ \App\Models\Setting::get('company_name', 'MunchGud Enterprises') }}<br>
                                    {{ \App\Models\Setting::get('company_address_1', '123 Snack Avenue, Industrial Area') }}<br>
                                    @if(\App\Models\Setting::get('company_address_2')) {{ \App\Models\Setting::get('company_address_2') }}<br> @endif
                                    {{ \App\Models\Setting::get('company_city', 'Patna') }}, {{ \App\Models\Setting::get('company_state', 'Bihar') }} {{ \App\Models\Setting::get('company_pincode', '800001') }}
                                </span>
                            </td>
                            <td>
                                <strong style="color:#111; font-size:16px;">Billed To:</strong><br>
                                <span style="color:#4b5563;">
                                    <strong>{{ $order->shipping_name }}</strong><br>
                                    {{ $order->shipping_line1 }}<br>
                                    @if(!empty($order->shipping_line2)) {{ $order->shipping_line2 }}<br> @endif
                                    {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}<br>
                                    Ph: {{ $order->shipping_phone }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Description</td>
                <td class="text-center">Price</td>
                <td class="text-center">Qty</td>
                <td class="text-right">Total</td>
            </tr>

            @foreach($order->items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>
                    <strong style="color:#111;">{{ $item->product_name }}</strong><br>
                    <span style="color:#6b7280; font-size:12px;">{{ $item->sku_name }}</span>
                </td>
                <td class="text-center">₹{{ number_format($item->unit_price ?? $item->price, 2) }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">₹{{ number_format($item->total_price ?? $item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Totals Float Right -->
        <table class="totals-table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="text-right" style="color:#6b7280;">Subtotal</td>
                <td class="text-right">₹{{ number_format($order->subtotal, 2) }}</td>
            </tr>
            @if($order->discount_amount > 0)
            <tr>
                <td class="text-right" style="color:#6b7280;">Discount</td>
                <td class="text-right" style="color:#059669;">-₹{{ number_format($order->discount_amount, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td class="text-right" style="color:#6b7280;">Shipping</td>
                <td class="text-right">₹{{ number_format($order->shipping_amount, 2) }}</td>
            </tr>
            <tr>
                <td class="text-right" style="color:#6b7280;">Tax</td>
                <td class="text-right">₹{{ number_format($order->tax_amount, 2) }}</td>
            </tr>
            <tr>
                <td class="text-right">Grand Total</td>
                <td class="text-right">₹{{ number_format($order->total, 2) }}</td>
            </tr>
        </table>
        
        <div style="clear:both;"></div>

        <div class="footer">
            Thank you for shopping with MunchGud! This is a computer generated invoice and does not require a signature.
        </div>
    </div>
</body>
</html>
