<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'model') {
    $idb = $_POST['idb'];
	
    $data = mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$idb'");           
    while ($kel = mysqli_fetch_array($data)) {
	if($kel['model']==1){
		$model = 'Sekali Bayar';
	}else{
		$model = 'Bulanan';
	}
                echo "<option value='$kel[model]'>$model</option>";
            }
}

if ($pg == 'bayar') {
	
$tanggalmu = date('d M Y');
$blth= date('mY');
$bulan = date('m');
$tahun = date('Y');	
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bulan]);
$ids = $_POST['idsiswa'];
$idbayar = $_POST['idb'];
$besar = $_POST['besar'];
 $duit = filter_var($besar, FILTER_SANITIZE_NUMBER_INT);
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));
$kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$idbayar'"));
$query = mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' AND blth='$blth' and idbayar='$idbayar'");
$cek = mysqli_num_rows($query);
if ($cek == 0) {
	
	$trx = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' and idbayar='$idbayar'"));
	$ke = $trx + 1;
	$bukti = date('YmdHis').'-'.$ke;
	$simpan = mysqli_query($koneksi,"INSERT INTO trx_bayar(tanggal,blth,idsiswa,kelas,idbayar,bayar,ke,bukti) VALUES('$tanggal','$blth','$ids','$siswa[kelas]','$idbayar','$duit','$ke','$bukti')");
	if($simpan){
	$datax = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM trx_bayar WHERE idsiswa='$ids' ORDER BY id DESC LIMIT 1"));
$pesan = "STRUK BUKTI PEMBAYARAN\n\n Bulan  : " .$bulane['ket']." ".$tahun."\n Nama  : ".$siswa['nama']."\n Untuk  : TRX ".$kode['kode']."\n Tgl Byr: ".$tanggalmu."\n Besar  : RP. ".number_format($datax['bayar'])."\n Byr Ke : ".$datax['ke']."\n Reff   : ".$datax['bukti']."\n\n Demikian INFORMASI PAYMENT DIGITAL ".$setting['sekolah']." Kami sampaikan kepada Orang Tua Siswa, agar menjadi sarana monitoring terhadap Putra Putri Bapak/Ibu, Terima Kasih. Tdak Perlu dibalas";
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
  CURLOPT_POSTFIELDS => array('message' =>$pesan,'number' => $siswa['nowa']),
));

$response = curl_exec($curl);
curl_close($curl);
	}
}
}

?>