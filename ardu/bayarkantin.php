<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$tgl =  date('Y-m-d');
$waktu = date('H:i:s');
$kartu = $_GET['nokartu'];
$datareg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg  WHERE nokartu='$kartu'"));
if($datareg['level']=='siswa'):
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE nokartu='$datareg[nokartu]'"));
$ids = $siswa['id_siswa'];
$saldo = $siswa['saldo'];
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where nokartu='$datareg[nokartu]'"));
if($jsiswa==0):
echo "TIDAK TERDAFTAR";
else:
$jumtrx = mysqli_num_rows(mysqli_query($koneksi, "SELECT idsiswa,status FROM transaksi_kantin where idsiswa='$ids' AND status='1'"));
  if($jumtrx==0){
	  echo "TIDAK ADA TRX";
  }else{
	$trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_harga) AS total,idsiswa,status FROM transaksi_kantin  WHERE idsiswa='$ids' AND status='1'"));
    if($saldo > $trx['total']){
	$saldoakhir = $saldo - $trx['total'];
	$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit) VALUES('$tgl','$waktu','$ids','0','$trx[total]')");
	$simpan = mysqli_query($koneksi,"UPDATE siswa SET saldo='$saldoakhir' WHERE id_siswa='$ids'");
	
		if($simpan){ 
		mysqli_query($koneksi,"UPDATE transaksi_kantin SET status='2',ket='0' WHERE idsiswa='$ids' AND status='1' OR status='3'");
	echo "Rp. ".number_format($trx['total']);
	}
	}else{
	echo "GAGAL";
	}
  }
endif;
endif;



if($datareg['level']=='pegawai'):
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE nokartu='$datareg[nokartu]'"));
$idpeg = $peg['id_user'];
$saldo = $peg['saldo'];
$jpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users where nokartu='$datareg[nokartu]'"));
if($jpeg==0):
echo "TIDAK TERDAFTAR";
else:
$jumtrx = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,status FROM transaksi_kantin where idpeg='$idpeg' AND status='1'"));
  if($jumtrx==0){
	  echo "TIDAK ADA TRX";
  }else{
	$trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_harga) AS total,idpeg,status FROM transaksi_kantin  WHERE idpeg='$idpeg' AND status='1'"));
    if($saldo > $trx['total']){
	$saldoakhir = $saldo - $trx['total'];
	$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idpeg,debet,kredit) VALUES('$tgl','$waktu','$idpeg','0','$trx[total]')");
	$simpan = mysqli_query($koneksi,"UPDATE users SET saldo='$saldoakhir' WHERE id_user='$idpeg'");
	
		if($simpan){ 
		mysqli_query($koneksi,"UPDATE transaksi_kantin SET status='2',ket='0' WHERE idpeg='$idpeg' AND status='1' OR status='3'");
	echo "Rp. ".number_format($trx['total']);
	}
	}else{
	echo "GAGAL";
	}
  }
  endif;
  endif;
mysqli_close($koneksi);
?>