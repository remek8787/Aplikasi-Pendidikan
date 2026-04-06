<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM status"));	
$hari = date('D');
$harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM waktu where hari='$hari'"));	
$waktu = date('H:i:s');
$tanggal = date('Y-m-d');
$jamu = date('H:i');
$bulan = date('m');
$tahun    = date('Y');
$jam_masuk  = strtotime($harix['masuk']);
$jam_eskul  = strtotime($harix['jam_eskul']);
$jam_datang = strtotime($jamu);
if($status['mode']=='1' OR $status['mode']=='2'):									
$selisih  = $jam_datang - $jam_masuk;
 elseif($status['mode']=='3'):
 $selisih  = $jam_datang - $jam_eskul;
endif;
if($selisih > 0){
	$jam   = floor($selisih / (60 * 60));
	$menit = $selisih - ( $jam * (60 * 60) );
	$detik = $selisih % 60;
	$ket =  'Terlambat '.$jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
}else{
$ket = "Tepat Waktu";	
}		

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';


if ($pg == 'pegawai') {
if($_POST['ket']=="S"){
	 $alasan = "SAKIT";
 }elseif($_POST['ket']=="I"){
	 $alasan = "IZIN";
 }elseif($_POST['ket']=="A"){
	 $alasan = "ALPHA";
}
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$_POST[idpeg]'"));
$nowa = $peg['nowa'];
$notifmu = "Assalamualaikum wr wb.....\n\nKami informasikan bahwa Sdr/i :\n\n" .$peg['nama']. "\n\nHari ini Tidak Hadir karena : ".$alasan."\n\nDemikian Informasi kami sampaikan untuk menjadi Sarana Monitorin Kepala Sekolah terhadap para Guru dan Staff. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas.\n\n Wassalamualaikum wr wb.....";
 
    $data = [
'tanggal' => $tanggal,
'idpeg' => $_POST['idpeg'],
'ket' => $_POST['ket'],
'keterangan' => $ket,
'masuk' => $waktu,
'level' =>'pegawai',
'bulan' => date('m'),
'tahun'=> date('Y')
    ];

      $simpan = insert($koneksi, 'absensi', $data);
           
		if($simpan){	
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
		  CURLOPT_POSTFIELDS => array('message' => $notifmu,'number' => $setting['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);		
		}
			

}
