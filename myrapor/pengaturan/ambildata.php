<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'pk') {
    $id_level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT level,jurusan FROM kelas WHERE level='" . $id_level . "' GROUP BY jurusan");
   echo "<option value=''>Pilih Jurusan</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[jurusan]'>$data[jurusan]</option>";
    }
}