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
	$cp = fetch ($koneksi, 'cp', ['mapel' =>$mapel,'guru'=>$guru,'tingkat'=>$tingkat,'smt'=>$smt]);
	
	
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
		<h4>KURIKULUM MERDEKA</h4>
		</center>
		<br>
    <table width="100%">
	
            <tr style="vertical-align:top">
			 <td width='2%'></td>
			<td width="35%">SATUAN PENDIDIKAN</td>
            <td width='5px'>:</td>
            <td width="35%"><?= $setting['sekolah'] ?></td>
           
			 <td></td>
			<td>Tahun Pelajaran</td>
            <td width='5px'>:</td>
            <td><?= $setting['tp'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>MATA PELAJARAN</td>
            <td width='5px'>:</td>
            <td><?= $map['nama_mapel'] ?> </td>
           
            <td></td>
			<td>Fase/Kelas</td>
            <td width='5px'>:</td>
            <td><?= $level['fase'] ?> / <?= $kelas ?></td>
            </tr>
			
			
    </table>
	<br>
 <b>Capaian Pembelajaran Fase</b>
    <table width="100%">
	<tr>
	<td><?= $cp['capaian'] ?></td>										
	</tr>
    </table>
   <br>   
 
	 <table width="100%" border="1" style="font-size:12px;">
	<tr style="text-align:center">
    <td>ELEMEN</td>
	<td>TUJUAN PEMBELAJARAN (TP)</td>	
	<td >KONTEN (MATERI PELAJARAN)</td>
	<td width='10%'>WAKTU (JP)</td>
	<td width='5%'>KET</td>	
	</tr>
	<?php
	$query = mysqli_query($koneksi, "SELECT * FROM cp_elemen WHERE idcp='$cp[id]' and guru='$guru'"); 
	while ($data = mysqli_fetch_array($query)) :
	$tp = fetch ($koneksi, 'tp', ['idcp' =>$data['idcp'],'idelemen'=>$data['id_elemen']]);
	$atp = fetch ($koneksi, 'atp', ['idcp' =>$data['idcp'],'idel'=>$data['id_elemen']]);
	?>
	<tr>
	<td><?= $data['elemen'] ?></td>
	<td><?= $tp['tujuan'] ?></td>
	<td><?= $tp['lingkup'] ?></td>
	<td style="text-align:center"><?= $atp['waktu'] ?></td>
	<td></td>
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