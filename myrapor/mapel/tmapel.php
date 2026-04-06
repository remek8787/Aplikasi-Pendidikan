<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	
    $result = delete($koneksi, 'mapel_rapor', ['id' => $id]);
	if($result){
		$query = "SELECT * FROM mapel_rapor ORDER BY id";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id'];
	 $query2 = "UPDATE mapel_rapor SET id = $no WHERE id = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE mapel_rapor  AUTO_INCREMENT = $no";
mysqli_query($koneksi,$query);
	}
}
if ($pg == 'tambah') {
	
	 $where = [
        'level'   => $_POST['level'],
		'jurusan'   => $_POST['pk'],
		'idmapel'   => $_POST['mapel']		
			];
			
     $data = [
	   'level'   => $_POST['level'],
		'jurusan'   => $_POST['pk'],
		'idmapel'   => $_POST['mapel'],	
		'kelompok'   => $_POST['kelompok'],
		'nourut'   => $_POST['urut']
		];
		
	 $cek = rowcount($koneksi, 'mapel_rapor', $where);
    if ($cek == 0) {		
	$result = insert($koneksi, 'mapel_rapor', $data);
	}
}
if ($pg == 'kelas') {
    $id_level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT kelas FROM siswa WHERE level='" . $id_level . "' GROUP BY kelas");
   echo "<option value=''>Pilih Kelas</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[kelas]'>$data[kelas]</option>";
    }
}
if ($pg == 'notif') {
	$notif = $_POST['notif'];
	mysqli_query($koneksi,"UPDATE pengaturan SET notif='$notif'");
}
if ($pg == 'kelompok') {
	$id = $_POST['id'];
	$data=[
	'kd'=> $_POST['kd'],
	'ket'=> $_POST['ket']
	];
	update($koneksi,'kode',$data,['id'=>$id]);
}