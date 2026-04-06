<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	
if ($pg == 'nilai') {
    $kode = $_POST['aspek'];
    $sql = mysqli_query($koneksi, "SELECT * FROM pkl_mnilai WHERE kode='" . $kode . "'");
		echo "<option value=''>Pilih Penilaian</option>";
	
	while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id]'>$data[aspek]</option>";
    }
}
if ($pg == 'dudi') {
    $kelas = $_POST['kelas'];
    $sql = mysqli_query($koneksi, "SELECT kelas,dudi FROM pkl_siswa WHERE kelas='" . $kelas . "' GROUP BY dudi");
		echo "<option value=''>Pilih Lokasi</option>";
	
	while ($data = mysqli_fetch_array($sql)) {
		$dudi = fetch($koneksi,'pkl_dudi',['id'=>$data['dudi']]);
        echo "<option value='$dudi[id]'>$dudi[nama_dudi]</option>";
    }
}
