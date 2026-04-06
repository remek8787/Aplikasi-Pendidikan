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
		'kode_sekolah' => $_POST['kode_server'],
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
		'tanggal_rapor' => $_POST['tgl'],
		'server' => $_POST['server'],
		'url_api' => $_POST['apiwa'],
		'header' => $_POST['laporan']
    ];
    $exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi' => 1]);
	
    if ($exec) {
        $ektensi = ['jpg', 'png','svg','PNG', 'JPG', 'JPEG'];
        if ($_FILES['logo']['name'] <> '') {
			
			$query = "SELECT * FROM pengaturan WHERE id_aplikasi='1'";
			$sql = mysqli_query($koneksi, $query); 
			$data = mysqli_fetch_array($sql);
			if(is_file("../../images/".$data['logo'])) 
			unlink("../../images/".$data['logo']); 			
            $logo = $_FILES['logo']['name'];
            $temp = $_FILES['logo']['tmp_name'];
            $ext = explode('.', $logo);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'logo' . rand(0,1000). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['logo' => $dest], ['id_aplikasi' => 1]);
                } else {
                    echo "gagal";
                }
            }
        }
		
		if ($_FILES['stempel']['name'] <> '') {
			$query = "SELECT * FROM pengaturan WHERE id_aplikasi='1'";
			$sql = mysqli_query($koneksi, $query); 
			$data = mysqli_fetch_array($sql);
			if(is_file("../../images/".$data['stempel'])) 
			unlink("../../images/".$data['stempel']); 
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
			 $query = "SELECT * FROM pengaturan WHERE id_aplikasi='1'";
			$sql = mysqli_query($koneksi, $query); 
			$data = mysqli_fetch_array($sql);
			if(is_file("../../images/".$data['ttd'])) 
			unlink("../../images/".$data['ttd']); 
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
		if ($_FILES['kop']['name'] <> '') {
			$query = "SELECT * FROM pengaturan WHERE id_aplikasi='1'";
			$sql = mysqli_query($koneksi, $query); 
			$data = mysqli_fetch_array($sql);
			if(is_file("../../images/".$data['header'])) 
			unlink("../../images/".$data['header']); 
            $kop = $_FILES['kop']['name'];
            $temp = $_FILES['kop']['tmp_name'];
            $ext = explode('.', $kop);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
               $dest = 'kop' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
								  if ($upload) {
                    $exec = update($koneksi, 'cetak', ['header' => $dest], ['id' => 1]);
                }
            }
        }
		
	}