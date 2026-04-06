<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">SARANA DAN PRASARANA</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>  	
													<th>KATEGORI</th>
													<th>NAMA RUANG / BARANG</th>														
													<th>JML</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM sapras_ruang"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['jenis'] ?></td>
													<td><?= $data['ruang'] ?></td>
													 <td><?= $data['jumlah'] ?></td>
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
									<img src="<?= $baseurl ?>/images/icon/sapras.ico" class="responsive" alt="thumb" />
									</div>
								<div class="h5" style="color:blue">E SAPRAS</div>
								<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
									  <div class="text-muted">HIGH SCHOOL</div>
									</div>
								  </div>	
									<div class="widget-payment-request-info m-t-md">
									<form action="cetak/cetak_sapras.php" target="_blank" method="GET" enctype="multipart/form-data">	
										<select name="kate" class="form-select" required="true">
									 <?php
										$kls = mysqli_query($koneksi, "SELECT jenis FROM sapras_ruang group by jenis");
										while ($kelas = mysqli_fetch_array($kls)) { ?>
										<option value="<?= $kelas['jenis'] ?>"><?= strtoupper($kelas[jenis]) ?></option>
										<?php } ?>
									</select>
										
										
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
					  
					  
					  
					  	  
					  
					  
					