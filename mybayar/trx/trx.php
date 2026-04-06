                                 <style>
							.respone {
							  width: 95%;
							  height: auto;
							}
							</style>	
							<?php
							require("../../konek/koneksi.php");
							require("../../konek/function.php");
							require("../../konek/crud.php");
							$blth = date('mY');
							$kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tmpbayar"));
							$jmasuk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(bayar) AS total FROM trx_bayar  WHERE tanggal='$tanggal'"));
							$jbayar = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(bayar) AS total FROM trx_bayar  WHERE blth='$blth'"));
							$reg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg WHERE nokartu='$kode[nokartu]'"));
							?>
									<div class="row">
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">credit_card</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">KARTU SISWA</span>
												
                                                <h4 style="color:blue;font-weight:bold;"><?= $kode['nokartu']; ?></h4>
                                                <span>
												<?php if (strlen($reg['nama']) > 22) { ?>
												<?= substr($reg['nama'],0,22) ?>....
												 <?php }else{ ?>
												 <?= $reg['nama'] ?>
												 <?php } ?>
												</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">shopping_cart</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">TOTAL MASUK HARI INI</span>
												
                                                <h5 style="color:blue;font-weight:bold;">RP : <?= number_format($jmasuk['total']); ?></h5>
                                              
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">shopping_cart</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">TOTAL MASUK BULAN INI</span>
												
                                                <h5 style="color:red;font-weight:bold;">RP : <?= number_format($jbayar['total']); ?></h5>
                                              
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                       <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">LIVE TRX TANGGAL <?= strtoupper(date('d M Y')); ?></h5>
									
                                    </div>
                                    <div class="card-body">
									<div class="card-box table-respone">
                                        <table id="datatable1" class="table table-bordered table-hover edis" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>                                               
                                                    <th>NAMA SISWA</th>
													<th>KELAS</th>
                                                    <th>KODE</th>
													  <th>JML</th>
													<th>KE</th>
													<th>NO BUKTI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM trx_bayar where tanggal='$tanggal'  ORDER BY id DESC LIMIT 5"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											  $kdbayar= fetch($koneksi,'m_bayar',['id'=>$data['idbayar']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $siswa['nama'] ?></td>
													 <td><?= $siswa['kelas'] ?></td>
                                                     <td><h5><span class="badge badge-dark"><?= $kdbayar['kode'] ?></span></h5></td>
													   <td><h5><span class="badge badge-success"><?= number_format($data['bayar']) ?></span></h5></td>
													  <td><h5><span class="badge badge-primary"><?= $data['ke'] ?></span></h5></td>
													  <td><?= $data['bukti'] ?></td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
								                         </div>
                                                      </div>
                                                </div>
											</div>
										</div>
									</div>
                              
									 
				<script>
			
			$('#datatable1').DataTable({
				pageLength: 10
			});
			</script>			