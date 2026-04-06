<?php ob_start();
error_reporting(0);
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
	
	
	$m = fetch($koneksi,'m_sk',['id'=>2]);
	$cetak = fetch($koneksi,'cetak',['id'=>1]);
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>BAGI TUGAS</title>
<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>

body {
	margin-top: 20px; 
	margin-bottom: 10px; 
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
		<p style="text-align:center" class="f12">SURAT KEPUTUSAN<br>KEPALA <?= strtoupper($setting['sekolah']) ?></p>
		<p style="text-align:center" class="f12">Nomor : <?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></p>
		<br>
         
		<p style="text-align:center" class="f12">PEMENUHAN BEBAN KERJA GURU DAN KEPALA SEKOLAH, PEMBAGIAN TUGAS GURU DALAM PROSES BELAJAR MENGAJAR DAN BIMBINGAN, DAN TUGAS TAMBAHAN PADA KURIKULUM MERDEKA</p>
		<p style="text-align:center" class="f12">SEMESTER <?= $setting['semester'] ?> TAHUN PELAJARAN <?= $setting['tp'] ?></p>
		<br>
      <p style="text-align:center" class="f12">Kepala <?= $setting['sekolah'] ?>  Kec. <?= $setting['kecamatan'] ?> Kab.  <?= $setting['kabupaten'] ?> </p>
	 <br>
	 <table width="100%" style="font-size:14px">
	 <tr style="vertical-align:top">
	 <td width="13%" rowspan="3">Menimbang</td>
	 <td width="1%" rowspan="3">:</td>
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_membaca where idsk='2'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
		
	?>
	
	 <td width="1%"><?= $no; ?>.</td>
	<td><?= $data['isi'] ?></td>
	</tr>
	<?php endwhile; ?>
	</table>
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td rowspan="15" width="13%"><p style="margin-top:8px">Mengingat</p></td>
	<td rowspan="15" width="1%"><br><p style="margin-top:-10px">:</p></td>
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_menimbang where idsk='2'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
	?>
	<tr style="vertical-align:top">
	<td width="1%" ><?= $no ?>. </td>
	<td style="text-align:justify;">
	<?php if($no <> 14): ?>
	<?= $data['isi'] ?>
	<?php elseif($no == 14):?>
	<?= $data['isi'] ?> <?= $setting['tp'] ?>
	<?php endif; ?></td>
	</tr>
	<?php endwhile; ?>
	</tr>
	</table>
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td rowspan="5" width="13%"><p style="margin-top:9px">Memperhatikan</p></td>
	<td rowspan="5" width="1%"><br><p style="margin-top:-9px">:</p></td>
	<?php
		$no=0;
		$query = mysqli_query($koneksi, "SELECT * FROM sk_mengingat where idsk='2'"); 
		while ($data = mysqli_fetch_array($query)) :
		$no++;
		
	?>
	<tr style="vertical-align:top">
	<td width="1%" ><?= $no ?>. </td>
	<td style="text-align:justify">
	<?php if($no==1): ?>
	<?= $data['isi'] ?>
	<?php else: ?>
	<?= $data['isi'] ?> <?= $setting['tp'] ?>
	<?php endif; ?></td>
	
	</td>
	</tr>
	<?php endwhile; ?>
	</tr>
	</table>
	 <p style="page-break-before: always;"></p>
	 <br>
	<p style="text-align:center;" class="f12">MEMUTUSKAN </p>
	<br>
	<table width="100%" style="font-size:14px">
	<tr style="vertical-align:top">
	<td width="13%">Menetapkan</td>
	<td width="1%">:</td>
	<td>KEPUTUSAN KEPALA SEKOLAH TENTANG PEMENUHAN BEBAN KERJA GURU DAN KEPALA SEKOLAH, PEMBAGIAN TUGAS GURU DALAM PROSES BELAJAR MENGAJAR DAN BIMBINGAN, DAN TUGAS TAMBAHAN PADA KURIKULUM MERDEKA </td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Pertama</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	Pemenuhan Beban Kerja Guru dan Kepala Sekolah Tahun Pelajaran <?= $setting['tp'] ?> Semester <?= $setting['semester'] ?>  sebagaimana tercantum dalam Lampiran I Surat Keputusan ini.
	</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Kedua</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	Pembagian Tugas Guru dalam Proses Belajar Mengajar dan Bimbingan Tahun Pelajaran <?= $setting['tp'] ?> Semester <?= $setting['semester'] ?> sebagaimana tercantum dalam Lampiran II Surat Keputusan ini.
	</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Ketiga</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	Pembagian Tugas Tambahan Pada Kurikulum Merdeka Mandiri Berubah Tugas Tambahan Koordinator Projek Penguatan Profil Pelajar Pancasila Tahun Pelajaran <?= $setting['tp'] ?> sebagaimana tercantum dalam Lampiran III dan IV Surat Keputusan ini
	</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Keempat</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	Masing-masing Guru melaporkan pelaksanaan tugasnya secara tertulis dan berkala kepada Kepala Sekolah, dan semua biaya yang timbul akibat pelaksanaan keputusan ini, dibebankan pada anggaran yang sesuai.
	</td>
	</tr>
	<tr style="vertical-align:top">
	<td width="12%">Kelima</td>
	<td width="1%">:</td>
	<td style="text-align:justify">
	Keputusan ini berlaku sejak tanggal ditetapkan dan apabila terdapat kekeliruan akan dibetulkan sebagaiamana mestinya.
	</td>
	</tr>
	</table>
	<p>Keputusan ini diberikan kepada yang bersangkutan, untuk dilaksanakan dengan penuh rasa tanggung jawab.</p>
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
	<td><?= $m['tglsk'] ?> <?= $sk['tahun'] ?></td>
	</tr>
	</table>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"></td>
	<td colspan="3">
	&nbsp;&nbsp;Kepala Sekolah
	<br><br><br><br>
	&nbsp; <b><u><?= $setting['kepsek'] ?></u></b>
	<br>&nbsp; NIP/NUPTK. <?= $setting['nip'] ?>
	
	<td>	
	
	</tr>	
	</table>
	<br>
	Tembusan :<br>
	1. Koordinator Wilayah Bidang Pendidikan Kec. <?= $setting['kecamatan'] ?> Kab. <?= $setting['kabupaten'] ?> <br>
    2. Arsip<br>
   
 <p style="page-break-before: always;"></p>
 <br>
 <table width="100%">
	<tr style="vertical-align:top;font-weight:bold">
	<td width="15%">Lampiran I<td>
	<td width="2%">:</td>
	<td width="83%">Surat Keputusan Kepala <?= $setting['sekolah'] ?></td>
	</tr>
	<tr style="vertical-align:top">
	<td>Nomor<td>
	<td>:</td>
	<td><?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></td>
	</tr>
<tr style="vertical-align:top">
	<td>Tentang<td>
	<td>:</td>
	<td></td>
	</tr>		
	</table>
	<br>
  <p style="text-align:center" class="f12">PEMENUHAN BEBAN KERJA GURU DAN KEPALA SEKOLAH KURIKULUM MERDEKA</p>
<p style="text-align:center" class="f12">SEMESTER <?= $setting['semester'] ?> TAHUN PELAJARAN <?= $setting['tp'] ?></p>
<br>
<p  style="text-align:justify">Berdasarkan Salinan Lampiran II Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 262/M/2022 Tentang Perubahan atas Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 56/M/20.. Tentang Pedoman Penerapan Kurikulum Dalam Rangka Pemulihan Pembelajaran, dan berdasarkan Permendikbud Nomor 15 Tahun 2018 bahwa:</p>
<br>
A.	Beban Kerja Guru<br>
<label style="width:20px;display: inline-block;"></label>1. Beban kerja guru pada satuan Pendidikan pelaksana Kurikulum Merdeka mencakup kegiatan pokok <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sebagai berikut:<br><br>
<label style="width:25px;display: inline-block;"></label>1)	Merencanakan pembelajaran atau pembimbingan.<br>
<label style="width:25px;display: inline-block;"></label>2)	Melaksanakan pembelajaran atau pembimbingan.<br>
<label style="width:25px;display: inline-block;"></label>3)	Menilai hasil pembelajaran atau pembimbingan.<br>
<label style="width:25px;display: inline-block;"></label>4)	Membimbing dan melatih peserta didik, dan<br>
<label style="width:25px;display: inline-block;"></label>5)	Melaksanakan tugas tambahan yang melekat pada pelaksanaan kegiatan pokok sesuai beban kerja<br><label style="width:38px;display: inline-block;"></label> guru.<br>
<br>
<p style="text-align:justify"><label style="width:20px;display: inline-block;"></label>2. Pemenuhan beban kerja guru dalam melaksanakan kegiatan pokok pembelajaran atau bimbingan<br><label style="width:35px;display: inline-block;"></label>paling sedikit 24 (dua puluh) jam tatap muka per minggu dan paling banyak 40 (empat puluh) jam <br><label style="width:35px;display: inline-block;"></label>tatap muka per minggu dan dilakukan dalam kegiatan intrakurikuler, kokurikuler, dan ekstrakurikuler.</p>
<br>
B.	Pemenuhan Beban Kerja Guru Pelaksana Kurikulum Merdeka 
<p style="text-align:justify"><label style="width:20px;display: inline-block;"></label>Kepala Sekolah menghitung kebutuhan guru berdasarkan pemenuhan beban kerja dalam struktur<br><label style="width:20px;display: inline-block;"></label>Kurikulum Merdeka, apabila guru tidak dapat memenuhi ketentuan dalam melaksanakan pembelajaran<br><label style="width:20px;display: inline-block;"></label>dan pembimbingan paling sedikit 24 (dua puluh) jam tatap muka per minggu, maka guru tersebut dapat<br><label style="width:20px;display: inline-block;"></label>diberikan:</p>

<p><label style="width:20px;display: inline-block;"></label>1. Tugas Tambahan dan atau</p>
<p><label style="width:20px;display: inline-block;"></label>2. Tugas Tambahan lain yang terkait dengan Pendidikan di satuan Pendidikan. </p>
<br>
C.	Koordinator Projek Penguatan Profil Pelajar Pancasila
<p><label style="width:20px;display: inline-block;"></label>1. Tugas tambahan lain sebagaimana huruf B poin 2 diprioritaskan bagi guru yang masih kekurangan<br><label style="width:35px;display: inline-block;"></label>jam pelajaran akibat perubahan struktur kurikulum.</p>
<br>
<p><label style="width:20px;display: inline-block;"></label>2. Tugas koordinator projek penguatan profil pelajar Pancasila adalah:</p>
<p><label style="width:25px;display: inline-block;"></label>1) Mengembangkan kemampuan, kepemimpinan, dalam mengelola projek penguatan profil pelajar<br><label style="width:40px;display: inline-block;"></label>Pancasila di satuan Pendidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>2) Mengelola sistem yang dibutuhkan oleh pendidik sebagai fasilitator projek penguatan profil pelajar<br><label style="width:40px;display: inline-block;"></label>Pancasila dan peserta didik untuk menyelesaikan projek penguatan profil pelajar Pancasila dengan<br><label style="width:40px;display: inline-block;"></label>sukses, dengan dukungan dan kolaborasi dari koordinator dan pimpinan satuan Pendidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>3) Memastikan tujuan dan asesmen pembelajaran terjadi di antara para pendidik dari berbagai mata<br><label style="width:40px;display: inline-block;"></label>pelajaran, dan</p>
<p><label style="width:25px;display: inline-block;"></label>4) Memastikan tujuan dan asesmen pembelajaran yang diberikan sesuai dengan capaian profil pelajar<br><label style="width:40px;display: inline-block;"></label>Pancasila dan kriteria kesuksesan yang sudah ditetapkan.</p>
<br>
<p><label style="width:20px;display: inline-block;"></label>3. Tugas sebagaimana huruf C poin 2 dibuktikan dengan:</p>

<p><label style="width:25px;display: inline-block;"></label>1) Surat tugas sebagai koodinator projek penguatan profil pelajar Pancasila dari kepala sekolah.</p>
<p><label style="width:25px;display: inline-block;"></label>2) Program dan jadwal kegiatan projek penguatan profil pelajar Pancasila yang ditandatngani oleh<br><label style="width:40px;display: inline-block;"></label>kepala sekolah.</p>
<p><label style="width:25px;display: inline-block;"></label>3) Laporan hasil kegiatan koordinator projek penguatan profil pelajar Pancasila yang ditandatngani<br><label style="width:40px;display: inline-block;"></label>oleh kepala sekolah.</p>
<br>
<p><label style="width:20px;display: inline-block;"></label>4. Beban kerja tugas tambahan sebagai koordinator projek penguatan profil pelajar Pancasila dapat<br><label style="width:35px;display: inline-block;"></label>diekuivalensikan dengan 2 (dua) jam tatap muka perminggu dan paling banyak mengampu 3 (tiga)<br><label style="width:35px;display: inline-block;"></label>rombongan belajar.</p>
<p style="page-break-before: always;"></p>
<br>
D.	Pemenuhan Beban Kerja Kepala Sekolah<br>
<p><label style="width:20px;display: inline-block;"></label>Pemenuhan beban kerja kepala sekolah sebagaimana diatur dalam Permendikbud Nomor 15 Tahun 2018<br><label style="width:20px;display: inline-block;"></label>yaitu:</p>
<p><label style="width:20px;display: inline-block;"></label>1. Manajerial</p>
<p><label style="width:25px;display: inline-block;"></label>a)	Merencanakan Program Sekolah.</p>
<p><label style="width:25px;display: inline-block;"></label>b)	Mengelola Standar Nasional Pendidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>c)	Melaksanakan Pengawasan dan Evaluasi.</p>
<br>
<p><label style="width:20px;display: inline-block;"></label>2.	Pengembangan Kewirausahaan</p>
<p><label style="width:25px;display: inline-block;"></label>a)	Merencanaka Program Pengembangan Kewirausahaan.</p>
<p><label style="width:25px;display: inline-block;"></label>b)	Melaksanakan Program Pengembangan Kewirausahaan.</p>
<p><label style="width:25px;display: inline-block;"></label>c)	Melaksanakan Evaluasi Program Pengembangan Kewirausahaan.</p>
<br>
<p><label style="width:20px;display: inline-block;"></label>3.	Supervisi Kepada Guru dan Tenaga Kependidikan</p>
<p><label style="width:25px;display: inline-block;"></label>a)	Merencanakan Program Supervisi Guru dan Tenada Kependidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>b)	Melaksanakan Supervisi Guru.</p>
<p><label style="width:25px;display: inline-block;"></label>c)	Melaksanakan Supervisi terhadap Tenaga Kependidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>d)	Menindaklanjuti hasil Supervisi terhadap Guru dalam Rangka Peningkatan Profesionalisme Guru.</p>
<p><label style="width:25px;display: inline-block;"></label>e)	Melaksanakan Evaluasi Supervisi Guru dan Tenaga Kependidikan.</p>
<p><label style="width:25px;display: inline-block;"></label>f)	Merencanakan dan Menindaklanjuti Hasil Evaluasi dan Pelaporan Pelaksanaan Tugas Supervisi<br><label style="width:40px;display: inline-block;"></label>kepada Guru dan Tenaga Kependidikan.</p>
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
	<td><?= $m['tglsk'] ?> <?= $sk['tahun'] ?></td>
	</tr>
	</table>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"></td>
	<td colspan="3">
	&nbsp;&nbsp;Kepala Sekolah
	<br><br><br><br>
	&nbsp; <b><u><?= $setting['kepsek'] ?></u></b>
	<br>&nbsp; NIP/NUPTK. <?= $setting['nip'] ?>
	
	<td>	
	
	</tr>	
	</table>
<p style="page-break-before: always;"></p>
<br>
<table width="100%">
	<tr style="vertical-align:top;font-weight:bold">
	<td width="15%">Lampiran II<td>
	<td width="2%">:</td>
	<td width="83%">Surat Keputusan Kepala <?= $setting['sekolah'] ?></td>
	</tr>
	<tr style="vertical-align:top">
	<td>Nomor<td>
	<td>:</td>
	<td><?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></td>
	</tr>
<tr style="vertical-align:top">
	<td>Tentang<td>
	<td>:</td>
	<td></td>
	</tr>		
	</table>
	<br>
	<p style="text-align:center" class="f12">PEMBAGIAN TUGAS GURU DALAM PROSES BELAJAR MENGAJAR DAN BIMBINGAN KURIKULUM MERDEKA</p>
<p style="text-align:center" class="f12">SEMESTER <?= $setting['semester'] ?> TAHUN PELAJARAN <?= $setting['tp'] ?></p>
<br>
	
	<?php $jklas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kelas")); ?>
 
	<table width="100%" border="1" style="font-size:12px">
	<tr style="vertical-align:middle;text-align:center">
	<td rowspan="2" width="5%">NO</td>
	<td rowspan="2" width="20%">NAMA<br>NIP / NUPTK</td>
	<td rowspan="2">JABATAN</td>
	<td rowspan="2">JENIS</td>
	<td colspan="<?= $jklas ?>">TUGAS DIKELAS</td>
	<td rowspan="2" width="5%">JJM</td>
	<td rowspan="2">TUGAS</td>
	<td rowspan="2">KET</td>
	</tr>
	<tr>
	<?php
	$queryx = mysqli_query($koneksi, "SELECT * FROM kelas"); 
	while ($datax = mysqli_fetch_array($queryx)) :
	?>
	<td style="text-align:center"><?= $datax['kelas'] ?></td>	
	<?php endwhile; ?>
	</tr>
	
	<tr>	
	<td style="text-align:center">1</td>	
	<td><?= $setting['kepsek'] ?><br><?= $setting['nip'] ?></td>
	<td style="text-align:center">Kepala Sekolah</td>	
	<td style="text-align:center">Kepala Sekolah</td>
	<?php
	$q = mysqli_query($koneksi, "SELECT * FROM kelas"); 
	while ($d = mysqli_fetch_array($q)) :
	?>
	<td></td>	
	<?php endwhile; ?>
	<td style="text-align:center">24</td>	
	<td style="text-align:center" >Kepala Sekolah</td>	
	<td style="text-align:center">Manajerial, Kewirausahaan, Supervisi</td>	
	</tr>
<?php
   
	$no=1;
	$query = mysqli_query($koneksi, "SELECT * FROM sk_peg WHERE idsk='2' and mapel<>''"); 
	while ($data = mysqli_fetch_array($query)) :
	$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
	$tgs = fetch($koneksi,'m_tugas',['idt'=>$data['kode']]);
	if($data['jenis']=='GM'){$jenis ='Guru Mapel';}
	if($data['jenis']=='GK'){$jenis ='Guru Kelas';}
	if($data['jenis']=='GM'){$jenis ='Guru Mapel';}
	if($data['jenis']=='GB'){$jenis ='Guru BK';}
	if($data['jenis']=='KS'){$jenis ='Kepala Sekolah';}
	$check = explode(', ',$data['level']);
	$checked = explode(', ',$data['kelas']);
	$jml_data = count($check);
	for ($i=0; $i < $jml_data; $i++);
	$jjm = $data['jjm'];
	$no++;
	$kuri1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas  WHERE level='$check[0]'"));
	$kuri2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas  WHERE level='$check[1]'"));
	$kuri3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas  WHERE level='$check[2]'"));
	if($jml_data==1){
	if($kuri1['kuri']=='1' OR $kuri2['kuri']=='1' OR $kuri3['kuri']=='1'){$kurix ='Kurikulum 2013';}
	if($kuri1['kuri']=='2' OR $kuri2['kuri']=='2' OR $kuri3['kuri']=='2'){$kurix ='Kurikulum Merdeka';}
	}else{
	if($kuri1['kuri']=='1' OR $kuri2['kuri']=='1' OR $kuri3['kuri']=='1'){$kurix ='Kurikulum 2013';}
	if($kuri1['kuri']=='2' OR $kuri2['kuri']=='2' OR $kuri3['kuri']=='2'){$kurix1 ='Kurikulum Merdeka';}
	}
	?>
	<tr>	
	<td style="text-align:center" width="5%"><?= $no ?></td>	
	<td><?= $peg['nama'] ?><br><?= $peg['nip'] ?></td>
	<td style="text-align:center"><?= $peg['jabatan'] ?></td>	
	<td style="text-align:center"><?= $jenis ?></td>
   <?php
   
  
	$que = mysqli_query($koneksi, "SELECT * FROM kelas"); 
	while ($dt = mysqli_fetch_array($que)) :
	
	
	?>
	<td style="text-align:center">
	<?php if(in_array ($dt['kelas'], $checked)){ ?>
	V
	<?php } ?>
	</td>	
	<?php endwhile; ?>
   <td style="text-align:center" width="5%">
   <?php if($jjm <>0): ?>
   <?= $jjm  ?>
   <?php endif; ?>
   </td>
<td style="text-align:center"><?= $data['mapel'] ?></td> 
  <td style="text-align:center">
  <?php if($jml_data == 1): ?>
  <?= $kurix ?>  
  <?php else: ?>
  <?= $kurix ?>  <?= $kurix1 ?> 
<?php endif; ?>
  </td>
	</tr>	
	<?php endwhile; ?>
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
	<td><?= $m['tglsk'] ?> <?= $sk['tahun'] ?></td>
	</tr>
	</table>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"></td>
	<td colspan="3">
	&nbsp;&nbsp;Kepala Sekolah
	<br><br><br><br>
	&nbsp; <b><u><?= $setting['kepsek'] ?></u></b>
	<br>&nbsp; NIP/NUPTK. <?= $setting['nip'] ?>
	<td>	
	
	</tr>	
	</table>
<p style="page-break-before: always;"></p>
<br>

<table width="100%">
	<tr style="vertical-align:top;font-weight:bold">
	<td width="15%">Lampiran III<td>
	<td width="2%">:</td>
	<td width="83%">Surat Keputusan Kepala <?= $setting['sekolah'] ?></td>
	</tr>
	<tr style="vertical-align:top">
	<td>Nomor<td>
	<td>:</td>
	<td><?= $nomor ?><?= $m['nosk'] ?><?= $tahun ?></td>
	</tr>
<tr style="vertical-align:top">
	<td>Tentang<td>
	<td>:</td>
	<td></td>
	</tr>		
	</table>
	<br>
	<p style="text-align:center" class="f12">TUGAS TAMBAHAN PENDIDIK DAN TENAGA KEPENDIDIKAN KURIKULUM MERDEKA </p>
<p style="text-align:center" class="f12">SEMESTER <?= $setting['semester'] ?> TAHUN PELAJARAN <?= $setting['tp'] ?></p>
<br>

<table width="100%" border="1" style="font-size:12px">
	<tr style="vertical-align:middle;text-align:center">
	<td width="5%">NO</td>
	<td width="20%">NAMA<br>NIP / NUPTK</td>
	<td>JABATAN</td>
	<td>JENIS TUGAS / TAMBAHAN</td>
	<td width="10%">SASARAN BIMBINGAN</td>
	<td>JAM PER MINGGU</td>
	<td>BEBAN TUGAS</td>
	<td>BEBAN KERJA</td>
	</tr>
<tr>	
	<td style="text-align:center">1</td>	
	<td><?= $setting['kepsek'] ?><br><?= $setting['nip'] ?></td>
	<td style="text-align:center">Kepala Sekolah</td>	
	<td style="text-align:center">Manajerial, Kewirausahaan, Supervisi</td>
	<td style="text-align:center">Guru <?= $setting['sekolah'] ?></td>	
	<td style="text-align:center">24</td>	
	<td style="text-align:center">24</td>	
	<td style="text-align:center">24</td>	
	</tr>
	<?php
	$no=1;
	$queryq = mysqli_query($koneksi, "SELECT * FROM sk_peg WHERE idsk='2' and lainnya<>''"); 
	while ($dataq = mysqli_fetch_array($queryq)) :
	$pegawai = fetch($koneksi,'users',['id_user'=>$dataq['idpeg']]);
	$tgas = fetch($koneksi,'m_tugas',['idt'=>$dataq['lainnya']]);
	$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jjm) as jumlah,idpeg FROM sk_peg  WHERE idpeg='$dataq[idpeg]'"));
	
	$no++;
	?>
	<tr>
	<td style="text-align:center"><?= $no ?></td>	
	<td><?= $pegawai['nama'] ?><br><?= $pegawai['nip'] ?></td>
	<td style="text-align:center"><?= $pegawai['jabatan'] ?></td>	
	<td style="text-align:center"><?= ucwords(strtolower($tgas['tugas'])) ?></td>
	<td style="text-align:center"><?= $dataq['kelas'] ?></td>	
	<td style="text-align:center"><?= $jjm['jumlah'] ?></td>	
	<td style="text-align:center"><?= $dataq['jjm_tugas'] ?></td>	
	<td style="text-align:center"><?= ($jjm['jumlah'] + $dataq['jjm_tugas']) ?></td>	
	</tr>
	<?php endwhile; ?>
	
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
	<td><?= $m['tglsk'] ?> <?= $sk['tahun'] ?></td>
	</tr>
	</table>
	<table width="100%">
	<tr style="vertical-align:top">
	<td width="60%"></td>
	<td colspan="3">
	&nbsp;&nbsp;Kepala Sekolah
	<br><br><br><br>
	&nbsp; <b><u><?= $setting['kepsek'] ?></u></b>
	<br>&nbsp; NIP/NUPTK. <?= $setting['nip'] ?>
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
$dompdf->setPaper('Folio', 'Potrait');
$dompdf->render();
$dompdf->stream("PEMBAGIAN TUGAS SEMESTER ".$semester.".pdf", array("Attachment" => false));
exit(0);
?>