<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$tanggal = date('Y-m-d');
$bulan = date('m');
$tahun = date('Y');
$proyek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM m_proyek"));
$nilproyek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proyek"));
$catat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proses"));
$dim = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM proyek"));
$sb = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proyek where nilai='SB'"));
?>


                      <div class="row">
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PROYEK</span>
                                                <span class="widget-stats-amount"><?= $proyek; ?></span>
                                                <span class="widget-stats-info"><?= substr($setting['sekolah'],0,19) ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">NILAI PROYEK</span>
                                                <span class="widget-stats-amount"><?= $nilproyek; ?></span>
                                                <span class="widget-stats-info"><?= substr($setting['sekolah'],0,19) ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-danger">
                                                <i class="material-icons-outlined">school</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">CATATAN PROSES</span>
                                                <span class="widget-stats-amount"><?= $catat ?> </span>
                                                <span class="widget-stats-info"><?= substr($setting['sekolah'],0,19) ?></span>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                       <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PROYEK (P5)</h5>										
                                    </div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
													<th>TINGKAT</th>
														<th>ROMBEL</th>
                                                    <th>PROYEK</th>
													 <th>JUDUL PROYEK</th>													 
													 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;			
											$query = mysqli_query($koneksi, "SELECT * FROM m_proyek"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                 <td><?= $no; ?></td>
                                                  <td><?= $data['tingkat'] ?></td>
													<td><?= $data['kelas'] ?></td>
												<td><?= $data['ke'] ?></td>
												<td><?= $data['judul'] ?></td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
                              
							
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">DIMENSI PROYEK</span>
                                                <span class="widget-stats-amount"><?= $dim; ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SANGAT BERKEMBANG</span>
                                                <span class="widget-stats-amount"><?= $sb; ?> </span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>	
                      </div>	
                               
	                 