<?php
defined('APK') or exit('No Access');
?>
<div class='row'>

       <div class='col-md-12'>
          <div class="card">
			<div id="menu-sandik2">
		   <a href="#" class="logomu"><h5 class="card-title">SETTING DATA SEKOLAH</h5></a>
				</div>
<div class="card-body">            
	<form id="formpengaturan" action='' method='post' enctype='multipart/form-data'>
        <div class="row mb-1">
        <label  class="col-md-2 col-form-label">Nama Aplikasi</label>
        <div class="col-md-3">
            <input type='text' name='aplikasi' value="<?= $setting['aplikasi'] ?>" class='form-control' readonly />
        </div>
    
        <label  class="col-md-2 col-form-label">Nama Sekolah</label>
        <div class="col-md-5">
            <input type='text' name='sekolah' value="<?= $setting['sekolah'] ?>" class='form-control' required='true' />
        </div>
    </div>
	 <div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Jenis Satuan Pend</label>
        <div class="col-sm-3">
           <select name='jenis' id="jenis" class='form-select'  required='true'>
            <option value="<?= $setting['jenis'] ?>"><?= $setting['jenis'] ?></option>
              <option value="">Pilih Jenis Pendidikan</option>  
              <option value="REGULER">REGULER</option>		   
              <option value="PKBM">PKBM</option> 
              </select>
        </div>
        <label  class="col-sm-2 col-form-label">Jenjang</label>
        <div class="col-sm-5">
         <select name='jenjang' id="jenjang" class='form-select'  required='true'>
           <option value="<?= $setting['jenjang'] ?>"><?= $setting['jenjang'] ?></option> 
              <option value="SMK">SMK</option>  
              <option value="SMA">MAN / SMA</option>		   
              <option value="SMP">MTs / SMP</option>  
              <option value="SD">MI / SD</option>	
			  <option value="PKBM">P K B M</option>
             </select>
        </div>
    </div>
	<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">NPSN</label>
        <div class="col-sm-3">
		<input type='text' name='npsn' value="<?= $setting['npsn'] ?>" class='form-control' required='true' />
          </div>
        <label  class="col-sm-2 col-form-label">Kode Server</label>
        <div class="col-sm-5">    
		  <input type='text' name='kode' value="<?= $setting['id_server'] ?>" class='form-control' required='true'  />
              </div>
			</div>
			<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Semester</label>
        <div class="col-sm-3">	
	 <select name='semester' class='form-select' required='true'>
        <option value="<?= $setting['semester'] ?>"><?= $setting['semester'] ?></option>
             <option value='1'>1</option>
                   <option value='2'>2</option>
             </select>
       </div>
          <label  class="col-sm-2 col-form-label">Tahun Pelajaran</label>
        <div class="col-sm-5">	                                    										 
			<input type='text' name='tp' value="<?= $setting['tp'] ?>" class='form-control' autocomplete="off" required='true'  />
                   </div>
					</div>
		<div class="row mb-1">
		 <label  class="col-sm-2 col-form-label">Telphone</label>
        <div class="col-sm-3">	 				                	 
		<input type='text' name='telp' value="<?= $setting['telp'] ?>" class='form-control' />
               </div>	

        <label  class="col-sm-2 col-form-label">Faximily</label>
        <div class="col-sm-5">
			<input type='text' name='fax' value="<?= $setting['fax'] ?>" class='form-control' required='true' />
                </div>
					</div>
			<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-4">
			<input type="text" name='alamat' class='form-control' value="<?= $setting['alamat'] ?>"  required='true' >
                                            </div>
		  <label  class="col-sm-1 col-form-label">Desa</label>
        <div class="col-sm-5">
	<input type="text" name='desa' class='form-control' value="<?= $setting['desa'] ?>"  required='true' >
            </div>
			  </div>
		<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-sm-4">
			<input type='text' name='kecamatan' value="<?= $setting['kecamatan'] ?>" class='form-control'  required='true' />
                  </div>
				<label  class="col-sm-1 col-form-label">Kab</label>
        <div class="col-sm-5">
			<input type='text' name='kabupaten' value="<?= $setting['kabupaten'] ?>" class='form-control'  required='true' />
                                            </div>
						               </div>
			<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Propinsi</label>
        <div class="col-sm-4">
		 <input type="text" name='propinsi' class='form-control' value="<?= $setting['propinsi'] ?>"  required='true' >
             </div>
				<label  class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-5">
			<input type='text' name='email' value="<?= $setting['email'] ?>" class='form-control' />
                                            </div>
						                </div>		
									
		<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Website</label>
        <div class="col-sm-10">
			<input type='text' name='web' value="<?= $setting['web'] ?>" class='form-control' />
                                            </div>
										  </div>
		<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Url Api WA</label>
        <div class="col-sm-10">
			<input type='text' name='apiwa' value="<?= $setting['url_api'] ?>" class='form-control' />
                                            </div>
										  </div>								  
		<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">Kepala Sekolah</label>
        <div class="col-sm-4">
			<input type='text' name='kepsek' value="<?= $setting['kepsek'] ?>" class='form-control'  />
                                       </div>
		<label  class="col-sm-1 col-form-label">NIP Kepala</label>
        <div class="col-sm-5">
			 <input type='text' name='nip' value="<?= $setting['nip'] ?>" class='form-control'  />
                                       </div>
						            </div>
			<div class="row mb-1">
        <label  class="col-sm-2 col-form-label">No WA Kepala</label>
        <div class="col-sm-10">
			<input type='number' name='nowa' value="<?= $setting['nowa'] ?>" class='form-control' />
          </div>
			 </div>												
			<div class="row mb-1">
			<label  class="col-sm-2 col-form-label">URL Sinkron</label>
			<div class="col-sm-4">
			<input type='text' name='server' value="<?= $setting['server'] ?>" class='form-control'  />
						</div>
                           <label  class="col-sm-1 col-form-label">Waktu Server</label>
						   <div class="col-sm-5">
							  <select name='waktu' class='form-select' required='true' >
                                                    <option value="<?= $setting['waktu'] ?>"><?= $setting['waktu'] ?></option>
                                                    <option value='Asia/Jakarta'>Asia/Jakarta</option>
                                                    <option value='Asia/Makassar'>Asia/Makassar</option>
                                                    <option value='Asia/Jayapura'>Asia/Jayapura</option>
                                                </select>           
                                       </div>
						            </div>	
									
									<br>
							<div class="row mb-1">
							<label  class="col-sm-2 col-form-label">Logo Sekolah</label>
							<div class="col-sm-4">
							   <input type='file' name='logo' class='form-control' />
                                            </div>
                                      <label  class="col-sm-1 col-form-label"></label>	
										<div class="col-sm-4">									  
                                                <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" height='50px' />
                                            
						                </div>				
									 </div><p>
							<div class="row mb-1">
							<label  class="col-sm-2 col-form-label">Logo Kemdikbud / Depag</label>
							<div class="col-sm-4">
							   <input type='file' name='logokanan' class='form-control' />
                                            </div>
                                      <label  class="col-sm-1 col-form-label"></label>	
										<div class="col-sm-4">									  
                                                <img src="<?= $baseurl ?>/images/<?= $setting['logokanan'] ?>" height='50px' />
                                            
						                </div>				
									 </div><p>
							<div class="row mb-1">
							<label  class="col-sm-2 col-form-label">Stempel</label>
							<div class="col-sm-4">
							   <input type='file' name='stempel' class='form-control' />
                                            </div>
                                      <label  class="col-sm-1 col-form-label"></label>	
										<div class="col-sm-4">									  
                                                <img src="<?= $baseurl ?>/images/<?= $setting['stempel'] ?>" height='50px' />
                                            
						                </div>				
									 </div><p>
									 
							<div class="row mb-1">
							<label  class="col-sm-2 col-form-label">TTD Kepsek</label>
							<div class="col-sm-4">
							   <input type='file' name='ttd' class='form-control' />
                                            </div>
                                      <label  class="col-sm-1 col-form-label"></label>	
										<div class="col-sm-4">									  
                                                <img src="<?= $baseurl ?>/images/<?= $setting['ttd'] ?>" height='50px' />
                                            
						                </div>				
									 </div><p>
							
		                 <label class="bold">Header Laporan</label>
		                    <div class="col-sm-12">
							<textarea name="laporan" class="form-control" rowspan="3" ><?= $setting['header'] ?></textarea>
                                            </div>
									<br>
									
                                   <div class="col-sm-12">		
                                      			<br>					 
                                                <button type='submit' name='submit1' class='btn btn-primary pull-right' > Simpan</button>
														
                                            </div>
						               
									           </form>
								            	</div> 
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
            url: 'pengaturan/crud_setting.php?pg=setting_app',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
                $('#progressbox').html('<div><label class="sandik" style="color:blue">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;margin-left:100px;"></div>');
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
