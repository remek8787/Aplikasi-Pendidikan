<?php
defined('APK') or exit('No accsess');
?>  
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card widget widget-list">
                                    <div class="card card-header">
									<h5 class="card-title">LENGKAPI DATA SEKOLAH</h5>
									</div>
                                    <div class="card-body">                                 
                                        <ul class="widget-list-content list-unstyled">									
                                            <li class="widget-list-item widget-list-item-green">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">school</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                      <?= $setting['sekolah'] ?>
                                                    </a>
                                                    <span class="widget-list-item-description-subtitle">
                                                    NPSN  <?= $setting['npsn'] ?>
                                                    </span>
                                                </span>
                                            </li>
											
                                          <li class="widget-list-item widget-list-item-blue">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">select_all</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                      Nomor Statistik Sekolah (NSS)
                                                    </a>
                                                    <span class="widget-list-item-description-subtitle">
                                                    <?= $setting['nss'] ?>
                                                    </span>
                                                </span>
                                            </li>
											 <li class="widget-list-item widget-list-item-grey">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">star</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                      Tahun Berdiri
                                                    </a>
                                                    <span class="widget-list-item-description-subtitle">
                                                    <?= $setting['tahun_berdiri'] ?>
                                                    </span>
                                                </span>
                                            </li>
                                        </ul>
										
                                    </div>
                                </div>
                            </div>
                             
    <div class="col-xl-4 mb-4">
        <div class="card">
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
				  <form id='formguru' class="row g-1">
					<div class="col-md-12 mb-1">
					<label class="bold">N P S N</label>
					 <input type='text' name='npsn' value="<?= $setting['npsn'] ?>" class='form-control'  readonly="true" />
					</div>
					<div class="col-md-12 mb-1">
					<label class="bold">N S S</label>
					 <input type='text' name='nss' value="<?= $setting['nss'] ?>" class='form-control'  required="true" />
					</div>
					<div class="col-md-12 mb-1">
					<label class="bold">AKREDITASI</label>
					 <input type='text' name='akreditasi' value="<?= $setting['akreditasi'] ?>" class='form-control'  required="true" />
					</div>
					<div class="col-md-12 mb-1">
					<label class="bold">TAHUN BERDIRI</label>
					 <input type='number' name='berdiri' value="<?= $setting['tahun_berdiri'] ?>" class='form-control'  required="true" />
					</div>
					<div class="col-md-8 mb-1">
					<label class="bold">LOGO PEMDA</label>
					 <input type='file' name='file'  class='form-control'  >
					</div>
					<div class="col-md-4 mb-1">
					<?php if($setting['pemda']<>''): ?>
					<br>
					<img src="../images/<?= $setting['pemda'] ?>" width="70px">
					<?php endif; ?>
					</div>
					<div class="widget-payment-request-actions m-t-lg d-flex">
                        <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                      </div>
					</form>
					<p></p>
                <div class="d-flex justify-content-between mb-2">
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">NPSN</p>
                      <p><?= $setting['npsn'] ?></p>
                    </div>
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">SMT</p>
                      <p><?= $setting['semester'] ?></p>
                    </div>
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">TP</p>
                      <p><?= $setting['tp'] ?></p>
                    </div>                    
                  </div>
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
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'pengaturan/tprofil.php',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								
									},
									success: function(data){   		
									setTimeout(function()
										{
										window.location.reload();
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>
					