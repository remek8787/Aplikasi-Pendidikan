<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>           
			<?php if ($ac == '') : ?>   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">STRUK PEMBAYARAN</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="8%">NO</th>                                               
                                                    <th>JML</th>
													<th>NAMA PRODUK</th>
													  <th>HARGA</th>
													<th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE tanggal='$tanggal' AND status='2'"); 
											  while ($data = mysqli_fetch_array($query)) :
											$produk = fetch($koneksi,'produk',['produk_id'=>$data['idproduk']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['jumlah'] ?></td>
													<td><?= $produk['produk_nama'] ?></td>
                                                    <td><?= number_format($data['harga']) ?></td>
													<td><?= number_format($data['total_harga']) ?></td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								
					       <div class="col-md-4">         
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">CETAK STRUK MANUAL</h5>										
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
										<label class="bold">TANGGAL</label>
									  <div class="input-group mb-1">
                                       <input type='text' name="tanggal" class='form-control' value="<?= $tanggal ?>" readonly />									   
                                        </div>
											
										<div class="widget-payment-request-actions m-t-md d-flex">
                                         <button class="btn btn-primary flex-grow-1 m-l-xxs" onclick="frames['frameresult'].print()"><i class='material-icons'>print</i>Cetak</button>
                                            </div>
									 </div>
					            </div>
							</div>
						</div>
					</div>						
							
				</div>
				<iframe id='loadframe' name='frameresult' src='manual/cetak.php' style='display:none'></iframe>
	 
<?php endif ?>
   
								