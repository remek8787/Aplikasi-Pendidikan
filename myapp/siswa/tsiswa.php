<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
	$query = "SELECT * FROM siswa WHERE id_siswa='$idu'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../images/fotosiswa/".$data['foto'])) 
			unlink("../../images/fotosiswa/".$data['foto']); 
		
    $exec = delete($koneksi, 'siswa', ['id_siswa' => $idu]);
	if($exec){
	$query = "SELECT * FROM siswa ORDER BY id_siswa";
    $hasil = mysqli_query($query);
 $no = 1;
while ($data  = mysqli_fetch_array($hasil)){
	$id = $data['id_siswa'];
	$query2 = "UPDATE siswa SET id_siswa = $no WHERE id_siswa = '$id'";
    mysqli_query($koneksi,$query2);
    $no++;   
	}
$query = "ALTER TABLE siswa  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}

if ($pg == 'edit') {
	$ids = $_POST['ids'];
        $data = [
        'nis'     => $_POST['nis'],
        'nisn'   => $_POST['nisn'],
		'nama'   => $_POST['nama'],
        'jk'   => $_POST['jk'],
		'agama'   => $_POST['agama'],
	    'kelas'   => $_POST['kelas'],
		'password'   => $_POST['password'],
		'nowa'   => $_POST['nowa']
        ];
    $exec = update($koneksi, 'siswa', $data, ['id_siswa' => $ids]);
	$ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
	if ($_FILES['file']['name'] != '') {
		$query = "SELECT * FROM siswa WHERE id_siswa='$ids'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../images/fotosiswa/".$data['foto'])) 
		unlink("../../images/fotosiswa/".$data['foto']); 
	
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
		'foto' => $file
		];
	$exec = update($koneksi, 'siswa', $datax, ['id_siswa' => $ids]);
	}
   }
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
		$dest = '../../images/fotosiswa/';
		$path = $dest . $file;
		$upload = move_uploaded_file($temp, $path);
	if ($upload) {
		 $data = [
        'nis'     => $_POST['nis'],
        'nisn'   => $_POST['nisn'],
		'nama'   => $_POST['nama'],
        'jk'   => $_POST['jk'],
		'agama'   => $_POST['agama'],
        'level'   => $_POST['level'],
	    'kelas'   => $_POST['kelas'],
		'jurusan'   => $_POST['pk'],
		'nowa'   => $_POST['nowa'],
		'username'   => $_POST['username'],
		'password'   => $_POST['password'],
		'foto' =>$file
        ];
	$exec = insert($koneksi, 'siswa', $data);
	}
   }
  }else{
	 $data = [
        'nis'     => $_POST['nis'],
        'nisn'   => $_POST['nisn'],
		'nama'   => $_POST['nama'],
        'jk'   => $_POST['jk'],
		'agama'   => $_POST['agama'],
        'level'   => $_POST['level'],
	    'kelas'   => $_POST['kelas'],
		'jurusan'   => $_POST['pk'],
		'username'   => $_POST['username'],
		'password'   => $_POST['password'],
		'nowa'   => $_POST['nowa']		
        ];
	$exec = insert($koneksi, 'siswa', $data);  
  }
}

?>