<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$tanggal = date('Y-m-d');
$bulan = date('m');
$tahun = date('Y');
$jabsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where tanggal='$tanggal' and level ='siswa'"));
$jagenda = mysqli_num_rows(mysqli_query($koneksi, "SELECT bulan,tahun FROM agenda where bulan='$bulan' and tahun='$tahun'"));
$jjurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT bulan,tahun,hambatan FROM agenda where hambatan<>'' and bulan='$bulan' and tahun='$tahun'"));
$jnil = mysqli_num_rows(mysqli_query($koneksi, "SELECT nilai FROM nilai_harian"));

?>

                       <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">JADWAL KBM HARI INI</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>                                               
                                                    <th>HARI</th>
													<th>KELAS</th>
                                                    <th>MATA PELAJARAN</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no = 0;
											$hari = date('D');
											 if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari'");
											elseif($user['level']=='guru'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari' and guru='$user[id_user]'");
											 endif;
											  while ($data = mysqli_fetch_array($query)) :
											  $harix = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);
											  $mapelx = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											  $guru = fetch($koneksi,'users',['id_user'=>$data['guru']]);
								
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $harix['hari'] ?><br><?= $data['dari'] ?> - <?= $data['sampai'] ?></td>
                                                     <td><h5><span class="badge badge-primary"> <?= $data['kelas'] ?></span></h5></td>
													  <td><?= $mapelx['nama_mapel'] ?><br><span class="badge badge-secondary"><?= $guru['nama'] ?></span> <span class="badge badge-info"><?= $kuri['nama_kurikulum'] ?></span></td>
													 
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
                              
							
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">menu</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">AGENDA GURU</span>
                                                <span class="widget-stats-amount"><?= $jagenda; ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
							   <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">apps</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">JURNAL GURU</span>
                                                <span class="widget-stats-amount"><?= $jjurnal; ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
							   
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">NILAI HARIAN</span>
                                                <span class="widget-stats-amount"><?= $jnil; ?> </span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>	
                      </div>	
                    