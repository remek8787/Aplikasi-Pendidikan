<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpreg");
	$data = mysqli_fetch_array($sql);
	$nokartu = $data['nokartu'];
?>
	
	<input type="text" name="nokartu" id="nokartu" placeholder="Scan Kartu Barcode Anda" class="form-control"  value="<?= $nokartu; ?>" required="true">
