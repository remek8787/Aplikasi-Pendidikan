<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus') {
    $id = $_POST['id'];
	$jdw = fetch($koneksi,'jadwal_mengajar',['id_jadwal'=>$id]);
	$result = delete($koneksi, 'lingkup', ['guru' => $jdw['guru'],'mapel'=>$jdw['mapel']]);
	$result = delete($koneksi, 'tujuan', ['guru' => $jdw['guru'],'mapel'=>$jdw['mapel']]);
	$result = delete($koneksi, 'deskripsi', ['guru' => $jdw['guru'],'mapel'=>$jdw['mapel']]);
    $result = delete($koneksi, 'jadwal_mengajar', ['id_jadwal' => $id]);
	if($result){
		$query = "SELECT * FROM jadwal_mengajar ORDER BY id_jadwal";
       $hasil = mysqli_query($query);
 $no = 1;
 
while ($data  = mysqli_fetch_array($hasil))
{
	 $id = $data['id_jadwal'];
	 $query2 = "UPDATE jadwal_mengajar SET id_jadwal = $no WHERE id_jadwal = '$id'";
   mysqli_query($koneksi,$query2);
 
   $no++;   
	}
	$query = "ALTER TABLE jadwal_mengajar  AUTO_INCREMENT = $no";
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
		'guru'   => $_POST['guru'],
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