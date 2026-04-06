<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa"));	
$gnon = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='NON PNS' and level='guru'"));
$gpns = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='PNS/ASN' and level='guru'"));
$tnon = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='NON PNS' and level='staff'"));
$tpns = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='PNS/ASN' and level='staff'"));
$jnon = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='NON PNS' and level='jaga'"));
$jpns = mysqli_num_rows(mysqli_query($koneksi, "SELECT status,level FROM users where status='PNS/ASN' and level='jaga'"));


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>LAMPIRAN 2</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px; 
margin-right: 50px;
margin-top: 40px;
margin-bottom: 20px;
}
.atas{
transform:rotate(-90deg);
-ms-transform:rotate(-90deg); /* IE 9 */
-webkit-transform:rotate(-90deg); /* Safari and Chrome */
}
</style>
<style>
.bold{
	font-weight:bold;
}
.tengah{
	text-align:center;
}

</style>

<body>	
<p>LAMPIRAN : II</p>
<p>DAFTAR PEMBAGIAN TUGAS GURU </p>
<p>Keadaan pada Bulan <?= bulan_indo($tanggal) ?> <?= $tahun ?></p>
<br>
      <table width="100%" border="1" style="font-size:12px">
   <tr class="tengah bold">   
  <td rowspan="2" height="60px">No</td>
  <td  rowspan="2">Nama/Nip/Nuptk</td>
  <td  rowspan="2">L/P </td>
  <td  rowspan="2">Jabatan</td>
  <td  rowspan="2">Ijazah</td>
  <td  rowspan="2">Mengajar<br>Bidang Studi</td>
  <td  rowspan="2">Sertifikasi<br>Tahun</td>
  <td  colspan="3">Jumlah Jam Mengajar Di Kelas</td>
  <td  rowspan="2">Tugas Tambahan</td>
  <td  rowspan="2">Jumlah<br>Jam Seluruh</td>
  <td  rowspan="2">Keterangan</td>
 </tr>   
 <tr class="tengah bold">  
<td>X</td>
<td>XI</td>
<td>XII</td>
</tr>
<?php
$no=0;
	$query = mysqli_query($koneksi, "SELECT * FROM users where level='guru'"); 
	while ($data = mysqli_fetch_array($query)) :
	$j1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sk_peg where idpeg='$data[id_user]' and idsk='2' and level='10'"));
	$j2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sk_peg where idpeg='$data[id_user]' and idsk='2' and level='11'"));
	$j3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sk_peg where idpeg='$data[id_user]' and idsk='2' and level='12'"));
	$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jjm) as jumlah,idpeg FROM sk_peg  WHERE idpeg='$data[id_user]' GROUP BY idpeg"));
	$jjm2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jjm_tugas) as jumlah,idpeg FROM sk_peg  WHERE idpeg='$data[id_user]' GROUP BY idpeg"));
		
	$no++;
	?>
	<tr>
	<td class="tengah"><?= $no; ?></td>
	<td><?= $data['nama'] ?><br><?= $data['nip'] ?></td>
	<td class="tengah"><?= $data['jk'] ?></td>
	<td class="tengah"><?= $data['jabatan'] ?></td>
	<td class="tengah"><?= $data['pendidikan'] ?></td>
	<td>
	<?php
	$que = mysqli_query($koneksi, "SELECT * FROM sk_peg where idpeg='$data[id_user]' and idsk='2' and mapel<>''"); 
	while ($dt = mysqli_fetch_array($que)) :
	
	?>
	* <?= $dt['mapel'] ?><br>
	<?php endwhile; ?>
	</td>
	<td></td>
	<td class="tengah"><?php if($j1<>0): ?> V <?php endif; ?></td>
	<td class="tengah"><?php if($j2<>0): ?> V <?php endif; ?></td>
	<td class="tengah"><?php if($j3<>0): ?> V <?php endif; ?></td>
	<td>
	<?php
	$queryx = mysqli_query($koneksi, "SELECT * FROM sk_peg where idpeg='$data[id_user]' and idsk='2' and lainnya<>''"); 
	while ($dtx = mysqli_fetch_array($queryx)) :
	$tgas = fetch($koneksi,'m_tugas',['idt'=>$dtx['lainnya']]);
	?>
	* <?= ucwords(strtolower($tgas['tugas'])) ?><br>
	<?php endwhile; ?>
	</td>
	<td class="tengah"><?= $jjm['jumlah'] + $jjm2['jumlah'] ?></td>
	<td></td>
</tr>
 <?php endwhile; ?>
   </table>	
<br>   
   <table width="100%" style="margin-left:50px">
   <tr>
   <td width="40%">
 
   </td>
   <td></td>
   <td><?= $setting['kecamatan'] ?>, <?php echo date("t",time());?>  <?= bulan_indo($tanggal) ?> <?= $tahun ?>
   <br>Kepala Sekolah<br>
    <br><br><br>
	<u><?= $setting['kepsek'] ?></u><br>
	NIP.<?= $setting['nip'] ?>
   </td>
    </tr>     
   </table>			
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
$dompdf->stream("Lampiran II .pdf", array("Attachment" => false));
exit(0);
?>