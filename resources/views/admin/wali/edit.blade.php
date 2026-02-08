@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">✏️ Edit Wali Murid</h1>
        <a href="{{ route('wali-murid.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

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

    {{-- PERHATIKAN: DI SINI KITA PAKAI $data (BUKAN $wali_murid) --}}
    <form action="{{ route('wali-murid.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nama Wali</label>
            {{-- PERHATIKAN: value="{{ old('nama_wali', $data->nama_wali) }}" --}}
            <input type="text" name="nama_wali"
                   value="{{ old('nama_wali', $data->nama_wali) }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                   required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Email (Login)</label>
            <input type="email" name="email" 
                   value="{{ old('email', $data->user?->email ?? '') }}" 
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                   placeholder="Email belum didaftarkan">
        </div>
    
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">No HP</label>
            <input type="text" name="no_hp" 
                   value="{{ old('no_hp', $data->no_hp) }}" 
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Alamat</label>
            <textarea name="alamat" rows="3"
                      class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('alamat', $data->alamat) }}</textarea>
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