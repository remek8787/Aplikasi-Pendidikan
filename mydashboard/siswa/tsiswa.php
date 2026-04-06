<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'edit') {
	$ids = $_POST['ids'];
	$nama = addslashes($_POST['nama']);
        $data = [
        'nama'     => $nama,
        't_lahir'   => $_POST['tlahir'],
		'tgl_lahir'   => $_POST['tgl'],
        'alamat'   => $_POST['alamat'],
		'desa'   => $_POST['desa'],
        'kecamatan'   => $_POST['kec'],
	    'kabupaten'   => $_POST['kab'],
		'nowa'   => $_POST['nowa'],
		'ayah'   => $_POST['ayah'],
		'ibu'   => $_POST['ibu'],
		'pek_ayah'   => $_POST['pek_ayah'],
		'pek_ibu'   => $_POST['pek_ibu'],
		'nowa_ortu'   => $_POST['nowa_ortu'],
		'password'   => $_POST['password']
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

?>