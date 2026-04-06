<?php
require("../../config/koneksi.php");
require("../../config/function.php");
require("../../config/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'tambah') {
  $where = [
  'idpeg' => $_POST['id'],		
    ];
    $data = [
'idpeg' => $_POST['id'],
'nokartu' => $_POST['nokartu'],
'nama' => $_POST['nama'],
'level' =>'pegawai'
    ];
	
 $cek = rowcount($koneksi, 'datareg', $where);
            if ($cek == 0) {
				mysqli_query($koneksi, "update users SET sts_rfid='1' WHERE id_user='$_POST[id]'");
            $exec = insert($koneksi, 'datareg', $data);
            echo $exec;
if ($exec){
mysqli_query($koneksi, "delete from tmpreg");
			}
		}

}
if ($pg == 'hapus_peg') {
    $id = $_POST['id'];
	mysqli_query($koneksi, "update users SET sts_rfid='0' WHERE id_user='$_POST[id]'");
    delete($koneksi, 'datareg', ['idpeg' => $id]);
}
if ($pg == 'hapus_siswa') {
    $id = $_POST['id'];
   
	mysqli_query($koneksi, "update siswa SET sts_rfid='0' WHERE id_siswa='$_POST[id]'");
	 delete($koneksi, 'datareg', ['idsiswa' => $id]);
}
if ($pg == 'siswa') {
  $where = [
  'nokartu' => $_POST['nokartu'],		
    ];
	
    $data = [
'idsiswa' => $_POST['id'],
'nokartu' => $_POST['nokartu'],
'nama' => $_POST['nama'],
'level' =>'siswa'
    ];
	
 $cek = rowcount($koneksi, 'datareg', $where);
            if ($cek == 0) {
            $exec = insert($koneksi, 'datareg', $data);
            echo $exec;
if ($exec){
mysqli_query($koneksi, "delete from tmpreg");
mysqli_query($koneksi, "update siswa SET sts_rfid='1' WHERE id_siswa='$_POST[id]'");
			}
		}

}