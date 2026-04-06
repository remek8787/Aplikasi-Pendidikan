<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$blth = date('mY');
$bulanmu = date('YmdHis');
$waktu = date('H:i:s');
mysqli_query($koneksi, "TRUNCATE tmpbayar");
$exec = mysqli_query($koneksi,"INSERT INTO tmpbayar(nokartu) VALUES('$kartu')");

$kartu = $_POST['nokartu'];
$idb = $_POST['idb'];
$bukti = "TRX-".$id."-".$bulanmu;
$query = mysqli_query($koneksi, "select * from m_bayar where id='$idb'");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
if ($cek ==0) {
echo "KODE TIDAK ADA";
	mysqli_close($koneksi);
}else{
$besar = $data['angsuran'];	
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$kartu'"));
$ids = $siswa['id_siswa'];	
$saldo = $siswa['saldo'];
$saldomu = $saldo-$besar;
$jumbayar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idb'"));	
if($jumbayar == $data['jumlah']){
		echo "LUNAS";
		}else{
	if($saldo < $besar){
		echo "GAGAL";
}else{	

$q = mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' AND blth='$blth' and idbayar='$idb'");
$ck = mysqli_num_rows($q);
if ($ck == 0) {
	
	$trx = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idb'"));
	$ke = $trx + 1;
	$simpan = mysqli_query($koneksi,"INSERT INTO trx_bayar(tanggal,blth,idsiswa,kelas,idbayar,bayar,ke,bukti) VALUES('$tanggal','$blth','$ids','$siswa[kelas]','$idb','$besar','$ke','$bukti')");
	if($simpan){
	     $simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit) VALUES('$tanggal','$waktu','$ids','0','$besar')");	
         mysqli_query($koneksi,"update siswa set saldo='$saldomu' where nokartu='$kartu'");
		}
		
		echo $data['kode']." Bayar ke ".$ke;
		}

echo "Sudah dibayar";

   }
	
}
}
	?>