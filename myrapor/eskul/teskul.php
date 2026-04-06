<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
	
$cek = rowcount($koneksi, 'peskul', ['idsiswa' => $_POST['nis'],'eskul'=>$_POST['eskul']]);
    if ($cek > 0) {
    echo "gagal";
    } else {
     $data = [
	    'idsiswa'     => $_POST['nis'],
        'eskul'     => $_POST['eskul'],
        'guru'   => $_POST['guru'],
		 'kelas'   => $_POST['kelas'],
		 'smt'=>$semester,
		 'tp'=>$tapel
		];
			$exec = insert($koneksi, 'peskul', $data);
			echo "OK";                   		
	  }
        
}
  if ($pg == 'nilai') {
	 $ids = $_POST['nis'];
    $eskul = $_POST['eskul'];
	$nilai = $_POST['nilai'];
	$ket = $_POST['ket'];
	
	$exec = mysqli_query($koneksi,"UPDATE peskul SET nilai='$nilai',ket='$ket',smt='$semester',tp='$tapel' WHERE idsiswa='$ids' AND eskul='$eskul'");
			                  		
}
        
if ($pg == 'guru') {
    $mapel = $_POST['eskul'];
    $sql = mysqli_query($koneksi, "SELECT * FROM m_eskul WHERE eskul='$mapel'");
    while ($data = mysqli_fetch_array($sql)) {
		$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[guru]'"));
        echo "<option value='$data[guru]'>$peg[nama]</option>";
    }
}
?>