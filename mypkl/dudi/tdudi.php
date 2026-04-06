<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'pkl_dudi', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM pkl_dudi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE pkl_dudi SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE pkl_dudi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
   $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../images/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
     $data = [
	    'nama_dudi'     => $_POST['dudi'],
        'bidang'     => $_POST['bidang'],
        'alamat'   => $_POST['alamat'],
		'direksi'   => $_POST['direksi'],
		'logo'   => $file	
			];
			$exec = insert($koneksi, 'pkl_dudi', $data);
			} 
	}
  }else{
	  $data = [
	   'nama_dudi'     => $_POST['dudi'],
       'bidang'     => $_POST['bidang'],
       'alamat'   => $_POST['alamat'],
	   'direksi'   => $_POST['direksi']
			
			];
			$exec = insert($koneksi, 'pkl_dudi', $data);
			} 
			
}
if ($pg == 'edit') {
	$id = $_POST['id'];
    $data = [
	    'nama_dudi'     => $_POST['dudi'],
        'bidang'     => $_POST['bidang'],
        'alamat'   => $_POST['alamat'],
		'direksi'   => $_POST['direksi']
			];
   $exec = update($koneksi, 'pkl_dudi', $data,['id'=>$id]);
	
   $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../images/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'logo' => $file
		];
	$exec = update($koneksi, 'pkl_dudi', $datax, ['id' => $id]);
	}
   }
  }
}

?>