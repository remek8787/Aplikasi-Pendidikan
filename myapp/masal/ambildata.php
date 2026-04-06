<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'siswa') {	
$kelas = $_POST['kelas'];
     $data = mysqli_query($koneksi, "SELECT id_siswa,kelas,nama,nowa_ortu FROM siswa where kelas='$kelas' and nowa_ortu<>''");           
     echo "<option value=''>Pilih Siswa</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[id_siswa]'>ORTU $kls[nama]</option>";
    }
}
