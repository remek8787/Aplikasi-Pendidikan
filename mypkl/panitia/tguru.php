<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	$id = 1;
    $data = [
	    'ketua'     => $_POST['ketua'],
        'sekretaris'     => $_POST['sekretaris'],
        'nipk'   => $_POST['nipk'],
	     'nips'   => $_POST['nips'],
		  'dari'   => $_POST['dari'],
		   'sampai'   => $_POST['sampai']
			];
	$simpan = update($koneksi, 'pkl_panitia', $data,['id'=>$id]);
}

?>