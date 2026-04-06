<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

	$id_bank =$_POST['idb'];
    $id_level =$_POST['k'];

   $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$id_level' ");
	while ($siswa = mysqli_fetch_array($siswaQ)) {
		$nilai = fetch($koneksi, 'nilai', array('id_bank' => $id_bank, 'id_siswa' => $siswa['id_siswa']));
			
				$jawaban = unserialize($nilai['jawaban_pg']);
				foreach ($jawaban as $key => $value) {
					$soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from soal where id_soal='$key' order by nomor ASC"));	
					$exec = mysqli_query($koneksi,"INSERT INTO jawaban_dup(id_siswa,id_bank,jenis,id_soal,jawaban) VALUES('$siswa[id_siswa]','$id_bank','$soal[jenis]','$soal[id_soal]','$value')");
			}
			
			$jawabe = unserialize($nilai['jawaban_esai']);
				foreach ($jawabe as $key => $value) {
					$soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from soal where id_soal='$key' order by nomor ASC"));	
						$exec = mysqli_query($koneksi,"INSERT INTO jawaban_dup(id_siswa,id_bank,jenis,id_soal,esai) VALUES('$siswa[id_siswa]','$id_bank','$soal[jenis]','$soal[id_soal]','$value')");
			}
			$jawabbs = unserialize($nilai['jawaban_bs']);
				foreach ($jawabbs as $key => $value) {
					$soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from soal where id_soal='$key' order by nomor ASC"));	
						$exec = mysqli_query($koneksi,"INSERT INTO jawaban_dup(id_siswa,id_bank,jenis,id_soal,jawabbs) VALUES('$siswa[id_siswa]','$id_bank','$soal[jenis]','$soal[id_soal]','$value')");
			}
			$jawabm = unserialize($nilai['jawaban_multi']);
				foreach ($jawabm as $key => $value) {
					$soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from soal where id_soal='$key' order by nomor ASC"));	
						$exec = mysqli_query($koneksi,"INSERT INTO jawaban_dup(id_siswa,id_bank,jenis,id_soal,jawabmulti) VALUES('$siswa[id_siswa]','$id_bank','$soal[jenis]','$soal[id_soal]','$value')");
			}
			$jawabu = unserialize($nilai['jawaban_urut']);
				foreach ($jawabu as $key => $value) {
					$soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from soal where id_soal='$key' order by nomor ASC"));	
						$exec = mysqli_query($koneksi,"INSERT INTO jawaban_dup(id_siswa,id_bank,jenis,id_soal,jawaburut) VALUES('$siswa[id_siswa]','$id_bank','$soal[jenis]','$soal[id_soal]','$value')");
			}
	}
 ?>