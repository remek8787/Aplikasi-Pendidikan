<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">DESKRIPSI RAPOR K-2013</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                <th>NO</th>
                                                <th>MAPEL</th>	
												<th>KI / KD</th>
												<th>DESKRIPSI</th>
                                                    
												<th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM deskripsi");
											else:
											$query = mysqli_query($koneksi, "SELECT * FROM deskripsi WHERE guru='$id_user'");
											endif;
											while ($data = mysqli_fetch_array($query)) :
											$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
												<td>
												<?= $mpl['kode'] ?>
												 <span class="badge badge-primary"><?= $data['level'] ?></span>
												</td>
												<td><?= $data['ki'] ?> / <?= $data['kd'] ?></td>
												<td><?= $data['deskripsi'] ?></td>
												<td>
												<a href="?pg=<?= enkripsi('desrapor') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>
												<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
												</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									 <?php if ($ac == '') : ?>
					       <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
										 <div class="text-muted">KURIKULUM 2013</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formguru' >
										<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $semester ?>"><?= $semester ?></option>
									    </select>
                                       </div>	
									 <div class="col-md-12 mb-1">
									  <label class="bold">Tingkat</label>
                                        <select name='level' id="level" class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Tingkat</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT level,kuri FROM kelas WHERE kuri='1' GROUP BY level"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['level'] ?>"><?= $kls['level'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
										
										<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
												                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select mapel' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">KOMPETENSI INTI</label>
                                        <select name='ki' class='form-select' style='width:100%' required>
                                          <option value=''>Pilih KI</option>
                                           <option value='KI-3'>Pengetahuan</option>
											<option value='KI-4'>Keterampilan</option>
												 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">DESKRIPSI</label>
											<textarea name="deskrip" class="form-control" rows="3" required="true" maxlength="200" ></textarea>							   
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
						</div>
					
			
					 <script>
						$("#level").change(function() {
						var level = $(this).val();
						var usr = <?= $user['id_user'] ?>;
						console.log(level + usr);
						$.ajax({
						type: "POST",
						url: "deskrip/ambildata.php?pg=guru", 
						data: "level=" + level + "&usr=" + usr, 
						success: function(response) { 
						$("#guru").html(response);
								}
							});
						});									 			
							</script>	
						<script>
						$("#guru").change(function() {
						var guru = $(this).val();
						var level = $('#level').val();
						console.log(guru + level);
						$.ajax({
						type: "POST",
						url: "deskrip/ambildata.php?pg=mapel", 
						data: "level=" + level + "&guru=" + guru, 
						success: function(response) { 
						$("#mapel").html(response);
								}
							});
						});
									 			
							</script>	
							
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'deskrip/tdeskrip.php?pg=tambah',
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
											   url: 'deskrip/tdeskrip.php?pg=hapus',
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
				 <?php elseif ($ac == enkripsi('edit')): ?>
			
					<?php
					$id = $_GET['id'];
					$desp = fetch($koneksi,'deskripsi',['id'=>$id]);
					
					?>					 
							<div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
										 <div class="text-muted">KURIKULUM 2013</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formedit' >	
                                    <input type="hidden" name="id" value="<?= $id ?>" >									
										<div class="col-md-12 mb-1">
											<label class="bold">DESKRIPSI</label>
											<textarea name="deskrip" class="form-control" rows="8" required="true" maxlength="200" ><?= $desp['deskripsi'] ?></textarea>							   
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
							<script>
							$('#formedit').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'deskrip/tdeskrip.php?pg=edit',
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
										window.location.replace("?pg=<?= enkripsi('desrapor') ?>");
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
                        
			 <?php endif ?>