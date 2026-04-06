<?php
require "../../../konek/koneksi.php";
require "../../../vendor/autoload.php";
require "../../../konek/function.php";
session_start();
 
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
$idb = $_GET['id'];
$bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT kode FROM banksoal WHERE id_bank='$idb'"));
$fexcel = $idb . "-" . $bank['kode'];
if (!file_exists('../../pengaturan/backup')) {
    mkdir('../../pengaturan/backup', 0777, true);
}

$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Edi Sukarna')
->setLastModifiedBy('Edi Sukarna')
->setTitle('Office 2007 XLSX')
->setSubject('Office 2007 XLSX')
->setDescription('Test document for Office 2007 XLSX.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

$spreadsheet->getActiveSheet()->getStyle('A1:X1')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

    $spreadsheet->getActiveSheet()->getStyle('A1:X1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF');


$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', "NO")
->setCellValue('B1', "ID BANK")
->setCellValue('C1', "NO SOAL")
->setCellValue('D1', "SOAL") 
->setCellValue('E1', "JENIS")
->setCellValue('F1', "PILIHAN A")
->setCellValue('G1', "PILIHAN B")
->setCellValue('H1', "PILIHAN C")
->setCellValue('I1', "PILIHAN D")
->setCellValue('J1', "PILIHAN E")
->setCellValue('K1', "PERNYATAAN A")
->setCellValue('L1', "PERNYATAAN B")
->setCellValue('M1', "PERNYATAAN C")
->setCellValue('N1', "PERNYATAAN D")
->setCellValue('O1', "PERNYATAAN E")
->setCellValue('P1', "JAWABAN")
->setCellValue('Q1', "FILE")
->setCellValue('R1', "FILE 1")
->setCellValue('S1', "FILE A")
->setCellValue('T1', "FILE B")
->setCellValue('U1', "FILE C")
->setCellValue('V1', "FILE D")
->setCellValue('W1', "FILE E")
->setCellValue('X1', "SKOR")
; 

$i=2; 
$no=1; 

$sql = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idb'");

while($row = mysqli_fetch_array($sql)){ 
$spreadsheet->setActiveSheetIndex(0)
	->setCellValue('A'.$i, $no)
	->setCellValue('B'.$i, $row['id_bank'])
	->setCellValue('C'.$i, $row['nomor'])
	->setCellValue('D'.$i, $row['soal'])
	->setCellValue('E'.$i, $row['jenis'])
	->setCellValue('F'.$i, $row['pilA'])
	->setCellValue('G'.$i, $row['pilB'])
	->setCellValue('H'.$i, $row['pilC'])
	->setCellValue('I'.$i, $row['pilD'])
	->setCellValue('J'.$i, $row['pilE'])
	->setCellValue('K'.$i, $row['perA'])
	->setCellValue('L'.$i, $row['perB'])
	->setCellValue('M'.$i, $row['perC'])
	->setCellValue('N'.$i, $row['perD'])
	->setCellValue('O'.$i, $row['perE'])
	->setCellValue('P'.$i, $row['jawaban'])
	->setCellValue('Q'.$i, $row['file'])
	->setCellValue('R'.$i, $row['file1'])
	->setCellValue('S'.$i, $row['fileA'])
	->setCellValue('T'.$i, $row['fileB'])
	->setCellValue('U'.$i, $row['fileC'])
	->setCellValue('V'.$i, $row['fileD'])
	->setCellValue('W'.$i, $row['fileE'])
	->setCellValue('X'.$i, $row['max_skor'])
	;
	$i++; $no++;
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(8); 
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(70); 
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(8); 
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40); 
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40); 
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(6);
$spreadsheet->getActiveSheet()->setTitle('Data Soal');

$spreadsheet->setActiveSheetIndex(0);


$mapel = mysqli_query($koneksi, "SELECT file, file1, fileA, fileB, fileC, fileD, fileE FROM soal WHERE id_bank='$idb'");
while ($mapelb = mysqli_fetch_array($mapel)) :
    if ($mapelb['file'] <> "") {
        $file = $mapelb['file'];
        $path = '../../../files/' . $mapelb['file'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['file1'] <> "") {
        $file = $mapelb['file1'];
        $path = '../../../files/' . $mapelb['file1'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileA'] <> "") {
        $file = $mapelb['fileA'];
        $path = '../../../files/' . $mapelb['fileA'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileB'] <> "") {
        $file = $mapelb['fileB'];
        $path = '../../../files/' . $mapelb['fileB'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileC'] <> "") {
        $file = $mapelb['fileC'];
        $path = '../../../files/' . $mapelb['fileC'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileD'] <> "") {
        $file = $mapelb['fileD'];
        $path = '../../../files/' . $mapelb['fileD'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
    if ($mapelb['fileE'] <> "") {
        $file = $mapelb['fileE'];
        $path = '../../../files/' . $mapelb['fileE'];
        if (file_exists($path)) {
            copy($path, $file);
            $array[] =  $file;
        }
    }
endwhile;

if (isset($array)) :
    $backup_file = '../../pengaturan/backup/' . $idb . "-" . $bank['kode'] . '.zip';
    if (file_exists($backup_file)) {
        unlink($backup_file);
    }
    $jumlah_array = count($array);
    $zip = new ZipArchive;
    if ($zip->open($backup_file, ZipArchive::CREATE) === TRUE) {
        for ($i = 0; $i < $jumlah_array; $i++) :
            $zip->addFile($array[$i]);
        endfor;
        $zip->close();
    }
    for ($i = 0; $i < $jumlah_array; $i++) :
        unlink($array[$i]);
    endfor;
endif;

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header("Content-Disposition: attachment; filename=$fexcel.xlsx");
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');


header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: cache, must-revalidate'); 
header('Pragma: public');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>
