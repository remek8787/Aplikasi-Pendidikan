<?php
require("../../../konek/koneksi.php");
require("../../../konek/function.php");
require("../../../konek/crud.php");

$foto = glob('../../../files/*'); 
foreach ($foto as $file) {
    if (is_file($file))
        unlink($file); 
}
$exec = mysqli_query($koneksi, "truncate file_pendukung");