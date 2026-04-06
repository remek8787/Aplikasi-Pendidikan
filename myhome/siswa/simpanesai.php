<?php

require("../../konek/koneksi.php");
require("../../konek/function.php");


$kode = $_POST['id'];
$nilai = mysqli_fetch_array(mysqli_query($koneksi, "select * from nilai a join banksoal b on a.id_bank=b.id_bank where a.id_nilai='$kode'"));
$soal = mysqli_fetch_array(mysqli_query($koneksi, "select SUM(max_skor) AS skr from soal where id_bank='$nilai[id_bank]'"));

$aresay = $_POST['nesai' . $kode];
$nesai = serialize($aresay);
$sum = 0;
foreach ($aresay as $id => $value) {
	$sum = $sum + $value;
}
 if($value > $_POST['makskor']):
 echo'GAGAL';
 else:
$total = $nilai['skor'] + $sum + $nilai['skor_multi'] + $nilai['skor_bs'] + $nilai['skor_urut'];
$simpan = mysqli_query($koneksi, "UPDATE nilai set skor_esai='$sum', nilai_esai2='$nesai',total='$total' where id_nilai = '$kode'");
if($simpan){
	$nilaimu = mysqli_fetch_array(mysqli_query($koneksi, "select * from nilai where id_nilai='$kode'"));
$nil = ($nilaimu['total']/$nilaimu['makskor'])*100;
$nilQ = round($nil);
$exec = mysqli_query($koneksi, "UPDATE nilai set nilai='$nilQ' where id_nilai = '$kode'");
}

echo 'OK';
endif;