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
													<th>NAMA BARANG</th>	
													<th>JML</th>
													<th>BAIK</th>
													<th>RINGAN</th>
													<th>BERAT</th>
													
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
													 
														
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
							<?php if ($ac == '') : ?>
							<?php $datax = fetch($koneksi,'aset',['id'=>$_GET['id']]); ?>
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
									<div class="widget-payment-request-info m-t-md">
									<form  action="cetak/cetak_aset.php"  method="post" enctype="multipart/form-data">	
									  
										<label class="bold">Pilih Kondisi</label>
									  <div class="input-group mb-1">
									<select name="kondisi" class="form-select" required="true">
									<option value="semua">Semua Kondisi</option>
									<option value="baik">Kondisi Baik</option>
									<option value="ringan">Rusak Ringan</option>
									<option value="berat">Rusak Berat</option>
									</select>
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">CETAK</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					
                 
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					