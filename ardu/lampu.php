<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

		$queryx = mysqli_query($koneksi,"SELECT * FROM lampu WHERE status='1'");
         while ($datax = mysqli_fetch_array($queryx)) :		 
		 echo "L".$datax['id'].$datax['status'];
		 endwhile;		 

			?>