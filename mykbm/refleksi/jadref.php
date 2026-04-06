<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">REFLEKSI SISWA</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
													<th>KELAS</th>
                                                    <th>MAPEL</th>	
													<th>TGL REFLEKSI</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_refleksi");
											elseif($user['level']=='guru'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_refleksi where idguru='$user[id_user]'");
											endif;	
											  while ($data = mysqli_fetch_array($query)) :
											 
											  $mapelx = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
											  $guru = fetch($koneksi,'users',['id_user'=>$data['idguru']]);
											
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                                <td><h5><span class="badge badge-primary"> <?= $data['kelas'] ?></span></h5></td>
												<td><?= $mapelx['kode'] ?><br><span class="badge badge-secondary"><?= $guru['nama'] ?></span> <span class="badge badge-info"><?= $kuri['nama_kurikulum'] ?></span></td>
												<td><?= $data['tanggal'] ?></td>
												<td>
												 <a href="?pg=<?= enkripsi('hasil') ?>&id=<?= $data['id'] ?>"  class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Hasil Refleksi"><i class="material-icons">download</i> </a>				
												 <a href="?pg=<?= enkripsi('jaref') ?>&id=<?= $data['id'] ?>"  class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Jawaban Siswa"><i class="material-icons">visibility</i> </a>				
                                                  <a href="?pg=<?= enkripsi('inref') ?>&id=<?= $data['id'] ?>"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Refleksi"><i class="material-icons">add</i> </a>												
												<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
												</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'refleksi/tref.php?pg=hapusjadwal',
												method: "POST",
												data: 'id=' + id,
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
												},
												success: function(data) {
													 
													setTimeout(function() {
														window.location.reload();
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    
									
									
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
									<form id='formguru' >	
									
										<div class="col-md-12 mb-1">
									  <label class="bold">MATA PELAJARAN</label>
                                        <select name='mapel' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM mapel"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
                                                    <option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">KELAS</label>
                                        <select name='kelas' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Kelas</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT kelas FROM kelas GROUP BY kelas"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
										 <label class="bold">GURU PENGAMPU</label>
									  <div class="col-md-12 mb-1">
                                        <select name='guru' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Guru</option>
                                                <?php 
												if($user['level']=='admin'):
												$usr = mysqli_query($koneksi, "SELECT * FROM users where level='guru'"); 
												elseif($user['level']=='guru'):
												$usr = mysqli_query($koneksi, "SELECT * FROM users where level='guru' and id_user='$user[id_user]'"); 
												endif;	
												?>
                                                <?php while ($guru = mysqli_fetch_array($usr)) : ?>
                                                    <option value="<?= $guru['id_user'] ?>"><?= $guru['nama'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
										<div class="col-md-12 mb-1">
									   <label class="bold">TGL REFLEKSI</label>
                                       <input  type="text" name='tgl' class='form-control datepicker'  autocomplete="off" required="true" />
                                        </div>										
										                                    
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'refleksi/tref.php?pg=jadwal',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								
									},
									success: function(data){   		
									setTimeout(function()
										{
										window.location.reload();
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
                        
             
				 <?php endif ?>
					 
							
                                 