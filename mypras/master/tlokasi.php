<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambahumum') {
	 $data=[
    'ruang' => $_POST['ruang'],
	'jenis'=>'umum',
    'jumlah' => $_POST['jml'],   
	'kelengkapan' => $_POST['kelengkapan'],   
	'keadaan' => $_POST['keadaan']  
	];
		$exec = insert($koneksi,'sapras_ruang',$data);
}
if ($pg == 'tambah_lab') {
	 $data=[
    'ruang' => $_POST['ruang'],
    'jumlah' => $_POST['jml'], 
	'jenis'=>'umum',	
	'ket' => 'lab',
	'kelengkapan' => $_POST['kelengkapan'],   
	'keadaan' => $_POST['keadaan']  
	];
		$exec = insert($koneksi,'sapras_ruang',$data);
}
if ($pg == 'hapus') {
	 $id = $_POST['id']; 
     $exec = mysqli_query($koneksi, "DELETE FROM sapras_ruang WHERE id='$id'");
}

if ($pg == 'editumum') {
	 $id = $_POST['id'];
	 
	 $data=[
    'ruang' => $_POST['ruang'],
    'jumlah' => $_POST['jml'],   
	'kelengkapan' => $_POST['kelengkapan'],   
	'keadaan' => $_POST['keadaan']  
	];
		$exec = update($koneksi,'sapras_ruang',$data,['id'=>$id]);

}
if ($pg == 'edit_penunjang') {
	 $id = $_POST['id'];
	 
	 $data=[
    'ruang' => $_POST['ruang'],
    'jumlah' => $_POST['jml'], 
    'luas' => $_POST['luas'],	
	'kelengkapan' => $_POST['kelengkapan'],   
	'keadaan' => $_POST['keadaan']  
	];
		$exec = update($koneksi,'sapras_ruang',$data,['id'=>$id]);

}
if ($pg == 'tambah_penunjang') {
	 
	 $data=[
	'jenis'=>'penunjang',
    'ruang' => $_POST['ruang'],
    'jumlah' => $_POST['jml'], 
    'luas' => $_POST['luas'],	
	'kelengkapan' => $_POST['kelengkapan'],   
	'keadaan' => $_POST['keadaan']  
	];
		$exec = insert($koneksi,'sapras_ruang',$data);

}