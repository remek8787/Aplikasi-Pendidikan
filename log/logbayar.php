	
								<?php
									require("../konek/koneksi.php");
									require("../konek/function.php");
									require("../konek/crud.php");
									$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE tanggal='$tanggal' AND kredit<>'' ORDER BY id DESC LIMIT 1"); 
	                                $cek = mysqli_num_rows($query);
									?>
                                     <style>
									.responsives {
									  width: 100px;
									  height: 120px;
									}
									#imgs {
									  border: 2px solid #fff;
									 border-radius: 3px;
									}
									</style>									
										<?php if($cek==0): ?>
										<div class="widget-payment-request-container">
       
										<center>
										  <img src="images/animasi.gif" alt="" >
												</center>
												</div>
												<div class="widget-payment-request-author">
												<center><b style="color:red">TIDAK ADA AKTIVITAS</b></center>
											</div>					
                                      <?php else: ?>										
                                            <table id="datata" class="table table-bordered" style="width:100%;font-size:10px;">
                                            
											<?php
											$tanggal = date('Y-m-d');
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE tanggal='$tanggal'  ORDER BY id DESC LIMIT 1"); 
											  while ($data = mysqli_fetch_array($query)) :
											 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$data[idsiswa]'"));
											  $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[idpeg]'"));
											  
											$no++;
											   ?>
                                                <tr>
                                                  <td style="text-align:center; vertical-align:middle;">
												  <?php if($data['idsiswa']<>''): ?>
													<?php if($siswa['foto'] ==''): ?>
														<img src="images/user.png" id="imgs" class="responsives">							
													<?php else: ?>
												    <img src="images/fotosiswa/<?= $siswa['foto'] ?>" id="imgs" class="responsives">
													<?php endif; ?>
													<br><?= $siswa['nama'] ?>
													<br><?= $siswa['kelas'] ?>
													<?php endif; ?>
													 <?php if($data['idpeg']<>''): ?>
													<?php if($speg['foto'] ==''): ?>
														<img src="images/user.png" id="imgs" class="responsives">												
													<?php else: ?>
												        <img src="images/fotoguru/<?= $peg['foto'] ?>" id="imgs" class="responsives">
													<?php endif; ?>	
													<br><?= $peg['nama'] ?>	
													<?php endif; ?>
													 
													</td>
                                                    <td style="background-color:black;vertical-align:middle">
													<br>CARD
													 <?php if($data['idsiswa']<>''): ?>
													 <span><?= $siswa['nokartu'] ?></span>
													 <?php endif; ?>
													  <?php if($data['idpeg']<>''): ?>
													  <span><?= $peg['nokartu'] ?></span>
													  <?php endif; ?>
													  <br>
													  <span style="font-size:10px"><?= $data['ket'] ?></span>
													  <br><br>
													 <span style="font-size:10px">Waktu Bayar</span><br>
													  <span><?= $data['tanggal'] ?></span>  <span><?= $data['jam'] ?></span>
													  <br> TOTAL BAYAR<br>
													 <span style="font-size:10px" class="badge badge-success">RP <?= number_format($data['kredit']) ?></span>
													
													</td>
													</tr>
													
													</tr>
													<?php endwhile; ?>
													
                                                </table>
												<?php endif; ?>