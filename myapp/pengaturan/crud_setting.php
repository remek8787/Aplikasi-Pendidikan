<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

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
$exec = mysqli_query($koneksi, "truncate alumni");	
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
$exec = mysqli_query($koneksi, "UPDATE pdb set jumlah='0'");
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
if ($pg == 'hapusttd') {
	$data = [
	'ttd'=>NULL
	];
	unlink("../../images/".$setting['ttd']);
	$exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi' => 1]);
	
}
if ($pg == 'hapusstp') {
	$data = [
	'stempel'=>NULL
	];
	unlink("../../images/".$setting['stempel']);
	$exec = update($koneksi, 'pengaturan', $data, ['id_aplikasi' => 1]);
	
}
if ($pg == 'hapuskop') {
	$cetak = fetch($koneksi,'cetak',['id'=>1]);
	$data = [
	'header'=>NULL
	];
	unlink("../../images/".$cetak['header']);
	$exec = update($koneksi, 'cetak', $data, ['id' => 1]);
	
}