<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");


$pesan = $_POST['pesan'];
if($pesan=='lampu1on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='1'");
}
if($pesan=='lampu1of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='1'");
}
if($pesan=='lampu2on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='2'");
}
if($pesan=='lampu2of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='2'");
}

if($pesan=='lampu3on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='3'");
}
if($pesan=='lampu3of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='3'");
}

if($pesan=='lampu4on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='4'");
}
if($pesan=='lampu4of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='4'");
}
if($pesan=='lampu5on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='5'");
}
if($pesan=='lampu5of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='5'");
}
if($pesan=='lampu6on'){
	mysqli_query($koneksi,"UPDATE lampu set status='ON' where id='6'");
}
if($pesan=='lampu6of'){
	mysqli_query($koneksi,"UPDATE lampu set status='OF' where id='6'");
}
?>