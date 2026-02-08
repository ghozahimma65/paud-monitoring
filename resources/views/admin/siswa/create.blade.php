@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">➕ Tambah Siswa Baru</h1>
        <a href="{{ route('siswa.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Wali Murid (Orang Tua)</label>
            <select name="wali_murid_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                <option value="">-- Pilih Wali Murid --</option>
                @foreach($wali_murids as $wali)
                    <option value="{{ $wali->id }}" {{ old('wali_murid_id') == $wali->id ? 'selected' : '' }}>
                        {{ $wali->nama_wali }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Alamat siswa akan otomatis mengikuti alamat wali murid.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">NIS (Lokal)</label>
                <input type="text" name="nis" value="{{ old('nis') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required placeholder="Contoh: 2024001">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">NISN (Nasional)</label>
                <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Contoh: 0123456789">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nama Siswa</label>
            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-3">
            <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition shadow-md">
                💾 Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection