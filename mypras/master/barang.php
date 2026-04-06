<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">PERALATAN IT</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>  	
													<th>NAMA BARANG</th>	
													<th>BAIK</th>
													<th>RUSAK</th>
													<th>TAHUN</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM sapras_ruang WHERE jenis='it'"); 
											while ($data = mysqli_fetch_array($query)) :
                                         
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['nama_barang'] ?></td>
													<td><?= $data['baik'] ?></td>
													<td><?= $data['rusak'] ?></td>
													<td><?= $data['tahun'] ?></td>
												<td>												
												<a href="?pg=<?= enkripsi('barang') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>											
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
											   url: 'master/tbarang.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi("barang") ?>');
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
									<img src="<?= $baseurl ?>/images/icon/sapras.ico" class="responsive" alt="thumb" />
									</div>
								<div class="h5" style="color:blue">E SAPRAS</div>
								<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
									  <div class="text-muted">HIGH SCHOOL</div>
									</div>
								  </div>	
									<form id='formbarang' class="row g-1">	
										<label class="bold">NAMA BARANG</label>
									  <div class="input-group mb-1">
									  <input type="text" name="barang" class="form-control" required="true">
                                        </div>
									<label class="bold">JUMLAH BAIK</label>
									  <div class="input-group mb-1">
									  <input type="number" name="baik" class="form-control" required="true">
                                        </div>
										<label class="bold">JUMLAH RUSAK</label>
									  <div class="input-group mb-1">
									  <input type="number" name="rusak" class="form-control" required="true">
                                        </div>
									<label class="bold">TAHUN PENGADAAN</label>
									  <div class="input-group mb-1">
									  <input type="number" name="tahun" class="form-control" required="true">
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						
                 <script>
						$('#formbarang').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'master/tbarang.php?pg=tambah',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.reload();
										}, 2000);
									}
								})
								return false;
							});
							</script>

             <?php elseif ($ac == enkripsi('edit')): ?>
			
             <?php
			 $id = $_GET['id'];
			 $dataz = fetch($koneksi,'sapras_ruang',['id'=>$id]);
			 ?>					 
                      
					     <div class="col-md-4">  
								<div class="card">  	
								<div class="card-body">  
								<div class="d-flex align-items-center flex-column mb-4">
								<div class="d-flex align-items-center flex-column">
								 <div class="sw-13 position-relative mb-3">
									<img src="<?= $baseurl ?>/images/icon/sapras.ico" class="responsive" alt="thumb" />
									</div>
								<div class="h5" style="color:blue">E SAPRAS</div>
								<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
									  <div class="text-muted">HIGH SCHOOL</div>
									</div>
								  </div>	
									<form id='formedit' >	
									<input type="hidden" name="id" value="<?= $dataz['id'] ?>" >
										<label class="bold">NAMA BARANG</label>
									  <div class="input-group mb-1">
									  <input type="text" name="barang" value="<?= $dataz['nama_barang'] ?>" class="form-control" required="true">
                                        </div>
									<label class="bold">JUMLAH BAIK</label>
									  <div class="input-group mb-1">
									  <input type="number" name="baik" value="<?= $dataz['baik'] ?>" class="form-control" required="true">
                                        </div>
										<label class="bold">JUMLAH RUSAK</label>
									  <div class="input-group mb-1">
									  <input type="number" name="rusak" value="<?= $dataz['rusak'] ?>" class="form-control" required="true">
                                        </div>
									<label class="bold">TAHUN PENGADAAN</label>
									  <div class="input-group mb-1">
									  <input type="number" name="tahun" value="<?= $dataz['tahun'] ?>" class="form-control" required="true">
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							
                 <script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'master/tbarang.php?pg=edit',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi("barang") ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					