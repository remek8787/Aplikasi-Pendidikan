<?php
defined('APK') or exit('No Access');
?>           
	<?php if ($ac == '') : ?>
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">INPUT ATP</h5>
							</div>
                            <div class="card-body">
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th>  	
										<th>MATERI</th>
										<th>SUB MATERI</th>
										<th>RINGKASAN</th>
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM tp"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM tp WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$atp = fetch($koneksi,'konten',['idtp'=>$data['id_tp']]);
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td><?= $data['lingkup'] ?><br>
										<span class="badge bg-primary"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										 <td><?= $atp['sub'] ?></td>
										 <td><?= $atp['ringkasan'] ?></td>
										<td>										
										<a href="?pg=<?= enkripsi('konten') ?>&idtp=<?= $data['id_tp'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Konten"><i class="material-icons">edit</i> </a>
										<button data-id="<?= $atp['id_konten'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
										</td>
                                       </tr>
										<?php endwhile; ?>
                                       </tbody>
                                    </table>	
								</div>
							</div>
						</div>
					</div>	
							
				
				<?php
					if (empty($_GET['idtp'])) {
						$idtp = "";
					} else {
						$idtp = $_GET['idtp'];
					}
					$datax = fetch($koneksi,'tp',['id_tp'=>$idtp]);
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
									  <?php if($idtp<>''): ?>
									<form id='formcpel'>
										<input type="hidden" name="idtp" value="<?= $idtp; ?>" >
										<input type="hidden" name="idcp" value="<?= $datax['idcp'] ?>" >
										<input type="hidden" name="idel" value="<?= $datax['idelemen'] ?>" >
										<input type="hidden" name="guru" value="<?= $datax['guru'] ?>" >
										<input type="hidden" name="mapel" value="<?= $datax['mapel'] ?>" >
										<input type="hidden" name="tingkat" value="<?= $datax['tingkat'] ?>" >
										<div class="col-md-12 mb-1">
											<label class="bold">Sub Materi</label>
											<textarea name="sub" class="form-control" rows="2" required="true"  ></textarea>								   
									   </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Ringkasan Materi</label>
											<textarea name="ringkasan" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Gambaran Kegiatan</label>
											<textarea name="gambaran" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Media Pembelajaran</label>
											<textarea name="media" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div class="col-md-12 mb-1">
											<label class="bold">Sumber Materi</label>
											<textarea name="sumber" class="form-control" rows="2" required="true" maxlength="200" ></textarea>							   
									   </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
										<?php else: ?>
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
										<?php endif; ?>
									 </div>
					            </div>
								</div>
							</div>
					
						<script>
						$('#formcpel').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'adm/tkonten.php?pg=tambah',
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
											window.location.replace("?pg=<?= enkripsi('konten') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
	       
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
											   url: 'adm/tkonten.php?pg=hapus',
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
	       
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					