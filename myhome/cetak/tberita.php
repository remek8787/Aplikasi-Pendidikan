<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'tambah') {
    $ujian = fetch($koneksi, 'ujian', ['id_ujian' => $_POST['id_ujian']]);
    $id_bank = $ujian['id_bank'];
    $sesi = $_POST['sesi'];
    $ruang = $_POST['ruang'];
    $kode_ujian = $ujian['kode_ujian'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    $nama_proktor = $_POST['nama_proktor'];
    $nip_proktor = $_POST['nip_proktor'];
    $nama_pengawas = $_POST['nama_pengawas'];
    $nip_pengawas = $_POST['nip_pengawas'];
    $catatan = $_POST['catatan'];
    $tgl_ujian = $_POST['tgl_ujian'];
    $nosusulan = serialize($_POST['nosusulan']);
    $hadir = $_POST['hadir'];
    $tidakhadir = $_POST['tidakhadir'];
    $data = array(
        'id_bank' => $id_bank,
        'sesi' => $sesi,
        'ruang' => $ruang,
        'jenis' => $kode_ujian,
        'mulai' => $mulai,
        'selesai' => $selesai,
        'nama_proktor' => $nama_proktor,
        'nip_proktor' => $nip_proktor,
        'nama_pengawas' => $nama_pengawas,
        'nip_pengawas' => $nip_pengawas,
        'catatan' => $catatan,
        'tgl_ujian' => $tgl_ujian,
        'no_susulan' => $nosusulan,
        'ikut' => $hadir,
        'susulan' => $tidakhadir
    );
    $where = [
        'id_bank' => $id_bank,
        'sesi' => $sesi,
        'ruang' => $ruang
    ];
    $cekberita = rowcount($koneksi, 'berita', $where);
    if ($cekberita == 0) {
        $tabel = 'berita';
        $cek = insert($koneksi, $tabel, $data);
        echo mysqli_error($koneksi);
        if ($cek == true) {
            echo "oke";
        } else {
            echo "no";
        }
    } else {
        echo "berita acara gagal dibuat";
    }
}

if ($pg == 'hapus') {
    $kode = $_POST['id'];
    $exec = mysqli_query($koneksi, "DELETE FROM berita WHERE id_berita='$kode'");
}

if ($pg == 'list_siswa') {
	 $iduji = $_POST['iduji'];
	 $uji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_ujian,level FROM ujian  WHERE id_ujian='$iduji'"));
    $sesi = $_POST['sesi'];
    $ruang = $_POST['ruang'];
    $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE ruang='$ruang' and sesi='$sesi' and level='$uji[level]'");
    echo "<option value=''>Pilih Siswa</option>";
    while ($siswa = mysqli_fetch_array($sql)) {
        echo "<option value='$siswa[nopes]'>$siswa[nopes] - $siswa[nama]</option>";
    }
}
if ($pg == 'header') {
$exec = mysqli_query($koneksi, "UPDATE pengaturan set header_kartu='$_POST[jawab]' where id_aplikasi='1'");
}
if ($pg == 'ttd') {
$exec = mysqli_query($koneksi, "UPDATE pengaturan set pk_ttd='$_POST[ttd]' where id_aplikasi='1'");
}
if ($pg == 'stp') {
$exec = mysqli_query($koneksi, "UPDATE pengaturan set pk_stempel='$_POST[stp]' where id_aplikasi='1'");
}