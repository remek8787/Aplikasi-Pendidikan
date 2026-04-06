<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
if($setting['pelanggaran']==1){
	$langgar='Menggunakan';
}else{
	$langgar = 'Tidak Menggunakan';
}
?>
			<div class='row'>
				  <div class="col-xl-8" >
				   <div class="card" >
						<div class="card card-header" >	
								<h5 class="card-title">PENGATURAN UJIAN</h5>
							</div>
				            <div class="card-body">            
						 	<form id="formpengaturan" class="row g-1" enctype='multipart/form-data'>
                             <div class="col-md-12">
								<label class="form-label bold"> Pelanggaran</label>
								<select class="form-select" name="langgar"  required style="width: 100%">
								 <option value="<?= $setting['pelanggaran'] ?>"><?= $langgar ?></option>
								   <option value='0'>Tdak Menggunakan</option>
								    <option value='1'>Menggunakan</option>
								  </select>
							     </div>	
		                  <div class="col-md-12">
								<label class="form-label bold"> Acak Soal</label>
								<select class="form-select" name="acak"  required style="width: 100%">								
								   <option value='1'>Ya Acak</option>								  
								  </select>
							     </div>	
								 <div class="col-md-12">
								<label class="form-label bold"> K K M</label>
								<input type="number" name="kkm" value="<?= $setting['kkm'] ?>" class="form-control" required="true" >
						</div>	
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary kanan">Simpan</button>
								</div>
							</form>
						</div> 
					</div>
				</div>
									
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
<script>
   $('#formpengaturan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
            url: 'asesmen/tsetting.php',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;margin-left:100px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
            success: function(data) {
             
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
   
</script>
