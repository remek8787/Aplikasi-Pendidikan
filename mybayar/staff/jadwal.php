<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">JADWAL PIKET MALAM</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>HARI</th>
													<th>NAMA STAFF</th>
                                                   <th>JJK</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_tu");											
											  while ($data = mysqli_fetch_array($query)) :
											  $harix = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);											
											  $guru = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);											
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $harix['hari'] ?></td>
                                                <td><?= $guru['nama'] ?></td>
												<td><?= $data['jjk'] ?></td>
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
									  <label class="bold">HARI</label>
                                        <select name='hari' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Hari</option>
                                                <?php $hr = mysqli_query($koneksi, "SELECT * FROM m_hari"); ?>
                                                <?php while ($hari = mysqli_fetch_array($hr)) : ?>
                                                    <option value="<?= $hari['inggris'] ?>"><?= $hari['hari'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
										<div class="col-md-12 mb-1">
									 
										 <label class="bold">NAMA STAFF</label>
									  <div class="col-md-12 mb-1">
                                        <select name='guru' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Staff</option>
                                                <?php 
												
												$usr = mysqli_query($koneksi, "SELECT * FROM users where level='staff'"); 
	
												?>
                                                <?php while ($guru = mysqli_fetch_array($usr)) : ?>
                                                    <option value="<?= $guru['id_user'] ?>"><?= $guru['nama'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
										 <div class="col-md-12 mb-1">
										  <label class="bold">JUMLAH JAM KERJA</label>
										 <input type="number" name="jjk" class="form-control" required="true" >
										 </div>
										  <div class="col-md-12 mb-1">
										  <label class="bold">HONOR PER JJK</label>
										 <input type="number" name="honor" class="form-control" required="true" >
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
									 url: 'staff/tjadwal.php?pg=tambah',
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
											   url: 'staff/tjadwal.php?pg=hapus',
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