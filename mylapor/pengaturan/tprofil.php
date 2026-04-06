<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$data = [
	'nss'=>$_POST['nss'],
	'tahun_berdiri'=>$_POST['berdiri'],
	'akreditasi'=>$_POST['akreditasi']
	];

	$exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi' => 1]);
	if ($exec) {
        $ektensi = ['jpg', 'png','svg','PNG', 'JPG', 'JPEG'];
        if ($_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'file' . rand(0,1000). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['pemda' => $dest], ['id_aplikasi' => 1]);
                } else {
                    echo "gagal";
                }
            }
        }
	}
?>