<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/apk.php");
require("../konek/crud.php");
(isset($_SESSION['id_user'])) ? $id_user = $_SESSION['id_user'] : $id_user = 0;
($id_user == 0) ? header('location:../myapp/') : null;
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$id_user'"));
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';

if ($pg == enkripsi('nilai')) :
	$sidebar = 'full';		

else :
	$sidebar = '';
endif;

?>
<!DOCTYPE html>
<html lang="en" translate="no">
    <head>
        <meta charset="utf-8" />
		<meta name="google" content="notranslate">
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
   <meta name="description" content="Sandik All in One">
    <meta name="keywords" content="Sandik All in One">
    <meta name="author" content="sandik">   
    <title><?= $setting['sekolah'] ?></title>
 
    <link href="<?= $baseurl ?>/font/material.css" rel="stylesheet">
    <link href="<?= $baseurl ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $baseurl ?>/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= $baseurl ?>/assets/plugins/pace/pace.css" rel="stylesheet">
	<link href="<?= $baseurl ?>/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
    <link href="<?= $baseurl ?>/assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link rel='stylesheet' href='<?= $baseurl ?>/assets/izitoast/css/iziToast.min.css'>
	<script src="<?= $baseurl ?>/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <link href="<?= $baseurl ?>/assets/css/main.css" rel="stylesheet">    
    <link rel="stylesheet" href="<?= $baseurl ?>/assets/css/sweetalert2.min.css">
	<link href="<?= $baseurl ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
	<script src='<?= $baseurl ?>/assets/tinymce/tinymce.min.js'></script>
	<link href="<?= $baseurl ?>/assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link rel='stylesheet' href='<?= $baseurl ?>/assets/datetimepicker/jquery.datetimepicker.css' />
 <link rel="icon" type="image/png" sizes="16x16" href="<?= $baseurl ?>/images/<?= $setting['logo'] ?>">
	  <style type="text/css">
   .bold { font-weight: bold; }
   .pull-right{
    float: right;
    display: block;
	margin-top:-30px;
	
  }
   .kanan{
    float: right;
    display: block;
	margin-top:5px;
	
  }
.edis2 {
  background-size: 360px;
  background-image: url('../images/tutwuri2.png');
  background-repeat: no-repeat;
  background-position: top right; 
}

</style> 
<style>
.responsive {
  width: 80px;
  height: auto;
  text-align:center;
}
.respon2 {
  width: 50px;
  height: auto;
  text-align:center;
}
</style>

</head>
<body>
