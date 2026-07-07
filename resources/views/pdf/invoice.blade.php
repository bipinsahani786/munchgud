<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            background: #fff;
            font-size: 11px;
            line-height: 1.4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @media print {
            body { margin: 0; padding: 0; }
            .invoice-page { padding: 0; max-width: none; box-shadow: none; }
            .no-print { display: none !important; }
            @page { margin: 8mm 10mm; size: A4; }
        }

        .invoice-page {
            max-width: 780px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Print Button Bar */
        .print-bar {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 14px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .print-bar p { color: #6c757d; font-size: 13px; font-family: Arial, sans-serif; }
        .print-btn {
            background: #212529;
            color: #fff;
            border: none;
            padding: 9px 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: Arial, sans-serif;
        }
        .print-btn:hover { background: #343a40; }

        /* Logo Area */
        .logo-area {
            text-align: center;
            padding: 10px 0 16px;
        }
        .logo-area img {
            height: 70px;
            object-fit: contain;
        }
        .logo-area .fallback-logo {
            font-size: 28px;
            font-weight: 900;
            color: #16a34a;
            letter-spacing: 1px;
        }

        /* Title */
        .invoice-title {
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #000;
            margin-bottom: 0;
        }
        .invoice-title h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 3px;
            color: #000;
        }

        /* Info Section - 3 columns */
        .info-section {
            display: table;
            width: 100%;
            border-collapse: collapse;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }
        .info-section .info-row {
            display: table-row;
        }
        .info-col {
            display: table-cell;
            vertical-align: top;
            padding: 10px 12px;
            font-size: 11px;
            line-height: 1.6;
            border-bottom: 1px solid #000;
        }
        .info-col:not(:last-child) {
            border-right: 1px solid #000;
        }
        .info-col-header {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            text-decoration: underline;
        }

        /* Invoice Details Table */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .detail-table td {
            padding: 1px 0;
            vertical-align: top;
        }
        .detail-table .dt-label {
            font-weight: 700;
            white-space: nowrap;
            padding-right: 6px;
            text-transform: uppercase;
            font-size: 10px;
        }
        .detail-table .dt-sep {
            width: 12px;
            text-align: center;
            font-weight: 700;
        }
        .detail-table .dt-value {
            font-weight: 400;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .items-table th {
            background: #fff;
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: center;
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: bottom;
        }
        .items-table td {
            border: 1px solid #000;
            padding: 10px 6px;
            vertical-align: top;
        }
        .items-table .col-sno { width: 30px; text-align: center; }
        .items-table .col-product { text-align: left; min-width: 140px; }
        .items-table .col-hsn { width: 50px; text-align: center; }
        .items-table .col-qty { width: 35px; text-align: center; }
        .items-table .col-price { width: 70px; text-align: right; }
        .items-table .col-discount { width: 60px; text-align: right; }
        .items-table .col-taxable { width: 65px; text-align: right; }
        .items-table .col-cgst { width: 65px; text-align: center; }
        .items-table .col-sgst { width: 65px; text-align: center; }
        .items-table .col-total { width: 65px; text-align: right; }

        .product-name { font-weight: 700; font-size: 11px; }
        .product-sku { font-size: 9px; color: #555; margin-top: 2px; }

        /* Net Total Row */
        .net-total-row td {
            border: 1px solid #000;
            padding: 10px 8px;
            font-weight: 700;
            font-size: 12px;
        }

        /* Footer */
        .footer-section {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .footer-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 12px;
            border: 1px solid #000;
            border-top: none;
        }
        .footer-right {
            display: table-cell;
            width: 50%;
            vertical-align: middle;
            padding: 12px;
            text-align: center;
            border: 1px solid #000;
            border-top: none;
            border-left: none;
        }
        .sig-box {
            border: 1px solid #999;
            height: 55px;
            width: 110px;
            margin-bottom: 8px;
        }
        .sig-text {
            font-size: 10px;
            font-weight: 700;
        }
        .reverse-text {
            font-size: 11px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="invoice-page">

    <!-- Print Bar Removed for PDF -->

    @php
        $companyName   = \App\Models\Setting::get('company_name', 'MUNCHGUD');
        $companyLogo   = \App\Models\Setting::get('company_logo', '');
        $companyAddr1  = \App\Models\Setting::get('company_address_1', '');
        $companyAddr2  = \App\Models\Setting::get('company_address_2', '');
        $companyCity   = \App\Models\Setting::get('company_city', '');
        $companyState  = \App\Models\Setting::get('company_state', '');
        $companyPin    = \App\Models\Setting::get('company_pincode', '');
        $storeEmail    = \App\Models\Setting::get('store_email', 'munchgud@gmail.com');
        $storePhone    = \App\Models\Setting::get('store_phone', '');
        $storeWebsite  = \App\Models\Setting::get('store_website', 'www.munchgud.com');
        $gstinNo       = \App\Models\Setting::get('gstin', '');
        $stateCode     = \App\Models\Setting::get('state_code', '');
        $hsnCode       = '19041090';

        $logoBase64 = null;
        if($companyLogo) {
            $path = storage_path('app/public/' . $companyLogo);
            if(file_exists($path) && is_file($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $logoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($path));
            }
        }
    @endphp

    <!-- Logo -->
    <div class="logo-area">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="{{ $companyName }}">
        @else
            <span class="fallback-logo">{{ strtoupper($companyName) }}</span>
        @endif
    </div>

    <!-- TAX INVOICE Title -->
    <div class="invoice-title">
        <h1>TAX INVOICE</h1>
    </div>

    <!-- Three Column Info -->
    <div class="info-section">
        <div class="info-row">
            <!-- Shipping Address -->
            <div class="info-col" style="width:33%;">
                <div class="info-col-header">SHIPPING ADDRESS:</div>
                {{ $order->shipping_name }}<br>
                {{ $order->shipping_line1 }}@if($order->shipping_line2),<br>{{ $order->shipping_line2 }}@endif<br>
                {{ $order->shipping_city }}<br>
                {{ $order->shipping_state }} {{ $order->shipping_pincode }}<br>
                India<br>
                @if($stateCode)State Code : {{ $stateCode }}<br>@endif
                @if($order->shipping_phone)Ph: {{ $order->shipping_phone }}@endif
            </div>

            <!-- Sold By -->
            <div class="info-col" style="width:33%; text-align:center;">
                <div class="info-col-header">SOLD BY:</div>
                <strong>{{ strtoupper($companyName) }}</strong><br>
                @if($companyAddr1){{ $companyAddr1 }}<br>@endif
                @if($companyAddr2){{ $companyAddr2 }}<br>@endif
                @if($companyCity){{ $companyCity }}<br>@endif
                @if($companyPin){{ $companyPin }}<br>@endif
                {{ $companyState }}<br>
                India<br>
                @if($stateCode)State Code : {{ $stateCode }}<br>@endif
                @if($storePhone)Ph: {{ $storePhone }}<br>@endif
                @if($gstinNo)GSTIN No.<br>@endif
                @if($storeWebsite)Website: {{ $storeWebsite }}<br>@endif
                Email: {{ $storeEmail }}
            </div>

            <!-- Invoice Details -->
            <div class="info-col" style="width:34%;">
                <div class="info-col-header">INVOICE DETAILS:</div>
                <table class="detail-table">
                    <tr>
                        <td class="dt-label">Invoice No.</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Invoice Date</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Order No.</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Order Date</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Channel</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->channel ?? 'CUSTOM' }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Shipped By</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->courier_name ?? 'Delhivery Surface' }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">AWB No.</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->tracking_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Payment Method</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->payment_method === 'cod' ? 'COD' : 'prepaid' }}</td>
                    </tr>
                    <tr>
                        <td class="dt-label">Remark</td>
                        <td class="dt-sep">:</td>
                        <td class="dt-value">{{ $order->remark ?? 'No Remark.' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th class="col-sno">S.No.</th>
                <th class="col-product" style="text-align:left;">Product Name</th>
                <th class="col-hsn">HSN</th>
                <th class="col-qty">QTY</th>
                <th class="col-mrp">MRP</th>
                <th class="col-price">Unit<br>Price</th>
                <th class="col-discount">Unit<br>Discount</th>
                <th class="col-taxable">Taxable<br>Value</th>
                <th class="col-cgst">CGST<br><span style="font-weight:400;">(Value | %)</span></th>
                <th class="col-sgst">SGST<br><span style="font-weight:400;">(Value | %)</span></th>
                <th class="col-total">Total<br><span style="font-weight:400;">(Inc. GST)</span></th>
            </tr>
        </thead>
        <tbody>
            @php $sno = 1; @endphp
            @foreach($order->items as $item)
            @php
                $unitPrice = $item->unit_price ?? $item->price ?? 0;
                $totalPrice = $item->total_price ?? ($unitPrice * $item->quantity);
                $mrp = optional($item->sku)->mrp ?? $unitPrice;
                $discountPerUnit = max(0, floatval($mrp) - floatval($unitPrice));
                
                $taxRate = 12; // 12% GST Inclusive
                $taxableValue = $totalPrice / 1.12;
                $totalGst = $totalPrice - $taxableValue;
                $cgst = $totalGst / 2;
                $sgst = $totalGst / 2;
            @endphp
            <tr>
                <td class="col-sno">{{ $sno++ }}</td>
                <td class="col-product">
                    <div class="product-name">{{ $item->product_name }}</div>
                    <div class="product-sku">SKU : {{ $item->sku_code ?? '-' }}</div>
                </td>
                <td class="col-hsn">{{ $hsnCode }}</td>
                <td class="col-qty">{{ $item->quantity }}</td>
                <td class="col-mrp" style="text-decoration: line-through; color: #555;">{{ number_format(floatval($mrp), 2) }}</td>
                <td class="col-price">{{ number_format(floatval($unitPrice), 2) }}</td>
                <td class="col-discount">{{ number_format(floatval($discountPerUnit), 2) }}</td>
                <td class="col-taxable">{{ number_format(floatval($taxableValue), 2) }}</td>
                <td class="col-cgst">{{ number_format(floatval($cgst), 2) }} | 6%</td>
                <td class="col-sgst">{{ number_format(floatval($sgst), 2) }} | 6%</td>
                <td class="col-total">{{ number_format(floatval($totalPrice), 2) }}</td>
            </tr>
            @endforeach

            @if($order->shipping_amount > 0)
            <tr>
                <td class="col-sno"></td>
                <td class="col-product"><div class="product-name">Shipping & Handling</div></td>
                <td class="col-hsn"></td>
                <td class="col-qty"></td>
                <td class="col-mrp"></td>
                <td class="col-price"></td>
                <td class="col-discount"></td>
                <td class="col-taxable">{{ number_format($order->shipping_amount, 2) }}</td>
                <td class="col-cgst">0.00 | 0.00</td>
                <td class="col-sgst">0.00 | 0.00</td>
                <td class="col-total">{{ number_format($order->shipping_amount, 2) }}</td>
            </tr>
            @endif

            @if($order->discount_amount > 0)
            <tr>
                <td class="col-sno"></td>
                <td class="col-product"><div class="product-name">Coupon Discount</div></td>
                <td class="col-hsn"></td>
                <td class="col-qty"></td>
                <td class="col-mrp"></td>
                <td class="col-price"></td>
                <td class="col-discount"></td>
                <td class="col-taxable"></td>
                <td class="col-cgst"></td>
                <td class="col-sgst"></td>
                <td class="col-total">-{{ number_format($order->discount_amount, 2) }}</td>
            </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="net-total-row">
                <td colspan="7" style="border:none; border-left:1px solid #000; border-bottom:1px solid #000;"></td>
                <td colspan="2" style="text-align:right; font-size:12px; letter-spacing:0.5px;">NET TOTAL (In Value)</td>
                <td colspan="2" style="text-align:right; font-size:14px;">Rs. {{ number_format($order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Footer: Signature + Reverse Charge -->
    <div class="footer-section">
        <div class="footer-left">
            <div class="sig-box"></div>
            <div class="sig-text">Authorized Signature for<br>{{ strtoupper($companyName) }}</div>
        </div>
        <div class="footer-right">
            <span class="reverse-text">Whether tax is payable under reverse charge- No</span>
        </div>
    </div>

</div>
</body>
</html>
