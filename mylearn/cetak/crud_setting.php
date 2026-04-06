<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'reset') {
$exec = mysqli_query($koneksi, "truncate materi");
$exec = mysqli_query($koneksi, "truncate jawaban_tugas");
$exec = mysqli_query($koneksi, "truncate tugas");
$exec = mysqli_query($koneksi, "truncate absensi_daring");
$exec = mysqli_query($koneksi, "truncate absen_mapel");

$gambarmu = glob('../../materi/*'); 
foreach ($gambarmu as $fileu) {
    if (is_file($fileu))
        unlink($fileu); 
}
$gambare = glob('../../tugas/*'); 
foreach ($gambare as $fileug) {
    if (is_file($fileug))
        unlink($fileug); 
}

}