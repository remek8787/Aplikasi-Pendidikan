<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
 $ids = $_POST['ids'];
  $idn = $_POST['idn'];
 $nama = $_POST['nama'];
 $kelas = $_POST['kelas'];
 $kode = $_POST['kode']; $nowa = $_POST['nowa'];
$result = mysqli_query($koneksi,"UPDATE nilai SET hapus='1' WHERE id_siswa='$ids' AND id_nilai='$idn' ");
 $mapel = $_POST['mapel'];
 $notif = "Assalamualaikum wr.wb\n\nKepada Bapak/Ibu Pengawas Ujian\nSaya yang bernama : \n*" .$nama. "* Kelas : *" .$kelas. "*\nMohon untuk direset Ujian pada Mapel : *" .$mapel. "* atau kode mapel *" .$kode.  "*\nDemikian permohonan reset saya sampaikan. Terima Kasih sebelum dan sesudahnya\n\nWassalamualaikum wr. wb.";

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
		  CURLOPT_POSTFIELDS => array('message' => $notif,'number' => $nowa)
		));
		 curl_exec($curl);
		curl_close($curl);	
?>