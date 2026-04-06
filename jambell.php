<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");

$hari = date('D');
$waktu = date('H:i:s');
$waktusandik = date('H:i');

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'jam') :
echo $waktusandik;
endif;
if ($pg == 'bell') :
$query = mysqli_query($koneksi,"SELECT * FROM bell WHERE hari='$hari'");
while ($data = mysqli_fetch_array($query)) :
$jam = date('H:i:s',strtotime($data['jam']));
if($jam==$waktu){
	echo $data['nada'];
}
endwhile;
endif;
if ($pg == 'lanjut') :
$jumbel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bell WHERE hari='$hari' and jam >'$waktu' limit 1"));
if($jumbel==0 ){
	echo "Tidak ada Jadwal";
}
$query = mysqli_query($koneksi,"SELECT * FROM bell WHERE hari='$hari' and jam >'$waktu' limit 1");
while ($data = mysqli_fetch_array($query)) :
if($data['nada'] < 10){$nada = "0".$data['nada'];}
if($data['nada'] > 9){$nada = $data['nada'];}
echo "Next ".$data['jam']." ".$nada;

endwhile;

endif;


?>