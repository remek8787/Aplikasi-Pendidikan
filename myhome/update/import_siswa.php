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
		
        for ($i = 4; $i < count($sheetData); $i++) {
			
			
            $ids = $sheetData[$i]['1'];
			$nopes = $sheetData[$i]['10'];
			$sesi = $sheetData[$i]['11'];
			$ruang = $sheetData[$i]['12'];
			
         
    $result = mysqli_query($koneksi, "UPDATE siswa SET nopes='$nopes',sesi='$sesi',ruang='$ruang' where id_siswa='$ids'");
            
        }
        echo "1";
    } else {
        echo "0";
    }
}
