<?php
class cetakNama{
public static $nama, $nim;

public static function Nama($nama){
	return "halo namaku".$nama;
}
}
echo cetakNama::Nama("Vikri");

//echo $a;
?>