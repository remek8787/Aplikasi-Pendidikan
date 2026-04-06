<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'pegawai') {
$id = $_POST['id'];
 $data = [
'ket' => $_POST['ket']
    ];

   $simpan = update($koneksi, 'absensi', $data,['id'=>$id]);
}
if ($pg == 'siswa') {
$id = $_POST['id'];
 $data = [
'ket' => $_POST['ket']
    ];

   $simpan = update($koneksi, 'absensi', $data,['id'=>$id]);
}