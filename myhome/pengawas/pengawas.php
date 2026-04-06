					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">PENGAWAS ASSESMEN</h5>
									</div>									
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                               
										  <th>NAMA PENGAWAS</th>
										  <th>KELAS</th>
                                          <th>RUANG</th>
										  <th>SESI</th>
										 
										  <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level='awas'"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                            
											  <td><?= $data['nama'] ?></td>
                                             <td><?= $data['kelas'] ?></td>
											 <td><?= $data['ruang'] ?></td>
											 <td><?= $data['sesi'] ?></td>
											<td>
											<a href="pengawas/cetak.php?iduser=<?= $data['id_user'] ?>"> <button class='btn btn-sm btn-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Akun"><i class="material-icons">print</i></button></a>
											
											<button data-id="<?= $data['id_user'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
											</td>
                                            </tr>
										<?php endwhile; ?>
										</tbody>
                                            </table>
										  </div>
										 </div>
										</div>
									</div>
									
					
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-header">
                                    									
                                    </div>
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
									<label class="bold">Nama Lengkap</label>
									<div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' required='true' />
                                    </div>
									<label class="bold">Tingkat</label>
									<div class="input-group mb-1">
                                      <select name="tingkat" id="tingkat" class="form-select" style="width:100%" required >
									   <option value="">Pilih Tingkat</option>
									 			 <?php
										$lev = mysqli_query($koneksi, "SELECT level FROM siswa GROUP BY level");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[level]'>$level[level]</option>";
										}
										?>						 
									  </select>
                                    </div>
								    <label class="bold">Kelas</label>
									<div class="input-group mb-1">
                                      <select name="kelas" id="kelas" class="form-select" style="width:100%" required >
									  		 
									  </select>
                                    </div>
									 <label class="bold">Ruang</label>
									<div class="input-group mb-1">
                                      <select name="ruang" id="ruang" class="form-select" style="width:100%" required >
									   						 
									  </select>
                                    </div>
									 <label class="bold">Sesi</label>
									<div class="input-group mb-1">
                                      <select name="sesi" id="sesi" class="form-select" style="width:100%" required >
									   <option value="">Pilih Sesi</option>
									 									 
									  </select>
                                    </div>
								    <label class="bold">Username</label>
									<div class="input-group mb-1">
                                       <input type='text' name='username' class='form-control' required='true' />
                                     </div>
									<label class="bold">Password</label>
									<div class="input-group mb-1">
                                       <input type='text' name='password' class='form-control' required='true' />
                                     </div>
									<label class="bold">Nomor WA</label>
									<div class="input-group mb-1">
                                       <input type='number' name='nowa' class='form-control' required='true' />
                                    </div>
								    
                                    <label class="bold">Foto Jika Ada</label>
									<div class="input-group mb-3">
                                       <input type='file' name='file' class='form-control'/>
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
					$("#tingkat").change(function() {
					var tingkat = $(this).val();
					console.log(tingkat);
					$.ajax({
					type: "POST",
					url: "pengawas/tguru.php?pg=kelas", 
					data: "tingkat=" + tingkat, 
					success: function(response) { 
					$("#kelas").html(response);
							}
						});
					});
					
					$("#kelas").change(function() {
					var kelas = $(this).val();
					console.log(kelas);
					$.ajax({
					type: "POST",
					url: "pengawas/tguru.php?pg=ruang", 
					data: "kelas=" + kelas, 
					success: function(response) { 
					$("#ruang").html(response);
							}
						});
					});
					
					$("#ruang").change(function() {
					var ruang = $(this).val();
					var kelas = $("#kelas").val();
					console.log(ruang + kelas);
					$.ajax({
					type: "POST",
					url: "pengawas/tguru.php?pg=sesi", 
					data: "ruang=" + ruang + "&kelas=" + kelas, 
					success: function(response) { 
					$("#sesi").html(response);
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
								 url: 'pengawas/tguru.php?pg=tambah',
								data: data,
								cache: false,
								contentType: false,
								processData: false,
								beforeSend: function() {
								$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								$('.progress-bar').animate({
								
								}, 500);
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
											   url: 'pengawas/tguru.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												
												}, 500);
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