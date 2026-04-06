<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

    $alamat = nl2br($_POST['alamat']);
	$npsn = $_POST['npsn'];
    $data = [ 
        'sekolah' => $_POST['sekolah'],
        'jenjang' => $_POST['jenjang'],
		'jenis' => $_POST['jenis'],
		'npsn' => $_POST['npsn'],
        'kepsek' => $_POST['kepsek'],
        'nip' => $_POST['nip'],
		'nowa' => $_POST['nowa'],
        'alamat' => $_POST['alamat'],
		'desa' => $_POST['desa'],
        'kecamatan' => $_POST['kec'],
        'kabupaten' => $_POST['kab'],
		 'propinsi' => $_POST['prop'],
        'email' => $_POST['email'],
        'waktu' => $_POST['waktu'],
		'semester' => $_POST['semester'],
		'tp' => $_POST['tp'],
		'server' => $_POST['server'],
		'url_api' => $_POST['apiwa'],
		'header' => $_POST['laporan']
    ];
    $exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi' => 1]);
	
    if ($exec) {
        $ektensi = ['jpg', 'png','svg','PNG', 'JPG', 'JPEG'];
        if ($_FILES['logo']['name'] <> '') {
            $logo = $_FILES['logo']['name'];
            $temp = $_FILES['logo']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'logo' . rand(0,1000). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../img/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['logo' => $dest], ['id_aplikasi' => 1]);
                } else {
                    echo "gagal";
                }
            }
        }
		
		if ($_FILES['stempel']['name'] <> '') {
            $logo = $_FILES['stempel']['name'];
            $temp = $_FILES['stempel']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'stempel' . rand(0,100). '.' . $ext;
                 $upload = move_uploaded_file($temp, '../../images/' . $dest);
				  if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['stempel' => $dest], ['id_aplikasi' => 1]);
                }
            }
        }
		 if ($_FILES['ttd']['name'] <> '') {
            $logo = $_FILES['ttd']['name'];
            $temp = $_FILES['ttd']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
               $dest = 'ttd' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
								  if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['ttd' => $dest], ['id_aplikasi' => 1]);
                }
            }
        }
		
		
	}