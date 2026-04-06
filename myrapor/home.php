<?php 
defined('APK') or exit('No Access');
?>
<style>
.divTable {
    width: 100%;
    display: table;
  
}
.divTableRow {
    width: 100%;
    height: 100%;
    display: table-row;
}
.divTableCell{
    padding:10px;
    width: 30%;
    height: 100%;
    display: table-cell;
    
}


</style>
<div class="row">
<div class="col-md-4">
	<div class="card" style="height:550px;">
  <div class="d-flex align-items-center flex-column mb-4">
	<div class="d-flex align-items-center flex-column">
		<div class="sw-13 position-relative mb-3">
		<br>
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
					</div>
				<div class="text-muted">E RAPOR</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
				<div class="text-muted">HIGH SCHOOL</div>
					</div>
				</div>	
				<div class="divTable">
					  <div class="divTableRow" >
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('menu13') ?>" ><img src="../images/icon/k13.ico"></a><br>K-2013 </div>
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('menu23') ?>"><img src="../images/icon/sandik.ico"></a><br>K-Merdeka </div>
					<div class="divTableCell text-center"><a href="../myproyek/" ><img src="../images/icon/p5.ico"></a><br>Projek </div>
			
					</div>
					
                </div>
				 </div>
				  </div>
			<?php 
			$ki3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ki,smt,tp FROM nilai_rapor where ki='KI-3' and smt='$semester' and tp='$tapel'"));
			$ki4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ki,smt,tp FROM nilai_rapor where ki='KI-4' and smt='$semester' and tp='$tapel'"));
			$spi = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sikap where ket='SPI' and smt='$semester' and tp='$tapel'"));
			$sos = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sikap where ket='SOS' and smt='$semester' and tp='$tapel'"));			
			$ki33 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PH' and smt='$semester' and tp='$tapel'"));
			$ki44 = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket,smt,tp FROM nilai_sumatif where ket='PTS' and smt='$semester' and tp='$tapel'"));
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
				   <div class="col-xl-6">
                    <div class="card widget widget-stats">
                        <div class="card-body">
                        <div class="widget-stats-container d-flex">
                    <div class="widget-stats-icon widget-stats-icon-success">
                       <i class="material-icons-outlined">webhook</i>
                         </div>
                     <div class="widget-stats-content flex-fill">
                     <span class="widget-stats-title">NILAI SUMATIF (PH)</span>
                           <span class="widget-stats-amount"><?= $ki33; ?></span>
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
                           <span class="widget-stats-amount"><?= $ki44; ?></span>
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