<?php
defined('APK') or exit('No accsess');
?>       
	
		<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$psb = fetch($koneksi,'pdb');
$jum = $psb['jumlah'];

?>
<style>

.circular-progress {
  --size: 250px;
  --half-size: calc(var(--size) / 2);
  --stroke-width: 20px;
  --radius: calc((var(--size) - var(--stroke-width)) / 2);
  --circumference: calc(var(--radius) * pi * 2);
  --dash: calc((var(--progress) * var(--circumference)) / 100);
  animation: progress-animation 5s linear 0s 1 forwards;
}

.circular-progress circle {
  cx: var(--half-size);
  cy: var(--half-size);
  r: var(--radius);
  stroke-width: var(--stroke-width);
  fill: none;
  stroke-linecap: round;
}

.circular-progress circle.bg {
  stroke: #ddd;
}

.circular-progress circle.fg {
  transform: rotate(-90deg);
  transform-origin: var(--half-size) var(--half-size);
  stroke-dasharray: var(--dash) calc(var(--circumference) - var(--dash));
  transition: stroke-dasharray 0.3s linear 0s;
  <?php if($jum<50): ?>
   stroke:#DC143C;
  <?php endif; ?>
  <?php if($jum>50 and $jum < 75): ?>
  stroke:#FFD700;
  <?php endif; ?>
  <?php if($jum>75): ?>
   stroke:#32CD32;
	 <?php endif; ?>
}

@property --progress {
  syntax: "<number>";
  inherits: false;
  initial-value: 0;
}

@keyframes progress-animation {
  from {
    --progress: 0;
  }
  to {
    --progress: <?= $jum ?>;
  }
}
</style>

                      <div class="row">
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
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">school</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DATA MASUK SISWA BARU</span>
                                                <span class="widget-stats-amount"><?= $psb['jumlah']; ?> </span>
                                               
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body text-center">
                                      <svg width="215" height="215" viewBox="0 0 250 250" class="circular-progress" >
									  <circle class="bg"></circle>
									  <circle class="fg"></circle>
									 </svg>
                                    </div>
                                </div>
                            </div>
                            
		<div class="col-xl-4">
				<div class="card widget widget-payment-request">
					<div class="card-header">
						
						</div>
					<div class="card-body">
			<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                    </div>
                <div class="h5 mb-0">IMPOR SISWA BARU</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
					<div class="widget-payment-request-info m-t-md"> 						      
					<form id='formsiswa'>	
						<label class="bold">Pilih File</label>
						<a href="mutasi/M_SISWA_BARU.xlsx" class="btn btn-link kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Format"> <i class="material-icons">download</i> Format</a>	   				            
						<div class="input-group mb-2">
					   <input type='file' name='file' class='form-control' required='true' />
							<span class="input-group-text">
								<button type="submit" class="btn btn-sm btn-primary"><i class="material-icons">upload</i></button>
							</span>
						</div>	
					</form>
					</div>                  
			
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
                </div>
              </div>             
            </div>					
		 </div>
		
							  
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'mutasi/import_siswa.php',
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
          