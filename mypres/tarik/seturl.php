<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

   $server = $_POST['server'];
   $npsn = $_POST['npsn'];
    mysqli_query($koneksi,"UPDATE pengaturan set npsn='$npsn',server='$server' where id_aplikasi='1'");
    

?>