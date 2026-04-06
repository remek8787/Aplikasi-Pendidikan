<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'edit') {
	$level = $_POST['level'];
	$model = $_POST['model'];
	$result = mysqli_query($koneksi,"UPDATE kelas SET mode_kkm='$model' WHERE level='$level'");
}

if ($pg == 'single') {
	$level = $_POST['level'];
	$kkm = $_POST['kkm'];
	$result = mysqli_query($koneksi,"UPDATE mapel_rapor SET kkm='$kkm',kuri='1' WHERE level='$level'");
}
if ($pg == 'multi') {
	$id = $_POST['idm'];
	$kkm = $_POST['kkm'];
		
	$count = count($_POST['kkm']);
	for( $i=0; $i < $count; $i++ ){
	$result = mysqli_query($koneksi,"UPDATE mapel_rapor SET kkm='$kkm[$i]',kuri='1' WHERE id='$id[$i]'");
	}
}
if ($pg == 'sikap') {
	$spi = $_POST['spi'];
	$sos = $_POST['sos'];

	$result = mysqli_query($koneksi,"UPDATE mapel_rapor SET sikap='1' WHERE idmapel='$spi' and kuri='1'");
	$result = mysqli_query($koneksi,"UPDATE mapel_rapor SET sikap='2' WHERE idmapel='$sos' and kuri='1'");
}
