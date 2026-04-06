<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

       
   
	 $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG', 'pdf', 'docx'];
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
       'idpeg'     => $_POST['idg'],
        'tanggal'     => $tanggal,
        'level'   => 'pegawai',
		'ket'   => $_POST['surat'],
        'file'  => $file   
        ];
		 $exec = insert($koneksi, 'surat', $data);
	}
   }
   }

?>