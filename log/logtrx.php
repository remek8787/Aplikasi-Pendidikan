			
							<?php
									require("../konek/koneksi.php");
									require("../konek/function.php");
									require("../konek/crud.php");
									$jtrx = mysqli_num_rows(mysqli_query($koneksi, "SELECT status FROM transaksi_kantin WHERE status='1'"));
									?>           
												   
			                        <?php if($jtrx==0): ?>
									
									<center> <img src="images/animasi.gif" alt="" ><br>
									<b style="color:red">TIDAK ADA TRANSAKSI</b></center>
									<?php else: ?>
									<?php
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idsiswa<>'' GROUP BY idsiswa ORDER BY id DESC"); 
											  while ($data = mysqli_fetch_array($query)) :
											 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_siswa,nama,kelas FROM siswa  WHERE id_siswa='$data[idsiswa]'"));
											  
											  ?>
                                            <b><?= $siswa['nama'] ?> <span class="badge badge-primary"><?= $siswa['kelas'] ?></span></b> 
											<div class="kanan"><h5><span class="badge badge-primary">BELUM BAYAR</span></h5></div>
                                            <table id="datatax"  style="width:100%;font-size:11px">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>                                               
                                                   <th>NAMA BARANG</th>
												   <th width="10%">JML</th>
												   <th width="15%">HARGA</th>
												    <th width="15%">TOTAL</th>
													  
                                                </tr>
                                            </thead>
											<tbody>
											<?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idsiswa='$data[idsiswa]'  ORDER BY id DESC"); 
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
													  
													</tr>
															
													<?php endwhile; ?>
													</tbody>
                                                </table>
												<?php  $total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idsiswa,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idsiswa='$data[idsiswa]' AND status='1'")); ?>
												<table id="datata" class="table table-bordered" style="width:100%;font-size:12px">
                                             
                                                <tr>
												<td colspan="3" style="text-align:right;font-weight:bold;">TOTAL RP.</td>
												<td width="20%" style="background-color:black;font-weight:bold;"><?= number_format($total['total']) ?></td>
												</tr>
												</table>
												<p>
												<?php endwhile; ?>
												
											

											
											<?php
											$que = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idpeg<>'' GROUP BY idpeg ORDER BY id DESC"); 
											  while ($dataq = mysqli_fetch_array($que)) :
											 $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_user,nama,jabatan FROM users  WHERE id_user='$dataq[idpeg]'"));
											  
											  ?>
                                            <b><?= $peg['nama'] ?>  <span class="badge badge-primary"><?= $peg['jabatan'] ?></span></b> 
											<div class="kanan"><h5><span class="badge badge-primary">BELUM BAYAR</span></h5></div>
                                            <table id="datata"  style="width:100%;font-size:11px">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>                                               
                                                   <th>NAMA BARANG</th>
												   <th width="10%">JML</th>
												   <th width="15%">HARGA</th>
												    <th width="15%">TOTAL</th>
													  
                                                </tr>
                                            </thead>
											<tbody>
											<?php
											$no=0;
											$queryx = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE status='1' and idpeg='$dataq[idpeg]' ORDER BY id DESC"); 
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
													  
													</tr>
																
													<?php endwhile; ?>
													</tbody>
                                                </table>
												<?php  $total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,SUM(total_harga) AS total FROM transaksi_kantin  WHERE idpeg='$dataq[idpeg]' AND status='1'")); ?>
												<table id="datata" class="table table-bordered" style="width:100%;font-size:12px">
                                             
                                                <tr>
												<td colspan="3" style="text-align:right;font-weight:bold;">TOTAL RP.</td>
												<td width="20%" style="background-color:black;font-weight:bold;"><?= number_format($total['total']) ?></td>
												</tr>
												</table>
												<p>
												<?php endwhile; ?>	
									
							    <?php endif; ?>
								