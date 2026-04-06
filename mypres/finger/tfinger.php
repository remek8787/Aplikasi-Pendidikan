<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'pegawai') {
if($_POST['id']<>''):
$iduser = $_POST['id'];
 $idjari = $_POST['idjari'];
   
   $data = [
		'idpeg' => $_POST['id'],
		'idjari' => $_POST['idjari'],
		'serial' => $_POST['serial'],
		'nama' => $_POST['nama'],
		'level' =>'pegawai'
    ];
	
 $exec = insert($koneksi, 'datareg', $data);
 echo"OK";
	if ($exec){
	mysqli_query($koneksi, "update users SET sts='1',idjari='$idjari' WHERE id_user='$iduser'");
			}		
	endif;
}

if ($pg == 'hapus') {
	$id = $_POST['id'];
	$reg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg  WHERE id='$id'"));
	
	$data = [
		'idjari' => $reg['idjari'],
		'level' => $reg['level'],
		'nama' => $reg['nama'],
		'serial' => $reg['serial']
    ];
	
	$exec = insert($koneksi, 'temp_finger', $data);
	
	if($reg['level']=='pegawai'):				          
   
    mysqli_query($koneksi, "update users SET sts='0',idjari=NULL WHERE idjari='$reg[idjari]'");
	elseif($reg['level']=='siswa'):
	mysqli_query($koneksi, "update siswa SET sts='0',idjari=NULL WHERE idjari='$reg[idjari]'");
	
	endif;
    delete($koneksi, 'datareg', ['id' => $id]);
	
}

if ($pg == 'siswa') {
	if($_POST['id']<>''):
	$ids = $_POST['id'];
	$idjari = $_POST['idjari'];
	
	$data = [
		'idsiswa' => $_POST['id'],
		'idjari' => $_POST['idjari'],
		'serial' => $_POST['serial'],
		'nama' => $_POST['nama'],
		'level' =>'siswa'
		];

	$exec = insert($koneksi, 'datareg', $data);
	echo"OK";
	
	if ($exec){
	mysqli_query($koneksi, "update siswa SET sts='1',idjari='$idjari' WHERE id_siswa='$ids'");
			}
		
			endif;
}