<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'kelas') {
    $level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT kelas,level FROM siswa WHERE level='" . $level . "' GROUP BY kelas");
    echo "<option value=''>Pilih Rombel</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[kelas]'>$data[kelas]</option>";
    }
}
if ($pg == 'tambah') {
   $ids=$_POST['ids'];
   $kelas=$_POST['kelas'];
   $proyek=$_POST['proyek'];
   $ketproyek=$_POST['ketproyek'];
   $nilai=$_POST['nilai'];
   $smt=$_POST['smt'];
   $count = count($_POST['kelas']);
$sql   = "INSERT INTO nilai_proyek(idsiswa,kelas,idproyek,proyek,nilai,semester) VALUES ";
for( $i=0; $i < $count; $i++ )
{
$sql .= "('{$ids[$i]}','{$kelas[$i]}','{$proyek[$i]}','{$ketproyek[$i]}','{$nilai[$i]}','{$smt[$i]}')";
$sql .= ",";
}
$sql = rtrim($sql,",");
$exec = $koneksi->query($sql);

echo $exec;
}

