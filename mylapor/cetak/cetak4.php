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

    <title>LAMPIRAN 1</title>

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
<style>
.divTable {
    width: 100%;
    display: table;
  
}
.divTableRow {
    width: 100%;
    height: 100%;
    display: table-row;
}
.divTableCell{
    padding:5px;
    width: 50%;
    display: table-cell;
}
</style>
<body>	
<p>LAMPIRAN : I</p>
<p>DAFTAR PERINCIAN JUMLAH SISWA DAN GURU</p>
<p>Keadaan pada Bulan <?= bulan_indo($tanggal) ?> <?= $tahun ?></p>
<br>
      <table width="100%" border="1" style="font-size:12px">
   <tr class="tengah bold">   
   <td colspan="4">MODEL - C</td>
   </tr>
	 <tr style="vertical-align:middle" class="tengah bold"> 
   <td rowspan="2">Perincian Kelas</td>
    <td colspan="3">Banyaknya Murid</td>
	</tr>
	 <tr style="vertical-align:middle" class="tengah bold">  
   <td>Lk</td>
      <td>Lk</td>
	  <td>Jumlah</td>
	</tr>
	
	<?php
	$query = mysqli_query($koneksi, "SELECT kelas FROM kelas"); 
	while ($data = mysqli_fetch_array($query)) :
	$jL = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa WHERE kelas='$data[kelas]' and jk='L'"));
	$jP = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa WHERE kelas='$data[kelas]' and jk='P'"));
	$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa WHERE kelas='$data[kelas]'"));
	
	?>
	 <tr>
	<td class="tengah"><?= $data['kelas'] ?></td>
	<td class="tengah"><?= $jL ?></td>
	<td class="tengah"><?= $jP  ?></td>
	<td class="tengah"><?= $jsis  ?></td>
	</tr>
	<?php endwhile; ?>
	<?php
	$jL1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa WHERE  jk='L'"));
	$jP1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa WHERE  jk='P'"));
	$jsis1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa"));
	
	?>
	 <tr>
	<td class="tengah bold">Jumlah</td>
	<td class="tengah bold"><?= $jL1 ?></td>
	<td class="tengah bold"><?= $jP1  ?></td>
	<td class="tengah bold"><?= $jsis1  ?></td>
	</tr>
   </table>
  <br>
   <table width="100%" border="1" style="font-size:12px">
   <tr class="tengah bold" style="vertical-align:top">   
   <td colspan="5">MODEL - D</td>
	</tr>
   <tr class="tengah bold">   
    <td colspan="5">Rekapitulasi banyaknya Guru/Pegawai</td>
	</tr>
    <tr class="tengah bold">     
   <td rowspan="2">Golongan / Ruang</td>
   <td colspan="2">Guru</td>
  <td rowspan="2">Jumlah</td>
    <td rowspan="2">Keterangan</td> 
	 </tr>
	 <tr class="tengah bold">     
   <td>Lk</td>
   <td>Pr</td>
	 </tr>
	 <?php
	 $query = mysqli_query($koneksi, "SELECT * FROM m_pangkat"); 
	while ($data = mysqli_fetch_array($query)) :
	$pegL = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='L' and golongan='$data[golongan]'"));
	$pegP = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='P' and golongan='$data[golongan]'"));
	$jpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='guru' and golongan='$data[golongan]'"));
	
	?>
	  <tr class="tengah">     
   <td><?= $data['golongan'] ?></td>
   <td><?= $pegL ?></td>
   <td><?= $pegP ?></td>
   <td><?= $jpeg ?></td>
   <td></td>
	 </tr>
	<?php endwhile; ?>
	<?php
	$pegL1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='L'"));
	$pegP1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='P'"));
	$jpeg1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='guru'"));
	?>
	  <tr class="tengah bold">     
   <td>Jumlah</td>
   <td><?= $pegL1 ?></td>
   <td><?= $pegP1 ?></td>
   <td><?= $jpeg1 ?></td>
   <td></td>
	 </tr>
   </table>
 
 
 <br>
  <div class="divTable">
	<div class="divTableRow" >
	<div class="divTableCell">
   <table width="100%" border="1" style="font-size:12px">
   
   <tr class="tengah bold" style="background-color:#FFDAB9">   
    <td colspan="5" height="30px">PEGAWAI TATA USAHA / PESURUH</td>
	</tr>
    <tr class="tengah bold">     
   <td rowspan="2">Golongan / Ruang</td>
   <td colspan="2">Pegawai</td>
  <td rowspan="2">Jumlah</td>
    <td rowspan="2">Keterangan</td> 
	 </tr>
	 <tr class="tengah bold">     
   <td>Lk</td>
   <td>Pr</td>
	 </tr>
	 <?php
	 $query = mysqli_query($koneksi, "SELECT * FROM m_pangkat"); 
	while ($data = mysqli_fetch_array($query)) :
	$pegL = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='L' and golongan='$data[golongan]'"));
	$pegP = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='P' and golongan='$data[golongan]'"));
	$jpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='staff' and golongan='$data[golongan]'"));
	
	?>
	  <tr class="tengah">     
   <td><?= $data['golongan'] ?></td>
   <td><?= $pegL ?></td>
   <td><?= $pegP ?></td>
   <td><?= $jpeg ?></td>
   <td></td>
	 </tr>
	<?php endwhile; ?>
	<?php
	$pegL1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='L'"));
	$pegP1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='P'"));
	$jpeg1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='staff'"));
	?>
	  <tr class="tengah bold">     
   <td>Jumlah</td>
   <td><?= $pegL1 ?></td>
   <td><?= $pegP1 ?></td>
   <td><?= $jpeg1 ?></td>
   <td></td>
	 </tr>
   </table>
</div>	<div class="divTableCell">
   <table width="100%" border="1" style="font-size:12px">
   <?php
	$pegL2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='L' and status='NON PNS'"));
	$pegP2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='P' and status='NON PNS'"));
	$jpeg2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='guru' and status='NON PNS'"));
	
	$pegL3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='L' and status='NON PNS'"));
	$pegP3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='staff' and jk='P' and status='NON PNS'"));
	$jpeg3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='staff' and status='NON PNS'"));
	
	$pegL4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='L' and status='PNS/ASN'"));
	$pegP4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,jk FROM users WHERE level='guru' and jk='P' and status='PNS/ASN'"));
	$jpeg4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level FROM users WHERE level='guru' and status='PNS/ASN'"));
	
	?>
   <tr class="tengah bold">   
    <td  height="30px">Keterangan personil</td>
	 <td>Lk</td>
	 <td>Pr</td>
	  <td>Jumlah</td>
	 </tr>
	 <tr>   
    <td height="20px">1. Guru Tetap *)</td>
	 <td class="tengah"><?= $pegL4 ?></td>
	 <td class="tengah"><?= $pegP4 ?></td>
	  <td class="tengah"><?= $jpeg4 ?></td>
	 </tr>
	  <tr>   
    <td height="20px">2  Guru Honor Sekolah</td>
	 <td class="tengah"><?= $pegL2 ?></td>
	 <td class="tengah"><?= $pegP2 ?></td>
	  <td class="tengah"><?= $jpeg2 ?></td>
	 </tr>
	  <tr>   
    <td height="20px">3. Guru Titipan</td>
	 <td></td>
	 <td></td>
	  <td></td>
	 </tr>
	  <tr>   
    <td height="20px">4. Guru Sertifikasi</td>
	 <td></td>
	 <td></td>
	  <td></td>
	 </tr>
	  <tr>   
    <td height="20px">5. Peg.TU.Tetap</td>
	 <td></td>
	 <td></td>
	  <td></td>
	 </tr>
	  <tr>   
    <td height="20px">6. Peg. TU.Tdk Tetap</td>
	 <td class="tengah"><?= $pegL3 ?></td>
	 <td class="tengah"><?= $pegP3 ?></td>
	  <td class="tengah"><?= $jpeg3 ?></td>
	 </tr>
	  <tr>   
    <td height="20px">7. Pesuruh Tetap</td>
	 <td></td>
	 <td></td>
	  <td></td>
	 </tr>
	  <tr>   
    <td height="20px">8. Pesuruh Tdk Tetap</td>
	 <td></td>
	 <td></td>
	  <td></td>
	 </tr>
   </table>
    </div>
			   </div>
			     </div>
		Catatan	<br>	 
			*). Tidak Termasuk Kepala Sekolah

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
$dompdf->setPaper('A4', 'Potrait');
$dompdf->render();
$dompdf->stream("Lampiran I .pdf", array("Attachment" => false));
exit(0);
?>