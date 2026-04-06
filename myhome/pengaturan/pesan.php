<?php
require "../../config/koneksi.php";
require "../../config/function.php";
require "../../config/crud.php";
$nowa = $_POST['nowa'];
$pesan = $_POST['pesan'];
$sender = $_POST['sender'];
$waktu = date('d M Y H:i:s');

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
echo $response;
 if($response){
	$exec = mysqli_query($koneksi,"INSERT INTO pesan_terkirim(waktu,nowa,isi,sender) VALUES('$waktu','$nowa','$pesan','$sender')"); 
 }

?>
