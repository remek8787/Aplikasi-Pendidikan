<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$hari = date('D');
$harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM waktu where hari='$hari'"));	

$tanggal = date('Y-m-d');
$jamabsen = date('H:i:s');
$bulan = date('m');
$tahun    = date('Y');
$jam_masuk  = strtotime($harix['masuk']);
$jam_eskul  = strtotime($harix['jam_eskul']);
$jam_datang = date('H:i');
if($status['mode']=='1'):									
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

	$nokartu = $_POST['uid'];
	$nokartu = str_replace("\r", '', $nokartu);
	$tglabsen = date('d M Y H:i:s');
	
	mysqli_query($koneksi, "TRUNCATE tmpreg");
    $status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM status"));	

$pesan1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='1'"));
$pesan2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='2'"));
$pesan3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='3'"));
$pesan4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='4'"));



$query = mysqli_query($koneksi, "select * from datareg where nokartu='$nokartu'");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$data[idpeg]'"));

$notif_masuk_siswa = $pesan1['pesan1']." ".$pesan1['pesan2']."\n\n*".$data['nama']."*\n\n".$pesan1['pesan3']."\n\n".$tglabsen."\n\n".$pesan1['pesan4'];
$notif_pulang_siswa = $pesan2['pesan1']." ".$pesan2['pesan2']."\n\n*".$data['nama']."*\n\n".$pesan2['pesan3']."\n\n".$tglabsen."\n\n".$pesan2['pesan4'];
$notif_masuk_peg = $pesan3['pesan1']." ".$pesan3['pesan2']."\n\n*".$peg['nama']."*\n\n".$pesan3['pesan3']."\n\n".$tglabsen."\n\n".$pesan3['pesan4'];
$notif_pulang_peg = $pesan4['pesan1']." ".$pesan4['pesan2']."\n\n*".$peg['nama']."*\n\n".$pesan4['pesan3']."\n\n".$tglabsen."\n\n".$pesan4['pesan4'];

   if ($cek ==0) {
	echo "TIDAK TERDAFTAR";
	$exec = mysqli_query($koneksi,"INSERT INTO tmpreg(nokartu) VALUES('$nokartu')");
	mysqli_close($koneksi);
		}else{
	
		echo $nama;	
		$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[idsiswa]'"));
		$kelas = $siswa['kelas'];
		$nowa = $siswa['nowa'];

		$cari_absen = mysqli_query($koneksi, "select * from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
		$jumlah_absen = mysqli_num_rows($cari_absen);
			
		if($status['mode']=='1' AND $jumlah_absen==0):
			if($data['level']=='pegawai'){
		mysqli_query($koneksi, "insert into absensi(nokartu,tanggal,idpeg, masuk, ket, bulan,tahun,level,keterangan)values('$nokartu','$tanggal','$data[idpeg]', '$jamabsen','H', '$bulan','$tahun','pegawai','$ket')");		
		mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$data[idpeg]','$waktumu','1')");		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $setting['url_api'].'/send-message',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_peg,'number' => $setting['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);
			}else{
				$koneksi->query("INSERT INTO  absensi(nokartu,tanggal,idsiswa,kelas,masuk,ket,bulan,tahun,level,keterangan)values('$nokartu','$tanggal', '$data[idsiswa]', '$kelas', '$jamabsen','H', '$bulan','$tahun','siswa','$ket')");			
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','1')");		
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_masuk_siswa,'number' => $nowa)
		));
		curl_exec($curl);
		curl_close($curl);
			}
		endif;
		if($status['mode']=='2'):
			mysqli_query($koneksi, "update absensi set pulang='$jamabsen' where nokartu='$nokartu' and tanggal='$tanggal'");
			if($data['level']=='pegawai'){
			mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$data[idpeg]','$waktumu','2')");		
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_pulang_peg,'number' => $setting['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);
			}else{
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','2')");		
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_pulang_siswa,'number' => $nowa)
		));
		curl_exec($curl);
		curl_close($curl);	
			}
			endif;

}
			?>