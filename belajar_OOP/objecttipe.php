<?php

class Anggota{
    public $nama;
    public $nim;
    public $matkul;

    public function __construct($x, $y , $z)
    {
        $this -> nama = $x;
        $this -> nim = $y;
        $this -> matkul = $z;
    }
    public function sebutNama(){
        echo "selamat pagi {$this -> nama}";
    }
}
class Cetak{
    public function cetakN(Anggota $anggota){
        $result = "Hallo {$anggota -> nama}, selamt datang di matakuliah {$anggota ->matkul}";
        return $result;
    }
}
$mhs1 = new Anggota("Vikri", 2310, "BBP");
$mhs2 = new Anggota("Sumanto", 10, "BBP");

//var_dump($mhs1);
$hasil = new Cetak(); 
echo $hasil -> cetakN($mhs1);
echo "<br>";
echo $hasil -> cetakN($mhs2);