<?php

class UangRupiah
{
    private static array $satuan = [
        0 => "",
        1 => "satu",
        2 => "dua",
        3 => "tiga",
        4 => "empat",
        5 => "lima",
        6 => "enam",
        7 => "tujuh",
        8 => "delapan",
        9 => "sembilan"
    ];

    private static array $tingkat = [
        "",
        "ribu",
        "juta",
        "miliar",
        "triliun"
    ];

    public static function formatRp(int|string $angka): string
    {
        return "Rp. " . number_format($angka, 0, ",", ".");
    }

    public static function terbilang(int|string $angka): string
    {
        if (is_string($angka)) {
            $angka = str_replace(".", "", $angka);
        }

        if ($angka == 0) {
            return "nol";
        }

        $angka = str_pad($angka, ceil(strlen($angka) / 3) * 3, "0", STR_PAD_LEFT);
        $kelompok = str_split($angka, 3);

        $hasil = [];
        foreach ($kelompok as $i => $nilai) {
            $nilai = (int)$nilai;
            if ($nilai === 0) continue;

            $tingkat = self::$tingkat[count($kelompok) - $i - 1];
            $hasil[] = self::bacaRatusan($nilai) . " " . $tingkat;
        }

        return trim(preg_replace("/\s+/", " ", implode(" ", $hasil)));
    }

    private static function bacaRatusan(int $angka): string
    {
        $hasil = "";

        $ratus = intdiv($angka, 100);
        $puluh = intdiv($angka % 100, 10);
        $satu = $angka % 10;

        // Ratusan
        if ($ratus > 0) {
            $hasil .= $ratus == 1 ? "seratus" : self::$satuan[$ratus] . " ratus";
        }

        // Belasan
        if ($puluh == 1) {
            $belasan = $satu == 0 ? "sepuluh" : ($satu == 1 ? "sebelas" : self::$satuan[$satu] . " belas");
            $hasil .= " " . $belasan;
        } else {
            // Puluhan
            if ($puluh > 0) {
                $hasil .= " " . self::$satuan[$puluh] . " puluh";
            }
            // Satuan
            if ($satu > 0) {
                if ($puluh == 0 || $puluh > 1) {
                    $hasil .= " " . self::$satuan[$satu];
                }
            }
        }

        return trim($hasil);
    }
}

 
