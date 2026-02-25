<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AStarController extends Controller
{
    public function cariRute(Request $request)
    {
        $id_awal = 1; // ID PAUD Aisyiyah Kartoharjo (Start)
        $awal = DB::table('titik_jalans')->where('id', $id_awal)->first();

        // 1. Ambil kordinat dari HP Flutter
        $latTujuan = $request->query('lat');
        $lngTujuan = $request->query('lng');

        if (!$latTujuan || !$lngTujuan) {
            return response()->json(['success' => false, 'message' => 'Koordinat tidak valid'], 400);
        }

        $semua_titik = DB::table('titik_jalans')->get()->keyBy('id');

        // 2. CARI TITIK TUJUAN YANG PALING COCOK BERDASARKAN KOORDINAT
        $tujuan = null;
        $jarakTerdekat = INF;

        foreach ($semua_titik as $titik) {
            $jarak = $this->hitungJarak($latTujuan, $lngTujuan, $titik->latitude, $titik->longitude);
            if ($jarak < $jarakTerdekat) {
                $jarakTerdekat = $jarak;
                $tujuan = $titik;
            }
        }

        if (!$tujuan) {
            return response()->json(['success' => false, 'message' => 'Titik tidak ditemukan'], 404);
        }

        $id_tujuan = $tujuan->id; // Dapatkan ID aslinya di tabel titik_jalans

        // 3. Ambil jalur jembatannya
        $edges = DB::table('jalur_jalans')->get();
        $graph = [];
        foreach ($edges as $edge) {
            $graph[$edge->titik_awal_id][] = [
                'tujuan' => $edge->titik_tujuan_id,
                'jarak' => $edge->jarak
            ];
        }

        // ==========================================
        // PROSES A-STAR (A*)
        // ==========================================
        $openList = [$id_awal];
        $closedList = [];
        $cameFrom = [];

        $gCost = [];
        $fCost = [];
        foreach ($semua_titik as $id => $titik) {
            $gCost[$id] = INF;
            $fCost[$id] = INF;
        }
        $gCost[$id_awal] = 0;
        $fCost[$id_awal] = $this->hitungHeuristic($awal, $tujuan);

        while (!empty($openList)) {
            $current = null;
            $lowestF = INF;
            foreach ($openList as $nodeId) {
                if ($fCost[$nodeId] < $lowestF) {
                    $lowestF = $fCost[$nodeId];
                    $current = $nodeId;
                }
            }

            if ($current == $id_tujuan) {
                return $this->rekonstruksiRute($cameFrom, $current, $semua_titik, $gCost[$current]);
            }

            $openList = array_diff($openList, [$current]);
            $closedList[] = $current;

            if (isset($graph[$current])) {
                foreach ($graph[$current] as $neighbor) {
                    $neighborId = $neighbor['tujuan'];

                    if (in_array($neighborId, $closedList)) continue;

                    $tentativeGCost = $gCost[$current] + $neighbor['jarak'];

                    if ($tentativeGCost < $gCost[$neighborId]) {
                        $cameFrom[$neighborId] = $current;
                        $gCost[$neighborId] = $tentativeGCost;
                        
                        $hCost = $this->hitungHeuristic($semua_titik[$neighborId], $tujuan);
                        $fCost[$neighborId] = $tentativeGCost + $hCost;

                        if (!in_array($neighborId, $openList)) {
                            $openList[] = $neighborId;
                        }
                    }
                }
            }
        }

        return response()->json(['success' => false, 'message' => 'Rute tidak ditemukan (Buntu)'], 404);
    }

    // --- RUMUS BANTUAN ---
    private function hitungJarak($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000;
        $latFrom = deg2rad((float)$lat1);
        $lonFrom = deg2rad((float)$lon1);
        $latTo = deg2rad((float)$lat2);
        $lonTo = deg2rad((float)$lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return round($angle * $earthRadius);
    }

    private function hitungHeuristic($titikA, $titikB) {
        return $this->hitungJarak($titikA->latitude, $titikA->longitude, $titikB->latitude, $titikB->longitude);
    }

    private function rekonstruksiRute($cameFrom, $current, $semua_titik, $jarakTotal) {
        $rute = [];
        while (isset($cameFrom[$current])) {
            array_unshift($rute, $semua_titik[$current]);
            $current = $cameFrom[$current];
        }
        array_unshift($rute, $semua_titik[$current]);

        return response()->json(['success' => true, 'jarak_total_meter' => $jarakTotal, 'titik_rute' => $rute]);
    }
}