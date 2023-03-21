<?php  
echo "No 6. Buat 1 function dengan berisikan code dengan ketentuan: <br><br>
Ada 2 Buah Variabel yaitu A = 5 dan B = 3, bagaimana melakukan swapping variable <br><br>
sehingga nilai A = 3 dan B =5, tanpa melakukan memakai variabel tambahan / temporary.<br><br>";  

$a = 5;  
$b = 3;  

$third = $a;  
$a = $b;  
$b = $third;  
echo "Setelah swapping:<br><br>";  
echo "a =".$a."  b=".$b;  

echo " <br><br> No 7. Buatlah sebuah code untuk mengubah semua angka antara 1 sampai dengan 1.000.000.000, <br><br>
menjadi sebuah kata. Contoh 1000.300.123 -> Satu Milyar Tiga Ratus Ribu Seratus Dua 
Puluh Tiga. <br><br>";  


function terbilang($x)
{
    $angka = array(
        "",
        "Satu",
        "Dua",
        "Tiga",
        "Empat",
        "Lima",
        "Enam",
        "Tujuh",
        "Delapan",
        "Sembilan",
        "Sepuluh",
        "Sebelas"
    );
    if ($x < 12)
        return " " . $angka[$x];
    elseif ($x < 20)
        return terbilang($x - 10) . " Belas";
    elseif ($x < 100)
        return terbilang($x / 10) . " Puluh" . terbilang($x % 10);
    elseif ($x < 200)
        return " Seratus" . terbilang($x - 100);
    elseif ($x < 1000)
        return terbilang($x / 100) . " Ratus" . terbilang($x % 100);
    elseif ($x < 2000)
        return " Seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
        return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
        return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);
    elseif ($x < 1000000000000)
        return terbilang($x / 1000000000) . " Milyar" . terbilang(fmod($x, 1000000000));
    else
        return "Angka terlalu besar";
}

$angka = 1000300123;
$terbilang = terbilang($angka);
echo $terbilang;


?>  