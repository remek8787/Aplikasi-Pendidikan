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
</style>
<div class="row">
<div class="col-md-4">
	<div class="card">
	<div class="card body">
  <div class="d-flex align-items-center flex-column mb-4">
	<div class="d-flex align-items-center flex-column">
		<div class="sw-13 position-relative mb-3">
		<br>
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
					</div>
				<div class="text-muted">E KELULUSAN</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
				<div class="text-muted">HIGH SCHOOL</div>
					</div>
				</div>	
				
				<div class="h5 mb-0 text-center">
				<?php if($waktumu < $skl['dibuka']): ?>
				PENGUMUMAN DIBUKA
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
			<?php 
			$smt = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket FROM nilai_skl where ket='SMT'"));
			$uji = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket FROM nilai_skl where ket='US'"));
			?>	  
				  
				<div class="col-md-8">  
				<div class="row">
				  <div class="col-xl-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                        <div class="widget-stats-container d-flex">
                    <div class="widget-stats-icon widget-stats-icon-success">
                       <i class="material-icons-outlined">webhook</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI SEMESTER</span>
                           <span class="widget-stats-amount"><?= $smt; ?></span>
                          <span class="widget-stats-info"></span>
                           </div>
                         </div>
                        </div>
                       </div>
				   </div>
				   
				    <div class="col-xl-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                        <div class="widget-stats-container d-flex">
                    <div class="widget-stats-icon widget-stats-icon-primary">
                       <i class="material-icons-outlined">webhook</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI UJIAN</span>
                           <span class="widget-stats-amount"><?= $uji; ?></span>
                          <span class="widget-stats-info"></span>
                           </div>
                         </div>
                        </div>
                       </div>
				   </div>
				   <div class="card">
                     <div class="card-body"> 
                   <canvas id="myChart"></canvas>					 
		
				   
				   </div>
				  </div>
				 
				 </div>
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
<script src="../assets/chartjs/chart.js"></script>
        <script>		
		<?php 		
		$sql = mysqli_query($koneksi,"select * from mapel_rapor WHERE level='$skl[tingkat]' GROUP BY idmapel");
		while($dr = mysqli_fetch_array($sql)){
			$mpl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$dr[idmapel]'"));
			$mapel[] = $mpl['kode'];
			
		$nilai = mysqli_query($koneksi,"select * from nilai_skl where mapel='$mpl[id]'");
		$jumlah[] = mysqli_num_rows($nilai);
		}
	 ?>
	const ctx = document.getElementById('myChart');
	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($mapel); ?>,
			datasets: [{
				label: 'Jumlah Data',
				data: <?php echo json_encode($jumlah); ?>,
				backgroundColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(255, 128, 6, 0.8)'
					],
				borderColor: [
					'rgba(255, 99, 71, 1)',
					'rgba(9, 31, 242, 0.8)',
					'rgba(255, 128, 6, 0.8)'
					],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>