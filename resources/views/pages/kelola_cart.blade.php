@extends('templates.nav_adm')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    @if (Session::get('success'))
    <div class="alert alert-success bg-green-500 text-white p-3 rounded-md mb-4">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="flex justify-end mb-6">
        <!-- Form Pencarian -->
        <form class="flex items-center space-x-2" action="{{ route('cart.data') }}" method="GET">
            <input type="text" name="cari" placeholder="Cari Nama Pengguna Cart..."
                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Cari</button>
        </form>
    </div>

    <!-- Tabel Cart -->
    <div class="overflow-x-auto shadow-md rounded-lg bg-white">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Produk</th>
                    <th class="p-4 text-left">Harga</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($carts as $key => $item)
                <tr class="border-b">
                    <td class="p-4">{{ ($carts->currentPage() - 1) * $carts->perPage() + ($key + 1) }}</td>
                    <td class="p-4">{{ $item->user->name ?? 'Guest' }}</td>
                    <td class="p-4">{{ $item->product->name }}</td>
                    <td class="p-4">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-4">{{ $item->quantity }}</td>
                    <td class="p-4">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                <i class="fas fa-trash">Hapus</i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end mt-4">
        {{ $carts->links() }}
    </div>  
</div>

@endsection