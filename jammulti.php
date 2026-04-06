<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'jamabsen'){
$hari = date('D');
$waktusandik = date('H:i');
$waktu = date('H:i:s');
$sql = mysqli_query($koneksi, "select * from status");
	$data = mysqli_fetch_array($sql);
	$mode_absen = $data['mode'];
	$mode = "";
	if($mode_absen==1){
		echo $waktusandik." >>>> Masuk";	
	}else if($mode_absen==2){
		echo $waktusandik." >>> Pulang";
	}else if($mode_absen==3){
		echo $waktusandik." Masuk Les ";
	}else if($mode_absen==4){
		echo $waktusandik." Pulang Les ";
	}else if($mode_absen==5){
		echo $waktusandik." Pkt Malam  ";
	}

}
if ($pg == 'jamu'){
	$waktumu = date('H:i');
	echo $waktumu;
}



?>