<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">LEMARI ARSIP</h5>
										<div class="pull-right">
										<a href="?pg=<?= enkripsi('dashgur') ?>" class="btn btn-primary">BACK</a>
										</div>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  	
													<th>KODE</th>
													<th>NAMA LEMARI</th>
													<th>LOKASI</th>	
													 <th width="20%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM m_lemari"); 
											while ($data = mysqli_fetch_array($query)) :													  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['kode'] ?></td>
													<td><?= $data['nama'] ?></td>
													<td><?= $data['lokasi'] ?></td>
												<td>												
												<a href="?pg=<?= enkripsi('lemari') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>											
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
											   url: 'arsip/tlemari.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(lemari) ?>');
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
							  
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">LEMARI ARSIP</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formdeskrip' >	
										<label class="bold">KODE</label>
									  <div class="input-group mb-1">
									  <input type="text" name="kode" class="form-control" required="true">
                                        </div>
										<label class="bold">NAMA LEMARI</label>
									  <div class="input-group mb-1">
									  <input type="text" name="nama" class="form-control" required="true">
                                        </div>
										<label class="bold">LOKASI</label>
									  <div class="input-group mb-1">
									  <input type="text" name="lokasi" class="form-control" required="true">
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
                 <script>
						$('#formdeskrip').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'arsip/tlemari.php?pg=lemari',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									width: "30%"
									}, 500);
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
			 $id = dekripsi($_GET['id']);
			 $dataz = fetch($koneksi,'m_lemari',['id'=>$id]);
			 ?>					 
                      
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                      <h5 class="bold">EDIT LEMARI</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formedit' >	
									<input type="hidden" name="id" value="<?= $dataz['id'] ?>" >
									
										<label class="bold">KODE</label>
									  <div class="input-group mb-1">
									  <input type="text" name="kode" class="form-control" value="<?= $dataz['kode'] ?>" required="true">
                                        </div>
										<label class="bold">NAMA LEMARI</label>
									  <div class="input-group mb-1">
									  <input type="text" name="nama" class="form-control" value="<?= $dataz['nama'] ?>" required="true">
                                        </div>
										<label class="bold">LOKASI</label>
									  <div class="input-group mb-1">
									  <input type="text" name="lokasi" class="form-control" value="<?= $dataz['lokasi'] ?>" required="true">
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
                 <script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'arsip/tlemari.php?pg=edit',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									width: "30%"
									}, 500);
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi(lemari) ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					