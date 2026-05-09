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
                <input type="text" name="nama_wali" value="{{ old('nama_wali', $data->nama_wali) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('alamat', $data->alamat) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Zona Wilayah</label>
                <select name="master_zona_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    <option value="">-- Pilih Zona Wilayah --</option>
                    @foreach ($zonas as $kategori => $zonaGroup)
                        <optgroup label="{{ $kategori }}">
                            @foreach ($zonaGroup as $zona)
                                <option value="{{ $zona->id }}" {{ old('master_zona_id', $data->master_zona_id) == $zona->id ? 'selected' : '' }}>
                                    {{ $zona->nama_zona }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 mb-6 mt-4">
                <h2 class="text-lg font-bold text-yellow-800 mb-2 flex items-center gap-2">🔐 Pengaturan Akun Login</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email Login</label>
                        <input type="email" name="email" value="{{ old('email', $data->user?->email ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                            placeholder="Email belum didaftarkan">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password Baru</label>
                        <input type="password" name="password"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                            placeholder="Kosongkan jika tidak ganti">
                        <p class="text-xs text-gray-500 mt-1">*Isi hanya jika ingin mengganti password login.</p>
                    </div>
                </div>
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