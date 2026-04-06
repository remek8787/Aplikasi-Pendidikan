<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	 $data=[
    'nama_barang' => $_POST['barang'],
    'baik' => $_POST['baik'], 
	'jenis'=>'it',	
	'rusak' => $_POST['rusak'],   
	'tahun' => $_POST['tahun']  
	];
		$exec = insert($koneksi,'sapras_ruang',$data);
}

if ($pg == 'hapus') {
	 $id = $_POST['id'];
     $exec = mysqli_query($koneksi, "DELETE FROM aset WHERE id='$id'");
}

if ($pg == 'edit') {
	 $id = $_POST['id'];
    $data=[
    'nama_barang' => $_POST['barang'],
    'baik' => $_POST['baik'], 
	'jenis'=>'it',	
	'rusak' => $_POST['rusak'],   
	'tahun' => $_POST['tahun']  
	];
	$exec = update($koneksi,'sapras_ruang',$data,['id'=>$id]);
}
