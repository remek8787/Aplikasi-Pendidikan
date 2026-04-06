<?php 
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$jumabsen = mysqli_num_rows(mysqli_query($koneksi, "SELECT tanggal,level FROM absensi where tanggal='$tanggal' and level='pegawai'"));
$jumpulang = mysqli_num_rows(mysqli_query($koneksi, "SELECT tanggal,pulang,level FROM absensi where tanggal='$tanggal' and pulang<>'' and level='pegawai'"));
$sql = mysqli_query($koneksi, "select * from status");
$sts = mysqli_fetch_assoc($sql);
if($sts['mode']==1){$status='KEHADIRAN';}if($sts['mode']==2){$status='PULANG';}
?>
<style>
.respon {
  width: 260px;
  height: 270px;
  text-align:center;
}

</style>
	<div class="card">
        <div class="card card-header">
			<h5 class="card-title" style="text-align:center">LIVE PRESENSI PEGAWAI</h5>
		</div>
       <div class="card-body">
	   <?php if($sts['mode']==1): ?>
	   <?php if($jumabsen==0): ?>
	   <img src="<?= $baseurl ?>/images/animasi.gif" >
	   Menunggu....
	   <?php else: ?>
	    <?php
		$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' and level='pegawai' ORDER BY id DESC LIMIT 1"); 
		while ($data = mysqli_fetch_assoc($query)) :
		$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
		$foto='../images/guru.png';
		if($data['ket']=='S'){$ket='<h4 style="color:blue;font-weight:bold">SAKIT</h4>';}
		if($data['ket']=='I'){$ket='<h4 style="color:gold;font-weight:bold">IZIN</h4>';}
		if($data['ket']=='A'){$ket='<h4 style="color:red;font-weight:bold">ALPHA</h4>';}
		if($data['ket']=='H'){$ket='<h4 style="color:green;font-weight:bold">HADIR</h4>';}
		?>
	    <div class="d-flex align-items-center flex-column mb-4">
			<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">

				<?php if($peg['foto']<>''){ ?>
				<img src="<?= $baseurl ?>/images/fotoguru/<?= $peg['foto'] ?>" class="respon" alt="thumb" />
				<?php }else{ ?>
				<img src="<?= $foto ?>" class="respon" alt="thumb" />
				<?php } ?>			
			</div>
			<h5 style="color:green;"><?= $status; ?></h5>			
			<h5 class="bold"><?= $peg['jabatan'] ?></h5>
			<div class="h5 mb-0"><?= $peg['nama'] ?></div>			
			<?= $ket ?>		
			</div>
		</div>
	   <?php endwhile; ?>	   
	   <?php endif; ?>	   
	   <?php endif; ?>
	   <?php if($sts['mode']==2): ?>
	    <?php if($jumpulang==0): ?>
	   <img src="<?= $baseurl ?>/images/animasi.gif" >
	   Menunggu....
	   <?php else: ?>
	   <?php
		$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' and level='pegawai' and pulang<>'' ORDER BY id DESC LIMIT 1"); 
		while ($data = mysqli_fetch_assoc($query)) : 
		$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
		$foto='../images/guru.png';
		?>
		<div class="d-flex align-items-center flex-column mb-4">
			<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">

				<?php if($peg['foto']<>''){ ?>
				<img src="<?= $baseurl ?>/images/fotoguru/<?= $peg['foto'] ?>" class="respon" alt="thumb" />
				<?php }else{ ?>
				<img src="<?= $foto ?>" class="respon" alt="thumb" />
				<?php } ?>			
			</div>
			<h5 style="color:blue;">PRESENSI <?= $status; ?></h5>			
			<h5 class="bold"> <?= $peg['jabatan'] ?></h5>
			<div class="h5 mb-0"><?= $peg['nama'] ?></div>			
			<h6 style="color:red;">Hati hati di jalan, sampai jumpa esok hari</h6>	
			</div>
		</div>
		
		<?php endwhile; ?>
	    <?php endif; ?>
	    <?php endif; ?>
	   </div>
	   </div>
	  