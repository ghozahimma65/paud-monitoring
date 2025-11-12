@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">📚 Data Peserta Didik</h1>
        <a href="{{ route('siswa.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
           + Tambah Siswa
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-2">#</th>
                <th class="p-2">Nama Anak</th>
                <th class="p-2">Tempat, Tgl Lahir</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Kelas</th>
                <th class="p-2">Wali Murid</th>
                <th class="p-2">Keterangan</th>
                <th class="p-2">Foto</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswas as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $siswa->waliMurid->nama_wali ?? '-' }}</td>
                    <td>{{ $siswa->keterangan ?? '-' }}</td>
                    <td>
                        @if ($siswa->foto)
                            <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->nama }}" width="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-gray-500 p-4">Belum ada data siswa</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
