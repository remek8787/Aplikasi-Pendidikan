<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	$idp = $_GET['idp'];
	$m = fetch($koneksi,'m_sk',['id'=>4]);
	$t = fetch($koneksi,'surat_tugas',['id'=>$idp]);
	$peg = fetch($koneksi,'users',['id_user'=>$t['idpeg']]);
	$hari = fetch($koneksi,'m_hari',['inggris'=>$t['hari']]);
	$cetak = fetch($koneksi,'cetak',['id'=>1]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>SURAT TUGAS</title>
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
		<p style="text-align:center" class="f12">SURAT TUGAS</p>
		<p style="text-align:center" class="f12">Nomor : <?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></p>
		<br>
      
		<br>
      <p class="f12">Kepala Sekolah <?= $setting['sekolah'] ?> Kabupaten <?= $setting['kabupaten'] ?> Propinsi <?= $setting['propinsi'] ?>, dengan ini memberi tugas kepada :</p>
	 <br>
	 <table width="100%" style="font-size:15px">	
	<tr style="vertical-align:middle">
	 <td width="20%">Nama</td>
	<td width="1%">:</td>
	<td><?= $peg['nama'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">NIP / NUPTK</td>
	<td width="1%">:</td>
	<td><?= $peg['nip'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Jabatan</td>
	<td width="1%">:</td>
	<td><?= $peg['jabatan'] ?></td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Keperluan</td>
	<td width="1%">:</td>
	<td>
	<?= $t['keperluan'] ?> 
	</td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Tempat</td>
	<td width="1%">:</td>
	<td>
	<?= $t['tempat'] ?> 
	</td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">Hari / Tanggal</td>
	<td width="1%">:</td>
	<td>
	<?= $hari['hari'] ?>, <?= date('d M Y',strtotime($t['tanggal'])) ?> 
	</td>
	</tr>
	<tr style="vertical-align:middle">
	 <td width="12%">W a k t u</td>
	<td width="1%">:</td>
	<td>
	<?= $t['waktu'] ?> 
	</td>
	</tr>
	</table>
	<br>
<p class="f12">Demikian surat tugas ini kami buat agar dilaksanakan sebagaimana mestinya dan setelah melaksanakan tugas, harap menyampaikan laporan kepada kepala sekolah.</p>
<br>
 
<br>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="50%"><td>
	<td width="10%"><td>
	<td width="40%">
	<?= $m['tempat'] ?>, <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?>
	<br>
Kepala Sekolah<br> 
<?= $setting['sekolah'] ?><br>
<br><br><br>
<?= $setting['kepsek'] ?><br>
NIP/NUPTK. <?= $setting['nip'] ?>
	</td>
	</tr>
	
	</table>
	 <p style="page-break-before: always;"></p>
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
		<p style="text-align:center" class="f12">SURAT PERINTAH PERJALANAN DINAS (SPPD)</p>
		<p style="text-align:center" class="f12">Nomor : <?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></p>
		<br>
		 <table width="100%" style="font-size:15px" border="1">	
			<tr style="vertical-align:top">
			<td width="1%">1</td>
			 <td>Pejabat berwenang yang memberi perintah</td>
			<td>Kepala <?= $setting['sekolah'] ?></td>
			</tr>
	         <tr style="vertical-align:top">
			<td width="1%">2</td>
			 <td>Nama/NIP Pegawai yang diperintahkan</td>
			<td> <?= $peg['nama'] ?><br>NIP/NUPTK <?= $peg['nip'] ?></td>
			</tr>
	          <tr style="vertical-align:top">
			<td width="1%">3</td>
			 <td>a.	Pangkat dan golongan ruang gaji menurut<br><label style="width:15px;display: inline-block;"></label>PP.No.6 tahun 1997/<br>
			 b.	Jabatan/ Instansi<br>c.	Tingkat menurut peraturan perjalanan dinas
			 </td>
			<td> </td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">4</td>
			 <td>Maksud perjalanan dinas</td>
			<td> <?= $t['keperluan'] ?> </td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">5</td>
			 <td>Alat angkutan yang dipergunakan</td>
			<td> <?= $t['kendaraan'] ?></td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">6</td>
			 <td>a.	Tempat berangkat<br>b.	Tempat Tujuan</td>
			<td> <?= $t['dari'] ?><br><?= $t['tempat'] ?></td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">7</td>
			 <td>a.	Lamanya perjalanan<br>b. Tanggal berangkat<br>c. Tanggal harus kembali</td>
			<td> <?= $t['lama'] ?> hari<br><?= date('d',strtotime($t['tanggal'])) ?> <?= bulan_indo($t['tanggal']) ?> <?= date('Y',strtotime($t['tanggal'])) ?><br></td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">8</td>
			 <td>Pengikut</td>
			<td> </td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">9</td>
			 <td>Pembebanan anggaran :<br>a. Instansi<br>b.	Fungsi/ Subfungsi/Program/Kegiatan MAK</td>
			<td></td>
			</tr>
			 <tr style="vertical-align:top">
			<td width="1%">10</td>
			 <td>Keterangan lain-lain</td>
			<td> Surat Perintah ini supaya dilaksanakan dengan rasa  penuh tanggung jawab</td>
			</tr>
    </table>
	<br>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="55%"><td>
	<td width="19%">Dikeluarkan di	<td>
	<td width="1%" style="text-align:center">:</td>
	<td width="25%"><?= $m['tempat'] ?></td>
	</tr>
	
	<tr style="vertical-align:top">
	<td><td>
	<td>Pada Tanggal<td>
	<td style="text-align:center">:</td>
	<td><?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= date('Y') ?></td>
	</tr>
	
	<tr style="vertical-align:top">
	<td><td>
	<td colspan="4">Kepala Sekolah <br><?= $setting['sekolah'] ?>
	<br><br><br><br>
	<b><u><?= $setting['kepsek'] ?></u></b><br>
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