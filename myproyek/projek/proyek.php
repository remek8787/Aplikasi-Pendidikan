<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
	
                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PROYEK PENGUATAN PROFIL PELAJAR PANCASILA</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
													<th>TINGKAT</th>
													<th>ROMBEL</th>
                                                    <th>PROYEK</th>
													<th>JUDUL PROYEK</th>													 
													<th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;			
											$query = mysqli_query($koneksi, "SELECT * FROM m_proyek"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                 <td><?= $no; ?></td>
                                                  <td><?= $data['tingkat'] ?></td>
													<td><?= $data['kelas'] ?></td>
												<td><?= $data['ke'] ?></td>
												<td><?= $data['judul'] ?></td>
												 <td style="text-align:center">
													<a href="?pg=<?= enkripsi('proyek') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>"> <button class='btn btn-sm btn-primary' data-bs-placement="top" data-bs-toggle="tooltip" title="Edit Projek"><i class='material-icons'>edit</i></button></a>
													<button data-id="<?= $data['id'] ?>" class="delet btn-sm btn btn-danger"><i class="material-icons">delete</i></button>
												</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
										
									</div>
							 <script>
									$('#datatable1').on('click', '.delet', function() {
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
											   url: 'projek/tproyek.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
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
									
									
							<?php if ($ac == '') : ?>
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                  
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											
									<div class="widget-payment-request-info m-t-md">
									 <div class="d-grid gap-2">
									<button class="btn btn-primary" type="button" disabled>
										<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
										 INPUT MASTER PROYEK
									</button>
											</div>
								 <form id="formtujuan" action=''>
							    <div class="col-md-12">
								<label class="form-label bold">Tingkat</label>
								<select name="level" id="level" class='form-select' required='true' style="width: 100%">
								  <option value="">Pilih Tingkat</option>
                                       <?php
										$lev = mysqli_query($koneksi, "SELECT level,kuri FROM kelas WHERE kuri='2' GROUP BY level");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[level]'>$level[level]</option>";
										}
										?>							
									 </select>
							     </div>	
                               <div class="col-md-12">
								<label class="form-label bold">Rombel</label>
								<select name="kelas" id='kelas' class='form-select' required='true' style="width: 100%">
								    			
									 </select>
							     </div>	
								
							<div class="col-md-12">
								<label class="form-label bold">Proyek Ke</label>
								<select name='ke'  class='form-select' required='true' style="width: 100%">
								<option value=''>Pilih Proyek Ke</option>
								  <option value='Proyek 1'>Proyek 1</option>
									<option value='Proyek 2'>Proyek 2</option>
									<option value='Proyek 3'>Proyek 3</option>
									 </select>
							</div>
							 
								 <div class="col-md-12">
								<label class="form-label bold">Judul Proyek</label>
								<input type="text" name="judul" class="form-control" required="true" >
							          </div>
								<div class="col-md-12">
									<label class="form-label bold">Deskripsi Proyek</label>
								<textarea  name='deskripsi' class='form-control' rows='5' cols='80' style='width:100%;' required="true" placeholder="Tuliskan secara singkat tentang deskripsi proyek yang dilakukan di sekolah anda."></textarea>
									</div>	  
									  <p>
									  
								           <div class="d-grid gap-2">
                                       <button type="submit"  class="btn btn-primary">SIMPAN</button>
                         
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
							 $('#formtujuan').submit(function(e) {
								e.preventDefault();
								$.ajax({
									type: 'POST',
									url: 'projek/tproyek.php?pg=tambah',
									data: $(this).serialize(),
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									width: "30%"
									}, 500);
									},
									success: function(data) {
										console.log(data);
										if (data == 'OK') {
										  
											setTimeout(function() {
												window.location.reload();
											}, 2000);
										} else {
										  iziToast.info(
									{
										title: 'GAGAL!',
										message: 'Data Sudah Ada',
										titleColor: '#FFFF00',
										messageColor: '#fff',
										backgroundColor: 'rgba(0, 0, 0, 0.5)',
										 progressBarColor: '#FFFF00',
										  position: 'topRight'
											});
											setTimeout(function() {
												window.location.reload();
											}, 2000);
										}

									}
								});
								return false;
							});
							
							 
							</script>
	                        <script>	
							$("#level").change(function() {
							var level = $(this).val();
							console.log(level);
							$.ajax({
							type: "POST",
							url: "projek/tnilai.php?pg=kelas", 
							data: "level=" + level, 
							success: function(response) { 
							$("#kelas").html(response);
							
									}
								});
							});
							</script>			
				<?php elseif ($ac == enkripsi('edit')): ?>	
						<?php 
						$id = dekripsi($_GET['id']); 	
						$pr = fetch($koneksi,'m_proyek',['id'=>$id]); 
						?>
						 
					 <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                  
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											
									<div class="widget-payment-request-info m-t-md">
									 <div class="d-grid gap-2">
									<button class="btn btn-primary" type="button" disabled>
										<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
										 EDIT MASTER PROYEK
									</button>
											</div>
								 <form id="formedit" action=''>
								 <input type="hidden" name="id" value="<?= $id ?>" >							   
								 <div class="col-md-12">
								<label class="form-label bold">Judul Proyek</label>
								<input type="text" name="judul" class="form-control" value="<?= $pr['judul'] ?>" required="true" >
							          </div>
								<div class="col-md-12">
									<label>Deskripsi Proyek</label>
								<textarea  name='deskripsi' class='form-control' rows='5' cols='80' style='width:100%;' required="true" placeholder="Tuliskan secara singkat tentang deskripsi proyek yang dilakukan di sekolah anda."><?= $pr['deskripsi'] ?></textarea>
									</div>	  
									  <p>
									  
								           <div class="d-grid gap-2">
                                       <button type="submit" class="btn btn-primary">SIMPAN</button>
                         
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
         url: 'projek/tproyek.php?pg=edit',
        enctype: 'multipart/form-data',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function() {
		$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
		$('.progress-bar').animate({
		width: "30%"
		}, 500);
		},
        success: function(data){   		
          
            setTimeout(function()
            {
                window.location.replace('?pg=<?= enkripsi(proyek) ?>');
            }, 2000);
		  
        }
    });
    return false;
});
</script>	
				                  
				
					
								
					  <?php endif ?>
					  
					  
					  
		  	  
					  
					  
					