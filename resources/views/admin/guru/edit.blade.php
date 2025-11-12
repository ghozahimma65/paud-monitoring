@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">✏️ Edit Guru</h1>

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama</label>
                    <input type="text" name="nama"
                        value="{{ old('nama', $guru->name) }}"
                           class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                </div>
    
                <!-- Bidang -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Bidang</label>
                    <input type="text" name="bidang" 
                           value="{{ old('bidang', $guru->bidang) }}" 
                           class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                </div>
    
                <!-- No HP -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">No HP</label>
                    <input type="text" name="no_hp" 
                           value="{{ old('no_hp', $guru->no_hp) }}" 
                           class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                </div>
    
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" 
                           value="{{ old('email', $guru->email) }}" 
                           class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                </div>
    
                <!-- Tombol -->
                <div class="flex justify-end mt-6 gap-3">
                    <a href="{{ route('guru.index') }}" 
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
