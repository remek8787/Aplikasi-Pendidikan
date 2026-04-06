<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $data = [    
	    'pakai'  => $_POST['pakai'],
        'lebar'  => $_POST['lebar'],
		'tinggi'  => $_POST['tinggi']
    ];
	
	 $datax = [    
	    'pakai'  => $_POST['pakai']
    ];
	
	if($_POST['pakai']=='1'){
    $exec = update($koneksi, 'cetak', $data, ['id'=>1]);
	}
	if($_POST['pakai']=='0'){
	$exec = update($koneksi, 'cetak', $datax, ['id'=>1]);
	}
?>