<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$kode = $_POST['kode'];

foreach ($_POST['id'] as $key=>$val) {
  $id = (int) $_POST['id'][$key];
  $isi = $_POST['isi'][$key];
  
  if($kode=='membaca'):
	$exec = mysqli_query($koneksi,"UPDATE sk_membaca SET isi='$isi' WHERE id='$id'");
   elseif($kode=='menimbang'):
	$exec = mysqli_query($koneksi,"UPDATE sk_menimbang SET isi='$isi' WHERE id='$id'");
   elseif($kode=='mengingat'):
	$exec = mysqli_query($koneksi,"UPDATE sk_mengingat SET isi='$isi' WHERE id='$id'");
  endif;
}