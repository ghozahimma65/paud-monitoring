@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6 no-print max-w-[21cm] mx-auto">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📄 Preview Rapot</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('perkembangan.show', $rapot->siswa_id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow transition">
                &larr; Kembali
            </a>
            <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2 transition">
                🖨️ Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <div class="bg-white mx-auto max-w-[21cm] shadow-xl text-black relative print:shadow-none print:m-0 print:w-full" 
         style="min-height: 29.7cm; font-family: 'Times New Roman', Times, serif; border: 4px solid #000; padding: 3px;">
        
        <div style="border: 1px solid #000; height: 100%; padding: 40px;">

            <div class="text-center mb-8">
                <h2 class="text-xl font-bold uppercase tracking-wider mb-2">Laporan Perkembangan Anak Didik</h2>
                <h3 class="text-2xl font-bold uppercase mb-1">PAUD 'Aisyiyah Kartoharjo</h3>
                <p class="text-base">Jln. Ciliwung II No. 22, Kartoharjo, Madiun</p>
                <div style="border-bottom: 3px double black; margin-top: 1rem;"></div>
            </div>

            <div class="mb-8">
                <table class="w-full text-base leading-loose">
                    <tr>
                        <td class="font-bold w-32">Nama Anak</td>
                        <td class="w-4">:</td>
                        <td class="uppercase font-semibold">{{ $rapot->siswa->nama_siswa }}</td>
                        <td class="font-bold w-32 text-right pl-4">Semester</td>
                        <td class="w-4 text-center">:</td>
                        <td>{{ $rapot->semester }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold">NIS / NISN</td>
                        <td>:</td>
                        <td>{{ $rapot->siswa->nis }} / {{ $rapot->siswa->nisn ?? '-' }}</td>
                        <td class="font-bold text-right pl-4">Tahun Ajaran</td>
                        <td class="text-center">:</td>
                        <td>{{ $rapot->tahun_ajaran }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Kelompok</td>
                        <td>:</td>
                        <td>{{ $rapot->siswa->kelompok_id ?? '-' }}</td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            </div>

            <div class="space-y-6 text-justify leading-relaxed text-lg">
                
                <div>
                    <h3 class="font-bold text-lg mb-2">A. PENGEMBANGAN AL ISLAM, KE'AISYIYAHAN DAN KEMUHAMMADIYAHAN (AIK)</h3>
                    <div class="pl-8">
                        {!! nl2br(e($rapot->narasi_aik ?? '-')) !!}
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-2">B. CAPAIAN PEMBELAJARAN NILAI AGAMA DAN BUDI PEKERTI</h3>
                    <div class="pl-8">
                        {!! nl2br(e($rapot->narasi_nilai_agama ?? '-')) !!}
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-2">C. CAPAIAN PEMBELAJARAN JATI DIRI</h3>
                    <div class="pl-8">
                        {!! nl2br(e($rapot->narasi_jati_diri ?? '-')) !!}
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-2">D. CAPAIAN PEMBELAJARAN DASAR-DASAR LITERASI, MATEMATIKA, SAINS, TEKNOLOGI, REKAYASA, SENI</h3>
                    <div class="pl-8">
                        {!! nl2br(e($rapot->narasi_literasi ?? '-')) !!}
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-2">E. KOKURIKULER</h3>
                    <div class="pl-8">
                        {!! nl2br(e($rapot->narasi_kokurikuler ?? '-')) !!}
                    </div>
                </div>

            </div>

            <div class="print:break-after-page mt-10"></div>

            <div class="mt-8 grid grid-cols-2 gap-10">
                
                <div>
                    <h3 class="font-bold text-lg mb-4 uppercase text-center" style="text-decoration: underline;">Pertumbuhan</h3>
                    <table class="w-full border-collapse border border-black text-base">
                        <tr class="bg-gray-200 print:bg-gray-300">
                            <td class="border border-black p-2 font-bold text-center">Aspek</td>
                            <td class="border border-black p-2 font-bold text-center">Hasil</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Berat Badan</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->berat_badan }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Tinggi Badan</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->tinggi_badan }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Lingkar Kepala</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->lingkar_kepala }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Lingkar Lengan</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->lingkar_lengan }}</td>
                        </tr>
                    </table>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4 uppercase text-center" style="text-decoration: underline;">Kehadiran Anak</h3>
                    <table class="w-full border-collapse border border-black text-base">
                        <tr class="bg-gray-200 print:bg-gray-300">
                            <td class="border border-black p-2 font-bold text-center">Keterangan</td>
                            <td class="border border-black p-2 font-bold text-center">Jumlah</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Sakit</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->sakit }} Hari</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Izin</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->izin }} Hari</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 pl-4">Tanpa Keterangan</td>
                            <td class="border border-black p-2 text-center font-semibold">{{ $rapot->alpha }} Hari</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="font-bold text-lg mb-2 uppercase">Refleksi Orang Tua</h3>
                <div class="border-2 border-black p-4 h-32 rounded">
                    <p class="italic text-lg">{{ $rapot->refleksi_orang_tua ?? '' }}</p>
                </div>
            </div>

            <div class="flex justify-between items-end mt-20 text-center text-base">
                
                <div class="w-1/3 flex flex-col items-center">
                    <p class="mb-24">Orang Tua / Wali</p>
                    <p class="font-bold border-b border-black w-40"></p>
                </div>

                <div class="w-1/3 flex flex-col items-center">
                    <p>Mengetahui,</p>
                    <p class="mb-1 font-bold">Pengelola</p>
                    <p class="mb-16 font-bold">PAUD 'Aisyiyah Kartoharjo</p> 
                    <p class="font-bold underline uppercase">{{ $rapot->nama_kepala_sekolah }}</p>
                    <p class="font-bold">NBM. {{ $rapot->nbm_kepala_sekolah }}</p>
                </div>

                <div class="w-1/3 flex flex-col items-center">
                    <p class="mb-1">Madiun, {{ \Carbon\Carbon::parse($rapot->tanggal_rapot)->translatedFormat('d F Y') }}</p>
                    <p class="mb-24">Guru Kelas</p>
                    
                    <p class="font-bold border-b border-black w-40 uppercase">
                        {{ $rapot->nama_guru }}
                    </p>
                </div>

            </div>

        </div> </div> </div>

{{-- CSS KHUSUS UNTUK PRINT & TAMPILAN KERTAS --}}
<style>
    /* Mengatur agar tampilan web meniru kertas */
    body {
        background-color: #f3f4f6; /* Abu-abu muda di web */
    }

    /* Saat tombol CETAK diklik */
    @media print {
        @page {
            size: A4;
            margin: 1cm; /* Margin kertas saat diprint */
        }
        body {
            background-color: white; /* Latar belakang putih saat print */
            margin: 0;
        }
        .no-print {
            display: none !important; /* Sembunyikan tombol saat print */
        }
        /* Paksa background warna (untuk tabel abu-abu) tercetak */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .shadow-xl {
            box-shadow: none !important; /* Hilangkan bayangan saat print */
        }
        /* Pastikan bingkai tetap tercetak */
        .max-w-\[21cm\] {
            max-width: 100% !important;
            width: 100% !important;
            border: 4px solid #000 !important; /* Pastikan border luar tercetak tebal */
        }
    }
</style>
@endsection