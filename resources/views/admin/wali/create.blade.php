@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">➕ Tambah Wali Murid</h1>
        <a href="{{ route('wali-murid.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

    {{-- Error Handling --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wali-murid.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 italic">Biodata Orang Tua / Wali</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">Nama Wali</label>
                    <input type="text" name="nama_wali" value="{{ old('nama_wali') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required placeholder="Nama Ayah / Ibu">
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700 font-medium mb-1">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required placeholder="08123...">
                </div>

                <div class="mb-2 md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('alamat') }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200 mb-6 shadow-inner">
            <h2 class="text-lg font-bold text-indigo-800 mb-2 flex items-center gap-2">
                📱 Akun Login Mobile
            </h2>
            <p class="text-xs text-indigo-600 mb-4 font-medium">
                * Berikan Email & Password ini kepada Orang Tua agar mereka bisa login di Aplikasi Mobile.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email Login</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" required placeholder="email@contoh.com">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none" required placeholder="Minimal 6 karakter">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition shadow-md">
                💾 Simpan Data Wali
            </button>
        </div>
    </form>
</div>
@endsection