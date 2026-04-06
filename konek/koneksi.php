<?php
session_start();
error_reporting(0);

//JIKA DIINSTAL DISUBDOMAIN HOSTING HAPUS BARIS DIBAWAH INI
$uri = $_SERVER['REQUEST_URI'];
$baseurl = explode("/", $uri);

if ($uri == '/') {
	$baseurl = "https://" . $_SERVER['HTTP_HOST'];
	(isset($baseurl[1])) ? $pg = $baseurl[1] : $pg = '';
	(isset($baseurl[2])) ? $ac = $baseurl[2] : $ac = '';
	(isset($baseurl[3])) ? $id = $baseurl[3] : $id = 0;
} else {
	$baseurl = "https://" . $_SERVER['HTTP_HOST'] . "/" . $baseurl[1];
	(isset($baseurl[2])) ? $pg = $baseurl[2] : $pg = '';
	(isset($baseurl[3])) ? $ac = $baseurl[3] : $ac = '';
	(isset($baseurl[4])) ? $id = $baseurl[4] : $id = 0;
}




//JIKA DIINSTAL DISUBDOMAIN HOSTING HAPUS TANDA // BARIS DIBAWAH INI

$uri = $_SERVER['REQUEST_URI'];
$baseurl = explode("/",$uri);

$baseurl = "https://".$_SERVER['HTTP_HOST'];
(isset($baseurl[1])) ? $pg = $baseurl[1] : $pg = '';
(isset($baseurl[2])) ? $ac = $baseurl[2] : $ac = '';
(isset($baseurl[3])) ? $id = $baseurl[3] : $id = 0;



$host = 'localhost';
$username = 'dentanet_demoesandik';
$password = '@demoesandik';
$database = 'dentanet_demoesandik';

$koneksi = mysqli_connect($host, $username, $password, "");
if ($koneksi) {
	$debe = mysqli_select_db($koneksi, $database);
	if ($debe) {
		$query = mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id_aplikasi='1'");
		if ($query) {
			$setting = mysqli_fetch_array($query);
			mysqli_set_charset($koneksi, 'utf8');
			date_default_timezone_set($setting['waktu']);
		}
	}
}

$semester = $setting['semester'];
$tapel = $setting['tp'];
$tanggal = date('Y-m-d');
$waktumu = date('Y-m-d H:i:s');
$bulan = date('m');
$tahun = date('Y');
?>