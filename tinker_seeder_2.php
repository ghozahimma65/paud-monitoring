<?php
$siswas = App\Models\Siswa::all();
foreach($siswas as $siswa) {
    App\Models\PenilaianRapot::updateOrCreate(
        ['siswa_id' => $siswa->id],
        [
            'semester' => 'Genap',
            'tahun_ajaran' => '2025/2026',
            'catatan_guru' => 'Ananda sangat berkembang...',
            'nama_guru' => 'Siti Aminah, S.Pd',
            'nilai_aik' => 'Alhamdulillah, ananda sudah mampu menghafal doa harian dengan baik.',
            'nilai_budi_pekerti' => 'Ananda menunjukkan sikap santun dan peduli pada teman sebayanya.',
            'nilai_jati_diri' => 'Berkembang dengan kemandirian yang tinggi saat bermain.',
            'nilai_literasi_steam' => 'Menunjukkan ketertarikan luar biasa pada balok susun dan warna.',
            'nilai_kokurikuler' => 'Sangat aktif dalam kegiatan seni budaya tari daerah.',
            'tinggi_badan' => 110,
            'berat_badan' => 18,
            'lingkar_kepala' => 50,
            'sakit' => 1,
            'izin' => 0,
            'alpha' => 0,
            'file_pdf' => 'rapot/dummy_rapot.pdf'
        ]
    );
}
echo "DB_NEW_RAPOT_SEEDED\n";
