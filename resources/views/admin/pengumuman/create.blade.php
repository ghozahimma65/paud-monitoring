@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-xl font-semibold mb-4 text-gray-700">➕ Tambah Pengumuman</h1>

    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Isi Pengumuman</label>
            <textarea name="isi" rows="4"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>{{ old('isi') }}</textarea>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300">
            </div>
            <div>
                <label class="block text-gray-600 font-medium mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300">
            </div>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1" class="mr-2" checked>
                <span class="text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('pengumuman.index') }}" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
