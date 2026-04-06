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
		$hapus = mysqli_query($koneksi, "TRUNCATE siswa");
		$hapus = mysqli_query($koneksi, "TRUNCATE kelas");
        for ($i = 4; $i < count($sheetData); $i++) {
			
			$ids = $sheetData[$i]['0'];
            $nisn = $sheetData[$i]['1'];
			$nis = $sheetData[$i]['2'];
			$level = $sheetData[$i]['3'];
			if($level=="1" OR $level=="2"){
				$fase="A";
			}elseif($level=="3" OR $level=="4"){
				$fase="B";
			}elseif($level=="5" OR $level=="6"){
				$fase="C";
			}elseif($level=="7" OR $level=="8" OR $level=="9"){
				$fase="D";
			}elseif($level=="10"){
				$fase="E";
			}elseif($level=="11" OR $level=="12"){
				$fase="F";
			}
			$kelas = $sheetData[$i]['4'];
			$pk = $sheetData[$i]['5'];
			if($pk==''){$pk = 'semua';}else{$pk = $pk;}
			$nama = $sheetData[$i]['6'];
			$nama = addslashes($nama);
			$jk = $sheetData[$i]['7'];
			$agama = $sheetData[$i]['8'];
			$nowa = $sheetData[$i]['9'];
			$nowaQ = $sheetData[$i]['10'];
			$username = $sheetData[$i]['11'];
			$pass = $sheetData[$i]['12'];
			$server = $setting['kode_server'];
			
			
			 $kls = mysqli_query($koneksi, "SELECT kelas FROM kelas WHERE kelas='$kelas'");
            $cekkelas = mysqli_num_rows($kls);
            if ($cekkelas == 0) {
                $result = mysqli_query($koneksi, "INSERT INTO kelas (level,fase,kelas,jurusan) 
				VALUES ('$level','$fase','$kelas','$pk')");
            }
            $qus = mysqli_query($koneksi, "SELECT username FROM siswa WHERE username='$username'");
            $ceknis = mysqli_num_rows($qus);
            if ($ceknis == 0) {
                $result = mysqli_query($koneksi, "INSERT INTO siswa (nis,nisn,nama,fase,level,kelas,jurusan,jk,agama,nowa,nowa_ortu,username,password,server) 
				VALUES ('$nis','$nisn','$nama','$fase','$level','$kelas','$pk','$jk','$agama','$nowa','$nowaQ','$username','$pass','$server')");
            }
        }
        echo "1";
    } else {
        echo "0";
    }
}
