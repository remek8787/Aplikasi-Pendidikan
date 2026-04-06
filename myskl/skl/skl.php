<?php
defined('APK') or exit('No Access');
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
?>

				<div class="row">
				 <div class="col-xl-8" >
				   <div class="card">
						<div class="card-body">	
								<form id='formsekolah' class="row g-2">
								<div class='col-md-6'>
                                      <label class="bold">SISWA TINGKAT</label>
                                      <select class="form-select" name="level" required style="width: 100%">
										<option value="<?= $skl['tingkat'] ?>"><?= $skl['tingkat'] ?></option>
										<?php
										$kls = mysqli_query($koneksi, "SELECT level FROM kelas GROUP BY level");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[level]'>$kelas[level]</option>";
										}
										?>
									</select>
                                    </div>
									<div class='col-md-6'>
                                      <label class="bold">PENGUMUMAN DIBUKA</label>
                                       <input type="text" class="tgl form-control" name="buka" value="<?= $skl['dibuka'] ?>" >
                                    </div>
									<div class='col-md-6'>
                                      <label class="bold">PENGUMUMAN DITUTUP</label>
                                       <input type="text" class="tgl form-control" name="tutup" value="<?= $skl['ditutup'] ?>" >
                                    </div>
									<div class='col-md-6'>
                                      <label class="bold">NAMA SURAT</label>
                                       <input type="text" class="form-control" name="nama" value="<?= $skl['nama_surat'] ?>" >
                                    </div>
									
									<div class='col-md-6'>
                                      <label class="bold">NOMOR SURAT</label>
                                       <input type="text" class="form-control" name="no_surat" value="<?= $skl['no_surat'] ?>" >
                                    </div>
									
								    <div class='col-md-6'>
                                      <label class="bold">TANGGAL SURAT</label>
                                      <input type="text" class="form-control" name="tgl_surat" value="<?= $skl['tgl_surat'] ?>" >
                                    </div>
									<div class='col-md-6'>
                                      <label class="bold">HEADER SURAT</label>
                                      <input type="file" class="form-control" name="file" >
                                    </div>
									<div class='col-md-6'>
                                     <?php if($skl['header']<>''): ?>
									 <img src="../images/<?= $skl['header'] ?>" style="max-width:200px">
									 <?php endif; ?>
                                    </div>
									
									<div class='col-md-12'>
                                      <label class="bold">PEMBUKA SURAT</label>
                                      <textarea name="pembuka"  class='editor1'><?= $skl['pembuka'] ?></textarea>
                                    </div>
									
									 <div class='col-md-12'>
                                      <label class="bold">ISI SURAT</label>
                                      <textarea name="isi"  class='editor1'><?= $skl['isi_surat'] ?></textarea>
                                    </div>
								   
									 <div class='col-md-12'>
                                      <label class="bold">PENUTUP SURAT</label>
                                         <textarea name="penutup" class='editor1'><?= $skl['penutup'] ?></textarea>
                                    </div>
								    
									<div class='col-md-12'>
									<br><br>					 
                                     <button type='submit' name='submit1' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-primary pull-right' > Simpan</button>			
									</div>
								</form>
							</div>
							
						</div>
					</div>
				
				<script>
    $('#formsekolah').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'skl/tskl.php',
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
