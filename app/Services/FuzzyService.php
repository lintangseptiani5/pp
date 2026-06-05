<?php

namespace App\Services;

class FuzzyService
{
    public function trapezoid($x, $a, $b, $c, $d)
    {
        if ($x <= $a) return 0;
        if ($x >= $d) return 0;

        if ($x > $a && $x < $b) {
            return ($x - $a) / ($b - $a);
        }

        if ($x >= $b && $x <= $c) {
            return 1;
        }

        if ($x > $c && $x < $d) {
            return ($d - $x) / ($d - $c);
        }

        return 0;
    }   

   public function fuzzifikasiTanam($x)
    {
        return [
            'awal' => max(
                $this->trapezoid($x, 1, 1, 2, 4),
                $this->trapezoid($x, 10, 11, 12, 12) // TAMBAHAN PENTING
            ),            
            'tengah' => $this->trapezoid($x, 3, 5, 7, 9),
            'akhir' => $this->trapezoid($x, 8, 10, 12, 12),
        ];
    }

    public function fuzzifikasiPanen($x)
    {
        return [
            'cepat' => $this->trapezoid($x, 1, 2, 4, 6),
            'sedang' => $this->trapezoid($x, 4, 6, 8, 10),
            'lama' => $this->trapezoid($x, 8, 10, 11, 12),
        ];
    }
public function fuzzifikasiSuhu($x)
{
    return [
        'dingin' => $this->trapezoid($x, 15, 18, 20, 23),
        'normal' => $this->trapezoid($x, 22, 25, 28, 30),
        'panas'  => $this->trapezoid($x, 28, 30, 35, 38),
    ];
}


public function fuzzifikasiKelembaban($x)
{
    return [
        'rendah' => $this->trapezoid($x, 40, 50, 60, 70),
        'normal' => $this->trapezoid($x, 60, 70, 80, 90),
        'tinggi' => $this->trapezoid($x, 80, 90, 100, 100),
    ];
}

public function fuzzifikasiHujan($x)
{
    return [
        'rendah' => $this->trapezoid($x, 0, 50, 100, 150),
        'sedang' => $this->trapezoid($x, 100, 150, 250, 300),
        'tinggi' => $this->trapezoid($x, 250, 300, 400, 500),
    ];
}
}