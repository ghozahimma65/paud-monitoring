@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-3">📚 Data Guru</h4>

    <a href="{{ route('guru.create') }}" class="btn btn-success mb-3">+ Tambah Guru</a>

    <table class="table table-bordered">
        <thead class="table-success">
            <tr><q></q>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Bidang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gurus as $guru)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>{{ $guru->email }}</td>
                    <td>{{ $guru->no_hp }}</td>
                    <td>{{ $guru->bidang }}</td>
                    <td>
                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data guru</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
