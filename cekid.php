<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$hari = date('D');
$harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM waktu where hari='$hari'"));	
$tglabsen = date('d M Y H:i:s');
$jamu = date('H:i');
$tanggal = date('Y-m-d');
$jamabsen = date('H:i:s');
$bulan = date('m');
$tahun    = date('Y');
$jam_masuk  = strtotime($harix['masuk']);
$jam_eskul  = strtotime($harix['jam_eskul']);
$jam_datang = strtotime($jamu);												
$selisih  = $jam_datang - $jam_masuk;
 
if($selisih > 0){
	$jam   = floor($selisih / (60 * 60));
	$menit = $selisih - ( $jam * (60 * 60) );
	$detik = $selisih % 60;
	$ket =  'Terlambat '.$jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
}else{
$ket = "Tepat Waktu";	
}		

$pesan1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='1'"));
$pesan2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='2'"));
$pesan3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='3'"));
$pesan4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_pesan  WHERE id='4'"));


if (isset($_POST['Get_Fingerid'])) {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg ORDER BY idjari DESC LIMIT 1"));
	$output = 
    [
        "Detail" =>
        [
            
            "Data User" => $data['nama'],
            "Data ID" => $data['idjari'],
			 "Data Serial" => $data['serialnumber']
        ]
    ];
    $json = json_encode($output);
    echo $json;
	
	mysqli_query($koneksi,"UPDATE datareg SET sts='1' WHERE idjari='$data[idjari]'");
}
if (isset($_POST['Hapus_id'])) {
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM temp_finger ORDER BY id DESC LIMIT 1"));
	$output = 
    [
        "Detail" =>
        [
            
            "Data User" => $data['nama'],
            "Data ID" => $data['idjari'],
			"Data Serial" => $data['serial']
        ]
    ];
    $json = json_encode($output);
    echo $json;
	delete($koneksi, 'temp_finger', ['idjari' => $data['idjari']]);
	
}

if (isset($_POST['uid'])) {
$idj = $_POST['uid'];
$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM status"));	
$query = mysqli_query($koneksi, "select * from datareg where idjari='$idj'");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];

if ($cek ==0) {
	echo "TIDAK TERDAFTAR";
	$koneksi -> close();
	}else{
     echo $nama;	
        $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE idjari='$data[idjari]'"));
		$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE idjari='$data[idjari]'"));
		$kelas = $siswa['kelas'];		
        $cari_absen = mysqli_query($koneksi, "select * from absensi where nokartu='$idj' and tanggal='$tanggal'");
		$jumlah_absen = mysqli_num_rows($cari_absen);
		if($status['mode']=='1' AND $jumlah_absen==0):
			if($data['level']=='pegawai'){	
          $notif_masuk_peg = $pesan3['pesan1']."\n\n".$pesan3['pesan2']."\n*".$peg['nama']."*\n\n".$pesan3['pesan3']." ".$tglabsen."\n\n".$pesan3['pesan4'];

			$simpan = mysqli_query($koneksi, "insert into absensi(nokartu,tanggal,idpeg, masuk, ket, bulan,tahun,level,keterangan,mesin)values('$idj','$tanggal','$data[idpeg]', '$jamabsen','H', '$bulan','$tahun','pegawai','$ket','FINGER')");		
			mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$peg[idpeg]','$waktumu','1')");	
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
			}else{
		$notif_masuk_siswa = $pesan1['pesan1']."\n\n".$pesan1['pesan2']."\n*".$data['nama']."*\n\n".$pesan1['pesan3']." ".$tglabsen."\n\n".$pesan1['pesan4'];
		$koneksi->query("INSERT INTO  absensi(nokartu,tanggal,idsiswa,kelas,masuk,ket,bulan,tahun,level,keterangan,mesin)values('$idj','$tanggal', '$data[idsiswa]', '$kelas', '$jamabsen','H', '$bulan','$tahun','siswa','$ket','FINGER')");			
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_masuk_siswa,'number' => $siswa['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);
			}
		endif;
		if($status['mode']=='2'):
		
			mysqli_query($koneksi, "update absensi set pulang='$jam' where nokartu='$idj' and tanggal='$tanggal'");
			if($absen['level']=='pegawai'){
	 $notif_pulang_peg = $pesan4['pesan1']."\n\n".$pesan4['pesan2']."\n*".$peg['nama']."*\n\n".$pesan4['pesan3']." ".$tglabsen."\n\n".$pesan4['pesan4'];
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
        $notif_pulang_siswa = $pesan2['pesan1']."\n\n".$pesan2['pesan2']."\n*".$data['nama']."*\n\n".$pesan2['pesan3']." ".$tglabsen."\n\n".$pesan2['pesan4'];
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
		  CURLOPT_POSTFIELDS => array('message' =>$notif_pulang_siswa,'number' => $siswa['nowa'])
		));
		curl_exec($curl);
		curl_close($curl);	
	}
			
			
			endif;
	}
  }
?>