
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="card widget widget-list">
                                    <div class="card-header">
                                        <?php if ($user['level']=='admin'): ?>
										<div class="kanan">
                                               
                                                <button id="confirm" class="btn btn-secondary">Hapus</button>
                                            </div>
											<?php endif; ?>
											 <h5 class="card-title">INFORMASI</h5>
                                    </div>
                                    <div class="card-body edis2">
                                    
                                        <ul class="widget-list-content list-unstyled">
										<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM informasi ORDER BY id DESC LIMIT 4"); 
											  while ($data = mysqli_fetch_array($query)) :
											 
											$no++;
											   ?>
										
                                            <li class="widget-list-item widget-list-item-green">
                                                <span class="widget-list-item-icon"><i class="material-icons-outlined">notifications</i></span>
                                                <span class="widget-list-item-description">
                                                    <a href="#" class="widget-list-item-description-title">
                                                        <?= $data['waktu'] ?> 
														<?php if($data['untuk']==0): ?>
														<h5 class="kanan"><span class="badge badge-primary">Siswa</span></h5>
                                                    <?php else : ?>
													<h5 class="kanan"><span class="badge badge-success">Proktor</span></h5>
                                                    <?php endif; ?>
													</a>
                                                    
                                                       <h5><?= $data['isi'] ?></h5>
                                                   
                                                </span>
                                            </li>
											
                                           <?php endwhile; ?>
                                        </ul>
										
                                    </div>
                                </div>
                            </div>
                             <script>
				$("#confirm").click(function(){
		    	Swal.fire({
				  title: 'Hapus Informasi',
				  text: "Data Informasi akan dikosongkan !",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, Reset!'
				}).then((result) => {
				  if (result.value) {
					$.ajax({
					url: 'tinfo.php?pg=reset',
					success: function(data) {
						 Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				   setTimeout(function() {
					window.location.reload();
					}, 1000);
						}
					});
					}
					return false;
						})

						});
					</script>	
	
                            <div class="col-xl-5">
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">INFORMASI</h5>
                                    </div>
                                    <div class="card-body">
									 <form id="formpesan">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">KIRIM INFORMASI</span>
                                                    <span class="widget-payment-request-author-about"><?= date('d M Y') ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="widget-payment-request-info m-t-md">
                                                <div class="widget-payment-request-info-item">
                                                    <span class="widget-payment-request-info-title d-block">
													
													<div class="col-md-12">
													<label>Untuk</label>
                                                  <select name="untuk" class="form-select" style="width: 100%;" required >
												<option value='1'>Pegawai</option>
												<option value='0'>Siswa</option>
												
                                           </select> 
										   </div><p>
										   <div class="col-md-12">
												<label>Informasi</label>
								              <textarea name='pesan'  class='editor1 form-control' rows="10" required="true" /></textarea>
												</div>
                                      
                                                </div>
                                               
                                            </div>
											<p>
											
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary" onclick="tinyMCE.triggerSave(true,true);" id="blockui-3">SIMPAN</button>
                                            </div>
                                        </div>
										</form>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				<script>
$('#formpesan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
             url: 'tinfo.php?pg=tambah',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {},
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
	tinymce.init({
		selector: '.editor1',
		
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
		],

		toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		paste_data_images: true,

		images_upload_handler: function(blobInfo, success, failure) {
			success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
		},
		image_class_list: [{
			title: 'Responsive',
			value: 'img-responsive'
		}],
	});
</script>