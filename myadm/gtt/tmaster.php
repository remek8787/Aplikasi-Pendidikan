<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$id = $_POST['id'];
     $data = [
	    'judul'     => $_POST['judul'],
        'nosk'     => $_POST['nosk'],
        'tempat'   => $_POST['tempat'],
		'tglsk'   => $_POST['tglsk']
		
			];
		$exec = update($koneksi, 'm_sk', $data,['id'=>$id]);	
