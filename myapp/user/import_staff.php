<?php
require "../../konek/koneksi.php";
require "../../vendor/autoload.php";
require("../../konek/function.php");
session_start();
if (!isset($_SESSION['id_pegawai'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

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
		 $exec = mysqli_query($koneksi, "delete from pegawai WHERE level='staff'");
        for ($i = 3; $i < count($sheetData); $i++) {
            $id_pegawai = $sheetData[$i]['0'];
            $nip = $sheetData[$i]['1'];
			$nama = $sheetData[$i]['2'];
			$nama = addslashes($nama);
			$username = $sheetData[$i]['3'];
			$password = $sheetData[$i]['4'];
			$nowa = $sheetData[$i]['5'];
			
           $qus = mysqli_query($koneksi, "SELECT username FROM pegawai WHERE username='$username'");
            $cekuser = mysqli_num_rows($qus);
            if ($cekuser == 0) {
			
                $exec = mysqli_query($koneksi, "INSERT INTO pegawai(nip,nama,level,jabatan,username,password,nowa) 
				VALUES ('$nip','$nama','staff','Staff','$username','$password','$nowa')");
             
				
            }
        }
        echo "1";
    } else {
        echo "0";
    }
}
