<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label - {{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .label-container {
            background-color: white;
            width: 4in; /* Standard shipping label width */
            min-height: 6in; /* Standard shipping label height */
            padding: 0.25in;
            box-sizing: border-box;
            border: 1px solid #ccc;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -1px;
            color: #000;
        }
        .order-meta {
            text-align: right;
            font-size: 12px;
        }
        .order-meta strong {
            display: block;
            font-size: 14px;
        }
        .section-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 700;
        }
        .address-box {
            border: 1px solid #000;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        .address-box strong {
            font-size: 18px;
            display: block;
            margin-bottom: 4px;
        }
        .from-address {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 20px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        .items-table th {
            background-color: #f9f9f9;
        }
        .barcode-placeholder {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            color: #999;
            font-size: 14px;
            border-radius: 8px;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .label-container {
                border: none;
                box-shadow: none;
                width: 4in;
                height: 6in;
                page-break-after: always;
            }
            .no-print {
                display: none !important;
            }
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #111;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .print-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="print-btn no-print">🖨️ Print Label</button>

    <div class="label-container">
        <div class="header">
            <div class="logo">{{ \App\Models\Setting::get('company_name', 'MUNCHGUD') }}</div>
            <div class="order-meta">
                <strong>#{{ $order->order_number }}</strong>
                {{ $order->created_at->format('M d, Y') }}
            </div>
        </div>

        <div class="section-title">SHIP TO</div>
        <div class="address-box">
            <strong>{{ $order->shipping_name }}</strong>
            {{ $order->shipping_line1 }}<br>
            @if(!empty($order->shipping_line2)) {{ $order->shipping_line2 }}<br> @endif
            {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}<br>
            <div style="margin-top: 8px; font-weight: 600;">Ph: {{ $order->shipping_phone }}</div>
        </div>

        <div class="section-title">RETURN ADDRESS</div>
        <div class="from-address">
            <strong>{{ \App\Models\Setting::get('company_name', 'MunchGud Enterprises') }}</strong><br>
            {{ \App\Models\Setting::get('company_address_1', '123 Snack Avenue, Industrial Area') }}<br>
            @if(\App\Models\Setting::get('company_address_2')) {{ \App\Models\Setting::get('company_address_2') }}<br> @endif
            {{ \App\Models\Setting::get('company_city', 'Patna') }}, {{ \App\Models\Setting::get('company_state', 'Bihar') }} {{ \App\Models\Setting::get('company_pincode', '800001') }}
        </div>

        <div class="section-title">CONTENTS</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Item</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td style="font-weight:bold; text-align:center; width: 40px;">{{ $item->quantity }}</td>
                    <td>{{ $item->product_name }} <span style="color:#666; font-size:10px;">({{ $item->sku_name }})</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Placeholder for barcode if they want to integrate one later -->
        <div class="barcode-placeholder">
            |||||| |||| ||||||| ||| |||<br>
            {{ $order->order_number }}
        </div>
    </div>

    <script>
        // Auto-trigger print dialog when opened
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
