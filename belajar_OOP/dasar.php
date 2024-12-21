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
        return "Hallo {$this -> nama}, selamt datang di matakuliah {$this ->matkul}";
    }
}

$mhs1 = new Anggota("Vikri", 2310, "BBP");

var_dump($mhs1);
echo $mhs1->sebutNama();