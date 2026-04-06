<?php
defined('APK') or exit('No Access');
$hari = date('D');
?>           
	<?php if ($ac == '') : ?>
	<?php
    if (empty($_GET['k'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['k'];
    }
      $jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas' and t_lahir<>''")); 
	?>
                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="bold">
										<?php if($semester=='1'): ?>
										CETAK RAPOR PAS
										<?php else: ?>
										CETAK RAPOR PAT
										<?php endif; ?>
										</h5>	
                                   <?php if($kelas<>''): ?>
						<?php if($jsiswa==0): ?>
						
						<form id='formupdate'>
						<div class="row">
						<div class='col-md-6'>
						<input type="file" name="file" class="form-control" >
							</div>
								<div class='col-md-6'>
								<button type='submit' name='submit1' class='btn btn-primary' >UPLOAD</button>	
								<a href="cetak/proses.php?kls=<?= $kelas ?>"> <button class="btn btn-success" type="button">UPDATE</button></a>				
								</div>
								</div>
							</form>
							<?php else: ?>
							<div class='col-md-12' id="datata">
							<button data-id="<?= $kelas ?>"  class="hapus btn btn-sm btn-danger kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> RESET</button>
							</div>
							<?php endif; ?>
							<?php endif; ?>										
                                    </div>
                                <div class="card-body">
								<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th width="5%">NO</th>												  
												  <th>N I S</th>
												  <th>NAMA SISWA</th>
                                                  <th>
												 
												  </th>				 
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$kelas'");
											while ($data = mysqli_fetch_array($query)) :
											$k = fetch($koneksi,'kelas',['kelas'=>$data['kelas']]);
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                 <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
													<td><?= $data['nama'] ?></td>
													<td>
													<?php if($data['t_lahir']<>''): ?>
														<a href="cetak/print_cover.php?ids=<?= $data['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-primary"><i class="material-icons">print</i></a>				
													<?php if($k['kuri']=='1'): ?>
													<a href="cetak/print_rapor_k13.php?ids=<?= $data['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-warning"><i class="material-icons">print</i></a>				
													<?php else: ?>
													<a href="cetak/rapor_merdeka.php?ids=<?= $data['id_siswa'] ?>" target="_blank" class="btn btn-sm btn-warning"><i class="material-icons">print</i></a>				
													<?php endif; ?>
													<?php else: ?>
													<button class="btn btn-sm  btn-light mb-1" type="button" disabled> <i class="material-icons">lock</i></button>			
													<button class="btn btn-sm  btn-light mb-1" type="button" disabled> <i class="material-icons">lock</i></button>			
													
													<?php endif; ?>
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
									
									<?php if($kelasmu==''): ?>
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $semester ?>"><?= $semester ?></option>
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select kelas' style='width:100%' required="true" >                                         
											<option value="">Pilih Kelas</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT * FROM kelas");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT * FROM kelas WHERE  kelas='$user[walas]'");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<option value="<?= $data['kelas'] ?>"><?= $data['kelas'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">Pilih Kelas</button>
                             
											</div>
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
										<script type="text/javascript">
										$('#pilih').click(function() {
										var k = $('.kelas').val();
										location.replace("?pg=<?= enkripsi('rapor') ?>&k=" + k);
										}); 
									</script>
									 </div>
					            </div>
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
							url: "nilai/ambildata.php?pg=kelas", 
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
							url: "nilai/ambildata.php?pg=mapel", 
							data: "kelas=" + kelas + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
				 <script>
						$('#formnilai').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'nilai/input.php',
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
							
						<script>
						$('#formcopy').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'nilai/copy.php',
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
							
				<script>
							$('#formupdate').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'cetak/import_siswa.php',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
									
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
									$('#datata').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'RESET',
											  text: "Upload Ulang Data Update",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Reset!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'nilai/treset.php',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
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
					  
					  
					  
					  	  
					  
					  
					