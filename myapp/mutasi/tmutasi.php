<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'tamat') {
    $tahun = date('Y');
	$tanggal = date('Y-m-d');
	$ids = $_POST['idsiswa'];
    $ket = $_POST['alasan'];
	$count = count($_POST['idsiswa']);
	for( $i=0; $i < $count; $i++ ){
		$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$ids[$i]'"));		
		$nama = addslashes($user['nama']);
		$simpan = mysqli_query($koneksi,"INSERT INTO alumni(nis,nisn,nama,kelas,jurusan,jk,tgl_mutasi,tahun_keluar,ket) VALUES('$user[nis]','$user[nisn]','$nama','$user[kelas]','$user[jurusan]','$user[jk]','$tanggal','$tahun','$ket')");
		$pesan = "Terima kasih kepada ananda \n".$user['nama']."\n\nTelah aktif belajar di ".$setting['sekolah']."\n\nSekarang Lulus dan kami berharap untuk melanjutkan ke jenjang berikutnya\n\nSemoga semakin rajin belajar dan tercapai apa yang ananda cita citakan";
		
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
		CURLOPT_POSTFIELDS => array('message' => $pesan,'number' => $user['nowa']),
		));
		$response = curl_exec($curl);
		curl_close($curl);
	
		
		if($simpan){
			mysqli_query($koneksi,"DELETE FROM siswa where id_siswa='$ids[$i]'");
			mysqli_query($koneksi,"DELETE FROM datareg where idsiswa='$ids[$i]'");
		}

	}
}
if ($pg == 'naik') {
	$ids = $_POST['idsiswa'];
    $kelas = $_POST['kelas'];
	$count = count($_POST['idsiswa']);
	for( $i=0; $i < $count; $i++ ){
	$simpan = mysqli_query($koneksi,"UPDATE siswa SET kelas='$kelas' where id_siswa='$ids[$i]'");
	$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$ids[$i]'"));
	$pesan = "Terima kasih kepada ananda \n".$siswa['nama']."\n\nTelah aktif belajar di ".$setting['sekolah']."\n\nSekarang naik ke kelas ".$kelas."\n\nSemoga semakin rajin belajar dan tercapai apa yang ananda cita citakan";
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
		CURLOPT_POSTFIELDS => array('message' => $pesan,'number' => $siswa['nowa']),
		));
		$response = curl_exec($curl);
		curl_close($curl);
	}
}