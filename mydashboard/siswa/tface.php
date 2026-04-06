<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

   (isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'hapus') {
    $id = $_POST['id'];
    $reg = fetch($koneksi,'datareg',['id'=>$id]);
	
	if($reg['level']=='siswa'){
		mysqli_query($koneksi, "update siswa SET sts='0' WHERE id_siswa='$reg[idsiswa]'");
	}
	if($reg['level']=='pegawai'){
		mysqli_query($koneksi, "update pegawai SET sts='0' WHERE id_pegawai='$reg[idpeg]'");
	}
	
	$gambar = glob('../../data/'.$reg['folder'].'/*'); 
  foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
    } 
	rmdir('../../data/'.$reg['folder']);
	
	
	 delete($koneksi, 'datareg', ['id' => $id]);
}


?>
