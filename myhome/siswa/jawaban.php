<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>           
			<?php if ($ac == '') : ?>
			
					<div class="row">
                          <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">CEK JAWABAN PESERTA</h5>
									</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                 <th width="5%">#</th>
												<th>KODE SOAL</th>
												<th>KODE UJIAN</th>			
												<th>MATA PELAJARAN</th>
												<th>LIHAT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php $jadwalQ = mysqli_query($koneksi, "SELECT * FROM ujian  ORDER BY tgl_ujian ASC, waktu_ujian ASC"); ?>
                                             <?php while ($jadwal = mysqli_fetch_array($jadwalQ)) : ?>
											  <?php
												$mapel= fetch($koneksi,'mapel',['kode'=>$jadwal['nama']]);
												$no++;
												?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><h5><span class="badge badge-secondary"> <?= $jadwal['kode_nama'] ?></span></h5></td>
													<td>
													<h5><span class="badge badge-warning"> <?= $jadwal['kode_ujian'] ?> &nbsp;<?= $jadwal['level'] ?></span></h5>
													</td>                                                 				
                                                    <td><?= $mapel['nama_mapel'] ?></td>
													<td>
														<a href="?pg=jawaban&ac=lihat&&id=<?= $jadwal['id_ujian'] ?>"class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cek Jawaban Siswa"><i class="material-icons">search</i></a>
						
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
                 <?php elseif ($ac == 'lihat') : ?>
				
					<div class="row">
                          <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">DATA JAWABAN</h5>
										
									</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>
                                                    <th>NAMA PESERTA</th>
                                                    <th width="5%">ROMBEL</th>
                                                    <th width="15%">SOAL-JAWAB</th>
                                                    
													 <th>DOWNLOAD</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
												$no=0;
											  $query = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$_GET[id]'"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['id_siswa']]);
											  $no++;
											   ?>
                                                <tr>
                                                   <td><?= $no; ?></td>
                                                   <td><?= $siswa['nama'] ?></td>
                                                   <td><?= $siswa['kelas'] ?></td>
                                                   <td><h5><span class="badge badge-primary"><?= $data['jumsoal'] ?></span> -
												   <span class="badge badge-success"><?= $data['jumjawab'] ?></span>
												   </h5>
												   </td>
												  
												  <td>
												  <a href="siswa/prosesjawab.php?idn=<?= $data['id_nilai'] ?>&ids=<?= $siswa['id_siswa'] ?>" class="btn btn-sm btn-primary" ><i class="material-icons">download</i></a>
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