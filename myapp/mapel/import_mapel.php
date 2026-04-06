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
	    $exec = mysqli_query($koneksi, "TRUNCATE mapel");
	    for ($i = 4; $i < count($sheetData); $i++) {
            
            $kode = $sheetData[$i]['1'];
            $nama = $sheetData[$i]['2'];
            $nama = addslashes($nama);
			
	        $exec = mysqli_query($koneksi, "INSERT INTO mapel (kode,nama_mapel)VALUES('$kode','$nama')");
		}
	} else {
        echo "0";
    }
	
}
?>