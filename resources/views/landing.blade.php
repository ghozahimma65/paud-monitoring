<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpaud Kartoharjo - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-emerald-50 text-gray-800">

    <nav class="flex justify-between items-center py-4 px-8 bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo PAUD Kartoharjo" class="w-12 h-12 object-contain">
            <h1 class="text-xl font-bold text-emerald-700">Simpaud Kartoharjo</h1>
        </div>
        <a href="{{ route('login') }}" class="px-5 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-full shadow hover:bg-emerald-700 transition">
            Masuk Admin 🔒
        </a>
    </nav>

    <section class="container mx-auto px-8 pt-32 pb-16 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Selamat Datang di <br><span class="text-emerald-600">Simpaud Kartoharjo</span>
            </h2>
            <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                Lembaga Pendidikan Anak Usia Dini (PAUD) terpercaya di Madiun dengan fokus pada pengembangan holistik anak. Kami menyediakan lingkungan belajar yang aman, menyenangkan, dan transparan bagi wali murid.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="https://wa.me/6281234567890" target="_blank" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg shadow-lg hover:bg-emerald-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Hubungi Admin
                </a>
                <a href="{{ asset('assets/apk/simpaud.apk') }}" download class="px-6 py-3 bg-white text-emerald-600 font-semibold border-2 border-emerald-600 rounded-lg shadow-lg hover:bg-emerald-50 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Download APK
                </a>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="{{ asset('images/hero.jpeg') }}" alt="Kegiatan PAUD" class="rounded-2xl shadow-2xl w-full object-cover h-[400px] border-4 border-white">
        </div>
    </section>

    <section class="bg-emerald-600 py-16 mt-8">
        <div class="container mx-auto px-8">
            <div class="text-center mb-12 text-white">
                <h3 class="text-3xl font-bold mb-2">Fitur Unggulan Simpaud</h3>
                <p class="text-emerald-100">Teknologi terdepan untuk mendukung perkembangan anak dan kenyamanan orang tua</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Fitur 1: Akses Real-Time -->
                <div class="bg-emerald-700 border-2 border-emerald-500 rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <svg class="w-12 h-12 text-emerald-100 mb-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <h4 class="text-xl font-bold mb-3">Akses Real-Time</h4>
                    <p class="text-emerald-100 text-sm leading-relaxed">Pantau perkembangan anak kapan saja langsung dari smartphone wali murid.</p>
                </div>

                <!-- Fitur 2: Validasi QR Code -->
                <div class="bg-emerald-700 border-2 border-emerald-500 rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <svg class="w-12 h-12 text-emerald-100 mb-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <h4 class="text-xl font-bold mb-3">Validasi QR Code</h4>
                    <p class="text-emerald-100 text-sm leading-relaxed">Sistem keamanan penjemputan siswa menggunakan scan QR Code unik.</p>
                </div>

                <!-- Fitur 3: Rute Cerdas A* -->
                <div class="bg-emerald-700 border-2 border-emerald-500 rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <svg class="w-12 h-12 text-emerald-100 mb-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 003 16.382V5.618a1 1 0 011.553-.894L9 7.5m0 0l6.553-3.894A1 1 0 0117 5.618v10.764a1 1 0 01-1.553.894L9 7.5m0 0V5m6 9.5v2.764a1 1 0 01-1.553.894l-4.447-2.724"></path></svg>
                    <h4 class="text-xl font-bold mb-3">Rute Cerdas A*</h4>
                    <p class="text-emerald-100 text-sm leading-relaxed">Navigasi kunjungan (Home Visit) guru yang otomatis & efisien dengan Algoritma A-Star.</p>
                </div>

                <!-- Fitur 4: Rapor Digital -->
                <div class="bg-emerald-700 border-2 border-emerald-500 rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <svg class="w-12 h-12 text-emerald-100 mb-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <h4 class="text-xl font-bold mb-3">Rapor Digital</h4>
                    <p class="text-emerald-100 text-sm leading-relaxed">Pencatatan penilaian ceklis dan anekdot siswa yang terintegrasi di satu pintu.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-8 py-20">
        <h3 class="text-3xl font-bold text-center text-gray-900 mb-12">Galeri Kegiatan Kami</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <img src="{{ asset('images/1 (1).jpeg') }}" class="rounded-lg shadow hover:opacity-90 transition cursor-pointer h-64 w-full object-cover">
            <img src="{{ asset('images/1 (2).jpeg') }}" class="rounded-lg shadow hover:opacity-90 transition cursor-pointer h-64 w-full object-cover">
            <img src="{{ asset('images/1 (3).jpeg') }}" class="rounded-lg shadow hover:opacity-90 transition cursor-pointer h-64 w-full object-cover">
            <img src="{{ asset('images/1 (4).jpeg') }}" class="rounded-lg shadow hover:opacity-90 transition cursor-pointer h-64 w-full object-cover">
            <img src="{{ asset('images/1 (5).jpeg') }}" class="rounded-lg shadow hover:opacity-90 transition cursor-pointer h-64 w-full object-cover">
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-6 text-center">
        <p>&copy; 2026 PAUD 'Aisyiyah Kartoharjo - Sistem Informasi Monitoring Akademik.</p>
    </footer>

</body>
</html>