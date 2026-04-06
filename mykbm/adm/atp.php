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
										<th>ELEMEN</th>
										<th>WAKTU</th>
										<th>PROFIL PELAJAR</th>
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM cp_elemen"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM cp_elemen WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$atp = fetch($koneksi,'atp',['idel'=>$data['id_elemen']]);
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td><?= $data['elemen'] ?><br>
										<span class="badge bg-primary"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										 <td>
										 <?php if($atp['waktu']<>''): ?>
										 <?= $atp['waktu'] ?> JP
										 <?php endif; ?>
										 </td>
										 <td><?= $atp['p5'] ?></td>
										<td>										
										<a href="?pg=<?= enkripsi('atp') ?>&idel=<?= $data['id_elemen'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah ATP"><i class="material-icons">edit</i> </a>
										<button data-id="<?= $atp['id_atp'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
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
					if (empty($_GET['idel'])) {
						$idel = "";
					} else {
						$idel = $_GET['idel'];
					}
					
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
									  <?php if($idel<>''): ?>
									<form id='formcpel'>
										<input type="hidden" name="idel" value="<?= $idel; ?>" >
										<div class="col-md-12 mb-1">
											<label class="bold">Alokasi Waktu (JP)</label>
											<input type="number" name="waktu" class="form-control" required="true" >						   
									   </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Profil Pelajar Pancasila</label>
											<textarea name="p5" class="form-control" rows="3" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div id="count" style="color:blue;">
											<span id="current_count">0</span>
											<span id="maximum_count">/ 200</span>
										</div>
										<script type="text/javascript">
										$('textarea').keyup(function() {    
										var characterCount = $(this).val().length,
										current_count = $('#current_count'),
										maximum_count = $('#maximum_count'),
										count = $('#count');    
										current_count.text(characterCount);        
										});
										</script>
										
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
									 url: 'adm/tatp.php?pg=tambah',
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
											window.location.replace("?pg=<?= enkripsi('atp') ?>");
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
											   url: 'adm/tatp.php?pg=hapus',
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
					  
					  
					  
					  	  
					  
					  
					