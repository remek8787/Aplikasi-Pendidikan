<?php
require("konek/koneksi.php");
require("konek/function.php");
require("konek/crud.php");
$status = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from status"));	
$hari = date('D');
$harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM waktu where hari='$hari'"));	
$waktu = date('H:i');
$tanggal = date('Y-m-d');
$jamabsen = date('H:i:s');
$bulan = date('m');
$tahun    = date('Y');
$jam_masuk  = strtotime($harix['masuk']);
$jam_eskul  = strtotime($harix['masuk_eskul']);
$jam_datang = strtotime($waktu);
if($status['mode']=='1'):									
$selisih  = $jam_datang - $jam_masuk;
 elseif($status['mode']=='3'):
 $selisih  = $jam_datang - $jam_eskul;
endif;
if($selisih > 0){
	$jam   = floor($selisih / (60 * 60));
	$menit = $selisih - ( $jam * (60 * 60) );
	$detik = $selisih % 60;
	$ket =  'Terlambat '.$jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
}else{
$ket = "Tepat Waktu";	
}		
$tu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jadwal_tu where hari='$hari'"));	

mysqli_query($koneksi, "TRUNCATE tmpreg");
	$nokartu = $_GET['nokartu'];
	
$query = mysqli_query($koneksi, "select * from datareg where nokartu='$nokartu' and folder is null");
$cek = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$nama = $data['nama'];
$edis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[idpeg]'"));

if ($cek ==0) {
	echo "TIDAK TERDAFTAR";
	$exec = mysqli_query($koneksi,"INSERT INTO tmpreg(nokartu) VALUES('$nokartu')");
	mysqli_close($koneksi);
		}else{	
		echo $data['nada']."#".$nama;	
		$cari_absen = mysqli_query($koneksi, "select * from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
		$jumlah_absen = mysqli_num_rows($cari_absen);
		
		$carieskul = mysqli_query($koneksi, "select * from absensi_les where nokartu='$nokartu' and tanggal='$tanggal'");
		$jumlaheskul = mysqli_num_rows($carieskul);	
		
		if($status['mode']=='1'):
		
			 $jumjadwal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar WHERE guru='$data[idpeg]' and hari='$hari'"));
             $jumabs = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE idpeg='$data[idpeg]' and tanggal='$tanggal'"));
		    if($jumlah_absen==0){
			if($data['level']=='pegawai'){			
			mysqli_query($koneksi, "insert into absensi(nokartu,tanggal,idpeg, masuk, ket, bulan,tahun,level,keterangan)values('$nokartu','$tanggal','$data[idpeg]', '$jamabsen','H', '$bulan','$tahun','pegawai','$ket')");		
			}else{
				 $koneksi->query("INSERT INTO  absensi(nokartu,tanggal,idsiswa,kelas,masuk,ket,bulan,tahun,level,keterangan)values('$nokartu','$tanggal', '$data[idsiswa]', '$kelas', '$jamabsen','H', '$bulan','$tahun','siswa','$ket')");			
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','1')");		
			}
			 }
			if($data['level']=='pegawai' and $edis['level']=='guru'){
			$jadwal = mysqli_fetch_array(mysqli_query($koneksi,"SELECT guru,kelas,jjm,hari,mapel,id_jadwal,dari,sampai FROM jadwal_mengajar WHERE NOT EXISTS(SELECT idpeg,tanggal,jadwal FROM absen_jjm WHERE jadwal_mengajar.guru=absen_jjm.idpeg and jadwal_mengajar.id_jadwal=absen_jjm.jadwal AND absen_jjm.tanggal='$tanggal')and hari='$hari' and guru='$data[idpeg]'"));			 
			 if($jumjadwal<>$jumabs){
			 	if($waktu >= $jadwal['dari'] && $waktu < $jadwal['sampai']){
			 $koneksi->query("INSERT INTO  absen_jjm(tanggal,idpeg,kelas,masuk,ket,bulan,tahun,mapel,jjm,jadwal)values('$tanggal', '$jadwal[guru]', '$jadwal[kelas]', '$jamabsen','H', '$bulan','$tahun','$jadwal[mapel]','$jadwal[jjm]','$jadwal[id_jadwal]')");			
			 }
			 }
			}
			if($data['level']=='pegawai' and $edis['level']=='staff'){
			  $jumlahtu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$data[idpeg]' and tanggal='$tanggal'"));
			 if($jumlahtu==0){				 
			 $koneksi->query("INSERT INTO  absen_tu(tanggal,idpeg,masuk,ket,bulan,tahun)values('$tanggal', '$data[idpeg]','$waktu','siang', '$bulan','$tahun')");			
			 }
			}
		endif;
		if($status['mode']=='2' and $jamabsen < $harix['batas_pulang']):
		 $jumpulang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[idpeg]' and tanggal='$tanggal' and pulang<>''"));
			
			if($jumpulang==0){
			mysqli_query($koneksi, "update absensi set pulang='$jamabsen' where nokartu='$nokartu' and tanggal='$tanggal'");
			if($data['level']=='pegawai'){
			mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$data[idpeg]','$waktumu','2')");		
			}
			 if($edis['level']=='staff'){
			 mysqli_query($koneksi, "update absen_tu set pulang='$harix[pulang]' where idpeg='$data[idpeg]' and tanggal='$tanggal'");
			$sandik = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absen_tu  WHERE idpeg='$data[idpeg]' and tanggal='$tanggal'"));
			$selisihq =  strtotime($sandik['pulang']) -  strtotime($sandik['masuk']);	
			$jamsel   = floor($selisihq / (60 * 60));
			$menitsel = $selisihq - ( $jamsel * (60 * 60) );
			$detiksel = $selisihq % 60;
			$ket2 =  round((($jamsel * 60) + floor( $menitsel / 60 ))/ 60);
			$honor = $tu['honor']* $ket2;
			  mysqli_query($koneksi, "update absen_tu set jumlah='$ket2',honor='$honor' where idpeg='$data[idpeg]' and tanggal='$tanggal'");
			if($sandik['masuk'] < $harix['masuk'] ){
				 mysqli_query($koneksi, "update absen_tu set masuk='$harix[masuk]',jumlah='$ket2',honor='$honor' where idpeg='$data[idpeg]' and tanggal='$tanggal'");
			}
			 }
			}else{
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','2')");		
			}
			
			endif;
			
			if($status['mode']=='3' AND $jumlaheskul==0):
			if($data['level']=='pegawai'){
				
			mysqli_query($koneksi, "insert into absensi_les(nokartu,tanggal,idpeg, masuk, ket, bulan,tahun,level,keterangan)values('$nokartu','$tanggal','$data[idpeg]', '$jamabsen','H', '$bulan','$tahun','pegawai','$ket')");		
			mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$data[idpeg]','$waktumu','1')");		
			
			}else{
				 $koneksi->query("INSERT INTO  absensi_les(nokartu,tanggal,idsiswa,kelas,masuk,ket,bulan,tahun,level,keterangan)values('$nokartu','$tanggal', '$data[idsiswa]', '$kelas', '$jamabsen','H', '$bulan','$tahun','siswa','$ket')");			
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','1')");		
			
			}
		endif;
          if($status['mode']=='4'):
		  $jumpulangeskul = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[idpeg]' and tanggal='$tanggal' and pulang<>''"));
			if( $jumpulangeskul==0): 
			mysqli_query($koneksi, "update absensi_les set pulang='$jamabsen' where nokartu='$nokartu' and tanggal='$tanggal'");
			if($data['level']=='pegawai'){
			mysqli_query($koneksi, "insert into pesan_terkirim(idpeg,waktu,ket)values('$data[idpeg]','$waktumu','2')");		
			
			}else{
				mysqli_query($koneksi, "insert into pesan_terkirim(idsiswa,waktu,ket)values('$data[idsiswa]','$waktumu','2')");		
			}
			endif;
			endif;
			if($status['mode']=='5'):
			$jumpiket = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$data[idpeg]' and tanggal='$tanggal' and ket='malam'"));
               if($jumpiket==0){
				   if($edis['level']=='staff'){
                   $koneksi->query("INSERT INTO  absen_tu(tanggal,idpeg,masuk,ket,bulan,tahun)values('$tanggal', '$data[idpeg]','$jamabsen','malam', '$bulan','$tahun')");
			   }
			   }			   
			endif;
}
			?>