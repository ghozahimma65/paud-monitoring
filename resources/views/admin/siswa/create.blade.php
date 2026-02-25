@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto mt-10 mb-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-700">➕ Tambah Siswa Baru</h1>
        <a href="{{ route('siswa.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Wali Murid (Orang Tua)</label>
            <select name="wali_murid_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                <option value="">-- Pilih Wali Murid --</option>
                @foreach($wali_murids as $wali)
                    <option value="{{ $wali->id }}" {{ old('wali_murid_id') == $wali->id ? 'selected' : '' }}>
                        {{ $wali->nama_wali }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Alamat siswa akan otomatis mengikuti alamat wali murid.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">NIS (Lokal)</label>
                <input type="text" name="nis" value="{{ old('nis') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required placeholder="Contoh: 2024001">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">NISN (Nasional)</label>
                <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Contoh: 0123456789">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Nama Siswa</label>
            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2">Laki-laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
        </div>

        <div class="mb-4 p-4 border border-blue-200 bg-blue-50 rounded-lg">
            <label class="block text-gray-800 font-bold mb-2">📍 Titik Lokasi Rumah (Untuk Rute Kunjungan)</label>
            <p class="text-xs text-gray-600 mb-2">Geser dan klik pada peta di bawah untuk menandai rumah siswa.</p>
            
            <div id="map" style="height: 300px; width: 100%; border-radius: 8px; z-index: 1;"></div>

            <div class="grid grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="w-full border border-gray-300 rounded p-2 bg-gray-100 text-sm" readonly placeholder="Otomatis terisi">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="w-full border border-gray-300 rounded p-2 bg-gray-100 text-sm" readonly placeholder="Otomatis terisi">
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-3">
            <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition shadow-md">
                💾 Simpan Data
            </button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Titik tengah default: Alun-alun Jember
        var map = L.map('map').setView([-7.628337, 111.525506], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        // Kalau ada error validasi dan ada data lama, tampilkan markernya
        @if(old('latitude') && old('longitude'))
            var oldLat = {{ old('latitude') }};
            var oldLng = {{ old('longitude') }};
            marker = L.marker([oldLat, oldLng]).addTo(map);
            map.setView([oldLat, oldLng], 15);
        @endif

        // Event saat peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
        });
    });
</script>
@endsection