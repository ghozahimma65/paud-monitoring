@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">➕ Tambah Guru</h1>

    <form action="{{ route('guru.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nama Guru</label>
            {{-- Name harus 'nama_guru', bukan 'nama' --}}
            <input type="text" name="nama_guru" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jenis Guru</label>
            {{-- Ganti input text 'bidang' jadi Select 'jenis_guru' sesuai Enum DB --}}
            <select name="jenis_guru" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
                <option value="guru_kelas">Guru Kelas</option>
                <option value="shadow_abk">Shadow ABK</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
    </form>
</div>
@endsection