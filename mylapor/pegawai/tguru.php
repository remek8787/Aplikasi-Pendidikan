<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'edit') {
	$id_user = $_POST['ids'];
   
        $data = [
       'pendidikan'     => $_POST['pendidikan'],
        'status'   => $_POST['status'],
		 'jk'   => $_POST['jk'],
		  'golongan'   => $_POST['golongan']
        ];
   
	$exec = update($koneksi, 'users', $data, ['id_user' => $id_user]);
	
}

?>