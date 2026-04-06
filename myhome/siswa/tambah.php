<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
 
 if($_POST['blok']==1){$blok='1';}else{$blok='0';}

$ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != ''){
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
       $dest = '../../images/fotosiswa/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
       'nis'     => $_POST['nis'],
        'nopes'     => $_POST['nisn'],
        'nama'   => addslashes($_POST['nama']),
		'agama'   => $_POST['agama'],
        'level'  => $_POST['level'],
       'kelas'  => $_POST['kelas'],
	   'jk'  => $_POST['jk'],
	   'jurusan'  => $_POST['pk'],
	   'password'  => $_POST['password'],
	   'nowa'  => $_POST['nowa'],
	   'blok'  => $blok,
	   'foto'    => $file
	   
        ];
		 $exec = insert($koneksi, 'siswa', $datax);
	}
   }
   
   }else{
     $data = [
    'nis'     => $_POST['nis'],
    'nopes'     => $_POST['nisn'],
    'nama'   => addslashes($_POST['nama']),
	'agama'   => $_POST['agama'],
    'level'  => $_POST['level'],
    'kelas'  => $_POST['kelas'],
	'jk'  => $_POST['jk'],
	'jurusan'  => $_POST['pk'],
	'password'  => $_POST['password'],
	'nowa'  => $_POST['nowa'],
	'blok'  => $blok
        ];
    
    $exec = insert($koneksi, 'siswa', $data);
   
   }
?>