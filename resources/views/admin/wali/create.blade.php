@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow w-1/2 mx-auto">
    <h2 class="text-xl font-semibold mb-4">Tambah Wali Murid</h2>

    <form action="{{ route('wali.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Alamat</label>
            <input type="text" name="alamat" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Lokasi Latitude</label>
            <input type="text" name="lokasi_lat" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Lokasi Longitude</label>
            <input type="text" name="lokasi_lng" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('wali.index') }}" class="ml-2 px-4 py-2 bg-gray-300 rounded">Batal</a>
    </form>
</div>
@endsection
