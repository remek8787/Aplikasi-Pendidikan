<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>COVER</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 50px; }
body { 
margin-left: 100px; 
margin-right: 50px;
margin-top: 80px;
margin-bottom: 50px;
}
</style>
<style>
div {
  
  width: 100%;
  height:auto;
  border: 2px solid black;
  padding: 10px;
 
}
.bold{
	font-weight:bold;
}
</style>
<body>	
<div>
<br><br><br>
<center>
<img src="../../images/<?= $setting['pemda'] ?>" style="max-width:150px;">
<?php if($setting['jenjang']=='SMK'): ?>
<h4 class="bold">DINAS PENDIDIKAN PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
<h4 class="bold">SEKOLAH MENENGAH KEJURUAN</h4>
<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
<?php endif; ?>
<?php if($setting['jenjang']=='SMA'): ?>
<h4 class="bold">DINAS PENDIDIKAN PROPINSI <?= strtoupper($setting['propinsi']) ?></h4>
<h4 class="bold">SEKOLAH MENENGAH ATAS</h4>
<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
<?php endif; ?>
<?php if($setting['jenjang']=='SMP'): ?>
<h4 class="bold">DINAS PENDIDIKAN KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
<h4 class="bold">SEKOLAH MENENGAH PERTAMA</h4>
<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
<?php endif; ?>
<?php if($setting['jenjang']=='SD'): ?>
<h4 class="bold">DINAS PENDIDIKAN KABUPATEN <?= strtoupper($setting['kabupaten']) ?></h4>
<h4 class="bold">SEKOLAH DASAR</h4>
<h4 class="bold"><?= strtoupper($setting['sekolah']) ?></h4>
<?php endif; ?>
<br>
<p>Alamat : <?= $setting['alamat'] ?> Desa <?= $setting['desa'] ?> Kec. <?= $setting['kecamatan'] ?> Kab. <?= $setting['kabupaten'] ?> - <?= $setting['propinsi'] ?></p>
<br><br><br>
<img src="../../images/<?= $setting['logo'] ?>" style="max-width:150px;">
<h3 class="bold">LAPORAN BULANAN</h3>
<table style="width:80%;margin-left:350px">
<tr style="text-align:left">
<td width="45%"><h4>UNTUK BULAN</h4></td>
<td><h4>: <?= strtoupper(bulan_indo($tanggal)) ?></h4></td>
</tr>
<tr>
<td><h4>TAHUN PELAJARAN</h4></td>
<td><h4>: <?= $setting['tp'] ?></h4> </td>
</tr>
</table>
<br>
</center>
</div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'Landscape');
$dompdf->render();
$dompdf->stream("Cover Laporan.pdf", array("Attachment" => false));
exit(0);
?>