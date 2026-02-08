@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👶 Data Peserta Didik</h1>
        <a href="{{ route('siswa.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-200">
            + Tambah Siswa
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">No</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">NIS / NISN</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">Nama Siswa</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">L/P</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">TTL</th>
                    <th class="py-3 px-4 text-left uppercase font-semibold text-sm">Wali Murid / Alamat</th>
                    <th class="py-3 px-4 text-center uppercase font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($siswas as $index => $siswa)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-700">{{ $siswa->nis ?? '-' }}</div>
                        <div class="text-xs text-gray-500">{{ $siswa->nisn ?? '-' }}</div>
                    </td>

                    <td class="py-3 px-4 font-medium">{{ $siswa->nama_siswa }}</td>
                    
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 rounded text-xs font-bold {{ $siswa->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                            {{ $siswa->jenis_kelamin }}
                        </span>
                    </td>
                    
                    <td class="py-3 px-4 text-sm">
                        {{ $siswa->tempat_lahir }}, {{ date('d-m-Y', strtotime($siswa->tanggal_lahir)) }}
                    </td>

                    <td class="py-3 px-4">
                        @if($siswa->wali_murid)
                            <div class="text-sm font-semibold text-gray-800">{{ $siswa->wali_murid->nama_wali }}</div>
                            {{-- Tampilkan Alamat dari Wali Murid --}}
                            <div class="text-xs text-gray-500 mt-1">🏠 {{ Str::limit($siswa->wali_murid->alamat, 30) }}</div>
                            @if(!empty($siswa->wali_murid->no_hp) && $siswa->wali_murid->no_hp != '-')
                                <div class="text-xs text-gray-500">📞 {{ $siswa->wali_murid->no_hp }}</div>
                            @endif
                        @else
                            <span class="text-red-500 text-xs italic bg-red-100 px-2 py-1 rounded">⚠️ Belum diset</span>
                        @endif
                    </td>

                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-500 hover:text-blue-700 hover:underline transition duration-150">
                                Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:underline transition duration-150">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        Belum ada data siswa.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection