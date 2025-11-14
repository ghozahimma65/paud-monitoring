<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simpaud Kartoharjo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100 font-sans">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-600 text-white min-h-screen p-6 shadow-xl">
        <h2 class="text-2xl font-bold mb-10">Simpaud Kartoharjo</h2>

        <nav class="space-y-4 text-sm">
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-home mr-3"></i> Home
            </a>

            <div>
                <p class="font-semibold uppercase text-xs mb-2">Data Master</p>
                <ul class="ml-4 space-y-1">
                    <li><a href="{{ route('guru.index') }}" class="block p-2 hover:bg-green-700 rounded">👨‍🏫 Guru</a></li>
                    <li><a href="{{ route('wali-murid.index') }}"class="block p-2 hover:bg-green-700 rounded">👪 Wali Murid</a></li>
                    <li><a href="{{ route('siswa.index') }}" class="block p-2 hover:bg-green-700 rounded">🧒 Peserta Didik</a></li>
                </ul>
            </div>

<a href="{{ route('admin.perkembangan.index') }}" class="flex items-center p-2 rounded-lg hover:bg-green-700 transition">
    <i class="fas fa-chart-line mr-3"></i> Laporan Perkembangan
</a>

            <a href="{{ route('pengumuman.index') }}" class="flex items-center p-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-bullhorn mr-3"></i> Menu Pengumuman
            </a>

            <div>
                <p class="font-semibold uppercase text-xs mb-2">Menu Akun</p>
                <ul class="ml-4 space-y-1">
                    <li>
                        <a href="{{ route('akun.index') }}" 
                           class="block p-2 hover:bg-green-700 rounded">
                           👥 Manajemen Akun
                        </a>
                    </li>
                </ul>
            </div>

            <a href="#" class="flex items-center p-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-bus mr-3"></i> Penjemputan
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        
        <!-- Navbar -->
        <header class="flex items-center justify-between bg-white px-6 py-4 shadow">
            <h1 class="text-lg font-semibold">Hai, Admin 👋</h1>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search Class, Documents, Activities..." 
                       class="px-4 py-2 rounded-lg border focus:ring-2 focus:ring-green-400 w-72 text-sm">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            @yield('content')
            @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
        </main>
    </div>

</body>
</html>
