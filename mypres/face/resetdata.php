<?php 
defined('APK') or exit('No Access');
$jjawab = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM datareg WHERE level='siswa' and folder<>''"));
$jnilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM datareg WHERE level='pegawai' and folder<>''"));
?>


                      <div class="row">
                            <div class="col-xl-8">
							<div class="row">
							<div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">menu</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">REGISTRASI SISWA</span>
                                                <span class="widget-stats-amount"><?= $jjawab; ?> <small>Data</small></span>
                                              
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
                                                <i class="material-icons-outlined">apps</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">REGISTRASI PEGAWAI</span>
                                                <span class="widget-stats-amount"><?= $jnilai; ?> <small>Data</small></span>
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                          </div>
						</div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									  <h5 class="card-title text-center">RESET REGISTRASI</h5>
                                        <div class="d-grid gap-2">
										<button class="btn btn-primary" type="button" id="optimal">RESET</button>
									</div>
									<p></p>
                                    <div class="mb-4">
								<p class="text-small text-muted mb-2">ALAMAT</p>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									  <i class="material-icons text-info" style="font-size:18px">home</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['alamat'] ?></div>
								</div>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
										<i class="material-icons text-info" style="font-size:18px">star</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['desa'] ?></div>
								</div>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									   <i class="material-icons text-info" style="font-size:18px">sync</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
								</div>
							  </div>
							  <div class="mb-4">
								<p class="text-small text-muted mb-2">CONTACT</p>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
										<i class="material-icons text-info" style="font-size:18px">phone</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['nowa'] ?></div>
								</div>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									   <i class="material-icons text-info" style="font-size:18px">inbox</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['email'] ?></div>
								</div>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									  <i class="material-icons text-info" style="font-size:18px">language</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['server'] ?></div>
								</div>
							  </div>
							  <div class="mb-4">
								<p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									 <i class="material-icons text-info" style="font-size:18px">person</i>
									</div>
								  </div>
								  <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
								</div>
								<div class="row g-0 mb-2">
								  <div class="col-auto">
									<div class="sw-3 me-1">
									  <i class="material-icons text-info" style="font-size:18px">payment</i>
									</div>
								  </div>
								  <div class="col text-alternate"><?= $setting['nip'] ?></div>
								</div>
							  </div>
							</div>
						  </div>             
						</div>					
						</div>
										 
									 
						
							  
				<script>
				$("#optimal").click(function(){
		    	Swal.fire({
				  title: 'Reset Registrasi',
				  text: "Informasi : Reset Registrasi",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, Reset'
				}).then((result) => {
				  if (result.value) {
					$.ajax({
					url: 'face/treset.php',
					success: function(data) {
						 Swal.fire(
				      'Success!',
				      'Your file has been Reset.',
				      'success'
				    )
				   setTimeout(function() {
					window.location.reload();
					}, 1000);
						}
					});
					}
					return false;
						})

						});
					</script>	
	