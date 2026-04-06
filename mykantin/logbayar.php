	
								<?php
									require("../konek/koneksi.php");
									require("../konek/function.php");
									require("../konek/crud.php");
									?>           
												
                                            <table id="datata" class="table table-bordered" style="width:100%;font-size:12px">
                                            
											<?php
											$tanggal = date('Y-m-d');
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE tanggal='$tanggal' and kredit >0 ORDER BY id DESC LIMIT 1"); 
											  while ($data = mysqli_fetch_array($query)) :
											 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$data[idsiswa]'"));
											  $peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[idpeg]'"));
											  
											$no++;
											   ?>
                                                <tr>
                                                  <td style="text-align:center; vertical-align:center;width:40%">
												  <?php if($data['idsiswa']<>''): ?>
													<?php if($siswa['foto'] ==''): ?>
														<img src="../images/user.png" class="respon">												
													<?php else: ?>
												        <img src="../images/fotosiswa/<?= $siswa['foto'] ?>" class="responsive">
													<?php endif; ?>	
													<?php endif; ?>
													 <?php if($data['idpeg']<>''): ?>
													<?php if($speg['foto'] ==''): ?>
														<img src="../images/user.png" class="respon">												
													<?php else: ?>
												        <img src="../images/fotoguru/<?= $peg['foto'] ?>" class="responsive">
													<?php endif; ?>	
													<?php endif; ?>
													</td>
                                                    <td style="text-align:left; vertical-align:center;width:60%;font-weight:bold;">
													 <?php if($data['idsiswa']<>''): ?>
													<?= $siswa['nama'] ?>
													 <br><?= $siswa['nis'] ?>													
													<span class="badge badge-dark"><?= $siswa['kelas'] ?></span>
													 <?php endif; ?>
													 <?php if($data['idpeg']<>''): ?>
													<?= $peg['nama'] ?>
													 <br><?= $peg['jabatan'] ?>			
													 <?php endif; ?>
													 <hr>
													 Waktu Bayar
													  <span class="badge badge-primary"><?= $data['tanggal'] ?></span>  <span class="badge badge-primary"><?= $data['jam'] ?></span>
													 </td>
													</tr>
													<tr>
													 <td style="text-align:center; vertical-align:center;width:40%;font-weight:bold;">
													 PAYMENT CARD
													 <?php if($data['idsiswa']<>''): ?>
													 <h5><span class="badge badge-primary"><?= $siswa['nokartu'] ?></span></h5>
													 <?php endif; ?>
													  <?php if($data['idpeg']<>''): ?>
													 <h5><span class="badge badge-primary"><?= $peg['nokartu'] ?></span></h5>
													  <?php endif; ?>
													 </td>
													 <td style="text-align:left; vertical-align:center;width:60%;font-weight:bold;">
													 TOTAL BAYAR
													 <h5><span class="badge badge-success">RP <?= number_format($data['kredit']) ?></span></h5>
													 </td>
													</tr>
													<?php endwhile; ?>
													
                                                </table>
												