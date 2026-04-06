<?php 
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");
$sql = mysqli_query($koneksi, "select * from status");
$sts = mysqli_fetch_assoc($sql);
?>

<div id="carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">                                    										
		<div class="carousel-item active">
           <div>
			<?php if($sts['mode']=='1'): ?>
               <h5 data-animation="animated fadeInDownBig">ABSEN MASUK</h5>
				<ul>
				<?php
				$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 8"); 			
				while ($data = mysqli_fetch_array($query)) :
				 $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
				 $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
				 if($data['ket']=='H'){$info='Hadir';} if($data['ket']=='S'){$info='Sakit';} 
				 if($data['ket']=='I'){$info='Izin';} if($data['ket']=='A'){$info='Alpha';}
                ?>
				<?php if($data['level']=='siswa'): ?>
             <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $siswa['nama'] ?> <small style="color:yellow">( <?= $info; ?> )</small></li>
			 <?php else : ?>
			 <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $peg['nama'] ?> <small style="color:yellow">( <?= $info; ?> )</small></li>
			 <?php endif; ?>
                  <?php endwhile; ?>               
              </ul>
	       <?php elseif($sts['mode']=='2'): ?>
               <h5 data-animation="animated fadeInDownBig">ABSEN PULANG</h5>
			<ul>
				<?php
				$query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE tanggal='$tanggal' and pulang<>'' ORDER BY pulang DESC LIMIT 8"); 			
				while ($data = mysqli_fetch_array($query)) :
				 $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
				 $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
                ?>
           <?php if($data['level']=='siswa'): ?>
             <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $siswa['nama'] ?>  </li>
			 <?php else : ?>
			 <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $peg['nama'] ?></li>
			 <?php endif; ?>
           <?php endwhile; ?>  
		   
		   
		   <?php elseif($sts['mode']=='3'): ?>
               <h5 data-animation="animated fadeInDownBig">ABSEN MASUK ESKUL</h5>
				<ul>
				<?php
				$query = mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 8"); 			
				while ($data = mysqli_fetch_array($query)) :
				 $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
				 $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
				 if($data['ket']=='H'){$info='Hadir';} if($data['ket']=='S'){$info='Sakit';} 
				 if($data['ket']=='I'){$info='Izin';} if($data['ket']=='A'){$info='Alpha';}
                ?>
				<?php if($data['level']=='siswa'): ?>
             <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $siswa['nama'] ?> <small style="color:yellow">( <?= $info; ?> )</small></li>
			 <?php else : ?>
			 <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $peg['nama'] ?></li>
			 <?php endif; ?>
                  <?php endwhile; ?>               
              </ul>
		
		<?php elseif($sts['mode']=='4'): ?>
               <h5 data-animation="animated fadeInDownBig">ABSEN PULANG ESKUL</h5>
			<ul>
				<?php
				$query = mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE tanggal='$tanggal' and pulang<>'' ORDER BY pulang DESC LIMIT 8"); 			
				while ($data = mysqli_fetch_array($query)) :
				 $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
				 $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
                ?>
           <?php if($data['level']=='siswa'): ?>
             <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $siswa['nama'] ?>  </li>
			 <?php else : ?>
			 <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $peg['nama'] ?></li>
			 <?php endif; ?>
           <?php endwhile; ?>  
		   
		   <?php elseif($sts['mode']=='5'): ?>
               <h5 data-animation="animated fadeInDownBig">ABSEN PIKET MALAM</h5>
			<ul>
				<?php
				$query = mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE tanggal='$tanggal' and ket='malam' ORDER BY id DESC LIMIT 8"); 			
				while ($data = mysqli_fetch_array($query)) :
				 
				 $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
                ?>
          
			 <li data-animation="animated fadeInDownBig" data-delay="1s"><?= $peg['nama'] ?></li>
			
           <?php endwhile; ?>  
		   
		   
		 <?php endif; ?>
      
		
                 </div>
                </div>
			</div>
		