<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">DATA STOK HAMPIR HABIS</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>NAMA PRODUK</th>
											         <th>JML SISA</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_toko='$user[idtoko]' AND produk_jumlah < 6 "); 
											while ($data = mysqli_fetch_array($query)) :
											  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                     <td><?= $data['produk_nama'] ?></td>
													<td><?= $data['produk_jumlah'] ?></td> 
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
					
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">CETAK STOK HABIS</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $user['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									
										 <label>Nama Toko</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' value="<?= $mytoko['nama_toko'] ?>" required='true' readonly />
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button  class="btn btn-primary flex-grow-1 m-l-xxs" onclick="frames['frameresult'].print()">CETAK</button>
                                            </div>
										
									 </div>
					            </div>
								</div>
							</div>
						</div>
					
					<iframe id='loadframe' name='frameresult' src='toko/cetakstok.php?idtoko=<?= $user[idtoko] ?>' style='display:none'></iframe>
