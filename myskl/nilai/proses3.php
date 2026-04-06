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
$mapel = $_GET['m'];
$jurusan = $_GET['j'];
$map = fetch($koneksi,'mapel',['id'=>$mapel]);
$mpl = $map['kode'];


$sheet->setCellValue('A1', "UPLOAD DATA NILAI PENGETAHUAN SEMESTER 1 - 6 "); 
$sheet->mergeCells('A1:N1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', $setting['sekolah']); 
$sheet->mergeCells('A2:N2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(14); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 $sheet->setCellValue('A3', strtoupper($map['nama_mapel'])); 
 $sheet->mergeCells('A3:N3'); 
$sheet->getStyle('A3')->getFont()->setBold(true); 
$sheet->getStyle('A3')->getFont()->setSize(12); 
 $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
$sheet->setCellValue('A4', "NO");
$sheet->setCellValue('B4', "IDM"); 
$sheet->setCellValue('C4', "IDJ"); 
$sheet->setCellValue('D4', "IDS"); 
$sheet->setCellValue('E4', "NIS"); 
$sheet->setCellValue('F4', "KELAS");
$sheet->setCellValue('G4', "NAMA SISWA"); 
$sheet->setCellValue('H4', "JK"); 
$sheet->setCellValue('I4', "SMT-1"); 
$sheet->setCellValue('J4', "SMT-2"); 
$sheet->setCellValue('K4', "SMT-3"); 
$sheet->setCellValue('L4', "SMT-4");
$sheet->setCellValue('M4', "SMT-5");  
$sheet->setCellValue('N4', "SMT-6"); 


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
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$npsn = $_GET['n'];
$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas' and jurusan='$jurusan'");
while($data = mysqli_fetch_array($sql)){ 

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $mapel);
    $sheet->setCellValue('C' . $i, 'KI3');
    $sheet->setCellValue('D' . $i, $data['id_siswa']);
    $sheet->setCellValue('E' . $i, $data['nis']);
	$sheet->setCellValue('F' . $i, $data['kelas']);
    $sheet->setCellValue('G' . $i, $data['nama']);
	$sheet->setCellValue('H' . $i, $data['jk']);
	$sheet->setCellValue('I' . $i, '');
	$sheet->setCellValue('J' . $i, '');
    $sheet->setCellValue('K' . $i, '');
	$sheet->setCellValue('L' . $i, '');
    $sheet->setCellValue('M' . $i, '');
	 $sheet->setCellValue('N' . $i, '');
     $sheet->getStyle('E' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('H' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('I' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('J' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('K' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('L' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('M' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('N' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("NILAI ".$mpl);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=NILAI PENGETAHUAN SEMESTER 1-6 ".$mpl."-".$kelas.".xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>