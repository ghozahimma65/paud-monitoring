@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">✏️ Edit Data Guru</h1>
        <a href="{{ route('guru.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
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

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Biodata Guru</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">Jenis Guru</label>
                    <select name="jenis_guru" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <option value="guru_kelas" {{ $guru->jenis_guru == 'guru_kelas' ? 'selected' : '' }}>Guru Kelas</option>
                        <option value="shadow_abk" {{ $guru->jenis_guru == 'shadow_abk' ? 'selected' : '' }}>Shadow ABK</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">No HP / WA</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">NIP (Opsional)</label>
                    <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>

            <div class="mt-2">
                <label class="block text-gray-700 font-medium mb-1">Alamat Rumah</label>
                <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('alamat', $guru->alamat) }}</textarea>
            </div>
        </div>

        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 mb-6">
            <h2 class="text-lg font-bold text-yellow-800 mb-2 flex items-center gap-2">🔐 Pengaturan Akun Login</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email Login</label>
                    <input type="email" name="email" value="{{ old('email', $guru->email) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-yellow-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password Baru</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-yellow-500 focus:outline-none" placeholder="Kosongkan jika tidak ingin ganti">
                    <p class="text-xs text-gray-500 mt-1">*Isi hanya jika ingin mengganti password login.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition shadow-md">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection