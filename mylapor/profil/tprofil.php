<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'profil_smk', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM profil_smk ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE profil_smk SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE profil_smk  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tunit') {
	
        $data = [
       'nama'     => $_POST['usaha'],
        'bidang'   => $_POST['bidang'],
		 'siup'   => $_POST['siup'],
		  'omset'   => $_POST['omset'],
		  'kode' =>'UP'
        ];
   
	$simpan = insert($koneksi, 'profil_smk', $data);
	
}
if ($pg == 'tbursa') {
	
        $data = [
       'nama'     => $_POST['dudi'],
        'tanggal'   => $_POST['tgl'],
		 'tahun'   => $_POST['tahun'],
		  
		  'kode' =>'BK'
        ];
   
	$simpan = insert($koneksi, 'profil_smk', $data);
	
}
if ($pg == 'tuji') {
	
        $data = [
       'nama'     => $_POST['dudi'],
        'tanggal'   => $_POST['tgl'],
		 'tahun'   => $_POST['tahun'],
		  
		  'kode' =>'UK'
        ];
   
	$simpan = insert($koneksi, 'profil_smk', $data);
	
}
?>