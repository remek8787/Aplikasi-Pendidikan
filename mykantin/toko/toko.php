<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA KANTIN</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>NAMA KANTIN</th>
											         <th>DESKRIPSI KANTIN</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM toko"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                     <td><?= $data['nama_toko'] ?></td>
													 <td><?= $data['deskrip'] ?></td>
													  
													  <td>
											
											  <a href="?pg=<?= enkripsi('toko') ?>&ac=<?= enkripsi('edit') ?>&idt=<?= $data['idt'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
												<button data-id="<?= $data['idt'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
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
											   url: 'toko/crtoko.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi("toko") ?>');
													}, 1000);
												}
											});
										}
										return false;
									})

								});

							</script>    
						<?php if ($ac == '') : ?>
					       <div class="col-xl-4 mb-4">
							<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/icon/kantin.ico" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formguru' >	
									 	
										 <label class="bold">Nama Kantin</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' required='true' autocomplete="off" />
                                        </div>
										
										<label class="bold">Deskripsi Kantin</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='deskrip' class='form-control' required='true' />
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
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'toko/crtoko.php?pg=tambah',
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
						}, 1000);
									  
						}
					});
				return false;
			});
		</script>	
                        
					 <?php elseif($ac == enkripsi('edit')): ?>	
						 <?php
						 $idt = $_GET['idt'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM toko WHERE idt='$idt'"));						
                            ?>
					<div class="col-xl-4 mb-4">
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
									   <input type="hidden" class="form-control" name="idt" value="<?= $idt ?>" readonly>
									
										 <label class="bold">Nama Kantin</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $data['nama_toko'] ?>" class='form-control' required='true' autocomplete="off" />
                                        </div>
										
										<label class="bold">Deskripsi Kantin</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='deskrip' value="<?= $data['deskrip'] ?>" class='form-control' required='true' />
                                        </div>
										
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
             url: 'toko/crtoko.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi("toko") ?>');
						}, 1000);
									  
						}
					});
				return false;
			});
		</script>			
					
<?php endif ?>
					
            
                                  
								