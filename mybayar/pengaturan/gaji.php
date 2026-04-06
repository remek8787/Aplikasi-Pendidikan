<?php
defined('APK') or exit('NO ACCESS');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PENERIMA PEMBAYARAN</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th>NO</th>  	
												  <th>NAMA PENERIMA</th>
                                                   <th>JENIS PEMBAYARAN</th>
												   <th>JUMLAH RP</th>  
													<th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM gaji"); 
											  while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user' => $data['idpeg']]);
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $peg['nama'] ?></td>
													<td><?= $data['tugas'] ?></td>
                                                    <td><?= number_format($data['besar']) ?></td>
													<td>
													<a href="?pg=<?= enkripsi('gaji') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
													</td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											  url: 'pengaturan/thonor.php?pg=hapusgaji',
												method: "POST",
												data: 'id=' + id,
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
												},
												success: function(data) {
													 
													setTimeout(function() {
														window.location.reload();
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script> 	
									
						<?php if ($ac == '') : ?>
						<?php 
								   if (empty($_GET['j'])) {
										$jenis = "";
								   }else{
									   $jenis = $_GET['j'];
								   }
								  if (empty($_GET['g'])) {
										$guru = "";
								   }else{
									   $guru = $_GET['g'];
								   }
								$peg = fetch($koneksi,'users',['id_user' => $guru]);
								$jns = fetch($koneksi,'kode_jenis',['kd' => $jenis]);
								$jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT guru,sum(jjm) as jml FROM jadwal_mengajar  WHERE guru='$guru'"));
								  $total = $jumlah['jml'] * $setting['honor'];
								  ?>	 
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
									<label class="bold">Nama Penerima</label>
									  <div class="input-group mb-1">
                                      <select name="guru" id="guru" class='form-select guru' style='width:100%' required="true" >                                         
												<option value="<?= $guru; ?>"><?= $peg['nama'] ?></option>  
											<option value="">Pilih Pegawai</option>  
											<?php 							
											$sql=mysqli_query($koneksi,"SELECT * FROM users WHERE level<>'admin'");
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										
										<label class="bold">Jenis Pembayaran</label>
									  <div class="input-group mb-1">
                                      <select name="jenis" id="jenis" class='form-select jenis' style='width:100%' required="true" >                                         
											<option value="<?= $jenis; ?>"><?= $jns['nama'] ?></option>  
											<option value="">Pilih Jenis</option>  
											<?php									
											$sql=mysqli_query($koneksi,"SELECT * FROM kode_jenis");											
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<option value="<?= $data['kd'] ?>"><?= $data['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
											  </div>
										
										<?php if($guru<>''): ?>  
										
										 <label class="bold">
										 <?php if($jenis=='1' OR $jenis=='2' OR $jenis=='3' OR $jenis=='4'){ ?>
										 Nama Tugas
										
										 <?php }else{ ?>
										 Nama Tugas Lainnya<?php } ?>
										 </label>
									  <div class="input-group mb-1">
									  <?php if($jenis=='1' OR $jenis=='2' OR $jenis=='3' OR $jenis=='4'){ ?>
                                       <input type='text' name='nama' class='form-control' value="<?= $jns['nama'] ?>" autocomplete="off" readonly='true' />
                                        <?php }else{ ?>
										  <input type='text' name='nama' class='form-control' autocomplete="off" required='true' />
										<?php } ?>
										</div>
									
										<label class="bold">
										<?php if($setting['jam']=='1'){ ?>  
										Pembayaran per Bulan Rp
										<?php }elseif($setting['jam']=='2'){ ?>
										<?php if($jenis=='1' OR $jenis=='2'){ ?>
										Honor Per Jam
										<?php }elseif($jenis=='3'){ ?>
										Honor Per Malam
										<?php }elseif($jenis=='4'){ ?>
										Honor Per Pertemuan
										<?php }elseif($jenis=='5'){ ?>
										Honor Per Bulan
											<?php } ?>
										<?php } ?>
										</label>
									  <div class="input-group mb-1">
									  <?php if($setting['jam']=='1'){ ?>
                                       									  
                                       <input type='number' name='besar' class='form-control' required='true' />
                                        <?php }else{ ?>
										 <?php if($jenis=='1'){ ?>
										<input type='text' name='besar' value="<?= $setting['honor'] ?>" class='form-control' readonly='true' />
										 <?php }else if($jenis=='2'){ ?>
										<input type='text' name='besar'  class='form-control' required='true' />
										<p>Sudah ada di jadwal Tu, Namun harus tetap diisi dan disimpan
										<?php }else{ ?>
										 <input type='number' name='besar' class='form-control' required='true' />
										<?php } ?>
										<?php } ?>
										</div>	 
                                      									
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
											<?php endif; ?>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
				<script type="text/javascript">
                 $('.jenis').change(function() {
				var j = $('.jenis').val();
				var g = $('.guru').val();
                location.replace("?pg=<?= enkripsi('gaji') ?>&j=" + j + "&g=" + g);
                  }); 
               </script>
						
						
						<script>
					$('#formkate').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'pengaturan/thonor.php?pg=gaji',
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
						 $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE id='$id'"));						
                         $peg = fetch($koneksi,'users',['id_user' => $data['idpeg']]);
						
							?>
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
									<form id='formedit' >
									 <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									
									  <label class="bold">Nama Penerima</label>
									  <div class="input-group mb-1">
                                      <select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $data['idpeg'] ?>"><?= $peg['nama'] ?></option>  
											<option value="">Pilih Pegawai</option>  
											<?php 							
											$sql=mysqli_query($koneksi,"SELECT * FROM users WHERE level<>'admin'");
											while ($dataq=mysqli_fetch_array($sql)) { ?>	
											<option value="<?= $dataq['id_user'] ?>"><?= $dataq['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<label class="bold">Jenis Pembayaran</label>
									  <div class="input-group mb-1">
                                      <select name="jenis" id="jenis" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $data['tugas'] ?>"><?= $data['tugas'] ?></option>  
											                                           
											 </select>
                                        </div>			
										<label class="bold">Jumlah Rp</label>
									  <div class="input-group mb-1">
									   <?php if($setting['jam']=='1'){ ?>
										 <input type='number' name='besar' value="<?= $data['besar'] ?>" class='form-control' required='true' />
									   <?php }else{ ?>
									   <?php if($data['kode']=='1'){ ?>
									   <input type='number' name='besar' value="<?= $data['besar'] ?>" class='form-control' readonly='true' />
										 <?php }else{ ?>
										 <input type='number' name='besar' value="<?= $data['besar'] ?>" class='form-control' required='true' />
										<?php } ?>	
										<?php } ?>	
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
             url: 'pengaturan/thonor.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi(gaji) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
                              