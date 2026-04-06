<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>           
		
			<div class="row">
                   <div class="col-xl-12 mb-6" >
				  <h5 class="bold">STATUS PESERTA</h5>
				   <div class="card">
				   <div class="card-body">
					<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-hover" style="width:100%">
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
                                                    <td><h5><span class="badge bg-dark"> <?= $jadwal['kode_nama'] ?></span></h5></td>
													<td>
													<h5><span class="badge bg-primary"> <?= $jadwal['kode_ujian'] ?> &nbsp;<?= $jadwal['level'] ?></span> <span class="badge bg-primary"><?= $jadwal['pk'] ?></span></h5>
													</td>
                                                    <td><?= $jadwal['tgl_ujian'] ?></br>
                                                          <?= $jadwal['tgl_selesai'] ?>
													</td>				
                                                    <td >
													<?php
													if ($jadwal['status'] == 1) { ?>
													<button type="button" class="btn btn-sm btn-success">
														Ujian Aktif <span class="badge bg-dark"><?= $jadwal['sesi'] ?></span>
												 </button>
													<?php  } elseif ($jadwal['status'] == 0) { ?>
												   <button type="button" class="btn btn-sm btn-danger">
														Non Aktif <span class="badge bg-light m-l-xxs"><?= $jadwal['sesi'] ?></span>
													</button>
													<?php  } ?>
												      </td>
													  <td><?= $jadwal['lama_ujian'] ?> menit</td>
													<td>
													  <?php if ($jadwal['tgl_ujian'] > date('Y-m-d H:i:s') and $jadwal['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
														 <div class="spinner-border text-warning" role="status"></div> Belum
												   <?php } elseif ($jadwal['tgl_ujian'] < date('Y-m-d H:i:s') and $jadwal['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
													   <div class="spinner-border text-success" role="status"></div> Mulai
												   <?php } else { ?>
													 <div class="spinner-border text-danger" role="status"></div> Habis
												   <?php } ?>
															
														</td>
														<td>
														<a href="?pg=<?= enkripsi('stawas_ujian') ?>&id=<?= $jadwal['id_ujian'] ?>"class="btn sm btn-icon btn-icon-only btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Status Peserta"><i class="material-icons">search</i></a>
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
		 