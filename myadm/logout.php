<?php
	require("../konek/koneksi.php");
	require("../konek/dis.php");
	(isset($_SESSION['id_user'])) ? $id_user = $_SESSION['id_user'] : $id_user = 0;
	session_destroy();
	echo "<script>location.href = '../myhome/';</script>";
