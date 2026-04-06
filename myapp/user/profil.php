<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
	<style>
.responsive {
  width: 50%;
  height: auto;
}
</style>		   
					<div class="row">
                          <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= strtoupper($user['nama']) ?></h5>
										
                                    </div>
                                    <div class="card-body">
									<center>
									<?php if($user['foto'] !=''): ?>
									<img src="../images/fotoguru/<?= $user['foto'] ?>" alt="" class="responsive">
									<?php else: ?>
									 <img src="../images/user.png" alt="" class="responsive">
									<?php endif; ?>
									<hr>TANDA TANGAN<hr>
									<?php if($user['ttd'] !=''): ?>
									<img src="../images/<?= $user['ttd'] ?>" alt="" class="responsive">
									<?php else: ?>
									
									<?php endif; ?>
									</center>
											</div>
										</div>
									</div>
						
					       <div class="col-md-6">
                                  <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">PROFILKU</h5>
										
                                    </div>
                                    <div class="card-body">
                                       
									<form id='formedit' >	
									 <label>N I P</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nip' value="<?= $user['nip'] ?>" class='form-control' required='true' />
									    <input type='hidden' name='iduser' value="<?= $user['id_user'] ?>" class='form-control' required='true' />
									   
                                        </div>	
										 <label>Nama Lengkap</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $user['nama'] ?>" class='form-control' required='true' />
                                        </div>
										<?php if($user['level']=='guru'): ?>
										<label>Status Guru</label>
									  <div class="input-group mb-1">
                                      <select name="jenis" class="form-select" style="width:100%"  >
									   <option value="<?= $user['jenis'] ?>"><?= $user['jenis'] ?></option>
									   <option value="">Pilih Status</option>
									  <option value="Guru Mapel">Guru Mapel</option>
									  <option value="Guru BK">Guru BK</option>
									  <option value="Guru Mapel Umum">Guru Mapel Umum</option>
									 
									  </select>
                                        </div>
										<?php endif; ?>
										<label>Username</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='username' value="<?= $user['username'] ?>" class='form-control' readonly />
                                        </div>
										<label>Password</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='password' value="<?= $user['password'] ?>" class='form-control' required='true' />
                                        </div>
										<label>Nomor WA</label>
									  <div class="input-group mb-1">
                                       <input type='number' name='nowa' value="<?= $user['nowa'] ?>" class='form-control' required='true' />
                                        </div>
										

										<label>Wali Kelas</label>
									  <div class="input-group mb-1">
                                      <select name="walas" class="form-select" style="width:100%" >
									   <option value="<?= $user['walas'] ?>"><?= $user['walas'] ?></option>
									  <option value="">Bukan Wali Kelas</option>
									   <?php $q = mysqli_query($koneksi, "select * from kelas");
									while ($data = mysqli_fetch_array($q)) { ?>
                                    <option value="<?= $data['kelas'] ?>"><?= $data['kelas'] ?></option>
									<?php } ?>
									  </select>
                                        </div>
									
                                      <label class="bold">Foto Jika Ada</label>
									  <div class="input-group mb-3">
                                       <input type='file' name='file' class='form-control'/>
                                        </div>	
										<label class="bold">Tanda Tangan Jika Ada</label>
									  <div class="input-group mb-3">
                                       <input type='file' name='ttd' class='form-control'/>
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
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
             url: 'user/tguru.php?pg=profil',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" ></div>');
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
                                  
								