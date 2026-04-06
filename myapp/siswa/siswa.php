<?php
defined('APK') or exit('No Access');
?>      
     
	<?php if ($ac == '') : ?>
		<div class="row">
            <div class="col-xl-12">
                <div class="card">
                  <div class="card card-header">                 
					<h5 class="card-title">DATA SISWA AKTIF</h5>
					<?php if($user['level']=='admin'): ?>
					<div class="pull-right">					
						<a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('tambah') ?>" class="btn btn-sm btn-primary kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Peserta"><i class="material-icons">add</i></a>   					 
					</div>
					<?php endif; ?>
				</div>	
						<div class="card-body">
								<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                               <tr style="vertical-align:middle">
                                                   <th>NO</th>
                                                    <th>NIS</th>
                                                    <th>NAMA SISWA</th>
                                                    <th>JK</th>
                                                     <th>ROMBEL</th>
													 <th>USERNAME</th>
													 <th>PASSWORD</th>
													 <th>FOTO</th>
													 <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa order by id_siswa desc"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr style="vertical-align:middle">
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
                                                  <td><?= $data['nama'] ?></td>
                                                  <td><?= $data['jk'] ?></td>
												  <td><?= $data['kelas'] ?></td>
												  <td><?= $data['username'] ?></td>
												  <td><?= $data['password'] ?></td>
												  <td>
												  <?php if($data['foto']==''): ?>
												  <img src="../images/user.png" style="max-width:30px" alt="">
												  <?php else : ?>
												   <img src="../images/fotosiswa/<?= $data['foto'] ?>" style="max-width:30px" alt="">
												  <?php endif; ?>
												  </td>
												    
												    <td>
													 <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('edit') ?>&ids=<?= enkripsi($data['id_siswa']) ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
												<?php if($user['level']=='admin'): ?>
												<button data-id="<?= $data['id_siswa'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
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
								</div>		
								
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
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
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
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
            
          <?php elseif($ac == enkripsi('edit')): ?>
			<?php
			$ids = dekripsi($_GET['ids']);
			$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
			if($siswa['jk']=='L'){
				$kel= 'Laki-laki';
			}else{
				$kel= 'Perempuan';
			}
			?>
			         <div class="row">
                          <div class="col-xl-8">
                             <div class="card">
                               <div class="card card-header"> 
								<h5 class="card-title">EDIT DATA SISWA</h5>
							</div>	
                      <div class="card-body">
					
			         <form id="formedit"  class="row g-3" enctype='multipart/form-data'>
					 <input type='hidden' name='ids' value="<?= $siswa['id_siswa'] ?>" class='form-control' />
						<div class="col-md-12">
								<label class="form-label bold">NAMA LENGKAP</label>
							<input type='text' name='nama' value="<?= $siswa['nama'] ?>" class='form-control' required="true" />
						</div>	   
							   <div class="col-md-4">
								<label class="form-label bold">NIS</label>
							<input type='text' name='nis' value="<?= $siswa['nis'] ?>" class='form-control' required="true" />
						</div>
						<div class="col-md-4">
								<label class="form-label bold">NISN</label>
							<input type='text' name='nisn' value="<?= $siswa['nisn'] ?>" class='form-control' required="true" />
						</div>
						<div class="col-md-4">
								<label class="form-label bold">TINGKAT</label>
						   <select class="form-select" name="level" required style="width: 100%">
							<option value="<?= $siswa['level'] ?>"><?= $siswa['level'] ?></option>
							  
							</select>
						</div>
                    <div class="col-md-4">
								<label class="form-label bold">ROMBEL</label>
						   <select class="form-select" name="kelas" required style="width: 100%">
							<option value="<?= $siswa['kelas'] ?>"><?= $siswa['kelas'] ?></option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
							</select>
						</div>
							<div class="col-md-4">
								<label class="form-label bold">AGAMA</label>
						   <select class="form-select" name="agama" required="true" style="width: 100%">
							<option value="<?= $siswa['agama'] ?>"><?= $siswa['agama'] ?></option>
							   <option value='' disabled>-- Pilih Agama --</option>
							      <option value='Islam'>Islam</option>
								  <option value='Kristen'>Kristen</option>
								   <option value='Katholik'>Katholik</option>
								  <option value='Hindu'>Hindu</option>
								   <option value='Budha'>Budha</option>
								  <option value='Konghucu'>Konghucu</option>
							</select>
						</div>		           
							<div class="col-md-4">
								<label class="form-label bold">JK</label>
						   <select class="form-select" name="jk" required="true" style="width: 100%">
							<option value="<?= $siswa['jk'] ?>"><?= $kel ?></option>
							  <option value='' disabled>-- Pilih JK --</option>
							  <option value='L'>Laki-laki</option>
								  <option value='P'>Perempuan</option>
							</select>
						</div>
						 <div class="col-md-4">
								<label class="form-label bold">JURUSAN</label>
						   <select class="form-select" name="pk" style="width: 100%" required="true">
							<option value="<?= $siswa['jurusan'] ?>"><?= $siswa['jurusan'] ?></option>
							 
							  <?php
										$lev = mysqli_query($koneksi, "SELECT jurusan FROM siswa GROUP BY jurusan");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[jurusan]'>$level[jurusan]</option>";
										}
										?>
							</select>
						</div>		
									<div class="col-md-4">
								<label class="form-label bold">USERNAME</label>
							<input type='text' name='username' value="<?= $siswa['username'] ?>" class='form-control' readonly />
						</div>
                         <div class="col-md-4">
								<label class="form-label bold">PASSWORD</label>
							<input type='text' name='password' value="<?= $siswa['password'] ?>" class='form-control' required="true" />
						</div>	
                        <div class="col-md-6">
								<label class="form-label bold">NO WHATSAPP ( Jika Ada )</label>
                                 <input type='number' name='nowa' value="<?= $siswa['nowa'] ?>" class='form-control' />
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
				window.location.replace("?pg=<?= enkripsi('siswa') ?>");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>
 <?php elseif($ac == enkripsi('tambah')): ?>
			<?php
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$serial = substr(str_shuffle($characters), 0,5);
			
			?>
			 <div class="row">
                          <div class="col-xl-8">
                             <div class="card">
                               <div class="card card-header"> 
								<h5 class="card-title">TAMBAH DATA SISWA</h5>
							</div>	
                      <div class="card-body">
					
			         <form id="formsiswa"  class="row g-3" enctype='multipart/form-data'>
					
						<div class="col-md-12">
								<label class="form-label bold">NAMA LENGKAP</label>
							<input type='text' name='nama'  class='form-control' required="true" />
						</div>	   
							   <div class="col-md-4">
								<label class="form-label bold">NIS</label>
							<input type='text' name='nis'  class='form-control' required="true" />
						</div>
						<div class="col-md-4">
								<label class="form-label bold">NISN</label>
							<input type='text' name='nisn' class='form-control' required="true" />
						</div>
						<div class="col-md-4">
								<label class="form-label bold">TINGKAT</label>
						   <select class="form-select" name="level" required style="width: 100%">
							 <option value=''>-- Pilih Tingkat --</option>
							<?php
										$lev = mysqli_query($koneksi, "SELECT level FROM kelas GROUP BY level");
										while ($lvl = mysqli_fetch_array($lev)) {
										echo "<option value='$lvl[level]'>$lvl[level]</option>";
										}
										?>
							</select>
						</div>
                    <div class="col-md-4">
								<label class="form-label bold">ROMBEL</label>
						   <select class="form-select" name="kelas" required style="width: 100%">
							 <option value=''>-- Pilih Rombel --</option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM kelas GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
							</select>
						</div>
							<div class="col-md-4">
								<label class="form-label bold">AGAMA</label>
						   <select class="form-select" name="agama" required="true" style="width: 100%">
							
							   <option value=''>-- Pilih Agama --</option>
							      <option value='Islam'>Islam</option>
								  <option value='Kristen'>Kristen</option>
								   <option value='Katholik'>Katholik</option>
								  <option value='Hindu'>Hindu</option>
								   <option value='Budha'>Budha</option>
								  <option value='Konghucu'>Konghucu</option>
							</select>
						</div>		           
							<div class="col-md-4">
								<label class="form-label bold">JK</label>
						   <select class="form-select" name="jk" required="true" style="width: 100%">
							
							  <option value=''>-- Pilih JK --</option>
							  <option value='L'>Laki-laki</option>
								  <option value='P'>Perempuan</option>
							</select>
						</div>
						 <div class="col-md-4">
								<label class="form-label bold">JURUSAN</label>
						   <select class="form-select" name="pk" style="width: 100%" required="true">
							 <option value=''>-- Pilih Jurusan --</option>
							  <?php
										$lev = mysqli_query($koneksi, "SELECT jurusan FROM siswa GROUP BY jurusan");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[jurusan]'>$level[jurusan]</option>";
										}
										?>
							</select>
						</div>		
									<div class="col-md-4">
								<label class="form-label bold">USERNAME</label>
							<input type='text' name='username' value="<?= $serial ?>" class='form-control' readonly />
						</div>
                         <div class="col-md-4">
								<label class="form-label bold">PASSWORD</label>
							<input type='text' name='password' value="<?= $serial ?>" class='form-control' required="true" />
						</div>	
                        <div class="col-md-6">
								<label class="form-label bold">NO WHATSAPP ( Jika Ada )</label>
                                 <input type='number' name='nowa'  class='form-control' />
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
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace("?pg=<?= enkripsi('siswa') ?>");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	

 <?php elseif($ac == enkripsi('upload')): ?>
		  <div class="row">					  
           <div class='col-md-8'>
            <div class="card">
                  <div id="menu-sandik2">
					<a href="#" class="logomu"><h5 class="card-title">FOTO SISWA</h5></a>
				</div>
                  <div class="card-body">
				  <div class='row'>
        <?php
        $ektensi = ['jpg', 'png', 'JPG', 'PNG', 'JPEG', 'jpeg'];
        $folder = "../images/fotosiswa/"; 
        if (!($buka_folder = opendir($folder))) die("eRorr... Tidak bisa membuka Folder");
        $file_array = array();
        while ($baca_folder = readdir($buka_folder)) :
            $file_array[] = $baca_folder;
        endwhile;
        $jumlah_array = count($file_array);
        for ($i = 2; $i < $jumlah_array; $i++) :
            $nama_file = $file_array;
            $nomor = $i - 1;
            $ext = explode('.', $nama_file[$i]);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) { ?>
               
				<div class="avatar avatar-xxl status status-online">
					<img src="<?= $folder.$nama_file[$i] ?>" alt="">&nbsp;&nbsp;
					</div>
                            
				<?php  } ?>
			<?php endfor;
        closedir($buka_folder);
        ?>
					</div>
				</div>
          </div>
      </div>

<div class="col-md-4">
     <div class="card">
       <div id="menu-sandik2">
		<a href="#" class="logomu"><h5 class="card-title">UPLOAD FOTO</h5></a>
			</div>
		  <div class="card-body">
			<p>
			   <form id='formfoto' >	
                   <label>Pilih File Zip</label>
	              <div class="input-group mb-3">
                     <input type='file' name='file' class='form-control' required='true' />
					<span class="input-group-text">
						<button type="submit" class="btn btn-success"><i class="material-icons">upload</i></button>
							</span>
                               </div>	
							</form>
							</div>		 
						</div>
					</div>
				</div>		
             </div>			 
   <script>
    $('#formfoto').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
            url: 'siswa/tfoto.php',
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
 <?php elseif($ac == 'login'): ?>
			<?php
			$idu = $_GET['idu'];
			$uji = fetch($koneksi,'ujian',['id_ujian'=>$idu]);
			$sesi = $uji['sesi'];
			$level = $uji['level'];
			$pk = $uji['pk'];
			?>
              <div class="row">
                  <div class="col-md-8">
                    <div class="card">
						  <div class="card card-header">	
					<h5 class="card-title">PESERTA BELUM LOGIN <span class="badge badge-primary">MAPEL <?= $uji['nama'] ?> </span> <span class="badge badge-danger">SESI <?= $uji['sesi'] ?> </span></h5></a>
					</div>
							<div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NO PESERTA</th>
                                                    <th>NAMA PESERTA</th>
                                                    <th>ROMBEL</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											if($pk=='semua'):
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE NOT EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]') and sesi='$sesi' and level='$level'");
											 else:
											 $query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE NOT EXISTS(SELECT * FROM nilai WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_ujian='$_GET[idu]') and sesi='$sesi' and level='$level' and jurusan='$pk'");
											 endif;
											 while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nopes'] ?></td>
                                                     <td><?= $data['nama'] ?></td>
                                                    <td><?= $data['kelas'] ?></td>
                                                   
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
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
										
		<?php elseif($ac == enkripsi('alumni')): ?>
		<div class="row">
            <div class="col-xl-8">
                <div class="card">
                  <div class="card card-header">                 
					<h5 class="card-title">DATA SISWA <?= strtoupper($_GET['ket']) ?></h5>
						</div>	
						<div class="card-body">
								<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                               <tr style="vertical-align:middle">
                                                   <th>NO</th>
                                                    <th>NIS</th>
                                                    <th>NAMA SISWA</th>
                                                    <th>JK</th>
                                                     <th>ROMBEL</th>
													 <th>TGL MUTASI</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM alumni WHERE ket='$_GET[ket]' order by id_siswa desc"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											$no++;
											   ?>
                                                <tr style="vertical-align:middle">
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
                                                  <td><?= $data['nama'] ?></td>
                                                  <td><?= $data['jk'] ?></td>
												  <td><?= $data['kelas'] ?></td>
												  <td><?= $data['tgl_mutasi'] ?></td>
												  
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
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
        <?php endif; ?>		 