<style>
.responsive {
  width: 200px;
  height: 230px;
}
</style>
<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$sql = mysqli_query($koneksi, "select * from status");
$sts = mysqli_fetch_assoc($sql);
?>  
<?php if($sts['mode']=='1'): ?>
 <p>						
<?php
	$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 1"); 
	$cek = mysqli_num_rows($query);
	if ($cek >= 1) {
	while ($data = mysqli_fetch_array($query)) :
	$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
	$datasis = fetch($koneksi,'datareg',['idsiswa'=>$data['idsiswa']]);
	$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
	$datapeg = fetch($koneksi,'datareg',['idpeg'=>$data['idpeg']]);
	if($data['ket']=='H'){$info='Hadir';} if($data['ket']=='S'){$info='Sakit';} 
	if($data['ket']=='I'){$info='Izin';} if($data['ket']=='A'){$info='Alpha';}
	?>

	<div class="widget-payment-request-container">
       <div class="widget-payment-request-author">
			<center>
             <?php if($data['level']=='siswa'): ?>                                  
             <?php if($sis['foto']==''){ ?>
			 
                <img src="images/user.png" alt="" class="responsive">
				
			<?php }else{ ?>
			
			    <img src="images/fotosiswa/<?= $sis['foto'] ?>" alt="" class="responsive">		
				
			<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
			
                <img src="images/user.png" alt="" class="responsive">
				
			<?php }else{ ?>
			
			    <img src="images/fotoguru/<?= $peg['foto'] ?>" alt="" class="responsive">
				
			<?php } ?>
			
			<?php endif; ?>
			
			 
			</center>
        <div class="widget-payment-request-author-info">
			<center>
			 <?php if($data['level']=='siswa'): ?> 
		      <h5><span class="badge bg-success"><?= ucwords(strtolower($sis['nama'])); ?></span></h5>
			  <?php else: ?>
			  <h5><span class="badge bg-success"><?= ucwords(strtolower($peg['nama'])); ?></span></h5>
			  <?php endif; ?>
                  <span>JAM ABSEN <?= $data['masuk']; ?></span><br>
				  <b><?= strtoupper($info); ?></b><br>
				
			</center>
                    </div>
				</div>
			
		<?php endwhile; ?>
		<?php }else{ ?>
			<div class="widget-payment-request-container">
       
			<center>
			  <img src="images/animasi.gif" alt="" >
					</center>
                    </div>
					<div class="widget-payment-request-author">
					<center><b style="color:red">TIDAK ADA AKTIVITAS</b></center>
				</div>	
		<?php } ?>				
		<?php elseif($sts['mode']=='2'): ?>		
              <p>
		<?php
	         $query2 = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' AND pulang<>'' AND ket='H' ORDER BY pulang DESC LIMIT 1"); 		
				while ($data2 = mysqli_fetch_array($query2)) :
				$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data2['idsiswa']]);
				$pegawai = fetch($koneksi,'users',['id_user'=>$data2['idpeg']]);
				$datasis = fetch($koneksi,'datareg',['idsiswa'=>$data2['idsiswa']]);
				$datapeg = fetch($koneksi,'datareg',['idpeg'=>$data2['idpeg']]);
                ?>

	<div class="widget-payment-request-container">
       <div class="widget-payment-request-author">
          <center>
		  <?php if($data2['level']=='siswa'): ?>                                  
             <?php if($siswa['foto']==''){ ?>
			 
                <img src="images/user.png" alt="" class="responsive">
							
			<?php }else{ ?>
			
			    <img src="images/fotosiswa/<?= $siswa['foto'] ?>" alt="" class="responsive">
				
			<?php } ?>
			<?php else : ?>
			<?php if($pegawai['foto']==''){ ?>
			
                <img src="images/user.png" alt="" class="responsive">
				
			<?php }else{ ?>
			
			    <img src="images/fotoguru/<?= $pegawai['foto'] ?>" alt="" class="responsive">
				
			<?php } ?>
			<?php endif; ?>
			</center>
                </div>
                   <div class="widget-payment-request-author-info">
					<center>
					<?php if($data2['level']=='siswa'): ?>  
						<h3><span class="badge badge-light"><?= $siswa['nama']; ?></span></h3>
					<?php else : ?>
					    <h3><span class="badge badge-light"><?= $pegawai['nama']; ?></span></h3>
					<?php endif; ?>
						<span>JAM ABSEN <?= $data2['pulang']; ?></span>
						<p>
						<b style="color:blue">Hati hati dalam perjalanan, Sampai jumpa esok hari</b>
					</center>
				</div>
			</div>
          <?php endwhile; ?>
		  
	<?php elseif($sts['mode']=='3'): ?>
 <p>						
<?php
	$query = mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 1"); 
	$cek = mysqli_num_rows($query);
	if ($cek >= 1) {
	while ($data = mysqli_fetch_array($query)) :
	$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
	$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
	if($data['ket']=='H'){$info='Hadir';} if($data['ket']=='S'){$info='Sakit';} 
	if($data['ket']=='I'){$info='Izin';} if($data['ket']=='A'){$info='Alpha';}
	?>

	<div class="widget-payment-request-container">
       <div class="widget-payment-request-author">
			<center>
             <?php if($data['level']=='siswa'): ?>                                  
             <?php if($sis['foto']==''){ ?>
                <img src="images/user.png" alt="" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotosiswa/<?= $sis['foto'] ?>" alt="" class="responsive">
			<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
                <img src="images/user.png" alt="" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotoguru/<?= $peg['foto'] ?>" alt="" class="responsive">
			<?php } ?>
			<?php endif; ?>
			</center>
        <div class="widget-payment-request-author-info">
			<center>
			 <?php if($data['level']=='siswa'): ?> 
		      <h3><span class="badge badge-light"><?= ucwords(strtolower($sis['nama'])); ?></span></h3>
			  <?php else: ?>
			  <h3><span class="badge badge-light"><?= ucwords(strtolower($peg['nama'])); ?></span></h3>
			  <?php endif; ?>
                  <span>JAM ABSEN <?= $data['masuk']; ?></span><br>
				  <b><?= strtoupper($info); ?></b><br>
				 
			</center>
                    </div>
				</div>
			
		<?php endwhile; ?>
		<?php }else{ ?>
			<div class="widget-payment-request-container">
       
			<center>
			  <img src="images/animasi.gif" alt="" >
					</center>
                    </div>
					<div class="widget-payment-request-author">
					<center><b style="color:red">TIDAK ADA AKTIVITAS</b></center>
				</div>	
		<?php } ?>			  
		  
		<?php elseif($sts['mode']=='4'): ?>		
              <p>
		<?php
	         $query2 = mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal' AND pulang<>'' AND ket='H' ORDER BY pulang DESC LIMIT 1"); 		
				while ($data2 = mysqli_fetch_array($query2)) :
				$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data2['idsiswa']]);
				$pegawai = fetch($koneksi,'users',['id_user'=>$data2['idpeg']]);
                ?>

	<div class="widget-payment-request-container">
       <div class="widget-payment-request-author">
          <center>
		  <?php if($data2['level']=='siswa'): ?>                                  
             <?php if($siswa['foto']==''){ ?>
                <img src="images/user.png" alt="" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotosiswa/<?= $siswa['foto'] ?>" alt="" class="responsive">
			<?php } ?>
			<?php else : ?>
			<?php if($pegawai['foto']==''){ ?>
                <img src="images/user.png" alt="" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotoguru/<?= $pegawai['foto'] ?>" alt="" class="responsive">
			<?php } ?>
			<?php endif; ?>
			</center>
                </div>
                   <div class="widget-payment-request-author-info">
					<center>
					<?php if($data2['level']=='siswa'): ?>  
						<h3><span class="badge badge-light"><?= $siswa['nama']; ?></span></h3>
					<?php else : ?>
					    <h3><span class="badge badge-light"><?= $pegawai['nama']; ?></span></h3>
					<?php endif; ?>
						<span>JAM ABSEN <?= $data2['pulang']; ?></span>
						<p>
						<b style="color:blue">Hati hati dalam perjalanan</b>
					</center>
				</div>
			</div>
          <?php endwhile; ?>  
		  
		  
	<?php endif; ?>