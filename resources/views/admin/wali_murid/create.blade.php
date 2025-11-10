@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Data Wali Murid</h2>

    <form action="{{ route('wali-murid.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Nama Wali</label>
            <input type="text" name="nama_wali" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-gray-700 font-medium">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Alamat</label>
            <textarea name="alamat" rows="3" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('wali-murid.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
