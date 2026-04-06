<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$mapel = $_POST['mapel'];
	$kelas = $_POST['kelas'];
    $guru = $_POST['guru'];
	   $tkt = fetch($koneksi,'kelas',['kelas'=>$kelas]);
	   $level = $tkt['level'];
	  
		
	$query = mysqli_query($koneksi, "SELECT idsiswa,kelas,mapel,guru,avg(nilai)as rata FROM nilai_harian where mapel='$mapel' and kelas='$kelas' and guru='$guru' and smt='$semester' and tp='$tapel' GROUP BY idsiswa");
	while ($data = mysqli_fetch_array($query)) :	
	$nr = round($data['rata']);
	$ids = $data['idsiswa'];
	 $qus = mysqli_query($koneksi, "SELECT * FROM nilai_sumatif WHERE idsiswa='$ids' and mapel='$data[mapel]' and smt='$semester' and tp='$tapel' and ket='PH'");
     $cek = mysqli_num_rows($qus);
            if ($cek == 0) {	
	$result = mysqli_query($koneksi,"INSERT INTO nilai_sumatif (mapel,idsiswa,level,kelas,guru,nilai,ket,smt,tp)
				VALUES('$mapel','$ids','$level','$kelas','$guru','$nr','PH','$semester','$tapel')");
			}else{
		$result = mysqli_query($koneksi,"UPDATE nilai_sumatif SET nilai='$nr' WHERE idsiswa='$ids' and mapel='$mapel' and ket='PH' and smt='$semester' and tp='$tapel'");			
			}
	endwhile;
