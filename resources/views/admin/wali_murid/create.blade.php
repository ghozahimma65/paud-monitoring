@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">➕ Tambah Wali Murid</h1>

    <form action="{{ route('wali.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nama Wali</label>
            {{-- PENTING: name="nama_wali", bukan "nama" --}}
            <input type="text" name="nama_wali" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Alamat</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" rows="3"></textarea>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
    </form>
</div>
@endsection