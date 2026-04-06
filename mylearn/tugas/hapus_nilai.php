<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$kode = $_POST['id'];
cek_session_guru();
$query = "SELECT * FROM jawaban_tugas WHERE id_jawaban='".$kode."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../../tugas/".$data['file'])) 
			unlink("../../../tugas/".$data['file']); 
$exec = mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_jawaban='$kode'");
