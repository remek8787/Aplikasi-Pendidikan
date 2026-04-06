<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	
        $data = [
        'tanggal'=> $tanggal,
		'bulan'=> $bulan,
		'idsiswa'=> $_POST['ids'],
		'kelas'=> $_POST['kelas'],
		'idkompetensi'=> $_POST['kompetensi'],
		'proses' => $_POST['proses']
        ];
    $exec = insert($koneksi, 'pkl_jurnal', $data);
}
	