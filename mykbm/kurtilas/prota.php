<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
    $smt= $_GET['smt'];
	$mapel= $_GET['mapel'];
	$kelas= $_GET['kelas'];
	$guru= $_GET['guru'];
	$level = fetch ($koneksi, 'kelas', ['kelas' =>$kelas]);
	$tingkat = $level['level'];
	$map = fetch ($koneksi, 'mapel', ['id' =>$mapel]);
	$usr = fetch ($koneksi, 'users', ['id_user' =>$guru]);
	
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>PROTA SMT <?= $smt ?></title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px;
 margin-right: 50px;
 margin-top: 40px;
 margin-bottom: 40px;
}
.bold{font-weight : bold;}
</style>
<body style="font-size: 14px;">	


<div style='background:#fff;'>
            <table width='100%'>
                <tr>
                    <td width='60px'><img src='../../images/<?= $setting['logo'] ?>' width='60px'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                          <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?></strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                        
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
              <br>
		<center><h3>PROGRAM TAHUNAN SEMESTER <?= $smt ?></h3>
		<h4>KURIKULUM 2013</h4>
		</center>
		<br>
    <table width="100%" style="font-size:13px">	
            <tr style="vertical-align:top">			
			<td width="30%">SATUAN PENDIDIKAN</td>
            <td width='5px'>:</td>
            <td width="35%"><?= $setting['sekolah'] ?></td>
           
			 <td></td>
			<td>TAHUN PELAJARAN</td>
            <td width='5px'>:</td>
            <td><?= $setting['tp'] ?></td>
            </tr>
			
			<tr>
           
			<td>MATA PELAJARAN</td>
            <td width='5px'>:</td>
            <td><?= $map['nama_mapel'] ?> </td>
           
            <td></td>
			<td>KELAS / SEMESTER</td>
            <td width='5px'>:</td>
            <td><?= $kelas ?> / <?= $smt ?></td>
            </tr>
			
			
    </table>
	<br>
 
	 <table width="100%" border="1" style="font-size:12px;">
	<tr style="text-align:center">
    <td>KOMPETENSI DASAR</td>
	<td>KOMPETENSI DASAR</td>	
	
	<td width='10%'>WAKTU (JP)</td>
	
	</tr>
	<?php
	$query = mysqli_query($koneksi, "SELECT * FROM rpp WHERE level='$tingkat' and mapel='$mapel' and guru='$guru'"); 
	while ($data = mysqli_fetch_array($query)) :
	
	?>
	<tr>
	<td>3.<?= $data['kd'] ?> <?= $data['des3'] ?></td>
	<td>4.<?= $data['kd'] ?> <?= $data['des4'] ?></td>
	<td style="text-align:center"><?= $data['alokasi'] ?> JP</td>
	
	</tr>
	<?php endwhile; ?>
    </table>
   <br>   
 
		<br>
	<table width='100%'>
					<tr>
					<td width="5%"></td>
					<td width='50px'></td>
						<td>
							Mengetahui, <br/>
							
					Kepala Sekolah
					<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='40%'></td>
						<td width="5%"></td>
						<td>
							<?= ucwords(strtolower($setting['kabupaten'])); ?>, <?= date('d'); ?> <?= bulan_indo($tanggal); ?> <?= date('Y') ?><br/>
							Guru Mapel<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $usr['nama'] ?></u><br/>
							NIP. <?= $usr['nip'] ?>
						</td>
					</tr>
				</table>
</div>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../pdf/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("PROTA ".$smt." ". $kelas ." - ".$map['kode'].".pdf", array("Attachment" => false));
exit(0);
?>