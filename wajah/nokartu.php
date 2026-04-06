<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpface");
	$data = mysqli_fetch_array($sql);
	$nokartu = $data['nokartu'];
?>
	
	
	 <input type="text"  id="lname" name="lname" placeholder="Tempelkan Kartu RFID Anda" class="form-control" value="<?= $nokartu ?>"  required="true">