<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'ubah') {
    $wkt = explode(" ",  $_POST['tgl_ujian']);
    $wkt_ujian = $wkt[1];
    $id = $_POST['idu'];
    
    $data = [
        
        'lama_ujian'         => $_POST['lama_ujian'],
        'tgl_ujian'        => $_POST['tgl_ujian'],
        'tgl_selesai'        => $_POST['tgl_selesai'],
        'waktu_ujian'     => $wkt_ujian,
        'sesi'       => $_POST['sesi']
    ];
    $exec = update($koneksi, 'ujian', $data, ['id_ujian' => $id]);
   
}
if ($pg == 'tambah') {
    $wkt = explode(" ",  $_POST['tgl_ujian']);
    $wkt_ujian = $wkt[1];
    
    $bank = fetch($koneksi, 'banksoal', ['id_bank' => $_POST['idmapel']]);
	$j = mysqli_query($koneksi, "SELECT SUM(IF(jenis='1',1,0)) AS jml_soal,SUM(IF(jenis='2',1,0)) AS jml_esai, SUM(IF(jenis='3',1,0)) AS jml_multi, SUM(IF(jenis='4',1,0)) AS jml_bs,SUM(IF(jenis='5',1,0)) AS jml_urut  FROM soal WHERE id_bank='$_POST[idmapel]' ");
	$jumlah=mysqli_fetch_array($j);
	
    $data = [
        'id_bank'         => $_POST['idmapel'],
        'nama'          => $bank['nama'],
		'jml_soal'   => $jumlah['jml_soal'],
        'jml_esai'         => $jumlah['jml_esai'],
		'jml_multi'         => $jumlah['jml_multi'],
		'jml_bs'         => $jumlah['jml_bs'],
	    'jml_urut'         => $jumlah['jml_urut'],
        'lama_ujian'         => $_POST['lama_ujian'],
        'tgl_ujian'        => $_POST['tgl_ujian'],
        'tgl_selesai'        => $_POST['tgl_selesai'],
        'waktu_ujian'     => $wkt_ujian,
		'level'     => $bank['level'],
		'pk'     => $bank['pk'],
        'sesi'       => $_POST['sesi'],
		'status'        => 1,
		'tampil_pg'         => $jumlah['jml_soal'],
	    'tampil_esai'         => $jumlah['jml_esai'],
		'tampil_multi'         => $jumlah['jml_multi'],
		'tampil_bs'         => $jumlah['jml_bs'],
	    'tampil_urut'         => $jumlah['jml_urut'],
		 'opsi'        => '4',
		'kode_ujian'        => $_POST['kode_ujian'],
		'pelanggaran'        => $_POST['langgar'],
		'soal_agama'        => $bank['soal_agama'],
        'kode_nama'        => $bank['kode']
    ];
	
    $cek = rowcount($koneksi, 'ujian', ['kode_nama' => $bank['kode'], 'sesi' => $_POST['sesi']]);
    if ($cek > 0) {
        echo "jadwal sudah ada";
    } else {
        $exec = insert($koneksi, 'ujian', $data);
            echo $exec;
			
       
        }
    
}
if ($pg == 'aktivasi') {
  foreach ($_POST['ujian'] as $ujian) {
        if ($_POST['aksi'] <> 'hapus') {
            $exec = update($koneksi, 'ujian', ['status' => $_POST['aksi'], 'sesi' => $_POST['sesi']], ['id_ujian' => $ujian]);
            if ($exec) {
                echo "update";
            }
        } else {
            $exec = delete($koneksi, 'ujian', ['id_ujian' => $ujian]);
            if ($exec) {
                echo "hapus";
            }
        }
    }  
}
if ($pg == 'token') {
    function create_random($length)
    {
        $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = rand(0, strlen($data) - 1);
            $string .= $data[$pos];
        }
        return $string;
    }
    $token = create_random(6);
    $now = date('Y-m-d H:i:s');
    echo $token;
    $cek = rowcount($koneksi, 'token');
    if ($cek <> 0) {
        $query = fetch($koneksi, 'token');
        $time = $query['time'];
        $tgl = buat_tanggal('H:i:s', $time);
        $exec = update($koneksi, 'token', ['token' => $token, 'time' => $now], ['id_token' => 1]);
    } else {
        $exec = insert($koneksi, 'token', ['token' => $token, 'masa_berlaku' => '00:15:00']);
    }
}
if ($pg == 'paket') {
    $paket = $_POST['paket'];
    $sql = mysqli_query($koneksi, "SELECT * FROM banksoal WHERE paket='" . $paket . "'");
    echo "<option value=''>Pilih Mapel</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id_bank]'>$data[kode] | $data[nama] | $data[level] | $data[pk]</option>";
    }
}
