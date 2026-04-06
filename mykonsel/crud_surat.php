<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'surat1') {
	$id = $_POST['idsp'];
	$nis = $_POST['nis'];
	$sts = $_POST['sts'];
      $data = [
	'nis' => $_POST['nis'],
	'tanggal' => $_POST['tanggal'],
	'nosurat' => $_POST['nosurat'],
	'tapel' => $_POST['tapel'],
	'sts' => $_POST['sts'],
	'idsp' => $_POST['idsp'],
	'sanksi' =>$_POST['sanksi']
	];
$exec=insert($koneksi,'bk_surat',$data);
mysqli_query($koneksi, "UPDATE bk_sp SET sts='$sts' WHERE id='$id'");
mysqli_query($koneksi, "UPDATE bk_siswa SET sts='$sts' WHERE nis='$nis' ");
}
