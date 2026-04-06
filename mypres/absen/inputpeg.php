<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$tanggalmu = date('Y-m-d');
$tanggal = $_POST['tanggal'];
$bulan = $_POST['bulan'];	
$tahun = $_POST['tahun'];	
$ket = $_POST['ket'];	
$ids = $_POST['idguru'];
$level = $_POST['level'];

$count = count($_POST['idguru']);
$sql   = "INSERT INTO absensi(idpeg,tanggal,level,ket,bulan,tahun) VALUES ";
for( $i=0; $i < $count; $i++ )
	
{
$sql .= "('{$ids[$i]}','{$tanggal[$i]}','{$level[$i]}','{$ket[$i]}','{$bulan[$i]}','{$tahun[$i]}')";
$sql .= ",";
if($ket[$i]=='I'){$keter[$i]='IZIN';}
if($ket[$i]=='A'){$keter[$i]='ALPHA';}
if($ket[$i]=='S'){$keter[$i]='SAKIT';}
$siswa = fetch($koneksi,'users',['id_user'=>$ids[$i]]);
$pesan = "INFORMASI ABSENSI DIGITAL\n\n Kami Informasikan Bahwa : \n*".$siswa['nama'].
         "*\n\nHari ini Tanggal ".$tanggalmu." telah absen dengan keterangan *".$keter[$i]."*\n\nInformasi ini dikirim Otomatis oleh Server Sekolah. Tidak Perlu dibalas\n\nTerima Kasih";	
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
  CURLOPT_POSTFIELDS => array('message' =>$pesan,'number' => $setting['nowa']),
));

$response = curl_exec($curl);
curl_close($curl);


}
$sql = rtrim($sql,",");
$exec = $koneksi->query($sql);


 

 
?>