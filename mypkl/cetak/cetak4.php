<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$ids = $_GET['ids'];
	$wt = fetch($koneksi,'pkl_panitia',['id'=>1]);
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

    <title>MONITOR & EVALUASI PKL</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px; 
margin-right: 80px; 
margin-top: 80px;
margin-bottom: 10px;  
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


<table width="100%" style="font-size:14px" >
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
	<td>Nama Pembimbing</td>
	<td>: <?= $peg['nama'] ?></td>	
	</tr>
	<tr>
	<td>Alamat Industri</td>
	<td>: <?= ucwords(strtolower($dudi['alamat'])) ?></td>	
	</tr>
	
	<tr>
	<td>Waktu Pkl </td>
	<td>: <?= $wt['dari'] ?> s/d <?= $wt['sampai'] ?></td>	
	</tr>
	</table>
	
	
	<br>
	 <table width="100%" border="1" style="font-size:14px">
	<tr style="vertical-align:middle" class="tengah bold">
	<td rowspan="2" width="5%">No.</td>
	<td rowspan="2">Monitoring</td>
	<td rowspan="2">Evaluasi</td>
	<td colspan="2">Check (V)</td>
	</tr>
	
	<tr>
	<td width="8%" class="tengah bold">Ya</td>
	<td width="8%" class="tengah bold">Tidak</td>	
	</tr>
	
    <?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM pkl_monitor");
		while ($data = mysqli_fetch_array($query)) :
		$soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_evaluasi WHERE idm='$data[id]' and idsiswa='$ids'"));	
		($soal['jawab'] == 'T') ? $jwbT = 'V' : $jwbT = '';
		($soal['jawab'] == 'Y') ? $jwbY = 'V' : $jwbY = '';
		$no++;
		 ?>
        <tr style="vertical-align:middle;">
        <td class="tengah"><?= $no; ?></td>                                           
	    <td><?= $data['monitoring'] ?></td>
		<td><?= $data['evaluasi'] ?></td>
         <td class="tengah"><?= $jwbY ?></td>
		 <td class="tengah"><?= $jwbT ?></td>
	</tr>
	<?php endwhile; ?>
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
$dompdf->stream("Evaluasi " .$siswa['nama']. ".pdf", array("Attachment" => false));
exit(0);
?>