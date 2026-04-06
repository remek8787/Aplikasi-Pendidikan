<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
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

$kelas = $_GET['kls'];


$sheet->setCellValue('A1', "UPDATE SISWA KELAS ".$kelas); 
$sheet->mergeCells('A1:Q1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', $setting['sekolah']); 
$sheet->mergeCells('A2:Q2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(14); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 $sheet->setCellValue('A3', 'LENGKAPI DATA SISWA'); 
 $sheet->mergeCells('A3:Q3'); 
$sheet->getStyle('A3')->getFont()->setBold(true); 
$sheet->getStyle('A3')->getFont()->setSize(12); 
 $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
$sheet->setCellValue('A4', "NO");
$sheet->setCellValue('B4', "IDS"); 
$sheet->setCellValue('C4', "N I S"); 
$sheet->setCellValue('D4', "NO PESERTA"); 
$sheet->setCellValue('E4', "KELAS"); 
$sheet->setCellValue('F4', "NAMA LENGKAP");
$sheet->setCellValue('G4', "JK"); 
$sheet->setCellValue('H4', "TEMPAT LAHIR"); 
$sheet->setCellValue('I4', "TANGGAL LAHIR");
$sheet->setCellValue('J4', "ALAMAT");
$sheet->setCellValue('K4', "DESA");
$sheet->setCellValue('L4', "KECAMATAN");
$sheet->setCellValue('M4', "KABUPATEN");
$sheet->setCellValue('N4', "NAMA AYAH");
$sheet->setCellValue('O4', "NAMA IBU");
$sheet->setCellValue('P4', "PEKERJAAN AYAH");
$sheet->setCellValue('Q4', "PEKERJAAN IBU");

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
$sheet->getStyle('N4')->applyFromArray($style_col);
$sheet->getStyle('O4')->applyFromArray($style_col);
$sheet->getStyle('P4')->applyFromArray($style_col);
$sheet->getStyle('Q4')->applyFromArray($style_col);

$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'");
while($data = mysqli_fetch_array($sql)){ 

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $data['id_siswa']);
    $sheet->setCellValue('C' . $i, $data['nis']);
    $sheet->setCellValue('D' . $i, $data['nopes']);
    $sheet->setCellValue('E' . $i, $data['kelas']);
	$sheet->setCellValue('F' . $i, $data['nama']);
    $sheet->setCellValue('G' . $i, $data['jk']);
	$sheet->setCellValue('H' . $i, '');
	$sheet->setCellValue('I' . $i, '');
	$sheet->setCellValue('J' . $i, '');
	$sheet->setCellValue('K' . $i, '');
	$sheet->setCellValue('L' . $i, '');
	$sheet->setCellValue('M' . $i, '');
	$sheet->setCellValue('N' . $i, '');
	$sheet->setCellValue('O' . $i, '');
	$sheet->setCellValue('P' . $i, '');
	$sheet->setCellValue('Q' . $i, '');
	
    
   $sheet->getRowDimension($i)->setRowHeight(20); 

   $i++; $no++;
}


$sheet->getColumnDimension('A')->setAutoSize(true); 
$sheet->getColumnDimension('B')->setWidth(0); 
$sheet->getColumnDimension('C')->setWidth(0);
$sheet->getColumnDimension('D')->setWidth(0);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);
$sheet->getColumnDimension('L')->setAutoSize(true);
$sheet->getColumnDimension('M')->setAutoSize(true);
$sheet->getColumnDimension('N')->setAutoSize(true);
$sheet->getColumnDimension('O')->setAutoSize(true);
$sheet->getColumnDimension('P')->setAutoSize(true);
$sheet->getColumnDimension('Q')->setAutoSize(true);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("SISWA ".$kelas);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=UPDATE SISWA KELAS ".$kelas.".xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>