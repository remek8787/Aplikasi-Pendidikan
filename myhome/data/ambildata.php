<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
	
if ($pg == 'jurusan') {
    $level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT jurusan,level FROM siswa WHERE level='" . $level . "' GROUP BY jurusan");
		echo "<option value=''>Pilih Jurusan</option>";
		echo "<option value='semua'>semua</option>";
	while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[jurusan]'>$data[jurusan]</option>";
    }
}
