<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$tanggal = date('Y-m-d');
$jam = date('H:i:s');
$bulan = date('m');
$tahun    = date('Y');
$tglabsen = date('d M Y H:i:s');

$nokartu = $_POST['uid'];
	$nokartu = str_replace("\r", '', $nokartu);


$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM status"));	
$absen = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' AND nokartu='$nokartu' ORDER BY id DESC LIMIT 1"));
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$absen[idsiswa]'"));
$nowa = $data['nowa'];
$nowaQ = $data['nowa_ortu'];
$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$absen[idpeg]'"));
if($absen['level']=='pegawai'){
$koneksi->query("INSERT INTO  absen_pesan(tanggal,idpeg)values('$tanggal','$peg[id_user]')");			
}
$absen2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal' AND nokartu='$nokartu' ORDER BY id DESC LIMIT 1"));
$data2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$absen2[idsiswa]'"));
$peg2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$absen2[idpeg]'"));

$pesan1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='1'"));
$pesan2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='2'"));
$pesan3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='3'"));
$pesan4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='4'"));
$pesan5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='5'"));
$pesan6 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='6'"));
$pesan7 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='7'"));
$pesan8 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='8'"));

$notif_masuk_siswa = $pesan1['pesan1']."\n\n".$pesan1['pesan2']."\n*".$data['nama']."*\n\n".$pesan1['pesan3']." ".$tglabsen."\n\n".$pesan1['pesan4'];
$notif_pulang_siswa = $pesan2['pesan1']."\n\n".$pesan2['pesan2']."\n*".$data['nama']."*\n\n".$pesan2['pesan3']." ".$tglabsen."\n\n".$pesan2['pesan4'];
$notif_masuk_peg = $pesan3['pesan1']."\n\n".$pesan3['pesan2']."\n*".$peg['nama']."*\n\n".$pesan3['pesan3']." ".$tglabsen."\n\n".$pesan3['pesan4'];
$notif_pulang_peg = $pesan4['pesan1']."\n\n".$pesan4['pesan2']."\n*".$peg['nama']."*\n\n".$pesan4['pesan3']." ".$tglabsen."\n\n".$pesan4['pesan4'];
$notif_masuk_eksiswa = $pesan5['pesan1']."\n\n".$pesan5['pesan2']."\n*".$data2['nama']."*\n\n".$pesan5['pesan3']." ".$tglabsen."\n\n".$pesan5['pesan4'];
$notif_pulang_eksiswa = $pesan6['pesan1']."\n\n".$pesan6['pesan2']."\n*".$data2['nama']."*\n\n".$pesan6['pesan3']." ".$tglabsen."\n\n".$pesan6['pesan4'];
$notif_masuk_ekpeg = $pesan7['pesan1']."\n\n".$pesan7['pesan2']."\n*".$peg2['nama']."*\n\n".$pesan7['pesan3']." ".$tglabsen."\n\n".$pesan7['pesan4'];
$notif_pulang_ekpeg = $pesan8['pesan1']."n\n".$pesan8['pesan2']."\n*".$peg2['nama']."*\n\n".$pesan8['pesan3']." ".$tglabsen."\n\n".$pesan8['pesan4'];


$query = mysqli_query($koneksi, "select * from datareg where nokartu='$nokartu'");
$cek = mysqli_num_rows($query);

	
if($status['mode']=='1' AND $cek<>0):
if($absen['level']=='pegawai'){
 $jumabs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_pesan WHERE idpeg='$peg[id_user]' and tanggal='$tanggal'"));
      if($jumabs==1){
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_peg,'number' => $setting['nowa'])
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_peg,'number' => $peg['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);
	  }
  }elseif($absen['level']=='siswa'){
      $jumabsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idsiswa='$data[id_siswa]' and tanggal='$tanggal'"));
		if($jumabsis==1){
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_siswa,'number' => $nowaQ)
		));
		 curl_exec($curl);
		curl_close($curl);
		
		}
	}
endif;


if($status['mode']=='2' AND $cek<>0):

if($absen['level']=='users'){
	
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_pulang_peg,'number' => $peg['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);
	}elseif($absen['level']=='siswa'){

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
		  CURLOPT_POSTFIELDS => array('message' => $notif_pulang_siswa,'number' => $nowaQ)
		));
		 curl_exec($curl);
		curl_close($curl);
		
	}
endif;

if($status['mode']=='3' AND $cek<>0):

if($absen2['level']=='users'){

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
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_ekpeg,'number' => $setting['nowa'])
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_masuk_ekpeg,'number' => $peg2['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);
  }elseif($absen2['level']=='siswa'){
 
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_masuk_eksiswa,'number' => $data2['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);
	}
endif;
if($status['mode']=='4' AND $cek<>0):
$absen2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal' AND nokartu='$nokartu' ORDER BY id DESC LIMIT 1"));
$data2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$absen2[idsiswa]'"));
$peg2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$absen2[idpeg]'"));
if($absen2['level']=='users'){
	
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_pulang_ekpeg,'number' => $setting['nowa'])
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
		  CURLOPT_POSTFIELDS => array('message' => $notif_pulang_ekpeg,'number' => $peg2['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);
	}elseif($absen2['level']=='siswa'){

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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_pulang_eksiswa,'number' => $data2['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);	
	}
endif;

			?>