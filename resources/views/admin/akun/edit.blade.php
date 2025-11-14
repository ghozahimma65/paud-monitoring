@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">✏️ Edit Akun</h1>

    <form action="{{ route('akun.update', $akun->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $akun->name) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $akun->email) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Role</label>
            <select name="role" class="w-full border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                <option value="guru" {{ $akun->role == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="wali_murid" {{ $akun->role == 'wali_murid' ? 'selected' : '' }}>Wali Murid</option>
                <option value="admin" {{ $akun->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('akun.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
