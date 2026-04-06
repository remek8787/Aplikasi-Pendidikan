<?php
defined('APK') or exit('No Access');
$sk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_sk  WHERE idsk='2'"));
?>
   <?php 
   if (empty($_GET['kode'])) {
        $kode = "";
   }else{
	   $kode = $_GET['kode'];
   }
 
   ?>
				<div class="row">
				 <div class="col-xl-8" >
				   <div class="card">
				    <div class="card card-header">
					<h5 class="card-tittle bold">MASTER SK PEMBAGIAN TUGAS MENGAJAR</h5>
					</div>
						<div class="card-body">	
						<form id='formedit' class="row g-2">
						<div class='col-md-12 mb-1'>	
							<label class="bold">PILIH KODE</label>						
							<select class="form-select kode" name="kode" required style="width: 100%">
								<option value="<?= $kode ?>"><?= strtoupper($kode) ?></option>
								<option value="menimbang">MENIMBANG</option>
									<option value="mengingat">MENGINGAT</option>
									<option value="memperhatikan">MEMPERHATIKAN</option>
									<option value="memutuskan">MEMUTUSKAN</option>
									</select>
									</div>
									<br>
									
									<input type="hidden" name="kode" value="<?= $kode ?>" >
									<?php
										$no=0;
										if($kode=='menimbang'):
										$query = mysqli_query($koneksi, "SELECT * FROM sk_membaca where idsk='2'"); 
										elseif($kode=='mengingat'):
										$query = mysqli_query($koneksi, "SELECT * FROM sk_menimbang where idsk='2'");
										elseif($kode=='memperhatikan'):
										$query = mysqli_query($koneksi, "SELECT * FROM sk_mengingat where idsk='2'");
										elseif($kode=='memutuskan'):
										$query = mysqli_query($koneksi, "SELECT * FROM sk_memutuskan where idsk='2'");
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$no++;
										?>
										<input type="hidden" name="id[]" value="<?= $data['id'] ?>" >
										<table>
										<tr>
											<td><input type="text" name="isi[]"  class='form-control' value="<?= $data['isi'] ?>" required="true"></td>											
										</tr>
										</table>
										
										<?php endwhile; ?>
									
									<div class='col-md-12'>
									<br><br>					 
                                     <button type='submit' name='submit1' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-primary pull-right' > Simpan</button>			
									</div>
								</form>
							</div>
							
						</div>
					</div>
				<script type="text/javascript">
                 $('.kode').change(function() {
				var kode = $('.kode').val();
                location.replace("?pg=<?= enkripsi('tugas') ?>&kode=" + kode);
                  }); 
               </script>
				<script>
				$('#formedit').submit(function(e){
					e.preventDefault();
					var data = new FormData(this);
					$.ajax(
					{
						type: 'POST',
						 url: 'tugas/tsk.php',
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
           	 <div class="col-xl-4 mb-6">
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
                  <div class="mb-5">
                    <p class="text-small text-muted mb-2">ALAMAT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="lungs" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['alamat'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="brain" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['desa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="stomach" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
                    </div>
                  </div>

                  <div class="mb-5">
                    <p class="text-small text-muted mb-2">CONTACT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="phone" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nowa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="email" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['email'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="pin" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['fax'] ?></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">KEPALA INSTANSI</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="health" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="building" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nip'] ?></div>
                    </div>
                  </div>
					<div class="card-body border-last-none">
                      
                    <br>
                  </div>
                
                </div>
              </div>
             
            </div>
   
			 </div>
			
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
