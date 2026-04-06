<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'ambil_sub') {
    $id = $_POST['kategori'];
    $sql = mysqli_query($koneksi, "SELECT * FROM bk_sub WHERE id_kat ='$id'");
    echo "<option value=''>Pilih Sub Kategori</option>";
    while ($sub = mysqli_fetch_array($sql)) {
        echo "<option value='$sub[id]'>$sub[sub_kategori]</option>";
    }
}
if ($pg == 'ambil_jenis') {
    $id = $_POST['sub'];
    $sql = mysqli_query($koneksi, "SELECT * FROM bk_pelanggaran WHERE idsub ='$id'");
    echo "<option value=''>Pilih Jenis Pelanggaran</option>";
    while ($sub = mysqli_fetch_array($sql)) {
        echo "<option value='$sub[id]'>$sub[pelanggaran]</option>";
    }
}
if ($pg == 'hapus_pelanggaran') {
	$id = $_POST['id'];
$exec = mysqli_query($koneksi, "DELETE FROM bk_pelanggaran WHERE id='$id'");
	
}
if ($pg == 'hapus_sub') {
	$id = $_POST['id'];
$exec = mysqli_query($koneksi, "DELETE FROM bk_sub WHERE id='$id'");
$hps = mysqli_query($koneksi, "DELETE FROM bk_pelanggaran WHERE idsub='$id'");	
}
if ($pg == 'hapus_kat') {
	$id = $_POST['id'];
	$query = mysqli_query($koneksi, "select * from bk_kategori WHERE id='$id'");
     while ($data = mysqli_fetch_array($query)):
	$hapuspelanggaran = mysqli_query($koneksi, "DELETE FROM  bk_pelanggaran WHERE idkat in (" . $id . ")");
	$hapus = mysqli_query($koneksi, "DELETE FROM  bk_sub WHERE id_kat in (" . $id . ")");
    endwhile;
	
$exec = mysqli_query($koneksi, "DELETE FROM bk_kategori WHERE id='$id'");

}
if ($pg == 'hapus_tindakan') {
	$id = $_POST['id'];
$exec = mysqli_query($koneksi, "DELETE FROM bk_tindakan WHERE id='$id'");
	
}
if ($pg == 'ambil_kelas') {
    $kelas = $_POST['kelas'];
    $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas ='$kelas'");
    echo "<option value=''>Pilih Siswa</option>";
    while ($sub = mysqli_fetch_array($sql)) {
        echo "<option value='$sub[nis]'>$sub[nama]</option>";
    }
}
if ($pg == 'hapus_siswa') {
	$id = $_POST['id'];
$exec = mysqli_query($koneksi, "DELETE FROM bk_siswa WHERE id='$id'");
	
}
if ($pg == 'simpanpel') {
      $data = [
	'pelanggaran'=>$_POST['pelanggaran'],
	'poin'=>$poin = $_POST['poin'],
     'idsub'=>$sub = $_POST['sub'],
      'idkat'=>$kat = $_POST['kategori']
	];
$exec=insert($koneksi,'bk_pelanggaran',$data);
}
if ($pg == 'editpel') {
	$id=$_POST['id'];
      $data = [
	'pelanggaran'=>$_POST['pelanggaran'],
	'poin'=> $_POST['poin']
	];
$exec=update($koneksi,'bk_pelanggaran',$data,['id'=>$id]);
}	
if ($pg == 'tambah_kategori') {
      $data = [
	'kategori'=>$_POST['kategori']
	
	];
$exec=insert($koneksi,'bk_kategori',$data);
}
if ($pg == 'edit_kategori') {
	$id = $_POST['id'];
      $data = [
	'kategori'=>$_POST['kategori']
	
	];
$exec=update($koneksi,'bk_kategori',$data,['id'=>$id]);
}
if ($pg == 'tambah_sub') {
      $data = [
	'id_kat'=>$_POST['kategori'],
	'sub_kategori'=>$_POST['sub']
	];
$exec=insert($koneksi,'bk_sub',$data);
}
if ($pg == 'edit_sub') {
	$id = $_POST['id'];
      $data = [
	'id_kat'=>$_POST['kategori'],
	'sub_kategori'=>$_POST['sub']
	];
$exec=update($koneksi,'bk_sub',$data,['id'=>$id]);
}
if ($pg == 'input_bk') {
	$tapel = $_POST['tapel'];
	$nis = $_POST['nis'];
    $idpel = $_POST['jenis'];
    $idkat = $_POST['kategori'];
	$idsub = $_POST['sub'];
	$ket = $_POST['ket'];
	$tanggal = $_POST['tanggal'];
	$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'"));
    $nowa = $data['nowa_ortu'];
	$p = fetch($koneksi,'bk_pelanggaran',['id'=>$idpel]);
	$poin=$p['poin'];
	$notif = "Assalamualaikum wr.wb\n\nKami Informasikan kepada Orang Tua dari\n\n*".$data['nama']."*\n\nbahwa hari ini ananda *".$data['nama']."*\ntelah melakukan pelanggaran sekolah berupa *".$p['pelanggaran']."*\n\nDemikian Informasi yang Kami Sampaikan, Harap menjadi perhatian Bapak/Ibu selaku Orang Tua Siswa\n\nWasallamualaikum wr.wb.\n\nPesan ini otomatis disampaikan oleh Server ".$setting['sekolah'];
      $data = [
	'nis'=>$nis,
	'kelas'=>$data['kelas'],
	'tanggal'=>$tanggal,
	'idkat'=>$idkat,
	'idsub'=>$idsub,
	'idpel'=>$idpel,
	'tapel'=>$tapel,
	'ket'=>$ket,
	'poin'=>$poin
	];
$exec=insert($koneksi,'bk_siswa',$data);

if($exec){
	
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
		  CURLOPT_POSTFIELDS => array('message' => $notif,'number' => $nowa)
		));
		 curl_exec($curl);
		curl_close($curl);
}
mysqli_query($koneksi,"INSERT INTO bk_pesan(nis,pesan,waktu) VALUES('$nis','$notif','$datetime')");
}


if ($pg == 'edit_bksiswa') {
	$id = $_POST['id'];
      $data = [
	'ket'=>$_POST['ket']
	
	];
$exec=update($koneksi,'bk_siswa',$data,['id'=>$id]);
}	
	
if ($pg == 'edit_tindakan') {
	$id=$_POST['id'];
      $data = [
	'ketentuan'=>$_POST['ketentuan'],
	'minpoin'=>$_POST['minpoin'],
	'maxpoin'=>$_POST['maxpoin']
	];
$exec=update($koneksi,'bk_tindakan',$data,['tindakan'=>$_POST['tindakan']]);
}		
	
	