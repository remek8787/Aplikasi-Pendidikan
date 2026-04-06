<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">LAPORAN DATA BUKU</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
                                                    <th>LOKASI</th>													
                                                    <th>KATEGORI</th>
                                                    <th>JUDUL BUKU</th>
													  <th>JUMLAH</th>
													  <th>KELUAR</th>
													  <th>STOK</th>
													 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM buku"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $kate = fetch($koneksi,'m_buku',['idm'=>$data['idkategori']]);
											  $keluar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where idbuku='$data[id]' and ket ='Pinjam'"));
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $kate['rak'] ?></td>
                                                    <td><?= $kate['kategori'] ?></td>
                                                     <td><?= $data['judul'] ?></td>
													  <td><h5><span class="badge badge-primary"><?= $data['jumlah'] ?></span></h5></td>
													  <td><h5><span class="badge badge-danger"><?= $keluar ?></span></h5></td>
													   <td><h5><span class="badge badge-dark"><?= $data['jumlah']-$keluar; ?></span></h5></td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
						</div>