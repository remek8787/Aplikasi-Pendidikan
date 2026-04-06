<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$hari = date('D');
?>           
	<?php if ($ac == '') : ?>
	
	<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">CETAK KATROL NILAI HARIAN</h5>
										
                                    </div>
                                    <div class="card-body">
									<div class="alert alert-custom" role="alert">
									<strong>Perhatian ! </strong><br>
										<span>Data Penilaian Harian akan muncul jika Hari sesuai Jadwal Mengajar</span>
									</div>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th>NO</th>
                                                  <th>HARI</th>													  
												  <th>KELAS</th>													                                                 
                                                  <th>MATA PELAJARAN</th>
												  <th>GURU PENGAMPU</th>
												  <th>PH - KATR</th>
												  <th></th>
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											
											$bulan = date('m');
											$tahun = date('Y');
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari'");
											 elseif($user['level']=='guru'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari' and guru='$user[id_pegawai]'");
											 endif;
											  while ($data = mysqli_fetch_array($query)) :
											  $harix = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);
											  $mapelx = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											  $guru = fetch($koneksi,'pegawai',['id_pegawai'=>$data['guru']]);
											  $kuri = fetch($koneksi,'m_kurikulum',['idk'=>$data['kuri']]);
											  $jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM siswa where kelas='$data[kelas]'"));
											  $jumdes = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$data[kelas]' and mapel='$data[mapel]' and guru='$data[guru]' and semester='$setting[semester]'"));
											  $jumkat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$data[kelas]' and mapel='$data[mapel]' and guru='$data[guru]' and semester='$setting[semester]' and katrol<>''"));
											$no++;
											   ?>
											   <tr>
                                                 <td><?= $no; ?></td>
												 <td><?= $harix['hari'] ?></td>
                                                   <td><h5><span class="badge badge-dark"><?= $data['tingkat'] ?></span> <span class="badge badge-primary"> <?= $data['kelas'] ?></span></h5></td>
													<td><?= $mapelx['nama_mapel'] ?> <span class="badge badge-secondary"><?= $kuri['nama_kurikulum'] ?></span></td>
													<td><?= $guru['nama'] ?></td>
													<td><h5><span class="badge badge-success"><?= ($jumdes/$jsiswa); ?> X</span> <span class="badge badge-warning"><?= ($jumkat/$jsiswa); ?> X</span></h5></td>
													<td>
													<?php if($jumkat<>0): ?>
													<a href="cetak/ctnilai2.php?j=<?= enkripsi($data['id_jadwal']) ?>"  class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PH"><i class="material-icons">print</i> </a>
													<?php else : ?>
													<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
													<?php endif; ?>
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
				
					  <?php endif ?>
					