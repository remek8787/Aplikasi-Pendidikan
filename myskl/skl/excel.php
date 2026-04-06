<?php ob_start();
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
require "../../vendor/autoload.php";

 
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

$ids = $_GET['ids'];
$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $ids]);

$query = mysqli_query($koneksi, "SELECT * FROM mapel"); 
while ($datax = mysqli_fetch_array($query)) :
$dataz = mysqli_fetch_array(mysqli_query($koneksi, "SELECT AVG(nilai) as rata,mapel,idsiswa,kelas FROM nilai WHERE mapel='$datax[id]' and idsiswa='$ids'"));
$nilrata = round($dataz['rata']);
$qus = mysqli_query($koneksi, "SELECT * FROM nilai_skl WHERE idsiswa='$ids' and mapel='$datax[id]'");
            $cek = mysqli_num_rows($qus);
            if ($cek == 0 and $dataz['mapel']==$datax['id']) {
           $result = mysqli_query($koneksi,"INSERT INTO nilai_skl(idsiswa,mapel,kelas,nilai) VALUES('$ids','$dataz[mapel]','$dataz[kelas]','$nilrata')");		
			}elseif($cek<>0 and $dataz['mapel']==$datax['id']) {
				$result = mysqli_query($koneksi,"UPDATE nilai_skl SET nilai='$nilrata' WHERE idsiswa='$ids' and mapel='$dataz[mapel]'");
			}
endwhile;
$sheet->setCellValue('A1', "NILAI IJAZAH"); 
$sheet->mergeCells('A1:C1'); 
$sheet->getStyle('A1')->getFont()->setBold(true); 
$sheet->getStyle('A1')->getFont()->setSize(15); 
 $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 
 $sheet->setCellValue('A2', strtoupper($siswa['nama'])); 
$sheet->mergeCells('A2:C2'); 
$sheet->getStyle('A2')->getFont()->setBold(true); 
$sheet->getStyle('A2')->getFont()->setSize(12); 
 $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 $sheet->setCellValue('A3', 'HASIL OLAH NILAI SEMESTER 1 - 6'); 
 $sheet->mergeCells('A3:C3'); 
$sheet->getStyle('A3')->getFont()->setBold(true); 
$sheet->getStyle('A3')->getFont()->setSize(12); 
 $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
 

$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

$i=5; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM nilai_skl where idsiswa='$ids'");
while($data = mysqli_fetch_array($sql)){ 
$mapel = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $mapel['nama_mapel']);
    $sheet->setCellValue('C' . $i, $data['nilai']);
  
	
     $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
   $sheet->getRowDimension($i)->setRowHeight(20); 

   $i++; $no++;
}


$sheet->getColumnDimension('A')->setAutoSize(true); 
$sheet->getColumnDimension('B')->setWidth(50); 
$sheet->getColumnDimension('C')->setAutoSize(true);


$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->setTitle("SISWA ".$kelas);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=NILAI IJAZAH ".$siswa['nama'].".xlsx");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>