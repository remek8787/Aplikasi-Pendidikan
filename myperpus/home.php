<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$exec = mysqli_query($koneksi, "truncate tmpbuku");
$exec = mysqli_query($koneksi, "truncate tmpsis");
$keluar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where ket ='Pinjam'"));

$jbuku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$jkate = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM m_buku"));
$pinjam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where tanggal='$tanggal' and ket ='Pinjam'"));
$kembali = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where tanggal='$tanggal' and ket ='Kembali'"));
?>


                      <div class="row">
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">storage</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">KATEGORI BUKU</span>
                                                <span class="widget-stats-amount"><?= $jkate; ?></span>
                                              
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
                                                <i class="material-icons-outlined">credit_card</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">TOTAL BUKU</span>
                                                <span class="widget-stats-amount"><?= $jbuku; ?></span>
                                              
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
                                                <i class="material-icons-outlined">shopping_cart</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">TOTAL BUKU KELUAR</span>
                                                <span class="widget-stats-amount"><?= $keluar ?> </span>

                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                       <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">RATING BUKU TERLARIS</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>KATEGORI</th>
													<th>JUDUL</th>
                                                    <th>JML BUKU</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											
											$query = mysqli_query($koneksi, "SELECT SUM(jml) AS mak,idbuku,ket FROM transaksi where ket='Pinjam' GROUP BY idbuku ORDER BY mak DESC LIMIT 10");
											
											  while ($data = mysqli_fetch_array($query)) :
											  $buku = fetch($koneksi,'buku',['id'=>$data['idbuku']]);
											  
											  $kate = fetch($koneksi,'m_buku',['idm'=>$buku['idkategori']]);
											 
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $kate['kategori'] ?></td>
													<td><?= $buku['judul'] ?></td>
                                                     <td><h5><span class="badge badge-dark"><?= $data['mak'] ?></span></h5></td>
													 
                                                </tr>
												<?php endwhile; ?>
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
                                                <span class="widget-stats-title">PEMINJAM HARI INI</span>
                                                <span class="widget-stats-amount"><?= $pinjam; ?></span>
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
                                                <span class="widget-stats-title">PENGEMBALIAN HARI INI</span>
                                                <span class="widget-stats-amount"><?= $kembali; ?> </span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
								
                            </div>
						</div>	
                      </div>	
                               
	                 