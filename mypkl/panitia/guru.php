					<?php
					defined('APK') or exit('No accsess');
					$panitia = fetch($koneksi,'pkl_panitia',['id'=>1]);
					?> 		
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">PANITIA PRAKERIN</h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>#</th>                                               
										  <th>KETUA</th>
                                          <th>SEKRETARIS</th>
										  <th>TGL PELAKSANAAN</th>										 
										  
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_panitia");
											while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;"> 
											 <td><?= $no; ?></td>
											  <td><?= $data['ketua'] ?></td>
                                             <td><?= $data['sekretaris'] ?></td>
											 <td><?= $data['dari'] ?> s/d <?= $data['sampai'] ?></td>
											
                                            </tr>
										<?php endwhile; ?>
										</tbody>
                                            </table>
										  </div>
										
										 </div>
										</div>
									</div>
								  	
						<?php if ($ac == '') : ?>
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
										</div>
										<div class="h5 mb-0">PRAKERIN</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id="formguru" class="row g-1">
									 <label class="bold">KETUA PANITIA</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="ketua" value="<?= $panitia['ketua'] ?>" class="form-control" required="true" >
									 </div>	
									 <label class="bold">NIP/NUPTK/NIK KETUA</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="nipk" value="<?= $panitia['nipk'] ?>" class="form-control" required="true" >
									 </div>	
										 <label class="bold">SEKRETARIS</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="sekretaris" value="<?= $panitia['sekretaris'] ?>" class="form-control" required="true" >
									 </div>	
									 <label class="bold">NIP/NUPTK/NIK SEKRETARIS</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="nips" value="<?= $panitia['nips'] ?>" class="form-control" required="true" >
									 </div>	
									  <label class="bold">DARI TANGGAL</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="dari" value="<?= $panitia['dari'] ?>" class="form-control" required="true" >
									 </div>	
									 <label class="bold">SAMPAI TANGGAL</label>
									 <div class="input-group mb-1">
                                       <input type="text" name="sampai" value="<?= $panitia['sampai'] ?>" class="form-control" required="true" >
									 </div>	
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                       </div>
										</form>
					               </div>
								</div>
							</div>
						</div>
				
<?php endif ?>
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'panitia/tguru.php?pg=tambah',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			
			}, 500);
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
		