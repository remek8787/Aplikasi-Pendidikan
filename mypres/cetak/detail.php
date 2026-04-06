 <?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$bulan = date('m');
$blQ = fetch($koneksi,'bulan',['bln'=>$bulan]);

?>


                        <div class="row">
                           <div class="col-xl-8">
                                <div class="card">
								<div class="card card-header">
                                     <h5 class="card-title">BULAN <?= strtoupper($blQ['ket']); ?> <?= date('Y') ?></h5></a>
										</div>
                                    <div class="card-body">
									
                                         <div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NAMA LENGKAP</th>
                                                    <th>JABATAN</th>
                                                      <th>H &nbsp;</th>
                                                    <th>I &nbsp;</th>
													<th>S &nbsp;</th>
													<th>A &nbsp;</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											
											$no=0; 
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$_GET[ids]'"); 
											 while ($data = mysqli_fetch_array($query)) :
				                             
											  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='H' AND bulan='$bulan'"));
											$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='I' AND bulan='$bulan'"));
											$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='S' AND bulan='$bulan'"));
											$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='A' AND bulan='$bulan'"));
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nama'] ?></td>
                                                     <td><?= ucfirst($data['level']); ?></td>
                                                     <td><?= $hadir; ?></td>
													   <td><?= $izin; ?></td>
													     <td><?= $sakit; ?></td>
														   <td><?= $alpha; ?></td>
                                                    
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                         
                             <div class="col-xl-4">
                                <div class="card widget widget-payment-request">
                                   
                                    <div class="card-body">
									 <form id="formabsen" method="GET" action="cetak/detailabsenguru.php" target="_blank" enctype="multipart/form-data">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/absen.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $setting['sekolah'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= date('d M Y') ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="widget-payment-request-info m-t-md">
                                                <div class="widget-payment-request-info-item">
                                                    <span class="widget-payment-request-info-title d-block">
													 <label class="form-label">BULAN</label>                               
													  <select name="bulan"  class="form-select" style="width: 100%;" required >
												  <option value=''></option>
													 <?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
													   <?php while ($mt = mysqli_fetch_array($qt)) : ?>
														 <option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
															<?php endwhile ?>
															   </select>   
													</span>                                                  
                                                </div>                                               
                                            </div>
											<p>
                                           <div class="d-grid gap-2">
                                             <input type="hidden" name="ids" value="<?= $_GET['ids'] ?>" >
                                                <button type="submit"  class="btn btn-primary flex-grow-1 m-l-xxs">CETAK DETAIL</button>
                                            </div>
                                        </div>
										</form>
										<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                             	
					</div>
                     	