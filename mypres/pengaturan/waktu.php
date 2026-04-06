<?php
defined('APK') or exit('No Access');

?>           
			   
					<div class="row">
                      <div class="col-md-8">
                        <div class="card">
                          <div class="card card-header">                                
							<h5 class="card-title">WAKTU PRESENSI</h5>
							</div>
                             <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>                                               
                                                    <th>HARI</th>
                                                    <th>KETERANGAN</th>
													  <th>JAM</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM waktu"); 
											while ($data = mysqli_fetch_array($query)) :
											$harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_hari  WHERE inggris='$data[hari]'"));
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $harix['hari'] ?></td>
                                                    <td>
													Masuk<br>
													Deteksi Alpha<br>
													Pulang<br>
													Batas Akhir Absen Pulang<br>
													Masuk Eskul<br>
													Pulang Eskul<br>
													Batas Akhir Absen Pulang<br>
													Piket Malam
													
													</td>
													<td>
													<?= $data['masuk'] ?><br>
													<?= date('H:i',strtotime($data['alpha'])) ?><br>
													<?= $data['pulang'] ?><br>
													<?= $data['batas_pulang'] ?><br>
													<?= $data['masuk_eskul'] ?><br>
													<?= $data['pulang_eskul'] ?><br>
													<?= $data['batas_eskul'] ?><br>
													<?= $data['piket_masuk'] ?>
													</td>
													
													<td>								
													  <a href="?pg=<?= enkripsi('waktu') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
						<?php if ($ac == '') : ?>
					
                     <div class="col-xl-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0">WAKTU PRESENSI</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formwaktu' >										 
									  <div class="col-md-12 mb-1">
									  <label class="bold">Hari</label>
                                        <select class="form-select" name="hari" required style="width: 100%">
										  <option value='' >-- Pilih Hari --</option>
										  <?php
											$lev = mysqli_query($koneksi, "SELECT * FROM m_hari");
											while ($level = mysqli_fetch_array($lev)) {
											echo "<option value='$level[inggris]'>$level[hari]</option>";
											} ?>
										</select>
                                        </div>	
										
									  <div class="col-md-12 mb-1">
									   <label class="bold">Jam Masuk</label>
                                       <input type='text' name='masuk' class='form-control jam1' required='true' autocomplete="off" />
                                        </div>
			                             
									  <div class="col-md-12 mb-1">
									  <label class="bold">Deteksi Alpha</label>
                                       <input type='text' name='alpha' class='form-control jam1' required='true' autocomplete="off" />
                                        </div>
										
									  <div class="col-md-12 mb-1">
									  <label class="bold">Jam Pulang</label>
                                       <input type='text' name='pulang' class='form-control jam1' required='true' autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Batas Akhir Absen Pulang</label>
                                       <input type='text' name='batas_pulang' class='form-control jam1' required='true' autocomplete="off" />
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">Absen Eskul dimulai(Jika Ada)</label>
                                       <input type='text' name='masuk_eskul' class='form-control jam1'  autocomplete="off" />
									   </div>
										
									  <div class="col-md-12 mb-1">
									  <label class="bold">Jam Pulang Eskul (Jika Ada)</label>
                                       <input type='text' name='pulang_eskul' class='form-control jam1'  autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Batas Akhir Absen Pulang Eskul</label>
                                       <input type='text' name='batas_eskul' class='form-control jam1'  autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Jadwal Piket Malam (Jika Ada)</label>
                                       <input type='text' name='piket_masuk' class='form-control jam1'  autocomplete="off" />
                                        
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
					<script>
    $('#formwaktu').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'pengaturan/twaktu.php?pg=tambah',
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
					 <?php elseif($ac == enkripsi('edit')): ?>	
						 <?php
						 $id = $_GET['id'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM waktu WHERE id='$id'"));	
                           $harix = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_hari  WHERE inggris='$data[hari]'"));
                           ?>
						
					 <div class="col-md-4">
                      <div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0">WAKTU PRESENSI</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formedit' >
                                     <input type="hidden" name="id" value="<?= $id; ?>" >									
									   <label class="bold">Hari</label>
									  <div class="col-md-12 mb-1">
                                        <select class="form-select" name="hari" required style="width: 100%">
										 <option value="<?= $data['hari'] ?>" ><?= $harix['hari'] ?></option>
										  <option value='' >-- Pilih Hari --</option>
										  <?php
											$lev = mysqli_query($koneksi, "SELECT * FROM m_hari");
											while ($level = mysqli_fetch_array($lev)) {
											echo "<option value='$level[inggris]'>$level[hari]</option>";
											} ?>
										</select>
                                        </div>	
										
									  <div class="col-md-12 mb-1">
									   <label class="bold">Jam Masuk</label>
                                       <input type='text' name='masuk' class='form-control jam1' value="<?= $data['masuk'] ?>" required='true' autocomplete="off" />
                                        </div>
			                            
									  <div class="col-md-12 mb-1">
									   <label class="bold">Deteksi Alpha</label>
                                       <input type='text' name='alpha' class='form-control jam1' value="<?= date('H:i',strtotime($data['alpha'])) ?>" required='true' autocomplete="off" />
                                        </div>
										
									  <div class="col-md-12 mb-1">
									  <label class="bold">Jam Pulang</label>
                                       <input type='text' name='pulang' class='form-control jam1' value="<?= $data['pulang'] ?>" required='true' autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Batas Akhir Absen Pulang</label>
                                       <input type='text' name='batas_pulang' class='form-control jam1' value="<?= $data['batas_pulang'] ?>" required='true' autocomplete="off" />
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">Absen Eskul dimulai(Jika Ada)</label>
                                       <input type='text' name='masuk_eskul' class='form-control jam1' value="<?= $data['masuk_eskul'] ?>" autocomplete="off" />                                  
									   </div>
										
									  <div class="col-md-12 mb-1">
									  <label class="bold">Jam Pulang Eskul (Jika Ada)</label>
                                       <input type='text' name='pulang_eskul' class='form-control jam1' value="<?= $data['pulang_eskul'] ?>" autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Batas Akhir Absen Pulang Eskul</label>
                                       <input type='text' name='batas_eskul' class='form-control jam1' value="<?= $data['batas_eskul'] ?>" autocomplete="off" />
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Jadwal Piket Malam (Jika Ada)</label>
                                       <input type='text' name='piket_masuk' value="<?= $data['piket_masuk'] ?>" class='form-control jam1'  autocomplete="off" />
                                        
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
			</div>
					<script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'pengaturan/twaktu.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi(waktu) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
				
<?php endif ?>
					
                        
            
                                  
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Hapus Data',
											  text: "Hapus Data Waktu Presensi",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'pengaturan/twaktu.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(waktu) ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    