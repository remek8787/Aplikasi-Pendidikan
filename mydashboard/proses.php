<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
    
	$jumlah = $_POST['jumlah'];
	$id = $_POST['id'];
	$count = count($_POST['jumlah']);
	
for( $i=0; $i < $count; $i++ )
	
{
	$simpan = mysqli_query($koneksi,"UPDATE keranjang SET jumlah='".$jumlah[$i]."' WHERE id='".$id[$i]."'");
}
?>