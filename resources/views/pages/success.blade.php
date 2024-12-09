<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
        <!-- Header Nota -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mx-auto mb-2">
            <h1 class="text-2xl font-bold">Nota Pesanan</h1>
        </div>

        <!-- Informasi Pesanan -->
        <div class="mb-6 grid grid-cols-2 gap-4">
            <div>
                <h2 class="font-semibold mb-2">Informasi Pembeli</h2>
                <p><strong>Nama :</strong> {{ $order['user']['name'] ?? 'Guest' }}</p>
                <p><strong>Alamat :</strong> {{ $order['address'] }}</p>
                <p><strong>Email :</strong> {{ $order['user']['email'] }}</p>
            </div>

            <div>
                <h2 class="font-semibold mb-2">Informasi Pesanan</h2>
                <p><strong>No. Pesanan :</strong> {{ $order['order_number'] }}</p>
                <p><strong>Tanggal Pesanan :</strong> {{ $order['created_at'] }}</p>
                <p><strong>Metode Pembayaran :</strong> {{ $order['payment_method'] }}</p>
            </div>
        </div>

        <!-- Rincian Produk -->
        <h2 class="font-semibold text-lg mb-2">Rincian Pesanan</h2>
        <table class="w-full border-collapse border border-gray-200 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 p-2 text-left">No</th>
                    <th class="border border-gray-200 p-2 text-left">Produk</th>
                    <th class="border border-gray-200 p-2 text-center">Jumlah</th>
                    <th class="border border-gray-200 p-2 text-right">Harga</th>
                    <th class="border border-gray-200 p-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-200 p-2">1.</td>
                    <td class="border border-gray-200 p-2">{{ $order['product']['name'] }}</td>
                    <td class="border border-gray-200 p-2 text-center">{{ $order['quantity'] }}</td>
                    <td class="border border-gray-200 p-2 text-right">Rp {{ number_format($order['price'], 0, ',', '.') }}</td>
                    <td class="border border-gray-200 p-2 text-right">Rp {{ number_format($order['price'] * $order['quantity'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="text-right mb-6">
            <p><strong>Subtotal:</strong> Rp {{ number_format($total = ($order['price'] * $order['quantity']), 0, ',', '.') }}</p>
            <p><strong>Biaya Pengiriman:</strong> Rp {{ number_format($shipping_fee = 5000, 0, ',', '.') }}</p>
            <p class="text-xl font-bold"><strong>Total:</strong> Rp {{ number_format($total + $shipping_fee, 0, ',', '.') }}</p>
        </div>

        <!-- Informasi Footer -->
        <div class="text-sm text-gray-600">
            <p>Terima kasih telah berbelanja di toko kami.</p>
            <p>PT. Rsch - Jakarta, Indonesia.</p>
        </div>
        <center>
            <a href="{{ route('order.download', $order->id) }}" class="bg-gray-800 text-white py-2 px-6 rounded-lg hover:bg-gray-900 transition">Export to PDF</a>
            <a href="{{ route('home') }}" class="bg-gray-800 text-white py-2 px-6 rounded-lg hover:bg-gray-900 transition">Kembali</a>
        </center>
    </div>
</body>

</html>
