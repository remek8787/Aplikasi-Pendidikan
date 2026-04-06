<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$kelas = $_GET['k'];
	$dudi= $_GET['d'];
	
	function getRomawi($bln){
               switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Rekomendasi <?= $kelas ?></title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body { 
margin-left: 80px; 
margin-right: 80px; 
margin-top: 80px;
margin-bottom: 50px;  
}
.tengah{
	text-align:center;
}
</style>
<body>	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
            <table width='100%'>
                <tr>
                    <td width='70px'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
                    <td style="text-align:center">
                        <strong class='f12'>
                        <?= strtoupper($setting['header']) ?><br>
                     <?= strtoupper($setting['sekolah']) ?> </strong><br>
					 <small>Alamat :  <?= $setting['alamat'] ?> Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> Email :  <?= $setting['email'] ?></small>
                       
                    </td>
                    
                </tr>
            </table>
			 <hr style="margin:1px">
		 <hr style="margin:2px">
   <br> <br>
		
		<p style="font-size:16px;font-weight:bold;text-align:center;">REKOMENDASI</p>
	      <p style="text-align:center;">Nomor : 0<?= $bulan ?>1/SMK/<?= $romawi ?>/<?= $tahun ?></p>

         <br><br>
<p style="text-align:justify; line-height: 1.8;"><label style="width:45px;display: inline-block;"></label>Menanggapi surat permohonan keikutsertaan siswa siswi <?= $setting['sekolah'] ?> Nomor : 0<?= ($bulan-1) ?>1/SMK/<?= $romawi ?>/<?= $tahun ?> tentang Permohonan
		 Kesediaan Tempat Pelaksanaan Praktik Kerja Industri tahun pelajaran <?= $setting['tp'] ?>, sehubungan dengan hal tersebut, Kepala <?= $setting['sekolah'] ?>
		 merekomendasikan nama-nama terlampir untuk mengikuti kegiatan tersebut.<br>
		 <label style="width:45px;display: inline-block;"></label>Demikian rekomendasi ini dikeluarkan untuk dipergunakan sebagaimana mestinya.</p>
		 <br><br>
     <table width="100%">
	<tr style="vertical-align:top">
	<td width="40%"><td>
	<td>
	<?= $setting['kecamatan'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?><br>
	Kepala Sekolah
	<br><br><br><br>
	<b><u><?= $setting['kepsek'] ?></u></b>
	<br>NIP/NUPTK. <?= $setting['nip'] ?>	
	<td>		
	</tr>	
	</table>
	<p style="page-break-before: always;"></p>
	<b>Lampiran</b><br>
	Surat Rekomendasi<br>
	Nomor : 0<?= $bulan ?>1/SMK/<?= $romawi ?>/<?= $tahun ?>
	<br><br><br>
	<table width="100%" border="1">
	<tr style="vertical-align:middle;font-weight:bold" class="tengah">
	<td height="30px">NO</td>
	<td>NAMA SISWA</td>
	<td>KELAS</td>
	<td>JURUSAN</td>
	</tr>
	<?php
	$no=0;
	$query = mysqli_query($koneksi, "SELECT * FROM pkl_siswa WHERE kelas='$kelas' and dudi='$dudi'");
	while ($data = mysqli_fetch_array($query)) :
	$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
	$no++;
	?>
    <tr style="vertical-align:middle;">
        <td class="tengah"><?= $no; ?></td>                                           
		<td><?= $sis['nama'] ?></td>
        <td class="tengah"><?= $data['kelas'] ?></td>
		 <td class="tengah"><?= $data['jurusan'] ?></td>		 
		</tr>								
	<?php endwhile; ?>
	</table>
	 <br><br>
     <table width="100%">
	<tr style="vertical-align:top">
	<td width="40%"><td>
	<td>
	<?= $setting['kecamatan'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?><br>
	Kepala Sekolah
	<br><br><br><br>
	<b><u><?= $setting['kepsek'] ?></u></b>
	<br>NIP/NUPTK. <?= $setting['nip'] ?>	
	<td>		
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