<?php 
defined('APK') or exit('No Access');
$jdudi = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pkl_dudi"));
$jprak = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pkl_siswa"));
$jpem = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pkl_pembimbing"));
$jkom = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pkl_kompetensi"));
$panitia = fetch($koneksi,'pkl_panitia');
$jumlahjurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT status FROM pkl_jurnal WHERE status='1' and tanggal='$tanggal'"));
$jumlahkegiatan = mysqli_num_rows(mysqli_query($koneksi, "SELECT status FROM pkl_kegiatan WHERE status='1' and kegiatan<>'' and tanggal='$tanggal'"));

?>

<?php if($user['level']=='admin'): ?>

            <div class="row">
				 <div class="col-md-5">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">APROVE DATA KEGIATAN</h5>
										</div>
                                    <div class="card-body">
									<div class="row">
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE status='0' and kegiatan<>'' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											 <div class="col-md-9">
                                           <button type="button" class="btn btn-dark">
									<?= $siswa['nama'] ?> <span class="badge badge-danger m-l-xxs"><?= date('d M Y',strtotime($data['tanggal'])); ?></span>
									</button>
									</div>
									 <div class="col-md-3">
									<a href="?pg=<?= enkripsi('status') ?>&id=<?= $data['id'] ?>" class="btn  btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove"><i class="material-icons">visibility</i></a>
										</div>
										<?php endwhile; ?>
										   </div>
										   <?php if($jumlahkegiatan<>0): ?>
										   Sudah di Aprove
										   <marquee><img src="../images/kegiatan.png" style="width:10%;height:auto"> 
										   <?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE status='1' and kegiatan<>'' and tanggal='$tanggal'");
											while ($datax = mysqli_fetch_array($queryx)) :
											$siswax = fetch($koneksi,'siswa',['id_siswa'=>$datax['idsiswa']]);
											
											$no++;
											   ?>
											    <?= $no ?>. <?= $siswax['nama'] ?>
										   <?php endwhile; ?>
										   
										   </marquee>
										   <?php endif; ?>
										   <hr>
										  
									<h5 class="card-title">APROVE DATA JURNAL</h5>
									
										   <div class="row">
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal WHERE status='0' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											 <div class="col-md-9">
                                           <button type="button" class="btn btn-dark">
									<?= $siswa['nama'] ?> <span class="badge badge-danger m-l-xxs"><?= date('d M Y',strtotime($data['tanggal'])); ?></span>
									</button>
									</div>
									 <div class="col-md-3">
									<a href="?pg=<?= enkripsi('statusjurnal') ?>&id=<?= $data['id'] ?>" class="btn  btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove"><i class="material-icons">visibility</i></a>
										</div>
										<?php endwhile; ?>
										   </div>
										   <?php if($jumlahjurnal<>0): ?>
										     Sudah di Aprove
										   <marquee><img src="../images/kegiatan.png" style="width:10%;height:auto">
										  
										  <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal WHERE status='1' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											   <?= $no ?>. <?= $siswa['nama'] ?>
										   <?php endwhile; ?>
										   </marquee>
										   <?php endif; ?>
										 </div>
										</div>
									</div>
			  
					 
					   <div class="col-xl-7">
					    <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">star</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DATA DUDI</span>
                                                <span class="widget-stats-amount"><?= $jdudi; ?> </span>
                                               
                                            </div>
                                          <i class="material-icons-outlined" style="color:gold">star</i>
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
                                                <span class="widget-stats-title">SISWA PRAKERIN</span>
                                                <span class="widget-stats-amount"><?= $jprak; ?></span>
                                               
                                            </div>
                                             <i class="material-icons-outlined" style="color:gold">star</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            
											<div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PEMBIMBING</span>
                                                <span class="widget-stats-amount"><?= $jpem ?> </span>
                                              
                                            </div>
                                            <i class="material-icons-outlined" style="color:gold">star</i>
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
                                                <span class="widget-stats-title">KOMPETENSI</span>
                                                <span class="widget-stats-amount"><?= $jkom ?></span>
                                            </div>
                                             <i class="material-icons-outlined" style="color:gold">star</i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
						 <div class="col-xl-6">
                      <div class="card widget widget-payment-request">
					    <div class="card-body">
					 <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                     <div class="avatar m-r-sm">
                         <img src="../images/guru.png" alt="">
                       </div>
                    <div class="widget-payment-request-author-info">
                  <span class="widget-payment-request-author-name"><?= $panitia['ketua'] ?></span>
                  <span class="widget-payment-request-author-about">KETUA PANITIA</span>
					<p style="color:blue;">PRAKERIN</p>
                   </div>
                 </div>
               </div>
			</div>
		 </div>
      </div>  
	  <div class="col-xl-6">
                      <div class="card widget widget-payment-request">
					    <div class="card-body">
					 <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                     <div class="avatar m-r-sm">
                         <img src="../images/guru.png" alt="">
                       </div>
                    <div class="widget-payment-request-author-info">
                 <span class="widget-payment-request-author-name"><?= $panitia['sekretaris'] ?></span>
                  <span class="widget-payment-request-author-about">SEKRETARIS</span>
					<p style="color:blue;">PRAKERIN</p>
                   </div>
                 </div>
               </div>
			</div>
		 </div>
      </div>  
   </div>
 </div>  
 </div>   
	<?php endif; ?>
	<?php if($user['level']=='guru'): ?>
	
            <div class="row">
				 <div class="col-md-5">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">APROVE DATA KEGIATAN</h5>
										</div>
                                    <div class="card-body">
									<div class="row">
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE status='0' and kegiatan<>'' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											 <div class="col-md-9">
                                           <button type="button" class="btn btn-dark">
									<?= $siswa['nama'] ?> <span class="badge badge-danger m-l-xxs"><?= date('d M Y',strtotime($data['tanggal'])); ?></span>
									</button>
									</div>
									 <div class="col-md-3">
									<a href="?pg=<?= enkripsi('status') ?>&id=<?= $data['id'] ?>" class="btn  btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove"><i class="material-icons">visibility</i></a>
										</div>
										<?php endwhile; ?>
										   </div>
										   <?php if($jumlahkegiatan<>0): ?>
										   Sudah di Aprove
										   <marquee><img src="../images/kegiatan.png" style="width:10%;height:auto"> 
										   <?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE status='1' and kegiatan<>'' and tanggal='$tanggal'");
											while ($datax = mysqli_fetch_array($queryx)) :
											$siswax = fetch($koneksi,'siswa',['id_siswa'=>$datax['idsiswa']]);
											
											$no++;
											   ?>
											    <?= $no ?>. <?= $siswax['nama'] ?>
										   <?php endwhile; ?>
										   
										   </marquee>
										   <?php endif; ?>
										   <hr>
										  
									<h5 class="card-title">APROVE DATA JURNAL</h5>
									
										   <div class="row">
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal WHERE status='0' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											 <div class="col-md-9">
                                           <button type="button" class="btn btn-dark">
									<?= $siswa['nama'] ?> <span class="badge badge-danger m-l-xxs"><?= date('d M Y',strtotime($data['tanggal'])); ?></span>
									</button>
									</div>
									 <div class="col-md-3">
									<a href="?pg=<?= enkripsi('statusjurnal') ?>&id=<?= $data['id'] ?>" class="btn  btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove"><i class="material-icons">visibility</i></a>
										</div>
										<?php endwhile; ?>
										   </div>
										   <?php if($jumlahjurnal<>0): ?>
										     Sudah di Aprove
										   <marquee><img src="../images/kegiatan.png" style="width:10%;height:auto">
										  
										  <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal WHERE status='1' and tanggal='$tanggal'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											
											$no++;
											   ?>
											   <?= $no ?>. <?= $siswa['nama'] ?>
										   <?php endwhile; ?>
										   </marquee>
										   <?php endif; ?>
										 </div>
										</div>
									</div>
			  
					 
					   <div class="col-xl-7">
					    <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">star</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DATA DUDI</span>
                                                <span class="widget-stats-amount"><?= $jdudi; ?> </span>
                                               
                                            </div>
                                          <i class="material-icons-outlined" style="color:gold">star</i>
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
                                                <span class="widget-stats-title">SISWA PRAKERIN</span>
                                                <span class="widget-stats-amount"><?= $jprak; ?></span>
                                               
                                            </div>
                                             <i class="material-icons-outlined" style="color:gold">star</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            
											<div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PEMBIMBING</span>
                                                <span class="widget-stats-amount"><?= $jpem ?> </span>
                                              
                                            </div>
                                            <i class="material-icons-outlined" style="color:gold">star</i>
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
                                                <span class="widget-stats-title">KOMPETENSI</span>
                                                <span class="widget-stats-amount"><?= $jkom ?></span>
                                            </div>
                                             <i class="material-icons-outlined" style="color:gold">star</i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
						 <div class="col-xl-6">
                      <div class="card widget widget-payment-request">
					    <div class="card-body">
					 <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                     <div class="avatar m-r-sm">
                         <img src="../images/guru.png" alt="">
                       </div>
                    <div class="widget-payment-request-author-info">
                  <span class="widget-payment-request-author-name"><?= $panitia['ketua'] ?></span>
                  <span class="widget-payment-request-author-about">KETUA PANITIA</span>
					<p style="color:blue;">PRAKERIN</p>
                   </div>
                 </div>
               </div>
			</div>
		 </div>
      </div>  
	  <div class="col-xl-6">
                      <div class="card widget widget-payment-request">
					    <div class="card-body">
					 <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                     <div class="avatar m-r-sm">
                         <img src="../images/guru.png" alt="">
                       </div>
                    <div class="widget-payment-request-author-info">
                 <span class="widget-payment-request-author-name"><?= $panitia['sekretaris'] ?></span>
                  <span class="widget-payment-request-author-about">SEKRETARIS</span>
					<p style="color:blue;">PRAKERIN</p>
                   </div>
                 </div>
               </div>
			</div>
		 </div>
      </div>  
   </div>
 </div>  
 </div>   
	<?php endif; ?>
	
