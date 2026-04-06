                                 
							<?php
							require("../../konek/koneksi.php");
							require("../../konek/function.php");
							require("../../konek/crud.php");
							$kode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tmpsis"));
							$barkode = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tmpbuku"));
							$pinjam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where tanggal='$tanggal' and ket ='Pinjam'"));
							$kembali = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi where tanggal='$tanggal' and ket ='Kembali'"));
							$reg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM datareg WHERE nokartu='$kode[nokartu]'"));
							$sql = mysqli_query($koneksi, "select * from statustrx");
							$datax = mysqli_fetch_array($sql);
							$mode_perpus = $datax['mode'];
							
							if($mode_perpus==1){
								$sts ="PINJAM";	
							}else if($mode_perpus==2){
								$sts = "KEMBALI";
							}else if($mode_perpus==3){
								$sts = "INPUT BUKU";
							}
							?>
									<div class="row">
							  <div class="col-xl-5">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">credit_card</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">KARTU PUSTAKA</span>
												
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
                            <div class="col-xl-2">
                                
                                    <div class="card-body">
                                        
                                                
												<?php if($barkode['kode']<>''): ?>
												<center><img src="../temp/perpus/<?= $barkode['kode']; ?>.png" class="responsive" style="margin-top:-10px;"></center>
												<?php endif; ?>
												
                                       
                                   
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">shopping_cart</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">TRANSAKSI HARI INI</span>
												
                                                <h5 style="color:red;font-weight:bold;">PINJAM &nbsp;&nbsp;: <?= $pinjam; ?></h5>
                                               <h5 style="color:blue;font-weight:bold;">KEMBALI : <?= $kembali; ?></h5>
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
                                        <h5 class="card-title">TRX TANGGAL <?= strtoupper(date('d M Y')); ?></h5>
									<div class="pull-right">
                                  <h5><span class="badge badge-danger kanan">MODE MESIN : <?= $sts; ?></span></h5>
										</div>
                                    </div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>NAMA SISWA</th>
													<th>KELAS</th>
                                                    <th>JUDUL BUKU</th>
													  <th>JML</th>
													<th>KET</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM transaksi where ket='Kembali' and tanggal='$tanggal' ORDER BY id DESC LIMIT 5"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											  $buku= fetch($koneksi,'buku',['id'=>$data['idbuku']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $siswa['nama'] ?></td>
													 <td><?= $siswa['kelas'] ?></td>
                                                     <td><?= $buku['judul'] ?></td>
													  <td><h5><span class="badge badge-dark"><?= $data['jml'] ?></span></h5></td>
													  <td><h5><span class="badge badge-success"><?= $data['ket'] ?></span></h5></td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
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