<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	
if ($pg == 'mapel') {
    $tgl = $_POST['tgl'];
    $sql = mysqli_query($koneksi, "SELECT tanggal,idmapel FROM jadwal_refleksi WHERE tanggal='$tgl' GROUP BY idmapel");
		echo "<option value=''>Pilih Mapel</option>";

	while ($data = mysqli_fetch_array($sql)) {
		$pel = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
        echo "<option value='$pel[id]'>$pel[nama_mapel]</option>";
    }
}
	
if ($pg == 'kelas') {
    $tgl = $_POST['tgl'];
	 $mapel = $_POST['mapel'];
    $sql = mysqli_query($koneksi, "SELECT tanggal,kelas FROM jadwal_refleksi WHERE tanggal='$tgl'  GROUP BY kelas");
		echo "<option value=''>Pilih Kelas</option>";

	while ($data = mysqli_fetch_array($sql)) {
		
        echo "<option value='$data[kelas]'>$data[kelas]</option>";
    }
}
if ($pg == 'siswa') {
	 $kelas = $_POST['kelas'];
    $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas'");
		echo "<option value=''>Pilih Siswa</option>";

	while ($data = mysqli_fetch_array($sql)) {
		
        echo "<option value='$data[id_siswa]'>$data[nama]</option>";
    }
}