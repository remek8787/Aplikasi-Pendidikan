<?php
defined('APK') or exit('No Access');
if($setting['jam']=='1'){$kodexx='Jam Mati';}
if($setting['jam']=='2'){$kodexx='Jam Hidup';}
?>  
								<?php 
								   if (empty($_GET['model'])) {
										$model = "";
								   }else{
									   $model = $_GET['model'];
								   }
								  if (empty($_GET['jjm'])) {
										$jjm = "";
								   }else{
									   $jjm = $_GET['jjm'];
								   }
								   if($model=='1'){$kode='Jam Mati';}
								   if($model=='2'){$kode='Jam Hidup';}
								   ?>	 
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">JJM DAN HONOR</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                <th width="10%">NO</th>                                               
                                                <th>JJM</th>
												<th>HONOR</th>
												<th>MODEL</th>	
                                                </tr>
                                            </thead>
                                            <tbody>											
                                                <tr>
                                                <td>1</td>
                                                <td><?= $setting['jjm'] ?> menit</td>
												<td>
												<?php if($setting['jam']=='2'){ ?>
												<?= number_format($setting['honor']) ?>
												<?php }else{ ?>
												Setting di menu Payment
												<?php } ?>
												</td>
												 <td><?= $kodexx; ?></td>
                                                </tr>												
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
									<form id='formguru'  >	
									
										<div class="col-md-12 mb-1">
									   <label class="bold">Durasi Waktu per 1 Jam Pelajaran</label>
                                       <input type='number' name='jjm' class='form-control jjm' value="<?= $setting['jjm'] ?>" required='true' autocomplete="off" required="true" />
                                        </div>
										<label class="bold">Model Jam Pembayaran</label>
									  <div class="input-group mb-1">
                                       <select name="model" id="model" class="form-select model" style="width:100%" required>
									 <option value="<?= $model ?>"><?= $kode ?></option>
									 <option value="">Pilih Model</option>
									   <option value="1">Jam Mati</option>
									   <option value="2">Jam Hidup</option>
									  </select>
                                        </div>
										<?php if($model=='2'): ?>
										<div class="col-md-12 mb-1">
									   <label class="bold">Honor Per 1 JJM Khusus Honorer</label>
									   <p> Jika menggunakan Jam Hidup</p>
                                       <input type='number' name='honor' class='form-control' value='0' required='true' autocomplete="off" required="true" />
                                        </div>
                                     <?php endif; ?>
										<div class="widget-payment-request-actions m-t-lg d-flex">
										<?php if($model<>''): ?>
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                             <?php endif; ?>
											</div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
                 $('.model').change(function() {
				var model = $('.model').val();
				var jjm = $('.jjm').val();
                location.replace("?pg=<?= enkripsi('jjm') ?>&model=" + model + "&jjm=" + jjm);
                  }); 
               </script>
				 <?php endif ?>
					 
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'jjm/tjjm.php',
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
										window.location.replace("?pg=<?= enkripsi('jjm') ?>");
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
                        
             
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
											   url: 'jadwal/tjadwal.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
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