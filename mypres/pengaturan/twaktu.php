<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $idw = $_POST['id'];
    $result = delete($koneksi, 'waktu', ['id' => $idw]);
	if($result){
		$query = "SELECT * FROM waktu ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE waktu SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE waktu  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	$alpha = date('H:i',strtotime($_POST['alpha']));
	$jalpha = $alpha.":00";
      $data = [
	    'hari'     => $_POST['hari'],     
        'masuk'   => $_POST['masuk'],
		'pulang'   => $_POST['pulang'],
		'batas_pulang'   => $_POST['batas_pulang'],
		'masuk_eskul'   => $_POST['masuk_eskul'],
		'pulang_eskul'   => $_POST['pulang_eskul'],
		'batas_eskul'   => $_POST['batas_eskul'],
		'alpha'   => $jalpha,
		'piket_masuk'   => $_POST['piket_masuk']
	    
			];
	$result = insert($koneksi, 'waktu', $data);

}
if ($pg == 'edit') {
	$id = $_POST['id'];
	
	$alpha = date('H:i',strtotime($_POST['alpha']));
	$jalpha = $alpha.":00";
	
         $data = [
        'hari'     => $_POST['hari'],     
        'masuk'   => $_POST['masuk'],
		'pulang'   => $_POST['pulang'],
		'batas_pulang'   => $_POST['batas_pulang'],
		'masuk_eskul'   => $_POST['masuk_eskul'],
		'pulang_eskul'   => $_POST['pulang_eskul'],
		'batas_eskul'   => $_POST['batas_eskul'],
		'alpha'   => $jalpha,
		'piket_masuk'   => $_POST['piket_masuk']
	    
        ];
    $result = update($koneksi, 'waktu', $data, ['id' => $id]);
    
	
}
?>