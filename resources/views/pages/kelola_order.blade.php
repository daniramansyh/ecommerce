@extends('templates.nav_adm')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    @if (Session::get('success'))
    <div class="alert alert-success bg-green-500 text-white p-3 rounded-md mb-4">
        {{ Session::get('success') }}
    </div>
    @endif

    <!-- Pencarian -->
    <div class="flex justify-end mb-6">
        <form class="flex items-center space-x-2" action="{{ route('order.data') }}" method="GET">
            <input type="text" name="search" placeholder="Cari Kode Order atau Nama..."
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 w-64">
            <button type="submit"
            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none">Cari</button>
        </form>
        <a href="{{ route('order.export-excel') }}" class="ms-2 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none">Export (Excel)</a>
    </div>

    <!-- Tabel Order -->
    <div class="overflow-x-auto shadow-md rounded-lg bg-white">
        <table class="w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-4 text-center">No</th>
                    <th class="p-4 text-center">Nomor Order</th>
                    <th class="p-4 text-center">Nama Pelanggan</th>
                    <th class="p-4 text-center">Produk</th>
                    <th class="p-4 text-center">Jumlah</th>
                    <th class="p-4 text-center">Total</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($orders as $key => $order)
                <tr class="border-b">
                    <td class="p-4 text-center">{{ ($orders->currentPage() - 1) * $orders->perPage() + ($key + 1) }}</td>
                    <td class="p-4 text-center">{{ $order->order_number }}</td>
                    <td class="p-4 text-center">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="p-4 text-center">{{ $order->product->name }}</td>
                    <td class="p-4 text-center">{{ $order->quantity }}</td>
                    <td class="p-4 text-center">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="p-4 text-center">
                        <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-md">
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="p-4 text-center">
                        <form action="{{ route('order.delete', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                Hapus
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
        {{ $orders->links() }}
    </div>
</div>
@endsection
