<?php
defined('APK') or exit('No Access');
if($setting['jenis']=='1'){$jenis='KEMDIKBUD';}else{$jenis='KEMENAG';}
$cetak = fetch($koneksi,'cetak',['id'=>1]);
?>
<div class="row">
    <div class="col-xl-8 mb-4">
		<div class="card">
			<div class="card card-header">
				<h5 class="bold">DATA SEKOLAH</h5>
				</div>
				<div class="card-body">
				<form id='formsekolah' class="row g-2">
				<div class='col-md-12'>
				<label class="bold">NAMA SEKOLAH / INSTANSI</label>
                    <input type='text' name='sekolah' value="<?= $setting['sekolah'] ?>"  class='form-control' required='true' />
                </div>
				<div class='col-md-4'>
                <label class="bold">JENJANG</label>
                <select name='jenjang' id="jenjang" class='form-select'  required='true'>
					<option value="<?= $setting['jenjang'] ?>"><?= $setting['jenjang'] ?></option> 
					<option value="SMK">SMK</option>  
					<option value="SMA">MAN / SMA</option>		   
					<option value="SMP">MTs / SMP</option>  
					<option value="SD">MI / SD</option>	
					<option value="PKBM">P K B M</option>
					</select>
						</div>
				<div class='col-md-4'>
                <label class="bold">KEMENTRIAN</label>
                <select name='jenis' id="jenis" class='form-select'  required='true'>
					<option value="<?= $setting['jenis'] ?>"><?= $jenis ?></option> 
					<option value="1">KEMDIKBUD</option>  
					<option value="2">KEMENAG</option>		   
					</select>
						</div>
				<div class='col-md-4'>
                <label class="bold">KODE SERVER</label>
                    <input type='text' name='kode_server' value="<?= $setting['kode_server'] ?>"  class='form-control' required='true' />
                       </div>		
				<div class='col-md-4'>
                <label class="bold">NPSN</label>
                    <input type='text' name='npsn' value="<?= $setting['npsn'] ?>"  class='form-control' required='true' />
                       </div>
									
				<div class='col-md-4'>
                <label class="bold">SEMESTER</label>
                    <select name='semester' class='form-select' required='true'>
					<option value="<?= $setting['semester'] ?>"><?= $setting['semester'] ?></option>
					<option value='1'>1</option>
					<option value='2'>2</option>
					</select>
                    </div>
				<div class='col-md-4'>
                <label class="bold">TAHUN PELAJARAN</label>
                    <input type='text' name='tp' value="<?= $setting['tp'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-12'>
                <label class="bold">TANGGAL RAPOR</label>
                    <input type='text' name='tgl' value="<?= $setting['tanggal_rapor'] ?>"  class='form-control' required='true' />
                      </div>
				<div class='col-md-4'>
                <label class="bold">NO WA</label>
                    <input type='text' name='nowa' value="<?= $setting['nowa'] ?>"  class='form-control' required='true' />
                      </div>	  
				<div class='col-md-8'>
                <label class="bold">ALAMAT</label>
                    <input type='text' name='alamat' value="<?= $setting['alamat'] ?>" class='form-control' required='true' />
                      </div>
				<div class='col-md-6'>
                <label class="bold">DESA</label>
                    <input type='text' name='desa' value="<?= $setting['desa'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">KECAMATAN</label>
                    <input type='text' name='kec' value="<?= $setting['kecamatan'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">KABUPATEN / KOTA</label>
                    <input type='text' name='kab' value="<?= $setting['kabupaten'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">PROPINSI</label>
                    <input type='text' name='prop' value="<?= $setting['propinsi'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">EMAIL</label>
                    <input type='text' name='email' value="<?= $setting['email'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">SERVER/WEB <small style="color:red">(jangan gunakan tanda / dibelakang)</small></label>
                    <input type='text' name='server' class='form-control' value="<?= $setting['server'] ?>" required="true"/>
                        </div>		
				<div class='col-md-6'>
                <label class="bold">KEPALA SEKOLAH</label>
                    <input type='text' name='kepsek' value="<?= $setting['kepsek'] ?>" class='form-control' required='true' />
                        </div>
				<div class='col-md-6'>
                <label class="bold">NIP </label>
                    <input type='text' name='nip' value="<?= $setting['nip'] ?>" class='form-control' required='true' />
                        </div>
				
				<div class='col-md-6'>
                <label class="bold">URL API WA <small style="color:red">(jangan gunakan tanda / dibelakang)</small></label>
                    <input type='text' name='apiwa' class='form-control' value="<?= $setting['url_api'] ?>" required="true"/>
                        </div>
				<div class='col-md-6'>
                <label class="bold">WAKTU SERVER</label>
                    <select name='waktu' class='form-select' required='true' >
                    <option value="<?= $setting['waktu'] ?>"><?= $setting['waktu'] ?></option>
                    <option value='Asia/Jakarta'>Asia/Jakarta</option>
                    <option value='Asia/Makassar'>Asia/Makassar</option>
                    <option value='Asia/Jayapura'>Asia/Jayapura</option>
                    </select>   
                    </div>
				<div class='col-md-4'>
                <label class="bold">LOGO SEKOLAH</label>
                    <input type='file' name='logo' class='form-control' />
                        </div>
				<div class="col-sm-4">	
					<?php if($setting['logo']<>''): ?>
						<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" height='50px' />
					<?php endif; ?>
				</div>	
					<div class='col-md-4'>
					
					</div>	
				<div class="col-sm-4">
					<label  class="bold">STEMPEL <small style="color:red">(jika digunakan)</small></label>
					<input type='file' name='stempel' class='form-control' />
                  </div>
                     <div class="col-sm-6">	
					<?php if($setting['stempel']<>''): ?>
						<img src="<?= $baseurl ?>/images/<?= $setting['stempel'] ?>" height='50px' />
					<?php endif; ?>
				</div>	
                <div class="col-md-2">
                   <br>
					<?php if($setting['stempel']<>''): ?>
					<button class="btn btn-sm btn-danger" type="button" id="stp">Hapus</button>
					<?php endif; ?>
					</div>
				<div class="col-sm-4">
					<label  class="bold">TTD KEPSEK <small style="color:red">(jika digunakan)</small></label>
					<input type='file' name='ttd' class='form-control' />
                  </div>
                     <div class="col-sm-6">	
					<?php if($setting['ttd']<>''): ?>
						<img src="<?= $baseurl ?>/images/<?= $setting['ttd'] ?>" height='40px' />
					<?php endif; ?>
				</div>	
				<div class="col-md-2">
                    <br>
					<?php if($setting['ttd']<>''): ?>
					<button class="btn btn-sm btn-danger" type="button" id="ttdd">Hapus</button>
				<?php endif; ?>
				 </div>
				<div class="col-sm-12">
				<label class="bold">HEADER LAPORAN</label>
					<textarea name="laporan" class="form-control" rowspan="3" ><?= $setting['header'] ?></textarea>
                        </div>
				<div class="col-sm-5">
				<label class="bold">KOP SEKOLAH <small style="color:red">(jika digunakan)</small></label>
					<input type='file' name='kop' class='form-control' />
                        </div>
				<div class="col-sm-5 mb-2">	
					<?php if($cetak['header']<>''): ?>
					<br>
						<img src="<?= $baseurl ?>/images/<?= $cetak['header'] ?>" height='40px' />
					<?php endif; ?>
				</div>	   		
				<div class="col-md-2">
                     <br>
						<?php if($cetak['header']<>''): ?>
						<button class="btn btn-sm btn-danger" type="button" id="cth">Hapus</button>
						<?php endif; ?>
					</div>
				<div class="col-sm-6">
				<label class="bold">NAMA YAYASAN (Jika Swasta)</label>
					<textarea name="yayasan" class="form-control" rowspan="1" ><?= $setting['yayasan'] ?></textarea>
                        </div>	
					<div class="col-sm-6">
				<label class="bold">KETUA NAMA YAYASAN (Jika Swasta)</label>
					<textarea name="ketua" class="form-control" rowspan="1" ><?= $setting['ketua'] ?></textarea>
                        </div>
				<div class='col-md-12'>
				<br><br>					 
                <button type='submit' name='submit1' class='btn btn-primary pull-right' > Simpan</button>			
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
            url: 'pengaturan/tsekolah.php',
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
				$("#ttdd").click(function(){
		    	Swal.fire({
				  title: 'Hapus',
				  text: "Hapus Tanda Tangan",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Hapus'
				}).then((result) => {
				  if (result.value) {
					$.ajax({
					url: 'pengaturan/crud_setting.php?pg=hapusttd',
					success: function(data) {
						 Swal.fire(
				      'Success!',
				      'Your file has been Optimize.',
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
			<script>
				$("#stp").click(function(){
		    	Swal.fire({
				  title: 'Hapus',
				  text: "Hapus Tanda Tangan",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Hapus'
				}).then((result) => {
				  if (result.value) {
					$.ajax({
					url: 'pengaturan/crud_setting.php?pg=hapusstp',
					success: function(data) {
						 Swal.fire(
				      'Success!',
				      'Your file has been Optimize.',
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
					<script>
				$("#cth").click(function(){
		    	Swal.fire({
				  title: 'Hapus',
				  text: "Hapus Kop Sekolah",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, Hapus'
				}).then((result) => {
				  if (result.value) {
					$.ajax({
					url: 'pengaturan/crud_setting.php?pg=hapuskop',
					success: function(data) {
						 Swal.fire(
				      'Success!',
				      'Your file has been Optimize.',
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