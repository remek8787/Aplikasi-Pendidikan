<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jpes = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa"));
$jmap = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM mapel"));
$jbank = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_bank FROM banksoal"));
$jsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_soal FROM soal"));
$jnilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_nilai FROM nilai"));
$jblok = mysqli_num_rows(mysqli_query($koneksi, "SELECT blok FROM siswa where blok='1'"));
?>


                      <div class="row">
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">school</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PESERTA ASESMEN</span>
                                                <span class="widget-stats-amount"><?= $jpes; ?> </span>
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">dataset</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">MATA PELAJARAN</span>
                                                <span class="widget-stats-amount"><?= $jmap; ?></span>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">apps</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">BANK SOAL</span>
                                                <span class="widget-stats-amount"><?= $jbank ?> </span>
                                              
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DATA SOAL</span>
                                                <span class="widget-stats-amount"><?= $jsoal; ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
									
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-purple">
                                                <i class="material-icons-outlined">support</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DATA NILAI</span>
                                                <span class="widget-stats-amount"><?= $jnilai; ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
									
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-danger">
                                                <i class="material-icons-outlined">close</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">BLOKIR PESERTA</span>
                                                <span class="widget-stats-amount"><?= $jblok; ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                         </div>
						 
						<div class="row">
						<div class="col-xl-4">
                                 <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">AKTIFITAS PESERTA</h5>
                                    </div>
                                    <div class="card-body" style="height:410px;">
									<?php
									$tgl= date('Y-m-d');
									$query = mysqli_query($koneksi, "SELECT * FROM log WHERE level='siswa' ORDER BY id_log DESC LIMIT 4"); 			
									while ($data = mysqli_fetch_array($query)) :
									$pusat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$data[id_siswa]'"));	
									$tgllog = date('Y-m-d',strtotime($data['date']));
									?>
									<?php if($tgl<>$tgllog):?>
									 <?php $exec = mysqli_query($koneksi, "truncate log"); ?>
									  <?php endif; ?>	
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/siswa.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <small><?= $pusat['nama'] ?></small>
													 <span class="widget-payment-request-author-about"><?= $data['text']; ?></span>
													<p style="color:blue;"><?= timeAgo($data['date']) ?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
										<?php endwhile; ?>
                                    </div>
                                </div>
							</div>
                           
							<div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">										
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" >
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">WA GETEWAY</div>
										</div>
                               	    <form id="formmasis" class="row g-1">
                                <div class="col-md-12">
									<label class="bold"> Kepada Siswa Kelas</label>
										<select name='kelas' class='form-select' style='width:100%' required="true" >
										<option value=''>Pilih Kelas</option>
										<?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
										</select>
									</div>
                                
								<div class="col-md-12">
							 <label class="bold"> Isi Pesan</label>
							 <textarea name='pesan' class='form-control'  rows="7" required="true" ></textarea>
							 </div>
							
							 <div class="col-md-12">
								<button type="submit" class="btn btn-primary kanan">KIRIM</button>
								</div>
							</form>
                           </div>
                        </div>
                   </div>
								  <div class="col-xl-4">
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">LOG AKTIFITAS</h5>
                                    </div>
                                    <div class="card-body" style="height:410px;">
									<?php
									$tgl= date('Y-m-d');
									$query = mysqli_query($koneksi, "SELECT * FROM log WHERE level<>'siswa' ORDER BY id_log DESC LIMIT 4"); 			
									while ($data = mysqli_fetch_array($query)) :
									$pusat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[id_user]'"));	
									$tgllog = date('Y-m-d',strtotime($data['date']));
									?>
									<?php if($tgl<>$tgllog):?>
									 <?php $exec = mysqli_query($koneksi, "truncate log"); ?>
									  <?php endif; ?>	
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $pusat['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $data['date']; ?></span>
													<p style="color:blue;"><?= timeAgo($data['date']) ?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
										<?php endwhile; ?>
                                    </div>
                                </div>
							</div>
								  
                               </div>	
                            
							</div>
                       
					  
							<script>
							   $('#formmasis').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/masalsis.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
										 $('.progress-bar').animate({
												
												}, 500);
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 2000);

										}
									});
									return false;
								});
							   
							</script>	
							  
				