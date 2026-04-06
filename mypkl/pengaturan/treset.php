<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$query = mysqli_query($koneksi, "SELECT * FROM pkl_reg"); 
	while ($data = mysqli_fetch_array($query)){
		$gambar = glob('../../data/'.$data['folder'].'/*'); 
  foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
    } 
	rmdir('../../data/'.$data['folder']);
	}
	

$exec = mysqli_query($koneksi, "truncate pkl_jurnal");
$exec = mysqli_query($koneksi, "truncate pkl_kegiatan");
$exec = mysqli_query($koneksi, "truncate pkl_reg");
$exec = mysqli_query($koneksi, "truncate pkl_nilai");
$exec = mysqli_query($koneksi, "truncate pkl_siswa");
$exec = mysqli_query($koneksi, "truncate pkl_pembimbing");

unlink('../../neural.json');
$from = '../../json/neural.json'; 
$to = '../../neural.json'; 
$kopi = copy($from,$to) ; 
	
?>