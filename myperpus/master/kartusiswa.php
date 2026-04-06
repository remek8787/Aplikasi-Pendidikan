<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpsis");
	$data = mysqli_fetch_array($sql);
	$kartu = $data['nokartu'];
?>
	
	<input type="text" name="kartusis" id="kartusis" placeholder="Silahkan Scan atau Tempel Kartu Siswa" class="form-control"  value="<?= $kartu; ?>" required="true" autocomplete="off">
