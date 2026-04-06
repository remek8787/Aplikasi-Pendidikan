<?php 
defined('APK') or exit('No Access');
$j1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sk_peg where idsk='1'"));
$j2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM sk_peg where idsk='2'"));
$j3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM surat_tugas"));

?>

                       <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">MASTER SURAT</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                                  
										  <th>JUDUL</th>                                         
										   <th>NOMOR</th>
										    <th>TEMPAT, TANGGAL</th>
										 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM m_sk"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                            <td><?= $data['judul'] ?></td>
											<td><?= $data['nosk'] ?></td>
											  <td><?= $data['tempat'] ?> <?= $data['tglsk'] ?></td>
                                          
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
                                                <i class="material-icons-outlined">menu</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">GTT / GTY</span>
                                                <span class="widget-stats-amount"><?= $j1; ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
							   <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">apps</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PEMBAGIAN TUGAS</span>
                                                <span class="widget-stats-amount"><?= $j2; ?></span>
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
                                                <span class="widget-stats-title">SPPD</span>
                                                <span class="widget-stats-amount"><?= $j3; ?> </span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>	
                      </div>	
                    