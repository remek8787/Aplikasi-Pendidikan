<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'users', ['id_user' => $idu]);
	if($exec){
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
	    'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
		'bank'   => $_POST['bank'],
		   'norek'   => $_POST['norek'],
        'level'  => 'staff',
		'jabatan'  => 'Staff',
		'foto'    => $file,
        'password'  => $_POST['password']
			];
			$exec = insert($koneksi, 'users', $data);
			echo "OK";                   		
	  }
        
	}
  }else{	
  $datax = [
         'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
		'bank'   => $_POST['bank'],
		   'norek'   => $_POST['norek'],
        'level'  => 'staff',
		'jabatan'  => 'Staff',
        'password'      => $_POST['password']

			];
			$exec = insert($koneksi, 'users', $datax);
			echo "OK";  
  }
}
}
if ($pg == 'edit') {
	$id_user = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
       'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
		'bank'   => $_POST['bank'],
		   'norek'   => $_POST['norek'],
        'level'  => 'staff',
		'jabatan'  => 'Staff',
        'password'  => $_POST['password']
        ];
    } else {
        $data = [
       'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
		'bank'   => $_POST['bank'],
		   'norek'   => $_POST['norek'],
		'jabatan'  => 'Staff',
        'level'  => 'staff'
      
        ];
    }
   
    $exec = update($koneksi, 'users', $data, ['id_user' => $id_user]);
    echo $exec;
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
		 $exec = update($koneksi, 'users', $datax, ['id_user' => $id_user]);
	}
   }
   }
}
?>