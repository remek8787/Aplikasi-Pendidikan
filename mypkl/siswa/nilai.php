					<?php
					defined('APK') or exit('No accsess');
					?> 		
					 
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">MASTER PENILAIAN SIKAP</h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>#</th> 
										   <th>KODE</th>
										  <th>ASPEK</th>
                                          <th>PENILAIAN</th>
										  <th></th>										 										 
                                          </tr>
                                          </thead>										
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_mnilai");
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                              <td><?= $no; ?></td> 
											 <td><?= $data['kode'] ?></td>
											  <td>
											  <?php if($data['kode']=='A'){ ?> SIKAP<?php } ?>
											  <?php if($data['kode']=='B'){ ?> PENGETAHUAN<?php } ?>
											  <?php if($data['kode']=='C'){ ?> KETERAMPILAN<?php } ?>
											  </td>
                                             <td><?= $data['aspek'] ?></td>
											 <td>											
											<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
											</td>
											 
                                            </tr>
										<?php endwhile; ?>
										</tbody>
										
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
											   url: 'siswa/tnilai.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
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
									<form id="formsiswa" class="row g-1">
									 <label class="bold">PENILAIAN</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kode" id="kode" required style="width: 100%">						
									 <option value="">PILIH ASPEK</option>
									<option value="A">ASPEK SIKAP</option>
										<option value="B">ASPEK PENGETAHUAN</option>
										<option value="C">ASPEK KETERAMPILAN</option>
									</select>
									 </div>
									
									 <label class="bold">ASPEK PENILAIAN</label>
									 <div class="input-group mb-1">
									 <input type="text" name="aspek" class="form-control" required="true">
                                    </div>	
																			
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button  type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                       </div>										
										
										</form>
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
							 url: 'siswa/tnilai.php?pg=tambah',
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
	
<?php endif ?>
	
								