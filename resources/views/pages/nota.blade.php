<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan</title>

    <style>
        /* Resetting default styles */
        body, h1, h2, p, table, th, td {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .invoice-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .invoice-header h1 {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .invoice-header h2 {
            font-size: 20px;
            font-weight: normal;
            color: #7f8c8d;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-info div {
            width: 48%;
        }

        .invoice-info p {
            font-size: 16px;
            margin: 5px 0;
            line-height: 1.5;
        }

        .invoice-info p span {
            font-weight: bold;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-details th,
        .invoice-details td {
            padding: 10px;
            border: 1px solid #ecf0f1;
            text-align: left;
            font-size: 16px;
        }

        .invoice-details th {
            background-color: #ecf0f1;
            font-weight: bold;
        }

        .invoice-summary {
            text-align: right;
            margin-bottom: 30px;
        }

        .invoice-summary p {
            font-size: 18px;
            margin: 5px 0;
        }

        .invoice-summary p span {
            font-weight: bold;
        }

        .invoice-footer {
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
        }

        .invoice-footer p {
            margin: 5px 0;
        }

        .text-bold {
            font-weight: bold;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
                padding: 20px;
                margin: 20px;
                max-width: 100%;
            }

            .invoice-header h1 {
                font-size: 36px;
            }

            .invoice-header h2 {
                font-size: 20px;
            }

            .invoice-info {
                display: block;
                margin-bottom: 20px;
            }

            .invoice-info div {
                width: 100%;
                margin-bottom: 10px;
            }

            .invoice-details th, .invoice-details td {
                padding: 8px;
                font-size: 14px;
            }

            .invoice-summary p {
                font-size: 16px;
            }

            .invoice-footer {
                font-size: 12px;
            }
        }

        /* Responsive styling for screen */
        @media (max-width: 768px) {
            .invoice-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .invoice-info div {
                width: 100%;
                margin-bottom: 20px;
            }

            .invoice-summary {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Sch.</h1>
            <h2>Nota Pesanan</h2>
        </div>

        <div class="invoice-info">
            <div>
                <p><span>Informasi Pembeli</span></p>
                <p><strong>Nama :</strong> {{ $order['user']['name'] ?? 'Guest' }}</p>
                <p><strong>Alamat :</strong> {{ $order['address'] }}</p>
                <p><strong>Email :</strong> {{ $order['user']['email'] }}</p>
            </div>
            <div>
                <p><span>Informasi Pesanan</span></p>
                <p><strong>No. Pesanan :</strong> {{ $order['order_number'] }}</p>
                <p><strong>Tanggal Pesanan :</strong> {{ $order['created_at'] }}</p>
                <p><strong>Metode Pembayaran :</strong> {{ $order['payment_method'] }}</p>
            </div>
        </div>

        <div class="invoice-details">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>{{ $order['product']['name'] }}</td>
                        <td>{{ $order['quantity'] }}</td>
                        <td>Rp {{ number_format($order['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($order['price'] * $order['quantity'], 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-summary">
            <p><span>Subtotal:</span> Rp {{ number_format($total = ($order['price'] * $order['quantity']), 0, ',', '.') }}</p>
            <p><span>Biaya Pengiriman:</span> Rp {{ number_format($shipping_fee = 5000, 0, ',', '.') }}</p>
            <p class="text-bold"><span>Total:</span> Rp {{ number_format($total + $shipping_fee, 0, ',', '.') }}</p>
        </div>

        <div class="invoice-footer">
            <p>Terima kasih telah berbelanja di toko kami.</p>
            <p>PT. Rsch - Jakarta, Indonesia.</p>
        </div>
    </div>
</body>

</html>
