<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

$idb = $_POST['idbank'];
$nomor = $_POST['nomor'];

if ($pg == 'JDH1') {
	$warna = $_POST['warna'];	
	$kode = '5.1.'.$idb;
$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor'  AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

}else{
		mysqli_query($koneksi,"INSERT INTO menjodohkan(idbank,kode,nomor,warna) VALUES('$idb','$kode','$nomor','$warna')");
 }
}


if ($pg == 'JDH2') {
	$warna = $_POST['warna'];	
	$kode = '5.2.'.$idb;
$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor'  AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

}else{
	mysqli_query($koneksi,"INSERT INTO menjodohkan(idbank,kode,nomor,warna) VALUES('$idb','$kode','$nomor','$warna')");
 }
}
if ($pg == 'JDH3') {
	$warna = $_POST['warna'];
	$kode = '5.3.'.$idb;
$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor' AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

}else{
	mysqli_query($koneksi,"INSERT INTO menjodohkan(idbank,kode,nomor,warna) VALUES('$idb','$kode','$nomor','$warna')");
 }
}

if ($pg == 'JDH4') {
	$warna = $_POST['warna'];
	$kode = '5.4.'.$idb;
$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor' AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

}else{
	mysqli_query($koneksi,"INSERT INTO menjodohkan(idbank,kode,nomor,warna) VALUES('$idb','$kode','$nomor','$warna')");
 }
}

if ($pg == 'JDH5') {
	$warna = $_POST['warna'];
	$kode = '5.5.'.$idb;
$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor' AND kode='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){

}else{
	mysqli_query($koneksi,"INSERT INTO menjodohkan(idbank,kode,nomor,warna) VALUES('$idb','$kode','$nomor','$warna')");
 }
}


if ($pg == 'RESET') {
mysqli_query($koneksi,"DELETE FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor'");
}	

if ($pg == 'UPJDH1') {
	$jawab = $_POST['jawab'];
	$cekdata = "SELECT * FROM menjodohkan WHERE idbank='$idb' AND nomor='$nomor'  AND jawab is NULL";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	mysqli_query($koneksi,"UPDATE menjodohkan SET jawab='$jawab' WHERE idbank='$idb' AND nomor='$nomor'  AND jawab is NULL");

}else{
	
}
}
	