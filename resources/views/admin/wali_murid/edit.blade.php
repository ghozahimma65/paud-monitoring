@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">✏️ Edit Data Wali Murid</h1>

    <form action="{{ route('wali-murid.update', $wali_murid->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Wali -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Nama Wali</label>
            <input type="text" name="nama_wali" 
                   value="{{ old('nama_wali', $wali_murid->nama_wali) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Email</label>
            <input type="email" name="email" 
                   value="{{ old('email', $wali_murid->email) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">No HP</label>
            <input type="text" name="no_hp" 
                   value="{{ old('no_hp', $wali_murid->no_hp) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Alamat</label>
            <textarea name="alamat" rows="3"
                      class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">{{ old('alamat', $wali_murid->alamat) }}</textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('wali-murid.index') }}" 
               class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600 transition">
                Batal
            </a>
            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
