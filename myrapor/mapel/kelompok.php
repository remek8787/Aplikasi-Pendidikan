<?php
defined('APK') or exit('No Access');
$kelompok = fetch($koneksi,'kode',['id'=>$_GET['id']]); 
?>     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">KELOMPOK MAPEL</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                <th>#</th>
												<th>KODE</th>
												<th>KETERANGAN</th>
                                                
												<th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;										
											$query = mysqli_query($koneksi, "SELECT * FROM kode where jenis='$setting[jenis]' and jenjang='$setting[jenjang]'");
											while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no ?></td>
                                               <td><?= $data['kd'] ?></td>
												<td><?= $data['ket'] ?></td>
												<td>						
												<a href="?pg=<?= enkripsi('kelompok') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary"><i class="material-icons">edit</i></a>
													
												</td>
                                                </tr>
												<?php endwhile; ?>
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
									<form id='formguru' >
										<input type="hidden" name="id" value="<?= $_GET['id'] ?>" >
									 <div class="col-md-12 mb-1">
									  <label class="bold">KODE</label>
                                         <input type="text" name='kd' id="kd" value="<?= $kelompok['kd'] ?>" class='form-control'  required>  
                                        </div>
										
										<div class="col-md-12 mb-1">
									  <label class="bold">No Urut Mapel</label>
                                        <input type="text" name='ket' id="ket" value="<?= $kelompok['ket'] ?>" class='form-control'  required>                                               			
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
				</div>
				 <?php endif ?>
												 
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'mapel/tmapel.php?pg=kelompok',
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
											   url: 'mapel/tmapel.php?pg=hapus',
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