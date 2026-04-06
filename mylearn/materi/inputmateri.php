<?php
defined('APK') or exit('No Access!');
?>
<?php if ($ac == '') { ?>
  <div class="row">
     <div class="col-md-8">
		<div class="card">
             <div class="card card-header">									
                  <h5 class="card-title">MATERI BELAJAR</h5>
					</div>
                      <div class="card-body">               
                    <form id="formmateri" class="row g-2"> 
                        <div class="col-md-6">        
						<label  class="bold">Mata Pelajaran</label>
							<select name='mapel' class='form-select' style='width:100%' required>
                                <option value=''>Pilih Mata Pelajaran</option>
                                <?php $que = mysqli_query($koneksi, "SELECT * FROM mapel"); ?>
                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
								<option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>
						 <div class="col-md-6">        
						<label  class="bold">Guru Pengampu</label>
							<select name='guru' class='form-select' style='width:100%' required>
                                <option value=''>Pilih Guru</option>
                                <?php 
								if($user['level']=='admin'):
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level='guru'"); 
								else :
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id_user'"); 
								endif;
								while ($guru = mysqli_fetch_array($query)) : 
								?>
								<option value="<?= $guru['id_user'] ?>"><?= $guru['nama'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>
						<div class="col-md-12">  
							<label  class="bold">Judul Materi</label>
							   <input type="text" class="form-control" name="judul"  placeholder="Judul materi" required>
                           </div>
                                       
						<div class="col-md-12"> 				
							<label  class="bold">Materi Belajar</label> 
						       <textarea name='isimateri' class='editor1' rows='5' cols='80' style='width:100%;'></textarea>
                            </div>
									 
                        <div class="col-md-6">           
							<label  class="bold">Kelas</label> 
						       <select name='kelas[]'  class='form-control form-control select2' multiple='multiple' style='width:100%' required='true'>
                                <option value="">Pilih Kelas</option>
								<?php $lev = mysqli_query($koneksi, "SELECT kelas FROM kelas group by kelas"); ?>
                                <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>
                               <?php endwhile ?>
                            </select>
                        </div>
						<div class="col-md-6"> 					 
						<label  class="bold">Berlaku Sampai Tanggal</label>
						    <input type='text' name='sampai' class='datepicker form-control' autocomplete='off' required='true' />
                        </div>
						<div class="col-md-6"> 	
							<label  class="bold">Link Google Drive (Jika ada)</label> 
						       <input type='text' name='link' class='form-control' autocomplete='off' />
                        </div>
						<div class="col-md-6">
						  <label class="bold">File (Jika ada)</label> 
						    <input type="file" class="form-control" name="file" >
						</div>					
						<div class="col-md-12">
						  <label class="bold">Youtube (Jika ada)</label> 
						    <input type="text" class="form-control" name="youtube" >
						</div>						
						<div class="col-sm-12">
						<label>Cara memasukan Link Youtube  Contoh Link : <b>https://youtu.be/42cqGZY9VTc</b> maka yang dimasukan adalah :<b>42cqGZY9VTc</b></label>
						</div>
									
                       <div class='modal-footer'>
                       <div class='kanan'>
                          <button type='submit'  class='btn btn-primary'>Simpan</button>
                        </div>
                      
                     </div>
					  </form>
                  </div>
               </div>
			 </div>    
 <script>
    $('#formmateri').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'materi/buat_materi.php',
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
            success: function(data) {
                if (data = 'OK') {
                    setTimeout(function() {
                        window.location.replace('?pg=<?= enkripsi(materi) ?>');
                    }, 2000);
                } else {
                  iziToast.info(
            {
                title: 'GAGAL!',
                message: 'Data sudah ada',
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
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">ALAMAT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">home</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['alamat'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">star</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['desa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">sync</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">CONTACT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">phone</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nowa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">inbox</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['email'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">language</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['server'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                         <i class="material-icons text-info" style="font-size:18px">person</i>
                        </div>
                      </div>
                      <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">payment</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nip'] ?></div>
                    </div>
                  </div>
                </div>
              </div>             
            </div>					
			</div>
			
 <?php } elseif ($ac == enkripsi('edit')) { ?>
 <?php
 $id = $_GET['id'];
 $materi=fetch($koneksi,'materi',['idm' => $_GET['id']]);
 $map=fetch($koneksi,'mapel',['id' => $materi['mapel']]);
 $peg=fetch($koneksi,'users',['id_user' => $materi['guru']]);
 ?>
 <div class="row">
     <div class="col-md-8">
		<div class="card">
             <div class="card card-header">									
                  <h5 class="card-title">EDIT MATERI BELAJAR</h5>
			</div>
            <div class="card-body">                
               <form id="formedit" class="row g-2">                             
                <input type="hidden" class="form-control" name="id" value="<?= $id ?>">
             <div class="col-md-6">        
						<label  class="bold">Mata Pelajaran</label>
							<select name='mapel' class='form-select' style='width:100%' required>
							<option value="<?= $materi['mapel'] ?>"><?= $map['nama_mapel'] ?></option>
                                <option value=''>Pilih Mata Pelajaran</option>
                                <?php $que = mysqli_query($koneksi, "SELECT * FROM mapel"); ?>
                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
								<option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>
						 <div class="col-md-6">        
						<label  class="bold">Guru Pengampu</label>
							<select name='guru' class='form-select' style='width:100%' required>
                              <option value="<?= $materi['guru'] ?>"><?= $peg['nama'] ?></option>
							  <option value=''>Pilih Guru</option>
                                <?php 
								if($user['level']=='admin'):
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level='guru'"); 
								else :
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id_user'"); 
								endif;
								while ($guru = mysqli_fetch_array($query)) : 
								?>
								<option value="<?= $guru['id_user'] ?>"><?= $guru['nama'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>                            
						<div class="col-md-12">  
							<label  class="bold">Judul Materi</label>
							   <input type="text" class="form-control" name="judul" value="<?= $materi['judul'] ?>" placeholder="Judul materi" required>
                           </div>
                                       
						<div class="col-md-12"> 				
							<label  class="bold">Materi Belajar</label> 
						       <textarea name='isimateri' class='editor1' rows='5' cols='80' style='width:100%;'><?= $materi['isimateri'] ?></textarea>
                            </div>
							
						 <div class="col-md-6">
							<label  class="bold">Kelas</label> 
						        <select name='kelas[]' id='soalkelas' class='form-control form-control-sm select2' multiple='multiple' style='width:100%' required='true'>
                                <?php $lev = mysqli_query($koneksi, "SELECT kelas FROM siswa group by kelas"); ?>
                                <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                <?php if (in_array($kelas['kelas'], unserialize($materi['kelas']))) : ?>
                                <option value="<?= $kelas['kelas'] ?>" selected><?= $kelas['kelas'] ?></option>
                                <?php else : ?>
                                <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>
                                <?php endif; ?>
                                <?php endwhile ?>
                                </select>
                            </div>
							<div class="col-md-6"> 					 
						<label  class="bold">Berlaku Sampai Tanggal</label>
						    <input type='text' name='sampai' class='datepicker form-control' value="<?= $materi['sampai'] ?>" autocomplete='off' required='true' />
                        </div>
						<div class="col-md-6"> 	
							<label  class="bold">Link Google Drive (Jika ada)</label> 
						       <input type='text' name='link' class='form-control' value="<?= $materi['link'] ?>" autocomplete='off' />
                        </div>
						<div class="col-md-6">
						  <label class="bold">File (Jika ada)</label> 
						    <input type="file" class="form-control" name="file" >
						</div>					
						<div class="col-md-12">
						  <label class="bold">Youtube (Jika ada)</label> 
						    <input type="text" class="form-control" name="youtube" value="<?= $materi['youtube'] ?>">
						</div>						
						<div class="col-sm-12">
						<label>Cara memasukan Link Youtube  Contoh Link : <b>https://youtu.be/42cqGZY9VTc</b> maka yang dimasukan adalah :<b>42cqGZY9VTc</b></label>
						</div>
									
                       <div class='modal-footer'>
                       <div class='kanan'>
                          <button type='submit'  class='btn btn-primary'>Simpan</button>
                        </div>       
                     </div>
					  </form>
                  </div>
				</div>
               </div>
                  
<script>
    $('#formedit').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        //console.log(data);
        $.ajax({
            type: 'POST',
            url: 'materi/edit.php',
            enctype: 'multipart/form-data',
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
            success: function(data) {
                if (data = 'OK') {
                    setTimeout(function() {
                        window.location.replace('?pg=<?= enkripsi(materi) ?>');
                    }, 2000);
                } else {
                  iziToast.info(
            {
                title: 'GAGAL!',
                message: 'Data sudah ada',
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
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">ALAMAT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">home</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['alamat'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">star</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['desa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">sync</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">CONTACT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">phone</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nowa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">inbox</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['email'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">language</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['server'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                         <i class="material-icons text-info" style="font-size:18px">person</i>
                        </div>
                      </div>
                      <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">payment</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nip'] ?></div>
                    </div>
                  </div>
                </div>
              </div>             
            </div>					
			</div>
 <?php } ?>
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
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
</script>