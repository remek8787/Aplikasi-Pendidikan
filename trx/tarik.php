<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tgl =  date('Y-m-d');
$waktu = date('H:i:s');
$kartu = $_POST['uid'];
$besar = $_POST['besar'];
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$kartu'"));
$ids = $siswa['id_siswa'];
$saldo = $siswa['saldo'];
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$kartu'"));
if($jsiswa==0):
echo "GAGAL";
else:
if($saldo < $besar){
	echo "KURANG";	
	}else{
	$saldomu = $saldo-$besar;
	 mysqli_query($koneksi,"update siswa set saldo='$saldo' where nokartu='$kartu'");
	$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit,ket) VALUES('$tanggal','$waktu','$ids','0','$besar','Tarik Tunai')");	

 mysqli_query($koneksi,"update siswa set saldo='$saldomu' where nokartu='$kartu'");
  if(strlen($siswa['nama']) > 20){
		$nama = substr($siswa['nama'], 0, 20) . " ..";
	}else{
		$nama = $siswa['nama'];
	}
  	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);

 echo "      SMK SADAM CISURUPAN       \n";
  echo "  Jalan Serang RT. 006 RW. 005  \n";
  echo "================================\n";
  echo "  STRUK BUKTI PENARIKAN SALDO   \n\n";  
  echo "Bulan  : ".$bulane['ket']." ".$tahun."\n";
  echo "Nama   : ".$nama."\n";
  echo "Tgl Trx: ".date('d-m-Y',strtotime($tanggal))."\n";
  echo "Besar  : RP. ".number_format($besar)."\n";
  echo "Saldo  : RP. ".number_format($saldomu)."\n";
  echo "Reff   : ".$data['bukti']."\n";
  echo "================================\n";
  echo "        TERIMA KASIH            ";
  echo " Cetak pada ".date('d-m-Y H:i:s')." ";
  
}
endif;
mysqli_close($koneksi);
?>