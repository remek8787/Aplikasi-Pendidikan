<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

     $data = [
        'jjm'   => $_POST['jjm'],
        'honor'   => $_POST['honor'],
		'jam'   => $_POST['model']
			];		
	$result = update($koneksi, 'pengaturan', $data);
	
