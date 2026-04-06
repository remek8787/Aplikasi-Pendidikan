<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$jpesL = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE jk='Laki-laki'"));
$jpesP = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE jk='Perempuan'"));

$jum = $jpesL + $jpesP;
?>           
			<?php if ($ac == '') : ?>
			
					<div class="row">
                          <div class="col-xl-12">
                                <div class="card">
                                  <div class="card card-header">  
								<h5 class="card-title">STATUS PESERTA</h5>
									</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                 <th width='5px'>#</th>
												<th>SOAL</th>
												<th>KODE - JURUSAN</th>
												<th>WAKTU</th>  
												<th>SESI</th>
												<th>LAMA</th>
												<th>STATUS</th>
												<th>PESERTA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php $jadwalQ = mysqli_query($koneksi, "SELECT * FROM ujian  ORDER BY tgl_ujian ASC, waktu_ujian ASC"); ?>
                                             <?php while ($jadwal = mysqli_fetch_array($jadwalQ)) : ?>
											  <?php
												$tgl = explode(" ", $jadwal['tgl_ujian']);
												$tgl = $tgl[0];
												$no++;
												?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><h5><span class="badge badge-secondary"> <?= $jadwal['kode_nama'] ?></span></h5></td>
													<td>
													<h5><span class="badge badge-primary"> <?= $jadwal['kode_ujian'] ?> &nbsp;<?= $jadwal['level'] ?></span> <span class="badge badge-primary"><?= $jadwal['pk'] ?></span></h5>
													</td>
                                                    <td><?= $jadwal['tgl_ujian'] ?><br>
                                                          <?= $jadwal['tgl_selesai'] ?>
													</td>				
                                                    <td style="text-align:center">
													<?php
													if ($jadwal['status'] == 1) { ?>
													<button type="button" class="btn btn-success">
														Ujian Aktif <span class="badge badge-dark m-l-xxs"><?= $jadwal['sesi'] ?></span>
												 </button>
													<?php  } elseif ($jadwal['status'] == 0) { ?>
												   <button type="button" class="btn btn-danger">
														Non Aktif <span class="badge badge-light m-l-xxs"><?= $jadwal['sesi'] ?></span>
													</button>
													<?php  } ?>
												      </td>
													  <td style="text-align:center"><?= $jadwal['lama_ujian'] ?> </td>
													<td style="text-align:center">
													  <?php if ($jadwal['tgl_ujian'] > date('Y-m-d H:i:s') and $jadwal['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
														<div class="spinner-grow text-secondary" role="status">
														<span class="visually-hidden">Loading...</span>
													  </div> <strong>BELUM MULAI</strong>
														
												   <?php } elseif ($jadwal['tgl_ujian'] < date('Y-m-d H:i:s') and $jadwal['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
													   <div class="spinner-grow text-success" role="status">
														<span class="visually-hidden">Loading...</span>
													</div> <strong>MULAI UJIAN</strong>
												   <?php } else { ?>
													<div class="spinner-grow text-danger" role="status">
														<span class="visually-hidden">Loading...</span>
													</div> <strong>WAKTU HABIS</strong>
														
												   <?php } ?>
															
														</td>
														<td>
														<a href="?pg=<?= enkripsi('status_ujian') ?>&id=<?= $jadwal['id_ujian'] ?>"class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Status Peserta"><i class="material-icons">search</i></a>
						
														</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								</div>		
		 
				</div>	

        <?php endif; ?>		 