<?php
defined('APK') or exit('No accsess');
?>       

<div class="row">
  <div class="col-xl-8" >
       <div class="card" >
	   <div class="card card-header" >
         <h5 class="card-title">DATA WALI KELAS</h5>
				</div>			
		<div class="card-body">
			<div class="card-box table-responsive">
			   <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:13px;">
				   <thead>
					<tr style="vertical-align:middle">
					<th>NO</th>
					<th>KELAS</th>
					<th>WALI KELAS</th>
					<th>FOTO</th>
					</tr>
				   </thead>
				   <tbody>
					 <?php
					$no=0;
					$query = mysqli_query($koneksi, "SELECT * FROM users WHERE walas<>''"); 
					while ($data = mysqli_fetch_assoc($query)) :
					$no++;
					?>
					<tr style="vertical-align:middle">
					<td><?= $no; ?></td>
					<td><?= $data['walas'] ?></td>
					<td><?= $data['nama'] ?></td>
																 
					<td>
					<?php if($data['foto']==''): ?>
					<img src="../images/guru.png" style="max-width:30px" alt="">
					<?php else : ?>
					<img src="../images/fotoguru/<?= $data['foto'] ?>" style="max-width:30px" alt="">
					<?php endif; ?>
					</td>
					</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
		<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
			<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                    </div>
                <div class="h5 mb-0">WALI KELAS</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
				  
					<div class="widget-payment-request-info m-t-md"> 						      
					<form id='formsiswa'>
						<div class="input-group mb-2">
						<label class="bold">Kelas / Rombel</label>
						 <select class="form-select" name="kelas" required style="width: 100%">
							<option value="">Pilih Kelas</option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
							</select>
						 </div>	       
						<div class="input-group mb-2">
					   <label class="bold">Wali Kelas</label>
						 <select class="form-select" name="idu" required style="width: 100%">
							<option value="">Pilih Guru</option>
							  <?php
										$peg = mysqli_query($koneksi, "SELECT * FROM users WHERE level='guru'");
										while ($guru = mysqli_fetch_array($peg)) {
										echo "<option value='$guru[id_user]'>$guru[nama]</option>";
										}
										?>
							</select>
						</div>	
						<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
					</div>                  
			    <p></p>
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
                </div>
              </div>             
            </div>					
		 </div>
		
							  
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'walas/twalas.php',
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
          