<?php

class Anggota{
    public $nama;
    public $nim;
    public $matkul;

   private function __construct($x, $y , $z)
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

class Laki extends Anggota{
    function penyapa(){
        $str = "{$this ->sebutNama()}, Kamu berpita merah";
        return $str;
    }
}

class Perempuan extends Anggota{
    function penyapa(){
        $str = "{$this ->sebutNama()}, Kamu berpita biru";
        return $str;
    }
}
$mhs1 = new Laki("Vikri", 2310, "BBP");
$mhs2 = new Perempuan("WatiK", 10, "BBP");  

//var_dump($mhs1);
$hasil = new Cetak(); 
echo $hasil -> cetakN($mhs1);
echo "<br>";
echo $mhs1 -> penyapa();
echo "<br>";
echo $mhs2 -> penyapa();
echo "<br>";
echo $hasil -> cetakN($mhs2);
echo "<br>";
