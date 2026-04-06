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
													<th>PERTANYAAN</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM refleksi ORDER BY id DESC");
											elseif($user['level']=='guru'):
											$query = mysqli_query($koneksi, "SELECT * FROM refleksi where idguru='$user[id_user]' ORDER BY id DESC");
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
												<td><?= $data['soal'] ?></td>
												<td>						
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
											   url: 'refleksi/tref.php?pg=hapus',
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
									<input type="hidden" name="idj" value="<?= $ref['id'] ?>" >
										<div class="col-md-12 mb-1">
									  <label class="bold">MATA PELAJARAN</label>
                                        <select name='mapel' class='form-select' style='width:100%' required>
                                                <option value="<?= $pel['id'] ?>"><?= $pel['nama_mapel'] ?></option>
                                              
												 </select>
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">KELAS</label>
                                        <select name='kelas' class='form-select' style='width:100%' required>
                                                 <option value="<?= $ref['kelas'] ?>"><?= $ref['kelas'] ?></option>
                                              
											</select>
                                        </div>
										 <label class="bold">GURU PENGAMPU</label>
									  <div class="col-md-12 mb-1">
                                        <select name='guru' class='form-select' style='width:100%' required>
                                           <option value="<?= $ref['idguru'] ?>"><?= $peg['nama'] ?></option>
												 </select>
                                        </div>
										<div class="col-md-12 mb-1">
									   <label class="bold">PERTANYAAN</label>
                                       <textarea  name='soal' class='form-control'  required="true" /></textarea>
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
									 url: 'refleksi/tref.php?pg=tambah',
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
					 
							
                                 