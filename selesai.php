<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
cek_session_siswa();

$idm = $_POST['id_bank'];
$ids = $_POST['id_siswa'];
$idu = $_POST['id_ujian'];
$namasiswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));
$totalsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$idm'"));
$totaljawaban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids'"));
$where = array(
    'id_bank' => $idm,
    'id_siswa' => $ids,
    'id_ujian' => $idu
);

$benar = $salah = 0;
$benarm = $salahm = 0;
$benarb = $salahb = 0;
$benaru = $salahu = 0;
$benari = $salahi = 0;
$mapel = fetch($koneksi, 'banksoal', array('id_bank' => $idm));
$siswa = fetch($koneksi, 'siswa', array('id_siswa' => $ids));
$ceksoal = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 1));
$ceksoalesai = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 2));
$cekmulti = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 3));
$cekbs = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 4));
$cekurut = select($koneksi, 'soal', array('id_bank' => $idm, 'jenis' => 5));

$arrayjawabesai = array();
foreach ($ceksoalesai as $getsoalesai) {
    $w2 = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getsoalesai['id_soal'],
        'jenis' => 2
    );
   
    $getjwb2 = fetch($koneksi, 'jawaban', $w2);
    if ($getjwb2) {
        $jawabxx = str_replace("'", "`", $getjwb2['esai']);
        $jawabxx = str_replace("#", ">>", $jawabxx);
        $jawabxx = preg_replace('/[^A-Za-z0-9\@\<\>\$\_\&\-\+\(\)\/\?\!\;\:\`\"\[\]\*\{\}\=\%\~\`\÷\× ]/', '', $jawabxx);
        $arrayjawabesai[$getsoalesai['id_soal']] = $jawabxx;
    } else {
        $arrayjawabesai[$getsoalesai['id_soal']] = 'Tidak Diisi';
    }
	 ($getjwb2['esai'] == $getsoalesai['jawaban']) ? $benari++ : $salahi++;
}
$arrayjawab = array();
foreach ($ceksoal as $getsoal) {
    $w = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getsoal['id_soal'],
        'jenis' => 1
    );
    $getjwb = fetch($koneksi, 'jawaban', $w);
    if ($getjwb) {
        $arrayjawab[$getsoal['id_soal']] = $getjwb['jawaban'];
    } else {
        $arrayjawab[$getsoal['id_soal']] = 'X';
    }
    ($getjwb['jawaban'] == $getsoal['jawaban']) ? $benar++ : $salah++;
}

$arraymulti = array();
foreach ($cekmulti as $getmulti) {
    $m = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getmulti['id_soal'],
        'jenis' => 3
    );
    $getmt = fetch($koneksi, 'jawaban', $m);
    if ($getmulti) {
        $arraymulti[$getmulti['id_soal']] = $getmt['jawabmulti'];
    } else {
        $arraymulti[$getmulti['id_soal']] = 'X';
    }
    ($getmt['jawabmulti'] == $getmulti['jawaban']) ? $benarm++ : $salahm++;
}

$arraybs = array();
foreach ($cekbs as $getbs) {
    $b = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $getbs['id_soal'],
        'jenis' => 4
    );
    $getb = fetch($koneksi, 'jawaban', $b);
    if ($getbs) {
        $arraybs[$getbs['id_soal']] = $getb['jawabbs'];
    } else {
        $arraybs[$getbs['id_soal']] = 'X';
    }
    ($getb['jawabbs'] == $getbs['jawaban']) ? $benarb++ : $salahb++;
}
$arrayurut = array();
foreach ($cekurut as $geturut) {
    $u = array(
        'id_siswa' => $ids,
        'id_bank' => $idm,
        'id_soal' => $geturut['id_soal'],
        'jenis' => 5
    );
    $getut = fetch($koneksi, 'jawaban', $u);
    if ($geturut) {
        $arrayurut[$geturut['id_soal']] = $getut['jawaburut'];
    } else {
        $arrayurut[$geturut['id_soal']] = 'X';
    }
    ($getut['jawaburut'] == $geturut['jawaban']) ? $benaru++ : $salahu++;
}


	$max = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(max_skor) AS skr,id_bank FROM soal WHERE id_bank='$idm'"));
	$score_siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skormu FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' "));
	$skor_pg = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' AND jenis='1'"));
	$skor_esai = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' AND jenis='2'"));
	$skor_multi = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' AND jenis='3'"));
	$skor_bs = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' AND jenis='4'"));
	$skor_urut = mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(skor) AS skor FROM jawaban WHERE id_bank='$idm' AND id_siswa='$ids' AND jenis='5'"));
	$spg = $skor_pg['skor'];
	$spe = $skor_esai['skor'];
	$spm = $skor_multi['skor'];
	$spb = $skor_bs['skor'];
	$spu = $skor_urut['skor'];
	$nilai = ($score_siswa['skormu']/$max['skr'])*100;
	
	
$data = array(
	'skor' => $spg,
	'skor_esai' => $spe,
	'skor_multi' => $spm,
	'skor_bs' => $spb,
	'skor_urut' => $spu,
    'total' => $score_siswa['skormu'],
	'makskor'=> $max['skr'],
	'nilai'=>round($nilai),
    'ujian_selesai' => $waktumu,
    'online' => 0,
	'jml_benar' => $benar,
	'benar_esai' => $benari,
	'benar_multi' => $benarm,
	'benar_bs' => $benarb,
	'benar_urut' => $benaru,
	'jawaban_pg' => serialize($arrayjawab),
    'jawaban_esai' => serialize($arrayjawabesai),
	'jawaban_multi' => serialize($arraymulti),
	'jawaban_bs' => serialize($arraybs),
	'jawaban_urut' => serialize($arrayurut),
	'server' =>$setting['id_server'],
	'jumjawab' =>$totaljawaban,
	'jumsoal' =>$totalsoal
);

update($koneksi, 'nilai', $data, $where);
 $logdata = array(
    'id_siswa' => dekripsi($id_siswa),
    'type' => 'ujian',
    'text' => 'selesai ujian',
    'date' => $waktumu,
	'level' => 'siswa'
);
insert($koneksi, 'log', $logdata);
if($totalsoal==$totaljawaban){
	$dataxx =[
	'browser'=>1
	];
	update($koneksi, 'nilai', $dataxx, $where);
	$exec = mysqli_query($koneksi, "DELETE FROM jodoh WHERE id_ujian='$idu' AND id_siswa='$ids'");
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_ujian='$idu' AND id_siswa='$ids'");
	$exec = mysqli_query($koneksi, "DELETE FROM jawaban_soal WHERE id_ujian='$idu' AND id_siswa='$ids'");
	if($exec){
	$soal_siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$idm'"));	
	$nilai_siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$ids' and id_bank='$idm'"));	
	$notif = "INFORMASI HASIL UJIAN ". $setting['sekolah']. " HARI INI\n\n Nama    : ".$namasiswa['nama']."\n Kode Mapel : ".$soal_siswa['kode']."\n Nilai            : ".$nilai_siswa['nilai']."\n\n Demikian Informasi Hasil Ujian Hari ini Kami sampaikan sebagai sarana monitoring terhadap Putra/Putri Bapak/Ibu selaku Orang Tua Siswa. Terima Kasih dan Tidak Perlu dibalas";
        $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $setting['url_api'].'/send-message',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('message' => $notif,'number' => $namasiswa['nowa'])
		));
		 curl_exec($curl);
		curl_close($curl);	
	}
}

	
?>

	