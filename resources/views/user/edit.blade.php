@extends('templates.nav_adm')

@section('content')

<div class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <form action="{{ route('kelola_akun.ubah.proses', $users['id']) }}" method="POST">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::get('success'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ Session::get('success') }}
            </div>
        @endif

        <!-- Nama Input -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama</label>
            <input type="text" id="name" name="name" value="{{ $users['name'] }}" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Email Input -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="text" id="email" name="email" value="{{ $users['email'] }}" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Role Select -->
        <div class="mb-4">
            <label for="role" class="block text-gray-700">Tipe Pengguna</label>
            <select id="role" name="role" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
                <option selected disabled hidden>Pilih</option>
                <option value="Admin" {{ $users['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Kasir" {{ $users['role'] == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="User" {{ $users['role'] == 'User' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500">Kirim</button>
    </form>
</div>

@endsection
