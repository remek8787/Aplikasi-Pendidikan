<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$ids = $_POST['idu'];
        $data = [
        'walas'     => $_POST['kelas']
        ];
    $exec = update($koneksi, 'users', $data, ['id_user' => $ids]);
	