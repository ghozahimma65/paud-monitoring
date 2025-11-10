@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-semibold text-gray-700 mb-4">✏️ Edit Guru</h1>

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="nama_guru" value="{{ $guru->nama_guru }}" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Bidang</label>
            <input type="text" name="bidang" value="{{ $guru->bidang }}" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">No HP</label>
            <input type="text" name="no_hp" value="{{ $guru->no_hp }}" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $guru->email }}" class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Perbarui</button>
    </form>
</div>
@endsection
