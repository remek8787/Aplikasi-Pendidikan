<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>      
     	<?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">DATA KONSUMEN</h5>										
									</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NIP</th>
                                                    <th>NAMA KONSUMEN</th>
                                                    <th>JABATAN</th>                                                  
													 <th>PAYMENT CARD</th>
													 <th>SALDO</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users where nokartu<>''"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nip'] ?></td>
                                                  <td><?= $data['nama'] ?></td>
                                                  <td><?= $data['jabatan'] ?></td>                                  
												  <td><?= $data['nokartu'] ?></td>
												  <td><?= number_format($data['saldo']) ?></td>
												<td>
												<a href="?pg=<?= enkripsi('pegawai') ?>&ac=<?= enkripsi('lihat') ?>&ids=<?= $data['id_user'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail"><i class="material-icons">visibility</i></button></a>
												</td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
		                          </div>
			 <?php elseif($ac == enkripsi('lihat')): ?>
			<?php
			$ids = $_GET['ids'];
			$peg = fetch($koneksi,'users',['id_user'=>$ids]);			
			?>
			           <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= $peg['nama'] ?></h5>										
									</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                      <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                       <thead>
                                        <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>JAM</th>
                                        <th>DEBET</th>                                                  
										<th>KREDIT</th>
										<th>KET</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM saldo where idpeg='$ids'"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= date('d-m-Y',strtotime($data['tanggal'])) ?></td>
                                                  <td><?= $data['jam'] ?></td>
                                                  <td style="text-align:right"><?= number_format($data['debet']) ?></td>                                 
												  <td style="text-align:right"><?= number_format($data['kredit']) ?></td>
												<td><?= $data['ket'] ?></td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
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
												<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
												</div>
											<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
												  <div class="text-muted">HIGH SCHOOL</div>
												</div>											 
											<div class="d-flex justify-content-between mb-2">
												<div class="text-center">
												  <p class="text-small text-muted mb-1">NPSN</p>
												  <p><?= $setting['npsn'] ?></p>
												</div>
												<div class="text-center">
												  <p class="text-small text-muted mb-1">SMT</p>
												  <p><?= $setting['semester'] ?></p>
												</div>
												<div class="text-center">
												  <p class="text-small text-muted mb-1">TP</p>
												  <p><?= $setting['tp'] ?></p>
												</div>                    
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">ALAMAT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">home</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['alamat'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">star</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['desa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">sync</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">CONTACT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">phone</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nowa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">inbox</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['email'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">language</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['server'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													 <i class="material-icons text-info" style="font-size:18px">person</i>
													</div>
												  </div>
												  <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">payment</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nip'] ?></div>
												</div>
											  </div>
											</div>
										  </div>             
										</div>					
									</div>
							
			
			   <?php endif; ?>		 