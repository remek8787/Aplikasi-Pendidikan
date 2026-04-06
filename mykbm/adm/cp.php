<?php
defined('APK') or exit('No Access');
$bulan = date('m');
$hari = date('D');
?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">INPUT CP (FASE)</h5>
							</div>
                            <div class="card-body">
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th>  	
										<th>KETERANGAN</th>
										<th>CAPAAIAN PEMBELAJARAN</th>										                                      													
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM cp"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM cp WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td>
										<span class="badge bg-primary"><?= $data['tingkat'] ?></span>
										<span class="badge bg-success"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										
										<td><?= $data['capaian'] ?></td>
										
										<td>										
										<a href="?pg=<?= enkripsi('cp') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>
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
											   url: 'adm/tcp.php?pg=hapus',
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
									<form id='formcp'>
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="">Pilih Semester</option>
									   <option value="1">1</option>
									   <option value="2">2</option>
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar  GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE  guru='$id_user' GROUP BY guru");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<?php $peg=fetch($koneksi,'users',['id_user' => $data['guru']]); ?>
											<option value="<?= $data['guru'] ?>"><?= $peg['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Tingkat</label>
											<select name="level" id="level" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Capaian Pembelajaran</label>
											<textarea name="cp" class="form-control" rows="3" required="true" maxlength="200" ></textarea>							   
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
									 </div>
					            </div>
								</div>
							</div>
					<script>
					$("#guru").change(function() {
						var guru = $(this).val();						
						console.log(guru);
						$.ajax({
							type: "POST",
							url: "agenda/tagenda.php?pg=level", 
							data: "guru=" + guru, 
							success: function(response) { 
							$("#level").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#level").change(function() {
						var level = $(this).val();
						var guru = $("#guru").val();							
						console.log(level + guru);
						$.ajax({
							type: "POST",
							url: "agenda/tagenda.php?pg=mapelguru", 
							data: "level=" + level + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
                 <script>
						$('#formcp').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'adm/tcp.php?pg=tambah',
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
											window.location.reload();
										}, 2000);
									}
								})
								return false;
							});
							</script>
	       
             <?php elseif ($ac == enkripsi('edit')): ?>
			
					<?php
					$id = $_GET['id'];
					$agd = fetch($koneksi,'cp',['id'=>$id]);
					$mapel = fetch($koneksi,'mapel',['id'=>$agd['mapel']]);
					$guru = fetch($koneksi,'users',['id_user'=>$agd['guru']]);
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
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $agd['guru'] ?>"><?= $guru['nama'] ?></option>  			                                           
											</select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Tingkat</label>
											<select name="level" id="level" class='form-select' style='width:100%' required="true" >                                         													                                           
											<option value="<?= $agd['tingkat'] ?>"><?= $agd['tingkat'] ?></option>
											</select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                                         													                                           
											<option value="<?= $agd['mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
											</select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Materi Belajar</label>
											<textarea name="cp" class="form-control" rows="8" required="true" maxlength="200" ><?= $agd['capaian'] ?></textarea>							   
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
									 url: 'adm/tcp.php?pg=edit',
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
											window.location.replace("?pg=<?= enkripsi('cp') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
							
			
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					