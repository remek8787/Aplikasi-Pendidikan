<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $data = [    
        'pelanggaran'  => $_POST['langgar'],
		'kkm'  => $_POST['kkm']
    ];
    $exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi'=>1]);
?>