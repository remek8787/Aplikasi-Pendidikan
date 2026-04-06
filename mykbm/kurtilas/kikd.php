<?php
defined('APK') or exit('No Access');

?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">INPUT RPP K-13</h5>
							</div>
                            <div class="card-body">
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th> 
										<th>SMT-MAPEL</th>
										<th>KD-3</th>
										<th>KD-4</th>										                                      													
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td>
										<span class="badge bg-primary"><?= $data['smt'] ?></span>
										<span class="badge bg-success"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										
										<td>3.<?= $data['kd'] ?> <?= $data['des3'] ?></td>
										<td>4.<?= $data['kd'] ?> <?= $data['des4'] ?></td>
										<td>										
										<a href="?pg=<?= enkripsi('kikd') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>
										<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
										</td>
                                       </tr>
										<?php endwhile; ?>
                                       </tbody>
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
											   url: 'kurtilas/trpp.php?pg=hapus',
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
				              <?php 
							   if (empty($_GET['m'])) {
									$mapel = "";
							   }else{
								   $mapel = $_GET['m'];
							   }
							 if (empty($_GET['s'])) {
									$smt = "";
							   }else{
								   $smt = $_GET['s'];
							   }
							   if (empty($_GET['g'])) {
									$guru = "";
							   }else{
								   $guru = $_GET['g'];
							   }
							   if (empty($_GET['l'])) {
									$level = "";
							   }else{
								   $level = $_GET['l'];
							   }
							   $peg = fetch($koneksi,'users',['id_user'=>$guru]);
							   $plj = fetch($koneksi,'mapel',['id'=>$mapel]);
							   $jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM rpp where smt='$smt' and mapel='$mapel' and guru='$guru' and level='$level'"));
							   $kd = $jml + 1;
							   ?>
				
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
									<form id='formcp'>
									<input type="hidden" name="kd" value="<?= $kd; ?>">
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  id="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $smt ?>"><?= $smt ?></option>
									   <option value="1">1</option>
									   <option value="2">2</option>
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $guru ?>"><?= $peg['nama'] ?></option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT * FROM users where level='guru'");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT * FROM users WHERE  id_user='$id_user'");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											
											<option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Tingkat</label>
											<select name="level" id="level" class='form-select' style='width:100%' required="true" >                           
											<option value="<?= $level ?>"><?= $level ?></option>
											<?php 
											$que=mysqli_query($koneksi,"SELECT level,kuri FROM kelas WHERE kuri='1' GROUP BY level");
											while ($lev=mysqli_fetch_array($que)) { ?>										
											<option value="<?= $lev['level'] ?>"><?= $lev['level'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                           
										<option value="<?= $mapel ?>"><?= $plj['nama_mapel'] ?></option>
										<?php 
											$query=mysqli_query($koneksi,"SELECT * FROM mapel");
											while ($pel=mysqli_fetch_array($query)) { ?>										
											<option value="<?= $pel['id'] ?>"><?= $pel['nama_mapel'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										
										<script type="text/javascript">
										 $('#mapel').change(function() {
										var m = $('#mapel').val();
										var s = $('#smt').val();
										var g = $('#guru').val();
										var l = $('#level').val();
										location.replace("?pg=<?= enkripsi('kikd') ?>&m=" + m + "&s=" + s + "&g=" + g + "&l=" + l);
										  }); 
									   </script>
										
										<div class="col-md-12 mb-1">
											<label class="bold">Materi Pokok</label>
											<textarea name="materi" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Sub Materi</label>
											<textarea name="sisipan" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
										<div class="col-md-12 mb-1">
											<label class="bold">KD 3.<?= $kd ?></label>
											<textarea name="kd3" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">KD 4.<?= $kd ?></label>
											<textarea name="kd4" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Alokasi Waktu (JP)</label>
											<input type="number" name="alokasi" class="form-control" required="true">
											</div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
					
					
                 <script>
						$('#formcp').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'kurtilas/trpp.php?pg=tambah',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace("?pg=<?= enkripsi('kikd') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
	       
             <?php elseif ($ac == enkripsi('edit')): ?>
			
					<?php
					$id = $_GET['id'];
					$dt = fetch($koneksi,'rpp',['id'=>$id]);
					$pel = fetch($koneksi,'mapel',['id'=>$dt['mapel']]);
					$guru = fetch($koneksi,'users',['id_user'=>$dt['guru']]);
					?>					 
                     
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
									<form id='formedit'>
									<input type="hidden" name="id" value="<?= $id; ?>" >
		
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  id="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $dt['smt'] ?>"><?= $dt['smt'] ?></option>
									   <option value="1">1</option>
									   <option value="2">2</option>
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $dt['guru'] ?>"><?= $guru['nama'] ?></option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT * FROM users where level='guru'");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT * FROM users WHERE  id_user='$id_user'");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											
											<option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Tingkat</label>
											<select name="level" id="level" class='form-select' style='width:100%' required="true" >                           
											<option value="<?= $dt['level'] ?>"><?= $dt['level'] ?></option>
											<?php 
											$que=mysqli_query($koneksi,"SELECT level,kuri FROM kelas WHERE kuri='1' GROUP BY level");
											while ($lev=mysqli_fetch_array($que)) { ?>										
											<option value="<?= $lev['level'] ?>"><?= $lev['level'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                           
										<option value="<?= $dt['mapel'] ?>"><?= $pel['nama_mapel'] ?></option>
										<?php 
											$query=mysqli_query($koneksi,"SELECT * FROM mapel");
											while ($pel=mysqli_fetch_array($query)) { ?>										
											<option value="<?= $dt['mapel'] ?>"><?= $pel['nama_mapel'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										
										
										
										<div class="col-md-12 mb-1">
											<label class="bold">Materi Pokok</label>
											<textarea name="materi" class="form-control" rows="2" required="true" maxlength="200" ><?= $dt['materi'] ?></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Sub Materi</label>
											<textarea name="sisipan" class="form-control" rows="2" required="true" maxlength="200" ><?= $dt['sisipan'] ?></textarea>							   
									   </div>
										<div class="col-md-12 mb-1">
											<label class="bold">KD 3.<?= $dt['kd'] ?></label>
											<textarea name="kd3" class="form-control" rows="2" required="true" maxlength="200" ><?= $dt['des3'] ?></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">KD 4.<?= $dt['kd'] ?></label>
											<textarea name="kd4" class="form-control" rows="2" required="true" maxlength="200" ><?= $dt['des4'] ?></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Alokasi Waktu (JP)</label>
											<input type="number" name="alokasi" class="form-control" value="<?= $dt['alokasi'] ?>" required="true">
											</div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						<script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'kurtilas/trpp.php?pg=edit',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace("?pg=<?= enkripsi('kikd') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
							
			
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					