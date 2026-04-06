<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $data = [    
	
		 'tgltrx'         => $_POST['tgl'],
		  'idbayar'         => $_POST['idbayar'],
		   'jamkirim'         => $_POST['jamkirim']
    ];
    $exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi'=>1]);
?>