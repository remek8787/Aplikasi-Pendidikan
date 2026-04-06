<?php
defined('APK') or exit('No Access');
?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA BUKU DIGITAL</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>JUDUL</th>
                                                    <th>DESKRIPSI</th>
													  <th>UPLOADER</th>
													  
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM digital ORDER BY id DESC"); 
											  while ($data = mysqli_fetch_array($query)) :
											  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['judul'] ?></td>
                                                     <td><?= $data['deskripsi'] ?></td>
													  <td><?= $data['guru'] ?></td>
													  <td>
											
											  <a href="?pg=<?= enkripsi('inbuku') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formkate' >	
									 
										 <label>Judul Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='judul' class='form-control' required='true' />
                                        </div>
										
										<label>Deskripsi Buku</label>
									  <div class="input-group mb-1">
                                       <textarea  name='deskrip' class='form-control' rows="2" required='true' /></textarea>
                                        </div>
										<label>Icon Buku</label>
									  <div class="input-group mb-1">
                                       <input type='file' name='ikon' class='form-control' required='true' />
                                        </div>
										<label>File PDF</label>
									  <div class="input-group mb-1">
                                        <input type='file' name='file' class='form-control' required='true' />
                                        </div>								
										<div class="widget-payment-request-actions m-t-lg d-flex">
										<input type="hidden" name="guru" value="<?= $user['nama'] ?>" >
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						
	<script>
    $('#formkate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'buku/tbuku.php?pg=tambah',
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
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM digital WHERE id='$id'"));						
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
									<form id='formedit' class="row g-1">	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									  <label>Judul Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='judul' value="<?= $data['judul'] ?>" class='form-control' required='true' />
                                        </div>
										
										<label>Deskripsi Buku</label>
									  <div class="input-group mb-1">
                                       <textarea  name='deskrip' class='form-control' rows="2" required='true' /><?= $data['deskripsi'] ?></textarea>
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
				
					
					
<?php endif ?>
					
                        
            <script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'buku/tbuku.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi(inbuku) ?>');
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
											   url: 'buku/tbuku.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(inbuku) ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    