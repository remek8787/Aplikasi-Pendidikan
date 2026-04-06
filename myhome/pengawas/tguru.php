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
        'nama'   => $_POST['nama'],
		'tingkat'   => $_POST['tingkat'],
		'kelas'   => $_POST['kelas'],
		'ruang'   => $_POST['ruang'],
		'sesi'   => $_POST['sesi'],
		'nowa'   => $_POST['nowa'],
		'level' => 'awas',
		'foto'    => $file,
		'username'     => $_POST['username'],
        'password'  => $_POST['password']
			];
			$exec = insert($koneksi, 'users', $data);
			echo "OK";                   		
	  } 
	}
  }else{	
  $datax = [
        'nama'   => $_POST['nama'],
		'tingkat'   => $_POST['tingkat'],
		'kelas'   => $_POST['kelas'],
		'ruang'   => $_POST['ruang'],
		'sesi'   => $_POST['sesi'],
		'nowa'   => $_POST['nowa'],
		'level' => 'awas',
		'username'     => $_POST['username'],
        'password'  => $_POST['password']
		];
		$exec = insert($koneksi, 'users', $datax);
		echo "OK";  
  }
}
}

if ($pg == 'kelas') {
    $level = $_POST['tingkat'];
    $sql = mysqli_query($koneksi, "SELECT level,kelas FROM siswa WHERE level='" . $level . "' GROUP BY kelas");
    echo "<option value=''>Pilih Kelas</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[kelas]'>$data[kelas]</option>";
    }
}
if ($pg == 'ruang') {
    $kelas = $_POST['kelas'];
    $sql = mysqli_query($koneksi, "SELECT kelas,ruang FROM siswa WHERE kelas='" . $kelas . "' GROUP BY kelas");
    echo "<option value=''>Pilih Ruang</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[ruang]'>$data[ruang]</option>";
    }
}
if ($pg == 'sesi') {
    $kelas = $_POST['kelas'];
	$ruang = $_POST['ruang'];
    $sql = mysqli_query($koneksi, "SELECT sesi,kelas,ruang FROM siswa WHERE kelas='$kelas'AND ruang='$ruang' GROUP BY sesi");
    echo "<option value=''>Pilih Sesi</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[sesi]'>$data[sesi]</option>";
    }
}
?>