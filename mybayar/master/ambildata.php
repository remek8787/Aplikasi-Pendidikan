<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	
if ($pg == 'jumlah') {
    $mode = $_POST['model'];
    $sql = mysqli_query($koneksi, "SELECT * FROM model WHERE mode='" . $mode . "'");
		echo "<option value=''>Pilih Angsuran</option>";
	
	while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[jml]'>$data[jml] X</option>";
    }
}
