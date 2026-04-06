<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idu = $_POST['id'];
    $exec = delete($koneksi, 'sk_peg', ['id' => $idu]);
	if($exec){
	$query = "SELECT * FROM sk_peg ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE sk_peg SET id = $no WHERE id = '$id'";
     mysqli_query($koneksi,$query2);
     $no++;   
	}
	$query = "ALTER TABLE sk_peg  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	 $kelas = implode(', ',$_POST['kelas']);
	  $mapel = implode(', ',$_POST['mapel']);
	   $level = implode(', ',$_POST['level']);
	    $jml_data = count($_POST['kelas']);
		
     $data = [
	    'idpeg'     => $_POST['idpeg'],
        'kode'     => $_POST['kode'],
        'mapel'   => $mapel,
		'kelas'   => $kelas,
		'level'   => $level,
		'idsk'   => $_POST['idsk'],
        'tp'  => $_POST['tp'],
		'smt'  => $_POST['smt'],
		'jenis'  => $_POST['jenis'],
		'jjm'  => $_POST['jjm'] * $jml_data
        
			];
		$exec = insert($koneksi, 'sk_peg', $data);	
}
if ($pg == 'eskul') {
	 $kelas = implode(', ',$_POST['kelas']);
	  $mapel = implode(', ',$_POST['mapel']);
     $data = [
	    'idpeg'     => $_POST['idpeg'],
        'kode'     => $_POST['kode'],
       'eskul'   => $mapel,
		'kelas'   => $kelas,
		'idsk'   => $_POST['idsk'],
        'tp'  => $_POST['tp'],
		'smt'  => $_POST['smt'],
		 'lainnya'     => $_POST['kode'],
		'jjm_tugas'  => $_POST['jjm']
			];
		$exec = insert($koneksi, 'sk_peg', $data);	
}
if ($pg == 'lainnya') {
	 $kelas = implode(', ',$_POST['kelas']);
     $data = [
	    'idpeg'     => $_POST['idpeg'],
        'kode'     => $_POST['kode'],
		'idsk'   => $_POST['idsk'],
        'tp'  => $_POST['tp'],
		'smt'  => $_POST['smt'],
		'kelas'   => $kelas,
		 'lainnya'     => $_POST['kode'],
		 'jjm_tugas'  => $_POST['jjm']
			];
		$exec = insert($koneksi, 'sk_peg', $data);	
}
?>