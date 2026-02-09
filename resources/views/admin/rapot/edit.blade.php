@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Rapot: {{ $rapot->siswa->nama_siswa }}</h1>

    <form action="{{ route('rapot.update', $rapot->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-bold">Tahun Ajaran</label>
                <select name="tahun_ajaran" class="w-full border p-2 rounded">
                    <option value="2025/2026" {{ $rapot->tahun_ajaran == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                    <option value="2026/2027" {{ $rapot->tahun_ajaran == '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                </select>
            </div>
            <div>
                <label class="block font-bold">Semester</label>
                <select name="semester" class="w-full border p-2 rounded">
                    <option value="1" {{ $rapot->semester == 1 ? 'selected' : '' }}>Semester 1 (Ganjil)</option>
                    <option value="2" {{ $rapot->semester == 2 ? 'selected' : '' }}>Semester 2 (Genap)</option>
                </select>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4 mt-6">Capaian Pembelajaran (A-E)</h2>

        <div class="mb-4">
            <label class="block font-bold">A. Nilai Agama & Budi Pekerti (AIK)</label>
            <textarea name="narasi_agama" rows="4" class="w-full border p-2 rounded">{{ $rapot->narasi_agama }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-bold">B. Capaian Pembelajaran Budi Pekerti</label>
            <textarea name="narasi_budi_pekerti" rows="4" class="w-full border p-2 rounded">{{ $rapot->narasi_budi_pekerti }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-bold">C. Jati Diri</label>
            <textarea name="narasi_jati_diri" rows="4" class="w-full border p-2 rounded">{{ $rapot->narasi_jati_diri }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-bold">D. Literasi & STEAM</label>
            <textarea name="narasi_literasi" rows="4" class="w-full border p-2 rounded">{{ $rapot->narasi_literasi }}</textarea>
        </div>

        <div class="mb-4 bg-gray-50 p-4 rounded border">
            <label class="block font-bold">E. Kokurikuler / P5</label>
            <div class="grid grid-cols-2 gap-4 mb-2">
                <input type="text" name="p5_tema" value="{{ $rapot->p5_tema }}" placeholder="Tema P5" class="border p-2 rounded">
                <input type="text" name="p5_judul" value="{{ $rapot->p5_judul }}" placeholder="Judul Topik" class="border p-2 rounded">
            </div>
            <textarea name="narasi_kokurikuler" rows="4" class="w-full border p-2 rounded">{{ $rapot->narasi_kokurikuler }}</textarea>
        </div>

        <h2 class="text-xl font-bold mb-4 mt-6">Data Fisik</h2>
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div><label>Berat (kg)</label><input type="number" step="0.1" name="berat_badan" value="{{ $rapot->berat_badan }}" class="w-full border p-2 rounded"></div>
            <div><label>Tinggi (cm)</label><input type="number" step="0.1" name="tinggi_badan" value="{{ $rapot->tinggi_badan }}" class="w-full border p-2 rounded"></div>
            <div><label>Lingkar Kpl (cm)</label><input type="number" step="0.1" name="lingkar_kepala" value="{{ $rapot->lingkar_kepala }}" class="w-full border p-2 rounded"></div>
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded font-bold hover:bg-green-700 w-full">Update Rapot</button>
    </form>
</div>
@endsection