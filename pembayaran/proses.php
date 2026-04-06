<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$kartu = $_POST['uid'];

$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$kartu'"));
if($jsiswa==0):
echo "GAGAL";
else:
	$datax = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nokartu='$kartu'"));
	$ids =$datax['id_siswa'];
	
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' ORDER BY id DESC LIMIT 1"));
	if($ids==$data['idsiswa']){
		 $sis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[idsiswa]'"));
  if(strlen($datax['nama']) > 20){
		$nama = substr($sis['nama'], 0, 20) . " ..";
	}else{
		$nama = $sis['nama'];
	}
		
	$bulan = date('m',strtotime($data['blth']));
	$tahun = date('Y',strtotime($data['blth']));	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);
	$kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$data[idbayar]'"));
    $Total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(bayar)AS jumlah,idsiswa,idbayar,blth from trx_bayar WHERE blth='$data[blth]' AND idsiswa='$data[idsiswa]' AND idbayar='$data[idbayar]'"));
	
  echo "      SMK SADAM CISURUPAN       \n";
  echo "  Jalan Serang RT. 006 RW. 005  \n";
  echo "================================\n";
  echo "     CEK PEMBAYARAN TERAKHIR   \n\n";  
  echo "Bulan  : ".$bulane['ket']." ".$tahun."\n";
  echo "Nama   : ".$nama."\n";
  echo "Untuk  : TRX ".$kode['kode']."\n";
  echo "Tgl Byr: ".date('d-m-Y',strtotime($data['tanggal']))."\n";
  echo "Besar  : RP. ".number_format($data['bayar'])."\n";
  echo "Byr Ke : ".$data['ke']."\n";
  echo "Reff   : ".$data['bukti']."\n";
  echo "================================\n";
  echo "Tot Masuk : RP. ".number_format($Total['jumlah'])."\n";
  echo "================================\n";
  echo "        TERIMA KASIH            ";
  echo " Cetak pada ".date('d-m-Y H:i:s')." ";
	}else{
  echo "GAGAL";
	}
endif;
?>