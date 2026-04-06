<?php
require "../../konek/koneksi.php";
require "../../vendor/autoload.php";
require("../../konek/function.php");
require_once("../../PHPExcel/PHPExcel.php");

		
			
$nama_file_baru = 'data.xlsx';
	
				if(is_file('../../temp/'.$nama_file_baru)) 
					unlink('../../temp/'.$nama_file_baru); 

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
				$tmp_file = $_FILES['file']['tmp_name'];
				if($ext == "xlsx"){
					move_uploaded_file($tmp_file, '../../temp/'.$nama_file_baru);
     
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('../../temp/'.$nama_file_baru); 
	$sheet = $loadexcel->getActiveSheet()->toArray();
	
		$nama_file_baru = 'data.xlsx';
        $sukses = $gagal = 0;
       
        for ($a = 8; $a < 14; $a++) {
            $kode = $sheet['3'][$a];
			
        for ($i = 4; $i < count($sheet); $i++) {
			
			 
			 $idm = $sheet[$i]['1'];
			$idj = $sheet[$i]['2'];
				$ids = $sheet[$i]['3'];
				$kelas = $sheet[$i]['5'];
				
                $kode = $kode;
                $nilai = $sheet[$i][$a];
			
           $result = mysqli_query($koneksi,"INSERT INTO nilai_skl(idsiswa,mapel,kelas,ki,nilai,kode,ket) VALUES('".$ids."','".$idm."','".$kelas."','".$idj."','".$nilai."','".$kode."','SMT')");		
			
			}
		}

		

}
	
			
			