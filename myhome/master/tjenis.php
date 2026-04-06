<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';



if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'jenis', ['id_jenis' => $id]);
}
if ($pg == 'tambah') {
    $data = [
	'id_jenis' => $_POST['kode'],
	'nama' => $_POST['nama'],
	'status' => $_POST['status']
	];
	 $datax=[
	'nama_ujian' => $_POST['nama']
	];
   $simpan = insert($koneksi,'jenis',$data);
   if($_POST['status']=='aktif'){
	 $exec = update($koneksi,'pengaturan',$datax,['id_aplikasi' =>1]);
   }
}


if ($pg == 'edit') {
	$id = $_POST['id'];
	 $data = [
	'id_jenis' => $_POST['kode'],
	'nama' => $_POST['nama'],
	'status' => $_POST['status']
	];
	$datax=[
	'nama_ujian' => $_POST['nama']
	];
   $simpan = update($koneksi,'jenis',$data,['id_jenis' =>$id]);
    if($_POST['status']=='aktif'){
   $exec = update($koneksi,'pengaturan',$datax,['id_aplikasi' =>1]);
  }
}