<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
require("konek/apk.php");
(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
($id_siswa == 0) ?  header("Location:$baseurl/mulai.php") : null;
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
$idsesi = $siswa['sesi'];
$level = $siswa['level'];
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl"));


(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';
if ($pg == '') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'jadwal') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'testongoing') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'profil') :
	$sidebar = 'sidebar-collapse';

else :
	$sidebar = '';
endif;

($pg == 'testongoing') ? $disa = '' : $disa = 'offcanvas';
 $token = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM token"));
 $nilsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' AND browser='0'"));
 $tglsekarang = time();
 $jbank = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_ujian FROM ujian"));
 
?>
<?php
  $array_browsers = ["OPR" => "Opera", "opera" => "Opera", "Edg" => "Microsoft Edge", "Chrome" => "Google Chrome", "Safari" => "Safari", "Firefox" => "Mozilla Firefox", "MSIE" => "Internet Explorer", "Trident" => "Internet Explorer", "Other" => "Unknown Browser"];  
  $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
  $jenis_browser = "Unknown Browser";
  foreach ($array_browsers as $key => $value) {
    if (strpos($agent, $key) !== false) {
      $jenis_browser = $value;
      break;
    }
  }
  $browserWarning = in_array($jenis_browser, ['Internet Explorer', 'Unknown Browser'], true);
?>

<?php if($jbank==0): ?>
<?php echo
 '<meta content="0; url=mydashboard/" http-equiv="refresh">';
 ?>
 <?php endif; ?>
<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="utf-8">
	<meta name="google" content="notranslate">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sandik All in One">
    <meta name="keywords" content="Sandik All in One">
    <meta name="author" content="sandik">
    <title><?= $setting['sekolah'] ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
    <link rel='shortcut icon' href='images/<?= $setting['logo'] ?>' />
	<link href="font/material.css" rel="stylesheet">	
    <link rel='stylesheet' href='vendor/css/bootstrap.min.css' />
    <link rel='stylesheet' href='vendor/fontawesome/css/all.css' />
    <link rel='stylesheet' href='vendor/css/AdminLTE.min.css' />
    <link rel='stylesheet' href='vendor/css/skins/skin-green-light.min.css' />
    <link rel='stylesheet' href='vendor/iCheck/square/green.css' />   
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">	
    <link rel='stylesheet' href='assets/toastr/toastr.min.css'>
    <link rel='stylesheet' href='assets/radio/css/style.css'>
    <link rel='stylesheet' href='assets/izitoast/css/iziToast.min.css'>
    <script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <link rel='stylesheet' href='vendor/css/costum.css' />
   <link rel='stylesheet' href='vendor/css/kostum.css'>
   <script type="text/javascript" src="assets/inc/TimeCircles.js"></script>
    <link rel="stylesheet" href="assets/inc/TimeCircles.css" />
	 <link rel="stylesheet" type="text/css" href="assets/animate/animate.css">
<style>
  .edis {
  background-size: 260px;
  background-image: url('images/tutwuri2.png');
  background-repeat: no-repeat;
  background-position: top right; 
}
</style>		
<style>
.responsive {
  width: 70%;
  height: auto;
}
</style>
</head>

<body class='hold-transition skin-green-light  fixed <?= $sidebar ?>' >