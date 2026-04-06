<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
?>

			<div class="row">
			 <div class="col-xl-8 mb-6">
			 <h2 class="small-title bold">DATA SISWA</h2>
			 <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('upload') ?>" class="btn btn-sm btn-icon btn-success pull-right"><i class="material-icons">upload</i>UPLOAD</a>
			   <div class="card">
				<div class="card-body">
				 
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-hover" style="width:100%;font-size:12px;">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>
												   <th>NIS</th>
													 <th>NISN</th>
													 <th>NAMA</th>
													 <th>KELAS</th>
													
													 <th>FOTO</th>
													 <th width="15%">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa order by id_siswa desc"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
												  <td><?= $data['nis'] ?></td>
												  <td><?= $data['nisn'] ?></td>
                                                  <td><?= $data['nama'] ?></td>                                                 
												  <td><?= $data['kelas'] ?></td>
												
												  <td>
												  <?php if($data['foto']==''): ?>
												 <a href="#"><img src="<?= $baseurl ?>/img/user.png" class="card-img rounded-xl sh-4 sw-4" alt="thumb" /></a>
												  <?php else : ?>
												    <a href="#"><img src="<?= $baseurl ?>/img/fotosiswa/<?= $data['foto'] ?>" class="card-img rounded-xl sh-4 sw-4" alt="thumb" /></a>
												  <?php endif; ?>
												  </td>
												    
												    <td>
													 <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('edit') ?>&ids=<?= $data['id_siswa'] ?>"> <button class="btn btn-sm btn-icon btn-icon-only btn-primary mb-1" type="button"> <i class="material-icons">edit</i></button></a>
												
												<button data-id="<?= $data['id_siswa'] ?>"  class="hapus btn btn-sm btn-icon btn-icon-only btn-danger mb-1" type="button"><i class="material-icons">delete</i></button>
												
													</td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
				
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Hapus Data',
											  text: "Data Siswa akan dihapus",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'siswa/tsiswa.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												setTimeout(function() {
												window.location.reload();
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script> 		
			
								
			<?php if ($ac == '') : ?>
			
			<div class="col-xl-4 mb-6">
			 <div class="card">
				<div class="card-body">
                      <div class="mb-3 pb-3 border-bottom border-separator-light">
                        <div class="row g-0 sh-6">
                          <div class="col-auto">
                            <a href="#">
                              <img src="<?= $baseurl ?>/img/belajar.png" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                            </a>
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-center justify-content-between">
                              <div class="d-flex flex-column">
                                <a href="#" class="body-link">SISWA</a>
                                <div class="text-small text-muted"><?= $setting['sekolah'] ?> </div>
                              </div>                              
                              </div>
                            </div>
                          </div>
                        </div>
						<form id="formsiswa"  class="row g-1" enctype='multipart/form-data'>
					    <div class="col-md-12">
								<label class="form-label bold">NO PESERTA UJIAN</label>
							<input type='text' name='nopes'  class='form-control' required="true" />
						</div>	 
						<div class="col-md-12">
								<label class="form-label bold">NAMA LENGKAP</label>
							<input type='text' name='nama'  class='form-control' required="true" />
						</div>	   
							   <div class="col-md-6">
								<label class="form-label bold">NIS</label>
							<input type='text' name='nis'  class='form-control' required="true" />
						</div>
						<div class="col-md-6">
								<label class="form-label bold">NISN</label>
							<input type='text' name='nisn'  class='form-control' required="true" />
						</div>
						
                    <div class="col-md-6">
								<label class="form-label bold">ROMBEL</label>
						   <select class="form-select" name="kelas" required style="width: 100%">
							  <option value='' selected>-- Pilih Rombel --</option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($k = mysqli_fetch_array($kls)) {
										echo "<option value='$k[kelas]'>$k[kelas]</option>";
										}
										?>
							</select>
						</div>
							<div class="col-md-6">
								<label class="form-label bold">AGAMA</label>
						   <select class="form-select" name="agama" required style="width: 100%">
							
							   <option value='' selected>-- Pilih Agama --</option>
							      <option value='Islam'>Islam</option>
								  <option value='Kristen'>Kristen</option>
								   <option value='Katholik'>Katholik</option>
								  <option value='Hindu'>Hindu</option>
								   <option value='Budha'>Budha</option>
								  <option value='Konghucu'>Konghucu</option>
							</select>
						</div>		           
							<div class="col-md-12">
								<label class="form-label bold">JK</label>
						   <select class="form-select" name="jk" required style="width: 100%">
							
							  <option value='' selected>-- Pilih JK --</option>
							  <option value='L'>Laki-laki</option>
								  <option value='P'>Perempuan</option>
							</select>
						</div>
						 	<div class="col-md-6">
								<label class="form-label bold">TEMPAT LAHIR</label>
							<input type='text' name='tempat'  class='form-control' required="true" />
						</div>
							<div class="col-md-6">
								<label class="form-label bold">TGL LAHIR</label>
							<input type='text' name='tgll'  class='form-control' placeholder="12 Agustus 2020" required="true" />
						</div>
							<div class="col-md-12">
								<label class="form-label bold">NO WA ( Jika ada )</label>
							<input type='text' name='nowa'  class='form-control'  />
						</div>
                        <div class="col-md-12">
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
				 </div>
                
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/tsiswa.php?pg=tambah',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
            $('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
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
           	
		<?php elseif ($ac == enkripsi('upload')) : ?>	
			
			<div class="col-xl-4 mb-6">
			 <div class="card">
				<div class="card-body">
                      <div class="mb-3 pb-3 border-bottom border-separator-light">
                        <div class="row g-0 sh-6">
                          <div class="col-auto">
                            <a href="#">
                              <img src="<?= $baseurl ?>/img/siswa.png" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                            </a>
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-center justify-content-between">
                              <div class="d-flex flex-column">
                                <a href="#" class="body-link">UPLOAD SISWA</a>
                                <div class="text-small text-muted"><?= $setting['sekolah'] ?> </div>
                              </div>                              
                              </div>
                            </div>
                          </div>
                        </div>
						<form id="formupload"  class="row g-1">
							 <div class="col-md-12">
						<a href="siswa/M_SISWA_SKL.xlsx" class="btn btn-sm btn-icon btn-link kanan"><i class="material-icons">download</i>FORMAT</a>
						</div>
							
                        <div class="col-md-12">
								<label class="form-label bold">FILE XLSX</label>
                                 <input type='file' name='file' class='form-control' />
						</div>	
						
						<div class="col-md-12">
						<button type="submit" class="btn btn-primary kanan">IMPORT</button>
						</div>
						</form>
						
						 </div>
                      </div>
                    </div>
                  </div>
				  
              
			<script>
    $('#formupload').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/import_siswa.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},			
			success: function(data){  			
			setTimeout(function()
				{
				window.location.replace('?pg=<?= enkripsi("siswa") ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
		
			
			
			
			
		<?php elseif ($ac == enkripsi('edit')) : ?>
          <?php
          $siswa = fetch($koneksi,'siswa',['id_siswa'=>$_GET['ids']]);
		 
			?>
			
			<div class="col-xl-4 mb-6">
			 <h2 class="small-title bold">EDIT SISWA</h2>
			 <div class="card">
				<div class="card-body">
				
                      <div class="mb-3 pb-3 border-bottom border-separator-light">
                        <div class="row g-0 sh-6">
                          <div class="col-auto">
                            <a href="#">
                              <img src="<?= $baseurl ?>/img/user.png" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                            </a>
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-center justify-content-between">
                              <div class="d-flex flex-column">
                                <a href="Doctors.Detail.html" class="body-link">SISWA</a>
                                <div class="text-small text-muted"><?= $user['nama_sekolah'] ?> </div>
                              </div>                              
                              </div>
                            </div>
                          </div>
                        </div>
						<form id='formedit' class="row g-1">
						<input type="hidden" name="ids" value="<?= $siswa['id_siswa'] ?>">
						 <div class="col-md-12">
								<label class="form-label bold">NO PESERTA UJIAN</label>
							<input type='text' name='nopes' value="<?= $siswa['nopes'] ?>" class='form-control' required="true" />
						</div>	
								
									<div class="col-md-6">
									 <label class="bold">NIS</label>
                                       <input type='text' name='nis' value="<?= $siswa['nis'] ?>" class='form-control' required='true'  />
									 </div>
										<div class="col-md-6">
									  <label class="bold">NISN</label>
                                       <input type='text' name='nisn' value="<?= $siswa['nisn'] ?>" class='form-control' required='true'  />
									 </div>
									
									<div class="col-md-12">
								   <label class="bold">Nama Lengkap</label>
                                       <input type='text' name='nama' value="<?= $siswa['nama'] ?>" class='form-control' required='true' />
                                    </div>
									
									<div class="col-md-6">
								    <label class="bold">Jenis Kelamin</label>
                                       <select name="jk" class="form-select" style="width:100%" required >
									   <option value="<?= $siswa['jk'] ?>"><?= $siswa['jk'] ?></option>
									   <option value="">Pilih JK</option>
									  <option value="L">Laki-laki</option>
									  <option value="P">Perempuan</option>									 								 
									  </select>
                                     </div>
									 <div class="col-md-6">
									<label class="bold">Agama</label>
                                      <select class="form-select" name="agama" required="true" style="width: 100%">
									 <option value="<?= $siswa['agama'] ?>"><?= $siswa['agama'] ?></option>
									<option value=''>Pilih Agama</option>
									<option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katholik'>Katholik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Budha'>Budha</option>
									</select>
                                     </div>
									 
									
									<div class="col-md-6">
									 <label class="bold">Kelas</label>
                                      <select name="kelas" class="form-select" style="width:100%" required >
									  <option value="<?= $siswa['kelas'] ?>"><?= $siswa['kelas'] ?></option>
									   <option value="">Pilih Kelas</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa  GROUP BY kelas");
										while ($k = mysqli_fetch_array($kls)) {
										echo "<option value='$k[kelas]'>$k[kelas]</option>";
										}
										?>									 
									  </select>
                                    </div>
									 <div class="col-md-6">
								<label class="form-label bold">TEMPAT LAHIR</label>
							<input type='text' name='tempat' value="<?= $siswa['t_lahir'] ?>" class='form-control' required="true" />
						</div>
							<div class="col-md-12">
								<label class="form-label bold">TGL LAHIR</label>
							<input type='text' name='tgll' value="<?= $siswa['tgl_lahir'] ?>"  class='form-control' placeholder="12 Agustus 2020" required="true" />
						</div>
							<div class="col-md-12">
								<label class="form-label bold">NO WA ( Jika ada )</label>
							<input type='text' name='nowa' value="<?= $siswa['nowa'] ?>" class='form-control'  />
						</div>
									 								
									<div class="col-md-12">
                                    <label class="bold">Foto Jika Ada</label>
									
                                       <input type='file' name='file' class='form-control'/>
                                    </div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">Simpan</button>
										 </div>
										</form>
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
			$('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},			
			success: function(data){  			
			setTimeout(function()
				{
				window.location.replace('?pg=<?= enkripsi("siswa") ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
		
		
		
		
		
		
		
		<?php endif; ?>