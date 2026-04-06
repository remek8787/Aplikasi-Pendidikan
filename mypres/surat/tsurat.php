<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'aprove') {
$id = $_POST['idz'];
 $surat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM surat WHERE id='$id'"));
 $tanggal = $surat['tanggal'];
 if($surat['level']=='siswa'):
 $idsiswa = $surat['idsiswa'];
 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$idsiswa'"));
 $level = 'siswa';
 $kelas = $siswa['kelas']; 
	 if($surat['ket']=='1'){
		 $ket = 'S';
		 $alasan = 'SAKIT';
	 }else{
		 $ket = 'I';
		 $alasan = 'IZIN';
	 }

$masuk = date('H:i');
$nowa = $siswa['nowa'];
$notifmu = "Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n " .$siswa['nama']. "\n Hari ini Tidak Hadir karena : ".$alasan."\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER ".$setting['sekolah']."\nWaktu Server :".$waktumu;
$simpan = mysqli_query($koneksi,"UPDATE surat set status='1' where id='$id' ");
$result = mysqli_query($koneksi,"INSERT INTO absensi(tanggal,idsiswa,kelas,level,ket,bulan,tahun) VALUES('$tanggal','$idsiswa','$kelas','$level','$ket','$bulan','$tahun')");
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
	else:
$idpeg = $surat['idpeg'];
 $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$idpeg'"));
 $level = 'pegawai';
	 if($surat['ket']=='1'){
		 $ket = 'S';
		 $alasan = 'SAKIT';
	 }else{
		 $ket = 'I';
		 $alasan = 'IZIN';
	 }

$masuk = date('H:i');
$nowa = $siswa['nowa'];
$notifmu = "Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Bapak/Ibu :\n " .$peg['nama']. "\n Hari ini Tidak Hadir karena : ".$alasan."\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Kepala Sekolah terhadap Pegawai. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER ".$setting['sekolah']."\nWaktu Server :".$waktumu;
$simpan = mysqli_query($koneksi,"UPDATE surat set status='1' where id='$id' ");
$result = mysqli_query($koneksi,"INSERT INTO absensi(tanggal,idpeg,level,ket,bulan,tahun) VALUES('$tanggal','$idpeg','$level','$ket','$bulan','$tahun')");	
	
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
	
	endif;

		
	
}
if ($pg == 'hapus') {
	$id = $_POST['id'];
 $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM surat WHERE id='$id'"));
 if(is_file("../../files/".$data['file'])) 
			unlink("../../files/".$data['file']); 
	$exec = mysqli_query($koneksi, "DELETE FROM surat WHERE id='$id'");
}
if ($pg == 'pres') {
	$id = $_POST['id'];
	mysqli_query($koneksi,"UPDATE siswa SET blokir='0' WHERE id_siswa='$id'");		
}
