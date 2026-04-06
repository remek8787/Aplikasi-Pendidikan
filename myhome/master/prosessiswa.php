<?php
require("../../config/koneksi.php");
require("../../config/function.php");
require "../../vendor/autoload.php";

session_start();
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
    'font' => ['bold' => true], 
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];


$style_row = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM sekolah  WHERE npsn='$_GET[n]'"));

$sheet->setCellValue('A1', "DATA SISWA "); 
$sheet->mergeCells('A1:H1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', $skl['nama_sekolah']); 
$sheet->mergeCells('A2:H2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(14); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 
 
$sheet->setCellValue('A4', "NO");
$sheet->setCellValue('B4', "NPSN"); 
$sheet->setCellValue('C4', "NIS"); 
$sheet->setCellValue('D4', "TINGKAT"); 
$sheet->setCellValue('E4', "ROMBEL"); 
$sheet->setCellValue('F4', "NAMA PESERTA");
$sheet->setCellValue('G4', "JK"); 
$sheet->setCellValue('H4', "AGAMA"); 
 $sheet->setCellValue('I4', "SERVER"); 

$sheet->getStyle('A4')->applyFromArray($style_col);
$sheet->getStyle('B4')->applyFromArray($style_col);
$sheet->getStyle('C4')->applyFromArray($style_col);
$sheet->getStyle('D4')->applyFromArray($style_col);
$sheet->getStyle('E4')->applyFromArray($style_col);
$sheet->getStyle('F4')->applyFromArray($style_col);
$sheet->getStyle('G4')->applyFromArray($style_col);
$sheet->getStyle('H4')->applyFromArray($style_col);
$sheet->getStyle('I4')->applyFromArray($style_col);


$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$npsn = $_GET['n'];
$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE npsn='$_GET[n]'");
while($data = mysqli_fetch_array($sql)){ 

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $data['npsn']);
    $sheet->setCellValue('C' . $i, $data['nis']);
    $sheet->setCellValue('D' . $i, $data['level']);
    $sheet->setCellValue('E' . $i, $data['kelas']);
	$sheet->setCellValue('F' . $i, $data['nama']);
    $sheet->setCellValue('G' . $i, $data['jk']);
	$sheet->setCellValue('H' . $i, $data['agama']);
	$sheet->setCellValue('I' . $i, '');
   

    $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
	 $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 
     $sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	
	  $sheet->getStyle('G' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	   $sheet->getStyle('H' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   $sheet->getRowDimension($i)->setRowHeight(20); 

   $i++; $no++;
}


$sheet->getColumnDimension('A')->setAutoSize(true); 
$sheet->getColumnDimension('B')->setAutoSize(true); 
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);


$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("DATA SISWA");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=DATA SISWA ".$skl['nama_sekolah'].".xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>