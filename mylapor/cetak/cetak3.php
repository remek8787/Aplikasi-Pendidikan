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

    <title>PROFIL</title>

<link rel='stylesheet' href='../../vendor/css/cetak.min.css'>

</head>
<style>
@page { margin: 50px; }
body { 
margin-left: 40px; 
margin-right: 20px;
margin-top: 50px;
margin-bottom: 50px;
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
<h3 class="bold tengah">PROFIL <?= strtoupper($setting['sekolah']) ?></h3>
 <h4 class="bold tengah">SUBDIN MENENGAH  DINAS PENDIDIKAN PROVINSI <?= strtoupper($setting['propinsi']) ?></h4>
 <h4 class="bold tengah"><?= $setting['tp'] ?></h4>   
   <br><br>
      <table width="100%" style="font-size:12px">
   <tr>
   <td>NAMA SEKOLAH</td>
   <td colspan="4">: <?= $setting['sekolah'] ?></td>
   
   </tr>  
<tr>
   <td>NPSN</td>
   <td>: <?= $setting['npsn'] ?></td>
   <td></td>
   <td>NSS</td>
   <td width="25%">: <?= $setting['nss'] ?></td>
   </tr> 
<tr>
   <td width="24%">Kurikulum yang digunakan</td>
   <td>:
   <?php
	$queryx = mysqli_query($koneksi, "SELECT kuri FROM kelas  GROUP BY kuri"); 
	while ($datax = mysqli_fetch_array($queryx)) :
	$kuri = fetch($koneksi,'m_kurikulum',['idk'=>$datax['kuri']]);
	?>
	<?= $kuri['nama_kurikulum'] ?> &nbsp;
	<?php endwhile; ?>
   </td>
   <td></td>
   <td width="18%">Tahun Berdiri</td>
   <td>: <?= $setting['tahun_berdiri'] ?></td>
   </tr> 
   <tr style="vertical-align:top">
   <td>Alamat Sekolah</td>
   <td>: <?= $setting['alamat'] ?>
   <br>&nbsp;&nbsp;Desa <?= $setting['desa'] ?>
   <br>&nbsp;&nbsp;Kec. <?= $setting['kecamatan'] ?>
   <br>&nbsp;&nbsp;Kab. <?= $setting['kabupaten'] ?>
   </td>
   <td></td>
   <td> <?php if($setting['jenjang']=='SMK' OR $setting['jenjang']=='SMA'): ?>Jurusan/Program<?php endif; ?></td>
   <td> <?php if($setting['jenjang']=='SMK' OR $setting['jenjang']=='SMA'): ?>:
   <?php
	$query = mysqli_query($koneksi, "SELECT jurusan FROM kelas WHERE jurusan<>'semua' GROUP BY jurusan"); 
	while ($data = mysqli_fetch_array($query)) :
	?>
	<?= $data['jurusan'] ?><br>&nbsp;
	<?php endwhile; ?>
	<?php endif; ?>
   </td>
   </tr>
   <tr>
   <td>Kode Pos</td>
   <td>: ................................</td>
   <td></td>
   <td>Akreditasi</td>
   <td>: <?= $setting['akreditasi'] ?></td>
   </tr>
    <tr>
   <td>Nomor Telepon Sekolah</td>
   <td>: ................................</td>
   <td></td>
   <td></td>
   <td></td>
   </tr>
    <tr>
   <td>Surel/Email</td>
   <td>: <?= $setting['email'] ?></td>
   <td></td>
   <td>Website Sekolah</td>
   <td>: <?= $setting['server'] ?></td>
   </tr>
   <tr>
   <td>Nama Kepala Sekolah</td>
   <td>: <?= $setting['kepsek'] ?></td>
   <td></td>
   <td>NIP Kepala </td>
   <td>: <?= $setting['nip'] ?></td>
   </tr>
   <tr>
   <td>No HP Kepala Sekolah</td>
   <td>: <?= $setting['nowa'] ?></td>
   <td></td>
   <td>Pangkat Kepala </td>
   <td>: .................................</td>
   </tr>
   <tr>
   <td>Jumlah Guru</td>
   <td>: PNS <?= $gpns; ?> <i>org</i>, Non PNS : <?= $gnon; ?> <i>org</i></td>
   <td></td>
   <td></td>
   <td></td>
   </tr>
   <tr>
   <td>Jumlah Laboran</td>
   <td>: PNS 0 <i>org</i>, Non PNS : 0 <i>org</i></td>
   <td></td>
   <td>Jumlah Siswa</td>
   <td>: <?= $jsis; ?></td>
   </tr>
   <tr>
   <td>Jumlah Tata Usaha</td>
   <td>: PNS <?= $tpns; ?> <i>org</i>, Non PNS : <?= $tnon; ?> <i>org</i></td>
   <td></td>
   <td>Ekstakurikuler</td>
   <td>: Pramuka (wajib)</td>
   </tr>
     <tr style="vertical-align:top">
   <td>Jumlah Penajaga Sekolah</td>
   <td>: PNS <?= $jpns; ?> <i>org</i>, Non PNS : <?= $jnon; ?> <i>org</i></td>
   <td></td>
   <td style="background-color:#99C68E"> <?php if($setting['jenjang']=='SMK' OR $setting['jenjang']=='SMA'): ?>BKK<br>(Bursa Kerja Khusus)<?php endif; ?></td>
   <td style="background-color:#99C68E"> <?php if($setting['jenjang']=='SMK' OR $setting['jenjang']=='SMA'): ?>: Ada / Tidak<?php endif; ?></td>
   </tr>
   </table>
   <br>
   <p style="font-size:14px;font-weight:bold">I. Keadaan Siswa dan Guru</p>
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center">
   <td rowspan="3">KOMPETENSI KEAHLIAN/PROGRAM KEAHLIAN</td>
   <td colspan="10">KEADAAN SISWA</td>
    <td colspan="6" style="background-color:#99C68E">KEADAAN GURU KELP C / PRODUKTIF</td>
   </tr>
   <tr style="text-align:center">
   <td colspan="3">KELAS 10</td>
   <td colspan="3">KELAS 11</td>
   <td colspan="3">KELAS 12</td>
   <td rowspan="2">JML SISWA</td>
    <td rowspan="2" style="background-color:#99C68E">JMLH Rombel</td>
	<td colspan="2" style="background-color:#99C68E">Jml Guru </td>
	<td rowspan="2" style="background-color:#99C68E">Jml Ideal</td>
	<td rowspan="2" style="background-color:#99C68E">Kurang</td>
	<td rowspan="2" style="background-color:#99C68E">Lebih</td>
   </tr>
  <tr style="text-align:center">
   <td>L</td>
	<td>P</td>
	<td style="background-color:#FFDAB9">Rbl</td>
	 <td>L</td>
	<td>P</td>
	<td style="background-color:#FFDAB9">Rbl</td>
	 <td>L</td>
	<td>P</td>
	<td style="background-color:#FFDAB9">Rbl</td>
	<td style="background-color:#99C68E">PNS</td>
	<td style="background-color:#99C68E">Non</td>
   </tr>
   
   <?php
	$query = mysqli_query($koneksi, "SELECT jurusan,pk,level FROM kelas GROUP BY jurusan"); 
	while ($data = mysqli_fetch_array($query)) :
	$jL10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='10' and jurusan='$data[jurusan]'"));
    $jP10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='10' and jurusan='$data[jurusan]'"));		
	$jR10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,kelas FROM kelas WHERE level='10' and jurusan='$data[jurusan]'"));		
	$jL11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='11' and jurusan='$data[jurusan]'"));
    $jP11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='11' and jurusan='$data[jurusan]'"));		
	$jR11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,kelas FROM kelas WHERE level='11' and jurusan='$data[jurusan]'"));		
	$jL12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='12' and jurusan='$data[jurusan]'"));
    $jP12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='12' and jurusan='$data[jurusan]'"));		
	$jR12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT level,kelas FROM kelas WHERE level='12' and jurusan='$data[jurusan]'"));		
	$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT jurusan FROM siswa WHERE jurusan='$data[jurusan]'"));	
	$jrom = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM kelas WHERE jurusan='$data[jurusan]'"));	
	$jpk = mysqli_num_rows(mysqli_query($koneksi, "SELECT jurusan FROM kelas  group by jurusan"));
	$guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT jadwal_mengajar.guru,jadwal_mengajar.mapel,mapel_rapor.idmapel,mapel_rapor.kelompok,mapel_rapor.jurusan FROM jadwal_mengajar JOIN mapel_rapor ON mapel_rapor.idmapel=jadwal_mengajar.mapel WHERE  mapel_rapor.jurusan='$data[jurusan]' AND mapel_rapor.kelompok<>'A' AND mapel_rapor.kelompok<>'B' GROUP BY jadwal_mengajar.guru"));	
	$ideal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE kelompok<>'A' AND kelompok<>'B' and jurusan='$data[jurusan]'"));	
	$ideal = $ideal/$jpk ;
	?>
	 <tr>
	<td><?= $data['pk'] ?></td>
	<td class="tengah"><?= $jL10; ?></td>
	<td class="tengah"><?= $jP10; ?></td>
	<td class="tengah" style="background-color:#FFDAB9"><?= $jR10; ?></td>
	<td class="tengah"><?= $jL11; ?></td>
	<td class="tengah"><?= $jP11; ?></td>
	<td class="tengah" style="background-color:#FFDAB9"><?= $jR11; ?></td>
	<td class="tengah"><?= $jL12; ?></td>
	<td class="tengah"><?= $jP12; ?></td>
	<td class="tengah" style="background-color:#FFDAB9"><?= $jR12; ?></td>
	<td class="tengah bold"><?= $jsiswa; ?></td>
	<td class="tengah" style="background-color:#99C68E"><?= $jrom; ?></td>
	<td style="background-color:#99C68E"></td>
	<td class="tengah" style="background-color:#99C68E"><?= $guru ?></td>
	<td class="tengah" style="background-color:#99C68E"><?= $ideal ?></td>
	<td class="tengah" style="background-color:#99C68E">
	<?php if($guru < $ideal): ?>
	<?= $ideal - $guru; ?>
	<?php endif; ?>
	</td>
	<td class="tengah" style="background-color:#99C68E">
	<?php if($guru > $ideal): ?>
	<?= $guru - $ideal; ?>
	<?php endif; ?>
	</td>
   </tr>
	
	<?php endwhile; ?>
	<?php
	$TL10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='10'"));
	$TP10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='10'"));
	$jrom10 = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM kelas WHERE level='10'"));	
	$TL11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='11'"));
	$TP11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='11'"));
	$jrom11 = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM kelas WHERE level='11'"));	
	$TL12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='L' and level='12'"));
	$TP12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,level FROM siswa WHERE jk='P' and level='12'"));
	$jrom12 = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM kelas WHERE level='12'"));	
	$Trom = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM kelas"));	
	$Tguru = mysqli_num_rows(mysqli_query($koneksi, "SELECT jadwal_mengajar.guru,jadwal_mengajar.mapel,mapel_rapor.idmapel,mapel_rapor.kelompok FROM jadwal_mengajar JOIN mapel_rapor ON mapel_rapor.idmapel=jadwal_mengajar.mapel WHERE mapel_rapor.kelompok<>'A' AND mapel_rapor.kelompok<>'B' GROUP BY jadwal_mengajar.guru"));	
	$Tideal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE kelompok<>'A' AND kelompok<>'B'"));	
	$Tguru = $Tguru*$jpk;
	$Tideal = $Tideal/$jpk;
	
	?>
    <tr>
	<td class="tengah bold">TOTAL</td>
	<td class="tengah bold"><?= $TL10; ?></td>
	<td class="tengah bold"><?= $TP10; ?></td>
	<td class="tengah bold" style="background-color:#FFDAB9"><?= $jrom10; ?></td>
	<td class="tengah bold"><?= $TL11; ?></td>
	<td class="tengah bold"><?= $TP11; ?></td>
	<td class="tengah bold" style="background-color:#FFDAB9"><?= $jrom11; ?></td>
	<td class="tengah bold"><?= $TL12; ?></td>
	<td class="tengah bold"><?= $TP12; ?></td>
	<td class="tengah bold" style="background-color:#FFDAB9"><?= $jrom12; ?></td>
	<td class="tengah bold"><?= $jsis; ?></td>
	<td class="tengah bold" style="background-color:#99C68E"><?= $Trom; ?></td>
	
	<td style="background-color:#99C68E"></td>
	<td class="tengah bold" style="background-color:#99C68E"><?= $Tguru; ?></td>
	<td class="tengah bold" style="background-color:#99C68E"><?= $Tideal; ?></td>
	<td class="tengah bold" style="background-color:#99C68E">
	<?php if($Tguru < $Tideal): ?>
	<?= $Tideal - $Tguru; ?>
	<?php endif; ?>
	</td>
	<td class="tengah bold" style="background-color:#99C68E">
	<?php if($Tguru > $Tideal): ?>
	<?= $Tguru - $Tideal; ?>
	<?php endif; ?>
	</td>
   </tr>
 
   </table>
   
  <p style="font-size:12px;">Ket: Guru Minimanl S-1/D4 dengan standar kebutuhan Guru Kurikulum <?php
	$queryx = mysqli_query($koneksi, "SELECT kuri FROM kelas  GROUP BY kuri"); 
	while ($datax = mysqli_fetch_array($queryx)) :
	$kuri = fetch($koneksi,'m_kurikulum',['idk'=>$datax['kuri']]);
	?>
	<?= $kuri['nama_kurikulum'] ?> &nbsp;
	<?php endwhile; ?></p>
  <br>
 <p style="font-size:12px;font-weight:bold">KELOMPOK A DAN B</p>
  <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center">
   <td rowspan="2" class="bold">Pelajaran</td>
   <td rowspan="2" class="bold">Nama</td>
   <td colspan="2">Status</td>
   <td rowspan="2" width="8%">Status Pelatihan</td>
    <td colspan="4">Keadaan Guru Sesuai Rombel</td>
   </tr> 
   <tr> 
   <td class="tengah" width="5%" >PNS</td>
   <td class="tengah" width="5%" >Non</td>
   <td width="10%" class="tengah">Rombel</td>
   <td width="5%" class="tengah">Ideal</td>
   <td width="5%" class="tengah">Kurang</td>
   <td width="5%" class="tengah">Lebih</td>
   </tr>
  
   <?php
	$query = mysqli_query($koneksi, "SELECT idmapel,kelompok,jurusan,level FROM mapel_rapor WHERE kelompok='A' or kelompok='B' GROUP BY idmapel"); 
	while ($data = mysqli_fetch_array($query)) :
	$pel = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
	
	?>
 <tr>
   <td>
   <?= $pel['nama_mapel'] ?>
   </td>
   <td>
   <?php
   $no=0;
	$queryx = mysqli_query($koneksi, "SELECT mapel,guru,kelas FROM jadwal_mengajar WHERE mapel='$pel[id]' GROUP BY guru"); 
	while ($jadwal= mysqli_fetch_array($queryx)) :
	$peg = fetch($koneksi,'users',['id_user'=>$jadwal['guru']]);
	$no++;
	?>
    <?= $no; ?>. <?= $peg['nama'] ?>
	<br>
	 <?php endwhile; ?>
	</td>
	<td class="tengah">
	<?php if($peg['status']<>'NON PNS'): ?>
	V
	<?php endif; ?>
	</td>
	<td class="tengah">
	<?php if($peg['status']=='NON PNS'): ?>
	V
	<?php endif; ?>
	</td>
	<td class="tengah"></td>
	<td class="tengah">
	 <?php  
	$queryxx = mysqli_query($koneksi, "SELECT mapel,guru,kelas FROM jadwal_mengajar WHERE mapel='$pel[id]' GROUP BY guru,kelas"); 
	while ($jadwalx= mysqli_fetch_array($queryxx)) : ?>
	<?= $jadwalx['kelas'] ?>
	<br>
	 <?php endwhile; ?>
	
	</td>
	<td></td>
	<td></td>
	<td></td>
	  <?php endwhile; ?>
   </tr>
  
   </table>
   <br>
    <p style="font-size:12px;font-weight:bold">KELOMPOK C / GURU PRODUKTIF</p>
    <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center">
   <td rowspan="2" class="bold">Pelajaran</td>
   <td rowspan="2" class="bold">Nama</td>
   <td colspan="2">Status</td>
   <td rowspan="2" width="8%">Status Pelatihan</td>
    <td colspan="4">Keadaan Guru Sesuai Rombel</td>
   </tr> 
   <tr> 
   <td class="tengah" width="5%" >PNS</td>
   <td class="tengah" width="5%" >Non</td>
   <td width="10%" class="tengah">Rombel</td>
   <td width="5%" class="tengah">Ideal</td>
   <td width="5%" class="tengah">Kurang</td>
   <td width="5%" class="tengah">Lebih</td>
   </tr>
  
   <?php
	$query = mysqli_query($koneksi, "SELECT idmapel,kelompok FROM mapel_rapor WHERE kelompok<>'A' and kelompok<>'B' GROUP BY idmapel"); 
	while ($data = mysqli_fetch_array($query)) :
	$pel = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
	
	?>
 <tr>
   <td>
   <?= $pel['nama_mapel'] ?>
   </td>
   <td>
   <?php
   $no=0;
	$queryx = mysqli_query($koneksi, "SELECT mapel,guru,kelas FROM jadwal_mengajar WHERE mapel='$pel[id]' GROUP BY guru"); 
	while ($jadwal= mysqli_fetch_array($queryx)) :
	$peg = fetch($koneksi,'users',['id_user'=>$jadwal['guru']]);
	$no++;
	?>
    <?= $no; ?>. <?= $peg['nama'] ?>
	<br>
	 <?php endwhile; ?>
	</td>
	<td class="tengah">
	<?php if($peg['status']<>'NON PNS'): ?>
	V
	<?php endif; ?>
	</td>
	<td class="tengah">
	<?php if($peg['status']=='NON PNS'): ?>
	V
	<?php endif; ?>
	</td>
	<td class="tengah"></td>
	<td class="tengah">
	 <?php  
	$queryxx = mysqli_query($koneksi, "SELECT mapel,guru,kelas FROM jadwal_mengajar WHERE mapel='$pel[id]' GROUP BY guru,kelas"); 
	while ($jadwalx= mysqli_fetch_array($queryxx)) : ?>
	<?= $jadwalx['kelas'] ?>
	<br>
	 <?php endwhile; ?>
	
	</td>
	<td></td>
	<td></td>
	<td></td>
	  <?php endwhile; ?>
   </tr> 
   </table>
  <p style="page-break-before: always;"></p>
    
	<?php
	$jrow1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum' and ket is null"));
	$jrow2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum' and ket='Lab'"));
	?>
    <p style="font-size:14px;font-weight:bold">II. Standar Ruang Pembelajaran Umum</p>  
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#FFDAB9"> 
   <td rowspan="2" class="bold">JUMLAH, KELENGKAPAN  DAN KEADAAN RUANG/LAB</td>
   <td colspan="<?= $jrow1; ?>" class="bold">Ruang/Laboraturium</td>
   <td colspan="<?= $jrow2; ?>" class="bold">Ruang/Lab Khusus</td>
    </tr> 
	 <tr style="text-align:center;background-color:#FFDAB9"> 
	 <?php
		$query = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum' and ket is null"); 
		while ($data = mysqli_fetch_array($query)) :
      ?>
	 <td height="70px" width="5%"><p class="atas"><?= $data['ruang'] ?></p></td>
	<?php endwhile; ?>
	<?php
		$qu = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum' and ket='Lab'"); 
		while ($datas = mysqli_fetch_array($qu)) :
      ?>
	 <td height="70px" width="5%"><p class="atas"><?= $datas['ruang'] ?></p></td>
	<?php endwhile; ?>
	 </tr> 
	 <tr> 
	 <td>Jumlah</td>
	 <?php
		$queryx = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum'"); 
		while ($datax = mysqli_fetch_array($queryx)) :
      ?>
	 <td class="tengah"><?= $datax['jumlah'] ?></td>
	<?php endwhile; ?>
	 </tr> 
	  <tr> 
	 <td>Kelengkapan Alat</td>
	  <?php
		$queryx = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum'"); 
		while ($datax = mysqli_fetch_array($queryx)) :
      ?>
	 <td class="tengah"><?= $datax['kelengkapan'] ?></td>
	<?php endwhile; ?>
	 </tr> 
	  <tr> 
	 <td>Keadaan </td>
	  <?php
		$queryx = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='umum'"); 
		while ($datax = mysqli_fetch_array($queryx)) :
      ?>
	 <td class="tengah"><?= $datax['keadaan'] ?></td>
	<?php endwhile; ?>
	 </tr> 
   </table>
   <table style="font-size:12px;">
   <tr>
   <td>Keterangan kelengkapan</td><td>: L= Lengkap, KL= Kurang Lengkap, TL= Tidak Lengkap</td>
   </tr><tr>
   <td>Keterangan Keadaan</td><td>: B= Baik, RR=Rusak Ringan, RB=Rusak Berat</td>
   </tr> 
   </table>
   
  <br>
  <?php
	$jrow3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"));
	
	?>
 <p style="font-size:14px;font-weight:bold">III. Standar Ruang Penunjang</p>  
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#FFDAB9">
   <td rowspan="2" class="bold">Jumlah dan Keadaan</td>
   <td colspan="<?= $jrow3; ?>" class="bold">Ruang/Tempat/Sekretariat</td> 
    </tr> 
	 <tr style="text-align:center;background-color:#FFDAB9">
	<?php
	$query = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"); 
	while ($data = mysqli_fetch_array($query)) :
      ?>
	 <td height="70px" width="5%"><p class="atas"><?= $data['ruang'] ?></p></td>
	<?php endwhile; ?>	 
	 
	 </tr> 
	 <tr> 
	 <td>Jumlah</td>
	<?php
	$querys = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"); 
	while ($dataq = mysqli_fetch_array($querys)) :
      ?>
	   <td class="tengah"><?= $dataq['jumlah'] ?></td>
	  <?php endwhile; ?>	 
	 </tr> 
	  <tr> 
	 <td>Kelengkapan Alat</td>
	<?php
	$querys = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"); 
	while ($dataq = mysqli_fetch_array($querys)) :
      ?>
	   <td class="tengah"><?= $dataq['kelengkapan'] ?></td>
	  <?php endwhile; ?>	
	 </tr> 
	  <tr> 
	 <td>Luas (M2)</td>
	<?php
	$querys = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"); 
	while ($dataq = mysqli_fetch_array($querys)) :
      ?>
	   <td class="tengah"><?= $dataq['luas'] ?></td>
	  <?php endwhile; ?>	
	 </tr> 
	  <tr> 
	 <td>Keadaan </td>
	 <?php
	$querys = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='penunjang'"); 
	while ($dataq = mysqli_fetch_array($querys)) :
      ?>
	   <td class="tengah"><?= $dataq['keadaan'] ?></td>
	  <?php endwhile; ?>	
	 </tr> 
   </table>
    <table style="font-size:12px;">
   <tr>
   <td>Keterangan kelengkapan</td><td>: L= Lengkap, KL= Kurang Lengkap, TL= Tidak Lengkap</td>
   </tr><tr>
   <td>Keterangan Keadaan</td><td>: B= Baik, RR=Rusak Ringan, RB=Rusak Berat</td>
   </tr> 
   </table>
  <br>
   <p style="font-size:14px;font-weight:bold">IV. Keadaan Peralatan IT</p>
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#FFDAB9">
   <td rowspan="2" class="bold">No</td>
   <td rowspan="2" class="bold">Sarana Prasarana IT</td>
   <td colspan="2" class="bold">Keadaan</td>
 <td rowspan="2" class="bold">Total Alat Tersedia</td>
 <td rowspan="2" class="bold">Kapasitas</td>
 <td rowspan="2" class="bold">Tahun Pengadaan</td> 
 </tr> 
    <tr style="text-align:center;background-color:#FFDAB9">
   <td class="bold">Baik</td>
   <td class="bold">Rusak</td>
   </tr>
   <?php
   $no=0;
	$querys = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='it'"); 
	while ($dataq = mysqli_fetch_array($querys)) :
      $no++;
	  ?>
	  <tr>
    <td class="tengah"><?= $no; ?></td>
	<td><?= $dataq['nama_barang'] ?></td>
	<td class="tengah"><?= $dataq['baik'] ?></td>
	<td class="tengah"><?= $dataq['rusak'] ?></td>
	<td class="tengah"><?= $dataq['baik'] + $dataq['rusak'] ?></td>
	<td class="tengah"><?= $dataq['kapasitas'] ?></td>
	<td class="tengah"><?= $dataq['tahun'] ?></td>
	</tr>
    <?php endwhile; ?>	
	 </tr> 
   </table>
   <br>
   <p style="font-size:14px;font-weight:bold">V. Pemetaan Peminat dan  Lulusan</p>
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#FFDAB9">
    <td rowspan="2" class="bold">Tahun</td>
	 <td colspan="2" class="bold">Peminat</td>
	 <td rowspan="2" class="bold">Jumlah Lulusan</td>
	  <td colspan="2" class="bold">Lulusan</td>
    </tr> 
	 <tr style="text-align:center;background-color:#FFDAB9">
	<td>Pendaftar</td>
	<td>Diterima</td>
	<td width="12%">Melanjutkan(%)</td>
	<td width="12%">Bekerja (%)</td>
	
	</tr> 
	
	<?php 
	for( $i=(date('Y')-3); $i < ($tahun+1); $i++ ){ 
	$jlulus = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alumni WHERE ket='Tamat' and tahun_keluar='$i'"));
	$pdb = fetch($koneksi,'pdb',['tahun'=>$i]);
	?>
	<tr>
	<td class="tengah"><?= $i; ?></td>
	<td class="tengah"><?= $pdb['jumlah'] ?></td>
	<td class="tengah"><?= $pdb['jumlah'] ?></td>
	<td class="tengah">
	<?php if($jlulus<>0){?>
	<?= $jlulus ?>
	<?php } ?>
	</td>
	<td></td>
	<td></td>
	
	</tr> 
	<?php } ?>
   </table>
  
  <br>
  
   <p style="font-size:14px;font-weight:bold">VII. Kerjasama Usaha/Industri (Dudi)</p>
   <table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#99C68E">
   <td>Nama Dudi</td>
   <td width="25%">Bidang Kerjasama Dengan Dudi Yang Telah Disepakati</td>
	<td width="20%">Jml Siswa PKL/Thn</td>
	<td>Tamatan Menjadi Tenaga Kerja</td>
   </tr>
    <?php
   $no=0;
	$query = mysqli_query($koneksi, "SELECT * FROM pkl_dudi"); 
	while ($dt = mysqli_fetch_array($query)) :
	$jpes = mysqli_num_rows(mysqli_query($koneksi, "SELECT dudi FROM pkl_siswa WHERE dudi='$dt[id]'"));
      $no++;
	  ?>
   <tr>   
   <td height="15px"><?= $dt['nama_dudi'] ?></td>
	<td><?= $dt['bidang'] ?></td>
	<td class="tengah"><?= $jpes ?></td>
	<td></td>
	</tr>
	<?php endwhile; ?>
	 
    </table>
	
	<p style="page-break-before: always;"></p>
	
   <p style="font-size:14px;font-weight:bold">VIII. Unit Produksi</p>
	<table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#99C68E">
   <td>Nama Usaha</td>
   <td width="25%">Bidang Usaha</td>
	<td width="20%">Badan Hukum Usaha</td>
	<td>Omset/tahun</td>
   </tr> 
    <?php
	$query = mysqli_query($koneksi, "SELECT * FROM profil_smk WHERE kode='UP'"); 
	while ($dt = mysqli_fetch_array($query)) :	
	  ?>
    <tr>   
  <td height="15px"><?= $dt['nama'] ?></td>
	<td><?= $dt['bidang'] ?></td>
	<td class="tengah"><?= $dt['siup'] ?></td>
	<td class="tengah"><?= number_format($dt['omset']) ?></td>
	</tr> 
	<?php endwhile; ?>
	 <tr> 
	 <td height="15px"></td>
	<td></td>
	<td></td>
  <td></td>	
	</tr> 
    </table>
	<br>
   <p style="font-size:14px;font-weight:bold">IX. Bursa Kerja Khusus</p>
	<table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#99C68E">
   <td>Tgl Pelaksanaan</td>
   <td width="45%">Dunia usaha atau Industri yang ikut Bursa Kerja</td>
	<td width="20%">Tahun Pelaksanaan</td>	
   </tr> 
   <?php
	$query = mysqli_query($koneksi, "SELECT * FROM profil_smk WHERE kode='BK'"); 
	while ($dt = mysqli_fetch_array($query)) :	
	  ?>
    <tr>   
  <td height="15px" class="tengah"><?= $dt['tanggal'] ?></td>
	<td><?= $dt['nama'] ?></td>
	<td class="tengah"><?= $dt['tahun'] ?></td>	
	</tr> 
	<?php endwhile; ?>
	 <tr> 
	 <td height="15px"></td>
	<td></td>
	<td></td>	
	</tr> 
    </table>
	<br>
   <p style="font-size:14px;font-weight:bold">X. TEMPAT UJI KOMPETENSI</p>
	<table width="100%" border="1" style="font-size:12px;">
   <tr style="text-align:center;background-color:#99C68E">
   <td>Tgl Pelaksanaan</td>
   <td width="45%">Nama Tempat Uji Kompetensi/LSP P1</td>
	<td width="20%">Tahun Pelaksanaan</td>	
   </tr> 
   
    <?php
	$query = mysqli_query($koneksi, "SELECT * FROM profil_smk WHERE kode='UK'"); 
	while ($dt = mysqli_fetch_array($query)) :	
	  ?>
    <tr>   
  <td height="15px" class="tengah"><?= $dt['tanggal'] ?></td>
	<td><?= $dt['nama'] ?></td>
	<td class="tengah"><?= $dt['tahun'] ?></td>	
	</tr> 
	<?php endwhile; ?>
	 <tr>   
  <td height="15px"></td>
	<td></td>
	<td></td>	
	</tr> 
    </table>
	
	<br><br>
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
$dompdf->stream("PROFIL SEKOLAH.pdf", array("Attachment" => false));
exit(0);
?>