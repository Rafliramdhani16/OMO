<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Digital</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            color: #333;
            font-size: 12px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .shop-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .invoice-id {
            color: #666;
            margin-bottom: 5px;
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .info-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .info-content {
            color: #555;
            line-height: 1.6;
        }

        .product-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .product-table th {
            text-align: left;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
            font-weight: normal;
            color: #666;
        }

        .product-table td {
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .price-summary {
            margin-left: auto;
            width: 250px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #666;
        }

        .total-row {
            font-weight: bold;
            color: #000;
            font-size: 14px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #333;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 11px;
            margin-top: 10px;
        }

        .status-paid {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background: #fff3e0;
            color: #e65100;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 11px;
            margin-top: 50px;
        }

        .contact {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="shop-name">OMO SHOP</div>
            <div class="invoice-id">No. Invoice: {{ $orderDetails->booking_trx_id }}</div>
            <div>{{ $orderDetails->created_at->format('d F Y, H:i') }} WIB</div>
            <div class="status-badge {{ $orderDetails->is_paid ? 'status-paid' : 'status-pending' }}">
                {{ $orderDetails->is_paid ? 'Sedang dikirim' : 'Menunggu Konfirmasi Pemabyaran' }}
            </div>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <div class="info-title">DATA PEMBELI</div>
                <div class="info-content">
                    {{ $orderDetails->name }}<br>
                    {{ $orderDetails->phone }}<br>
                    {{ $orderDetails->email }}
                </div>
            </div>
            <div class="info-section">
                <div class="info-title">ALAMAT PENGIRIMAN</div>
                <div class="info-content">
                    {{ $orderDetails->address }}<br>
                    {{ $orderDetails->city }}<br>
                    {{ $orderDetails->post_code }}
                </div>
            </div>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th style="text-align: right">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $orderDetails->shirt->name }}</td>
                    <td>{{ $orderDetails->shirtSize->size }}</td>
                    <td>{{ $orderDetails->quantity }}</td>
                    <td style="text-align: right">Rp {{ number_format($orderDetails->shirt->price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="price-summary">
            <div class="price-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($orderDetails->sub_total_amount, 0, ',', '.') }}</span>
            </div>
            @if($orderDetails->discount_amount > 0)
            <div class="price-row">
                <span>Diskon</span>
                <span>- Rp {{ number_format($orderDetails->discount_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="price-row">
                <span>PPN (11%)</span>
                <span>Rp {{ number_format($orderDetails->total_tax, 0, ',', '.') }}</span>
            </div>
            <div class="price-row total-row">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($orderDetails->grand_total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <div>Terima kasih telah berbelanja di OMO Shop</div>
            <div class="contact">WA: 085511515656 | Email: support@omoshop.com</div>
        </div>
    </div>
</body>
</html>