@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">👨‍🏫 Data Guru</h1>
        <a href="{{ route('guru.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Guru</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama Guru</th>
                <th class="p-2">Email</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Jenis Guru</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gurus as $i => $guru)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $i + 1 }}</td>
                <td class="p-2 font-medium">{{ $guru->nama_guru ?? '-' }}</td>
                <td class="p-2">{{ $guru->email ?? '-' }}</td>
                <td class="p-2">{{ $guru->no_hp ?? '-' }}</td>
                <td class="p-2">
                    {{-- Logic tampilan badge --}}
                    @if($guru->jenis_guru == 'guru_kelas')
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Guru Kelas</span>
                    @elseif($guru->jenis_guru == 'shadow_abk')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Shadow ABK</span>
                    @else
                        -
                    @endif
                </td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('guru.edit', $guru->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data guru</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection