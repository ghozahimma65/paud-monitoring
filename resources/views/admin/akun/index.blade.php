@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-700">🔐 Daftar Akun</h1>
        <a href="{{ route('akun.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Akun</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <table class="w-full border border-gray-200 rounded-lg text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border">#</th>
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Role</th>
                <th class="p-3 border">Password</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $i + 1 }}</td>
                    <td class="p-3 border">{{ $user->name }}</td>
                    <td class="p-3 border">{{ $user->email }}</td>
                    <td class="p-3 border text-center">
                        @if($user->role == 'guru')
                            <span class="text-blue-600 font-semibold">Guru</span>
                        @elseif($user->role == 'wali_murid')
                            <span class="text-purple-600 font-semibold">Wali Murid</span>
                        @else
                            <span class="text-gray-600">Admin</span>
                        @endif
                    </td>

                    {{-- Kolom password (disembunyikan tapi bisa dilihat) --}}
                    <td class="p-3 border text-center">
                        <div class="relative inline-block">
                            <input 
                                type="password" 
                                value="123456" 
                                readonly 
                                class="border rounded-lg px-2 py-1 text-center bg-gray-100 text-sm w-24 password-field"
                            >
                            <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>

                    {{-- Tombol Aksi --}}
                    <td class="p-3 border text-center space-x-2">
                        <a href="{{ route('akun.edit', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                    
                        <form action="{{ route('akun.reset', $user->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Reset</button>
                        </form>
                    
                        <form action="{{ route('akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus akun ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">Belum ada akun terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script show/hide password --}}
<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.closest('div').querySelector('.password-field');
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});
</script>
@endsection
