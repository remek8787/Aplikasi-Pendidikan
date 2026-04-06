<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$idp = $_GET['idp'];
	
	$m = fetch($koneksi,'m_sk',['id'=>3]);
	$peg = fetch($koneksi,'users',['id_user'=>$idp]);
	$pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM sk_peg  WHERE idpeg='$idp' and idsk='2' and mapel<>''"));
	$sk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM sk_peg  WHERE idpeg='$idp' and idsk='1'"));
	$cetak = fetch($koneksi,'cetak',['id'=>1]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>AKTIF MENGAJAR</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body {
	margin-top: 50px; 
	margin-bottom: 50px; 
	margin-left: 80px;
	margin-right: 80px;
	}
</style>
<body>	


<div style='background:#fff; width:97%; margin:0 auto; height:90%;'>
<?php if($cetak['pakai']=='0'): ?>
            <table width='100%'>
                <tr>
                    <td width='70px'><img src='../../images/<?= $setting['logo'] ?>' width='70px'></td>
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
        <?php else: ?>
        <br>
		 <center>
		<img src="../../images/<?= $cetak['header'] ?>" style="width:<?= $cetak['lebar'] ?>px;height:<?= $cetak['tinggi'] ?>px;" >
		</center>
		<?php endif; ?>
		<p style="text-align:center" class="f12">SURAT KETERANGAN</p>
		<p style="text-align:center" class="f12">Nomor : <?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></p>
		<br>
      
		<br>
      <p class="f12">Yang bertanda tangan di bawah ini: </p>
	 <br>
	 <table width="100%" style="font-size:15px">	
	<tr style="vertical-align:middle">
	 <td width="20%">Nama</td>
	<td width="1%">:</td>
	<td><?= $setting['kepsek'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">NIP / NUPTK</td>
	<td width="1%">:</td>
	<td><?= $setting['nip'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Jabatan</td>
	<td width="1%">:</td>
	<td>Kepala <?= $setting['sekolah'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Alamat</td>
	<td width="1%">:</td>
	<td>
	<?= $setting['alamat'] ?> Desa <?= $setting['desa'] ?> Kec. <?= $setting['kecamatan'] ?>
	Kab. <?= $setting['kabupaten'] ?>
	</td>
	</tr>
	</table>
	<br>
<p class="f12">Dengan ini menerangkan dengan sebenar-benarnya, bahwa:</p>
<br>
 <table width="100%" style="font-size:15px">	
	<tr style="vertical-align:middle">
	 <td width="20%">Nama</td>
	<td width="1%">:</td>
	<td><?= $peg['nama'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">NIP/NUPTK</td>
	<td width="1%">:</td>
	<td><?= $peg['nip'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Jabatan</td>
	<td width="1%">:</td>
	<td>Guru <?= $pel['mapel'] ?></td>
	</tr>
	
	</table>
	<br>
	<p class="f12"><label style="width:25px;display: inline-block;"></label>Adalah benar-benar Guru <?= $pel['mapel'] ?> di <?= $setting['sekolah'] ?> terhitung mulai tanggal <?= $sk['tmt'] ?> <?= $sk['tahun'] ?> sampai dengan sekarang.</p>
	<br>
	<p class="f12"><label style="width:25px;display: inline-block;"></label>Demikian surat keterangan ini kami buat, untuk dipergunakan sebagaimana mestinya. Pernyataan ini sesuai dengan keadaan yang sebenarnya.</p>

<br>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="50%"><td>
	<td width="10%"><td>
	<td width="40%">
	<?= $m['tempat'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?>
	<br>
	Mengetahui<br> 
Kepala Sekolah<br> 
<?= $setting['sekolah'] ?><br>
<br><br><br>
<?= $setting['kepsek'] ?><br>
NIP/NUPTK. <?= $setting['nip'] ?>
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
$dompdf->setPaper('Folio', 'Potrait');
$dompdf->render();
$dompdf->stream("PH ". $kelas . ".pdf", array("Attachment" => false));
exit(0);
?>