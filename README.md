# UangRupiah-Format-Uang-Ke-Rupiah
script simple php untuk konversi uang ke rupiah maupun ke bacaan uang

## Contoh Penggunaan

```php
<?php 
require "UangRupiah.php";

echo UangRupiah::formatRp(2345678901234) . "\n"; 
// Rp. 2.345.678.901.234

echo UangRupiah::terbilang(2345678901234) . "\n"; 
// dua triliun tiga ratus empat puluh lima miliar enam ratus tujuh puluh delapan juta sembilan ratus satu ribu dua ratus tiga puluh empat
