<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");


(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'guru') {
	$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$_POST[usr]'"));
    $level = $_POST['level'];
	if($user['level']=='admin'):
    $sql = mysqli_query($koneksi, "SELECT tingkat,guru FROM jadwal_mengajar WHERE tingkat='$level' GROUP BY guru");
   elseif($user['level']=='guru'):
    $sql = mysqli_query($koneksi, "SELECT tingkat,guru FROM jadwal_mengajar WHERE tingkat='$level' and guru ='$user[id_user]' GROUP BY guru");
   endif;
   echo "<option value=''>Pilih Guru</option>";
    while ($data = mysqli_fetch_array($sql)) {
		$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
        echo "<option value='$data[guru]'>$peg[nama]</option>";
    }
}
if ($pg == 'mapel') {
	$guru = $_POST['guru'];
    $level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT tingkat,guru,mapel FROM jadwal_mengajar WHERE tingkat='$level' and guru ='$guru' GROUP BY mapel");
   echo "<option value=''>Pilih Mapel</option>";
    while ($data = mysqli_fetch_array($sql)) {
		$pel = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
        echo "<option value='$data[mapel]'>$pel[nama_mapel]</option>";
    }
}