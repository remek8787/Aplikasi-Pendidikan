<?php
require("../konek/koneksi.php");
require("../konek/function.php");
$waktu = date('Y-m-d H:i:s');
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = mysqli_escape_string($koneksi, $_POST['password']);
$lvl = mysqli_escape_string($koneksi, $_POST['level']);
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' and level='$lvl'");
$cek = mysqli_num_rows($query);
$user = mysqli_fetch_array($query);
if ($cek <> 0) {
    if ($user['level'] == 'admin') {
        if (!password_verify($password, $user['password'])) {
            echo "nopass";
        } else {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['level'] = 'admin';
		mysqli_query($koneksi, "INSERT INTO log (id_user,type,text,date,level) VALUES ('$user[id_user]','login','Masuk','$waktu','admin')");
            echo "ok";
			
        }
 }elseif ($user['level'] == 'guru') {

        if ($password == $user['password']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['level'] = 'guru';
			mysqli_query($koneksi, "INSERT INTO log (id_user,type,text,date,level) VALUES ('$user[id_user]','login','Masuk','$waktu','guru')");
            echo "ok";
		
		} else {
            echo "nopass";
        }
	 }
	 elseif ($user['level'] == 'awas') {

        if ($password == $user['password']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['level'] = 'awas';
			mysqli_query($koneksi, "INSERT INTO log (id_user,type,text,date,level) VALUES ('$user[id_user]','login','Masuk','$waktu','pengawas')");
            echo "ok";
		
		} else {
            echo "nopass";
        }
	 }
	 
} elseif ($cek == 0) {
    echo "td";
}