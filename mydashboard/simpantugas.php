<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
cek_session_siswa();

$id_tugas = $_POST['id_tugas'];
$id_siswa = $_SESSION['id_siswa'];
$jawaban = addslashes($_POST['jawaban']);
$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
$tgs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tugas WHERE id_tugas='$id_tugas'"));
$kelas = $siswa['kelas'];
$mapel = $tgs['mapel'];
$datetime = date('Y-m-d H:i:s');

if ($_FILES['file']['name'] <> '') {	
$totalfiles = count($_FILES['file']['name']);
 
 $filename = $_FILES['file']['name'];
 $ext = explode('.', $filename);
 $ext = end($ext);
  $file = $id_tugas . '_' . $id_siswa . '.' . $ext;
 if(move_uploaded_file($_FILES["file"]["tmp_name"],'../tugas/'.$file)){

   $datax = array(
                'id_tugas' => $id_tugas,
                'id_siswa' => $id_siswa,
				'kelas' => $kelas,
				'mapel' => $mapel,
                'jawaban' => $jawaban,
                'file' => $file
            );
            $where = array(
                'id_siswa' => $id_siswa,
                'id_tugas' => $id_tugas
            );
            $cek = rowcount($koneksi, 'jawaban_tugas', $where);
            if ($cek == 0) {
                insert($koneksi, 'jawaban_tugas', $datax);
				
            } else {
                update($koneksi, 'jawaban_tugas', $datax, $where);
            }
            echo "1";
            
    }

} else {
    $data = array(
        'id_tugas' => $id_tugas,
        'id_siswa' => $id_siswa,
		'kelas' => $kelas,
		'mapel' => $mapel,
        'jawaban' => $jawaban,
		'tgl_dikerjakan' => $datetime

    );
    $where = array(
        'id_siswa' => $id_siswa,
        'id_tugas' => $id_tugas
    );
    $cek = rowcount($koneksi, 'jawaban_tugas', $where);
    if ($cek == 0) {
        insert($koneksi, 'jawaban_tugas', $data);
		
    } else {
        update($koneksi, 'jawaban_tugas', $data, $where);
    }
    echo "1";
}
 
