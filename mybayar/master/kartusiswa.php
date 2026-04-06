<?php
require("../../config/koneksi.php");
require("../../config/function.php");
require("../../config/crud.php");

	$sql = mysqli_query($koneksi, "select * from tmpbayar");
	$data = mysqli_fetch_array($sql);
	$kartu = $data['nokartu'];
?>
	
	<input type="text" name="kartusis" id="kartusis" placeholder="Silahkan Scan atau Tempel Kartu Siswa" class="form-control"  value="<?= $kartu; ?>" required="true" autocomplete="off">
