@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">➕ Tambah Guru</h1>

    <form action="{{ route('guru.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Bidang</label>
            <input type="text" name="bidang" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Telepon</label>
            <input type="text" name="telepon" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Alamat</label>
            <input type="text" name="alamat" 
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Simpan
            </button>
            <a href="{{ route('guru.index') }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
