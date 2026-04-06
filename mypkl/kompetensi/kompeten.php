					<?php
					defined('APK') or exit('No accsess');
					?> 		
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">KOMPETENSI PRAKERIN</h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>#</th>                                               
										  <th>JURUSAN</th>
                                          <th>KOMPETENSI</th>
										  										 
										  <th width="20%"></th> 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_kompetensi");
											while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;"> 
											 <td><?= $no; ?></td>
											 
                                             <td><?= $data['jurusan'] ?></td>
											 <td><?= $data['deskrip'] ?></td>
											 <td>											
											<a href="?pg=<?= enkripsi('kompetensi') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
										</div>
										<div class="h5 mb-0">PRAKERIN</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id="formguru" class="row g-1">
									 <label class="bold">JURUSAN</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="jurusan"  required style="width: 100%">
									<option value="">Pilih Jurusan</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT jurusan FROM kelas GROUP BY jurusan");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[jurusan]'>$kelas[jurusan]</option>";
										}
										?>
									</select>
									 </div>	
									<label class="bold">ASPEK KOMPETENSI</label>
									 <div class="input-group mb-1">
									 <textarea name="deskrip" class="form-control" rows="3" required="true"></textarea>
									  </div>	
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                       </div>
										</form>
					               </div>
								</div>
							</div>
						</div>
				<?php elseif($ac == enkripsi('edit')): ?>	
		<?php
			$id = $_GET['id'];
		    $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_kompetensi WHERE id='$id'"));						
           
			  ?>
					<div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
										</div>
										<div class="h5 mb-0">PRAKERIN</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formedit' class="row g-1">	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label class="bold">JURUSAN</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="jurusan"  required style="width: 100%">
									<option value="<?= $data['jurusan'] ?>"><?= $data['jurusan'] ?></option>
									<option value="">Pilih Jurusan</option>
									 
									</select>
									 </div>	
									<label class="bold">ASPEK KOMPETENSI</label>
									 <div class="input-group mb-1">
									 <textarea name="deskrip" class="form-control" rows="3" required="true"><?= $data['deskrip'] ?></textarea>
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
	
<?php endif ?>
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'kompetensi/tdeskrip.php?pg=tambah',
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
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'kompetensi/tdeskrip.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi("kompetensi") ?>');
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
											   url: 'kompetensi/tdeskrip.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												setTimeout(function() {
												window.location.replace('?pg=<?= enkripsi("kompetensi") ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>