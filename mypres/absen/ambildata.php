<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	
if ($pg == 'jadwal') {
	$hari = date('D');
    $kelas = $_POST['kelas'];
    $sql = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar WHERE kelas='$kelas' and hari='$hari'");
		echo "<option value=''>Pilih Mapel</option>";
	while ($data = mysqli_fetch_array($sql)) {
		$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
		$guru = fetch($koneksi,'users',['id_user'=>$data['guru']]);
        echo "<option value='$data[id_jadwal]'>$mpl[kode] - $guru[nama]</option>";
    }
}
