<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

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


$query = mysqli_query($koneksi,"SELECT * FROM waktu WHERE hari='$hari'");
while ($data = mysqli_fetch_array($query)) :
if($data['masuk']<>'' && $waktusandik <= $data['pulang']){
mysqli_query($koneksi,"UPDATE status set mode='1'");
}
if($data['pulang']<>'' && $waktusandik >= $data['pulang'] && $waktusandik < $data['batas_pulang'] ){
mysqli_query($koneksi,"UPDATE status set mode='2'");
}
if($data['masuk_eskul']<>'' && $waktusandik >= $data['masuk_eskul'] && $waktusandik < $data['pulang_eskul']){
mysqli_query($koneksi,"UPDATE status set mode='3'");
}
if($data['pulang_eskul']<>'' && $waktusandik >= $data['pulang_eskul'] && $waktusandik < $data['batas_eskul']){
mysqli_query($koneksi,"UPDATE status set mode='4'");
}
if($data['piket_masuk']<>'' && $waktusandik >= $data['piket_masuk'] && $waktusandik < '23:00'){
mysqli_query($koneksi,"UPDATE status set mode='5'");
}
endwhile;


if($setting['notif']==$waktu):

$queryx = mysqli_query($koneksi,"SELECT * FROM jadwal_mengajar WHERE hari='$hari'");
while ($datax = mysqli_fetch_array($queryx)) :
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$datax[guru]'"));
$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id='$datax[mapel]'"));
$nowa = $peg['nowa']; 

$notifmu = "Assalamualaikum wr.wb\n\nKami informasikan Bahwa hari ini Bapak/ibu Guru ada Jadwal KBM di ".$setting['sekolah']. "\n\nMata Pelajaran *".$mapel['nama_mapel']."* Kelas *".$datax['kelas']."*\n\nDari jam ".$datax['dari']." Sampai ".$datax['sampai']."\n\nDemikian informasi dari server secara otomatis untuk mengingatkan Bapak/Ibu guru. Terima kasih dan tidak perlu dibalas\n\nWassalamualaikum wr,wb";
mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$datax[guru]','$waktumu','1')");	
          $curl = curl_init();
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => $setting['url_api'].'/send-message',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('message' => $notifmu,'number' => $nowa)
		));
		 curl_exec($curl);
		curl_close($curl);
			
			
        sleep(1);
	endwhile;
endif;


?>