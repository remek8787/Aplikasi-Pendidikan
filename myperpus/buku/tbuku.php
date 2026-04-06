<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'digital', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM digital ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE digital SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE digital  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
        $jam = date('H:i:s');
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskrip'];
        $guru = $_POST['guru'];
	
  $koneksi->query(" INSERT INTO digital (judul,deskripsi,tanggal,jam,guru) VALUES ('$judul','$deskripsi','$tanggal','$jam','$guru')");
  $id = $koneksi->insert_id;	

$ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['ikon']['name'] != '') {
   $ikon = $_FILES['ikon']['name'];
   $temp = $_FILES['ikon']['tmp_name'];
   $ext = explode('.', $ikon);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../buku/images/';
      $path = $dest . $ikon;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'ikon' => $ikon
		];
	$exec = update($koneksi, 'digital', $datax, ['id' => $id]);
	}
   }
  }
$ektensi = ['PDF', 'pdf'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../buku/pdf/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
		$datax = [
		'file' => $file
		];
	$exec = update($koneksi, 'digital', $datax, ['id' => $id]);
	}
   }
  }
}
if ($pg == 'edit') {
	$id = $_POST['id'];
    
        $data = [
         'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskrip']
        ];
   
    $exec = update($koneksi, 'digital', $data, ['id' => $id]);
  
}

?>