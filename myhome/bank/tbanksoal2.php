<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'simpan_soal') {
	$idsoal = $_POST['idsoal'];
	$nomor = $_POST['nomor'];
    $jenis = $_POST['jenis'];
    $id_bank = $_POST['mapel'];
	$skor = $_POST['skor'];
    $isi_soal = addslashes($_POST['isi_soal']);
	$hapus = mysqli_query($koneksi, "DELETE FROM kunci_soal WHERE id_bank='$id_bank' AND id_soal='$idsoal'");
    $bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id_bank'"));     
	$soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' AND  id_soal='$idsoal' AND jenis='$jenis'");
    $soal = mysqli_fetch_array($soalQ);	
	
    $ektensi = ['jpg', 'png', 'mp3', 'jpeg'];
    
        $pilA = addslashes($_POST['pilA']);
        $pilB = addslashes($_POST['pilB']);
        $pilC = addslashes($_POST['pilC']);
        $pilD = addslashes($_POST['pilD']);
        $pilE = addslashes($_POST['pilE']);
       
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $url = '../files/' . $id_bank . '_' . $nomor . '_1.' . $ext;
                $urlx = $id_bank . '_' . $nomor . '_1.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $url);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$urlx','$id_bank')");
                (!$upload) ? $url = $soal['file'] : null;
            }
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $file1 = '../files/' . $id_bank . '_' . $nomor . '_2.' . $ext;
                $filex1 = $id_bank . '_' . $nomor . '_2.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $file1);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filex1','$id_bank')");
                (!$upload) ? $file1 = $soal['file1'] : null;
            }
        } else {
            $filex1 = $soal['file1'];
        }
        if (isset($_FILES['fileA']['name']) && $_FILES['fileA']['name'] <> '') {
            $fileA = $_FILES['fileA']['name'];
            $temp = $_FILES['fileA']['tmp_name'];
            $size = $_FILES['fileA']['size'];
            $ext = explode('.', $fileA);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileA = '../files/' . $id_bank . '_' . $nomor . '_A.' . $ext;
                $filexA = $id_bank . '_' . $nomor . '_A.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $fileA);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filexA','$id_bank')");
                (!$upload) ? $fileA = $soal['fileA'] : null;
            }
        } else {
            $filexA = $soal['fileA'];
        }
        if (isset($_FILES['fileB']['name']) && $_FILES['fileB']['name'] <> '') {
            $fileB = $_FILES['fileB']['name'];
            $temp = $_FILES['fileB']['tmp_name'];
            $size = $_FILES['fileB']['size'];
            $ext = explode('.', $fileB);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileB = '../files/' . $id_bank . '_' . $nomor . '_B.' . $ext;
                $filexB = $id_bank . '_' . $nomor . '_B.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $fileB);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filexB','$id_bank')");
                (!$upload) ? $fileB = $soal['fileB'] : null;
            }
        } else {
            $filexB = $soal['fileB'];
        }
        if (isset($_FILES['fileC']['name']) && $_FILES['fileC']['name'] <> '') {
            $fileC = $_FILES['fileC']['name'];
            $temp = $_FILES['fileC']['tmp_name'];
            $size = $_FILES['fileC']['size'];
            $ext = explode('.', $fileC);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileC = '../files/' . $id_bank . '_' . $nomor . '_C.' . $ext;
                $filexC = $id_bank . '_' . $nomor . '_C.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $fileC);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filexC','$id_bank')");
                (!$upload) ? $fileC = $soal['fileC'] : null;
            }
        } else {
            $filexC = $soal['fileC'];
        }
        if (isset($_FILES['fileD']['name']) && $_FILES['fileD']['name'] <> '') {
            $fileD = $_FILES['fileD']['name'];
            $temp = $_FILES['fileD']['tmp_name'];
            $size = $_FILES['fileD']['size'];
            $ext = explode('.', $fileD);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileD = '../files/' . $id_bank . '_' . $nomor . '_D.' . $ext;
                $filexD = $id_bank . '_' . $nomor . '_D.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $fileD);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filexD','$id_bank')");
                (!$upload) ? $fileD = $soal['fileD'] : null;
            }
        } else {
            $filexD = $soal['fileD'];
        }

        if (isset($_FILES['fileE']['name']) && $_FILES['fileE']['name'] <> '') {
            $fileE = $_FILES['fileE']['name'];
            $temp = $_FILES['fileE']['tmp_name'];
            $size = $_FILES['fileE']['size'];
            $ext = explode('.', $fileE);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileE = '../files/' . $id_bank . '_' . $nomor . '_E.' . $ext;
                $filexE = $id_bank . '_' . $nomor . '_E.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $fileE);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_bank)values('$filexE','$id_bank')");
                (!$upload) ? $fileE = $soal['fileE'] : null;
            }
        } else {
            $filexE = $soal['fileE'];
        }

     if($jenis == '1'){
		 $jawaban = $_POST['jawaban'];
		 $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE',max_skor='$skor' WHERE id_soal='$idsoal'");
	  $idjawab = $idsoal.'.1';
	mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$id_bank','$idsoal','$idjawab','$skor')");
	 }
	  if($jenis == '2'){
	   $jenisjawab = $_POST['jenisjawab'];  
	   $jawaban = strtolower($pilA);
	   $jumlahKarakter = strlen($jawaban);
	   $skor = $_POST['skor'];
	   $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal', jawaban='$jawaban',max_skor='$skor',file='$urlx',file1='$filex1',jenisjawab='$jenisjawab',panjang='$jumlahKarakter' WHERE id_soal='$idsoal' AND jenis='2'");
         $idjawab = $idsoal.'.1';
	mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$id_bank','$idsoal','$idjawab','$skor')");
   }
  if ($jenis == '3') {
	    
       $jawabQ = $_POST['jawaban'];
	   $jml_data = count($_POST['jawaban']);
	   $tskor = $jml_data * $skor;
       $jawaban = implode($_POST['jawaban'], ', ');
	   
	$exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',max_skor='$tskor',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban',file='$urlx',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_soal='$idsoal'");
	  for ($i=0; $i < $jml_data; $i++){
   $idjawab = $idsoal.'.'.($i+1);  
   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$i]','$id_bank','$idsoal','$idjawab','$skor')");
         
     }
     }
	   if ($jenis == '4') {
		   $jawabQ = $_POST['jawaban'];
	       $jml_data = count($_POST['jawaban']);
	       $tskor = $jml_data * $skor;
		   $jawaban=implode(', ',$_POST['jawaban']);
		  
		   $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',max_skor='$tskor',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban',file='$urlx',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_soal='$idsoal'");
	  for ($i=0; $i < $jml_data; $i++){
   $idjawab = $idsoal.'.'.($i+1);  
   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$i]','$id_bank','$idsoal','$idjawab','$skor')");
         
     }
	   }
	 if($jenis == '5'){
		$perA = addslashes($_POST['perA']);
        $perB = addslashes($_POST['perB']);
        $perC = addslashes($_POST['perC']);
        $perD = addslashes($_POST['perD']);
        $perE = addslashes($_POST['perE']);	
		$data = array(); 
		
  $sql = mysqli_query($koneksi,"SELECT * FROM menjodohkan WHERE idbank='$id_bank' and nomor='$nomor'"); 
  while ($r = mysqli_fetch_array($sql)){ 
    $data[]=$r['jawab'];
	$datax[]=$r['warna'];
  }
  
	   $warna = implode(", ",$datax);
		$jawab = implode(", ",$data);
		$jml_data = count($data);
		$jawabQ = explode(', ',$jawab);
		$tskor = $jml_data * $skor;
		$jawaban=$jawab;
		  
   $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',max_skor='$tskor',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',perA='$perA',perB='$perB',perC='$perC',perD='$perD',perE='$perE',jawaban='$jawaban',warna='$warna',file='$urlx',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_soal='$idsoal'");
   for ($i=0; $i < $jml_data; $i++){
   $idjawab = $idsoal.'.'.($i+1);  
   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$i]','$id_bank','$idsoal','$idjawab','$skor')");
   $hapus = mysqli_query($koneksi,"DELETE FROM menjodohkan WHERE idbank='$id_bank' and nomor='$nomor'");	 
     }
	
}

}
 
