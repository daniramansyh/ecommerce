@extends('templates.nav_adm')

@section('content')
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <form action="{{ route('produk.tambah.proses') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Session::get('success'))
            <div class="bg-green-500 text-white p-2 rounded-md mb-4">
                {{ Session::get('success') }}
            </div>
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
            </div>

            <div class="mb-4">
                <label for="type" class="block text-gray-700">Jenis Produk</label>
                <select id="type" name="type"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
                    <option value="Men" {{ old('type')=="Men" ? 'selected' : '' }}>Men</option>
                    <option value="Women" {{ old('type')=="Women" ? 'selected' : '' }}>Women</option>
                    <option value="Kids" {{ old('type')=="Kids" ? 'selected' : '' }}>Kids</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Harga</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
            </div>

            <div class="mb-6">
                <label for="stock" class="block text-gray-700">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk:</label>
                <div class="relative">
                    <input type="file" name="image" id="image" accept="image/*" required
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-gray-300 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                </div>
            </div>


            <button type="submit"
                class="w-full p-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500">
                Kirim
            </button>
        </form>
    </div>
</div>

@endsection