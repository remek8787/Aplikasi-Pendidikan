<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $result = delete($koneksi, 'users', ['id_user' => $id]);
	if($result){
		$query = "SELECT * FROM users ORDER BY id_user";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id_user'];
	 $query2 = "UPDATE users SET id_user = $no WHERE id_user = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE users  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $cekuser = rowcount($koneksi, 'users', ['username' => $_POST['username']]);
    if ($cekuser > 0) {
        echo "gagal";
    } else {
   $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
        $dest = '../../images/fotoguru/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
     $data = [
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
        'level'  => 'admin',
		'foto'    => $file,
        'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT)
			];
			$result = insert($koneksi, 'users', $data);
			echo "OK";                   		
	  }
        
	}
  }else{	
  $datax = [
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
        'level'         => 'admin',
        'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT)

			];
			$result = insert($koneksi, 'users', $datax);
			echo "OK";  
  }
}
}
if ($pg == 'edit') {
	$id_user = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
            'nama'   => $_POST['nama'],
            'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];
    } else {
        $data = [
           
            'nama'   => $_POST['nama'],
			
        ];
    }
   
$result = update($koneksi, 'users', $data, ['id_user' => $id_user]);
	$ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
       $dest = '../../images/fotoguru/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'foto' => $file
		];
		 $result = update($koneksi, 'users', $datax, ['id_user' => $id_user]);
	}
   }
   }
}
?>