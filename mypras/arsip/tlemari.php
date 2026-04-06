<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 $smt = $setting['semester'];
if ($pg == 'lemari') {
	 $kode = $_POST['kode'];
     $nama = $_POST['nama'];
     $lokasi = $_POST['lokasi'];
	 
     $result = mysqli_query($koneksi, "INSERT INTO m_lemari(kode,nama,lokasi) VALUES ('$kode','$nama','$lokasi')");
}

if ($pg == 'hapus') {
	 $id = $_POST['id'];
    $result = mysqli_query($koneksi, "DELETE FROM m_lemari WHERE id='$id'");
}

if ($pg == 'edit') {
	 $id = $_POST['id'];
    $kode = $_POST['kode'];
     $nama = $_POST['nama'];
     $lokasi = $_POST['lokasi'];
       $result = mysqli_query($koneksi, "UPDATE m_lemari SET kode='$kode',nama='$nama',lokasi='$lokasi' WHERE id='$id'");

}
