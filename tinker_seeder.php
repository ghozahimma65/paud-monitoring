<?php
$siswas = App\Models\Siswa::all();
foreach($siswas as $siswa) {
    App\Models\PenilaianRapot::updateOrCreate(
        ['siswa_id' => $siswa->id],
        [
            'semester' => 'Genap',
            'tahun_ajaran' => '2025/2026',
            'catatan_guru' => 'Ananda sangat interaktif, kreatif, dan mandiri selama di kelas. Pertahankan prestasinya!',
            'nama_guru' => 'Siti Aminah, S.Pd',
            'nilai_aspek' => [
                'Agama' => 'BSB',
                'Fisik' => 'BSB',
                'Kognitif' => 'BSH',
                'Bahasa' => 'MB',
                'SosEm' => 'BSB',
                'Seni' => 'BSB'
            ]
        ]
    );
}
echo "DB_RAPOT_SEEDED\n";
