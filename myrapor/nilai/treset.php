<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
 
   $kelas = $_POST['id'];
  
  $exec = mysqli_query($koneksi,"update siswa set t_lahir=NULL,tgl_lahir=NULL WHERE kelas='$kelas'");
  
  
