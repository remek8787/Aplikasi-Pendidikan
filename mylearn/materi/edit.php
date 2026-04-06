<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

$id = $_POST['id'];
$id_mapel = addslashes($_POST['mapel']);
$guru = $_POST['guru'];
$materi = addslashes($_POST['isimateri']);
$judul = addslashes($_POST['judul']);
$sampai = $_POST['sampai'];
$youtube = $_POST['youtube'];
$kelas = serialize($_POST['kelas']);
$link = $_POST['link'];

$ektensi = ['jpg', 'png', 'docx', 'pdf', 'xlsx'];
if ($_FILES['file']['name'] <> '') {
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $ext = explode('.', $file);
    $ext = end($ext);
    if (in_array($ext, $ektensi)) {
        $dest = '../../materi/';
        $path = $dest . $file;
        $upload = move_uploaded_file($temp, $path);
        if ($upload) {
            $data = array(
            'mapel' => $id_mapel,
            'kelas' => $kelas,
            'guru' => $guru,
            'judul' => $judul,
            'isimateri' => $materi,
			'sampai'=>$sampai,
			'link'=>$link,
            'youtube' => $youtube,
            'file' => $file
            );
            update($koneksi, 'materi', $data, ['idm' => $id]);
            echo 'OK';
        } else {
            echo "gagal";
        }
    }
} else {
    $data = array(
        'mapel' => $id_mapel,
    'kelas' => $kelas,
    'guru' => $guru,
    'judul' => $judul,
    'isimateri' => $materi,
	'sampai'=>$sampai,
	'link'=>$link,
    'youtube' => $youtube
    );
    update($koneksi, 'materi', $data, ['idm' => $id]);
    
    echo "OK";
}
