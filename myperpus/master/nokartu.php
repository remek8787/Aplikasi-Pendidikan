<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpbuku");
	$data = mysqli_fetch_array($sql);
	$nokartu = $data['kode'];
?>
	
	<input type="text" name="nokartu" id="nokartu" placeholder="Silahkan Scan Barcode Buku" class="form-control"  value="<?= $nokartu; ?>" required="true" autocomplete="off">
