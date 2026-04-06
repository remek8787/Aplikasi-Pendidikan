<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
$id = $_POST['id'];
$gambar = glob('../../images/kartu/*'); 
foreach ($gambar as $filex) {
    if (is_file($filex))
        unlink($filex); 
}
$data = [
    'model' => $_POST['model'],
	'depan' =>'',
	'belakang' =>''
    ];
    $exec = update($koneksi, 'mesin_absen', $data, ['id' => $id]);
	 if ($exec) {
        $ektensi = ['jpg', 'png','PNG', 'JPG', 'JPEG'];
        if ($_FILES['depan']['name'] <> '') {
            $depan = $_FILES['depan']['name'];
            $temp = $_FILES['depan']['tmp_name'];
            $ext = explode('.', $depan);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'depan' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/kartu/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'mesin_absen', ['depan' => $dest], ['id' => $id]);
                } else {
                    echo "gagal";
                }
            }
        }
		if ($_FILES['belakang']['name'] <> '') {
            $belakang = $_FILES['belakang']['name'];
            $temp = $_FILES['belakang']['tmp_name'];
            $ext = explode('.', $belakang);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'belakang' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/kartu/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'mesin_absen', ['belakang' => $dest], ['id' => $id]);
                } else {
                    echo "gagal";
                }
            }
        }
	 }