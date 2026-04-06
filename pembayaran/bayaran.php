<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$waktu = date('H:i:s');
mysqli_query($koneksi, "TRUNCATE tmpbayar");
$kartu = $_POST['uid'];

$besar = $_POST['besar'];
$idbayar = $_POST['idm'];
$blth = date('mY');
$bulanmu = date('YmdHis');
$bukti = "TRX-".$idbayar."-".$bulanmu;
$jenis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$idbayar'"));

$datax = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nokartu='$kartu'"));
if($datax['nokartu']==$kartu){	
	$ids =$datax['id_siswa'];
	$saldomu = $datax['saldo'];
	$saldo = $datax['saldo']-$besar;
$jumbayar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idbayar'"));	
if($jumbayar == $jenis['jumlah']){
echo "LUNAS";
}else{
if($saldomu < $besar){
echo "KURANG";
}else{	
	$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));
$query = mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' AND blth='$blth' and idbayar='$idbayar'");
$cek = mysqli_num_rows($query);
if ($cek == 0) {
	$exec = mysqli_query($koneksi,"INSERT INTO tmpbayar(nokartu) VALUES('$kartu')");
	$trx = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idbayar'"));
	$ke = $trx + 1;
	$simpan = mysqli_query($koneksi,"INSERT INTO trx_bayar(tanggal,blth,idsiswa,kelas,idbayar,bayar,ke,bukti) VALUES('$tanggal','$blth','$ids','$siswa[kelas]','$idbayar','$besar','$ke','$bukti')");
	if($simpan){
	$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit,ket) VALUES('$tanggal','$waktu','$ids','0','$besar','$jenis[kode]')");	
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idbayar' and blth='$blth'"));		
  $sis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));
  mysqli_query($koneksi,"update siswa set saldo='$saldo' where nokartu='$kartu'");
  if(strlen($datax['nama']) > 20){
		$nama = substr($sis['nama'], 0, 20) . " ..";
	}else{
		$nama = $sis['nama'];
	}
  
  $bulan = date('m',strtotime($data['blth']));
	$tahun = date('Y',strtotime($data['blth']));	
    $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);
  $kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$data[idbayar]'"));
    $Total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(bayar)AS jumlah,idsiswa,idbayar,blth from trx_bayar WHERE blth='$data[blth]' AND idsiswa='$data[idsiswa]' AND idbayar='$data[idbayar]'"));
	
  echo "      SMK SADAM CISURUPAN       \n";
  echo "  Jalan Serang RT. 006 RW. 005  \n";
  echo "================================\n";
  echo "    STRUK BUKTI PEMBAYARAN   \n\n";  
  echo "Bulan  : ".$bulane['ket']." ".$tahun."\n";
  echo "Nama   : ".$nama."\n";
  echo "Untuk  : TRX ".$kode['kode']."\n";
  echo "Tgl Byr: ".date('d-m-Y',strtotime($data['tanggal']))."\n";
  echo "Besar  : RP. ".number_format($data['bayar'])."\n";
  echo "Byr Ke : ".$data['ke']."\n";
  echo "Reff   : ".$data['bukti']."\n";
  echo "================================\n";
  echo "Tot Masuk : RP. ".number_format($Total['jumlah'])."\n";
  echo "================================\n";
  echo "        TERIMA KASIH            ";
  echo " Cetak pada ".date('d-m-Y H:i:s')." ";
  
  
   if($data['ke'] != 0){
	   $notif = "Assalamualaikum wr.wb\n\n Kami Sampaikan Informasi bahwa Ananda ".$nama." telah melakukan Pembayaran\n Nama    : ".$kode['nama']."\n Tanggal : ".date('d-m-Y',strtotime($data['tanggal']))."\n Besar   : RP. ".number_format($data['bayar'])."\n Byr Ke  : ".$data['ke']."\n Reff    : ".$data['bukti']."\n\n Tot Masuk : RP. ".number_format($Total['jumlah'])."\n\n Demikian Informasi ini kami sampaikan kepada Orang Tua Siswa sebagai sarana Informasi DIGITAL ".$setting['sekolah']." Pesan ini Tidak Perlu dibalas. Terima Kasih\n\n
   Wassalamualaikum wr.wb.";
	
  
  
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
		  CURLOPT_POSTFIELDS => array('message' => $notif,'number' => $siswa['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);
   }
		}
	}else{
		 echo "GAGAL";
	}
}
}
}

?>