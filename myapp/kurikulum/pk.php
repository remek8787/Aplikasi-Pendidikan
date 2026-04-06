<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
						   <div class="card">
						  <div class="card-body">
                           <div class="card-box table-responsive">
                               <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                           <thead>
                                               <tr style="vertical-align:middle">
                                                   <th>NO</th>
                                                    <th>JURUSAN</th>
                                                    <th>PROGRAM KEAHLIAN</th>
                                                    <th>BIDANG KEAHLIAN</th>
                                                     <th>KOMPETENSI KEAAHLIAN</th>
												
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT jurusan,bk,pk,kk FROM kelas GROUP BY jurusan"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr style="vertical-align:middle">
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['jurusan'] ?></td>
                                                  <td><?= $data['pk'] ?></td>
                                                  <td><?= $data['bk'] ?></td>
												  <td><?= $data['kk'] ?></td>
												 
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
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formguru' >	
									 <div class="col-md-12 mb-1">
									  <label class="bold">JURUSAN</label>
                                        <select name='jurusan' id="jurusan" class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Jurusan</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT jurusan FROM kelas GROUP BY jurusan"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['jurusan'] ?>"><?= $kls['jurusan'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
										
										<div class="col-md-12 mb-1">
									  <label class="bold">BIDANG KEAHLIAN</label>
                                        <input type="text" name="bk" class="form-control" required="true">
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">PROGRAM KEAHLIAN</label>
                                        <input type="text" name="pk" class="form-control" required="true">
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">KOMPETENSI KEAHLIAN</label>
                                        <input type="text" name="kk" class="form-control" required="true">
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
									 url: 'kurikulum/tpk.php',
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