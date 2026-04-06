<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
 $ektensi = ['JPG', 'png', 'JPEG', 'jpg', 'jpeg', 'PNG'];
   if ($_FILES['file']['name'] != '') {
   $file = $_FILES['file']['name'];
   $temp = $_FILES['file']['tmp_name'];
   $ext = explode('.', $file);
   $ext = end($ext);
   if (in_array($ext, $ektensi)) {
      $dest = '../../images/';
      $path = $dest . $file;
      $upload = move_uploaded_file($temp, $path);
	if ($upload) {
    $data = [
		'header'=>$file,
		'dibuka' => $_POST['buka'],
		'ditutup' => $_POST['tutup'],
        'nama_surat' => $_POST['nama'],
		'tingkat' => $_POST['level'],
        'no_surat' => $_POST['no_surat'],
        'tgl_surat' => $_POST['tgl_surat'],
        'pembuka' => $_POST['pembuka'],
        'isi_surat' => $_POST['isi'],
        'penutup' => $_POST['penutup']   
			];
    $exec = update($koneksi, 'skl', $data);
	                  		
	  } 
	}
  }else{	
   
   $data = [	
		'tingkat' => $_POST['level'],
		'dibuka' => $_POST['buka'],
		'ditutup' => $_POST['tutup'],
        'nama_surat' => $_POST['nama'],
        'no_surat' => $_POST['no_surat'],
        'tgl_surat' => $_POST['tgl_surat'],
        'pembuka' => $_POST['pembuka'],
        'isi_surat' => $_POST['isi'],
        'penutup' => $_POST['penutup']   
			];
    
  $exec = update($koneksi, 'skl', $data);
  
  }
