<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tanggal = date('Y-m-d');
$jamabsen = date('H:i:s');
$bulan = date('m');
$tahun    = date('Y');

$kode = $_POST['uid'];

$query = mysqli_query($koneksi, "select * from siswa where nis='$kode'");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];
$nowa = $data['nowa'];
if ($cek ==0) {
	echo "0";
}else{
	
	$cari_absen = mysqli_query($koneksi, "select * from absensi where nokartu='$kode' and tanggal='$tanggal'");
		$jumlah_absen = mysqli_num_rows($cari_absen);
		if($jumlah_absen==0):
		mysqli_query($koneksi, "insert into absensi(nokartu,tanggal,idsiswa, masuk, ket, bulan,tahun,level)values('$kode','$tanggal','$data[id_siswa]', '$jamabsen','H', '$bulan','$tahun','siswa')");		
		echo "1";
		else :
		echo "2";
		endif;

}
?>