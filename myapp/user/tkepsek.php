<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'pegawai', ['id_pegawai' => $id]);
	if($exec){
		$query = "SELECT * FROM pegawai ORDER BY id_pegawai";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id_pegawai'];
	 $query2 = "UPDATE pegawai SET id_pegawai = $no WHERE id_pegawai = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE pegawai  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $cekuser = rowcount($koneksi, 'pegawai', ['username' => $_POST['username']]);
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
        'level'  => 'kepala',
		'jabatan'  => 'Kepsek',
		'foto'    => $file,
        'password'  => $_POST['password']
			];
			$exec = insert($koneksi, 'pegawai', $data);
			echo "OK";                   		
	  }
        
	}
  }else{	
  $datax = [
         'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
        'level'  => 'kepala',
		'jabatan'  => 'Kepsek',
        'password'      => $_POST['password']

			];
			$exec = insert($koneksi, 'pegawai', $datax);
			echo "OK";  
  }
}
}
if ($pg == 'edit') {
	$id_pegawai = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
       'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
        'level'  => 'kepala',
        'password'  => $_POST['password']
        ];
    } else {
        $data = [
       'nip'     => $_POST['nip'],
        'username'     => $_POST['username'],
        'nama'   => $_POST['nama'],
		'nowa'   => $_POST['nowa'],
        'level'  => 'kepala'
      
        ];
    }
   
    $exec = update($koneksi, 'pegawai', $data, ['id_pegawai' => $id_pegawai]);
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
		 $exec = update($koneksi, 'pegawai', $datax, ['id_pegawai' => $id_pegawai]);
	}
   }
   }
}
?>