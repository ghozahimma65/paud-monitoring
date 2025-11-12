@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">✏️ Edit Data Peserta Didik</h1>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nama Anak</label>
                <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Alamat</label>
                <textarea name="alamat" rows="2"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>
    
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium">Kelas</label>
                    <select name="kelas_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $siswa->kelas_id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <label class="block text-gray-700 font-medium">Wali Murid</label>
                    <select name="wali_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
                        @foreach($wali_murids as $wali)
                            <option value="{{ $wali->id }}" {{ $wali->id == $siswa->wali_id ? 'selected' : '' }}>
                                {{ $wali->nama_wali }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Foto</label>
                <input type="file" name="foto" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-500">
                @if ($siswa->foto)
                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama }}" class="mt-2 w-20 h-20 object-cover rounded">
                @endif
            </div>
    
            <div class="flex justify-end space-x-2">
                <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Perbarui</button>
            </div>
        </form>
</div>
@endsection
