<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
							
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'login') {
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password' ");
$cek = mysqli_num_rows($query);
if ($cek <> 0) {
$user = mysqli_fetch_array($query);
   echo $user['id_user']."#";
   echo $user['nama']."#";
   echo $user['jabatan']."#";
}else{
	echo "0";
}
	
}
if ($pg == 'absen') {
	$hari = date('D');
	$tanggal = date('Y-m-d');
	$tglabsen = date('Y-m-d H:i:s');
	$bulan = date('m');
	$tahun = date('Y');
	$masuk = date('H:i:s');
	$username = $_POST['username'];
	$lokasi = $_POST['lokasi'];
	$lat = $_POST['lat'];
    $lon = $_POST['lon'];
    $nokep = $setting['nowa'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users where username='$username'"));
    $nowa = $data['nowa'];
	$idpeg = $data['id_user'];
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg FROM data_luar WHERE idpeg='$idpeg'"));
	$notif_gagal = "Kami informasikan bahwa\n\n*".$data['nama']."*\nPresensi ditolak. Anda sudah melakukan presensi, Lokasi Anda saat ini : ".$lokasi."\n\n Terima kasih. Tidak Perlu dibalas";
	$notif = "Kami informasikan bahwa\n\n*".$data['nama']."*\nTelah melakukan Presensi dari Luar Area Sekolah.\n\nLokasi Anda saat ini : ".$lokasi."\n\nTerima kasih. Tidak Perlu dibalas";
if($cek==1){ 

	$cek2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,tanggal FROM absensi WHERE idpeg='$idpeg' and tanggal='$tanggal'"));
      $cek3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg,tanggal FROM absen_tu WHERE idpeg='$idpeg' and tanggal='$tanggal'"));

    if($cek2==0){
	if($data['level']=='guru'){		
	$sql = mysqli_query($koneksi,"SELECT * FROM jadwal_mengajar WHERE hari='$hari' and guru='$idpeg'");
    while ($dt = mysqli_fetch_array($sql)) :
	$exec = mysqli_query($koneksi,"INSERT INTO absen_jjm(tanggal,idpeg,kelas,masuk,ket,mapel,jjm,bulan,tahun,jadwal) VALUES('$tanggal','$idpeg','$dt[kelas]','$dt[dari]','H','$dt[mapel]','$dt[jjm]','$bulan','$tahun','$dt[id_jadwal]')");
	endwhile;
	}
	if($data['level']=='staff'){
	if($cek3==0){
	$tu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jadwal_tu where idpeg='$idpeg' and hari='$hari'"));
	$honor = $tu['jjk']*$tu['honor'];
	$exec = mysqli_query($koneksi,"INSERT INTO absen_tu(tanggal,idpeg,masuk,pulang,ket,jumlah,bulan,tahun,honor) VALUES('$tanggal','$idpeg','$masuk','$masuk','siang','$tu[jjk]','$bulan','$tahun','$honor')");
	}
	}
	$exec = mysqli_query($koneksi,"INSERT INTO absensi(tanggal,idpeg,level,masuk,ket,bulan,tahun,jenis,link) VALUES('$tanggal','$data[id_user]','pegawai','$masuk','H','$bulan','$tahun','1','$lokasi')");

    if($exec){
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif,'number' => $nowa)
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif,'number' => $nokep)
		));
		curl_exec($curl);
		curl_close($curl);
   
      
         echo "2";
		}

	 }else{
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_gagal,'number' => $nowa)
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_gagal,'number' => $nokep)
		));
		curl_exec($curl);
		curl_close($curl);
       echo "1";
	  }	   
 }else{
	echo "0"; 
 }
 
}
  ?>