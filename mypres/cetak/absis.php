 <?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$bulan = date('m');
$blQ = fetch($koneksi,'bulan',['bln'=>$bulan]);
?>


                        <div class="row">
                           <div class="col-xl-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">BULAN <?= strtoupper($blQ['ket']); ?> <?= date('Y') ?></h5>
										</div>
                                    <div class="card-body">				
                                         <div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                   
                                                    <th>ROMBEL</th>
                                                    <th>L &nbsp;</th>
                                                    <th>P &nbsp;</th>
													<th>TOTAL &nbsp;</th>
													<th>WALI KELAS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											
											$no=0; 
											
											$query = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); 
											 while ($data = mysqli_fetch_array($query)) :
				                             $laki = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,kelas FROM siswa WHERE kelas='$data[kelas]' AND jk='L'"));
											$prp = mysqli_num_rows(mysqli_query($koneksi, "SELECT jk,kelas FROM siswa WHERE kelas='$data[kelas]' AND jk='P'"));
											$total = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM siswa WHERE kelas='$data[kelas]'"));
											$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE walas='$data[kelas]'"));
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['kelas'] ?></td>
                                                    <td><?= $laki; ?></td>
													<td><?= $prp; ?></td>
													<td><?= $total; ?></td>
													<td><?= $peg['nama'] ?></td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                         
                            <div class="col-xl-4">
                                <div class="card">
                                  <div class="card-body">
								 
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/absen.png" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									 
									 <form id="formabsen" method="GET" action="cetak/cetakkelas.php" target="_blank"  enctype="multipart/form-data">
                                        <div class="col-md-12 mb-2">
										<label class="bold">ROMBEL</label>                               
											<select name="kelas"  class="form-select" style="width: 100%;" required >
												<option value=''></option>
												<?php $kls = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY kelas"); ?>
												<?php while ($Q = mysqli_fetch_array($kls)) : ?>
												<option value="<?= $Q['kelas'] ?>"><?= $Q['kelas'] ?></option>
												<?php endwhile ?>
												</select>  
										<div class="col-md-12 mb-2">
										 <label class="bold">BULAN</label>
                                            <select name="bulan"  class="form-select" style="width: 100%;" required >
											<option value=''></option>
											<?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
											<?php while ($mt = mysqli_fetch_array($qt)) : ?>
											<option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
											<?php endwhile ?>
										  </select>                                              
                                            </div>
											
                                           <div class="d-grid gap-2">                                             
                                                <button type="submit"  class="btn btn-primary flex-grow-1 m-l-xxs">CETAK REKAP</button>
                                            </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>      	
					</div>
                     	