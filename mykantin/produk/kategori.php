<?php
defined('APK') or exit('NO ACCESS');
?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">KATEGORI PRODUK</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>KATEGORI</th>
													 <th width="25%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM kategori"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['kategori_nama'] ?></td>
                                                     
													 <td>
											
											  <a href="?pg=<?= enkripsi('kategori') ?>&ac=<?= enkripsi('edit') ?>&idk=<?= $data['kategori_id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
												<button data-id="<?= $data['kategori_id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
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
											   url: 'produk/tkategori.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												 $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
													$('.progress-bar').animate({
													width: "30%"
													}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi("kategori") ?>');
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
									<form id='formkategori' >	
									 <label class="bold">KATEGORI</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kategori' class='form-control' required='true' />  
                                        </div>											
										<div class="widget-payment-request-actions m-t-md d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
	<script>
    $('#formkategori').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'produk/tkategori.php?pg=tambah',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			 $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
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
					 <?php elseif($ac == enkripsi('edit')): ?>	
						 <?php
						 $idk = $_GET['idk'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$idk'"));						
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
									<form id='formedit' >	
									   <input type="hidden" class="form-control" name="idk" value="<?= $idk ?>">
									 <label class="bold">KATEGORI</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kategori' value="<?= $data['kategori_nama'] ?>" class='form-control' required='true' />
									   
                                        </div>	
										 
										<div class="widget-payment-request-actions m-t-md d-flex">

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
             url: 'produk/tkategori.php?pg=edit',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			 $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace('?pg=<?= enkripsi("kategori") ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>			
					
<?php endif ?>
   