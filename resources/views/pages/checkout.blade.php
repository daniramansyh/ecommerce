@extends('templates.nav_user')

@section('content_user')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-10">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Form Pemesanan</h1>
        
        <form action="{{ route('order.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Informasi Pengguna -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pengguna</h2>
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium">Nama</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300" readonly>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300" readonly>
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700 font-medium">Alamat</label>
                        <input type="text" name="address" id="address" placeholder="Masukkan alamat lengkap Anda"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Produk</h2>
                <div class="flex flex-col lg:flex-row items-center gap-8 bg-gray-50 p-6 rounded-lg shadow-md">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    
                    <!-- Gambar Produk -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                            class="h-48 object-cover rounded-lg shadow p-3">
                    </div>
                    
                    <!-- Informasi Produk -->
                    <div class="flex flex-col space-y-4 w-full">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Stok Tersedia: {{ $product->stock }}</p>

                        <!-- Kuantitas -->
                        <div class="flex items-center gap-4">
                            <button type="button" 
                                class="w-10 h-10 bg-gray-200 text-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-300 transition"
                                onclick="document.getElementById('quantity').stepDown()">
                                -
                            </button>
                            <input name="quantity" id="quantity" type="number" value="1" min="1" max="{{ $product->stock }}" 
                                class="w-16 border border-gray-300 text-center rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                            <button type="button" 
                                class="w-10 h-10 bg-gray-200 text-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-300 transition"
                                onclick="document.getElementById('quantity').stepUp()">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="radio" name="payment_method" id="payment_bank_transfer" value="Bank Transfer" 
                            class="w-4 h-4 text-blue-600 focus:ring focus:ring-blue-300" required>
                        <label for="payment_bank_transfer" class="ml-2 text-gray-700">Bank Transfer</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="payment_method" id="payment_cod" value="COD (Bayar di Tempat)" 
                            class="w-4 h-4 text-blue-600 focus:ring focus:ring-blue-300">
                        <label for="payment_cod" class="ml-2 text-gray-700">COD (Bayar di Tempat)</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="payment_method" id="payment_ewallet" value="E-Wallet" 
                            class="w-4 h-4 text-blue-600 focus:ring focus:ring-blue-300">
                        <label for="payment_ewallet" class="ml-2 text-gray-700">E-Wallet (OVO, GoPay, Dana)</label>
                    </div>
                </div>
            </div>

            <!-- Metode Pengiriman -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Metode Pengiriman</h2>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="radio" name="shipping_method" id="shipping_standard" value="Standard" 
                            class="w-4 h-4 text-blue-600 focus:ring focus:ring-blue-300" required>
                        <label for="shipping_standard" class="ml-2 text-gray-700">Standard (3-5 Hari)</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="shipping_method" id="shipping_express" value="Express" 
                            class="w-4 h-4 text-blue-600 focus:ring focus:ring-blue-300">
                        <label for="shipping_express" class="ml-2 text-gray-700">Express (1-2 Hari)</label>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-4">
                <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                    Beli Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<!-- Tambahkan script tambahan jika diperlukan -->
@endpush
