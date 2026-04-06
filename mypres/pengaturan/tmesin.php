<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

       $mesin = $_POST['mesin'];    
       $api = $_POST['api']; 
    $simpan = mysqli_query($koneksi,"UPDATE pengaturan SET mesin='$mesin',url_api='$api'");
   
?>