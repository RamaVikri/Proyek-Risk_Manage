<?php
// Preload Code 
$input = trim(fgets(STDIN));
$harga_barang = explode(' ', str_replace(',', ' ', $input));

$harga_barang1 = (int)$harga_barang[0];
$harga_barang2 = (int)$harga_barang[1];
$harga_barang3 = (int)$harga_barang[2];

//mulai kerjakan dari sini
$total_harga = $harga_barang1+ $harga_barang2+$harga_barang3;
$total_harga_dengan_pajak = ($total_harga+(($total_harga)*0.1));
$total_harga_akhir = ($total_harga_dengan_pajak)-(($total_harga_dengan_pajak)*0.05);

// Output hasil dalam format yang sesuai
echo "Total harga setelah pajak: Rp" . number_format($total_harga_dengan_pajak, 0, ',', '.') . "\n";
echo "Total harga setelah diskon: Rp" . number_format($total_harga_akhir, 0, ',', '.') . "\n";