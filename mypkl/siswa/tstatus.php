<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$id = $_POST['id'];
$status = $_POST['aprove'];
$catatan = $_POST['catatan'];
mysqli_query($koneksi,"UPDATE pkl_kegiatan SET status='$status',catatan='$catatan' WHERE id='$id'"); 

?>