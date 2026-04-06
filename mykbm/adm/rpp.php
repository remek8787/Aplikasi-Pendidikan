<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
    $smt= $_GET['smt'];
	$idel= $_GET['elemen'];
	$mapel= $_GET['mapel'];
	$kelas= $_GET['kelas'];
	$guru= $_GET['guru'];
	$level = fetch ($koneksi, 'kelas', ['kelas' =>$kelas]);
	$tingkat = $level['level'];
	$map = fetch ($koneksi, 'mapel', ['id' =>$mapel]);
	$usr = fetch ($koneksi, 'users', ['id_user' =>$guru]);
	$cp = fetch ($koneksi, 'cp', ['mapel' =>$mapel,'guru'=>$guru,'tingkat'=>$tingkat,'smt'=>$smt]);
	$el = fetch ($koneksi, 'cp_elemen', ['idcp' =>$cp['id'],'id_elemen'=>$idel]);
	$tp = fetch ($koneksi, 'tp', ['idcp' =>$cp['id'],'idelemen'=>$idel]);
	$atp = fetch ($koneksi, 'atp', ['idcp' =>$cp['id'],'idel'=>$idel]);
	$konten = fetch ($koneksi, 'konten', ['idcp' =>$cp['id'],'idel'=>$idel,'idtp'=>$tp['id_tp']]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>RPP</title>
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
		<center><h3>RENCANA PELAKSANAAN PEMBELAJARAN<br>Sesuai dengan PPA Tahun 2022 Revisi 2024</h3></center>
		<br>
 <b>A. INFORMASI UMUM</b>
    <table width="100%">
	
            <tr>
			 <td width='2%'></td>
			<td width="30%">Nama Penyusun</td>
            <td width='5px'>:</td>
            <td><?= $usr['nama'] ?></td>
            </tr>
			
			<tr>
			 <td></td>
			<td>Nama Instansi</td>
            <td width='5px'>:</td>
            <td><?= $setting['sekolah'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Jenjang Sekolah</td>
            <td width='5px'>:</td>
            <td><?= $setting['jenjang'] ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Fase / Kelas</td>
            <td width='5px'>:</td>
            <td><?= $level['fase'] ?> / <?= $kelas ?></td>
            </tr>
			
			<tr>
            <td></td>
			<td>Alokasi Waktu</td>
            <td width='5px'>:</td>
            <td><?= $atp['waktu'] ?> JP X <?= $setting['jjm'] ?> Menit</td>
            </tr>
			<tr>
            <td></td>
			<td>Mata Pelajaran</td>
            <td width='5px'>:</td>
            <td><?= $map['nama_mapel'] ?></td>
            </tr>
			<tr>
            <td></td>
			<td>Tujuan Pembelajaran</td>
            <td width='5px'>:</td>
            <td><?= $tp['tujuan'] ?></td>
            </tr>
    </table>
 
   <br>
	<br>
 <b>GAMBARAN KEGIATAN</b>
    <table width="100%">
	<tr>
    <td width='2%'></td>
	<td><?= $konten['gambaran'] ?></td>										
	</tr>
    </table>
   <br>   
 <b>LANGKAH-LANGKAH PEMBELAJARAN</b>
	 <table width="100%">
	<tr style="vertical-align:top">
	<td width='1%'></td>
    <td width='1%'>1.</td>	
	<td>Guru melakukan asesmen awal dengan berbagai cara untuk mengetahui pemahaman awal siswa tentang :<br>
	<?= $tp['lingkup'] ?><br>
	</td>	
	</tr>
	<tr style="vertical-align:top">
	<td width='1%'></td>
    <td width='1%'>2.</td>	
	<td>Guru mengajak siswa untuk melakukan berbagai aktivitas yang berhubungan dengan :<br>
	<?= $konten['sub'] ?><br>
	</td>	
	</tr>
	<tr style="vertical-align:top">
	<td width='1%'></td>
    <td width='1%'>3.</td>	
	<td>Guru mengobservasi seluruh siswa selama kegiatan berlangsung untuk mengetahui kemampuan awal peserta didik tentang :<br>
	<?= $tp['lingkup'] ?><br>
	</td>	
	</tr>
	
	
    </table>
<br>   
 <b>TINDAK LANJUT DARI ASESMEN AWAL</b>											
	 <table width="100%">
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Pembelajaran terdiferensiasi berdasarkan dari asesmen awal tentang materi:<br>
	<?= $konten['sub'] ?>
	</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Siswa dengan hambatan (belum mampu melakukan pengukuran) dapat melakukan Latihan dengan guru, atau mereka dikelompokkan dan berlatih secara klasikal dengan guru tentang :<br>
	<?= $konten['sub'] ?>
	</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Bagi anak yang sudah mampu, mereka terus bereksplorasi sendiri dengan pemantauan guru tentang :<br>
	<?= $konten['sub'] ?>
	</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru memberikan LKPD yang berbeda kepada setiap kelompok</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Siswa berdiskusi dalam kelompoknya untuk mengerjakan LKPD yang diberikan</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru membimbing siswa dalam berdiskusi agar semua siswa terlibat aktif dalam berdiskusi</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru membimbing siswa dengan menggunakan beragam media dalam proses pembelajaran dan mengerjakan LKPDnya</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Perwakilan masing-masing kelompok mempresentasikan hasil didskusinya di depan kelas</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru memberikan kesempatan yang sama kepada siswa untuk menanggapi</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru memberikan apresiasi kepada setiap kelompok yang tampil secara bergantian</td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Siswa menyimpulkan pembelajaran yang telah dilakukan tentang :<br><?= $tp['tujuan'] ?></td>	
	</tr>	
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Siswa mengerjakan latihan yang diberikan guru</td>	
	</tr>
	
	</table>
	
	<table width="100%">
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru menyampaikan analisis hasil latihan dan memintak umpan balik siswa</td>	
	</tr>
	<tr style="vertical-align:top">
    <td width='1%'></td>
	<td width='1%'>*</td>
	<td>Guru dan siswa melakukan refleksi pembelajaran dan menyusun langkah pembelajaran berikutnya berdasarkan umpan balik siswa</td>	
	</tr>
 </table>
 <br>
<b>ASSESMENT</b>											
	 <table width="100%">
	<tr style="vertical-align:top">
	<td colspan="2" width="1%">1.</td>
	<td>Asesmen awal dapat dilakukan di awal pembelajaran ketika siswa melakukan aktivitas tentang :<br>
	    <?= $tp['lingkup'] ?><br>																					
	</td>	
	</tr>
	<tr style="vertical-align:top">
	<td colspan="2" width="1%">2.</td>
	<td>Penilaian formatif berupa penilaian performa dengan mengisi lembar observasi siswa tentang  materi :<br>
	    <?= $konten['sub'] ?><br>																					
	</td>	
	</tr>
	<tr style="vertical-align:top">
	<td colspan="2" width="1%">3.</td>
	<td>Disediakan rubrik untuk menilai  hasil kerja siswa tentang :<br>
	    <?= $tp['lingkup'] ?><br>																					
	</td>	
	</tr>
	<tr style="vertical-align:top">
	<td colspan="2" width="1%">4.</td>
	<td>Rubrik<br>
	    Rubrik penilaian dijadikan untuk menilai keterampilan atau produk hasil kerja siswa tentang :																					
	</td>	
	</tr>
 </table>
   
	<table style="width:90%;margin-left:30px;font-size:12px" border="1">
	<tr style="text-align:center;">
	<td rowspan="2" width="30%" class="bold">Tujuan Pembelajaran</td>
	<td colspan="4"  class="bold">Penilaian</td>	
	</tr>
	<tr style="text-align:center;">
	<td class="bold">Perlu Bimbingan</td>
	<td class="bold">Cukup</td>
	<td class="bold">Baik</td>
	<td class="bold">Sangat Baik</td>
	</tr>
	<tr style="text-align:center;vertical-align:top">
	<td><?= $el['capaian'] ?></td>
	<td>Belum mempu menyebutkan	<br><?= $tp['tujuan'] ?></td>
	<td>Mampu menyebutkan<br><?= $tp['tujuan'] ?></td>
	<td>Mampu Menjelaskan masing-masing fungsi<br><?= $tp['tujuan'] ?></td>
	<td>Mampu membandingkan fungsi dari<br><?= $tp['tujuan'] ?></td>
	</tr>
	</table>
	

											
	 <table width="100%">
	<tr>
	<td colspan="2" class="bold">Rencana Tindak Lanjut</td>	
	</tr>
	<tr style="vertical-align:top">
	<td width="1%">1.</td>
	<td>Peserta didik dikatakan mencapai tujuan pembelajaran jika mencapai kriteria baik.</td>	
	</tr>
	<tr style="vertical-align:top">
	<td width="1%">2.</td>
	<td>Bila pencapaian peserta didik pada kriteria perlu bimbingan, dan cukup, maka tindak lanjut yang dapat dilakukan adalah melakukan kegiatan kembali secara individu atau kelompok yang dibimbing langsung oleh guru.</td>	
	</tr>
	<tr style="vertical-align:top">
	<td width="1%">3.</td>
	<td>Jenis kegiatan dan tingkat kesulitan dimulai dari yang termudah.</td>	
	</tr>
 </table>
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
$dompdf->stream("RPP ". $kelas ." - ".$map['kode'].".pdf", array("Attachment" => false));
exit(0);
?>