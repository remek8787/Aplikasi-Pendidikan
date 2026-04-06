<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	$cetak = fetch($koneksi,'cetak',['id'=>1]);
	$id = $_GET['id'];
	$sk = fetch($koneksi,'sk_peg',['id'=>$id]);
	$m = fetch($koneksi,'m_sk',['id'=>1]);
	$peg = fetch($koneksi,'users',['id_user'=>$sk['idpeg']]);
	if($sk['nomor']<10){$nomor = "00".$sk['nomor'];}else{$nomor = "0".$sk['nomor'];}
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>SK GTT</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body {
	margin-top: 20px; 
	margin-bottom: 20px; 
	margin-left: 50px;
	margin-right: 50px;
	}
	
</style>
<body style="font-size:14px">	


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
		<p style="text-align:center" class="f12">SURAT KEPUTUSAN<br>KETUA YAYASAN <?= strtoupper($setting['yayasan']) ?></p>
		<p style="text-align:center" class="f12">Nomor : <?= $nomor ?><?=$sk['nosk'] ?><?=$sk['tahun'] ?></p>
		<br>
         
		<p style="text-align:center" class="f12">TENTANG<br>PENGANGKATAN GURU TETAP YAYASAN</p>
		<p style="text-align:center" class="f12">PADA <?= $setting['sekolah'] ?> </p>
		<br>
      <p style="text-align:center" class="f12">Ketua Yayasan <?= $setting['yayasan'] ?> </p>
	 <br>
	 <table width="100%" style="font-size:14px">
	 
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_membaca where idsk='1'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
	?>
	<tr style="vertical-align:top">
	 <td width="12%">Membaca</td>
	<td width="1%">:</td>
	<td><?= $data['isi'] ?></td>
	</tr>
	<?php endwhile; ?>
	</table>
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td rowspan="4" width="12%"><p style="margin-top:14px">Menimbang</p></td>
	<td rowspan="4" width="1%"><br><p style="margin-top:-4px">:</p></td>
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_menimbang where idsk='1'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
	?>
	<tr style="vertical-align:top">
	<td width="1%" ><?= $no ?>. </td>
	<td style="text-align:justify"><?= $data['isi'] ?></td>
	</tr>
	<?php endwhile; ?>
	</tr>
	</table>
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td rowspan="5" width="12%"><p style="margin-top:14px">Mengingat</p></td>
	<td rowspan="5" width="1%"><br><p style="margin-top:-5px">:</p></td>
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_mengingat where idsk='1'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
	?>
	<tr style="vertical-align:top">
	<td width="1%" ><?= $no ?>. </td>
	<td style="text-align:justify"><?= $data['isi'] ?></td>
	</tr>
	<?php endwhile; ?>
	</tr>
	</table>
	<br>
	<p style="text-align:center;" class="f12">MEMUTUSKAN </p>
	
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td width="12%">Menetapkan</td>
	<td width="1%"></td>
	<td></td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Pertama</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	<?php if($sk['jk']=='Laki-laki'){ ?>
	Bahwa Saudara
	<?php }else{ ?>
	Bahwa Saudari
	<?php } ?>
	<br>
	<label style="width:114px;display: inline-flex;">Nama</label> : <?= $peg['nama'] ?><br>
    <label style="width:114px;display: inline-flex;">Tempat/Tgl Lahir</label> : <?= $sk['ttl'] ?><br>		
	<label style="width:114px;display: inline-flex;">Pendidikan</label> : <?= $sk['pdk'] ?><br>
    Terhitung mulai tanggal <?= $sk['tglsk'] ?> <?= $sk['tahun'] ?> s/d 30 Juni <?= $sk['tahun']+1; ?> diangkat sebagai Guru Tetap Yayasan (GTY) pada <?= $setting['sekolah'] ?> Desa <?= $setting['desa'] ?> Kec. <?= $setting['kecamatan'] ?> Kab. <?= $setting['kabupaten'] ?>	
	</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Kedua</td>
	<td width="1%">:</td>
	<td style="text-align:justify">Keputusan ini bukan merupakan jaminan untuk diangkat sebagai Pegawai Negeri Sipil.</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Ketiga</td>
	<td width="1%">:</td>
	<td style="text-align:justify">Segala sesuatu akan ditinjau kembali jika dikemudian hari terdapat kekeliruan dalam keputusan ini.</td>
	</tr>
	</table>
	<br>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"><td>
	<td width="14%">Ditetapkan di<td>
	<td width="1%" style="text-align:center">:</td>
	<td width="25%"><?= $m['tempat'] ?></td>
	</tr>
	<tr style="vertical-align:top">
	<td><td>
	<td>Pada Tanggal<td>
	<td style="text-align:center">:</td>
	<td><?= $sk['tglsk'] ?> <?= $sk['tahun'] ?></td>
	</tr>
	</table>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"></td>
	<td colspan="3">
	&nbsp; Ketua Yayasan<br>&nbsp; <?= $setting['yayasan'] ?>
	<br><br><br>
	&nbsp; <b><u><?= $setting['ketua'] ?></u></b>
	
	<td>	
	
	</tr>	
	</table>
	
	Tembusan Kepada YTH :<br>
	1. Kepala <?= $setting['sekolah'] ?><br>
    2. Pengawas <?= $setting['sekolah'] ?><br>
    3. Yang Bersangkutan Untuk Diketahui

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
$dompdf->stream("SK GTT/GTY ".$peg['nama'].".pdf", array("Attachment" => false));
exit(0);
?>