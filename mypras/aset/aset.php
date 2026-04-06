<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">ASET SEKOLAH</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  	
													<th>TANGGAL</th>
													<th>NAMA BARANG</th>	
													<th>JML</th>
													<th>TOTAL RP</th>													
													 <th width="18%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM aset ORDER BY id DESC"); 
											while ($data = mysqli_fetch_array($query)) :
														
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['tanggal'] ?></td>
													<td><?= $data['nama_barang'] ?></td>
													<td><?= $data['jumlah'] ?></td>
													<td><?= number_format($data['total']) ?></td>
													  <td>
											
											<a href="?pg=<?= enkripsi('aset') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>											
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
											   url: 'aset/taset.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(aset) ?>');
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
									
									<form id='formbarang' >	
										<label class="bold">Tanggal Pembelian</label>
									  <div class="input-group mb-1">
									 <input type="text" name="tgl" class="form-control datepicker" required="true" autocomplete="off">
                                        </div>
										<label class="bold">Nama Toko</label>
									  <div class="input-group mb-1">
									  <input type="text" name="toko" class="form-control" required="true" >
									 </div>
									 <label class="bold">Alamat Toko</label>
									  <div class="input-group mb-1">
									 <input type="text" name="alamat" class="form-control" required="true" >
                                        </div>
										<label class="bold">Nama Barang</label>
									  <div class="input-group mb-1">
									 <input type="text" name="barang" class="form-control"  required="true" >
                                        </div>
										<label class="bold">Jumlah Barang</label>
									  <div class="input-group mb-1">
									 <input type="number" name="jumlah" class="form-control" value="1" required="true" >
                                        </div>
										<label class="bold">Harga Per Barang</label>
									  <div class="input-group mb-1">
									 <input type="number" name="harga" class="form-control" value="0" required="true" >
                                        </div>
										<label class="bold">Sumber Dana</label>
									  <div class="input-group mb-1">
									 <select name='dana' class='form-select' required='true' style="width: 100%">								  
								   <option value='BOS'>BOS</option>
								    <option value='BOP'>BOSP</option>
									<option value='Lainnya'>Lainnya</option>
									
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
						
				
                 <script>
						$('#formbarang').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'aset/taset.php?pg=input',
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
			 $id = dekripsi($_GET['id']);
			 $aset = fetch($koneksi,'aset',['id'=>$id]);
			 
			 ?>					 
                      
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                      <h5 class="bold">EDIT ASET</h5>
										
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
									<input type="hidden" name="id" value="<?= $aset['id'] ?>" >
									<label class="bold">Tanggal Pembelian</label>
									  <div class="input-group mb-1">
									 <input type="text" name="tgl" class="form-control datepicker" value="<?= $aset['tanggal'] ?>" required="true" autocomplete="off">
                                        </div>
										<label class="bold">Nama Toko</label>
									  <div class="input-group mb-1">
									  <input type="text" name="toko" class="form-control" value="<?= $aset['toko'] ?>" required="true" >
									 </div>
									 <label class="bold">Alamat Toko</label>
									  <div class="input-group mb-1">
									 <input type="text" name="alamat" class="form-control" value="<?= $aset['alamat'] ?>" required="true" >
                                        </div>
										<label class="bold">Nama Barang</label>
									  <div class="input-group mb-1">
									 <input type="text" name="barang" class="form-control" value="<?= $aset['nama_barang'] ?>" required="true" >
                                        </div>
										<label class="bold">Jumlah Barang</label>
									  <div class="input-group mb-1">
									 <input type="number" name="jumlah" class="form-control" value="<?= $aset['jumlah'] ?>" required="true" >
                                        </div>
										<label class="bold">Harga Per Barang</label>
									  <div class="input-group mb-1">
									 <input type="number" name="harga" class="form-control" value="<?= $aset['harga'] ?>" required="true" >
                                        </div>
										<label class="bold">Sumber Dana</label>
									  <div class="input-group mb-1">
									 <select name='dana' class='form-select' required='true' style="width: 100%">
								  <option value="<?= $aset['dana'] ?>"><?= $aset['dana'] ?></option>
								   <option value='BOS'>BOS</option>
								   <option value='BOP'>BOSP</option>
									<option value='Lainnya'>Lainnya</option>
									
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
                 <script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'aset/taset.php?pg=edit',
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
											window.location.replace('?pg=<?= enkripsi(aset) ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					