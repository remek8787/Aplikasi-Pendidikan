<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'input') {
	 
   $ektensi = ['JPG', 'png', 'JPEG','pdf','PDF','doc','xlsx', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
       $dest = '../../arsip/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'idlemari' => $_POST['idl'],
		'nama_arsip' => $_POST['nama'],
		'tanggal' => $tanggal,
		'file' => $file,
		'nomor'=> $_POST['nomor'],
		'inputer' => $_POST['inputer']
		];
		 $exec = insert($koneksi, 'arsip', $datax);
	}
   }
   }
  
}

if ($pg == 'hapus') {
	 $id = $_POST['id'];
	 $query = "SELECT * FROM arsip WHERE id='".$id."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../arsip/".$data['file'])) 
			unlink("../../arsip/".$data['file']); 
	 
     $exec = mysqli_query($koneksi, "DELETE FROM arsip WHERE id='$id'");
}

if ($pg == 'edit') {
	 $id = $_POST['id'];
   
	  $ektensi = ['JPG', 'png', 'JPEG','pdf','PDF','doc','xlsx', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
        $dest = '../../arsip/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$query = "SELECT * FROM arsip WHERE id='".$id."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../arsip/".$data['file'])) 
			unlink("../../arsip/".$data['file']); 
		
		
		$datax = [
		'idlemari' => $_POST['idl'],
		'nama_arsip' => $_POST['nama'],
		'tanggal' => $tanggal,
		'file' => $file
		];
		 $exec = update($koneksi, 'arsip', $datax,['id'=>$id]);
		 	}
		}
   }else{
	   $datax = [
		'idlemari' => $_POST['idl'],
		'nama_arsip' => $_POST['nama'],
		'tanggal' => $tanggal
		
		];
		 $exec = update($koneksi, 'arsip', $datax,['id'=>$id]);
   }
   
}