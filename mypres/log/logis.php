<?php 
require("../../konek/koneksi.php");
require("../../konek/function.php");
require("../../konek/crud.php");
$jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE tanggal='$tanggal'"));

?>
<style>
.respone {
  width: 260px;
  height: 270px;
  text-align:center;
}
</style>

		<div class="card">
        <div class="card card-header">
			<h5 class="card-title" style="text-align:center">LIVE PRESENSI GURU DALAM KBM</h5>
		</div>                           
            <div class="card-body">
			 <?php if($jml==0): ?>
	   <img src="<?= $baseurl ?>/images/animasi.gif" >
	   Menunggu....
	   <?php else: ?>
				
				 <?php
		$query = mysqli_query($koneksi, "SELECT * FROM absen_jjm WHERE tanggal='$tanggal' ORDER BY id DESC LIMIT 1"); 
		while ($data = mysqli_fetch_assoc($query)) :
		$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
		$foto='../images/guru.png';
		$pel = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
		$ket='<h4 style="color:blue;font-weight:bold">MASUK KELAS</h4>';
		?>
	    <div class="d-flex align-items-center flex-column mb-4">
			<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">

				<?php if($peg['foto']<>''){ ?>
				<img src="<?= $baseurl ?>/images/fotoguru/<?= $peg['foto'] ?>" class="respone" alt="thumb" />
				<?php }else{ ?>
				<img src="<?= $foto ?>" class="respone" alt="thumb" />
				<?php } ?>			
			</div>
			<h5 style="color:green;"><?= $pel['kode'] ?></h5>			
			<h5 class="bold">KELAS <?= $data['kelas'] ?> <label style="width:5px;display: inline-block;"></label><?= $data['jjm'] ?> JP</h5>
			<div class="h5 mb-0"><?= $peg['nama'] ?></div>			
			<?= $ket ?>		
			</div>
		</div>
	   <?php endwhile; ?>	   
		<?php endif; ?>
      </div>