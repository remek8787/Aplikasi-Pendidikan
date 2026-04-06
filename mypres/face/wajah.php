<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
?>
	 <?php
$folder = "../../photo";
$gambar = scandir($folder);

foreach($gambar as $img);
    
?>			

 <img src="../photo/<?= $img ?>" alt="" style="width:100%">
