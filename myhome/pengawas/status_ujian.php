<?php
$nilaiq = mysqli_query($koneksi, "SELECT nilai.id_nilai,nilai.id_ujian,nilai.id_bank,nilai.id_siswa,nilai.ipaddress,nilai.jumjawab,nilai.browser,
nilai.ujian_mulai,nilai.ujian_selesai,nilai.ujian_berlangsung,nilai.nilai,
ujian.id_ujian,ujian.pelanggaran ,ujian.status FROM nilai LEFT JOIN ujian ON nilai.id_ujian=ujian.id_ujian  where ujian.status='1' and nilai.id_siswa<>'' and nilai.id_ujian='$_GET[id]' ORDER BY nilai.id_nilai DESC");

$uj = fetch($koneksi,'ujian',['id_ujian'=>$_GET['id']]);
 ?>

   <div class='row'>
	<?php if($uj['pelanggaran']==0): ?>
    <div class='col-md-12'>
	<?php else : ?>
	 <div class='col-md-12'>
	<?php endif; ?>
            <div class="card">
                  <div class="card-header">
				
                    <h5 class="bold"><span class="badge badge-primary"><?= $uj['nama'] ?></span> <span class="badge badge-dark">SESI <?= $uj['sesi'] ?></span> <span class="badge badge-success"> TINGKAT <?= $uj['level'] ?></span> </h5>
					<div class="pull-right">
					  <a href="." class="btn btn-danger">BACK</a>
					  
					  </div>
					<br>
					<?php if($uj['pelanggaran']==0): ?>
					
					<?php else : ?>
                     <span class="badge badge-secondary kanan">RESET BROWSER</span>
						<?php endif; ?>
					</div>
                <div class='card-body'>
				
                    <div id='logstatus'>


 
			</div>
		</div>
	</div>
</div>
<?php if($uj['pelanggaran']==0): ?>
<?php else : ?>
		
			<?php endif; ?>	
		</div>	
	
  <script>
    var autoRefresh = setInterval(
        function() {
            <?php if (isset($_GET['id'])) { ?>
                $('#logstatus').load("pengawas/semua_status.php?idu=<?= $_GET['id'] ?>");
				
            <?php } ?>
        }, 3000
    );

   
</script>

 