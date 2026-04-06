<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$ids = $_GET['ids'];
	$dudi= $_GET['d'];
	$dudi = fetch($koneksi,'pkl_dudi',['id'=>$dudi]);
	$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
	$kelas = fetch($koneksi,'kelas',['kelas'=>$siswa['kelas']]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Sertifikat</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 10px; 
margin-right: 10px; 
margin-top: 10px;
margin-bottom: 0px;  
}
.tengah{
	text-align:center;
}
</style>
<body style="font-size:15px">	
                      							
   <img src="../../images/kartu/frame.png" style="z-index: 800;position:absolute;width:1100px;height:770px">
<br><img src="../../images/<?= $setting['logo'] ?>" style="z-index: 800;position:absolute;margin-top:30px;margin-left:950px;width:60px">
<br><img src="../../images/<?= $dudi['logo'] ?>" style="z-index: 800;position:absolute;margin-top:6;margin-left:870px;width:65px">
<br><p class="tengah" style="margin-top:150px">Diberikan Kepada:</p>
<br><p class="tengah" style="font-size:28px;font-weight:bold"><?= $siswa['nama'] ?></p>							 
     <table style="margin-left:350px;width:100%">
	 <tr>
    <td width="20%">Tempat, Tanggal Lahir</td>
	<td width="1%">:</td>
	<td><?= $siswa['t_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></td>
     </tr>
     
	 <tr>
    <td width="20%">Nomor Induk Siswa Nasional</td>
	<td width="1%">:</td>
	<td><?= $siswa['nisn'] ?></td>
     </tr>
      <tr>
    <td width="20%">Bidang Keahlian</td>
	<td width="1%">:</td>
	<td><?= $kelas['bk'] ?></td>
     </tr>	 
	 <tr>
    <td width="20%">Program Keahlian</td>
	<td width="1%">:</td>
	<td><?= $kelas['pk'] ?></td>
     </tr>
	  <tr>
    <td width="20%">Kompetensi Keahlian</td>
	<td width="1%">:</td>
	<td><?= $kelas['kk'] ?></td>
     </tr>
	  <tr>
    <td width="20%">Satuan Pendidikan</td>
	<td width="1%">:</td>
	<td width="40%"><?= $setting['sekolah'] ?></td>
     </tr>
	</table>
	<br><p class="tengah">Telah melaksanakam Praktik Kerja Lapangan (PKL) selama 6 bulan di <?= strtoupper($dudi['nama_dudi']) ?><br>dengan hasil <b>Baik</b></p>		
<br>
  <img src="../../images/<?= $setting['logo'] ?>" style="z-index: 800;position:absolute;margin-top:-170;margin-left:400px;width:300px;opacity:0.08;">
  <table style="margin-left:200px;width:100%">
	 <tr>
    <td width="40%">
	<br>Kepala Sekolah<br>
	<?= $setting['sekolah'] ?>
	<br><br><br><br><br>
	<b><?= $setting['kepsek'] ?></b>
	</td>
	<td width="20%"></td>
	<td><?= $setting['kabupaten'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?> <br>
	Pimpinan<br><?= ucwords(strtolower($dudi['nama_dudi'])) ?>
	<br><br><br><br><br>
	<b><?= $dudi['direksi'] ?></b>
	</td>
     </tr>
	 </table>
	  <p style="page-break-before: always;"></p>
	  <img src="../../images/kartu/frame2.png" style="z-index: 800;position:absolute;width:1100px;height:770px">
<br><br>
<p class="tengah" style="font-size:18px;font-weight:bold;">DAFTAR NILAI PRAKTIK KERJA INDUSTRI (PRAKERIN)</p>
<br><p class="tengah" style="font-size:18px;font-weight:bold;margin-top:-20px"><?= $setting['sekolah'] ?></p>
<br><p class="tengah" style="font-size:18px;font-weight:bold;margin-top:-20px">TAHUN PELAJARAN <?= $setting['tp'] ?></p>

<hr style="margin:1px">
<hr style="margin:2px">
<br>
<table style="width:100%;margin-left:170px;margin-right:10px">
	 <tr>
    <td width="15%">Nama Siswa</td>
	<td width="30%">: <?= ucwords(strtolower($siswa['nama'])) ?></td>
	<td width="5%"></td>
	<td width="18%">Bidang Study Keahlian</td>
	<td>: <?= $kelas['bk'] ?></td>
     </tr>
	  <tr>
    <td>No. Induk Siswa</td>
	<td>: <?= $siswa['nis'] ?></td>
	<td></td>
	<td>Program Study Keahlian</td>
	<td>: <?= $kelas['pk'] ?></td>
     </tr>
	  <tr>
    <td>N I S N</td>
	<td>: <?= $siswa['nisn'] ?></td>
	<td></td>
	<td>Kompetensi Keahlian</td>
	<td>: <?= $kelas['kk'] ?></td>
     </tr>
	 </table>
	 
	 <b style="margin-left:170px">TEMPAT PRAKERIN</b>	
	 <table style="width:100%;margin-left:170px">
	 <tr>
    <td width="15%">Nama DU/DI</td>
	<td>: <?= ucwords(strtolower($dudi['nama_dudi'])) ?></td>
	</tr>
	<tr>
	<td width="15%">Alamat DU/DI</td>
	<td>: <?= ucwords(strtolower($dudi['alamat'])) ?></td>
     </tr>
	  </table>
	  <br>
	  <table style="width:100%;margin-left:300px;margin-right:300px;font-size:12px" border="1">
	  <tr>
	  <td rowspan="2" class="tengah">NO</td>
	   <td rowspan="2" class="tengah">ASPEK PENILAIAN</td>
	   <td colspan="2" class="tengah">NILAI</td>	   
	  </tr>
	  <tr>
	  <td class="tengah">ANGKA</td>
	  <td class="tengah">HURUF</td>
	  </tr>
	   <?php
	$sql = mysqli_query($koneksi,"select * from pkl_mnilai");
     $no = 0;
      while ($data = mysqli_fetch_array($sql)):
	 $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_nilai  WHERE idsiswa='$ids' and ida='$data[id]' and ket='1'"));
	if($nilai['nilai'] < 70){$huruf='D';}if($nilai['nilai'] >= 70 and $nilai['nilai'] <= 80){$huruf='C';}
	if($nilai['nilai'] >= 80 and $nilai['nilai'] <= 90){$huruf='B';}
	if($nilai['nilai'] >= 90 and $nilai['nilai'] <= 100){$huruf='A';}
	$no++;
	?>
	<tr>
	<td class="tengah"><?= $no ?></td>
	<td><?= $data['aspek'] ?></td>
	<td class="tengah"><?= $nilai['nilai'] ?></td>
	<td class="tengah">
	<?php if($nilai['nilai']<>0): ?>
	<?= $huruf ?>
	<?php endif; ?>
	</td>
	</tr>
	<?php endwhile; ?>
	
	</table>
	 
	  <table style="margin-left:200px;width:100%;font-size:14px">
	 <tr>
    <td width="40%">Mengetahui,
	<br>Kepala Sekolah<br>
	<?= $setting['sekolah'] ?>
	<br><br><br><br><br>
	<b><?= $setting['kepsek'] ?></b>
	</td>
	<td width="20%"></td>
	<td><?= $setting['kabupaten'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?> <br>
	Pimpinan<br><?= ucwords(strtolower($dudi['nama_dudi'])) ?>
	<br><br><br><br><br>
	<b><?= $dudi['direksi'] ?></b>
	</td>
     </tr>
	 </table>
	  <br>
  <img src="../../images/<?= $setting['logo'] ?>" style="z-index: 800;position:absolute;margin-top:-370;margin-left:400px;width:300px;opacity:0.08;">
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
$dompdf->stream("Sertifikat PKL " .$siswa['nama']. ".pdf", array("Attachment" => false));
exit(0);
?>