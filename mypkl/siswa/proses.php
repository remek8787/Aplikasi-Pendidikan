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

$kelas = $_GET['k'];
$id = $_GET['id'];
$d = fetch($koneksi,'pkl_mnilai',['id'=>$id]);
if($d['kode']=='A'){$ket='SIKAP';}
if($d['kode']=='B'){$ket='PENGETAHUAN';}
if($d['kode']=='C'){$ket='KETERAMPILAN';}

$sheet->setCellValue('A1', "ASPEK ".$ket); 
$sheet->mergeCells('A1:E1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', $d['aspek']); 
$sheet->mergeCells('A2:E2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(12); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
$sheet->setCellValue('A3', 'Rentang Nilai dari 0 - 100'); 
$sheet->mergeCells('A3:E3'); 
$sheet->getStyle('A3')->getFont()->setBold(true); 
$sheet->getStyle('A3')->getFont()->setSize(12); 
 $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
  
$sheet->setCellValue('A4', "NO");
$sheet->setCellValue('B4', "IDS"); 
$sheet->setCellValue('C4', "NAMA SISWA"); 
$sheet->setCellValue('D4', "KELAS"); 
$sheet->setCellValue('E4', "NILAI"); 

$sheet->getStyle('A4')->applyFromArray($style_col);
$sheet->getStyle('B4')->applyFromArray($style_col);
$sheet->getStyle('C4')->applyFromArray($style_col);
$sheet->getStyle('D4')->applyFromArray($style_col);
$sheet->getStyle('E4')->applyFromArray($style_col);
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'");
while($data = mysqli_fetch_array($sql)){ 

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $data['id_siswa']);
    $sheet->setCellValue('C' . $i, $data['nama']);
    $sheet->setCellValue('D' . $i, $data['kelas']);
    $sheet->setCellValue('E' . $i, '');
	
     $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	
   $sheet->getRowDimension($i)->setRowHeight(20); 

   $i++; $no++;
}


$sheet->getColumnDimension('A')->setAutoSize(true); 
$sheet->getColumnDimension('B')->setWidth(0); 
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("NILAI ".$mpl);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=NILAI SEMESTER 1-6 ".$mpl."-".$kelas.".xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>