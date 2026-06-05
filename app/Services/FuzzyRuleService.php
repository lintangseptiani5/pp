<?php

namespace App\Services;

class FuzzyRuleService
{
    public function inferensi($fuzzyTanam, $fuzzyPanen, $fuzzySuhu, $fuzzyKelembaban, $fuzzyHujan)
{
    $rules = [];

    // ========================
    // KANGKUNG (air tinggi, cepat)
    // ========================
    $rules['kangkung'][] = min(
        $fuzzyTanam['awal'],
        $fuzzySuhu['normal'],
        $fuzzyHujan['tinggi'],
        $fuzzyKelembaban['tinggi'],
        $fuzzyPanen['cepat']
    );

    $rules['kangkung'][] = min(
        $fuzzyTanam['tengah'],
        $fuzzySuhu['normal'],
        $fuzzyHujan['sedang'],
        $fuzzyKelembaban['tinggi'],
        $fuzzyPanen['cepat']
    );
    // kangkung fleksibel
    $rules['kangkung'][] = min(
        $fuzzyTanam['akhir'],
        $fuzzySuhu['normal'],
        $fuzzyHujan['tinggi'],
        $fuzzyKelembaban['tinggi'],
        $fuzzyPanen['cepat']
    );
    // TRANSISI AWAL-AKHIR (Desember-Januari)
    $rules['kangkung'][] = min(
        max($fuzzyTanam['awal'], $fuzzyTanam['akhir']),
        $fuzzySuhu['normal'],
        $fuzzyHujan['tinggi'],
        $fuzzyKelembaban['tinggi'],
        $fuzzyPanen['cepat']
    );

    // ========================
    // TOMAT (stabil)
    // ========================
    $rules['tomat'][] = min(
        $fuzzyTanam['tengah'],
        $fuzzySuhu['normal'],
        $fuzzyHujan['sedang'],
        $fuzzyKelembaban['normal'],
        $fuzzyPanen['sedang']
    );

    $rules['tomat'][] = min(
        $fuzzyTanam['awal'],
        $fuzzySuhu['normal'],
        $fuzzyHujan['sedang'],
        $fuzzyKelembaban['normal'],
        $fuzzyPanen['sedang']
    );

    // TOMAT fleksibel
    $rules['tomat'][] = min(
        $fuzzyTanam['tengah'],
        $fuzzySuhu['normal'],
        max($fuzzyHujan['sedang'], $fuzzyHujan['rendah']),
        max($fuzzyKelembaban['normal'], $fuzzyKelembaban['tinggi']),
        $fuzzyPanen['sedang']
    );

    // ========================
    // CABAI (panas & kering)
    // ========================
    $rules['cabai'][] = min(
        $fuzzyTanam['akhir'],
        $fuzzySuhu['panas'],
        $fuzzyHujan['rendah'],
        $fuzzyKelembaban['rendah'],
        $fuzzyPanen['lama']
    );

    $rules['cabai'][] = min(
        $fuzzyTanam['tengah'],
        $fuzzySuhu['panas'],
        $fuzzyHujan['rendah'],
        $fuzzyKelembaban['rendah'],
        $fuzzyPanen['lama']
    );

    $rules['cabai'][] = min(
    $fuzzyTanam['akhir'],
    max($fuzzySuhu['panas'], $fuzzySuhu['normal']),
    max($fuzzyHujan['rendah'], $fuzzyHujan['sedang']),
    max($fuzzyKelembaban['rendah'], $fuzzyKelembaban['normal']),
    $fuzzyPanen['lama']
);

    // ========================
    // AGREGASI MAX
    // ========================
    $hasil = [];

    foreach ($rules as $tanaman => $nilai) {
        $hasil[$tanaman] = max($nilai);
    }

    return $hasil;
}

    public function getRekomendasi($hasilRule)
    {
        if (empty($hasilRule)) {
            return ["Tidak ada rekomendasi"];
        }

        $threshold = 0.05;
        $minConfidence = 0.1;

        $max = max($hasilRule);

        if ($max < $minConfidence) {
            arsort($hasilRule);
            return [array_key_first($hasilRule)]; // ambil terbaik walau lemah
        }

        $rekomendasi = [];

        foreach ($hasilRule as $tanaman => $nilai) {
            if (($max - $nilai) <= $threshold) {
                $rekomendasi[] = $tanaman;
            }
        }

        return $rekomendasi;
    }
}