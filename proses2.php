<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'JDH1') {	
$idsoal = $_POST['idsoal'];
$idsiswa = $_POST['idsiswa'];
$idbank = $_POST['idbank'];
$idujian = $_POST['idujian'];
$kode = $_POST['kode'];
$warna = $_POST['warna'];
$cekdata = "SELECT * FROM jodoh WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'  AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

	}else{
		mysqli_query($koneksi,"INSERT INTO jodoh(id_soal,id_bank,id_ujian,kode,id_siswa,warna,jenis) VALUES('$idsoal','$idbank','$idujian','$kode','$idsiswa','$warna','5')");
		}
}

if ($pg == 'UPJDH') {
$idsoal = $_POST['idsoal'];
$idsiswa = $_POST['idsiswa'];
$idbank = $_POST['idbank'];
$idujian = $_POST['idujian'];
	$jdh = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jodoh WHERE id_soal='$idsoal' AND id_siswa='$idsiswa' AND jawab is NULL"));
	$kode = $jdh['kode'];
	$jawab = $_POST['jawab'];
	$cekdata = "SELECT * FROM jodoh WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'  AND kode='$kode' AND jawab is NULL";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$ubah = mysqli_query($koneksi,"UPDATE jodoh SET jawab='$jawab' WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'  AND kode='$kode' AND jawab is NULL");
	if($ubah){
	$data = array(); 
  $sql = mysqli_query($koneksi,"SELECT * FROM jodoh WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'"); 
  while ($r = mysqli_fetch_array($sql)){ 
    $data[]=$r['jawab'];
	$datax[]=$r['warna'];
  }
		$warna = implode(", ",$datax);
		$jawab = implode(", ",$data);
		
$cek = "SELECT * FROM jawaban WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'  AND id_bank='$idbank' AND jenis='5'";
$jika = mysqli_query($koneksi,$cek);
if(mysqli_num_rows($jika)>0){	
$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawaburut='$jawab',jawaban='$jawab',warna='$warna' WHERE id_siswa='$idsiswa' AND id_bank='$idbank' AND id_soal='$idsoal' AND jenis='5'");
		}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,id_ujian,jawaban,jawaburut,warna,jenis) VALUES ('$idsiswa','$idbank','$idsoal','$idujian','$jawab','$jawab','$warna','5')");

			}  
if($exec):
$hapus = mysqli_query($koneksi,"DELETE FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");		
$Q = mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");	
while ($coba = mysqli_fetch_array($Q)){
$jawaban = explode(', ',$coba['jawaban']);
$jml = count($jawaban);
$i=0;
foreach($jawaban as $string){
$i++;
$idjawab = $coba['id_soal'].'.'.$i;

$simpeun = mysqli_query($koneksi,"INSERT INTO jawaban_soal(id_soal,id_siswa,id_bank,id_ujian,idjawab,jenis,jawab) VALUES('$coba[id_soal]','$idsiswa','$idbank','$idujian','$idjawab','5','$string')");
	}
}
	$QN = mysqli_query($koneksi,"SELECT * FROM kunci_soal WHERE id_bank='$idbank' AND id_soal='$idsoal'");
	while ($skore = mysqli_fetch_array($QN)){
	$JS = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban_soal WHERE id_bank='$idbank' AND id_soal='$idsoal' AND id_siswa='$idsiswa' AND idjawab='$skore[id_jawab]'"));
	$soale = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM soal WHERE id_bank='$idbank' AND id_soal='$idsoal'"));
	$jawab_soale = explode(', ',$soale['jawaban']);
	$jml_jwbsoal = count($jawab_soale);
	$jawab_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_bank='$idbank' AND id_soal='$idsoal' AND id_siswa='$idsiswa' "));
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
    'id_bank' => $idbank,
    'id_siswa' => $idsiswa
    
    );
	$scorsis = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skorsis FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa' "));
	mysqli_query($koneksi,"UPDATE jawaban set skor='$scorsis[skorsis]' where id_soal='$idsoal' and id_siswa='$idsiswa'");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(max_skor) AS skr,id_bank FROM soal WHERE id_bank='$idbank'"));
	$score_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skormu FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' "));
	$skor_pg = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' AND jenis='1'"));
	$skor_esai = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' AND jenis='2'"));
	$skor_multi = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' AND jenis='3'"));
	$skor_bs = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' AND jenis='4'"));
	$skor_urut = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idbank' AND id_siswa='$idsiswa' AND jenis='5'"));
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
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");
	
	}

endif;		
	
		}
	}
}


	

?>