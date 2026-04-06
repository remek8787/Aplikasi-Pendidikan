<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
						  <div class="row">
                            <?php									
							$query = mysqli_query($koneksi, "SELECT level,kuri FROM kelas group by level");
							while ($data = mysqli_fetch_array($query)) :
							$kuri = fetch($koneksi,'m_kurikulum',['idk'=>$data['kuri']]);
							?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/buku.png" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0">TINGKAT <?= $data['level'] ?></div>
										  <div class="text-muted"><?= $kuri['nama_kurikulum'] ?></div>
										</div>
									  </div>    
								</div>
								</div>
								</div>
							<?php endwhile; ?>
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
									 <div class="col-md-12 mb-1">
									  <label class="bold">Tingkat</label>
                                        <select name='level' id="level" class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Tingkat</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT level FROM kelas GROUP BY level"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['level'] ?>"><?= $kls['level'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
										
										<div class="col-md-12 mb-1">
									  <label class="bold">KURIKULUM</label>
                                        <select name='kuri' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Kurikulum</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM m_kurikulum"); ?>
                                                <?php while ($k = mysqli_fetch_array($que)) : ?>
                                                    <option value="<?= $k['idk'] ?>"><?= $k['nama_kurikulum'] ?></option>
                                                <?php endwhile ?>
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
				</div>
				 <?php endif ?>
					 						 
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'kurikulum/tkuri.php',
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
											   url: 'jadwal/tjadwal.php?pg=hapus',
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