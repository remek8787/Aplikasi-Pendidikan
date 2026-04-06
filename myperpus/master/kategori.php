<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">KATEGORI BUKU</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                            <tr>
                                            <th>NO</th>                                               
                                            <th>KATEGORI</th>
                                            <th>KODE LEMARI</th>
											<th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM m_buku"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['kategori'] ?></td>
                                                <td><?= $data['rak'] ?></td>
											    <td>											
											  <a href="?pg=<?= enkripsi('kategori') ?>&ac=<?= enkripsi('edit') ?>&idm=<?= $data['idm'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>											
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
									 <label>Kategori Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kate' class='form-control' required='true' />
									   
                                        </div>	
										 <label>Kode Lemari</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='rak' class='form-control' required='true' />
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
    $('#formkate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tkate.php?pg=tambah',
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
						 $idm = $_GET['idm'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_buku WHERE idm='$idm'"));						
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
									   <input type="hidden" class="form-control" name="idm" value="<?= $idm ?>" readonly>
									 <label>Kategori Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kate' value="<?= $data['kategori'] ?>" class='form-control' required='true' />
									   
                                        </div>	
										 <label>Kode Lemari</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='rak' value="<?= $data['rak'] ?>" class='form-control' required='true' />
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
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
             url: 'master/tkate.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi(kategori) ?>');
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
											   url: 'master/tkate.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(kategori) ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    