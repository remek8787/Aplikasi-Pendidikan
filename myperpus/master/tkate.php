<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'm_buku', ['idm' => $id]);
	if($exec){
		$query = "SELECT * FROM m_buku ORDER BY idm";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['idm'];
	 $query2 = "UPDATE m_buku SET idm = $no WHERE idm = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE m_buku  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $cek = rowcount($koneksi, 'm_buku', ['kategori' => $_POST['kate']]);
    if ($cek > 0) {
        echo "gagal";
    } else {
   $data = [
	    'kategori'     => $_POST['kate'],
        'rak'     => $_POST['rak']
       
			];
			$exec = insert($koneksi, 'm_buku', $data);	                   		
	  }
}
if ($pg == 'edit') {
	$idm = $_POST['idm'];
    
        $data = [
       'kategori'     => $_POST['kate'],
        'rak'     => $_POST['rak']
        ];
    
   
    $exec = update($koneksi, 'm_buku', $data, ['idm' => $idm]);
    echo $exec;
	
}

?>