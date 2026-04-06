<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">LAPORAN DATA PEMINJAM BUKU</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
                                                    <th>TANGGAL</th>													
                                                    
                                                    <th>NAMA SISWA</th>
													  <th>KELAS</th>
													  <th>JUDUL BUKU</th>
													  <th>JML</th>
													 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi where ket='pinjam'"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											  $buku = fetch($koneksi,'buku',['id'=>$data['idbuku']]);
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['tanggal'] ?></td>
                                                     <td><?= $siswa['nama'] ?></td>
													  <td><h5><span class="badge badge-primary"><?= $data['kelas'] ?></span></h5></td>
													  <td><?= $buku['judul'] ?></td>
													  <td><h5><span class="badge badge-danger"><?= $data['jml']; ?></span></h5></td>
													  
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
						       </div>