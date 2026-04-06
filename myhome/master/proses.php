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

$sheet->setCellValue('A1', "RINCIAN PESERTA ASESMEN"); 
$sheet->mergeCells('A1:F1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
$sheet->setCellValue('A3', "NO");
$sheet->setCellValue('B3', "NPSN"); 
$sheet->setCellValue('C3', "NAMA SEKOLAH"); 
$sheet->setCellValue('D3', "STATUS");
$sheet->setCellValue('E3', "KEPALA SEKOLAH");  
$sheet->setCellValue('F3', "JML SISWA");



$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);

$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);


$i=4; 
$no=1; 
$query = mysqli_query($koneksi, "SELECT * FROM sekolah"); 
while ($data = mysqli_fetch_assoc($query)){
$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE npsn='$data[npsn]'"));

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $data['npsn']);
    $sheet->setCellValue('C' . $i, $data['nama_sekolah']);
    $sheet->setCellValue('D' . $i, $data['status']);
    $sheet->setCellValue('E' . $i, $data['kepsek']);
    $sheet->setCellValue('F' . $i, $jsis);
	
	if($jsis==0): 
   $sheet->getStyle('A' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   $sheet->getStyle('B' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   $sheet->getStyle('C' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   $sheet->getStyle('D' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   $sheet->getStyle('E' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   $sheet->getStyle('F' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
   endif;
	if($jsis>=1 AND $jsis<= 20): 
   $sheet->getStyle('A' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   $sheet->getStyle('B' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   $sheet->getStyle('C' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   $sheet->getStyle('D' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   $sheet->getStyle('E' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   $sheet->getStyle('F' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
   endif;   
    $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
	 $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 
    
	
   $sheet->getRowDimension($i)->setRowHeight(20); 

   $i++; $no++;
}


$sheet->getColumnDimension('A')->setAutoSize(true); 
$sheet->getColumnDimension('B')->setWidth(0); 
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);


$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("BIODATA");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="RINCIAN PESERTA ASESMEN.xlsx"'); 
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>