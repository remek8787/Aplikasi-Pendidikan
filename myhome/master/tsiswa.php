<?php
require("../../config/koneksi.php");
require("../../config/function.php");
require("../../config/crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';



if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'siswa', ['npsn' => $id]);
	 delete($koneksi, 'server', ['npsn' => $id]);
}
