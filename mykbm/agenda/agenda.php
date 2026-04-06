<?php
defined('APK') or exit('No Access');
$bulan = date('m');
$hari = date('D');
?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">AGENDA DAN JURNAL GURU BULAN <?= strtoupper(bulan_indo($tanggal)) ?></h5>
							</div>
                            <div class="card-body">
							 
								<strong>Perhatian ! </strong><br>
								<span>Agenda Guru dapat diisi jika Hari sesuai Jadwal Mengajar</span>
								<p></p>
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th>  	
										<th>TANGGAL</th>
										<th>KELAS</th>
										<th>MAPEL</th>										
                                        <th>KET</th>													
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM agenda ORDER BY id DESC"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM agenda WHERE guru='$id_user' ORDER BY id DESC"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td><?= $data['tanggal'] ?></td>
										<td><?= $data['kelas'] ?> </td>
										<td>
										<span class="badge bg-primary"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										<td>
										<?php if($data['hadir'] >= 50): ?>
										<h5><span class="badge bg-success">Tercapai</span></h5>
										<?php else: ?>
										<span class="badge bg-danger">Tidak Tercapai</span>
										<?php endif; ?>
										</td>
										<td>
										<?php if($data['hadir'] < 50 and $data['pemecahan']==''): ?>
										<a href="?pg=<?= enkripsi('agenda') ?>&ac=<?= enkripsi('jurnal') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat Jurnal"><i class="material-icons">add</i> </a>
										<?php else: ?>
										<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
										<?php endif; ?>
										<?php if($data['pemecahan']==''): ?>
										<a href="?pg=<?= enkripsi('agenda') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>
										<?php else: ?>
										<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
										<?php endif; ?>
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
											   url: 'agenda/tagenda.php?pg=hapus',
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
									<form id='formagenda'>
									<div class="col-md-12 mb-1">
									  <label class="bold">Tanggal</label>
                                        <input type="text" name="tgl" class="datepicker form-control" value="<?= $tanggal; ?>" required="true" autocomplete="off">
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE hari='$hari' GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE hari='$hari' and guru='$id_user' GROUP BY guru");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<?php $peg=fetch($koneksi,'users',['id_user' => $data['guru']]); ?>
											<option value="<?= $data['guru'] ?>"><?= $peg['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Materi Belajar</label>
											<textarea name="materi" class="form-control" rows="3" required="true" maxlength="200" ></textarea>							   
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
										<div class="col-md-12 mb-1">
											<label class="bold">Tujuan Pembelajaran</label>
											<textarea name="tp" class="form-control textarea" rows="3" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div id="count2" style="color:red;">
											<span id="current_count2">0</span>
											<span id="maximum_count2">/ 200</span>
										</div>
										<script type="text/javascript">
										$('.textarea').keyup(function() {    
										var characterCount2 = $(this).val().length,
										current_count2 = $('#current_count2'),
										maximum_count2 = $('#maximum_count2'),
										count2 = $('#count2');    
										current_count2.text(characterCount2);        
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
							url: "agenda/tagenda.php?pg=kelas", 
							data: "guru=" + guru, 
							success: function(response) { 
							$("#kelas").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#kelas").change(function() {
						var kelas = $(this).val();
						var guru = $("#guru").val();							
						console.log(kelas + guru);
						$.ajax({
							type: "POST",
							url: "agenda/tagenda.php?pg=mapel", 
							data: "kelas=" + kelas + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
                 <script>
						$('#formagenda').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'agenda/tagenda.php?pg=tambah',
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
					$agd = fetch($koneksi,'agenda',['id'=>$id]);
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
									  <label class="bold">Tanggal</label>
                                        <input type="text" name="tgl" class="datepicker form-control" value="<?= $tanggal; ?>" required="true" autocomplete="off">
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $agd['guru'] ?>"><?= $guru['nama'] ?></option>  			                                           
											</select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select' style='width:100%' required="true" >                                         													                                           
											<option value="<?= $agd['kelas'] ?>"><?= $agd['kelas'] ?></option>
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
											<textarea name="materi" class="form-control" rows="3" required="true" maxlength="200" ><?= $agd['materi'] ?></textarea>							   
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
										<div class="col-md-12 mb-1">
											<label class="bold">Tujuan Pembelajaran</label>
											<textarea name="tp" class="form-control textarea" rows="3" required="true" maxlength="200" ><?= $agd['tujuan'] ?></textarea>							   
									   </div>
									   <div id="count2" style="color:red;">
											<span id="current_count2">0</span>
											<span id="maximum_count2">/ 200</span>
										</div>
										<script type="text/javascript">
										$('.textarea').keyup(function() {    
										var characterCount2 = $(this).val().length,
										current_count2 = $('#current_count2'),
										maximum_count2 = $('#maximum_count2'),
										count2 = $('#count2');    
										current_count2.text(characterCount2);        
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
									 url: 'agenda/tagenda.php?pg=edit',
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
											window.location.replace("?pg=<?= enkripsi('agenda') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
							
			<?php elseif ($ac == enkripsi('jurnal')): ?>
			
					<?php $id = $_GET['id']; ?>					                      
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
									<form id='formjurnal'>
									<input type="hidden" name="id" value="<?= $id; ?>" >								
										<div class="col-md-12 mb-1">
											<label class="bold">Hambatan</label>
											<textarea name="hambat" class="form-control" rows="3" required="true" maxlength="200" ></textarea>							   
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
										<div class="col-md-12 mb-1">
											<label class="bold">Pemecahan</label>
											<textarea name="pecah" class="form-control textarea" rows="3" required="true" maxlength="200" ></textarea>							   
									   </div>
									   <div id="count2" style="color:red;">
											<span id="current_count2">0</span>
											<span id="maximum_count2">/ 200</span>
										</div>
										<script type="text/javascript">
										$('.textarea').keyup(function() {    
										var characterCount2 = $(this).val().length,
										current_count2 = $('#current_count2'),
										maximum_count2 = $('#maximum_count2'),
										count2 = $('#count2');    
										current_count2.text(characterCount2);        
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
						$('#formjurnal').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'agenda/tagenda.php?pg=jurnal',
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
											window.location.replace("?pg=<?= enkripsi('agenda') ?>");
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					