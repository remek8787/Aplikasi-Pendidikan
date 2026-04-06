<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$sql = mysqli_query($koneksi, "select * from statustrx");
	$data = mysqli_fetch_array($sql);
	$mode_perpus = $data['mode'];
if($mode_perpus==3){
	mysqli_query($koneksi, "TRUNCATE tmpbuku");
$kode = $_POST['kode'];
$query = mysqli_query($koneksi, "INSERT INTO tmpbuku(kode) VALUES ('$kode')");
}	
	
    $edis = mysqli_query($koneksi, "select * from tmpsis");
	$datamu = mysqli_fetch_array($edis);
	$kartu = $datamu['nokartu'];
	
if($kartu<>''):
	
	$reg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg WHERE nokartu='$kartu'"));
    $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$reg[idsiswa]'"));
	$idsis = $siswa['id_siswa'];
	$kelas = $siswa['kelas'];
	
	
	


if($mode_perpus==1){
	mysqli_query($koneksi, "TRUNCATE tmpbuku");
	$kode = $_POST['kode'];
	$query = mysqli_query($koneksi, "INSERT INTO tmpbuku(kode) VALUES ('$kode')");
	$buku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM buku WHERE barkode='$kode'"));
	$idbuku = $buku['id'];
	if($buku['barkode']==$kode){
	$simpan = mysqli_query($koneksi,"INSERT INTO transaksi(tanggal,idsiswa,kelas,idbuku,ket) VALUES('$tanggal','$idsis','$kelas','$idbuku','Pinjam')");
	}
}
if($mode_perpus==2){
	$kode = $_POST['kode'];
	mysqli_query($koneksi, "TRUNCATE tmpbuku");
	$kode = $_POST['kode'];
	$query = mysqli_query($koneksi, "INSERT INTO tmpbuku(kode) VALUES ('$kode')");
	$buku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM buku WHERE barkode='$kode'"));
	$idbuku = $buku['id'];
	if($buku['barkode']==$kode){
	$simpan = mysqli_query($koneksi,"UPDATE transaksi SET tgl_kembali='$tanggal',ket='Kembali' where idbuku='$idbuku' and idsiswa='$idsis' and ket='Pinjam'");
	}
	
}
endif;
	?>