<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rapot - {{ $rapot->siswa->nama_siswa }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap');
        body { background: #525659; font-family: 'Times New Roman', Times, serif; color: black; margin: 0; padding: 0; }
        
        /* SETTINGAN KERTAS A4 (Layar) */
        .page {
            background: white; width: 210mm; height: 297mm;
            padding: 2cm; margin: 1cm auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            position: relative; overflow: hidden; display: block;
        }
        
        /* HEADER POIN (KOTAK JUDUL) */
        .judul-poin {
            background-color: #e5e7eb;
            border: 1px solid black;
            padding: 8px 10px;
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* NARASI */
        .narasi { font-size: 11pt; line-height: 1.3; text-align: justify; margin-bottom: 10px; }
        .narasi p { text-indent: 1cm; margin-top: 0; margin-bottom: 5px; }
        .narasi ul { list-style-type: disc; margin-left: 25px; text-indent: 0; }
        .narasi ol { list-style-type: decimal; margin-left: 25px; text-indent: 0; }
        
        /* TABEL */
        .table-data th { background: #eee; border: 1px solid black; padding: 2px; text-align: center; font-size: 10pt; font-weight: bold; }
        .table-data td { border: 1px solid black; padding: 2px; font-size: 10pt; }
        
        .garis-kop { border-top: 3px solid black; border-bottom: 1px solid black; height: 3px; margin: 5px 0 15px 0; }
        .header-hal { text-align: right; font-size: 9pt; font-style: italic; color: #888; border-bottom: 1px solid #ddd; margin-bottom: 10px; }
        .footer-hal { position: absolute; bottom: 1cm; right: 2cm; font-size: 9pt; color: #888; }

        /* SETTINGAN KHUSUS PRINT (ANTI BLANK PAGE) */
        @media print {
            @page {
                size: A4;
                margin: 0; /* Hapus margin default browser */
            }
            
            html, body {
                width: 210mm;
                height: 297mm;
                background: white;
                margin: 0 !important;
                padding: 0 !important;
            }

            .page {
                margin: 0 !important;
                border: initial;
                border-radius: initial;
                width: 210mm;
                height: 297mm; /* Tinggi fix */
                box-shadow: none;
                page-break-after: always; /* Paksa ganti halaman tiap div .page */
                overflow: hidden; /* Potong konten berlebih */
            }

            /* SOLUSI: Halaman terakhir DILARANG ganti halaman */
            .page:last-of-type {
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
                margin-bottom: 0 !important;
            }

            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="no-print fixed top-0 left-0 w-full bg-white shadow-md p-3 flex justify-between z-50">
        <span class="font-bold text-gray-700 ml-4">Preview Rapot: {{ $rapot->siswa->nama_siswa }}</span>
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded font-bold mr-4 hover:bg-blue-700">🖨️ Cetak PDF</button>
    </div>
    <div class="h-16 no-print"></div>

    <div class="page">
        <div class="text-center">
            <h2 class="font-bold text-xl uppercase m-0">PAUD 'AISYIYAH KARTOHARJO</h2>
            <h3 class="font-bold text-lg uppercase m-0">KOTA MADIUN</h3>
            <p class="text-sm italic m-0">Jl. Sarana Mulya, Kartoharjo, Kec. Kartoharjo, Kota Madiun</p>
        </div>
        <div class="garis-kop"></div>
        <div class="text-center mb-4"><h2 class="font-bold text-lg underline">LAPORAN PERKEMBANGAN ANAK DIDIK</h2></div>
        
        <table class="w-full font-bold mb-6 text-[11pt]">
            <tr><td width="20%">NAMA ANAK</td><td width="2%">:</td><td width="40%">{{ $rapot->siswa->nama_siswa }}</td><td width="15%">KELOMPOK</td><td width="2%">:</td><td>SHINTA</td></tr>
            <tr><td>NIS</td><td>:</td><td>{{ $rapot->siswa->nis }}</td><td>SEMESTER</td><td>:</td><td>{{ $rapot->semester == 1 ? '1 (Satu)' : '2 (Dua)' }}</td></tr>
            <tr><td>USIA</td><td>:</td><td>{{ \Carbon\Carbon::parse($rapot->siswa->tanggal_lahir)->age }} Tahun</td><td>TAHUN</td><td>:</td><td>{{ $rapot->tahun_ajaran }}</td></tr>
        </table>

        <div class="judul-poin">A. PENGEMBANGAN AL ISLAM, KE’AISYIYAHAN (AIK)</div>
        <div class="narasi">{!! $rapot->narasi_agama !!}</div>
        <div class="footer-hal">Hal. 1</div>
    </div>

    <div class="page">
        <div class="header-hal">{{ $rapot->siswa->nama_siswa }} - Hal. 2</div>
        <div class="judul-poin">B. CAPAIAN PEMBELAJARAN BUDI PEKERTI</div>
        <div class="narasi">{!! $rapot->narasi_budi_pekerti !!}</div>
        <div class="footer-hal">Hal. 2</div>
    </div>

    <div class="page">
        <div class="header-hal">{{ $rapot->siswa->nama_siswa }} - Hal. 3</div>
        <div class="judul-poin">C. CAPAIAN PEMBELAJARAN JATI DIRI</div>
        <div class="narasi">{!! $rapot->narasi_jati_diri !!}</div>
        <div class="footer-hal">Hal. 3</div>
    </div>

    <div class="page">
        <div class="header-hal">{{ $rapot->siswa->nama_siswa }} - Hal. 4</div>
        <div class="judul-poin">D. CAPAIAN PEMBELAJARAN LITERASI & STEAM</div>
        <div class="narasi">{!! $rapot->narasi_literasi !!}</div>
        <div class="footer-hal">Hal. 4</div>
    </div>

    <div class="page">
        <div class="header-hal">{{ $rapot->siswa->nama_siswa }} - Hal. 5</div>
        <div class="judul-poin">E. KOKURIKULER</div>
        <div class="narasi">{!! $rapot->narasi_kokurikuler !!}</div>
        <div class="footer-hal">Hal. 5</div>
    </div>

    <div class="page">
        <div class="header-hal">{{ $rapot->siswa->nama_siswa }} - Hal. 6</div>
        
        <div class="text-center mb-1"><h3 style="border:none; margin:0; text-decoration:none;">REFLEKSI ORANG TUA</h3></div>
        <div class="border border-black p-2 mb-4" style="min-height: 2cm;">
            @if($rapot->refleksi_orang_tua)
                <p class="text-justify font-serif text-[10pt] m-0">{{ $rapot->refleksi_orang_tua }}</p>
            @else
                <p class="text-gray-400 italic text-sm text-center mt-4">(Mohon Ayah/Bunda menuliskan masukan/harapan...)</p>
            @endif
        </div>

        <div class="flex gap-2 mb-6">
            <div class="w-1/2">
                <table class="table-data w-full">
                    <thead><tr><th colspan="2">PERTUMBUHAN</th></tr></thead>
                    <tbody>
                        <tr><td width="60%">Berat Badan</td><td class="text-center font-bold">{{ $rapot->berat_badan }} kg</td></tr>
                        <tr><td>Tinggi Badan</td><td class="text-center font-bold">{{ $rapot->tinggi_badan }} cm</td></tr>
                        <tr><td>Lingkar Kepala</td><td class="text-center font-bold">{{ $rapot->lingkar_kepala }} cm</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="w-1/2">
                <table class="table-data w-full">
                    <thead><tr><th colspan="2">KEHADIRAN</th></tr></thead>
                    <tbody>
                        <tr><td width="60%">Sakit</td><td class="text-center font-bold">{{ $rapot->sakit }} hari</td></tr>
                        <tr><td>Izin</td><td class="text-center font-bold">{{ $rapot->izin }} hari</td></tr>
                        <tr><td>Alpha</td><td class="text-center font-bold">{{ $rapot->alpha }} hari</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <div class="text-right mb-1 mr-10 font-serif text-[10pt]">Madiun, {{ \Carbon\Carbon::parse($rapot->tanggal_rapot)->translatedFormat('d F Y') }}</div>
            
            <table class="w-full text-center font-bold text-[10pt]">
                <tr>
                    <td width="50%" valign="top">Orang Tua / Wali Murid<br>
                        <div style="height: 60px;"></div>
                        (.............................................)
                    </td>
                    <td width="50%" valign="top">Guru Kelas<br>
                        <div style="height: 60px;"></div>
                        <span style="text-decoration: underline;">{{ $rapot->nama_guru }}</span><br>
                        <span class="font-normal text-xs">NIP. {{ $rapot->nipy_guru ?? '-' }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="pt-4">Mengetahui,<br>Pengelola PAUD 'Aisyiyah Kartoharjo</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 70px; vertical-align: bottom;">
                        <span style="text-decoration: underline;">{{ $rapot->nama_kepala_sekolah }}</span><br>
                        <span class="font-normal text-xs">NIP. {{ $rapot->nipy_kepala_sekolah ?? '-' }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>