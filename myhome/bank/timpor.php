<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
require("../../assets/excel_reader2.php");
require_once '../../PHPExcel/PHPExcel/Reader/Excel5.php';
$idmapel=$_POST['idmapel'];
  
 $nomer = $_POST['nomer'];
if($nomer==''){
$nomer=0;
}	
 
if (isset($_FILES['file']['name'])) {
    
        $file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $ext = explode('.', $file);
        $ext = end($ext);
		
        if ($ext <> 'xls') {
            echo "harap pilih file excel .xls";
        } else {
            $data = new Spreadsheet_Excel_Reader($temp);
            $hasildata = $data->rowcount($sheet_index = 0);
            $sukses = $gagal = 0;
         

            for ($i = 4; $i <= $hasildata; $i++) :
                $no = $data->val($i, 1);
				
                $soal = addslashes($data->val($i, 2));
                $gambar = addslashes($data->val($i, 3));
                $num = addslashes($data->val($i, 4));
                $pil = addslashes($data->val($i, 5));
                $opsi = addslashes($data->val($i, 6));
                $per = addslashes($data->val($i, 7));
				$jenis = addslashes($data->val($i, 8));
                $jawab = addslashes($data->val($i, 9));
               $sandik = $data->val($i, 10);
                $nomor = $nomer+$no; 
				 if ($jenis == '5') {	
				    $jawabanQQ=explode(', ',$jawab);
					 $jml_dataZ = count($jawabanQQ);
					 if($jml_dataZ==2){$warna="#00BCD4, #F44336";}
					  if($jml_dataZ==3){$warna="#00BCD4, #F44336, #4CAF50";}
					   if($jml_dataZ==4){$warna="#00BCD4, #F44336, #4CAF50, #FF9800";}
					    if($jml_dataZ==5){$warna="#00BCD4, #F44336, #4CAF50, #FF9800, #0277BD";}
				 }
			 if ($soal <> '') {
                $koneksi->query("INSERT INTO soal (id_bank,nomor,soal,jenis,jawaban,max_skor,warna) VALUES ('$idmapel','$no','$soal','$jenis','$jawab','$sandik','$warna')");
			       $idsoal = $koneksi->insert_id;
				 
			} 
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
					 if($jml_data==2){$warna="#00BCD4,#F44336";}
					  if($jml_data==3){$warna="#00BCD4,#F44336,#4CAF50";}
					   if($jml_data==4){$warna="#00BCD4,#F44336,#4CAF50,#FF9800";}
					    if($jml_data==4){$warna="#00BCD4,#F44336,#4CAF50,#FF9800,#0277BD";}
					 $skormu = $sandik/$jml_data;
				  $jawabJ = $jawaban;
				   for ($c=0; $c < $jml_data; $c++){
				   $idjawab = $idsoal.'.'.($c+1);  
				 mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabJ[$c]','$idmapel','$idsoal','$idjawab','$skormu')");
						 
				   }
					 }
			  if ($gambar <> '') {
                    $exec = mysqli_query($koneksi, "INSERT INTO temp_pil (idbank,nomor) VALUES ('$idmapel','$no')");
			 } 
			 if ($pil == 'A'):
				  $exec = mysqli_query($koneksi, "UPDATE soal SET pilA='$opsi',perA='$per' WHERE id_bank='$idmapel' AND nomor='$num'");
				
				elseif ($pil == 'B'):
				 $exec = mysqli_query($koneksi, "UPDATE soal SET pilB='$opsi',perB='$per' WHERE id_bank='$idmapel' AND nomor='$num'");
				
                elseif ($pil == 'C'):
				 $exec = mysqli_query($koneksi, "UPDATE soal SET pilC='$opsi',perC='$per' WHERE id_bank='$idmapel' AND nomor='$num'");
				
               elseif ($pil == 'D'):
				 $exec = mysqli_query($koneksi, "UPDATE soal SET pilD='$opsi',perD='$per' WHERE id_bank='$idmapel' AND nomor='$num'");
				
                 elseif ($pil == 'E'):
				 $exec = mysqli_query($koneksi, "UPDATE soal SET pilE='$opsi',perE='$per' WHERE id_bank='$idmapel' AND nomor='$num'");
			
			endif; 
			
            endfor;
		}
		

  $objReader = new PHPExcel_Reader_Excel5($temp);
  $dataQ = $objReader->load($_FILES['file']['tmp_name']);
  $objData = $dataQ->getActiveSheet();
  $dataArray = $objData->toArray();
    for ($a=1; $a < $dataArray ; $a++) {
		 $objData = $dataQ->getActiveSheet();
		 
        foreach ($objData->getDrawingCollection() as $gbr) {
			   
          $string = $gbr->getCoordinates();
          $coord = PHPExcel_Cell::coordinateFromString($string);
		if ($gbr instanceof PHPExcel_Worksheet_MemoryDrawing) {
          $image = $gbr->getImageResource();
          $img = $gbr->getIndexedFilename();
		  $ext = explode('.', $img);
          $ext = end($ext);
		  $gb = rand(1, 10000) . '.' . $ext;
          imagejpeg($image, '../../files/'. $gb);
	
		
		}
		
       $exec = mysqli_query($koneksi, "INSERT INTO temp_file (id_bank,nama_file) VALUES ('$idmapel','$gb')");
	   $exec = mysqli_query($koneksi, "INSERT INTO file_pendukung (id_bank,nama_file) VALUES ('$idmapel','$gb')");
	
					 
		}
	 break;
	 
	}
		
			
		}

	
?>		   
<?php	
   
	$queryxs = mysqli_query($koneksi, "select * from temp_pil JOIN temp_file ON temp_file.id_file=temp_pil.id 
	WHERE idbank='$idmapel'");
     while ($nom = mysqli_fetch_array($queryxs)):
     $nomer = $nom['nomor'] ;
	 
	
	 $exec = mysqli_query($koneksi, "INSERT INTO temp_soal (id_bank,nomor,idfile,file) VALUES ('$nom[idbank]','$nomer','$nom[id]','$nom[nama_file]')");	
	 
	 endwhile;
?>

<?php

	 $query = mysqli_query($koneksi, "select * from temp_soal WHERE id_bank='$idmapel'");
         while ($filex = mysqli_fetch_array($query)){
	    
	 $exec = mysqli_query($koneksi, "UPDATE soal SET file='$filex[file]' WHERE id_bank='$filex[id_bank]' AND nomor='$filex[nomor]'");
	
	if($exec){
	mysqli_query($koneksi, "truncate temp_file");
    mysqli_query($koneksi, "truncate temp_pil");
	mysqli_query($koneksi, "truncate temp_soal");
	}
		 }	
?>		
		
	
			