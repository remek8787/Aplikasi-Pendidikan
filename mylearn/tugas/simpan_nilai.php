
<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
cek_session_guru();
$kode = $_POST['id'];
$jawab = fetch($koneksi,'jawaban_tugas',['id_jawaban' => $kode]);
$tugas = fetch($koneksi,'tugas',['id_tugas' => $jawab['id_tugas']]);
$nilai = $_POST['nilai' . $kode];

$query = mysqli_query($koneksi, "UPDATE jawaban_tugas set nilai='$nilai' where id_jawaban = '$kode'");
echo mysqli_error($koneksi);
echo "nilai berhasil disimpan";

?>