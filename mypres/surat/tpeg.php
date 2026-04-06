<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

$id = $_POST['id'];
 $surat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM surat WHERE id='$id'"));
 $tanggal = $surat['tanggal'];
 $idpeg = $surat['idpeg'];
 
 $pegawai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$idpeg'"));
 $level = 'pegawai';
 
	 if($surat['ket']=='1'){
		 $ket = 'S';
	 }else{
		 $ket = 'I';
	 }
if($surat['ket']=='1'){
		 $alasan = 'SAKIT';
	 }else{
		 $alasan = 'IZIN';
	 }
	 
$masuk = date('H:i');
$nowa = $pegawai['nowa'];
$notifmu = "Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n " .$pegawai['nama']. "\n Hari ini Tidak Hadir karena : ".$alasan."\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua pegawai terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER ".$setting['sekolah']."\nWaktu Server :".$waktumu;
 

$simpan = mysqli_query($koneksi,"UPDATE surat set status='1',pesan='$notifmu' where id='$id' ");
$result = mysqli_query($koneksi,"INSERT INTO absensi(tanggal,idpeg,level,ket,masuk) VALUES('$tanggal','$idpeg','$level','$ket','$masuk')");
	
	if($result){
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
	}
?>