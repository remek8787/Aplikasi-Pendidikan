<div class="row">
<div class="col-md-4">
	<div class="card" style="height:550px;">
  <div class="d-flex align-items-center flex-column mb-4">
	<div class="d-flex align-items-center flex-column">
		<div class="sw-13 position-relative mb-3">
		<br>
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
					</div>
				<div class="text-muted">RAPOR KURIKULUM 2013</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
				<div class="text-muted">HIGH SCHOOL</div>
					</div>
				</div>	
            <div class="app-menu">
               <ul class="accordion-menu">
			   <li>
				<a href="#"><i class="material-icons-two-tone">settings</i>Master Rapor<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
					<ul class="sub-menu">
					<?php if($user['level']=='admin'): ?>
					<li><a href="?pg=<?= enkripsi('kkm') ?>">KKM Rapor K-2013</a></li>
					<li><a href="?pg=<?= enkripsi('sikap') ?>">Mapel Nilai Sikap</a></li>
					<?php endif; ?>
					<li><a href="?pg=<?= enkripsi('desrapor') ?>">Deskripsi (K-2013)</a></li>
					
					</ul>
				  </li>
				<li>
				<a href="#"><i class="material-icons-two-tone">star</i>Rapor PTS K-13<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
					<ul class="sub-menu">
					<li><a href="?pg=<?= enkripsi('ph') ?>">Nilai PH SMT <?= $semester ?></a></li>	
					<li><a href="?pg=<?= enkripsi('pts') ?>">Nilai PTS SMT <?= $semester ?></a></li>
				</ul>
				 </li>
                <li>
					<a href="#"><i class="material-icons-two-tone">rate_review</i>Rapor PAS/PAT K-13<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
						<ul class="sub-menu">
						<li><a href="?pg=<?= enkripsi('ph') ?>">Nilai PH SMT <?= $semester ?></a></li>	
						<?php if($setting['semester']==1): ?>
						<li><a href="?pg=<?= enkripsi('pas') ?>">Nilai PAS SMT <?= $semester ?></a></li>
						<?php else: ?>
						<li><a href="?pg=<?= enkripsi('pat') ?>">Nilai PAT SMT <?= $semester ?></a></li>
						<?php endif; ?>
						<li><a href="?pg=<?= enkripsi('deskrip3') ?>">Nilai Deskripsi</a></li>	
						<li><a href="?pg=<?= enkripsi('nsikap') ?>">Nilai Sikap</a></li>	
							
					</ul>
					 </li>        
                    </ul>
                </div>
				 </div>
				  </div>
			<?php 
			$ki3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ki,smt,tp FROM nilai_rapor where ki='KI-3' and smt='$semester' and tp='$tapel'"));
			$ki4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ki,smt,tp FROM nilai_rapor where ki='KI-4' and smt='$semester' and tp='$tapel'"));
			$spi = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sikap where ket='SPI' and smt='$semester' and tp='$tapel'"));
			$sos = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sikap where ket='SOS' and smt='$semester' and tp='$tapel'"));			
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
                     <span class="widget-stats-title">NILAI PENGETAHUAN</span>
                           <span class="widget-stats-amount"><?= $ki3; ?></span>
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
                     <span class="widget-stats-title">NILAI KETERAMPILAN</span>
                           <span class="widget-stats-amount"><?= $ki4; ?></span>
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
                    <div class="widget-stats-icon widget-stats-icon-success">
                       <i class="material-icons-outlined">star</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI SIKAP SPIRITUAL</span>
                           <span class="widget-stats-amount"><?= $spi; ?></span>
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
                       <i class="material-icons-outlined">star</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI SIKAP SOSIAL</span>
                           <span class="widget-stats-amount"><?= $sos; ?></span>
                          <span class="widget-stats-info"></span>
                           </div>
                         </div>
                        </div>
                       </div>
				   </div>
				   </div>
				  </div>
				 
				 </div>