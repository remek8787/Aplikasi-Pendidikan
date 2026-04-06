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
		
        for ($i = 4; $i < count($sheetData); $i++) {
			
			 $ids = $sheetData[$i]['0'];
            $nopes = $sheetData[$i]['1'];
			$nis = $sheetData[$i]['2'];
			$nisn = $sheetData[$i]['3'];
			$kelas = $sheetData[$i]['4'];
			$nama = $sheetData[$i]['5'];
			$nama = addslashes($nama);
			$jk = $sheetData[$i]['6'];
			$agama = $sheetData[$i]['7'];
			$tempat = $sheetData[$i]['8'];
			$tgll = $sheetData[$i]['9'];
			$nowa = $sheetData[$i]['10'];
			$alamat = $sheetData[$i]['11'];
			$desa = $sheetData[$i]['12'];
			$kec = $sheetData[$i]['13'];
			$kab = $sheetData[$i]['14'];
            $qus = mysqli_query($koneksi, "SELECT nis FROM siswa WHERE nis='$nis'");
            $ceknis = mysqli_num_rows($qus);
            if ($ceknis == 0) {
                $result = mysqli_query($koneksi, "INSERT INTO siswa (nis,nisn,nama,kelas,jk,agama,t_lahir,tgl_lahir,nopes,nowa,alamat,desa,kecamatan,kabupaten) 
				VALUES ('$nis','$nisn','$nama','$kelas','$jk','$agama','$tempat','$tgll','$nopes','$nowa','$alamat','$desa','$kec','$kab')");
            }
        }
        echo "1";
    } else {
        echo "0";
    }
}
