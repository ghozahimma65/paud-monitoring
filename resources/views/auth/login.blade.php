<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Simpaud</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-br from-green-400 via-green-500 to-green-700">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl flex flex-col md:flex-row overflow-hidden">
        
        <!-- Left Side (hidden di HP, tampil di desktop) -->
        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-green-500 to-green-700 text-white p-10 flex-col justify-center">
            <h2 class="text-3xl font-bold">Selamat Datang</h2>
            <p class="mt-4 text-lg">Silahkan login untuk mengakses dashboard admin Simpaud Kartoharjo</p>
            <!-- Ganti logo -->
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="mt-10 w-40 mx-auto animate-pulse">
        </div>

        <!-- Right Side (Form Login) -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center md:text-left">Sign In</h2>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600">Email</label>
                    <input type="text" name="email" required
                        class="w-full mt-2 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-2 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                        @if (session('error'))
                        <div style="color:red;">{{ session('error') }}</div>
                        @endif

                <button type="submit"
                    class="w-full py-3 rounded-lg bg-gradient-to-r from-green-400 to-green-600 text-white font-bold shadow-lg hover:opacity-90 transition">
                    Login
                </button>
            </form>

            <p class="text-sm text-gray-500 mt-6 text-center md:text-left">© 2025 Simpaud Kartoharjo</p>
        </div>

    </div>

</body>
</html>
