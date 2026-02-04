@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">👶 Tambah Siswa</h1>

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf

        {{-- Dropdown Pilih Wali Murid --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Wali Murid (Orang Tua)</label>
            <select name="wali_id" class="w-full border rounded px-3 py-2 bg-gray-50 focus:ring focus:ring-green-300" required>
                <option value="">-- Pilih Orang Tua --</option>
                @foreach($walis as $wali)
                    <option value="{{ $wali->id }}">{{ $wali->nama_wali }} - ({{ Str::limit($wali->alamat, 30) }})</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Jika nama orang tua tidak ada, tambahkan dulu di menu Wali Murid.</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2" placeholder="Contoh: Madiun" required>
            </div>
            <div>
                <label class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jenis Kelamin</label>
            <div class="flex gap-4 mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="L" class="text-green-600" required>
                    <span class="ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="P" class="text-green-600">
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 w-full">Simpan Data Siswa</button>
    </form>
</div>
@endsection