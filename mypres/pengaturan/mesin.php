<?php
defined('APK') or exit('No Access');
$mesin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mesin_absen  WHERE id='$setting[mesin]'"));
?>
						<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">MESIN PRESENSI</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px;">
                                            <thead>
                                                <tr>                                                
                                                    <th>NAMA MESIN</th>
                                                    <th>API WA</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$query = mysqli_query($koneksi, "SELECT mesin,url_api FROM pengaturan"); 
											while ($data = mysqli_fetch_array($query)) :											
											   ?>
                                                <tr>
                                                   
                                                    <td><?= $mesin['mesin'] ?></td>
                                                    <td><?= $data['url_api'] ?></td>
													
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                            </table>
												
										</div>
									</div>
								</div>
							</div>
						
                     <div class="col-xl-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0">MESIN PRESENSI</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formmesin' class="row g-2">									
									  <div class="col-md-12 mb-1">
									   <label class="bold">Mesin Presensi</label>
                                        <select class="form-select" name="mesin" required style="width: 100%">
										 <option value="<?= $setting['mesin'] ?>" ><?= $mesin['mesin'] ?></option>
										  <option value='' >-- Pilih Mesin --</option>
										  <?php
											$lev = mysqli_query($koneksi, "SELECT * FROM mesin_absen");
											while ($msn = mysqli_fetch_array($lev)) {
											echo "<option value='$msn[id]'>$msn[mesin]</option>";
											} ?>
										</select>
                                        </div>	
										 
									  <div class="col-md-12 mb-1">
									   <label class="bold">URL API WA</label>
                                        <input type="text" name="api" value="<?= $setting['url_api'] ?>" class="form-control" >
                                        </div>	
										<div class="col-md-12 mb-2">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs kanan">Simpan</button>
                                            </div>
										</form>
									
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
    $('#formmesin').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'pengaturan/tmesin.php',
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
				