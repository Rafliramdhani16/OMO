<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan</title>
    <style>
        body {
            font-family: Inter, system-ui, sans-serif;
            line-height: 1.5;
            color: #334155;
            max-width: 500px;
            margin: 0 auto;
            padding: 16px;
            background: #f8fafc;
        }
        .container {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 24px;
        }
        .logo img {
            height: 40px;
        }
        .order-info {
            margin: 16px 0;
            padding: 16px;
            background: #f1f5f9;
            border-radius: 8px;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 16px 0;
        }
        .total {
            font-size: 16px;
            color: #0f172a;
        }
        .total-amount {
            font-size: 20px;
            font-weight: 600;
            color: #2563eb;
        }
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">

        <h2 style="margin: 0 0 16px 0; text-align: center;">Pesanan Dikonfirmasi ✨</h2>
        
        <p>Hai {{ $orderDetails->name }},</p>
        <p>Terima kasih atas pesanan Anda. Berikut detail pesanannya:</p>

        <div class="order-info">
            <p style="margin: 0"><strong>ID Pesanan:</strong> {{ $orderDetails->booking_trx_id }}</p>
            <p style="margin: 8px 0"><strong>Tanggal:</strong> {{ $orderDetails->created_at->format('d M Y H:i') }}</p>
            
            <div class="divider"></div>
            
            <p style="margin: 8px 0"><strong>Produk:</strong> {{ $orderDetails->shirt->name }}</p>
            <p style="margin: 8px 0"><strong>Ukuran:</strong> {{ $orderDetails->shirtSize->size }}</p>
            <p style="margin: 8px 0"><strong>Jumlah:</strong> {{ $orderDetails->quantity }}</p>
            <p style="margin: 8px 0"><strong>Harga:</strong> Rp {{ number_format($orderDetails->shirt->price, 0, ',', '.') }}</p>
        </div>

        <div class="divider"></div>

        <div class="total">
            <p style="margin: 8px 0">Subtotal: Rp {{ number_format($orderDetails->sub_total_amount, 0, ',', '.') }}</p>
            @if($orderDetails->discount_amount > 0)
            <p style="margin: 8px 0">Diskon: -Rp {{ number_format($orderDetails->discount_amount, 0, ',', '.') }}</p>
            @endif
            <p style="margin: 8px 0">Pajak (11%): Rp {{ number_format($orderDetails->sub_total_amount * 0.11, 0, ',', '.') }}</p>
            <p class="total-amount" style="margin: 16px 0 0 0">Total: Rp {{ number_format($orderDetails->grand_total_amount, 0, ',', '.') }}</p>
        </div>

        <div class="divider"></div>

        <div class="order-info">
            <p style="margin: 0"><strong>Alamat Pengiriman:</strong><br>
            {{ $orderDetails->address }}<br>
            {{ $orderDetails->city }}, {{ $orderDetails->post_code }}</p>
            <p style="margin: 8px 0 0 0"><strong>Telepon:</strong> {{ $orderDetails->phone }}</p>
        </div>

        <p style="margin: 16px 0 0 0; text-align: center;">Ada pertanyaan? Hubungi tim layanan pelanggan kami.</p>
    </div>

    <div class="footer">
        <p style="margin: 0">Email ini dikirim oleh Tim Oh My outfit</p>
        <p style="margin: 4px 0 0 0">© {{ date('Y') }} Oh My Outfit</p>
    </div>
</body>
</html>