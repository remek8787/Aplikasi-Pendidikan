<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$id_siswa = $_POST['id_siswa'];
$id_bank = $_POST['id_bank'];
$id_ujian = $_POST['id_ujian'];
$id_soal = $_POST['id_soal'];
$jenis = '4';
$bs1 = $_POST['bs1'];
$bs2 = $_POST['bs2'];
$bs3 = $_POST['bs3'];
$bs4 = $_POST['bs4'];
$bs5 = $_POST['bs5'];


 if($bs1<>'' AND $bs2==''){$jawab = $bs1;}
 if($bs1<>'' AND $bs2<>''){$jawab = $bs1.', '.$bs2;}
  if($bs1<>'' AND $bs2<>'' AND $bs3<>''){$jawab = $bs1.', '.$bs2.', '.$bs3;}
   if($bs1<>'' AND $bs2<>'' AND $bs3<>'' AND $bs4<>''){$jawab = $bs1.', '.$bs2.', '.$bs3.', '.$bs4;}
    if($bs1<>'' AND $bs2<>'' AND $bs3<>'' AND $bs4<>'' AND $bs5<>''){$jawab = $bs1.', '.$bs2.', '.$bs3.', '.$bs4.', '.$bs5;}
 
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	
$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawabbs='$jawab',jawaban='$jawab' WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'");

	}else{
		
$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,id_ujian,jawabbs,jawaban,jenis) VALUES ('$id_siswa','$id_bank','$id_soal','$id_ujian','$jawab','$jawab','$jenis')");
	
	
		}
if($exec){
$hapus = mysqli_query($koneksi,"DELETE FROM jawaban_soal WHERE id_soal='$id_soal' AND id_siswa='$id_siswa'");		
$Q = mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$id_soal' AND id_siswa='$id_siswa'");	
while ($coba = mysqli_fetch_array($Q)){
$jawaban = explode(', ',$coba['jawaban']);
$jml = count($jawaban);
$i=0;
foreach($jawaban as $string){
$i++;
$idjawab = $coba['id_soal'].'.'.$i;

$simpeun = mysqli_query($koneksi,"INSERT INTO jawaban_soal(id_soal,id_siswa,id_bank,id_ujian,idjawab,jenis,jawab) VALUES('$coba[id_soal]','$id_siswa','$id_bank','$id_ujian','$idjawab','4','$string')");
	}
}
	$QN = mysqli_query($koneksi,"SELECT * FROM kunci_soal WHERE id_bank='$id_bank' AND id_soal='$id_soal'");
	while ($skore = mysqli_fetch_array($QN)){
	$JS = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban_soal WHERE id_bank='$id_bank' AND id_soal='$id_soal' AND id_siswa='$id_siswa' AND idjawab='$skore[id_jawab]'"));
	$soale = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM soal WHERE id_bank='$id_bank' AND id_soal='$id_soal'"));
	$jawab_soale = explode(', ',$soale['jawaban']);
	$jml_jwbsoal = count($jawab_soale);
	$jawab_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_bank='$id_bank' AND id_soal='$id_soal' AND id_siswa='$id_siswa' "));
	$siswa_jwb = explode(', ',$jawab_siswa['jawaban']);
	$jml_jwbsiswa = count($siswa_jwb);
	if($jml_jwbsiswa <= $jml_jwbsoal){
	if($skore['jawaban']==$JS['jawab']) {
		$skor = $skore['skor'];
	}else{
		$skor=0;
	}
	}else{
		$skor = 0;
	}
	$simpan = mysqli_query($koneksi,"UPDATE jawaban_soal SET skor='$skor' WHERE idjawab='$JS[idjawab]'");

	}
	if($simpan){
			$wherez = array(
    'id_bank' => $id_bank,
    'id_siswa' => $id_siswa
    
    );
	$scorsis = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skorsis FROM jawaban_soal WHERE id_soal='$id_soal' AND id_siswa='$id_siswa' "));
	mysqli_query($koneksi,"UPDATE jawaban set skor='$scorsis[skorsis]' where id_soal='$id_soal' and id_siswa='$id_siswa'");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(max_skor) AS skr,id_bank FROM soal WHERE id_bank='$id_bank'"));
	$score_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skormu FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' "));
	$skor_pg = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND jenis='1'"));
	$skor_esai = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND jenis='2'"));
	$skor_multi = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND jenis='3'"));
	$skor_bs = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND jenis='4'"));
	$skor_urut = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$id_bank' AND id_siswa='$id_siswa' AND jenis='5'"));
	$spg = $skor_pg['skor'];
	$spe = $skor_esai['skor'];
	$spm = $skor_multi['skor'];
	$spb = $skor_bs['skor'];
	$spu = $skor_urut['skor'];
	$nilai = ($score_siswa['skormu']/$max['skr'])*100;
	$data = array(
	'skor' => $spg,
	'skor_esai' => $spe,
	'skor_multi' => $spm,
	'skor_bs' => $spb,
	'skor_urut' => $spu,
    'total' => $score_siswa['skormu'],
	'makskor'=> $max['skr'],
	'nilai'=>round($nilai)
	);

    update($koneksi, 'nilai', $data, $wherez);
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_soal='$id_soal' AND id_siswa='$id_siswa'");
	
	}
	}

?>