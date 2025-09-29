@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-xl font-semibold mb-4 text-gray-700">➕ Tambah Peserta Didik</h1>

    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-600">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600">NIS</label>
            <input type="text" name="nis" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600">Kelas</label>
            <select name="kelas_id" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600">Wali Murid</label>
            <select name="wali_id" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400" required>
                <option value="">-- Pilih Wali Murid --</option>
                @foreach($wali as $w)
                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600">Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-green-400">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('siswa.index') }}" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
