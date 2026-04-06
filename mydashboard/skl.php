<?php 
defined('APK') or exit('No Access');
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
?>
<style>


#clockdiv{
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 20;
  text-align: center;
  font-size: 20px;
}

#clockdiv > div{
  padding: 10px;
  border-radius: 3px;
  background: #00BF96;
  display: inline-block;
}

#clockdiv div > span{
  padding: 15px;
  border-radius: 3px;
  background: #00816A;
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 16px;
}

  .form-container {
      display: none; /* All forms hidden by default */
    }
/* visit: http://www.dumetschool.com/ */
.h3 {
transform:rotate(-20deg);
-ms-transform:rotate(-20deg); /* IE 9 */
-webkit-transform:rotate(-20deg); /* Safari and Chrome */
}

</style>
<div class="row">
<div class="col-md-6">
	<div class="card">
	<div class="card-body text-center"> 
	<div class="d-flex align-items-center flex-column">
		<div class="sw-13 position-relative mb-3">
		
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
					</div>
				<div class="text-muted">E KELULUSAN</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
				<div class="text-muted">HIGH SCHOOL</div>
					</div>
				<br>
				<div class="h5 mb-0 text-center">
				<?php if($waktumu < $skl['dibuka']): ?>
				PENGUMUMAN DIBUKA DALAM
				<?php endif; ?>
				<?php if($waktumu >= $skl['dibuka'] AND $waktumu <= $skl['ditutup']): ?>
				PENGUMUMAN SUDAH DIBUKA
				<?php endif; ?>
				<?php if($waktumu >= $skl['ditutup']): ?>
				PENGUMUMAN DITUTUP
				<?php endif; ?>
				</div>
				<?php if($waktumu < $skl['dibuka']): ?>
				<div id="clockdiv">
					<div>
					<span class="days"></span>
					<div class="smalltext">Hari</div>
					</div>
					 <div>
					<span class="hours"></span>
					<div class="smalltext">Jam</div>
					</div>
					<div>
					<span class="minutes"></span>
					<div class="smalltext">Menit</div>
					</div>
					<div>
					<span class="seconds"></span>
					<div class="smalltext">Detik</div>
					</div>
					</div> 
                    <?php endif; ?>					
						</div>					
				 </div>
				  </div>
			 
				  <div class="col-md-6">                  
				<div class="card">
				<div class="card-body">			 
				<div class="d-flex align-items-center flex-column">
					<div class="sw-13 position-relative">
					<?php if($siswa['foto']<>''): ?>
						<img src="<?= $baseurl ?>/images/fotosiswa/<?= $siswa['foto'] ?>" class="responsive" alt="thumb" />								
					<?php else : ?>		
					<img src="<?= $baseurl ?>/images/siswa.png" class="responsive" alt="thumb" />	
						<?php endif; ?>		
								</div>
							<div class="text-muted">E KELULUSAN</div>
							
							<div class="text-muted"><?= $siswa['kelas'] ?> <?= $siswa['jurusan'] ?></div>
						</div>
						<?php if($waktumu < $skl['dibuka']): ?>
							<div class="d-flex align-items-center flex-column">
							<br>
							<img src="<?= $baseurl ?>/images/animasi.gif" class="responsive" alt="thumb" />	
							<br>
							<div class="text-muted">MENUNGGU KELULUSAN</div>
						<div class="h5 mb-0"><?= $siswa['nama'] ?></div>
						<div class="text-muted">Semoga Lulus</div>
							</div>
							<?php endif; ?>	
							<?php if($waktumu >= $skl['dibuka'] AND $waktumu <= $skl['ditutup']): ?>
							<div class="h5 mb-2 text-center"><?= $siswa['nama'] ?></div>
							<br>
							<div class="d-flex align-items-center flex-column">
							<input type="image" name="submit" src="../images/amplop.png"  width="200px"  id="A" >
							</div>
							<div class="form-container" id="formB">
							<div class="d-flex align-items-center flex-column" style="height:200px">
							<img src="../images/buka.png" width="300px" >
							
							<?php if($siswa['ket']=='0'): ?>
							<h3 style="margin-top:-130px;text-align:center;font-weight:bold;color:red" class="h3">TIDAK LULUS</h3>
							
							<?php endif; ?>
							<?php if($siswa['ket']=='1'): ?>
							
							<h3 style="margin-top:-130px;text-align:center;font-weight:bold;color:green" class="h3">LULUS</h3>
							
							<?php endif; ?>
							<?php if($siswa['ket']=='2'): ?>
							<div class="h4 mb-2 text-center">
			
							<h3 style="margin-top:-130px;text-align:center;font-weight:bold;color:blue" class="h3">LULUS BERSYARAT</h3>
							</div>
							<?php endif; ?>
							</div>
							  <?php if($siswa['ket']<>0): ?>
				            <div class="col-xl-12">
								<div class="card widget widget-stats">
									<div class="card-body">
									<div class="widget-stats-container d-flex">
								<div class="widget-stats-icon widget-stats-icon-warning">
								   <i class="material-icons-outlined">mail</i>
									 </div>
								 <div class="widget-stats-content flex-fill">
								 <span class="widget-stats-title">DOWNLOAD KELULUSAN</span>
									  <span class="widget-stats-info">
									  <a href="print_skl.php?ids=<?= $siswa['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-link"><i class="material-icons">download</i> Download</a>
									  </span>
									   </div>
									 </div>
									</div>
								   </div>
							   </div>
							 
				            <div class="col-xl-12">
								<div class="card widget widget-stats">
									<div class="card-body">
									<div class="widget-stats-container d-flex">
								<div class="widget-stats-icon widget-stats-icon-success">
								   <i class="material-icons-outlined">webhook</i>
									 </div>
								 <div class="widget-stats-content flex-fill">
								 <span class="widget-stats-title">DOWNLOAD SKKB</span>
									  <span class="widget-stats-info">
									  <a href="cetakskkb.php?ids=<?= $siswa['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-link"><i class="material-icons">download</i> Download</a>
									  </span>
									   </div>
									 </div>
									</div>
								   </div>
							   </div>
							   
							<div class="col-xl-12">
								<div class="card widget widget-stats">
									<div class="card-body">
									<div class="widget-stats-container d-flex">
								<div class="widget-stats-icon widget-stats-icon-primary">
								   <i class="material-icons-outlined">select_all</i>
									 </div>
								 <div class="widget-stats-content flex-fill">
								 <span class="widget-stats-title">DOWNLOAD TRANSKIP</span>
									  <span class="widget-stats-info">
									  <a href="transkipnilai.php?ids=<?= $siswa['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-link"><i class="material-icons">download</i> Download</a>
									  </span>
									   </div>
									 </div>
									</div>
								   </div>
							   </div>   
				           <?php endif; ?>
						     <?php endif; ?>
							</div>
						  </div>
						</div>
				     </div>
                     </div>
		<script>
		$("#A").click(function() {
			$("#formB").show(); 
			$("#A").hide();
			});
		</script>
	<script>
	function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}
const deadline = "<?= $skl['dibuka'] ?>";

initializeClock('clockdiv', deadline);
</script>
