<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

    $id = $_POST['id'];
    delete($koneksi, 'bk_pesan', ['id' => $id]);
	
?>