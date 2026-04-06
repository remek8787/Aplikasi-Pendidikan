<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");


$pesan = $_POST['pesan'];
if($pesan=='lampu satu hidup' or $pesan=='lampu 1 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='1'");
}
if($pesan=='lampu satu mati' or $pesan=='lampu 1 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='1'");
}
if($pesan=='lampu dua hidup' or $pesan=='lampu 2 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='2'");
}
if($pesan=='lampu dua mati' or $pesan=='lampu 2 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='2'");
}

if($pesan=='lampu tiga hidup' or $pesan=='lampu 3 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='3'");
}
if($pesan=='lampu tiga mati' or $pesan=='lampu 3 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='3'");
}

if($pesan=='lampu empat hidup' or $pesan=='lampu 4 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='4'");
}
if($pesan=='lampu empat mati' or $pesan=='lampu 4 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='4'");
}
if($pesan=='lampu lima hidup' or $pesan=='lampu 5 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='5'");
}
if($pesan=='lampu lima mati' or $pesan=='lampu 5 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='5'");
}
if($pesan=='lampu enam hidup' or $pesan=='lampu 6 hidup'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='6'");
}
if($pesan=='lampu enam mati' or $pesan=='lampu 6 mati'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='6'");
}
?>