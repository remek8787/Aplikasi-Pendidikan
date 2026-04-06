<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
	
    $result = delete($koneksi, 'refleksi', ['id' => $idu]);
	if($result){
		$query = "SELECT * FROM refleksi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE refleksi SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE refleksi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'jadwal') {
	
     $data = [
	   
        'kelas'   => $_POST['kelas'],
        'idmapel'   => $_POST['mapel'],
		'idguru'   => $_POST['guru'],
		'tanggal'   => $_POST['tgl']
		
			];
		
	$result = insert($koneksi, 'jadwal_refleksi', $data);
	
}
if ($pg == 'tambah') {
	
     $data = [
	    'idjadwal'   => $_POST['idj'],
        'kelas'   => $_POST['kelas'],
        'idmapel'   => $_POST['mapel'],
		'idguru'   => $_POST['guru'],
		'soal'   => $_POST['soal']
		
			];
		
	$result = insert($koneksi, 'refleksi', $data);
	
}
if ($pg == 'nilai') {
	
     $data = [	   
        'idsiswa'   => $_POST['ids'],
        'mapel'   => $_POST['mapel'],
		'tanggal'   => $_POST['tgl'],
		'nilai'   => $_POST['nilai']		
			];
	 $where = [	   
        'idsiswa'   => $_POST['ids'],
        'idmapel'   => $_POST['mapel'],
		'tanggal'   => $_POST['tgl'],	
			];	
	$result = insert($koneksi, 'nilai_refleksi', $data);
	$result = delete($koneksi, 'jawaban_refleksi', $where);
	
}
if ($pg == 'hapusjadwal') {
    $idu = $_POST['id'];
	
    $result = delete($koneksi, 'jadwal_refleksi', ['id' => $idu]);
	$result = delete($koneksi, 'refleksi', ['idjadwal' => $idu]);
	if($result){
		$query = "SELECT * FROM jadwal_refleksi ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE jadwal_refleksi SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE jadwal_refleksi  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}