<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require "../../vendor/autoload.php";
require("../../konek/crud.php");
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

$idbank = $_GET['idb'];
$sesi = $_GET['sesi'];
$kelas = $_GET['kls'];

$bank = fetch($koneksi,'banksoal',['id_bank'=>$idbank]);
$mapel = fetch($koneksi,'mapel',['kode'=>$bank['nama']]);

$sheet->setCellValue('A1', "NILAI ASESMEN"); 
$sheet->mergeCells('A1:G1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
$sheet->setCellValue('A2', "SEKOLAH / MADRASAH");
$sheet->setCellValue('A3', "MATA PELAJARAN");
$sheet->setCellValue('D2', $setting['sekolah']);
$sheet->setCellValue('D3', strtoupper($mapel['nama_mapel'])." (".$bank['kode'].")");

$sheet->mergeCells('A4:G4');  
 
$sheet->setCellValue('A5', "NO"); 
$sheet->setCellValue('B5', "NIS"); 
$sheet->setCellValue('C5', "NO PESERTA"); 
$sheet->setCellValue('D5', "NAMA SISWA");
$sheet->setCellValue('E5', "KELAS");  
$sheet->setCellValue('F5', "SESI");
$sheet->setCellValue('G5', "NILAI");


$sheet->getStyle('A5')->applyFromArray($style_col);
$sheet->getStyle('B5')->applyFromArray($style_col);
$sheet->getStyle('C5')->applyFromArray($style_col);
$sheet->getStyle('D5')->applyFromArray($style_col);
$sheet->getStyle('E5')->applyFromArray($style_col);
$sheet->getStyle('F5')->applyFromArray($style_col);
$sheet->getStyle('G5')->applyFromArray($style_col);

$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);


$i=6; 
$no=1; 
 if($bank['soal_agama']==''):
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$bank[level]' and sesi='$sesi' and kelas='$kelas' ORDER BY id_siswa ASC"); 
else:
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE level='$bank[level]' and sesi='$sesi' and agama='$bank[soal_agama]' and kelas='$kelas' ORDER BY id_siswa ASC"); 
endif;
while ($siswa = mysqli_fetch_assoc($query)){
	$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai  WHERE id_siswa='$siswa[id_siswa]' and id_bank='$idbank'"));
    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $siswa['nis']);
    $sheet->setCellValue('C' . $i, $siswa['nopes']);
    $sheet->setCellValue('D' . $i, $siswa['nama']);
    $sheet->setCellValue('E' . $i, $siswa['kelas']);
	$sheet->setCellValue('F' . $i, $siswa['sesi']);
    $sheet->setCellValue('G' . $i, $nilai['katrol']);
	
    $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 
    $sheet->getStyle('E' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('F' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle('G' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	
	$sheet->getStyle('A' . $i)->applyFromArray($style_row);
	$sheet->getStyle('B' . $i)->applyFromArray($style_row);
	$sheet->getStyle('C' . $i)->applyFromArray($style_row);
	$sheet->getStyle('D' . $i)->applyFromArray($style_row);
	$sheet->getStyle('E' . $i)->applyFromArray($style_row);
	$sheet->getStyle('F' . $i)->applyFromArray($style_row);
	$sheet->getStyle('G' . $i)->applyFromArray($style_row);
    $sheet->getRowDimension($i)->setRowHeight(20); 
 
   $i++; $no++;

}
 

$sheet->getColumnDimension('A')->setWidth(5); 
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("DATA NILAI");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=NILAI ".$bank['kode']."-".$bank['level'].".xlsx"); 
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>