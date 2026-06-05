<?php

namespace App\Http\Controllers;

use App\Models\DataCuaca;
use App\Models\DataTanaman;
use App\Services\FuzzyRuleService;
use App\Services\FuzzyService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function recommend(Request $request, FuzzyService $fuzzy, FuzzyRuleService $ruleService)
    {
        if (!$request->tanam || !$request->panen) {
            return response()->json(['error' => 'Input tidak valid'], 400);
        }

        $tanam = (int) $request->tanam;
        $panen = (int) $request->panen;

        $rentang = $this->getRentangBulan($tanam, $panen);

        // =========================
        // AMBIL DATA CUACA
        // =========================
        $cuacaList = DataCuaca::whereIn('bulan_angka', $rentang)->get();

        if ($cuacaList->isEmpty()) {
            return response()->json(['error' => 'Data cuaca tidak ditemukan'], 404);
        }

        // =========================
        // FUZZY CUACA (RATA-RATA)
        // =========================
        $fuzzySuhuAll = [];
        $fuzzyHumAll = [];
        $fuzzyHujanAll = [];

        foreach ($cuacaList as $c) {
            $fs = $fuzzy->fuzzifikasiSuhu($c->suhu_rata);
            $fh = $fuzzy->fuzzifikasiKelembaban($c->kelembaban_rata);
            $fhu = $fuzzy->fuzzifikasiHujan($c->curah_hujan_total);

            foreach ($fs as $k => $v) $fuzzySuhuAll[$k][] = $v;
            foreach ($fh as $k => $v) $fuzzyHumAll[$k][] = $v;
            foreach ($fhu as $k => $v) $fuzzyHujanAll[$k][] = $v;
        }

        // rata-rata
        $fuzzySuhu = [];
        foreach ($fuzzySuhuAll as $k => $vals) {
            $fuzzySuhu[$k] = array_sum($vals) / count($vals);
        }

        $fuzzyKelembaban = [];
        foreach ($fuzzyHumAll as $k => $vals) {
            $fuzzyKelembaban[$k] = array_sum($vals) / count($vals);
        }

        $fuzzyHujan = [];
        foreach ($fuzzyHujanAll as $k => $vals) {
            $fuzzyHujan[$k] = array_sum($vals) / count($vals);
        }

        // =========================
        // FUZZY TANAM
        // =========================
        $fuzzyTanamAll = [];

        foreach ($rentang as $b) {
            $f = $fuzzy->fuzzifikasiTanam($b);

            foreach ($f as $key => $val) {
                $fuzzyTanamAll[$key][] = $val;
            }
        }

        $fuzzyTanam = [];
        foreach ($fuzzyTanamAll as $key => $vals) {
            $fuzzyTanam[$key] = array_sum($vals) / count($vals);
        }

        $fuzzyPanen = $fuzzy->fuzzifikasiPanen($panen);

        // fallback
        if (array_sum($fuzzyTanam) == 0) $fuzzyTanam['tengah'] = 1;
        if (array_sum($fuzzyPanen) == 0) $fuzzyPanen['sedang'] = 1;

        // =========================
        // INFERENSI
        // =========================
        $hasilRule = $ruleService->inferensi(
            $fuzzyTanam,
            $fuzzyPanen,
            $fuzzySuhu,
            $fuzzyKelembaban,
            $fuzzyHujan
        );

        $rekomendasi = $ruleService->getRekomendasi($hasilRule);

        // =========================
        // HITUNG OUTPUT
        // =========================
        $tanamanUtama = $rekomendasi[0] ?? null;

        $tanaman = $tanamanUtama
            ? DataTanaman::where('nama_tanaman', $tanamanUtama)->first()
            : null;

        $umur = $tanaman ? $tanaman->umur_panen : null;

        $tanggalTanam = Carbon::create(date('Y'), $tanam, 1);
        $tanggalPanen = $umur ? $tanggalTanam->copy()->addDays($umur) : null;

        // =========================
        // RATA-RATA CUACA (UNTUK OUTPUT)
        // =========================
        $avgSuhu = $cuacaList->avg('suhu_rata');
        $avgHum = $cuacaList->avg('kelembaban_rata');
        $avgHujan = $cuacaList->avg('curah_hujan_total');

        return response()->json([
            'cuaca' => [
                'suhu' => round($avgSuhu, 2),
                'kelembaban' => round($avgHum, 2),
                'hujan' => round($avgHujan, 2),
            ],
            'rekomendasi' => $rekomendasi,
            'umur_panen' => $umur,
            'tanggal_panen' => $tanggalPanen ? $tanggalPanen->format('d M Y') : null
        ]);
    }

   public function predictHarvest(Request $request, FuzzyService $fuzzy, FuzzyRuleService $ruleService)
    {
        $tanamanNama = strtolower($request->tanaman);
        $tanggal = $request->tanggal;

        if (!$tanamanNama || !$tanggal) {
            return response()->json(['error' => 'Input tidak lengkap'], 400);
        }

        // ambil tanaman
        $tanaman = DataTanaman::whereRaw('LOWER(nama_tanaman) = ?', [$tanamanNama])->first();
        if (!$tanaman) {
            return response()->json(['error' => 'Tanaman tidak ditemukan'], 404);
        }

        $umur = $tanaman->umur_panen;

        // =========================
        // HITUNG PANEN (deterministik)
        // =========================
        $tanggalTanam = Carbon::parse($tanggal);
        $tanggalPanen = $tanggalTanam->copy()->addDays($umur);
        $bulan = $tanggalTanam->month;

        // =========================
        // AMBIL CUACA
        // =========================
        $cuaca = DataCuaca::where('bulan_angka', $bulan)->first();

        if (!$cuaca) {
            return response()->json(['error' => 'Data cuaca tidak ditemukan'], 404);
        }

        // =========================
        // FUZZIFIKASI
        // =========================
        $fTanam = $fuzzy->fuzzifikasiTanam($bulan);
        $fPanen = $fuzzy->fuzzifikasiPanen($tanggalPanen->month);
        $fSuhu = $fuzzy->fuzzifikasiSuhu($cuaca->suhu_rata);
        $fHum = $fuzzy->fuzzifikasiKelembaban($cuaca->kelembaban_rata);
        $fHujan = $fuzzy->fuzzifikasiHujan($cuaca->curah_hujan_total);

        // fallback
        if (array_sum($fTanam) == 0) $fTanam['tengah'] = 1;
        if (array_sum($fPanen) == 0) $fPanen['sedang'] = 1;

        // =========================
        // INFERENSI (pakai rule utama)
        // =========================
        $hasilRule = $ruleService->inferensi(
            $fTanam,
            $fPanen,
            $fSuhu,
            $fHum,
            $fHujan
        );

        // =========================
        // NILAI TANAMAN YANG DIPILIH
        // =========================
        $nilaiTanaman = $hasilRule[$tanamanNama] ?? 0;

        $maxNilai = max($hasilRule);

            if ($nilaiTanaman >= $maxNilai - 0.05) {
                $status = 'Optimal';
            } elseif ($nilaiTanaman >= $maxNilai - 0.15) {
                $status = 'Cukup Optimal';
            } else {
                $status = 'Tidak Optimal';
            }


                arsort($hasilRule);
            $nilaiUtama = $hasilRule[$tanamanNama] ?? 0;

            $alternatif = [];

            if ($status === 'Tidak Optimal') {

                foreach ($hasilRule as $nama => $nilai) {

                    if ($nama == $tanamanNama) continue;

                    if ($nilai >= $maxNilai - 0.1) {
                        $alternatif[] = $nama;
                    }
                }

                if (empty($alternatif)) {
                    $alternatif = ['Tidak ada alternatif yang lebih baik'];
                }
            }

            // fallback
            if (empty($alternatif)) {
                $alternatif = ['Tidak ada alternatif yang lebih baik'];
            }
            
            $bulanScore = [];

        for ($i = 1; $i <= 12; $i++) {

            $cuacaLoop = DataCuaca::where('bulan_angka', $i)->first();
            if (!$cuacaLoop) continue;

            $fTanamLoop = $fuzzy->fuzzifikasiTanam($i);

            // estimasi bulan panen berdasarkan umur
            $estimasiPanen = $i + round($umur / 30);
            if ($estimasiPanen > 12) $estimasiPanen -= 12;

            $fPanenLoop = $fuzzy->fuzzifikasiPanen($estimasiPanen);

            $fS = $fuzzy->fuzzifikasiSuhu($cuacaLoop->suhu_rata);
            $fH = $fuzzy->fuzzifikasiKelembaban($cuacaLoop->kelembaban_rata);
            $fHu = $fuzzy->fuzzifikasiHujan($cuacaLoop->curah_hujan_total);

            $hasilLoop = $ruleService->inferensi(
                $fTanamLoop,
                $fPanenLoop,
                $fS,
                $fH,
                $fHu
            );

            $nilaiLoop = $hasilLoop[$tanamanNama] ?? 0;

            // filter nilai terlalu kecil (noise fuzzy)
            if ($nilaiLoop >= 0.2) {
                $bulanScore[$i] = $nilaiLoop;
            }    }

        // sorting
        arsort($bulanScore);

        $bulanTerbaik = [];

            // ambil nilai bulan saat ini (sebagai pembanding)
            $nilaiSekarang = $nilaiTanaman;

            foreach ($bulanScore as $bulanKey => $nilai) {

                // hanya ambil bulan yang lebih baik dari kondisi sekarang
                if ($nilai > $nilaiSekarang) {
                    $bulanTerbaik[] = $bulanKey;
                }

                if (count($bulanTerbaik) >= 3) break;
            }

            // fallback kalau tidak ada yang lebih baik
            if (empty($bulanTerbaik)) {
                $bulanTerbaik = ['Tidak ada bulan yang lebih optimal'];
            }
        // =========================
        // REKOMENDASI
        // =========================
        if ($status === 'Optimal') {
            $rekomendasi = 'Kondisi sangat sesuai. Tanaman dapat tumbuh optimal.';
        } elseif ($status === 'Cukup Optimal') {
            $rekomendasi = 'Tanaman masih bisa ditanam, namun tidak pada kondisi terbaik.';
        } else {
            $rekomendasi = 'Tidak disarankan. Pilih alternatif tanaman atau ubah waktu tanam.';
        }

                return response()->json([
                'tanggal_panen' => $tanggalPanen->format('d M Y'),
                'umur' => $umur,
                'status' => $status,
                'nilai_kecocokan' => round($nilaiTanaman, 3),
                'rekomendasi' => $rekomendasi,
                'alternatif_tanaman' => $status === 'Tidak Optimal' ? $alternatif : [],
                'bulan_terbaik' => $status === 'Tidak Optimal' ? array_values($bulanTerbaik) : []
            ]);
    }

private function getRentangBulan($tanam, $panen)
{
    $bulan = [];
    $current = $tanam;

    while (true) {
        $bulan[] = $current;
        if ($current == $panen) break;

        $current++;
        if ($current > 12) $current = 1;
    }

    return $bulan;
}

private function bulanToAngka($bulan)
{
    if (is_numeric($bulan)) {
        return (int)$bulan;
    }

    $map = [
        'Januari' => 1, 'Februari' => 2, 'Maret' => 3,
        'April' => 4, 'Mei' => 5, 'Juni' => 6,
        'Juli' => 7, 'Agustus' => 8, 'September' => 9,
        'Oktober' => 10, 'November' => 11, 'Desember' => 12
    ];

    return $map[$bulan] ?? 0;
}
    
}

