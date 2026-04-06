<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
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

$sheet->setCellValue('A1', "UPDATE PESERTA UJIAN "); 
$sheet->mergeCells('A1:M1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', $setting['sekolah']); 
$sheet->mergeCells('A2:M2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(14); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 
 
$sheet->setCellValue('A4', "NO");
$sheet->setCellValue('B4', "ID"); 
$sheet->setCellValue('C4', "NIS"); 
$sheet->setCellValue('D4', "TINGKAT"); 
$sheet->setCellValue('E4', "ROMBEL"); 
$sheet->setCellValue('F4', "NAMA PESERTA");
$sheet->setCellValue('G4', "JK"); 
$sheet->setCellValue('H4', "AGAMA"); 
$sheet->setCellValue('I4', "USERNAME"); 
$sheet->setCellValue('J4', "PASSWORD");
$sheet->setCellValue('K4', "NO PESERTA");  
$sheet->setCellValue('L4', "SESI"); 
$sheet->setCellValue('M4', "RUANG");

$sheet->getStyle('A4')->applyFromArray($style_col);
$sheet->getStyle('B4')->applyFromArray($style_col);
$sheet->getStyle('C4')->applyFromArray($style_col);
$sheet->getStyle('D4')->applyFromArray($style_col);
$sheet->getStyle('E4')->applyFromArray($style_col);
$sheet->getStyle('F4')->applyFromArray($style_col);
$sheet->getStyle('G4')->applyFromArray($style_col);
$sheet->getStyle('H4')->applyFromArray($style_col);
$sheet->getStyle('I4')->applyFromArray($style_col);
$sheet->getStyle('J4')->applyFromArray($style_col);
$sheet->getStyle('K4')->applyFromArray($style_col);
$sheet->getStyle('L4')->applyFromArray($style_col);
$sheet->getStyle('M4')->applyFromArray($style_col);
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$npsn = $_GET['n'];
$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa");
while($data = mysqli_fetch_array($sql)){ 

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $data['id_siswa']);
    $sheet->setCellValue('C' . $i, $data['nis']);
    $sheet->setCellValue('D' . $i, $data['level']);
    $sheet->setCellValue('E' . $i, $data['kelas']);
	$sheet->setCellValue('F' . $i, $data['nama']);
    $sheet->setCellValue('G' . $i, $data['jk']);
	$sheet->setCellValue('H' . $i, $data['agama']);
	$sheet->setCellValue('I' . $i, $data['username']);
	$sheet->setCellValue('J' . $i, $data['password']);
	$sheet->setCellValue('K' . $i, $data['nopes']);
    $sheet->setCellValue('L' . $i, $data['sesi']);
   $sheet->setCellValue('L' . $i, $data['ruang']);
   
    $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
	 $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 
     $sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	
	 $sheet->getStyle('G' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	 $sheet->getStyle('H' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	  $sheet->getStyle('K' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	   $sheet->getStyle('L' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
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
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);
$sheet->getColumnDimension('L')->setAutoSize(true);
$sheet->getColumnDimension('M')->setAutoSize(true);
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("DATA SISWA");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=UPDATE PESERTA UJIAN.xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>