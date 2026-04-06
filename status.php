<?php
require "konek/koneksi.php";
require "konek/function.php";
require "konek/crud.php";
cek_session_siswa();
$id_siswa = $_SESSION['id_siswa'];
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'statusonline') {
    $data = [
        'online' => 1
    ];
    $exec = update($koneksi, 'siswa', $data, ['id_siswa' => $id_siswa]);
}
if ($pg == 'statusoffline') {
    $data = [
        'online' => 0
    ];
    $exec = update($koneksi, 'siswa', $data, ['id_siswa' => $id_siswa]);
}
if ($pg == 'ulangujian') {
    $id = $_POST['id'];
	$ids = $_POST['ids'];
   
   
    $where2 = array(
      
        'id_siswa' => $ids,
        'id_ujian' => $id
    );
    delete($koneksi, 'nilai',$where2);

}
