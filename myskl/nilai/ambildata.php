<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'pk') {
     $kelas = $_POST['kelas'];	
     $query = mysqli_query($koneksi, "SELECT kelas,jurusan FROM kelas where kelas='$kelas'");           
     echo "<option value=''>Pilih Jurusan</option>";
     while ($data = mysqli_fetch_array($query)) {
     echo "<option value='$data[jurusan]'>$data[jurusan]</option>";
    }
}
if ($pg == 'mapel') {
     $kelas = $_POST['kelas'];	
	 $pk = $_POST['pk'];
	 $lvl = fetch($koneksi,'kelas',['kelas'=>$kelas]);
	 $level = $lvl['level'];
     $query = mysqli_query($koneksi, "SELECT idmapel,jurusan FROM mapel_rapor where level='$level' and jurusan='$pk'");           
     echo "<option value=''>Pilih Mapel</option>";
     while ($data = mysqli_fetch_array($query)) {
	$pel = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);	 
     echo "<option value='$data[idmapel]'>$pel[nama_mapel]</option>";
    }
}
