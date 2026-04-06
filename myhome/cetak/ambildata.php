<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'kelas') {
    $id_level = $_POST['tingkat'];
    $sql = mysqli_query($koneksi, "SELECT level,kelas FROM siswa WHERE level='" . $id_level . "' GROUP BY kelas");
    echo "<option value=''>Pilih Kelas</option>";
   while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[kelas]'>$data[kelas]</option>";
    }
}

if ($pg == 'ambil_ruang') {
    $sql = mysqli_query($koneksi, "SELECT ruang FROM siswa  GROUP BY ruang");
    echo "<option value=''>Pilih Ruang</option>";
    while ($ruang = mysqli_fetch_array($sql)) {
        echo "<option value='$ruang[ruang]'>$ruang[ruang]</option>";
    }
}
if ($pg == 'ambilkelas') {
    $id_bank = $_POST['mapel_id'];
	$bank = fetch($koneksi,'banksoal',['id_bank'=>$id_bank]);
	$level = $bank['level'];
	$jurusan = $bank['pk'];
    $ruang = $_POST['ruang'];
    $sesi = $_POST['sesi'];
     $data = mysqli_query($koneksi, "SELECT kelas,sesi,ruang,level FROM siswa WHERE  ruang='$ruang' and sesi='$sesi' and level='$level'  GROUP BY kelas");
            
            echo "<option value=''>Pilih Kelas</option>";
            while ($kelas = mysqli_fetch_array($data)) {
                echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
            }
        
}
if ($pg == 'ambil_sesi') {
    $ruang = $_POST['ruang'];
    $sql = mysqli_query($koneksi, "SELECT sesi,ruang FROM siswa WHERE ruang ='$ruang' GROUP BY sesi");
    echo "<option value=''>Pilih Sesi</option>";
    while ($sesi = mysqli_fetch_array($sql)) {
        echo "<option value='$sesi[sesi]'>$sesi[sesi]</option>";
    }
}
