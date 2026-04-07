<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpaud Kartoharjo</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tailwind Custom Config & Global CSS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        green: {
                            50: '#f2f8f5',
                            100: '#e1f0e8',
                            200: '#c5e2d4',
                            300: '#9dcdb9',
                            400: '#70b197',
                            500: '#4e957a',
                            600: '#3a7760',
                            700: '#30604e',
                            800: '#274d40',
                            900: '#213f35',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Global Enhancements */
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #e5f0ea; }
        
        /* Soften all cards globally and tint white to pastel green */
        .bg-white {
            background-color: #f3fbf6 !important; /* Soft green tint instead of stark white */
        }
        .bg-white.shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border-radius: 1rem;
            border: 1px solid rgba(225, 240, 232, 0.8);
        }
        
        /* Beautify all inputs/selects globally */
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], select, textarea {
            border-radius: 0.75rem !important;
            border-color: #c5e2d4 !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02) !important;
            transition: all 0.2s ease;
        }
        input:focus, select:focus, textarea:focus {
            ring: 2px !important;
            ring-color: #70b197 !important;
            border-color: #70b197 !important;
            outline: none !important;
        }
        
        /* Global Button Enhancements */
        button, .btn, a.bg-green-600, a.bg-blue-600 {
            transition: all 0.2s ease;
        }
        button:hover, .btn:hover, a.bg-green-600:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(58, 119, 96, 0.2);
        }
        
        /* Improve HTML Table looks globally */
        table.w-full {
            border-radius: 0.75rem;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #e1f0e8;
        }
        table th {
            background-color: #f2f8f5 !important;
            color: #30604e !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem !important;
        }
        table td {
            padding: 1rem !important;
            color: #4a5568;
            border-bottom: 1px solid #e1f0e8;
        }
        table tr:last-child td {
            border-bottom: none;
        }
        table tr:hover td {
            background-color: #fcfdfd;
        }
    </style>
</head>
<body class="flex bg-[#e5f0ea] text-gray-800 font-sans antialiased selection:bg-green-200 selection:text-green-900">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#f1f8f4] border-r border-[#d4ebd8] flex flex-col transition-all duration-300 shadow-sm z-20">
        <div class="p-6 flex items-center border-b border-[#f2f8f5]">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg text-white font-bold text-xl mr-3">
                S
            </div>
            <h2 class="text-xl font-extrabold text-gray-800 tracking-tight">Simpaud</h2>
        </div>

        <nav class="flex-1 p-4 space-y-6 overflow-y-auto custom-scrollbar">
            
            <!-- Main Menu -->
            <div>
                <p class="px-3 text-xs font-bold text-green-500 uppercase tracking-wider mb-2">Menu Utama</p>
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-green-900 bg-green-50 hover:bg-green-100 transition-colors shadow-sm">
                    <i class="fas fa-home w-5 h-5 mr-3 flex items-center justify-center text-green-600"></i> 
                    Dashboard
                </a>
            </div>

            @if(auth()->user()->role == 'admin')
            <!-- Data Master -->
            <div>
                <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Data Master</p>
                <ul class="space-y-1">
                    <li><a href="{{ route('guru.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                        <i class="fas fa-chalkboard-teacher w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Guru</a>
                    </li>
                    <li><a href="{{ route('wali-murid.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                        <i class="fas fa-users w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Wali Murid</a>
                    </li>
                    <li><a href="{{ route('siswa.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                        <i class="fas fa-child w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Peserta Didik</a>
                    </li>
                </ul>
            </div>
            @endif

            <!-- Laporan & Info -->
            <div>
                <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Laporan & Info</p>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.perkembangan.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                            <i class="fas fa-chart-line w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Perkembangan
                        </a>
                    </li>
                    @if(auth()->user()->role == 'admin')
                    <li>
                        <a href="{{ route('pengumuman.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                            <i class="fas fa-bullhorn w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Pengumuman
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('penjemputan.index') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl text-gray-600 hover:text-green-800 hover:bg-green-50/50 transition-colors">
                            <i class="fas fa-bus w-5 h-5 mr-3 text-gray-400 flex items-center justify-center group-hover:text-green-500"></i> Penjemputan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="p-4 border-t border-[#e1f0e8]">
            <div class="flex items-center p-3 bg-gradient-to-r from-green-50 to-white rounded-xl shadow-sm border border-green-100">
                <div class="w-9 h-9 rounded-full bg-green-200 flex items-center justify-center text-green-800 font-bold mr-3 border-2 border-white shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-green-600 uppercase font-semibold">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- Navbar -->
        <header class="flex items-center justify-between bg-[#f1f8f4]/80 backdrop-blur-lg px-8 py-4 border-b border-[#d4ebd8] z-10 sticky top-0">
            <div class="flex items-center text-gray-700">
                <h1 class="text-lg font-semibold tracking-wide flex items-center">
                    👋 <span class="ml-2">Halo, <span class="text-green-700">{{ Auth::user()->name }}</span></span>
                </h1>
            </div>
            <div class="flex items-center space-x-6">
                <!-- Search Input with Icon -->
                <div class="relative hidden md:block">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Cari..." 
                           class="pl-10 pr-4 py-2 bg-gray-50/50 border border-gray-200 focus:bg-white rounded-xl w-64 text-sm transition-all focus:w-80 shadow-sm">
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center px-4 py-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all font-medium text-sm shadow-sm" title="Logout">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#e5f0ea] p-8">
            @yield('content')
            
            @if (session('success'))
            <div class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center animate-bounce border-2 border-green-400 z-50">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif
        </main>
    </div>

</body>
</html>
