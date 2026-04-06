<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$id = $_POST['id'];
$status = $_POST['aprove'];
mysqli_query($koneksi,"UPDATE pkl_jurnal SET status='$status' WHERE id='$id'"); 

?>