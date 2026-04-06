<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$kelas = $_POST['kelas'];
$pesan = $_POST['pesan'];

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nowa<>''"); 
while ($data = mysqli_fetch_array($query)) :
$nowa = $data['nowa'];

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
  CURLOPT_POSTFIELDS => array('message' => $pesan,'number' => $nowa),
));


$response = curl_exec($curl);

curl_close($curl);

if($response){
mysqli_query($koneksi,"INSERT INTO pesan_terkirim(idsiswa,tgl,nowa,isi) VALUES ('$data[id_siswa]','$tanggal','$nowa','$pesan')");
}
 endwhile;

?>
