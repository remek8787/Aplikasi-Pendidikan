<?php
defined('APK') or exit('No Access');
$ref = fetch($koneksi,'jadwal_refleksi',['id'=>$_GET['id']]);
$pel = fetch($koneksi,'mapel',['id'=>$ref['idmapel']]);
$peg = fetch($koneksi,'users',['id_user'=>$ref['idguru']]);
?>     
							
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">HASIL REFLEKSI</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
													<th>KETERANGAN</th>
													<th>JML</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$ref[kelas]'"));
											 $nilA = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_refleksi where mapel='$ref[idmapel]' and tanggal='$ref[tanggal]' and nilai='A'"));
											  $nilB = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_refleksi where mapel='$ref[idmapel]' and tanggal='$ref[tanggal]' and nilai='B'"));
											  $nilC = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_refleksi where mapel='$ref[idmapel]' and tanggal='$ref[tanggal]' and nilai='C'"));
											  $nilD = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_refleksi where mapel='$ref[idmapel]' and tanggal='$ref[tanggal]' and nilai='D'"));
											  
											  ?>
                                                <tr>
                                                <td>1</td>
                                                <td>Sangat Memahami Materi</td>
												<td><?= $nilA ?></td>
                                                </tr>
												 <tr>
                                                <td>2</td>
                                                <td>Memahami Materi</td>
												<td><?= $nilB ?></td>
                                                </tr>
												 <tr>
                                                <td>3</td>
                                                <td>Cukup Memahami Materi</td>
												<td><?= $nilC ?></td>
                                                </tr>
												 <tr>
                                                <td>4</td>
                                                <td>Kurang Memahami Materi</td>
												<td><?= $nilD ?></td>
                                                </tr>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
									
									
									 <?php if ($ac == '') : ?>
					       <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">TANGGAL</label>
                                        <select name='tgl' id='tgl' class='form-select' style='width:100%' required>
                                           <option value="<?= $ref['tanggal'] ?>"><?= $ref['tanggal'] ?></option>
											</select>
                                        </div>
										        
										<div class="col-md-12 mb-1">
									  <label class="bold">MATA PELAJARAN</label>
                                        <select name='mapel' id='mapel' class='form-select' style='width:100%' required>
                                              <option value="<?= $ref['idmapel'] ?>"><?= $pel['nama_mapel'] ?></option>
												 </select>
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">KELAS</label>
                                        <select name='kelas' id="kelas" class='form-select' style='width:100%' required>
                                             <option value="<?= $ref['kelas'] ?>"><?= $ref['kelas'] ?></option>
											</select>
                                        </div>
										
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				 <?php endif ?>
					 
							
                                 