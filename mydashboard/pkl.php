<?php 
defined('APK') or exit('No Access');
$jabsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa'"));
$jkeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa'"));
$jurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa ='$id_siswa'"));


$cari_absen = mysqli_query($koneksi, "select * from pkl_kegiatan where idsiswa='$id_siswa' and tanggal='$tanggal'");
$jumlah_absen = mysqli_num_rows($cari_absen);
$dataku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa' and status='1'"));
$menupkl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_siswa where idsiswa ='$id_siswa'"));
$jurnalku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa='$id_siswa' and tanggal='$tanggal'"));
$juragan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa' and tanggal='$tanggal' and ttd<>''"));
$absenku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa' and pulang<>'' and tanggal='$tanggal'"));
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
    width: 50%;
    height: 100%;
    display: table-cell;
    
}


</style>
		<div class="row">
				<div class="col-xl-4">
				<div class="card">
				  <div class="card card-header text-center">
				   <h5 class="card-tittle">MENU PRAKERIN SISWA</h5>
				   </div>
                   <div class="card-body">
				    <div class="d-flex align-items-center flex-column mb-4">
						<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
						<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
							</div>
							
					<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
						<div class="text-muted">HIGH SCHOOL</div>
							</div>
					</div>
					<?php if($menupkl==1): ?>
				   <div class="divTable">
					  <div class="divTableRow" >
					  <?php $jreg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_reg where idsiswa='$id_siswa'")); ?>
					<?php if($jreg==0): ?>
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('register') ?>" ><img src="../images/icon/eabsen.ico"></a><br>Registrasi Wajah</div>
					<?php else: ?>
					<div class="divTableCell text-center"><a href="#" ><img src="../images/icon/eabsen.ico"></a><p style="color:red" >Registrasi Sukses</p></div>
					<?php endif; ?>
					<?php if($jumlah_absen==0): ?>
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('absen') ?>" ><img src="../images/icon/presensi.ico"></a><p>E Presensi</p> </div>
					<?php else: ?>
					<div class="divTableCell text-center"><a href="#" ><img src="../images/icon/presensi.ico"></a><p style="color:red" >Sudah Absen</p></div>
					<?php endif; ?>
					</div>
					<?php $edis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$id_siswa' and tanggal='$tanggal'")); ?>
					<?php if($jumlah_absen<>0): ?>
					<div class="divTableRow" >
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('kegiatan') ?>"><img src="../images/icon/payment.ico"></a>
					<?php if($edis['kegiatan']<>'' and $edis['status']=='0'): ?><p style="color:blue">Menunggu Aprove</p><?php endif; ?>
					<?php if($edis['kegiatan']=='' and $edis['status']=='0'): ?><p style="color:black">Input Kegiatan</p><?php endif; ?>
					<?php if($edis['kegiatan']<>'' and $edis['status']=='1'): ?><p style="color:green">Kegiatan Selesai</p><?php endif; ?>
					<?php if($edis['kegiatan']<>'' and $edis['status']=='2'): ?><p style="color:blue">Silahkan Ulangi</p><?php endif; ?>
					</div>
				
					<?php $sandik = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_jurnal WHERE idsiswa='$id_siswa' and tanggal='$tanggal'")); ?>
				<?php if($dataku==1): ?>
					<?php if($jurnalku==0 and $edis['status']=='1'): ?>
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('jurnal') ?>" ><img src="../images/icon/kantin.ico"></a><p>Jurnal Prakerin</p></div> 
						<?php endif; ?>
						<?php if($jurnalku==1 and $sandik['status']=='0'): ?>
					<div class="divTableCell text-center"><a href="#" ><img src="../images/icon/kantin.ico"></a><br><p style="color:blue" >Menunggu Aprove</p></div>			
						<?php endif; ?>
						<?php if($jurnalku==1 and $sandik['status']=='1'): ?>
					<div class="divTableCell text-center"><a href="#" ><img src="../images/icon/kantin.ico"></a><br><p style="color:red" >Jurnal Selesai</p></div>			
						<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="divTableRow" >
					<?php if($jurnalku==1 and $sandik['status']=='1' and $edis['ttd']==''): ?>			
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('tandatangan') ?>"><img src="../images/icon/digital.ico"></a>
					<?php if($edis['ttd']==''): ?><p>TTD Instruktur</p><?php endif; ?><?php if($edis['ttd']<>''): ?><p style="color:red">TTD Selesai</p><?php endif; ?></div>
						<?php endif; ?>
					<?php if($jurnalku==1 and $sandik['status']=='1' and $edis['ttd']<>''): ?>
					<div class="divTableCell text-center"><a href="#"><img src="../images/icon/digital.ico"></a>
					<?php if($edis['ttd']==''): ?><p>TTD Instruktur</p><?php endif; ?><?php if($edis['ttd']<>''): ?><p style="color:red">TTD Selesai</p><?php endif; ?></div>
										
						<?php endif; ?>
						<?php if($juragan==1): ?>
						<?php if($sandik['pulang']<>''): ?>
						<div class="divTableCell text-center"><a href="#"><img src="../images/icon/absent1.ico"></a><p style="color:red">Hati2 di Jalan</p></div>
						<?php else: ?>
						<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('absen') ?>"><img src="../images/icon/absent1.ico"></a><br>Presensi Pulang</div>
						<?php endif; ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					</div>
						<?php endif; ?>
					</div>
               </div>
			  </div>
			 	
				 <div class="col-xl-8">
					    <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">MY PRESENSI</span>
                                                <span class="widget-stats-amount"><?= $jabsis; ?> </span>
                                               
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
                                                <span class="widget-stats-title">MY KEGIATAN</span>
                                                <span class="widget-stats-amount"><?= $jkeg; ?></span>
                                               
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-info">
                                                <i class="material-icons-outlined">edit</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">MY JURNAL</span>
                                                <span class="widget-stats-amount"><?= $jurnal; ?></span>
                                               
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">APROVE DATAKU</span>
                                                <span class="widget-stats-amount"><?= $dataku; ?></span>
                                               
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-12">
							<div class="row">
							<div class="col-xl-5">
							 <div class="card">
                              <div class="card-body">
							  
							<marquee direction="down"><center> <h4><?= $siswa['nama'] ?></h4> <img src="../images/kegiatan.png" style="width:30%;height:auto"></center> <table width="100%">
						<tr><td>Jam Masuk</td><td><?= $edis['jam'] ?></td></tr>
						<tr><td>Kegiatan</td><td><?= $edis['kegiatan'] ?></td></tr>
						<tr><td>Instruktur</td><td><?= $edis['instruktur'] ?></td></tr>
						<?php if($edis['ttd']<>''): ?>
						<tr><td>Telah di tanda tangani</td><td><img src="../images/ttd/<?= $edis['ttd'] ?>" width="80px"></td></tr>	
						<?php else: ?>
						<tr><td colspan="2" style="color:red">Belum di tanda tangani</td></tr>
						<?php endif; ?>
						<tr><td>Jam Pulang</td><td><?= $sandik['pulang'] ?></td></tr>
						</table></marquee>
							</div>
							</div>
						</div>
						<div class="col-xl-7">
						<div class="card">
                              <div class="card-body edis2">
							  
						<h4><?= $siswa['nama'] ?></h4> 
						<hr>
						<p>Data Kegiatan <?= date('d') ?> <?= bulan_indo($tanggal) ?> <?= $tahun ?></p>
						<hr>
						<table width="100%">
						<tr><td>Jam Masuk</td><td><?= $edis['jam'] ?></td></tr>
						<tr><td>Kegiatan</td><td><?= $edis['kegiatan'] ?></td></tr>
						<tr><td>Instruktur</td><td><?= $edis['instruktur'] ?></td></tr>
						<?php if($edis['ttd']<>''): ?>
						<tr><td>Telah di tanda tangani</td><td><img src="../images/ttd/<?= $edis['ttd'] ?>" width="80px"></td></tr>	
						<?php else: ?>
						<tr><td colspan="2" style="color:red">Belum di tanda tangani</td></tr>
						<?php endif; ?>
						<tr><td>Jam Pulang</td><td><?= $sandik['pulang'] ?></td></tr>
						</table>
						       </div>
							</div>
							</div>
                           </div>
						</div>
					</div>
					</div>
					</div>	