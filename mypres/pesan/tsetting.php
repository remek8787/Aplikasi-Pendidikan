<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'masuksis') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>1]);
}

if ($pg == 'pulangsis') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>2]);
}

if ($pg == 'masukpeg') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>3]);
}

if ($pg == 'pulangpeg') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>4]);
}
if ($pg == 'hps') {
	$exec = mysqli_query($koneksi, "truncate pesan_terkirim");
}

if ($pg == 'masukeksis') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>5]);
}
if ($pg == 'pulangeksis') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>6]);
}
if ($pg == 'masukekpeg') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>7]);
}

if ($pg == 'pulangekpeg') {
    $data = [
'pesan1' => $_POST['pesan1'],
'pesan2' => $_POST['pesan2'],
'pesan3' => $_POST['pesan3'],
'pesan4' => $_POST['pesan4'],
    ];

  update($koneksi, 'm_pesan', $data,['id'=>8]);
}
	?>
            