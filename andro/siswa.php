<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
require("../konek/apk.php");

								
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'login') {
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE username='$username' AND password='$password' ");
$cek = mysqli_num_rows($query);
if ($cek <> 0) {
$user = mysqli_fetch_array($query);
   echo $user['id_siswa']."#";
   echo $user['nama']."#";
   echo $user['kelas']."#";
   echo $user['jurusan'];
}else{
	echo "gagal";
}
	
}

if ($pg == 'jadwal') { 

     
$idsiswa = $_POST['idsiswa'];
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$idsiswa'"));
$level = $siswa['level'];
$idsesi = $siswa['sesi'];	
$pk = $siswa['jurusan'];	
$query = "SELECT * FROM ujian WHERE status='1' AND level='$level' AND sesi='$idsesi' AND soal_agama='$agama' ORDER BY tgl_ujian ";
$data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
$ResultData = mysqli_num_rows($data);

if ($ResultData > 0) {
$getdata = array();
 while($row =mysqli_fetch_assoc($data)){
		$where = [
		  'id_bank' => $row['id_bank'],
		  'id_siswa' => $idsiswa
		  ];
	

	$nilai = fetch($koneksi, 'nilai', $where);
	$ceknilai = rowcount($koneksi, 'nilai', $where);
	if ($ceknilai == '0') :

	$getdata[] = $row;
	
	endif;

  
 }
 
 echo json_encode($getdata);
 
mysqli_close($koneksi);
} else {
echo "gagal";
mysqli_close($koneksi);
}

}



if ($pg == 'ambildata') {

$idb = $_POST['idbank'];
$no = 0;
$query = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb'"); 
								  while ($data = mysqli_fetch_array($query)) :
								$no++;
								 if($data['pilA']==''):
									mysqli_query($koneksi,"UPDATE soal SET pilA=NULL WHERE nomor='$data[nomor]'");
									endif;
									 if($data['pilB']==''):
									mysqli_query($koneksi,"UPDATE soal SET pilB=NULL WHERE nomor='$data[nomor]'");
									endif;
									 if($data['pilC']==''):
									mysqli_query($koneksi,"UPDATE soal SET pilC=NULL WHERE nomor='$data[nomor]'");
									endif;
									 if($data['pilD']==''):
									mysqli_query($koneksi,"UPDATE soal SET pilD=NULL WHERE nomor='$data[nomor]'");
									endif;
								   if($data['pilE']==''):
									mysqli_query($koneksi,"UPDATE soal SET pilE=NULL WHERE nomor='$data[nomor]'");
									endif;
									 if($data['perA']==''):
									mysqli_query($koneksi,"UPDATE soal SET perA=NULL WHERE nomor='$data[nomor]'");
									endif;
								   if($data['perB']==''):
									mysqli_query($koneksi,"UPDATE soal SET perB=NULL WHERE nomor='$data[nomor]'");
									endif;
								   if($data['perC']==''):
									mysqli_query($koneksi,"UPDATE soal SET perC=NULL WHERE nomor='$data[nomor]'");
									endif;
									if($data['perD']==''):
									mysqli_query($koneksi,"UPDATE soal SET perD=NULL WHERE nomor='$data[nomor]'");
									endif;
									if($data['perE']==''):
									mysqli_query($koneksi,"UPDATE soal SET perE=NULL WHERE nomor='$data[nomor]'");
									endif;
									
								   	if($data['file']==''):
									mysqli_query($koneksi,"UPDATE soal SET file=NULL WHERE nomor='$data[nomor]'");
									endif;
										if($data['file1']==''):
									mysqli_query($koneksi,"UPDATE soal SET file1=NULL WHERE nomor='$data[nomor]'");
									endif;
										if($data['fileA']==''):
									mysqli_query($koneksi,"UPDATE soal SET fileA=NULL WHERE nomor='$data[nomor]'");
									endif;
										if($data['fileB']==''):
									mysqli_query($koneksi,"UPDATE soal SET fileB=NULL WHERE nomor='$data[nomor]'");
									endif;	
										if($data['fileC']==''):
									mysqli_query($koneksi,"UPDATE soal SET fileC=NULL WHERE nomor='$data[nomor]'");
									endif;
										if($data['fileD']==''):
									mysqli_query($koneksi,"UPDATE soal SET fileD=NULL WHERE nomor='$data[nomor]'");
									endif;
										if($data['fileE']==''):
									mysqli_query($koneksi,"UPDATE soal SET fileE=NULL WHERE nomor='$data[nomor]'");
									endif;
									
									endwhile;



$query = "SELECT * FROM soal WHERE id_bank='$idb' ORDER BY rand()";
$data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
$ResultData = mysqli_num_rows($data);

if ($ResultData > 0) {
$getdata = array();
 while($row =mysqli_fetch_assoc($data))
 {
 $getdata[] = $row;
 }
 echo json_encode($getdata);
} else {
echo "gagalambil";
}

}

if ($pg == 'jumsoal') {
$bank = $_POST['idbank'];
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$bank'"));
echo $jumlah;
}



if ($pg == 'jawab') {
$idsiswa = $_POST['idsiswa'];
$idsoal = $_POST['idsoal'];
$idbank = $_POST['idbank'];
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$idsiswa'"));
$level = $siswa['level'];

$bj = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$idsoal'"));
$jenis = $bj['jenis'];
$jawab = $_POST['jawaban'];
$uji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_bank='$idbank'"));
$idu = $uji['id_ujian'];
$kd_uji = $uji['kode_ujian'];
$nilaiQ = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$idu' AND id_bank='$idbank' AND id_siswa='$idsiswa'"));

if($nilaiQ >0){
	
}else{
mysqli_query($koneksi,"INSERT INTO nilai(id_ujian,id_bank,id_siswa,level,ujian_mulai,ujian_berlangsung,kode_ujian,online) VALUES('$idu','$idbank','$idsiswa','$level','$waktumu','$waktumu','$kd_uji','1')");
}


if($jenis=='1'){

$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	
	}else{
	$result = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,jenis,id_ujian,jawaban) VALUES ('$idsiswa','$idbank','$idsoal','1','$idu','$jawab')");
	if($result){
	  $soale = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kunci_soal WHERE id_soal='$idsoal'"));
		$jawabane = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' and id_siswa='$idsiswa'"));
	
	if($soale['jawaban']==$jawabane['jawaban']){
		$skore = $soale['skor'];
	}else{
		$skore =0;
	}
	$simpan = mysqli_query($koneksi,"UPDATE jawaban SET skor='$skore' WHERE id_soal='$idsoal' and id_siswa='$idsiswa'");
	if($simpan){
		$wherez = array(
    'id_bank' => $idbank,
    'id_siswa' => $idsiswa
    
    );
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
	}
	}
	}
	
	
}	
if($jenis=='2'){

$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	
	
	}else{
$result = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,jenis,id_ujian,jawaban) VALUES ('$idsiswa','$idbank','$idsoal','2','$idu','$jawab')");
if($result){
$soale = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kunci_soal WHERE id_soal='$idsoal'"));
		$jawabane = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' and id_siswa='$idsiswa'"));
	
	if($soale['jawaban']==$jawabane['jawaban']){
		$skore = $soale['skor'];
	}else{
		$skore =0;
	}
	$simpan = mysqli_query($koneksi,"UPDATE jawaban SET skor='$skore' WHERE id_soal='$idsoal' and id_siswa='$idsiswa'");
	if($simpan){
		$wherez = array(
    'id_bank' => $idbank,
    'id_siswa' => $idsiswa
    
    );
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
	}
	}
	}
	
	
}	
if($jenis=='3'){
$jawab = substr($_POST['jawaban'], 0, -2); 
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){	
	$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawabmulti='$jawab' WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'");
	}else{
	$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,jenis,id_ujian,jawaban) VALUES ('$idsiswa','$idbank','$idsoal','3','$idu','$jawab')");
	}
	
if($exec){
$hapus = mysqli_query($koneksi,"DELETE FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");		
$Q = mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");	
while ($coba = mysqli_fetch_array($Q)){
$jawaban = explode(', ',$coba['jawaban']);
$jml = count($jawaban);
$i=0;
foreach($jawaban as $string){
$i++;
$idjawab = $coba['id_soal'].'.'.$i;

$simpeun = mysqli_query($koneksi,"INSERT INTO jawaban_soal(id_soal,id_siswa,id_bank,id_ujian,idjawab,jenis,jawab) VALUES('$coba[id_soal]','$idsiswa','$idbank','$idu','$idjawab','3','$string')");
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
	$simpan = mysqli_query($koneksi,"UPDATE jawaban_soal SET skor='$skor' WHERE id_jawaban='$JS[id_jawaban]'");

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
  }
  
 }
 
if($jenis=='4'){
$jawab = substr($_POST['jawaban'], 0, -2); 
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawabbs='$jawab' WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'");
	}else{
	$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,jenis,id_ujian,jawaban) VALUES ('$idsiswa','$idbank','$idsoal','4','$idu','$jawab')");
	echo "OK";
	}
if($exec){
$hapus = mysqli_query($koneksi,"DELETE FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");		
$Q = mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");	
while ($coba = mysqli_fetch_array($Q)){
$jawaban = explode(', ',$coba['jawaban']);
$jml = count($jawaban);
$i=0;
foreach($jawaban as $string){
$i++;
$idjawab = $coba['id_soal'].'.'.$i;

$simpeun = mysqli_query($koneksi,"INSERT INTO jawaban_soal(id_soal,id_siswa,id_bank,id_ujian,idjawab,jenis,jawab) VALUES('$coba[id_soal]','$idsiswa','$idbank','$idu','$idjawab','4','$string')");
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
	$simpan = mysqli_query($koneksi,"UPDATE jawaban_soal SET skor='$skor' WHERE id_jawaban='$JS[id_jawaban]'");

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
 }	

}

if($jenis=='5'){
$jawab = substr($_POST['jawaban'], 0, -2); 
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawaburut='$jawab' WHERE id_siswa='$idsiswa' AND id_soal='$idsoal'");
	}else{
	$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_bank,id_soal,jenis,id_ujian,jawaban) VALUES ('$idsiswa','$idbank','$idsoal','5','$idu','$jawab')");
	
	}
if($exec){
$hapus = mysqli_query($koneksi,"DELETE FROM jawaban_soal WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");		
$Q = mysqli_query($koneksi,"SELECT * FROM jawaban WHERE id_soal='$idsoal' AND id_siswa='$idsiswa'");	
while ($coba = mysqli_fetch_array($Q)){
$jawaban = explode(', ',$coba['jawaban']);
$jml = count($jawaban);
$i=0;
foreach($jawaban as $string){
$i++;
$idjawab = $coba['id_soal'].'.'.$i;

$simpeun = mysqli_query($koneksi,"INSERT INTO jawaban_soal(id_soal,id_siswa,id_bank,id_ujian,idjawab,jenis,jawab) VALUES('$coba[id_soal]','$idsiswa','$idbank','$idu','$idjawab','5','$string')");
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
	$simpan = mysqli_query($koneksi,"UPDATE jawaban_soal SET skor='$skor' WHERE id_jawaban='$JS[id_jawaban]'");

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
	
	}
	
}


}


if ($pg == 'selesai') {
$idsiswa = $_POST['idsiswa'];
$idbank = $_POST['idbank'];
$uji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_bank='$idbank'"));


$idu = $uji['id_ujian'];
$idm = $idbank;
$ids = $idsiswa;

$namasiswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));
$totalsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idm'"));
$totaljawaban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids'"));
$where = array(
    'id_bank' => $idm,
    'id_siswa' => $ids,
    'id_ujian' => $idu
	);

$benar = $salah = 0;
$benarm = $salahm = 0;
$benarb = $salahb = 0;
$benaru = $salahu = 0;
$benari = $salahi = 0;
$mapel = fetch($koneksi, 'banksoal', array('id_bank' => $idm));
$siswa = fetch($koneksi, 'siswa', array('id_siswa' => $ids));
$ceksoal = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 1));
$ceksoalesai = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 2));
$cekmulti = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 3));
$cekbs = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 4));
$cekurut = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 5));

$arrayjawabesai = array();
foreach ($ceksoalesai as $getsoalesai) {
    $w2 = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getsoalesai['id_soal'],
        'jenis' => 2
    );
   
    $getjwb2 = fetch($koneksi, 'jawaban', $w2);
    if ($getjwb2) {
        $jawabxx = str_replace("'", "`", $getjwb2['esai']);
        $jawabxx = str_replace("#", ">>", $jawabxx);
        $jawabxx = preg_replace('/[^A-Za-z0-9\@\<\>\$\_\&\-\+\(\)\/\?\!\;\:\`\"\[\]\*\{\}\=\%\~\`\÷\× ]/', '', $jawabxx);
        $arrayjawabesai[$getsoalesai['id_soal']] = $jawabxx;
    } else {
        $arrayjawabesai[$getsoalesai['id_soal']] = 'Tidak Diisi';
    }
	 ($getjwb2['esai'] == $getsoalesai['jawaban']) ? $benari++ : $salahi++;
}
$arrayjawab = array();
foreach ($ceksoal as $getsoal) {
    $w = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getsoal['id_soal'],
        'jenis' => 1
    );
    $getjwb = fetch($koneksi, 'jawaban', $w);
    if ($getjwb) {
        $arrayjawab[$getsoal['id_soal']] = $getjwb['jawaban'];
    } else {
        $arrayjawab[$getsoal['id_soal']] = 'X';
    }
    ($getjwb['jawaban'] == $getsoal['jawaban']) ? $benar++ : $salah++;
}

$arraymulti = array();
foreach ($cekmulti as $getmulti) {
    $m = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getmulti['id_soal'],
        'jenis' => 3
    );
    $getmt = fetch($koneksi, 'jawaban', $m);
    if ($getmulti) {
        $arraymulti[$getmulti['id_soal']] = $getmt['jawabmulti'];
    } else {
        $arraymulti[$getmulti['id_soal']] = 'X';
    }
    ($getmt['jawabmulti'] == $getmulti['jawaban']) ? $benarm++ : $salahm++;
}

$arraybs = array();
foreach ($cekbs as $getbs) {
    $b = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getbs['id_soal'],
        'jenis' => 4
    );
    $getb = fetch($koneksi, 'jawaban', $b);
    if ($getbs) {
        $arraybs[$getbs['id_soal']] = $getb['jawabbs'];
    } else {
        $arraybs[$getbs['id_soal']] = 'X';
    }
    ($getb['jawabbs'] == $getbs['jawaban']) ? $benarb++ : $salahb++;
}
$arrayurut = array();
foreach ($cekurut as $geturut) {
    $u = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $geturut['id_soal'],
        'jenis' => 5
    );
    $getut = fetch($koneksi, 'jawaban', $u);
    if ($geturut) {
        $arrayurut[$geturut['id_soal']] = $getut['jawaburut'];
    } else {
        $arrayurut[$geturut['id_soal']] = 'X';
    }
    ($getut['jawaburut'] == $geturut['jawaban']) ? $benaru++ : $salahu++;
}


$data = array(
    'ujian_selesai' => $waktumu,
    'online' => 0,
	
	'jawaban_pg' => serialize($arrayjawab),
    'jawaban_esai' => serialize($arrayjawabesai),
	'jawaban_multi' => serialize($arraymulti),
	'jawaban_bs' => serialize($arraybs),
	'jawaban_urut' => serialize($arrayurut),
	'server' =>$setting['id_server'],
	'jumjawab' =>$totaljawaban,
	'jumsoal' =>$totalsoal,
	'browser'=>1
);

update($koneksi, 'nilai', $data, $where);
    $exec = mysqli_query($koneksi, "DELETE FROM jodoh WHERE id_bank='$idm' AND id_siswa='$ids'");
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids'");
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_bank='$idm' AND id_siswa='$ids'");
	if($exec){
echo "sukses";
	}
}

if ($pg == 'nilai_ujian') {
	$ids = $_POST['idsiswa'];
$query = "SELECT * FROM nilai INNER JOIN banksoal ON banksoal.id_bank=nilai.id_bank INNER JOIN mapel ON mapel.kode=banksoal.nama WHERE nilai.id_siswa='$ids'";
$data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
$ResultData = mysqli_num_rows($data);

if ($ResultData > 0) {
$getdata = array();
 while($row =mysqli_fetch_assoc($data))
 {
 $getdata[] = $row;
 }
 echo json_encode($getdata);
} else {
echo "gagal";
}
	
}

	?>