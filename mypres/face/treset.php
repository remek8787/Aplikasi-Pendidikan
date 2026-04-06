<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

unlink('../../neural.json');
$from = '../../json/neural.json'; 
$to = '../../neural.json'; 
$kopi = copy($from,$to) ; 
$query = mysqli_query($koneksi, "SELECT * FROM datareg"); 
	while ($data = mysqli_fetch_array($query)){
		$gambar = glob('../../data/'.$data['folder'].'/*'); 
  foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
    } 
	rmdir('../../data/'.$data['folder']);
	}
	

$exec = mysqli_query($koneksi, "update users set sts='0',nokartu=NULL,idjari=NULL where level<>'admin'");
$exec = mysqli_query($koneksi, "DELETE FROM datareg WHERE level='pegawai'");
$exec = mysqli_query($koneksi, "truncate tmpface");



	
?>