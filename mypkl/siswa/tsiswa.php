<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'pkl_siswa', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM pkl_siswa ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE pkl_siswa SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE pkl_siswa  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	$kelas = $_POST['kelas'];
	$pk = $_POST['jurusan'];
    $ids = $_POST['idsiswa'];
    $dudi = $_POST['dudi'];
	$count = count($_POST['idsiswa']);
		for( $i=0; $i < $count; $i++ ){		
		$simpan = mysqli_query($koneksi,"INSERT INTO pkl_siswa(idsiswa,kelas,jurusan,dudi) VALUES('$ids[$i]','$kelas[$i]','$pk[$i]','$dudi')");	
		}

}



?>