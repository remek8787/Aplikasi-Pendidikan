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
    <title>PROMES</title>
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
		<center><h3>PROGRAM SEMESTER</h3>
		<h4>KURIKULUM 2013</h4>
		</center>
		<br>
    <table width="100%">
	
            <tr style="vertical-align:top">
			 <td width='2%'></td>
			<td width="35%">SATUAN PENDIDIKAN</td>
            <td width='5px'>:</td>
            <td width="35%"><?= $setting['sekolah'] ?></td>
           
			 <td></td>
			<td>TAHUN PELAJARAN</td>
            <td width='5px'>:</td>
            <td><?= $setting['tp'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>MATA PELAJARAN</td>
            <td width='5px'>:</td>
            <td><?= $map['nama_mapel'] ?> </td>
           
            <td></td>
			<td>KELAS / SEMESTER</td>
            <td width='5px'>:</td>
            <td><?= $level['fase'] ?> - <?= $kelas ?> / <?= $smt ?></td>
            </tr>
			
			
    </table>
	<br>
 
	 <table width="100%" border="1" style="font-size:12px;">
	<tr style="text-align:center">
    <td rowspan="2">KOMPETENSI DASAR</td>
	<td rowspan="2">KOMPETENSI DASAR</td>	
	<td rowspan="2" width='7%'>ALOKASI WAKTU</td>
	<?php if($smt==1): ?>
	<td colspan="2">JULI</td>
	<td colspan="5">AGUSTUS</td>
    <td colspan="4">SEPTEMBER</td>	
	<td colspan="4" >OKTOBER</td>
	<td colspan="5" >NOPEMBER</td>
	<td colspan="2" width="5%">DESEMBER</td>
	<?php else: ?>
	<td colspan="4">JANUARI</td>
	<td colspan="4">FEBRUARI</td>
    <td colspan="4">MARET</td>	
	<td colspan="4" >APRIL</td>
	<td colspan="5" >MEI</td>
	<td colspan="2" width="5%">JUNI</td>
	<?php endif; ?>
	</tr>
	<tr style="text-align:center">
<?php if($smt==1): ?>	
	<td style="background-color:red" width="2%"></td>
	<td width="2%">1</td>
	<td width="2%">2</td>
	<td width="2%">3</td>
	<td width="2%">4</td>
	<td width="2%">5</td>
	<td width="2%">6</td>
	<td width="2%">7</td>
	<td width="2%">8</td>
	<td width="2%">9</td>
	<td width="2%">10</td>
	<td width="2%">11</td>
	<td width="2%">12</td>
	<td width="2%">13</td>
	<td width="2%">14</td>
	<td width="2%">15</td>
	<td width="2%">16</td>
	<td width="2%">17</td>
	<td width="2%">18</td>
	<td width="2%">19</td>
	<td width="2%">20</td>
	<td style="background-color:red"></td>
	<?php else: ?>
	<td width="2%">1</td>
	<td width="2%">2</td>
	<td width="2%">3</td>
	<td width="2%">4</td>
	<td width="2%">5</td>
	<td width="2%">6</td>
	<td width="2%">7</td>
	<td width="2%">8</td>
	<td width="2%">9</td>
	<td width="2%">10</td>
	<td width="2%">11</td>
	<td width="2%">12</td>
	<td width="2%">13</td>
	<td width="2%">14</td>
	<td width="2%">15</td>
	<td width="2%">16</td>
	<td width="2%">17</td>
	<td width="2%">18</td>
	<td width="2%">19</td>
	<td width="2%">20</td>
	<td width="2%">21</td>
	<td width="2%">22</td>
	<td style="background-color:red"></td>
	<?php endif; ?>
	</tr>
	
	<?php
	$query = mysqli_query($koneksi, "SELECT * FROM rpp WHERE level='$tingkat' and mapel='$mapel' and guru='$guru'"); 
	while ($data = mysqli_fetch_array($query)) :
	
	?>
	<tr>

	<td>3.<?= $data['kd'] ?> <?= $data['des3'] ?></td>
	<td>4.<?= $data['kd'] ?> <?= $data['des4'] ?></td>
	<td style="text-align:center">X<br><?= $data['alokasi'] ?> JP</td>
	<td style="background-color:red"></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td style="background-color:red"></td>
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
$dompdf->setPaper('A4', 'Landscape');
$dompdf->render();
$dompdf->stream("PROMES ".$smt." ". $kelas ." - ".$map['kode'].".pdf", array("Attachment" => false));
exit(0);
?>