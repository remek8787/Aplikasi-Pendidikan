<?php
require("../../../konek/koneksi.php");
require("../../../konek/function.php");
require("../../../konek/crud.php");
cek_session_admin();
$kode = $_POST['kode'];
$exec = mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_file in (" . $kode . ")");
foreach ($kode as $kodes) {

    $file = fetch($koneksi, 'file_pendukung', ['id_file' => $kodes]);
    $filles = "../../../files/" . $file['nama_file'];
    if (file_exists($files)) {
        unlink($filles);
    }
}
if ($exec) {
    echo 1;
} else {
    echo 0;
}
