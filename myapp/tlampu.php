<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'status') {
	$id = $_GET['id'];
$led = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM lampu WHERE id='$id'"));
if($led['status']=='ON'){$status='OF';}
if($led['status']=='OF'){$status='ON';}
$data = [
        'status'     => $status
        ];
    $exec = update($koneksi, 'lampu', $data, ['id' => $id]);

}
if ($pg == 'edit') {
	$id = $_POST['id'];

$data = [
        'nama'     => $_POST['nama']
        ];
    $exec = update($koneksi, 'lampu', $data, ['id' => $id]);

}
?>