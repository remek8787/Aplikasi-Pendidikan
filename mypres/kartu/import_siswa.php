<?php
require "../../konek/koneksi.php";
require "../../vendor/autoload.php";
require("../../konek/function.php");
session_start();
if (!isset($_SESSION['id_user'])) {
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
		
        for ($i = 4; $i < count($sheetData); $i++) {
			
			$nis = $sheetData[$i]['1'];         
			$tgl = $sheetData[$i]['6'];
			$tempat = $sheetData[$i]['5'];
			$alamat = $sheetData[$i]['7'];
          mysqli_query($koneksi, "UPDATE siswa SET tgl_lahir='$tgl',
				t_lahir='$tempat',
				alamat='$alamat'
				WHERE nis='$nis'");
             
        }
        echo "1";
    } else {
        echo "0";
    }
}