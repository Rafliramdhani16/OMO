<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: #f8fafc;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .content {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .order-details {
            background: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Order Confirmation</h1>
        <p>Thank you for your purchase!</p>
    </div>

    <div class="content">
        <p>Dear {{ $orderDetails->name }},</p>
        
        <p>Thank you for shopping with us. Your order has been successfully processed. Below are your order details:</p>

        <div class="order-details">
            <h3>Order Information</h3>
            <p><strong>Order ID:</strong> {{ $orderDetails->booking_trx_id }}</p>
            <p><strong>Order Date:</strong> {{ $orderDetails->created_at->format('d M Y H:i') }}</p>
            
            <h4>Product Details</h4>
            <p><strong>Item:</strong> {{ $orderDetails->shirt->name }}</p>
            <p><strong>Size:</strong> {{ $orderDetails->shirtSize->size }}</p>
            <p><strong>Quantity:</strong> {{ $orderDetails->quantity }}</p>
            <p><strong>Price per Item:</strong> Rp {{ number_format($orderDetails->shirt->price, 0, ',', '.') }}</p>
        </div>

        <div class="order-details">
            <h4>Shipping Information</h4>
            <p><strong>Shipping Address:</strong><br>
            {{ $orderDetails->address }}<br>
            {{ $orderDetails->city }}, {{ $orderDetails->post_code }}</p>
            <p><strong>Phone:</strong> {{ $orderDetails->phone }}</p>
        </div>

        <div class="total">
            <p><strong>Subtotal:</strong> Rp {{ number_format($orderDetails->sub_total_amount, 0, ',', '.') }}</p>
            @if($orderDetails->discount_amount > 0)
                <p><strong>Discount:</strong> - Rp {{ number_format($orderDetails->discount_amount, 0, ',', '.') }}</p>
            @endif
            <p><strong>Tax (11%):</strong> Rp {{ number_format($orderDetails->sub_total_amount * 0.11, 0, ',', '.') }}</p>
            <p><strong>Total Amount:</strong> Rp {{ number_format($orderDetails->grand_total_amount, 0, ',', '.') }}</p>
        </div>

        <p>A detailed PDF report of your order is attached to this email. You can also download it from your order details page on our website.</p>

        <p>If you have any questions about your order, please don't hesitate to contact our customer service team.</p>

        <p>Best regards,<br>
        Your Shop Team</p>
    </div>

    <div class="footer">
        <p>This email was sent by Your Shop Name</p>
        <p>© {{ date('Y') }} Your Shop Name. All rights reserved.</p>
    </div>
</body>
</html>