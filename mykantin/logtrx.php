			
							<?php
									require("../konek/koneksi.php");
									require("../konek/function.php");
									require("../konek/crud.php");
									?>           
												   
			
									<?php
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idsiswa<>'' GROUP BY idsiswa"); 
											  while ($data = mysqli_fetch_array($query)) :
											 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_siswa,nama FROM siswa  WHERE id_siswa='$data[idsiswa]'"));
											  
											  ?>
                                            <b><?= $siswa['nama'] ?></b> 
											<div class="kanan"><h5><span class="badge badge-primary">BELUM BAYAR</span></h5></div>
                                            <table id="datata"  style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>                                               
                                                   <th>NAMA BARANG</th>
												   <th width="10%">JML</th>
												   <th width="15%">HARGA</th>
												    <th width="15%">TOTAL</th>
													   <th width="5%">CANCEL</th>
													    <th width="5%">PROSES</th>
                                                </tr>
                                            </thead>
											<tbody>
											<?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idsiswa='$data[idsiswa]'"); 
											  while ($datax = mysqli_fetch_array($queryx)) :
											   $produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$datax[idproduk]'"));
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $produk['produk_nama'] ?></td>
													 <td><?= $datax['jumlah'] ?></td>
													  <td><?= number_format($datax['harga']) ?></td>
													   <td><?= number_format($datax['total_harga']) ?></td>
													   <td>
													   <?php if($datax['ket']=='0'): ?>
													   <div id="sis<?= $datax['id'] ?>">
													   <button data-id="<?= $datax['id'] ?>"  class="hapus btn btn-sm btn-danger"><i class="material-icons">close</i></button>
													  </div>
													  

													   <?php elseif($datax['ket']=='1'): ?>
													    <button  class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>							  
													    <?php endif; ?>
													  </td>
													  <td>
													   <?php if($datax['ket']=='0'): ?>
													  <div id="siswa<?= $datax['id'] ?>">
													  <button data-idz="<?= $datax['id'] ?>"  class="acc btn btn-sm btn-success"><i class="material-icons">check</i></button>
													 
													   </div>
													  <?php elseif($datax['ket']=='1'): ?>
													    <button  class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>							  
													    <?php endif; ?>
													   </td>
													</tr>
													<script>
																$('#sis<?= $datax[id] ?>').on('click', '.hapus', function() {
																var id = $(this).data('id');
																console.log(id);
																swal({
																		  title: 'Yakin akan Cancel Pesanan?',
																		  text: "Pesanan Akan di Batalkan",
																		  type: 'warning',
																		  showCancelButton: true,
																		  confirmButtonColor: '#3085d6',
																		  cancelButtonColor: '#d33',
																		  confirmButtonText: 'Ya, Tolak',
																		  cancelButtonText: "Batal"				  
																}).then((result) => {
																	if (result.value) {
																		$.ajax({
																		   url: 'siswa/batal.php',
																			method: "POST",
																			data: 'id=' + id,
																			
																		});
																	}
																	return false;
																})

															});

														</script> 
														 <script>
																$('#siswa<?= $datax[id] ?>').on('click', '.acc', function() {
																var idz = $(this).data('idz');
																console.log(idz);
																swal({
																		  title: 'Proses Pesanan',
																		  text: "Pesanan Akan di Proses",
																		  type: 'warning',
																		  showCancelButton: true,
																		  confirmButtonColor: '#3085d6',
																		  cancelButtonColor: '#d33',
																		  confirmButtonText: 'Ya, Proses',
																		  cancelButtonText: "Batal"				  
																}).then((result) => {
																	if (result.value) {
																		$.ajax({
																		   url: 'siswa/setuju.php',
																			method: "POST",
																			data: 'idz=' + idz,
																			
																		});
																	}
																	return false;
																})

															});

														</script>    			
													<?php endwhile; ?>
													</tbody>
                                                </table>
												<?php  $total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idsiswa='$data[idsiswa]' AND status='1'")); ?>
												<table id="datata" class="table table-bordered" style="width:100%;font-size:12px">
                                             
                                                <tr>
												<td colspan="4" style="text-align:right;font-weight:bold;">TOTAL RP.</td>
												<td width="20%" style="background-color:yellow;font-weight:bold;"><?= number_format($total['total']) ?></td>
												</tr>
												</table>
												<p>
												<?php endwhile; ?>
												
											





											
											<?php
											$que = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idpeg<>'' GROUP BY idpeg"); 
											  while ($dataq = mysqli_fetch_array($que)) :
											 $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_user,nama,jabatan FROM users  WHERE id_user='$dataq[idpeg]'"));
											  
											  ?>
                                            <b><?= $peg['nama'] ?>  <span class="badge badge-primary"><?= $peg['jabatan'] ?></span></b> 
											<div class="kanan"><h5><span class="badge badge-primary">BELUM BAYAR</span></h5></div>
                                            <table id="datata"  style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>                                               
                                                   <th>NAMA BARANG</th>
												   <th width="10%">JML</th>
												   <th width="15%">HARGA</th>
												    <th width="15%">TOTAL</th>
													   <th width="5%">CANCEL</th>
													    <th width="5%">PROSES</th>
                                                </tr>
                                            </thead>
											<tbody>
											<?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idpeg='$dataq[idpeg]'"); 
											  while ($datax = mysqli_fetch_array($queryx)) :
											   $produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$datax[idproduk]'"));
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $produk['produk_nama'] ?></td>
													 <td><?= $datax['jumlah'] ?></td>
													  <td><?= number_format($datax['harga']) ?></td>
													   <td><?= number_format($datax['total_harga']) ?></td>
													   <td>
													   <?php if($datax['ket']=='0'): ?>
													   <div id="sis<?= $datax['id'] ?>">
													   <button data-id="<?= $datax['id'] ?>"  class="hapus btn btn-sm btn-danger"><i class="material-icons">close</i></button>
													  </div>
													  

													   <?php elseif($datax['ket']=='1'): ?>
													    <button  class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>							  
													    <?php endif; ?>
													  </td>
													  <td>
													   <?php if($datax['ket']=='0'): ?>
													  <div id="siswa<?= $datax['id'] ?>">
													  <button data-idz="<?= $datax['id'] ?>"  class="acc btn btn-sm btn-success"><i class="material-icons">check</i></button>
													 
													   </div>
													  <?php elseif($datax['ket']=='1'): ?>
													    <button  class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>							  
													    <?php endif; ?>
													   </td>
													</tr>
													<script>
																$('#sis<?= $datax[id] ?>').on('click', '.hapus', function() {
																var id = $(this).data('id');
																console.log(id);
																swal({
																		  title: 'Yakin akan Cancel Pesanan?',
																		  text: "Pesanan Akan di Batalkan",
																		  type: 'warning',
																		  showCancelButton: true,
																		  confirmButtonColor: '#3085d6',
																		  cancelButtonColor: '#d33',
																		  confirmButtonText: 'Ya, Tolak',
																		  cancelButtonText: "Batal"				  
																}).then((result) => {
																	if (result.value) {
																		$.ajax({
																		   url: 'siswa/batal.php',
																			method: "POST",
																			data: 'id=' + id,
																			
																		});
																	}
																	return false;
																})

															});

														</script> 
														 <script>
																$('#siswa<?= $datax[id] ?>').on('click', '.acc', function() {
																var idz = $(this).data('idz');
																console.log(idz);
																swal({
																		  title: 'Proses Pesanan',
																		  text: "Pesanan Akan di Proses",
																		  type: 'warning',
																		  showCancelButton: true,
																		  confirmButtonColor: '#3085d6',
																		  cancelButtonColor: '#d33',
																		  confirmButtonText: 'Ya, Proses',
																		  cancelButtonText: "Batal"				  
																}).then((result) => {
																	if (result.value) {
																		$.ajax({
																		   url: 'siswa/setuju.php',
																			method: "POST",
																			data: 'idz=' + idz,
																			
																		});
																	}
																	return false;
																})

															});

														</script>    			
													<?php endwhile; ?>
													</tbody>
                                                </table>
												<?php  $total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idpeg='$dataq[idpeg]' AND status='1'")); ?>
												<table id="datata" class="table table-bordered" style="width:100%;font-size:12px">
                                             
                                                <tr>
												<td colspan="4" style="text-align:right;font-weight:bold;">TOTAL RP.</td>
												<td width="20%" style="background-color:yellow;font-weight:bold;"><?= number_format($total['total']) ?></td>
												</tr>
												</table>
												<p>
												<?php endwhile; ?>	
									
													
							