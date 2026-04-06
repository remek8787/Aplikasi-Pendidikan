<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from statustrx"));
	
mysqli_query($koneksi, "TRUNCATE tmpsis");
	
$nokartu = $_GET['nokartu'];

$query = mysqli_query($koneksi, "select * from datareg where nokartu='$nokartu'");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];

if ($cek ==0) {
	echo "TIDAK TERDAFTAR";
	
		}else{
		if($status['mode']=='1'){
		echo $data['nada']."#".$nama."#24";	
			}
		if($status['mode']=='2'){
		echo $data['nada']."#".$nama."#25";	
			}	
	    mysqli_query($koneksi,"INSERT INTO tmpsis(nokartu) VALUES('$nokartu')");
}
			?>