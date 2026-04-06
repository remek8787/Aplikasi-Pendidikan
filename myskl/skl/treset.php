<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
 
   $kelas = $_POST['id'];
  
  $exec = mysqli_query($koneksi,"update siswa set ket=NULL WHERE kelas='$kelas'");
  
  
