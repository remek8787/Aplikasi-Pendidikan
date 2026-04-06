<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">JENIS PEMBAYARAN</h5>
										<div class="pull-right">
										<a href="cetak/cetakjenis.php" target="_blank" class="btn btn-sm btn-primary kanan"><i class="material-icons">print</i> Master</a>
										</div>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  												
                                                    <th>KODE</th>
													<th>TOTAL RP</th>
                                                    <th>MODEL</th>													 
													 <th>JML X</th>
													 <th>JML BAYAR RP</th>
													 <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM m_bayar"); 
											  while ($data = mysqli_fetch_array($query)) :
											  if($data['model']=='1'){
												  $model='Sekali Bayar';
											  }else{
												  $model = 'Bulanan';
											  }
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['kode'] ?></td>
													<td><?= number_format($data['total']) ?></td>
                                                     <td><?= $model ?></td>
													<td><h5><span class="badge badge-primary"><?= $data['jumlah'] ?> X</span></h5></td>
													<td><h5><span class="badge badge-dark"><?= number_format($data['angsuran']) ?></span></h5></td>
													  <td>
											
											  <a href="?pg=<?= enkripsi('jenis') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
											
											</td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
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
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formkate' >	
									 <label class="bold">Kode</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kode' class='form-control' required='true' />
									   
                                        </div>	
										 <label class="bold">Nama Pembayaran</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' required='true' />
                                        </div>
										<label class="bold">Total Pembayaran Rp</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='total' id="duit" class='form-control' required='true' />
                                        </div>
										<label class="bold">Model Pembayaran</label>
									  <div class="input-group mb-1">
                                       <select name="model" id="model" class="form-select" style="width:100%" required>
									  <option value="">Pilih Model</option>
									   <option value="1">Sekali Bayar</option>
									   <option value="2">Bulanan</option>
									  </select>
                                        </div>
										<div class='col-md-12 mb-1'>
											<label class="bold">JUMLAH ANGSURAN</label>
												<select class="form-select" name="jumlah" id="jumlah" required style="width: 100%">											 
											  
											</select>
											</div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
						<script>
    $('#formkate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tjenis.php?pg=tambah',
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
					
					 <?php elseif($ac == enkripsi('edit')): ?>	
						 <?php
						 $id = $_GET['id'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$id'"));						
                           if($data['model']=='1'){$model ='Sekali Bayar';}
							if($data['model']=='2'){$model ='Bulanan';}
						   ?>
					 <div class="col-md-4">
                      
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">EDIT JENIS PEMBAYARAN</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
												
                                                    <img src="../images/user.png" alt="">
                                               
											   </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">E-PEMBAYARAN</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formedit' >	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label class="bold">Kode</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kode' value="<?= $data['kode'] ?>" class='form-control' required='true' />
									   
                                        </div>	
										 <label class="bold">Nama Pembayaran</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $data['nama'] ?>" class='form-control' required='true' />
                                        </div>
										<label class="bold">Total Pembayaran Rp</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='total' id="duit" value="<?= number_format($data['total'],0,",",".") ?>" class='form-control' required='true' />
                                        </div>
										<label class="bold">Model Pembayaran</label>
									  <div class="input-group mb-1">
                                       <select name="model" id="model" class="form-select" style="width:100%" required>
									 <option value="<?= $kode['model'] ?>"><?= $model ?></option>
									 <option value="">Pilih Model</option>
									   <option value="1">Sekali Bayar</option>
									   <option value="2">Bulanan</option>
									  </select>
                                        </div>
										<div class='col-md-12 mb-1'>
											<label class="bold">JUMLAH ANGSURAN</label>
												<select class="form-select" name="jumlah" id="jumlah" required style="width: 100%">											 
											   <option value="<?= $data['jumlah'] ?>"><?= $data['jumlah'] ?>X</option>
											</select>
											</div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>				
					</div>
				
					
<?php endif ?>
					
                        
            <script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tjenis.php?pg=edit',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace('?pg=<?= enkripsi(jenis) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
                                 <script>	
									$("#model").change(function() {
									var model = $(this).val();
									console.log(model);
									$.ajax({
									type: "POST",
									url: "master/ambildata.php?pg=jumlah", 
									data: "model=" + model, 
									success: function(response) { 
									$("#jumlah").html(response);
											}
										});
									});
									
									</script>