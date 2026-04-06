<div class="row">
<div class="col-md-4">
	<div class="card" style="height:550px;">
  <div class="d-flex align-items-center flex-column mb-4">
	<div class="d-flex align-items-center flex-column">
		<div class="sw-13 position-relative mb-3">
		<br>
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
					</div>
				<div class="text-muted">RAPOR KURIKULUM MERDEKA</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
				<div class="text-muted">HIGH SCHOOL</div>
					</div>
				</div>	
            <div class="app-menu">
               <ul class="accordion-menu">
			   <li>
				<a href="#"><i class="material-icons-two-tone">settings</i>Master Rapor<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
					<ul class="sub-menu">
					<li><a href="?pg=<?= enkripsi('desmer') ?>">Capaian Pembelajaran</a></li>
					</ul>
				  </li>
				<li>
				<a href="#"><i class="material-icons-two-tone">star</i>Rapor PTS K-Merdeka<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
					<ul class="sub-menu">
					<li><a href="?pg=<?= enkripsi('sumatif') ?>">Nilai PH (Sumatif) <?= $semester ?></a></li>
					<li><a href="?pg=<?= enkripsi('pts2') ?>">Nilai PTS (Sumatif) <?= $semester ?></a></li>	
				</ul>
				 </li>
                <li>
					<a href="#"><i class="material-icons-two-tone">rate_review</i>Rapor PAS/PAT K-Merdeka<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
						<ul class="sub-menu">
						<li><a href="?pg=<?= enkripsi('sumatif') ?>">Nilai PH (Sumatif) <?= $semester ?></a></li>
						<?php if($setting['semester']==1): ?>
						<li><a href="?pg=<?= enkripsi('sumatifpas') ?>">Nilai PAS (Sumatif) <?= $semester ?></a></li>
						<?php else: ?>
						<li><a href="?pg=<?= enkripsi('sumatifpat') ?>">Nilai PAT (Sumatif) <?= $semester ?></a></li>
						<?php endif; ?>
						<li><a href="?pg=<?= enkripsi('formatif') ?>">Nilai Formatif</a></li>		
					</ul>
					 </li>        
                    </ul>
                </div>
				 </div>
				  </div>
				<?php 
			$ki3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PH' and smt='$semester' and tp='$tapel'"));
			$ki4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PTS' and smt='$semester' and tp='$tapel'"));
			$pas = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PAS' and smt='$semester' and tp='$tapel'"));
			$pat = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PAT' and smt='$semester' and tp='$tapel'"));			
			$ki2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT smt,tp FROM nilai_formatif where smt='$semester' and tp='$tapel'"));			
			
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
                     <span class="widget-stats-title">NILAI SUMATIF (PH)</span>
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
                     <span class="widget-stats-title">NILAI SUMATIF (PTS)</span>
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
                       <i class="material-icons-outlined">select_all</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
					 <?php if($semester=='1'): ?>
                     <span class="widget-stats-title">NILAI SUMATIF (PAS)</span>
                           <span class="widget-stats-amount"><?= $pas; ?></span>
						<?php else : ?>   
					 <span class="widget-stats-title">NILAI SUMATIF (PAT)</span>
                           <span class="widget-stats-amount"><?= $pat; ?></span>
						<?php endif; ?>   
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
                       <i class="material-icons-outlined">menu</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI FORMATIF</span>
                           <span class="widget-stats-amount"><?= $ki2; ?></span>
                          <span class="widget-stats-info"></span>
                           </div>
                         </div>
                        </div>
                       </div>
				   </div>
				   </div>
				  </div>
				 
				 </div>