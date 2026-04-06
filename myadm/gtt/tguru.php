<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'sk_peg', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM sk_peg ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE sk_peg SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE sk_peg  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	$jum = mysqli_num_rows(mysqli_query($koneksi, "SELECT idsk FROM sk_peg WHERE idsk='1'"));
	$nomor = $jum + 1;
     $data = [
	    'idpeg'     => $_POST['idpeg'],
        'jk'     => $_POST['jk'],
        'ttl'   => $_POST['ttl'],
		'pdk'   => $_POST['pdk'],
		'idsk'   => $_POST['idsk'],
        'nosk'  => $_POST['nosk'],
		'tahun'  => $_POST['tahun'],
		'tglsk'  => $_POST['tglsk'],
        'tmt'  => $_POST['tmt'],
		 'akhir'  => $_POST['tahun'],
		  'nomor'  => $nomor
			];
		$exec = insert($koneksi, 'sk_peg', $data);	
}
if ($pg == 'edit') {
	$id = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
       'nip'     => $_POST['nip'],
        'nama'   => $_POST['nama'],
		'walas'   => $_POST['walas'],
		'nowa'   => $_POST['nowa'],
        'level'  => 'guru',
		'jabatan'  => 'Guru',
        'password'  => $_POST['password']
        ];
    } else {
        $data = [
         'nip'     => $_POST['nip'],
		 'walas'   => $_POST['walas'],
         'nama'   => $_POST['nama'],
		 'nowa'   => $_POST['nowa'],
		 'jabatan'  => 'Guru',
         'level'  => 'guru'
      
        ];
    }
   
    $exec = update($koneksi, 'sk_peg', $data, ['id' => $id]);
    
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
	$exec = update($koneksi, 'sk_peg', $datax, ['id' => $id]);
	}
   }
  }
}
if ($pg == 'profil') {
	$id = $_POST['iduser'];
    if ($_POST['password'] <> "") {
        $data = [
        'nip'     => $_POST['nip'],
        'nama'   => $_POST['nama'],
		'jenis'   => $_POST['jenis'],
		'nowa'   => $_POST['nowa'],
		'walas'   => $_POST['walas'],
        'password'  => $_POST['password']
        ];
    } else {
        $data = [
       'nip'     => $_POST['nip'],
        'nama'   => $_POST['nama'],
		 'nowa'   => $_POST['nowa'],
		'walas'   => $_POST['walas']
        ];
    }
   
    $exec = update($koneksi, 'sk_peg', $data, ['id' => $id]);
  
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
		 $exec = update($koneksi, 'sk_peg', $datax, ['id' => $id]);
	}
   }
  }
    if ($_FILES['ttd']['name'] <> '') {
            $logo = $_FILES['ttd']['name'];
            $temp = $_FILES['ttd']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
            $dest = 'ttd' . rand(0,100). '.' . $ext;
            $upload = move_uploaded_file($temp, '../../images/' . $dest);
			if ($upload) {
                    $exec = update($koneksi, 'sk_peg', ['ttd' => $dest], ['id' => $id]);
                }
            }
        }
}
?>