<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'kelas') {
	 $guru = $_POST['guru'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas FROM jadwal_mengajar where guru='$guru'  GROUP BY kelas");           
     echo "<option value=''>Pilih Kelas</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[kelas]'>$kls[kelas]</option>";
    }
}

if ($pg == 'mapel') {
	 $guru = $_POST['guru'];
	 $kelas = $_POST['kelas'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas,mapel FROM jadwal_mengajar where guru='$guru'  and kelas='$kelas' GROUP BY mapel");           
     echo "<option value=''>Pilih Mapel</option>";
     while ($m = mysqli_fetch_array($data)) {
	$mpl = fetch($koneksi,'mapel',['id'=>$m['mapel']]);	 
     echo "<option value='$m[mapel]'>$mpl[nama_mapel]</option>";
    }
}

if ($pg == 'level') {
	 $guru = $_POST['guru'];
     $data = mysqli_query($koneksi, "SELECT guru,tingkat FROM jadwal_mengajar where guru='$guru' GROUP BY tingkat");           
     echo "<option value=''>Pilih Tingkat</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[tingkat]'>$kls[tingkat]</option>";
    }
}

if ($pg == 'elemen') {
	 $guru = $_POST['guru'];
	 $mapel = $_POST['mapel'];
     $data = mysqli_query($koneksi, "SELECT * FROM cp_elemen where guru='$guru' and mapel='$mapel'");           
     echo "<option value=''>Pilih Pertemuan ke</option>";
     while ($m = mysqli_fetch_array($data)) {
	$mpl = fetch($koneksi,'atp',['idel'=>$m['id_elemen']]);	 
     echo "<option value='$m[id_elemen]'>$mpl[ke]</option>";
    }
}