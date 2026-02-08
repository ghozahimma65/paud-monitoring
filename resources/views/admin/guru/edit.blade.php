@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">✏️ Edit Data Guru</h1>
        <a href="{{ route('guru.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

    {{-- Cek Error --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Gagal Menyimpan:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nama Guru</label>
            {{-- Ambil langsung dari tabel guru kolom nama_guru --}}
            <input type="text" name="nama_guru"
                   value="{{ old('nama_guru', $guru->nama_guru) }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                   required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" 
                   value="{{ old('email', $guru->email) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                   required>
        </div>
    
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">No HP</label>
            <input type="text" name="no_hp" 
                   value="{{ old('no_hp', $guru->no_hp) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Jenis Guru</label>
                    <select name="jenis_guru" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        
                        {{-- Opsi 1: Guru Kelas --}}
                        <option value="guru_kelas" 
                            {{ old('jenis_guru', $guru->jenis_guru) == 'guru_kelas' ? 'selected' : '' }}>
                            Guru Kelas
                        </option>
                        
                        {{-- Opsi 2: Shadow ABK --}}
                        <option value="shadow_abk" 
                            {{ old('jenis_guru', $guru->jenis_guru) == 'shadow_abk' ? 'selected' : '' }}>
                            Shadow ABK
                        </option>
        
                    </select>
                </div>

        <div class="flex justify-end mt-6 gap-3">
            <button type="submit" 
                    class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 shadow-md">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection