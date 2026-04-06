<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'pkl_pembimbing', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM pkl_pembimbing ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE pkl_pembimbing SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE pkl_pembimbing  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	$kelas = $_POST['kelas'];
    $idpeg = $_POST['guru'];
    $dudi = $_POST['dudi'];
	 $intruk = $_POST['instruktur'];
	
mysqli_query($koneksi,"INSERT INTO pkl_pembimbing(idpeg,kelas,dudi,instruktur) VALUES('$idpeg','$kelas','$dudi','$intruk')");
}

if ($pg == 'edit') {
	$id = $_POST['id'];
    $data = [
	    'idpeg'     => $_POST['guru'],
        'kelas'     => $_POST['kelas'],
        'dudi'   => $_POST['dudi'],
	     'instruktur'   => $_POST['instruktur']
		 
			];
	$simpan = update($koneksi, 'pkl_pembimbing', $data,['id'=>$id]);
}

?>