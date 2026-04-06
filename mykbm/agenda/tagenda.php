<?php
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
 
if ($pg == 'tambah') {
	$tgl = $_POST['tgl'];
	$guru = $_POST['guru'];
	$hari = date('D',strtotime($tgl));
	$bulan = date('m',strtotime($tgl));
	$tahun = date('Y',strtotime($tgl));
	$mapel = $_POST['mapel'];
	$kelas = $_POST['kelas'];
    $materi = $_POST['materi'];
	$tp = $_POST['tp'];
	$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'"));
	$jabs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where kelas='$kelas' and tanggal='$tgl' and ket='H'"));
	$hadir = round(($jabs/$jsiswa)*100);
	 if($hadir > 0){$hadir = $hadir;}else{$hadir = 0;}
		$where = [
		'tanggal'   => $tgl,
        'kelas'   => $kelas,
		'mapel'   => $mapel,
		'guru'   => $guru		
			];
			
		$data = [
		'hari'   => $hari,
		'tanggal'   => $tgl,
        'kelas'   => $kelas,
		'mapel'   => $mapel,
		'materi'   => $materi,
		'tujuan'   => $tp,
		'guru'   => $guru,
		'bulan'   => $bulan,
		'tahun'   => $tahun,
		'hadir'   => $hadir
			];	
	$cek = rowcount($koneksi, 'agenda', $where);
    if ($cek == 0) {		
	$result = insert($koneksi, 'agenda', $data);
	}
			
}

if ($pg == 'edit') {
	$id = $_POST['id'];
	$tgl = $_POST['tgl'];
	$guru = $_POST['guru'];
	$hari = date('D',strtotime($tgl));
	$bulan = date('m',strtotime($tgl));
	$tahun = date('Y',strtotime($tgl));
	$mapel = $_POST['mapel'];
	$kelas = $_POST['kelas'];
    $materi = $_POST['materi'];
	$tp = $_POST['tp'];
	$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'"));
	$jabs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where kelas='$kelas' and tanggal='$tgl' and ket='H'"));
	$hadir = round(($jabs/$jsiswa)*100);
	 if($hadir > 0){$hadir = $hadir;}else{$hadir = 0;}
	 
	 $data = [
		'hari'   => $hari,
		'tanggal'   => $tgl,
        'kelas'   => $kelas,
		'mapel'   => $mapel,
		'materi'   => $materi,
		'tujuan'   => $tp,
		'guru'   => $guru,
		'bulan'   => $bulan,
		'tahun'   => $tahun,
		'hadir'   => $hadir
			];	
	 $result = update($koneksi, 'agenda', $data,['id'=>$id]);
}

if ($pg == 'hapus') {
	 $id = $_POST['id'];
     $exec = mysqli_query($koneksi, "DELETE FROM agenda WHERE id='$id'");
}

if ($pg == 'jurnal') {
	 $id = $_POST['id'];
     $hambat = $_POST['hambat'];
	 $pecah = $_POST['pecah'];
     $exec = mysqli_query($koneksi, "UPDATE agenda SET hambatan='$hambat',pemecahan='$pecah' WHERE id='$id'");
}

if ($pg == 'kelas') {
	$hari = date('D');
	 $guru = $_POST['guru'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas,hari FROM jadwal_mengajar where guru='$guru' and hari='$hari' GROUP BY kelas");           
     echo "<option value=''>Pilih Kelas</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[kelas]'>$kls[kelas]</option>";
    }
}

if ($pg == 'mapel') {
	$hari = date('D');
	 $guru = $_POST['guru'];
	 $kelas = $_POST['kelas'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas,hari,mapel FROM jadwal_mengajar where guru='$guru' and hari='$hari' and kelas='$kelas' GROUP BY mapel");           
     echo "<option value=''>Pilih Mapel</option>";
     while ($m = mysqli_fetch_array($data)) {
	$mpl = fetch($koneksi,'mapel',['id'=>$m['mapel']]);	 
     echo "<option value='$m[mapel]'>$mpl[nama_mapel]</option>";
    }
}

if ($pg == 'ambil_kelas') {
	 $guru = $_POST['guru'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas FROM agenda where guru='$guru' GROUP BY kelas");           
     echo "<option value=''>Pilih Kelas</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[kelas]'>$kls[kelas]</option>";
    }
}

if ($pg == 'ambil_mapel') {
	 $guru = $_POST['guru'];
	 $kelas = $_POST['kelas'];
     $data = mysqli_query($koneksi, "SELECT guru,kelas,mapel FROM jadwal_mengajar where guru='$guru' and kelas='$kelas' GROUP BY mapel");           
     echo "<option value=''>Pilih Mapel</option>";
     while ($m = mysqli_fetch_array($data)) {
	$mpl = fetch($koneksi,'mapel',['id'=>$m['mapel']]);	 
     echo "<option value='$m[mapel]'>$mpl[nama_mapel]</option>";
    }
}

if ($pg == 'level') {
	 $guru = $_POST['guru'];
     $data = mysqli_query($koneksi, "SELECT guru,tingkat FROM jadwal_mengajar where guru='$guru' GROUP BY tingkat");           
     echo "<option value=''>Pilih Tingkat</option>";
     while ($kls = mysqli_fetch_array($data)) {
     echo "<option value='$kls[tingkat]'>$kls[tingkat]</option>";
    }
}

if ($pg == 'mapelguru') {
	 $guru = $_POST['guru'];
	 $level = $_POST['level'];
     $data = mysqli_query($koneksi, "SELECT guru,tingkat,mapel FROM jadwal_mengajar where guru='$guru' and tingkat='$level' GROUP BY mapel");           
     echo "<option value=''>Pilih Mapel</option>";
     while ($m = mysqli_fetch_array($data)) {
	$mpl = fetch($koneksi,'mapel',['id'=>$m['mapel']]);	 
     echo "<option value='$m[mapel]'>$mpl[nama_mapel]</option>";
    }
}
