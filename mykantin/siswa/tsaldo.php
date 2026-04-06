<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$tgl =  date('Y-m-d');
$waktu = date('H:i:s');
 $ids = $_POST['ids'];
		$besar = $_POST['besar'];
        $duit = filter_var($besar, FILTER_SANITIZE_NUMBER_INT);
		$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
		$saldo = $siswa['saldo'];
		$saldomu = $saldo + $duit;
		
		$data = [
		'saldo' =>$saldomu,	
        ];		
	     $exec = update($koneksi, 'siswa', $data,['id_siswa'=>$ids]);
$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idsiswa,debet,kredit) VALUES('$tgl','$waktu','$ids','$duit','0')");		 
?>