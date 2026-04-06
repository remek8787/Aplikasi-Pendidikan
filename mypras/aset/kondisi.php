<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">EDIT KONDISI ASET SEKOLAH</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  	
													<th>NAMA BARANG</th>	
													<th>JML</th>
													<th>BAIK</th>
													<th>RINGAN</th>
													<th>BERAT</th>
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
													<td><?= $data['nama_barang'] ?></td>
													<td><?= $data['jumlah'] ?></td>
													<td><?= $data['baik'] ?></td>
													<td><?= $data['ringan'] ?></td>
													<td><?= $data['berat'] ?></td>
													  <td>
											
											<a href="?pg=<?= enkripsi('kondisi') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>											
											</td>
														
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
							<?php if ($ac == '') : ?>
							<?php $datax = fetch($koneksi,'aset',['id'=>$_GET['id']]); ?>
					       <div class="col-md-4">
							  
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">EDIT KONDISI</h5>
										
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
									<form id='formbarang' >	
									  <input type="hidden" name="id" value="<?= $_GET['id'] ?>" >
										<label class="bold">Nama Barang</label>
									  <div class="input-group mb-1">
									 <input type="text" name="barang" class="form-control" value="<?= $datax['nama_barang'] ?>" readonly="true" >
                                        </div>
										<label class="bold">Jumlah Barang</label>
									  <div class="input-group mb-1">
									 <input type="number" name="jumlah" class="form-control" value="<?= $datax['jumlah'] ?>" readonly="true" >
                                        </div>
										<label class="bold">Jumlah Baik</label>
									  <div class="input-group mb-1">
									 <input type="number" name="baik" class="form-control" value="<?= $datax['baik'] ?>" required="true" >
                                        </div>
										<label class="bold">Jumlah Rusak Ringan</label>
									  <div class="input-group mb-1">
									 <input type="number" name="ringan" class="form-control" value="<?= $datax['ringan'] ?>" required="true" >
                                        </div>
										<label class="bold">Jumlah Rusak Berat</label>
									  <div class="input-group mb-1">
									 <input type="number" name="berat" class="form-control" value="<?= $datax['berat'] ?>" required="true" >
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
						$('#formbarang').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'aset/taset.php?pg=kondisi',
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

            
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					