<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$tgl =  date('Y-m-d');
$waktu = date('H:i:s');
 $ids = $_POST['ids'];
		$besar = $_POST['besar'];
        $duit = filter_var($besar, FILTER_SANITIZE_NUMBER_INT);
		$peg = fetch($koneksi,'users',['id_user'=>$ids]);
		$saldo = $peg['saldo'];
		$saldomu = $saldo + $duit;
		
		$data = [
		'saldo' =>$saldomu,	
        ];		
	     $exec = update($koneksi, 'users', $data,['id_user'=>$ids]);
$simpeun = mysqli_query($koneksi,"INSERT INTO saldo(tanggal,jam,idpeg,debet,kredit) VALUES('$tgl','$waktu','$ids','$duit','0')");		 
?>