<?php 
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$jumabsen = mysqli_num_rows(mysqli_query($koneksi, "SELECT tanggal,level FROM absensi where tanggal='$tanggal' and level='siswa'"));
$jumpulang = mysqli_num_rows(mysqli_query($koneksi, "SELECT tanggal,pulang,level FROM absensi where tanggal='$tanggal' and pulang<>'' and level='siswa'"));
$sql = mysqli_query($koneksi, "select * from status");
$sts = mysqli_fetch_assoc($sql);
if($sts['mode']==1){$status='MASUK';}if($sts['mode']==2){$status='PULANG';}

?>
<style>
.responi {
  width: 260px;
  height: 270px;
  text-align:center;
}

</style>

	<div class="card">
        <div class="card card-header">
			<h5 class="card-title" style="text-align:center">LIVE PRESENSI SISWA</h5>
		</div>
       <div class="card-body">
	   <?php if($sts['mode']==1): ?>
	   <?php if($jumabsen==0): ?>
	   <img src="<?= $baseurl ?>/images/animasi.gif" >
	   Menunggu....
	   <?php else: ?>
	    <?php
		$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' and level='siswa' ORDER BY id DESC LIMIT 1"); 
		while ($data = mysqli_fetch_assoc($query)) :
		$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
		if($sis['jk']=='L'){$foto='../images/siswa.png';}if($sis['jk']=='P'){$foto='../images/wanita.png';}	
		if($data['ket']=='S'){$ket='<h4 style="color:blue;font-weight:bold">SAKIT</h4>';}
		if($data['ket']=='I'){$ket='<h4 style="color:gold;font-weight:bold">IZIN</h4>';}
		if($data['ket']=='A'){$ket='<h4 style="color:red;font-weight:bold">ALPHA</h4>';}
		if($data['ket']=='H'){$ket='<h4 style="color:green;font-weight:bold">HADIR</h4>';}
		

 
		?>
		
    </div>
	    <div class="d-flex align-items-center flex-column mb-4">
			<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative">

				<?php if($sis['foto']<>''){ ?>
				<img src="<?= $baseurl ?>/images/fotosiswa/<?= $sis['foto'] ?>" class="responi" alt="thumb" />
				<?php }else{ ?>
				<img src="<?= $foto ?>" class="respon" alt="thumb" />
				<?php } ?>			
			</div>
		 <p></p>
			<h5 style="color:green;">PRESENSI <?= $status; ?></h5>			
			<h5 class="bold">KELAS <?= $sis['kelas'] ?></h5>
		<div class="h5 mb-0"><?= $sis['nama'] ?></div>			
			<?= $ket ?>		
			</div>
		</div>
		
	   <?php endwhile; ?>	   
	   <?php endif; ?>	   
	   <?php endif; ?>
	   <?php if($sts['mode']==2): ?>
	    <?php if($jumpulang==0): ?>
	   <img src="<?= $baseurl ?>/images/animasi.gif" >
	   Tidak ada Aktifitas
	   <?php else: ?>
	   <?php
		$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' and level='siswa' and pulang<>'' ORDER BY id DESC LIMIT 1"); 
		while ($data = mysqli_fetch_assoc($query)) : 
		$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
		if($sis['jk']=='L'){$foto='../images/siswa.png';}if($sis['jk']=='P'){$foto='../images/wanita.png';}	
		?>
		<div class="d-flex align-items-center flex-column mb-4">
			<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">

				<?php if($sis['foto']<>''){ ?>
				<img src="<?= $baseurl ?>/images/fotosiswa/<?= $sis['foto'] ?>" class="responi" alt="thumb" />
				<?php }else{ ?>
				<img src="<?= $foto ?>" class="respon" alt="thumb" />
				<?php } ?>			
			</div>
		
			<h5 style="color:blue;">PRESENSI <?= $status; ?></h5>			
			<h5 class="bold">KELAS <?= $sis['kelas'] ?></h5>
			<div class="h5 mb-0"><?= $sis['nama'] ?></div>			
			<h6 style="color:red;">Hati hati di jalan, sampai jumpa esok hari</h6>	
			</div>
		</div>
		
		<?php endwhile; ?>
	    <?php endif; ?>
	    <?php endif; ?>
	   </div>
	   </div>
	  