<?php
defined('APK') or exit('No Access');
?>      
     
	<?php if ($ac == '') : ?>
		<div class="row">
             <div class="col-xl-8">
               <div class="card">
                 <div class="card-body">
					<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
				 <?php if($siswa['foto']==''): ?>
                    <img src="<?= $baseurl ?>/images/siswa.png" class="responsive" alt="thumb" />
					<?php else: ?>
					 <img src="<?= $baseurl ?>/images/fotosiswa/<?= $siswa['foto'] ?>" class="responsive" alt="thumb" />
					 <?php endif; ?>
                    </div>
                <div class="h5 mb-0"><?= $siswa['nama'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
			         <form id="formedit"  class="row g-1" enctype='multipart/form-data'>
					 <input type='hidden' name='ids' value="<?= $siswa['id_siswa'] ?>" class='form-control' />
						<div class="col-md-12">
								<label class="form-label bold">NAMA LENGKAP</label>
							<input type='text' name='nama' value="<?= $siswa['nama'] ?>" class='form-control' required="true" />
						</div>	   
							   <div class="col-md-6">
								<label class="form-label bold">TEMPAT LAHIR</label>
							<input type='text' name='tlahir' value="<?= $siswa['t_lahir'] ?>" class='form-control' required="true" />
						</div>
						<div class="col-md-6">
								<label class="form-label bold">TANGGAL LAHIR <small>Contoh : 12 Agustus 2009</small></label>
								
							<input type='text' name='tgl' value="<?= $siswa['tgl_lahir'] ?>" class='form-control' required="true" />
						</div>
						<div class="col-md-6">
								<label class="form-label bold">ALAMAT</label>
							<input type='text' name='alamat' value="<?= $siswa['alamat'] ?>" class='form-control' required="true" />
						</div>
                           <div class="col-md-6">
								<label class="form-label bold">DESA</label>
							<input type='text' name='desa' value="<?= $siswa['desa'] ?>" class='form-control' required="true" />
						</div>
									<div class="col-md-6">
								<label class="form-label bold">KECAMATAN</label>
							<input type='text' name='kec' value="<?= $siswa['kecamatan'] ?>" class='form-control' required="true" />
						</div>
                         <div class="col-md-6">
								<label class="form-label bold">KABUPATEN</label>
							<input type='text' name='kab' value="<?= $siswa['kabupaten'] ?>" class='form-control' required="true" />
						</div>	
                        <div class="col-md-12">
								<label class="form-label bold">NO WHATSAPP ( Jika Ada )</label>
                                 <input type='number' name='nowa' value="<?= $siswa['nowa'] ?>" class='form-control' />
						</div>
                         <div class="col-md-6">
								<label class="form-label bold">NAMA AYAH</label>
							<input type='text' name='ayah' value="<?= $siswa['ayah'] ?>" class='form-control' required="true" />
						</div>		
                     
					 <div class="col-md-6">
								<label class="form-label bold">PEKERJAAN AYAH</label>
							<input type='text' name='pek_ayah' value="<?= $siswa['pek_ayah'] ?>" class='form-control' required="true" />
						</div>	
						 <div class="col-md-6">
								<label class="form-label bold">NAMA IBU</label>
							<input type='text' name='ibu' value="<?= $siswa['ibu'] ?>" class='form-control' required="true" />
						</div>			
							<div class="col-md-6">
								<label class="form-label bold">PEKERJAAN IBU</label>
							<input type='text' name='pek_ibu' value="<?= $siswa['pek_ibu'] ?>" class='form-control' required="true" />
						</div>	
						 <div class="col-md-6">
								<label class="form-label bold">NO WHATSAPP ORTU ( Jika Ada )</label>
                                 <input type='number' name='nowa_ortu' value="<?= $siswa['nowa_ortu'] ?>" class='form-control' />
						</div>
						<div class="col-md-6">
								<label class="form-label bold">USERNAME</label>
							<input type='text' name='username' value="<?= $siswa['username'] ?>" class='form-control' readonly="true" />
						</div>	
						<div class="col-md-6">
								<label class="form-label bold">PASSWORD</label>
							<input type='text' name='password' value="<?= $siswa['password'] ?>" class='form-control' required="true" />
						</div>	
                        <div class="col-md-6">
								<label class="form-label bold">FOTO ( Jika Ada )</label>
                                 <input type='file' name='file' class='form-control' />
						</div>	
						
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary kanan">Simpan</button>
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
             url: 'siswa/tsiswa.php?pg=edit',
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
               

        <?php endif; ?>		 