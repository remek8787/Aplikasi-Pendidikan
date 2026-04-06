<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'ubah') {
	$id = $_POST['idm'];
    $nama = $_POST['mapel'];
    $level = $_POST['level'];
    $status = $_POST['status'];
	 $kode = str_replace(' ', '', $_POST['kode']);
	$model = $_POST['model'];
	if($model==0){
    $groupsoal = 'NON AKM';
	}else{
	$groupsoal = 'AKM';
	}
    $agama = $_POST['agama'];
    $kelas = serialize($_POST['kelas']);
	  $guru = $_POST['guru'];
	
   $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE  kode='$kode'"));
        if ($cek > 0) :
            echo "GAGAL";
        else :
       $exec = mysqli_query($koneksi, "UPDATE banksoal SET kode='$kode',nama='$nama',level='$level',status='$status',idguru='$guru',soal_agama='$agama' WHERE id_bank='$id'");
        echo "OK";     
     endif;
    }


if ($pg == 'tambah') {
    $pk = $_POST['pk'];
    $nama = $_POST['mapel'];
    $level = $_POST['level'];
    $status = $_POST['status'];
	$kode = str_replace(' ', '', $_POST['kode']);
	$model = $_POST['model'];
	if($model==2){
    $groupsoal = 'NON AKM';
	}else{
	$groupsoal = 'AKM';
	}
    $agama = $_POST['agama'];
    $paket = $_POST['paket'];
	$guru = $_POST['guru'];
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE  kode='$kode'"));
        if ($cek > 0) :
            echo "GAGAL";
        else :		
        $exec = mysqli_query($koneksi, "INSERT INTO banksoal (kode, nama,idguru,level,pk,model,status,soal_agama,groupsoal,paket) VALUES ('$kode','$nama','$guru','$level','$pk','$model','$status','$agama','$groupsoal','$paket')");
			if ($exec) {
                echo "OK";
            } 
       endif;
	
}

if ($pg == 'hapus') {
    $kode = $_POST['id'];
    $exec = mysqli_query($koneksi, "DELETE a.*, b.* FROM banksoal a JOIN soal b ON a.id_bank = b.id_bank WHERE a.id_bank=$kode");
    $exec = mysqli_query($koneksi, "DELETE FROM soal WHERE id_bank in=$kode");
    $exec = mysqli_query($koneksi, "DELETE FROM banksoal  WHERE id_bank=$kode");
	$exec = mysqli_query($koneksi, "DELETE FROM kunci_soal  WHERE id_bank=$kode");
    if ($exec) {
        echo 1;
    } else {
        echo 0;
    }
}
if ($pg == 'simpan_soal') {
  $nomor = $_POST['nomor'];
    $jenis = $_POST['jenis'];
    $id_bank = $_POST['mapel'];
	$skor = $_POST['skor'];	
    $isi_soal = addslashes($_POST['isi_soal']);
    $ektensi = ['jpg', 'png', 'mp3', 'jpeg'];

	  $pilA = addslashes($_POST['pilA']);
      $pilB = addslashes($_POST['pilB']);
      $pilC = addslashes($_POST['pilC']);
      $pilD = addslashes($_POST['pilD']);
	  $pilE = addslashes($_POST['pilE']);
      $bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id_bank'"));     
		
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
		
	
	if ($jenis == '1') {
   	
	$jawaban = $_POST['jawaban'];
	$koneksi->query(" INSERT INTO soal (id_bank,nomor,soal,max_skor,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE) VALUES ('$id_bank','$nomor','$isi_soal','$skor','1','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE')");
	$idsoal = $koneksi->insert_id;
	$idjawab = $idsoal.'.1';
	mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$id_bank','$idsoal','$idjawab','$skor')");
	}
if ($jenis == '3') {
	$jawabQ = $_POST['jawaban'];
	 $jml_data = count($_POST['jawaban']);
	 $tskor = $jml_data * $skor;
	 $jawaban=implode(', ',$_POST['jawaban']);
	 $koneksi->query(" INSERT INTO soal (id_bank,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE) VALUES ('$id_bank','$nomor','$isi_soal','3','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE')");
	 $idsoal = $koneksi->insert_id;	
	 mysqli_query($koneksi,"UPDATE soal SET max_skor='$tskor' WHERE id_soal='$idsoal'");
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
		$koneksi->query(" INSERT INTO soal (id_bank,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE) VALUES ('$id_bank','$nomor','$isi_soal','4','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE')");
	   	$idsoal = $koneksi->insert_id;	
		 mysqli_query($koneksi,"UPDATE soal SET max_skor='$tskor' WHERE id_soal='$idsoal'");
			for ($i=0; $i < $jml_data; $i++){
   $idjawab = $idsoal.'.'.($i+1);  
   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$i]','$id_bank','$idsoal','$idjawab','$skor')");
         
     }
		
	}
	if ($jenis == '5') {
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
		$koneksi->query(" INSERT INTO soal (id_bank,nomor,soal,max_skor,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,warna,perA,perB,perC,perD,perE,file,file1,fileA,fileB,fileC,fileD,fileE) VALUES ('$id_bank','$nomor','$isi_soal','$jml_data','5','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$warna','$perA','$perB','$perC','$perD','$perE','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE')");
	   	$idsoal = $koneksi->insert_id;	
		 mysqli_query($koneksi,"UPDATE soal SET max_skor='$tskor' WHERE id_soal='$idsoal'");
		for ($i=0; $i < $jml_data; $i++){
   $idjawab = $idsoal.'.'.($i+1);  
   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$i]','$id_bank','$idsoal','$idjawab','$skor')");
	$hapus = mysqli_query($koneksi,"DELETE FROM menjodohkan WHERE idbank='$id_bank' and nomor='$nomor'");	
		}  
	}
  if ($jenis == '2') {
	  $jenisjawab = $_POST['jenisjawab'];
	  $jawaban = strtolower($pilA);
	  $jumlahKarakter = strlen($jawaban);
	  
   $exec = mysqli_query($koneksi, "INSERT INTO soal (id_bank,nomor,soal,jawaban,max_skor,jenis,file,file1,jenisjawab,panjang) VALUES ('$id_bank','$nomor','$isi_soal','$jawaban','$skor','2','$urlx','$filex1','$jenisjawab','$jumlahKarakter')");
   $idsoal = $koneksi->insert_id;
   $idjawab = $idsoal.'.1';
	mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$id_bank','$idsoal','$idjawab','$skor')");
  }	
	
   
}

if ($pg == 'kosongsoal') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'soal', ['id_bank' => $id]);
	  $exec = delete($koneksi, 'kunci_soal', ['id_bank' => $id]);
	   $exec = delete($koneksi, 'file_pendukung', ['id_bank' => $id]);
    echo $exec;
}
if ($pg == 'hapussoal') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'soal', ['id_soal' => $id]);
	$exec = delete($koneksi, 'kunci_soal', ['id_soal' => $id]);
    echo $exec;
}
