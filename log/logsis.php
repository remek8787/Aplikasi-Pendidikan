<style>
.responsive {
  width: 200px;
  height: 230px;
}
#img {
  border: 15px solid #556;
 border-radius: 10px;
}
</style>
<?php
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$jronda = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE tanggal='$tanggal' and ket='malam'"));
$sql = mysqli_query($koneksi, "select * from status");
$sts = mysqli_fetch_assoc($sql);
?>  
<?php if($sts['mode']=='1'): ?>
 <p>						
<?php
	$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal'  and jenis is NULL ORDER BY id DESC LIMIT 1"); 
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


			<center>
             <?php if($data['level']=='siswa'): ?>                                  
             <?php if($sis['foto']==''){ ?>
			<img src="images/user.png" id="img" class="responsive">
				<?php }else{ ?>
			 <img src="images/fotosiswa/<?= $sis['foto'] ?>" id="img" class="responsive">		
				<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
			<img src="images/user.png" id="img" class="responsive">
				<?php }else{ ?>
			<img src="images/fotoguru/<?= $peg['foto'] ?>" id="img" class="responsive">
				<?php } ?>
			<?php endif; ?>			 
			</center>
		
			<div class="card">
			<div class="card-body" style="background-color:#556;color:#fff;border-radius:10px">
        
			<center>
			 <?php if($data['level']=='siswa'): ?> 
		      <h5><?= ucwords(strtolower($sis['nama'])); ?></h5>
			  <?php else: ?>
			  <h5><?= ucwords(strtolower($peg['nama'])); ?></h5>
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
          
		<?php
	         $query2 = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' AND pulang<>'' AND ket='H' ORDER BY pulang DESC LIMIT 1"); 		
				while ($data2 = mysqli_fetch_array($query2)) :
				$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data2['idsiswa']]);
				$peg = fetch($koneksi,'users',['id_user'=>$data2['idpeg']]);
				$datasis = fetch($koneksi,'datareg',['idsiswa'=>$data2['idsiswa']]);
				$peg = fetch($koneksi,'users',['id_user'=>$data2['idpeg']]);
				$datapeg = fetch($koneksi,'datareg',['idpeg'=>$data2['idpeg']]);
                ?>

	
          <center>
		  <?php if($data2['level']=='siswa'): ?>                                  
             <?php if($siswa['foto']==''){ ?>
               <img src="images/user.png" id="img" class="responsive">			
			<?php }else{ ?>
			<img src="images/fotosiswa/<?= $siswa['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
			<img src="images/user.png" id="img" class="responsive">				
			<?php }else{ ?>
			<img src="images/fotoguru/<?= $peg['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php endif; ?>
			</center>
                <div class="card">
			<div class="card-body" style="background-color:#556;color:#fff;border-radius:10px">
        
					<center>
					<?php if($data2['level']=='siswa'): ?>  
						<h5><span class="badge badge-light"><?= $siswa['nama']; ?></span></h5>
					<?php else : ?>
					    <h5><span class="badge badge-light"><?= $peg['nama']; ?></span></h5>
					<?php endif; ?>
						<span>JAM ABSEN <?= $data2['pulang']; ?></span>
						<br>	<b style="color:blue">Hati hati dalam perjalanan, Sampai jumpa esok hari</b>
					</center>
				</div>
			</div>
          <?php endwhile; ?>
		  
	<?php elseif($sts['mode']=='3'): ?>
 						
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

			<center>
             <?php if($data['level']=='siswa'): ?>                                  
             <?php if($sis['foto']==''){ ?>
                <img src="images/user.png" id="img" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotosiswa/<?= $sis['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
                <img src="images/user.png" id="img" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotoguru/<?= $peg['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php endif; ?>
			</center>
         <div class="card">
			<div class="card-body" style="background-color:#556;color:#fff;border-radius:10px">
        
			<center>
			 <?php if($data['level']=='siswa'): ?> 
		      <h5><span class="badge badge-light"><?= ucwords(strtolower($sis['nama'])); ?></span></h5>
			  <?php else: ?>
			  <h5><span class="badge badge-light"><?= ucwords(strtolower($peg['nama'])); ?></span></h5>
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
       
		<?php
	         $query2 = mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal' AND pulang<>'' AND ket='H' ORDER BY pulang DESC LIMIT 1"); 		
				while ($data2 = mysqli_fetch_array($query2)) :
				$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data2['idsiswa']]);
				$peg = fetch($koneksi,'users',['id_user'=>$data2['idpeg']]);
                ?>

	
          <center>
		  <?php if($data2['level']=='siswa'): ?>                                  
             <?php if($siswa['foto']==''){ ?>
                <img src="images/user.png" id="img" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotosiswa/<?= $siswa['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php else : ?>
			<?php if($peg['foto']==''){ ?>
                <img src="images/user.png" id="img" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotoguru/<?= $peg['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			<?php endif; ?>
			</center>
               <div class="card">
			<div class="card-body" style="background-color:#556;color:#fff;border-radius:10px">
        
					<center>
					<?php if($data2['level']=='siswa'): ?>  
						<h5><span class="badge badge-light"><?= $siswa['nama']; ?></span></h5>
					<?php else : ?>
					    <h5><span class="badge badge-light"><?= $peg['nama']; ?></span></h5>
					<?php endif; ?>
						<span>JAM ABSEN <?= $data2['pulang']; ?></span>
						<br>
						<b style="color:blue">Hati hati dalam perjalanan</b>
					</center>
				</div>
			</div>
          <?php endwhile; ?>  
		 	
			
	<?php elseif($sts['mode']=='5'): ?>		
              <p>
			  <?php if($jronda==0): ?>
			  <div class="widget-payment-request-container">
       
			<center>
			  <img src="images/animasi.gif" alt="" >
					</center>
                    </div>
					<div class="widget-payment-request-author">
					<center><b style="color:red">TIDAK ADA AKTIVITAS</b></center>
				</div>	
			  <?php else: ?>
		<?php
		
	         $query5 = mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE tanggal='$tanggal' AND  ket='malam' ORDER BY id DESC LIMIT 1"); 		
				while ($data5 = mysqli_fetch_array($query5)) :
				$peg = fetch($koneksi,'users',['id_user'=>$data5['idpeg']]);
                ?>

	
          <center>
		 
			<?php if($peg['foto']==''){ ?>
                <img src="images/user.png" alt="" class="responsive">
			<?php }else{ ?>
			    <img src="images/fotoguru/<?= $peg['foto'] ?>" id="img" class="responsive">
			<?php } ?>
			
			</center>
              <div class="card">
			<div class="card-body" style="background-color:#556;color:#fff;border-radius:10px">
        
					<center>
					
					    <h5><span class="badge badge-light"><?= $peg['nama']; ?></span></h5>
					
						<span>JAM ABSEN <?= $data5['masuk']; ?></span>
						<br>
						<b style="color:blue">Selamat Ronda</b>
					</center>
				</div>
			</div>
          <?php endwhile; ?> 		
			
		<?php endif; ?>	
	<?php endif; ?>