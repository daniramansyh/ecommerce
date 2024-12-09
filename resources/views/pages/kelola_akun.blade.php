@extends('templates.nav_adm')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

    <div class="container mx-auto">
        <div class="flex justify-between mb-6">
            <!-- Form Pencarian Akun -->
            <form class="flex items-center space-x-2" action="{{ route('kelola_akun.data') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Akun..."
                    class="form-input py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 w-64">
                <button type="submit"
                    class="py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none">Cari</button>
            </form>

            <!-- Tombol Tambah Akun -->
            <a href="{{ route('kelola_akun.tambah') }}"
                class="ml-3 py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none">Tambah
                Akun</a>
        </div>

        @if (Session::get('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ Session::get('success') }}
        </div>
        @endif

        <!-- Tabel Akun -->
        <div class="overflow-x-auto shadow-md rounded-lg bg-white">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-1 px-1 border border-gray-300 text-center">No</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Nama</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Email</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Role</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) < 1) <tr>
                        <td colspan="5" class="py-4 text-center">Data Akun Kosong</td>
                        </tr>
                        @else
                        @foreach ($users as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-1 px-1 text-center">{{ ($users->currentPage() - 1) * $users->perpage() + ($index + 1) }}</td>
                            <td class="py-3 px-4 text-center">{{ $item['name'] }}</td>
                            <td class="py-3 px-4 text-center">{{ $item['email'] }}</td>
                            <td class="py-3 px-4 text-center">{{ $item['role'] }}</td>
                            <td class="py-3 px-4 flex justify-center space-x-2">
                                <a href="{{ route('kelola_akun.ubah', $item['id']) }}"
                                    class="py-1 px-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none">Edit</a>
                                <button
                                    class="py-1 px-3 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $item['id'] }}"
                                    data-name="{{ $item['name'] }}">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex justify-end mt-4">
            {{ $users->links() }}
        </div>

        {{-- Modal Delete --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data akun? <b>{{ $item->name}}</b>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="py-1 px-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="py-1 px-3 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    const deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const modal = document.getElementById('exampleModal');
            const form = modal.querySelector('form');
            const modalName = modal.querySelector('#nama_akun');
            modalName.textContent = name;
            form.action = route('kelola_akun.hapus', $item['id']) ;
        });
    });
</script>
@endpush