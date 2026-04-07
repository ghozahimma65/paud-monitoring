<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Simpaud Kartoharjo</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mesh-bg {
            background-color: #f2f8f5;
            background-image: 
                radial-gradient(at 40% 20%, #c5e2d4 0px, transparent 50%),
                radial-gradient(at 80% 0%, #e1f0e8 0px, transparent 50%),
                radial-gradient(at 0% 50%, #d4ebe0 0px, transparent 50%),
                radial-gradient(at 80% 50%, #b7dac9 0px, transparent 50%),
                radial-gradient(at 0% 100%, #e1f0e8 0px, transparent 50%),
                radial-gradient(at 80% 100%, #c5e2d4 0px, transparent 50%),
                radial-gradient(at 0% 0%, #f2f8f5 0px, transparent 50%);
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center mesh-bg relative overflow-hidden">

    <!-- Decorative floating elements -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-green-200/50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-teal-200/50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse" style="animation-delay: 2s;"></div>

    <div class="bg-[#f0f9f4]/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-100 w-full max-w-5xl flex flex-col md:flex-row overflow-hidden relative z-10 m-4">
        
        <!-- Left Side (hidden di HP, tampil di desktop) -->
        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-green-500/90 to-teal-600/90 text-white p-12 flex-col justify-center relative overflow-hidden">
            <!-- inner flare -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-32 h-32 object-contain mb-8 drop-shadow-lg">
                
                <h2 class="text-4xl font-extrabold tracking-tight mb-4">Selamat Datang</h2>
                <p class="text-lg text-green-50 font-medium leading-relaxed max-w-sm">
                    Sistem Informasi Monitoring dan Manajemen PAUD Terpadu Kartoharjo.
                </p>
                <div class="mt-8 flex items-center space-x-2 text-green-100 text-sm justify-center">
                    <span class="w-8 h-px bg-green-200/50"></span>
                    <span>Akses khusus staf & admin</span>
                    <span class="w-8 h-px bg-green-200/50"></span>
                </div>
            </div>
        </div>

        <!-- Right Side (Form Login) -->
        <div class="w-full md:w-1/2 p-10 lg:p-14 flex flex-col justify-center bg-[#e8f5ed]/30 backdrop-blur-md">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Sign In</h2>
                <p class="text-gray-500 mt-2 font-medium">Masuk untuk melanjutkan ke dashboard.</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" required placeholder="admin@simpaud.com"
                        class="w-full px-5 py-3.5 bg-[#f0f9f4]/80 border border-green-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none transition-all shadow-sm text-gray-700">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-5 py-3.5 bg-[#f0f9f4]/80 border border-green-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none transition-all shadow-sm text-gray-700">
                </div>

                @if (session('error'))
                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                </div>
                @endif

                <button type="submit"
                    class="w-full py-3.5 mt-4 rounded-xl bg-green-600 text-white font-bold tracking-wide shadow-[0_4px_14px_0_rgba(22,163,74,0.39)] hover:bg-green-700 hover:shadow-[0_6px_20px_rgba(22,163,74,0.23)] hover:-translate-y-0.5 transition-all duration-200">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-auto pt-10 text-center md:text-left">
                <p class="text-sm text-gray-400 font-medium tracking-wide">© 2026 Simpaud Kartoharjo.</p>
            </div>
        </div>

    </div>

</body>
</html>
