@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">➕ Tambah Akun</h1>

    <form action="{{ route('akun.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Jenis Akun</label>
            <select name="role" id="roleSelect" class="w-full border-gray-300 rounded-lg p-2">
                <option value="guru">Guru</option>
                <option value="wali_murid">Wali Murid</option>
            </select>
        </div>

        <div id="guruSelect" class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Pilih Guru</label>
            <select name="user_id" class="w-full border-gray-300 rounded-lg p-2">
                @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                @endforeach
            </select>
        </div>

        <div id="waliSelect" class="mb-4 hidden">
            <label class="block text-gray-700 font-medium mb-1">Pilih Wali Murid</label>
            <select name="user_id" class="w-full border-gray-300 rounded-lg p-2">
                @foreach ($waliMurids as $wali)
                    <option value="{{ $wali->id }}">{{ $wali->nama_wali }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('akun.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    if (this.value === 'guru') {
        document.getElementById('guruSelect').classList.remove('hidden');
        document.getElementById('waliSelect').classList.add('hidden');
    } else {
        document.getElementById('waliSelect').classList.remove('hidden');
        document.getElementById('guruSelect').classList.add('hidden');
    }
});
</script>
@endsection
