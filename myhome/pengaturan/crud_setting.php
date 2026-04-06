<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'setting_app') {
    $alamat = nl2br($_POST['alamat']);
	$smt = $_POST['semester'];
    $data = [
        
        'sekolah' => $_POST['sekolah'],
        'id_server' => $_POST['kode'],
        'jenjang' => $_POST['jenjang'],
		 'npsn' => $_POST['npsn'],
        'kepsek' => $_POST['kepsek'],
        'nip' => $_POST['nip'],
		'nowa' => $_POST['nowa'],
        'alamat' => $_POST['alamat'],
		'desa' => $_POST['desa'],
        'kecamatan' => $_POST['kecamatan'],
        'kabupaten' => $_POST['kabupaten'],
		 'propinsi' => $_POST['propinsi'],
        'telp' => $_POST['telp'],
        'fax' => $_POST['fax'],
        'web' => $_POST['web'],
		'url_api' => $_POST['apiwa'],
        'email' => $_POST['email'],
		'header'=>$_POST['laporan'],
        'waktu' => $_POST['waktu'],
		'server' => $_POST['server'],
		'semester' => $_POST['semester'],
		'tp' => $_POST['tp'],
		'jenis' => $_POST['jenis']
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
                $dest = 'logo' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['logo' => $dest], ['id_aplikasi' => 1]);
                } else {
                    echo "gagal";
                }
            }
        }
		if ($_FILES['logokanan']['name'] <> '') {
            $logokanan = $_FILES['logokanan']['name'];
            $temp = $_FILES['logokanan']['tmp_name'];
            $ext = explode('.', $logokanan);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $dest = 'logo' . rand(0,100). '.' . $ext;
                $upload = move_uploaded_file($temp, '../../images/' . $dest);
                if ($upload) {
                    $exec = update($koneksi, 'pengaturan', ['logokanan' => $dest], ['id_aplikasi' => 1]);
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
		
    } else {
        echo "Gagal menyimpan";
    }
}


if ($pg == 'setting_restore') {
    function restore($file)
    {
        require("../../konek/koneksi.php");
        global $rest_dir;
        $nama_file    = $file['name'];
        $ukrn_file    = $file['size'];
        $tmp_file    = $file['tmp_name'];

        if ($nama_file == "") {
            echo "Fatal Error";
        } else {
            $alamatfile    = $rest_dir . $nama_file;
            $templine    = array();

            if (move_uploaded_file($tmp_file, $alamatfile)) {

                $templine    = '';

                $lines    = file($alamatfile);

                foreach ($lines as $line) {
                    if (substr($line, 0, 2) == '--' || $line == '')
                        continue;

                    $templine .= $line;

                    if (substr(trim($line), -1, 1) == ';') {
                        mysqli_query($koneksi, $templine);
                        $templine = '';
                    }
                }
            } else {
                echo "Proses upload gagal, kode error = " . $file['error'];
            }
        }
    }
    restore($_FILES['datafile']);
    if (isset($_FILES['datafile'])) {
        echo "data berhasil di restore";
    }
}


if ($pg == 'ambil_jenjang') {
    $jenis = $_POST['jenis'];
    $sql = mysqli_query($koneksi, "SELECT * FROM jenis_sp WHERE jenis='" . $jenis . "'");
    echo "<option value='semua'>Pilih Jenjang</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[jenjang]'>$data[ket]</option>";
    }
}
if ($pg == 'reset_pesan') {
	$exec = mysqli_query($koneksi, "truncate pesan_terkirim");
}

if ($pg == 'reset') {
$exec = mysqli_query($koneksi, "truncate berita");
$exec = mysqli_query($koneksi, "truncate banksoal");
$exec = mysqli_query($koneksi, "truncate file_pendukung");
$exec = mysqli_query($koneksi, "truncate jawaban");
$exec = mysqli_query($koneksi, "truncate jawaban_dup");
$exec = mysqli_query($koneksi, "truncate jawaban_soal");
$exec = mysqli_query($koneksi, "truncate jodoh");
$exec = mysqli_query($koneksi, "truncate kelas");
$exec = mysqli_query($koneksi, "truncate kunci_soal");
$exec = mysqli_query($koneksi, "truncate log");
$exec = mysqli_query($koneksi, "truncate mapel");
$exec = mysqli_query($koneksi, "truncate menjodohkan");
$exec = mysqli_query($koneksi, "truncate nilai");
$exec = mysqli_query($koneksi, "truncate siswa");
$exec = mysqli_query($koneksi, "truncate soal");
$exec = mysqli_query($koneksi, "truncate ujian");
$exec = mysqli_query($koneksi, "truncate users");
$dataxx = [
        'nama'   => 'Admin',
        'username'   => 'admin',
		'password'   => '$2y$10$t3L.GQrBJJHa5gPSooBuhOiZYk4yFgJT7TqBvqPI1bU57mJFQOrAG',
		'level'   => 'admin',
		'sts' => 2
			];
$result = insert($koneksi, 'users', $dataxx);

$exec = mysqli_query($koneksi, "UPDATE sinkron set jumlah='0',tanggal=NULL");

$gambarmu = glob('../../images/fotosiswa/*'); 
foreach ($gambarmu as $fileu) {
    if (is_file($fileu))
        unlink($fileu); 
}
$gambare = glob('../../images/fotoguru/*'); 
foreach ($gambare as $fileug) {
    if (is_file($fileug))
        unlink($fileug); 
}
$foto = glob('../../files/*'); 
foreach ($foto as $file) {
    if (is_file($file))
        unlink($file); 
}
    $filezip = '../../files.zip';
     unlink($filezip); 
}