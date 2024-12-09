@extends('templates.nav_user')

@section('content_user')
<div class="p-6">
    <div class="border-2 border-gray-200 rounded-lg bg-gradient-to-b from-gray-50 to-gray-100 shadow-lg">
        @if (Session::get('success'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ Session::get('success') }}
            </div>
            @endif
        <!-- Produk Section -->
        <form action="{{ route('cart.add') }}" method="POST"
            class="bg-white flex flex-col lg:flex-row items-center gap-16 rounded-lg shadow-md p-8">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <!-- Gambar Produk -->
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-96 h-96 object-cover rounded-lg shadow-md p-3">
            </div>

            <!-- Detail Produk -->
            <div class="flex flex-col space-y-6 w-full lg:w-1/2">
                <!-- Nama Produk -->
                <h1 class="text-4xl font-extrabold text-gray-800">
                    {{ $product->name }}
                </h1>

                <!-- Rating -->
                <div class="flex items-center">
                    @for ($i = 0; $i < 5; $i++) <i class="fas fa-star text-yellow-400"></i>
                        @endfor
                        <span class="ml-2 text-sm text-gray-500">(27 ulasan)</span>
                </div>

                <!-- Harga -->
                <div class="text-3xl font-semibold text-gray-700">
                    Rp. {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <!-- Kontrol Kuantitas -->
                <div class="flex items-center gap-4">
                    <button type="button" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition"
                        onclick="document.getElementById('quantity').stepDown()">
                        -
                    </button>
                    <input name="quantity" id="quantity" type="number" value="1" min="1" max="{{ $product->stock }}"
                        class="w-14 text-center border rounded-lg focus:ring-2 focus:ring-gray-300" readonly>
                    <button type="button" class="w-10 h-10 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition"
                        onclick="document.getElementById('quantity').stepUp()">
                        +
                    </button>
                    <span class="text-sm text-red-500">Stok tersisa: {{ $product->stock }}</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg shadow-lg hover:bg-blue-700 transition">
                        Tambahkan ke Keranjang
                    </button>
                    <a href="{{ route('order.checkout', $product->id) }}"
                        class="w-full bg-gray-100 text-center text-gray-700 py-3 rounded-lg border hover:bg-gray-200 transition">
                        Beli Sekarang
                    </a>
                </div>

                <!-- Tombol Lainnya -->
                <div class="flex justify-around text-gray-600 text-sm space-x-4">
                    <a class="flex items-center gap-2 hover:text-gray-800 transition">
                        <i class="fas fa-comments"></i> Chat
                    </a>
                    <a class="flex items-center gap-2 hover:text-gray-800 transition">
                        <i class="fas fa-heart"></i> Wishlist
                    </a>
                    <a class="flex items-center gap-2 hover:text-gray-800 transition">
                        <i class="fas fa-share-alt"></i> Share
                    </a>
                </div>
            </div>
        </form>

        <!-- Informasi Tambahan -->
        <div class="mt-10 bg-white p-8 rounded-lg shadow-md space-y-8">
            <!-- Tab Menu -->
            <ul class="flex border-b pb-2 space-x-8">
                <li>
                    <a href="#" class="text-lg font-semibold text-gray-700 border-b-2 border-gray-700 pb-2">
                        Detail
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="text-lg font-semibold text-gray-600 hover:text-gray-700 hover:border-b-2 hover:border-gray-700 pb-2">
                        Spesifikasi
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="text-lg font-semibold text-gray-600 hover:text-gray-700 hover:border-b-2 hover:border-gray-700 pb-2">
                        Info Penting
                    </a>
                </li>
            </ul>

            <!-- Detail Produk -->
            <div class="space-y-4 text-gray-700">
                <div>
                    <strong>Kondisi:</strong> Bekas
                </div>
                <div>
                    <strong>Min. Pemesanan:</strong> 1 Buah
                </div>
                <div>
                    <strong>Etalase:</strong> Semua Etalase
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-4 text-gray-600">
                <p>Selamat datang di <span class="font-semibold text-gray-800">RSch - Jakarta</span>
                    <span class="text-yellow-500">😊🙏</span>
                </p>
                <p class="text-yellow-600">
                    ⚠️ Harap tanyakan stok sebelum order ya kak ⚠️
                </p>
                <p class="text-yellow-600">
                    ⚠️ Mohon baca keterangan sebelum membeli... Membeli = Membaca = Setuju ⚠️
                </p>
                <p>Komplain dan info masa garansi = Hubungi Admin</p>
                <a href="#" class="text-gray-700 font-medium hover:underline inline-block">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush