<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai where hapus='1'"));
	if($nilai==0){
	echo "GAGAL";		
	}else{	
   $busek = mysqli_query($koneksi, "DELETE FROM nilai WHERE hapus='1'");
 
	}	
			?>