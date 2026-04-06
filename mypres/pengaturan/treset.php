<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$query = mysqli_query($koneksi, "SELECT * FROM datareg"); 
	while ($data = mysqli_fetch_array($query)){
		$gambar = glob('../../data/'.$data['folder'].'/*'); 
  foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
    } 
	rmdir('../../data/'.$data['folder']);
	}
	
	$query = mysqli_query($koneksi, "SELECT * FROM pkl_reg"); 
	while ($data = mysqli_fetch_array($query)){
		$gambar = glob('../../data/'.$data['folder'].'/*'); 
  foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
    } 
	rmdir('../../data/'.$data['folder']);
	}
	
$exec = mysqli_query($koneksi, "update mesin_absen set depan='KARTU.png',belakang='KARTU.png',model='Landscape'");
$exec = mysqli_query($koneksi, "update siswa set sts='0',idjari=NULL");
$exec = mysqli_query($koneksi, "update users set sts='0',idjari=NULL where level<>'admin'");
$exec = mysqli_query($koneksi, "truncate absensi");
$exec = mysqli_query($koneksi, "truncate absen_pesan");
$exec = mysqli_query($koneksi, "truncate absen_jjm");
$exec = mysqli_query($koneksi, "truncate absen_mapel");
$exec = mysqli_query($koneksi, "truncate datareg");
$exec = mysqli_query($koneksi, "truncate absensi_les");
$exec = mysqli_query($koneksi, "truncate waktu");
$exec = mysqli_query($koneksi, "truncate temp_finger");
$exec = mysqli_query($koneksi, "truncate surat");
$exec = mysqli_query($koneksi, "truncate pesan_terkirim");
$exec = mysqli_query($koneksi, "truncate tmpface");
$exec = mysqli_query($koneksi, "truncate absen_tu");

unlink('../../neural.json');
$from = '../../json/neural.json'; 
$to = '../../neural.json'; 
$kopi = copy($from,$to) ; 
	
?>