<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$id_mapel = $_POST['mapel'];
$guru = $_POST['guru'];
$tugas = addslashes($_POST['isitugas']);
$judul = addslashes($_POST['judul']);
$tgl_mulai = $_POST['tgl_mulai'];
$tgl_selesai = $_POST['tgl_selesai'];
$kelas = serialize($_POST['kelas']);

$ektensi = ['jpg', 'png','jpeg','JPEG','JPG','PNG','docx', 'pdf', 'xlsx', 'pptx', 'ppt', 'doc','mp4','3gp'];
if ($_FILES['file']['name'] <> '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../tugas/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
      if ($upload) {
         $data =[
            'mapel' => $id_mapel,
            'kelas' => $kelas,
            'guru' => $guru,
            'judul' => $judul,
            'tugas' => $tugas,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
             'file' => $file
			
         ];
         insert($koneksi, 'tugas', $data);
         echo "OK";
      } else {
         echo "gagal";
      }
   }
} else {
   $datax = [
      'mapel' => $id_mapel,
      'kelas' => $kelas,
      'guru' => $guru,
      'judul' => $judul,
      'tugas' => $tugas,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai
	 
   ];
   insert($koneksi, 'tugas', $datax);
   echo "OK";
}
