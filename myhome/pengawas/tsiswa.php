<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'login') {
    $id = $_POST['id'];
	
    $exec = mysqli_query($koneksi,"UPDATE siswa set online='0' where id_siswa='$id'");
  }
if ($pg == 'hapus') {
    $id = $_POST['id'];
	$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM  nilai WHERE id_nilai='$id'"));
	$idsiswa = $nilai['id_siswa'];
	$idujian = $nilai['id_ujian'];
	 $busek = mysqli_query($koneksi, "DELETE FROM reset WHERE idsiswa='$idsiswa' AND idnilai='$id' AND idujian='$idujian'");
    $exec = delete($koneksi, 'nilai', ['id_nilai' => $id]);
  }
  if ($pg == 'ulang') {
    $id = $_POST['id'];
	
    $exec = delete($koneksi, 'nilai', ['id_nilai' => $id]);
  }
  if ($pg == 'reset') {
    $id = $_POST['id'];
	$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM  nilai WHERE id_nilai='$id'"));
	$idbank = $nilai['id_bank'];
	$idsiswa = $nilai['id_siswa'];
	$idujian = $nilai['id_ujian'];
	$hapus = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
    $busek = mysqli_query($koneksi, "DELETE FROM reset WHERE idsiswa='$idsiswa' AND idnilai='$id' AND idujian='$idujian'");
    $hapuse = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
	$hapusnya = mysqli_query($koneksi, "DELETE FROM jodoh WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
	$exec = delete($koneksi, 'nilai', ['id_nilai' => $id]);
  }
  
  if ($pg == 'selesai') {
    $id = $_POST['idp'];
	 
	$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM  nilai WHERE id_nilai='$id'"));
	$idbank = $nilai['id_bank'];
	$idsiswa = $nilai['id_siswa'];
	$idujian = $nilai['id_ujian'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(max_skor) AS skr,id_bank FROM soal WHERE id_bank='$idbank'"));
	$total = $nilai['skor']+$nilai['skor_esai']+$nilai['skor_multi']+$nilai['skor_bs']+$nilai['skor_urut'];
    $nilaimu = ($total/$max['skr'])*100;
	$nilaimu = round($nilaimu);
	$simpan = mysqli_query($koneksi,"UPDATE nilai SET ujian_selesai='$waktumu', browser='1', online='0',total='$total',nilai='$nilaimu' WHERE id_nilai='$id'");
	$hapus = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
	$hapus = mysqli_query($koneksi, "DELETE FROM jodoh WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
	$hapus = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_ujian='$idujian'");
	
 $logdata = array(
    'id_siswa' => dekripsi($id_siswa),
    'type' => 'ujian',
    'text' => 'selesai ujian',
    'date' => $waktumu,
	'level' => 'siswa'
);
insert($koneksi, 'log', $logdata);
  }
  
 
 
  if ($pg == 'paksaall') {
    $id = $_POST['id'];
	
  $simpan = mysqli_query($koneksi,"UPDATE nilai SET ujian_selesai='$waktumu', browser='1', online='0' WHERE id_ujian='$id' and browser='0'");
	$hapus = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_ujian='$id'");
	 $busek = mysqli_query($koneksi, "DELETE FROM reset WHERE idujian='$id'");
 
  }
   if ($pg == 'optimal') {
	 $tablejawab = 'jawaban';
	 $tablesoal = 'soal';
	  $tablenilai = 'nilai';
	   $exec = mysqli_query($koneksi, "OPTIMIZE TABLE '".$tablejawab."'");
	   $exec = mysqli_query($koneksi, "OPTIMIZE TABLE '".$tablesoal."'");
	   $exec = mysqli_query($koneksi, "OPTIMIZE TABLE '".$tablenilai."'");
  }
?>