<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .customer-details, .order-summary {
            margin-bottom: 20px;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary table th, .order-summary table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-summary table th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Struk Pembayaran</h1>
        <p>Thank you for your purchase!</p>
    </div>

    <div class="customer-details">
        <h3>Customer Details</h3>
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Address:</strong> {{ $address }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
    </div>

    <div class="order-summary">
        <h3>Order Summary</h3>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($items as $item)
                    @php $subtotal = $item['quantity'] * $item['price']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="total">Total</td>
                    <td>${{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
