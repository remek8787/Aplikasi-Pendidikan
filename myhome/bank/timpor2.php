<?php
require "../../konek/koneksi.php";
require "../../vendor/autoload.php";
require("../../konek/function.php");

$file_mimes = array('application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
if (isset($_FILES['file']['name'])) {
    $ext = ['xls', 'xlsx'];
    $arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);
    if (in_array($extension, $ext)) {
        if ('xls' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
		
		

$idmapel=$_POST['idmapel'];
  
 $nomer = $_POST['nomer'];
if($nomer==''){
$nomer=0;
}	
  for ($i = 8; $i < count($sheetData); $i++) {
            $nomor = $sheetData[$i]['0'];
            $jenis = $sheetData[$i]['1'];
            $soal = $sheetData[$i]['2'];
            $soal = addslashes($soal);
			 $pilA = $sheetData[$i]['3'];
            $pilA = addslashes($pilA);
			 $pilB = $sheetData[$i]['4'];
            $pilB = addslashes($pilB);
			 $pilC = $sheetData[$i]['5'];
            $pilC = addslashes($pilC);
			 $pilD = $sheetData[$i]['6'];
            $pilD = addslashes($pilD);
			$pilE = $sheetData[$i]['7'];
            $pilE = addslashes($pilE);
			
			  $perA = $sheetData[$i]['8'];
            $perA = addslashes($perA);
			 $perB = $sheetData[$i]['9'];
            $perB = addslashes($perB);
			 $perC = $sheetData[$i]['10'];
            $perC = addslashes($perC);
			 $perD = $sheetData[$i]['11'];
            $perD = addslashes($perD);
			$perE = $sheetData[$i]['12'];
            $perE = addslashes($perE);
			
			 $jawab = $sheetData[$i]['13'];
			 $skor = $sheetData[$i]['14'];
              $sandik = $skor;
			   if ($jenis == '5') {	
				    $jawabanQQ=explode(', ',$jawab);
					 $jml_dataZ = count($jawabanQQ);
					 if($jml_dataZ==2){$warna="#00BCD4, #F44336";}
					  if($jml_dataZ==3){$warna="#00BCD4, #F44336, #4CAF50";}
					   if($jml_dataZ==4){$warna="#00BCD4, #F44336, #4CAF50, #FF9800";}
					    if($jml_dataZ==5){$warna="#00BCD4, #F44336, #4CAF50, #FF9800, #0277BD";}
				 }
			  
			  
	        $koneksi->query("INSERT INTO soal (id_bank,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,perA,perB,perC,perD,perE,jawaban,warna,max_skor)VALUES('$idmapel','$nomor','$soal','$jenis','$pilA','$pilB','$pilC','$pilD','$pilE','$perA','$perB','$perC','$perD','$perE','$jawab','$warna','$skor')");
		       $idsoal = $koneksi->insert_id;
		if ($jenis == '1') {	
				  $jawaban = $jawab;
				 $idjawab = $idsoal.'.1';
	              mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$idmapel','$idsoal','$idjawab','$sandik')");
				 }
			if ($jenis == '2') {	
				  $jawaban = $jawab;
				 $idjawab = $idsoal.'.1';	 
					mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawaban','$idmapel','$idsoal','$idjawab','$sandik')");
				  }
				 if ($jenis == '3') {	
				    $jawaban=explode(', ',$jawab);
					 $jml_data = count($jawaban);
					 $skormu = $sandik/$jml_data;
				  $jawabQ = $jawaban;
				   for ($a=0; $a < $jml_data; $a++){
				   $idjawab = $idsoal.'.'.($a+1);  
				   mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabQ[$a]','$idmapel','$idsoal','$idjawab','$skormu')");
				   }
					 }
				 if ($jenis == '4') {	
				    $jawaban=explode(', ',$jawab);
					 $jml_data = count($jawaban);
					 $skormu = $sandik/$jml_data;
				  $jawabB = $jawaban;
				   for ($b=0; $b < $jml_data; $b++){
				   $idjawab = $idsoal.'.'.($b+1);  
				  mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabB[$b]','$idmapel','$idsoal','$idjawab','$skormu')");
          
				   }
					 }
				 if ($jenis == '5') {	
				    $jawaban=explode(', ',$jawab);
					 $jml_data = count($jawaban);
					 $skormu = $sandik/$jml_data;
				  $jawabJ = $jawaban;
				   for ($c=0; $c < $jml_data; $c++){
				   $idjawab = $idsoal.'.'.($c+1);  
				 mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabJ[$c]','$idmapel','$idsoal','$idjawab','$skormu')");
						 
				   }
					 }
		}
	}
	
}
?>		
		
	
			