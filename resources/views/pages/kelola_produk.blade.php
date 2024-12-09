@extends('templates.nav_adm')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="flex justify-end mb-6">
        <!-- Form Pencarian -->
        <form class="flex items-center space-x-2" action="{{ route('produk.data') }}" method="GET">
            @if (Request::get('sort_stock') == 'stock')
            <input type="hidden" name="sort_stock" value="stock">
            @endif
            <input type="text" name="cari" placeholder="Cari Nama Product..."
                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Cari</button>
        </form>

        <!-- Tombol Urutkan Stok -->
        <form action="{{ route('produk.data') }}" method="GET" class="ml-3">
            <input type="hidden" name="sort_stock" value="stock">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Urutkan
                Stok</button>
        </form>

        <!-- Tombol Tambah Product -->
        <a href="{{ route('produk.tambah') }}"
            class="ml-3 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none">+ Tambah</a>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success bg-green-500 text-white p-3 rounded-md mb-4">
        {{ Session::get('success') }}
    </div>
    @endif

    <!-- Tabel Produk -->
    <div class="overflow-x-auto shadow-md rounded-lg bg-white">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-1 px-1 border border-gray-300 text-center">No</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Nama</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Kategori</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Harga</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Stok</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Gambar</th>
                    <th class="py-3 px-4 border border-gray-300 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) < 1) <tr>
                    <td colspan="6" class="py-4 text-center">Data Product Kosong</td>
                    </tr>
                    @else
                    @foreach ($products as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="py-1 px-1 text-center">{{ ($products->currentPage() - 1) * $products->perpage() +
                            ($index + 1) }}</td>
                        <td class="py-3 px-4 text-center">{{ $item['name'] }}</td>
                        <td class="py-3 px-4 text-center">{{ $item['type'] }}</td>
                        <td class="py-3 px-4 text-center">Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-center {{ $item['stock'] <= 3 ? 'bg-red-500 text-white' : '' }} cursor-pointer"
                            onclick="showModalStock('{{ $item['id'] }}', '{{ $item['stock'] }}')">
                            {{ $item['stock'] }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                class="h-32 object-cover">
                        </td>
                        <td class="py-3 px-4 flex justify-center space-x-2">

                            <a href="{{ route('produk.ubah', $item['id']) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Edit</a>
                            <button
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none"
                                onclick="showModalDelete('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end mt-4">
        {{ $products->links() }}
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data Product? <b id="nama_product"></b>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Stok -->
    <div class="modal fade" id="modalEditStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="">
                @csrf
                @method('patch')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Stock Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock" class="form-label">Stock Product:</label>
                        <input type="text" class="form-control" id="stock" name="stock">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function showModalDelete(id, name) {
        $('#nama_product').text(name);
        let url = "{{ route('produk.hapus', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr('action', url);
        $('#exampleModal').modal('show');
    }

    function showModalStock(id, stock) {
        $('#stock').val(stock);
        let url = "{{ route('produk.ubah.stock', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr('action', url);
        $("#modalEditStock").modal('show');
    }

    @if(Session::get('failed'))
        $(document).ready(function() {
            let id = "{{ Session::get('id') }}";
            let stock = "{{ Session::get('stock') }}";
            showModalStock(id, stock);
        })
    @endif
</script>
@endpush