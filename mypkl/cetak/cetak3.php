<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$ids = $_GET['ids'];
	
	$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
	$kk = fetch($koneksi,'kelas',['kelas'=>$siswa['kelas']]);
	$pkl = fetch($koneksi,'pkl_siswa',['idsiswa'=>$ids]);
	$dudi = fetch($koneksi,'pkl_dudi',['id'=>$pkl['dudi']]);
	$gp = fetch($koneksi,'pkl_pembimbing',['kelas'=>$siswa['kelas'],'dudi'=>$pkl['dudi']]);
	$peg = fetch($koneksi,'users',['id_user'=>$gp['idpeg']]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>NILAI PKL</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px; 
margin-right: 80px; 
margin-top: 80px;
margin-bottom: 20px;  
}
.tengah{
	text-align:center;
}
}
.bold{
	font-weight:bold;
}
</style>
<body>	


<table width="100%" >
	<tr>
	<td width="30%">Nama Peserta Dididk</td>
	<td>: <?= ucwords(strtolower($siswa['nama'])) ?></td>	
	</tr>
	<tr>
	<td>Kelas</td>
	<td>: <?= $siswa['kelas'] ?></td>	
	</tr>
	<tr>
	<td>Semester</td>
	<td>: <?= $setting['semester'] ?></td>	
	</tr>
	<tr>
	<td>Kompetensi Keahlian</td>
	<td>: <?= $kk['kk'] ?></td>	
	</tr>
	<tr>
	<td>Nama Industri</td>
	<td>: <?= ucwords(strtolower($dudi['nama_dudi'])) ?></td>	
	</tr>
	<tr>
	<td>Nama Instruktur</td>
	<td>: <?= $gp['instruktur'] ?></td>	
	</tr>
	</table>
	
	
	<br>
	 <table width="100%" border="1">
	<tr style="vertical-align:middle" class="tengah bold">
	<td>No.</td>
	<td>Komponen Penilaian</td>
	<td>Skor<br>(0-100)</td>
	<td>Keterangan</td>
	</tr>
	</tr>
    <?php
	$sql = mysqli_query($koneksi,"select kode from pkl_mnilai GROUP BY kode");
     $no = 0;
      while ($data = mysqli_fetch_array($sql)):
	 
	$no++;
	?>
	<tr>
	<td class="tengah"><?= $no ?></td>
	<td class="bold">
	<?php if($data['kode']=='A'): ?>Aspek Sikap<?php endif; ?>
	<?php if($data['kode']=='B'): ?>Aspek Pengetahuan<?php endif; ?>
	<?php if($data['kode']=='C'): ?>Aspek Keterampilan<?php endif; ?>
	</td>
	<td></td>
	<td></td>
	</tr>
	<?php
	 $query = mysqli_query($koneksi,"select * from pkl_mnilai WHERE kode='$data[kode]'");
	  while ($mapel = mysqli_fetch_array($query)):
	$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_nilai  WHERE idsiswa='$ids' and ida='$mapel[id]' and ket='1'"));
	if($nilai['nilai'] < 70){$huruf='D';}if($nilai['nilai'] >= 70 and $nilai['nilai'] <= 80){$huruf='C';}
	if($nilai['nilai'] >= 80 and $nilai['nilai'] <= 90){$huruf='B';}
	if($nilai['nilai'] >= 90 and $nilai['nilai'] <= 100){$huruf='A';}
	?>
	<tr>
	<td></td>
	<td><?= $mapel['aspek'] ?></td>
	<td class="tengah"><?= $nilai['nilai'] ?></td>
	<td class="tengah">
	<?php if($nilai['nilai']<>0): ?>
	<?= $huruf ?>
	<?php endif; ?>
	</td>
	</tr>
	<?php endwhile; ?>
	
	<?php endwhile; ?>
	<?php
	$rtpkl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,ket,avg(nilai) as rata FROM pkl_nilai  WHERE idsiswa='$ids' and ket='1'"));
	$nlap = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_nilai  WHERE idsiswa='$ids' and ket='2'"));
	$ratax = round(($nlap['nilai']*20)/100 + ($rtpkl['rata']*80)/100);
	if($ratax < 70){$huruff='D';}
	if($ratax >= 70 and $ratax <= 80){$huruff='C';}
	if($ratax >= 80 and $ratax <= 90){$huruff='B';}
	if($ratax >= 90 and $ratax <= 100){$huruff='A';}
	?>
	<tr>
	<td colspan="2" class="bold">Nilai Rata-rata Nilai 1,2, & 3 (80%)</td>
	<td class="tengah bold"><?= round(($rtpkl['rata']*80)/100) ?></td>
	<td class="tengah bold"></td>
	</tr>
	<tr>
	<td class="tengah">4</td>
	<td>Nilai Laporan PKL (20%)</td>
	<td class="tengah bold"><?= round(($nlap['nilai']*20)/100) ?></td>
	<td></td>
	</tr>
	<tr>
	<td colspan="2" class="bold">Nilai Akhir PKL</td>
	<td class="tengah bold"><?= round(($nlap['nilai']*20)/100 + ($rtpkl['rata']*80)/100) ?></td>
	<td class="tengah bold"><?= $huruff ?></td>
	</tr>
	</table>
	<br>
	<table width="100%" border="1">
	<tr>
	<td height="40px" class="tengah bold">NA = (Nilai Rata-rata 1,2, &3) x 80% + (Nilai Laporan PKL) x 20% </td>
	</tr>
	</table>
	
	<br>
	 <table width="100%">
	<tr style="vertical-align:top">
	<td width="55%"></td>
	<td>
	<?= ucwords(strtolower($setting['kecamatan'])); ?>, <?php echo date("t",time()); ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?><br/>
	Kepala Sekolah
	<br><br><br><br>
	<b><u><?= $setting['kepsek'] ?></u></b>
	<br>NIP/NUPTK. <?= $setting['nip'] ?>	
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
$dompdf->stream("Rekomendasi PKL Kelas " .$kelas. ".pdf", array("Attachment" => false));
exit(0);
?>