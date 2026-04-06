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
			$tempat = $sheetData[$i]['7'];
			$tgl = $sheetData[$i]['8'];
			$alamat = $sheetData[$i]['9'];
			$desa = $sheetData[$i]['10'];
			$kec = $sheetData[$i]['11'];
			$kab = $sheetData[$i]['12'];
			$ayah = $sheetData[$i]['13'];
			$ibu = $sheetData[$i]['14'];
			$pek = $sheetData[$i]['15'];
			$pekibu = $sheetData[$i]['16'];
			
          mysqli_query($koneksi, "UPDATE siswa SET alamat='$alamat',
				desa='$desa',kecamatan='$kec',kabupaten='$kab',ayah='$ayah',ibu='$ibu',
				pek_ayah='$pek',pek_ibu='$pekibu',t_lahir='$tempat',tgl_lahir='$tgl' WHERE id_siswa='$ids'");
         
        }
        echo "1";
    } else {
        echo "0";
    }
}
