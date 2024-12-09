@extends('templates.nav_user')

@section('content_user')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 m-4">
    <div class="bg-gray-100 min-h-screen py-10 px-6">
        <div class="container mx-auto">
            <!-- Judul Halaman -->
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>
            @if (Session::get('success'))
            <div class="alert alert-success bg-green-500 text-white p-3 rounded-md mb-4">
                {{ Session::get('success') }}
            </div>
            @endif
            <!-- Daftar Produk di Keranjang -->
            <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                <!-- Item Produk -->
                @foreach ($carts as $item)
                <div class="flex items-center justify-between border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <!-- Gambar Produk -->
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                            class="w-20 h-20 object-cover rounded-lg shadow-md">
                        <!-- Detail Produk -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $item->product->name }}</h2>
                            <p class="text-gray-600 text-sm">Rp{{ number_format($item->product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Kontrol Kuantitas -->
                    <div class="flex items-center gap-4">
                        <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition"
                            onclick="document.getElementById('quantity').stepDown()">
                            -
                        </button>
                        <input name="quantity" id="quantity" type="number" value="{{ $item->quantity }}" min="1"
                            class="w-14 text-center border rounded-lg focus:ring-2 focus:ring-gray-300" readonly>
                        <button class="w-10 h-10 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition"
                            onclick="document.getElementById('quantity').stepUp()">
                            +
                        </button>
                    </div>

                    <!-- Total Harga Item -->
                    <p class="text-gray-800 font-medium">
                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    </p>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            <!-- Total dan Checkout -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Total Harga</h2>
                    <p class="text-xl font-bold text-gray-800">
                        Rp. {{ number_format($totalPrice, 2, ',', '.') }}
                    </p>
                </div>
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('home') }}"
                        class="bg-gray-200 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-300 transition">
                        Lanjutkan Belanja
                    </a>
                    <a href="{{ route('order.checkout', $item->product->id) }}" class="bg-gray-800 text-white py-2 px-6 rounded-lg hover:bg-gray-900 transition">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')
@endpush