@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">➕ Tambah Peserta Didik</h1>

    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-2">Nama Anak</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded p-2">
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-600 font-medium mb-2">Alamat</label>
            <textarea name="alamat" class="w-full border border-gray-300 rounded p-2" rows="3"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-600 font-medium mb-2">Kelas</label>
                <select name="kelas_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-2">Wali Murid</label>
                <select name="wali_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- Pilih Wali Murid --</option>
                    @foreach ($wali_murids as $wali)
                        <option value="{{ $wali->id }}">{{ $wali->nama_wali }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-600 font-medium mb-2">Keterangan</label>
            <input type="text" name="keterangan" class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mt-4">
            <label class="block text-gray-600 font-medium mb-2">Foto</label>
            <input type="file" name="foto" class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('siswa.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 mr-2">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
