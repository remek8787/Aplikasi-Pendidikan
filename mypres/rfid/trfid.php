<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';


if ($pg == 'tambah') {
	$jnada = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM datareg"));
	$nada = 26 + $jnada;
	if($_POST['id']<>''):
		$where = [
		'idpeg' => $_POST['id'],		
				];
 $data = [
		'idpeg' => $_POST['id'],
		'nokartu' => $_POST['nokartu'],
		'nama' => $_POST['nama'],
		'level' =>'pegawai',
		'nada' => $nada
		];
	
 $cek = rowcount($koneksi, 'datareg', $where);
    if ($cek == 0) {
		mysqli_query($koneksi, "update users SET sts='1' WHERE id_user='$_POST[id]'");
		$result = insert($koneksi, 'datareg', $data);          
			if ($result){
			mysqli_query($koneksi, "delete from tmpreg");
			}
		}
	
		endif;
}

if ($pg == 'hapus') {
    $id = $_POST['id'];
    $reg = fetch($koneksi,'datareg',['id'=>$id]);
	if($reg['level']=='siswa'){
		mysqli_query($koneksi, "update siswa SET sts='0',saldo='0',nokartu=NULL WHERE id_siswa='$reg[idsiswa]'");
		 delete($koneksi, 'absensi', ['idsiswa' => $reg['idsiswa']]);
		 delete($koneksi, 'absensi_eskul', ['idsiswa' => $reg['idsiswa']]);
		
	}
	if($reg['level']=='pegawai'){
		mysqli_query($koneksi, "update users SET sts='0' WHERE id_user='$reg[idpeg]'");
		delete($koneksi, 'absensi', ['idpeg' => $reg['idpeg']]);
		delete($koneksi, 'absensi_eskul', ['idpeg' => $reg['idpeg']]);
	}
	 delete($koneksi, 'datareg', ['id' => $id]);
}

if ($pg == 'siswa') {
	$jnada = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM datareg"));
	$nada = 26 + $jnada;
if($_POST['id']<>''):
  $where = [
		'nokartu' => $_POST['nokartu'],		
			];
	
 $data = [
		'idsiswa' => $_POST['id'],
		'nokartu' => $_POST['nokartu'],
		'nama' => $_POST['nama'],
		'level' =>'siswa',
		'nada' => $nada
		];
	
 $cek = rowcount($koneksi, 'datareg', $where);
	 if ($cek == 0) {
	 $result = insert($koneksi, 'datareg', $data);
	  echo"OK";
		if ($result){
			mysqli_query($koneksi, "update siswa SET sts='1',nokartu='$_POST[nokartu]' WHERE id_siswa='$_POST[id]'");
			mysqli_query($koneksi, "delete from tmpreg");
			
				}
			}
	
	endif;
}