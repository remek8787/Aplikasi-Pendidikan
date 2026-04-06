
<?php
defined('APK') or exit('No Access');
?>           
	<?php if ($ac == '') : ?>
	<div class="row">
		<div class="col-xl-12 mb-2">		
           <div class="card">
			<div class="card card-header">
				<h5 class="card-title">BANK SOAL </h5>
				<div class="pull-right">
				<a href="?pg=<?= enkripsi('banksoal') ?>&ac=tambah" class="btn btn-sm btn-primary kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat Bank Soal"><i class="material-icons">add</i></a>   
             </div>
			    </div>
									
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
												<tr style="vertical-align:middle">
												<th>NO</th>
												<th>KODE</th>
												<th>TINGKAT</th>
												<th>PEMBUAT SOAL</th>
												<th>JUMLAH</th>
												<th>FILE ZIP</th>
												<th>ACTION</th>
												</tr>
                                            <tbody>
											<?php 
											  if ($user['level'] == 'admin') :
											 $Q = mysqli_query($koneksi, "SELECT * FROM banksoal");
											  elseif ($user['level'] == 'guru') :
											   $Q = mysqli_query($koneksi, "SELECT * FROM banksoal WHERE idguru='$user[id_user]'");
												endif;
											 
											 ?>
											   <?php while ($bank = mysqli_fetch_array($Q)) : ?>
												<?php
											    $guru = fetch($koneksi,'users',['id_user' => $bank['idguru']]);	
											    $jumlahsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$bank[id_bank]'"));			   
												$directory = '../';
												$files = glob($directory .$bank['id_bank']. '.zip');

												if ( $files !== false )
												{
													$filecount = count( $files );
													$jfile = $filecount;
													
												}
												else
												{
													$jfile = 0;
													
												}
												$no++;
												?>
												<tr style="vertical-align:middle">
												 <td><?= $no ?></td>
												 <td><?= $bank['kode'] ?></td>
												 <td>												  
													 <h5><span class="badge badge-primary"><?= $bank['level'] ?></span>  <span class="badge badge-dark"><?= $bank['pk'] ?></span> <span class="badge badge-danger"><?= $bank['paket'] ?></span></h5>												 
												 </td>
												
												 <td><?= $guru['nama'] ?></td>		
												  <td><?= $jumlahsoal ?> soal - <?= $bank['groupsoal'] ?></td>
												   <td>
												  <?php if($jfile==0){ ?>
												  <b style="color: red;">Zip Belum dibuat</b>
												  <?php }else{ ?>
												   <b style="color: blue;">Zip Sudah dibuat</b>
												  <?php } ?>
												  </td>	
												 <td style="text-align:center">
												  <a href="?pg=<?= $pg ?>&ac=lihat&id=<?= $bank['id_bank'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Input"><i class="material-icons">search</i></button></a>
												   
												   <a href="?pg=<?= enkripsi('banksoal') ?>&ac=<?= enkripsi('impor') ?>&id=<?= $bank['id_bank'] ?>"> <button class='btn btn-sm btn-info' data-bs-toggle="tooltip" data-bs-placement="top" title="Import"><i class="material-icons">upload</i></button></a>
												  
												  <a href="?pg=<?= enkripsi('banksoal') ?>&ac=edit&id=<?= enkripsi($bank['id_bank']) ?>"> <button class='btn btn-sm btn-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<button data-id="<?= $bank['id_bank'] ?>" class="hapus btn-sm btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
													<?php if($jfile==0){ ?>
													<button data-idzip="<?= $bank['id_bank'] ?>" class="zip btn-sm btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat File Zip"><i class="fa fa-plus"></i> ZIP</button>
													<?php }else{ ?>
													<button data-idz="<?= $bank['id_bank'] ?>"  class="busek btn-sm btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus File Zip"><i class="fa fa-trash"></i> ZIP</button>
													<?php } ?>
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
							</div>	
							<script>
				$('#datatable1').on('click', '.hapus', function() {
						var id = $(this).data('id');
						console.log(id);
						Swal.fire({
							title: 'Are you sure?',
							text: 'Akan menghapus data ini!',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes'
						}).then((result) => {
							if (result.value) {
								$.ajax({
									url: 'bank/tbanksoal.php?pg=hapus',
									method: "POST",
									data: 'id=' + id,
									success: function(data) {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									}, 500);
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
				$('#datatable1').on('click', '.zip', function() {
						var idzip = $(this).data('idzip');
						console.log(idzip);
						swal({
							title: 'Buat File Zip',
							text: 'Pastikan Input Soal ini Sudah Selesai',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes'
						}).then((result) => {
							if (result.value) {
								$.ajax({
									url: 'bank/proseszip.php',
									method: "POST",
									data: 'idzip=' + idzip,
									success: function(data) {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
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
					<script>
				$('#datatable1').on('click', '.busek', function() {
						var idz = $(this).data('idz');
						console.log(idz);
						swal({
							title: 'Hapus Zip ?',
							text: 'Akan menghapus File Zip ini!',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes'
						}).then((result) => {
							if (result.value) {
								$.ajax({
									url: 'bank/hapuszip.php',
									method: "POST",
									data: 'idz=' + idz,
									success: function(data) {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
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
					
					
		<?php elseif ($ac == 'tambah') : ?>					
			
			<div class="row">          
				<div class="col-xl-8 mb-2">
                   <div class="card">
				    <div class="card card-header">
						<h5 class="card-title">INPUT BANK SOAL </h5>
						</div> 
                    <div class="card-body">
						<form id='formbank' class="row g-2">                         
                            <div class="col-md-6">
								<label class="bold"> Model Soal</label>
								<select class="form-select" name="model" id="model" required style="width: 100%">
								<option value=''>Pilih Model Soal</option>
								<option value='1'>MODEL AKM</option>
								<option value='2'>MODEL NON AKM</option>
								</select>
							</div>	
							<div class="col-md-6">
								<label class="bold">Paket Soal</label>
								<select class="form-select" name="paket" required style="width: 100%">
								<option value=''>Pilih Paket Soal</option>
								  <option value='A'>Paket A</option>
								  <option value='B'>Paket B</option>
								  <option value='C'>Paket C</option>
								  </select>
							</div>		 
							<div class="col-md-6">								 
								<label class="bold">Tingkat</label>
								<select name='level' id='level' class='form-select' required='true' style="width: 100%">
								    <option value=''>Pilih Tingkat</option>
										<?php
										$lev = mysqli_query($koneksi, "SELECT level FROM siswa GROUP BY level");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[level]'>$level[level]</option>";
										}
										?>
									 </select>
							</div>
							<div class="col-md-6">								 
								<label class="bold">Jurusan</label>
								<select name='pk' id="pk" class='form-select' required='true' style="width: 100%">
								</select>
							</div>
							
							<div class="col-md-4">
								<label class="bold">Kode Bank</label>
								<input type="text" name="kode" class="form-control" required="true">
							</div>
							<div class="col-md-8">
								<label class="bold">Mata Pelajaran</label>
								<select name='mapel' class='form-select' required='true' style="width: 100%">
								    <option value=''>Pilih Mapel</option>									
									<?php
			
									$mpl = mysqli_query($koneksi, "SELECT * FROM mapel");
									
									while ($map = mysqli_fetch_array($mpl)) :
									echo "<option value='$map[kode]'>$map[nama_mapel]</option>";
										endwhile;
										?>
								</select>
							</div>	
							
							<div class="col-md-12">
								<label class="bold">Guru Pengampu</label>
								<select name="guru" class='form-select' required='true' style="width: 100%">
									<?php
										if($user['level']=='admin'){
										$guruku = mysqli_query($koneksi, "SELECT * FROM users where level='guru' order by nama asc");
										}else{
										$guruku = mysqli_query($koneksi, "SELECT * FROM users where id_user='$user[id_user]'");
										}
										echo "<option value=''>Pilih Guru Pengampu</option>";
										while ($guru = mysqli_fetch_array($guruku)) {
										echo "<option value='$guru[id_user]'>$guru[nama]</option>";
										}
										?>
								</select>
							</div>
							
							<div class="col-md-6">
								<label class="bold">Status Soal</label>
								<select name='status' class='form-select' required='true' style="width: 100%">
									<option value='1'>Aktif</option>
									<option value='0'>Non Aktif</option>
								</select>
							</div>
							
							<div class='col-md-6'>
                                <label class="boldl">Soal Agama</label>
                                <select name='agama' class='form-select' style="width: 100%">
                                    <option value=''>Bukan Soal Agama</option>                    
                                    <option value='Islam'>Islam</option>
									<option value='Kristen'>Kristen</option>
									<option value='Katolik'>Katholik</option>
									<option value='Hindu'>Hindu</option>
									<option value='Budha'>Budha</option>
								</select>						
                            </div>
															
							<div class="col-md-6">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkme">
                                    <label class="form-check-label" for="checkme">
                                        Saya Setuju
                                    </label>
                                </div>
                            </div>
							
                            <div class="col-md-6">
                                <button type="submit"  id="blo1" class="btn btn-primary kanan" disabled="disabled">Simpan</button>
                            </div>					
					</form>
					</div>
				</div>	
			</div>
	  <script>	
		$("#level").change(function() {
		var level = $(this).val();
		console.log(level);
		$.ajax({
		type: "POST",
		url: "data/ambildata.php?pg=jurusan", 
		data: "level=" + level, 
	    success: function(response) { 
		$("#pk").html(response);
				}
			});
		});
		
		</script>
<script>
	
	$('#formbank').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',		
            url: 'bank/tbanksoal.php?pg=tambah',
            enctype: 'multipart/form-data',
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
         if (data == 'OK') {		
            setTimeout(function()
            {
                window.location.replace('?pg=<?= enkripsi(banksoal) ?>');
            }, 2000);
             } else {
			 iziToast.warning(
            {
                title: 'Gagal!',
                message: 'Kode Bank Soal sudah digunakan',
				titleColor: '#FFFF00',
				messageColor: '#fff',
				backgroundColor: '#8b0000',
				 progressBarColor: '#FFFF00',
                  position: 'topRight'
            });
            setTimeout(function(){
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
			
       
<?php elseif ($ac == 'edit'): ?>
<?php
$id = dekripsi($_GET['id']);
$bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id'"));
$mpl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kode='$bank[nama]'"));
$guruQ = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$bank[idguru]'"));
  ?>
 
          <div class="row">          
				<div class="col-md-8">
                   <div class="card">
                          <div class="card-body">
						<form id='formeditbank' class="row g-2"> 
							 <input type="hidden" name="idm" value="<?= $id ?>" >
                               <div class="col-md-6">
								<label class="bold">Kode Bank</label>
								<input type="text" name="kode" class="form-control" value="<?= $bank['kode'] ?>" required="true" >
								</div>
								 
								<div class="col-md-6">								 
								<label class="bold">Tingkat</label>
								<select name='level' id='level' class='form-select' required='true' style="width: 100%">
								  <option value="<?= $bank['level'] ?>" selected><?= $bank['level'] ?></option>
								  
										<?php
										$lev = mysqli_query($koneksi, "SELECT * FROM level");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[level]'>$level[level]</option>";
										}
										?>
									 </select>
							</div>
							
						
							
							<div class="col-md-12">
								<label class="bold">Mata Pelajaran</label>
								<select name='mapel' id='mapel' class='form-select' required='true' style="width: 100%">
								   <option value="<?= $bank['nama'] ?>"><?= $mpl['nama_mapel'] ?></option>
									<?php
									$mpl = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY nama_mapel ASC");
									while ($pl = mysqli_fetch_array($mpl)) {
										echo "<option value='$pl[kode]'>$pl[nama_mapel]</option>";
											}
										?>
											</select>
							</div>
							
							<div class="col-md-12">
								<label class="bold">Guru Pengampu</label>
								<select name="guru" class='form-select' required='true' style="width: 100%">
									<option value="<?= $bank['idguru'] ?>" selected><?= $guruQ['nama'] ?></option>
							 <?php
								if($user['level']=='admin'){
									$guruku = mysqli_query($koneksi, "SELECT * FROM users where level='guru' order by nama asc");
									}else{
									$guruku = mysqli_query($koneksi, "SELECT * FROM users where id_user='$user[id_user]'");
									}
								echo "<option value=''>Pilih Guru Pengampu</option>";
								while ($guru = mysqli_fetch_array($guruku)) {
									echo "<option value='$guru[id_user]'>$guru[nama]</option>";
										}
										?>
										</select>
									
							</div>
							<div class="col-md-6">
								<label class="bold">Status Soal</label>
								<select name='status' class='form-select' required='true' style="width: 100%">
								  <option value='1'>Aktif</option>
									<option value='0'>Non Aktif</option>
									</select>
										</div>
							       <div class='col-md-6'>
                                      <label class="boldl">Soal Agama</label>
                                          <select name='agama' class='form-select' style="width: 100%">
                                           <option value="<?= $bank['soal_agama'] ?>"><?= $bank['soal_agama'] ?></option>
                                              <option value=''>Bukan Soal Agama</option>
											 <?php
                                                $agam = mysqli_query($koneksi, "SELECT agama FROM siswa group by agama");
                                                   while ($agama = mysqli_fetch_array($agam)) : ($agama['agama'] == $mapel['soal_agama']) ? $s = 'selected' : $s = '';
                                                       echo "<option value='" . $agama['agama'] . "' $s>$agama[agama]</option>";
                                                           endwhile;
                                                                 ?>
                                                                    </select>						
                                                               </div>
															   <p>
													 <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkme">
                                                            <label class="form-check-label" for="checkme">
                                                                Saya Setuju
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit"  id="blo1" class="btn btn-primary kanan" disabled="disabled">Simpan</button>
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
	
	$('#formeditbank').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
            url: 'bank/tbanksoal.php?pg=ubah',
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
			 success: function(data){   
         if (data == 'OK') {		
            
            setTimeout(function()
            {
                window.location.replace('?pg=<?= enkripsi(banksoal) ?>');
            }, 2000);
             } else {
			 iziToast.warning(
            {
                title: 'Gagal!',
                message: 'Kode Bank Soal sudah digunakan',
				titleColor: '#FFFF00',
				messageColor: '#fff',
				backgroundColor: '#8b0000',
				 progressBarColor: '#FFFF00',
                  position: 'topRight'
            });
            setTimeout(function(){
                window.location.reload();
            }, 2000);	
           }			
        }
    });
    return false;
	});
</script>	


	<?php elseif ($ac == enkripsi('impor')): ?>
    <?php include "bank/import.php"; ?>
    <?php elseif ($ac == 'pg'): ?>
    <?php include 'bank/input_soal.php'; ?>
	<?php elseif ($ac == 'multi'): ?>
    <?php include 'bank/input_soal2.php'; ?>
	<?php elseif ($ac == 'bs'): ?>
    <?php include 'bank/input_soal3.php'; ?>
	<?php elseif ($ac == 'urut'): ?>
    <?php include 'bank/input_soal4.php'; ?>
	<?php elseif ($ac == 'lihat'): ?>

    <?php
    $id_bank = $_GET['id'];
   if (isset($_REQUEST['tambah'])) {
        $sip = $_SERVER['SERVER_NAME'];
        $smax = mysqli_query($koneksi, "SELECT max(qid) AS maxi FROM savsoft_qbank");
        while ($hmax = mysqli_fetch_array($smax)) :
            $jumsoal = $hmax['maxi'];
        endwhile;
        $smaop = mysqli_query($koneksi, "SELECT max(oid) AS maxop FROM savsoft_options");
        while ($hmaop = mysqli_fetch_array($smaop)) {
            $jumop = $hmaop['maxop'];
        }

        $b_op = ($jumop != 0) ? ($jumop / $jumsoal) : 0;
        $no = 1;
        $sqlcek = mysqli_query($koneksi, "SELECT * FROM savsoft_qbank");
        while ($r = mysqli_fetch_array($sqlcek)) {
            $s_soal = mysqli_fetch_array(mysqli_query($koneksi, "select * from savsoft_qbank where qid='$no'"));
            $soal_tanya = $s_soal['question'];
            $l_soal = $s_soal['lid'];
            $c_id = $s_soal['cid'];
            $g_soal = $s_soal['description'];
            $g_soal = str_replace(" ", "", $g_soal);
            $smin = mysqli_query($koneksi, " select min(oid) as mini from savsoft_options where qid='$no'");
            while ($hmin = mysqli_fetch_array($smin)) {
                $min_op = $hmin['mini'];
            }
            $sqlopc = mysqli_query($koneksi, " select * from savsoft_options where qid='$no' and oid='$min_op'");
            $ropc = mysqli_fetch_array($sqlopc);
            $opj1 = $ropc['q_option'];
            $opj1 = str_replace(" &ndash;", "-", $opj1);
            $opjs1 = $ropc['score'];
            $fileA = $ropc['q_option_match'];
            $fileA = str_replace(" ", "", $fileA);

            $dele = mysqli_query($koneksi, "DELETE FROM savsoft_options WHERE qid='$no' AND oid='$min_op'");

            $smin = mysqli_query($koneksi, " select min(oid) as mini from savsoft_options where qid='$no'");
            while ($hmin = mysqli_fetch_array($smin)) {
                $min_op = $hmin['mini'];
            }

            $sqlopc = mysqli_query($koneksi, " select * from savsoft_options where qid='$no' and oid='$min_op'");
            $rubah = mysqli_query($koneksi, " select * from savsoft_options where qid='$no'");
            $ck_jum = mysqli_num_rows($rubah);

            $ropc = mysqli_fetch_array($sqlopc);
            $opj2 = $ropc['q_option'];
            $opj2 = str_replace(" &ndash;", "-", $opj2);
            $opjs2 = $ropc['score'];
            $fileB = $ropc['q_option_match'];
            $fileB = str_replace(" ", "", $fileB);
            $dele = mysqli_query($koneksi, " delete from savsoft_options where qid='$no' and oid='$min_op'");
            $smin = mysqli_query($koneksi, " select min(oid) as mini from savsoft_options where qid='$no'");
            while ($hmin = mysqli_fetch_array($smin)) {
                $min_op = $hmin['mini'];
            }
            $sqlopc = mysqli_query($koneksi, " select * from savsoft_options where qid='$no' and oid='$min_op'");
            $ropc = mysqli_fetch_array($sqlopc);
            $opj3 = $ropc['q_option'];
            $opj3 = str_replace(" &ndash;", "-", $opj3);
            $opjs3 = $ropc['score'];
            $fileC = $ropc['q_option_match'];
            $fileC = str_replace(" ", "", $fileC);
            $dele = mysqli_query($koneksi, " delete from savsoft_options where qid='$no' and oid='$min_op'");
            $smin = mysqli_query($koneksi, " select min(oid) as mini from savsoft_options where qid='$no'");
            while ($hmin = mysqli_fetch_array($smin)) {
                $min_op = $hmin['mini'];
            }

            $sqlopc = mysqli_query($koneksi, " select * from savsoft_options where qid='$no' and oid='$min_op'");
            $ropc = mysqli_fetch_array($sqlopc);
            $opj4 = $ropc['q_option'];
            $opj4 = str_replace(" &ndash;", "-", $opj4);
            $opjs4 = $ropc['score'];
            $fileD = $ropc['q_option_match'];
            $fileD = str_replace(" ", "", $fileD);
            $dele = mysqli_query($koneksi, " delete from savsoft_options where qid='$no' and oid='$min_op'");
            $smin = mysqli_query($koneksi, " select min(oid) as mini from savsoft_options where qid='$no'");
            while ($hmin = mysqli_fetch_array($smin)) {
                $min_op = $hmin['mini'];
            }

            $sqlopc = mysqli_query($koneksi, " select * from savsoft_options where qid='$no' and oid='$min_op'");
            $ropc = mysqli_fetch_array($sqlopc);
            $opj5 = $ropc['q_option'];
            $opj5 = str_replace(" &ndash;", "-", $opj5);
            $opjs5 = $ropc['score'];
            $fileE = $ropc['q_option_match'];
            $fileE = str_replace(" ", "", $fileE);
            $dele = mysqli_query($koneksi, " delete from savsoft_options where qid='$no' and oid='$min_op'");
            if ($opjs1 == 1) {
                $kunci = "A";
            }
            if ($opjs2 == 1) {
                $kunci = "B";
            }
            if ($opjs3 == 1) {
                $kunci = "C";
            }
            if ($opjs4 == 1) {
                $kunci = "D";
            }
            if ($opjs5 == 1) {
                $kunci = "E";
            }
			
			
            if ($ck_jum !== 0) {
                $jns = "1";
				$skor = "1";
            }
            if ($ck_jum == 0) {
                $jns = "2";
				$skor = "5";
            }
            
            $soal_tanya2 = str_replace("&amp;lt;", "<", $soal_tanya);         
            $soal_tanya = str_replace("&amp;gt;", ">", $soal_tanya2);
           
			if ($jns == '1') {
			 $koneksi->query("INSERT INTO soal (id_bank,nomor,soal,pilA,pilB,pilC,pilD,pilE,jawaban,jenis,file1,fileA,fileB,fileC,fileD,fileE,max_skor) VALUES ('$id_bank','$no','$soal_tanya','$opj1','$opj2','$opj3','$opj4','$opj5','$kunci','$jns','$g_soal','$fileA','$fileB','$fileC','$fileD','$fileE','$skor')");
            $idsoal = $koneksi->insert_id;
			$idjawab = $idsoal.'.1';
			mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$kunci','$id_bank','$idsoal','$idjawab','$skor')");
			}
			if ($jns == '2') {
				$jawabna = strtolower($opj1);
				$jawabna = ltrim($jawabna,' ');
			 $koneksi->query("INSERT INTO soal (id_bank,nomor,soal,jawaban,jenis,file1,fileA,fileB,fileC,fileD,fileE,max_skor) VALUES ('$id_bank','$no','$soal_tanya','$jawabna','$jns','$g_soal','$fileA','$fileB','$fileC','$fileD','$fileE','$skor')");
            $idsoal = $koneksi->insert_id;
			$idjawab = $idsoal.'.1';
			mysqli_query($koneksi,"INSERT INTO kunci_soal(jawaban,id_bank,id_soal,id_jawab,skor) VALUES ('$jawabna','$id_bank','$idsoal','$idjawab','$skor')");
			}
			
			if ($g_soal <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$g_soal','$id_bank')");
            }
            if ($fileA <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$fileA','$id_bank')");
            }
            if ($fileB <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$fileB','$id_bank')");
            }
            if ($fileC <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$fileC','$id_bank')");
            }
            if ($fileD <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$fileD','$id_bank')");
            }
            if ($fileE <> "") {
                $file = mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_bank) values ('$fileE','$id_bank')");
            }
            $no++;
        }
         mysqli_query($koneksi, "TRUNCATE TABLE savsoft_qbank");
         mysqli_query($koneksi, "TRUNCATE TABLE savsoft_options");
    }
    $namamapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id_bank'"));
    if ($namamapel['jml_esai'] == 0) {
        $hide = 'hidden';
    } else {
        $hide = '';
    }
    if ($namamapel['jml_soal'] == 0) {
        $hidex = 'hidden';
    } else {
        $hidex = '';
    }
    ?>

			<?php $mode = fetch($koneksi, 'banksoal', ['id_bank' => $id_bank]); 
			
			?>
         <div class="row">          
				<div class="col-md-12">
                   <div class="card">
                     <div class="card-header">
                       <div class="col-md-4">
							<div class="form-group">
							<select  onChange="document.location.href=this.options[this.selectedIndex].value;" class="form-select">
								<option value="0">-- PILIH SOAL -- </option>

								<option value="?pg=<?= $pg ?>&ac=pg&id=<?= $mode['id_bank'] ?>&jenis=1">Pilihan Ganda</option>
								 <option value="?pg=<?= $pg ?>&ac=pg&id=<?= $mode['id_bank'] ?>&jenis=2">Uraian Singkat</option>
								 <?php if($mode['model']==1){ ?>
								 <option value="?pg=<?= $pg ?>&ac=multi&id=<?= $mode['id_bank'] ?>&jenis=3">PG Multi Choice</option>
								 <option value="?pg=<?= $pg ?>&ac=bs&id=<?= $mode['id_bank'] ?>&jenis=4">Benar Salah</option>
								 <option value="?pg=<?= $pg ?>&ac=urut&id=<?= $mode['id_bank'] ?>&jenis=5">Menjodohkan</option>
									 
								 <?php } ?>
							    </select>

                                </div>
                            </div>
						<div class="pull-right">
							<a href="?pg=<?= enkripsi('banksoal') ?>" class="btn btn-sm btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali"><i class="material-icons">arrow_back</i></a>
							<button class='btn btn-sm btn-primary ' onclick="frames['frameresult'].print()" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak"><i class="material-icons">print</i></button>
                        <iframe name='frameresult' src='bank/cetaksoal.php?id=<?= $id_bank ?>' style='border:none;width:1px;height:1px;'></iframe>
					   <button id="btnreset" data-id="<?= $id_bank ?>" class='btn btn-sm btn-danger' data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
									
									</div>
								</div>
							</div>
						</div>
					</div>
					 <div class="row">          
				<div class="col-md-12">
                   <div class="card">
					
					<div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                       <button class="nav-link active" id="pills-PG-tab" data-bs-toggle="pill" data-bs-target="#pills-PG" type="button" role="tab" aria-controls="pills-PG" aria-selected="true">PG</button>
                          </li>
						   <?php if($mode['model']==1){ ?>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-MULTI-tab" data-bs-toggle="pill" data-bs-target="#pills-MULTI" type="button" role="tab" aria-controls="pills-MULTI" aria-selected="false">PG MULTI</button>
                          </li>
                      <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-BS-tab" data-bs-toggle="pill" data-bs-target="#pills-BS" type="button" role="tab" aria-controls="pills-BS" aria-selected="false">BENAR SALAH</button>
                          </li>
						  
						 <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-JODOH-tab" data-bs-toggle="pill" data-bs-target="#pills-JODOH" type="button" role="tab" aria-controls="pills-JODOH" aria-selected="false">MENJODOHKAN</button>
                          </li>  
						   <?php } ?>
						  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-RSAI-tab" data-bs-toggle="pill" data-bs-target="#pills-ESAI" type="button" role="tab" aria-controls="pills-ESAI" aria-selected="false">ESAI</button>
                          </li> 
                           </ul>       
				<div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade active show" id="pills-PG" role="tabpanel" aria-labelledby="pills-PG-tab">
                     <div class='table-responsive'>
                                    <table id="tabelPG" class='table'>
                                        <tbody>
										<?php $no=0; ?>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank' AND jenis='1' order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
												<?php $no++; ?>
                                                <tr>
                                                    <td style='width:30px;text-align:center'>
                                                        <?= $no ?>
														<br><br>
														<button data-id="<?= $soal['id_soal'] ?>" class="hapus btn-sm btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
                                                    <br>
													 <?php if($soal['jenis']==1){ ?>
													<a href="?pg=<?= enkripsi('editsoal1') ?>&id_soal=<?php echo $soal['id_soal'] ?>"><button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<?php } ?>
													</td>
													 
                                                    <td style="text-align:justify">
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
                                                        <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														
                                                        <table width="100%" >
                                                            <tr>
															<?php if ($soal['pilA'] <> '') : ?>
                                                                <td style="width:8%;vertical-align:top;">A.<input type="radio" name="radio<?= $soal['id_soal'] ?>" <?php if($soal['jawaban']=='A'){echo "checked"; } ?>></td>
                                                                <td style="width:46%;vertical-align:top;">
                                                                    <?php
                                                                    if ($soal['pilA'] <> '') {
                                                                        echo "$soal[pilA] ";
                                                                    }

                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																<?php endif; ?>
																<?php if ($soal[pilC] <>'' ) : ?>
                                                                <td style="width:8%;vertical-align:top;">C.<input type="radio" name="radio<?= $soal['id_soal'] ?>" <?php if($soal['jawaban']=='C'){echo "checked"; } ?>></td>
                                                                <td style="width:46%;vertical-align:top;">
                                                                    <?php
                                                                    if (!$soal['pilC'] == "") {
                                                                        echo "$soal[pilC] ";
                                                                    }

                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileC]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																 <?php endif; ?>
                                                                

                                                            </tr>

                                                            <tr>
															 <?php if ($soal['pilB'] <>'') : ?>
                                                                <td style="width:8%;vertical-align:top;">B.<input type="radio" name="radio<?= $soal['id_soal'] ?>" <?php if($soal['jawaban']=='B'){echo "checked"; } ?>></td>
                                                                <td style="width:46%;vertical-align:top;">
                                                                    <?php
                                                                    if (!$soal['pilB'] == "") {
                                                                        echo "$soal[pilB] ";
                                                                    }

                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileB]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
																<?php endif; ?>
                                                                <?php if ($soal['pilD'] <>'') : ?>
                                                                    <td style="vertical-align:top;">D.<input type="radio" name="radio<?= $soal['id_soal'] ?>" <?php if($soal['jawaban']=='D'){echo "checked"; } ?>></td>
                                                                    <td style="vertical-align:top;">
                                                                        <?php
                                                                        if (!$soal['pilD'] == "") {
                                                                            echo "$soal[pilD] ";
                                                                        }

                                                                        if ($soal['fileD'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileD']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$baseurl/files/$soal[fileD]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                <?php endif; ?>
																</tr>
															<?php if ($soal['pilE'] <>'') : ?>
															<tr>
                                                                    <td style="vertical-align:top;">E.<input type="radio" name="radio<?= $soal['id_soal'] ?>" <?php if($soal['jawaban']=='E'){echo "checked"; } ?>></td>
                                                                    <td style="vertical-align:top;">
                                                                        <?php
                                                                        if (!$soal['pilE'] == "") {
                                                                            echo "$soal[pilE] ";
                                                                        }

                                                                        if ($soal['fileE'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileE']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$baseurl/files/$soal[fileE]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
																	</tr>
                                                                <?php endif; ?>
                                                        </table>														
														<b> Skor Max : </b> <?= $soal['max_skor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;
														<b> Kunci : </b> <?= $soal['jawaban'] ?> 
                                                       </tr>
                                                
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
									</div>
                                 </div>
				  
                        <div class="tab-pane fade" id="pills-MULTI" role="tabpanel" aria-labelledby="pills-MULTI-tab">
                      <div class='table-responsive'>
                                    <table id="tabelMULTI" class='table  '>
                                        <tbody>
										<?php $no=0; ?>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank' AND jenis='3' order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
												  <?php $checked = explode(', ',$soal['jawaban']); ?>
												<?php $no++; ?>
                                                <tr>
                                                    <td style='width:30px;text-align:center'>
                                                        <?= $no ?>
														<br><br>
														<button data-id="<?= $soal['id_soal'] ?>" class="hapus btn-sm btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
                                                    <br>
													<?php if($soal['jenis']==3){ ?>
													<a href="?pg=<?= enkripsi('editsoal3') ?>&id_soal=<?php echo $soal['id_soal'] ?>"><button class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<?php } ?>
													</td>
													
                                                    <td style="text-align:justify">
													
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														
                                                       <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														<table width="100%">
                                                            <tr>
															<?php if ($soal['pilA'] <>'') : ?>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">A.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>" <?php in_array ('A', $checked) ? print 'checked' : ''; ?>></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;">
															  <?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															 <?= $soal['pilA'] ?>
															 </td>
															 <?php endif; ?>
															 <?php if ($soal['pilB'] <>'') : ?>
															<td style="padding: 3px;width: 2%; vertical-align: text-top;">B.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>" <?php in_array ('B', $checked) ? print 'checked' : ''; ?>></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;">
															 <?php
                                                                    
                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileB]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															 <?= $soal['pilB'] ?>
															 </td>
															 <?php endif; ?>
															</tr>
															
															 <tr>
															  <?php if ($soal['pilC'] <>'') : ?>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">C.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>" <?php in_array ('C', $checked) ? print 'checked' : ''; ?>></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;">
															 <?php
                                                                    
                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileC]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															 <?= $soal['pilC'] ?>
															 </td>
															 <?php endif; ?>
															 <?php if ($soal['pilD'] <>'') : ?>
															<td style="padding: 3px;width: 2%; vertical-align: text-top;">D.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>" <?php in_array ('D', $checked) ? print 'checked' : ''; ?>></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                              <?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileD]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															 <?= $soal['pilD'] ?>
															 </td>
															<?php endif; ?>
															</tr>
															
															  <?php if ($soal['pilE'] <>'') : ?>
															<tr>
														      <td style="padding: 3px;width: 2%; vertical-align: text-top;">E.</td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"><input type="checkbox" name="<?= $soal['id_soal'] ?>" <?php in_array ('E', $checked) ? print 'checked' : ''; ?>></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;">
															 <?php
                                                                    
                                                                    if ($soal['fileE'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileE']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileE]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															 <?= $soal['pilE'] ?>
															 </td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"></td>
															 <td style="padding: 3px;width: 2%; vertical-align: text-top;"></td>
															 <td style="padding: 3px;width: 31%; vertical-align: text-top;"> </td>
															
															</tr>
															<?php endif; ?>
															</table>
														<b> Skor Max : </b> <?= $soal['max_skor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;
														<b> Kunci : </b> <?= $soal['jawaban'] ?> 
														 </tr>
                                                
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
								</div>						
					          </div>
                      
					  <div class="tab-pane fade" id="pills-BS" role="tabpanel" aria-labelledby="pills-BS-tab">
                        <div class='table-responsive'>
                                    <table id="tabelBS" class='table'>
                                        <tbody>
										<?php $no=0; ?>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank' AND jenis='4' order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
												 <?php $checked = explode(', ',$soal['jawaban']); ?>
												<?php $no++; ?>
                                                <tr>
                                                    <td style='width:30px;text-align:center'>
                                                        <?= $no ?>
														<br><br>
														<button data-id="<?= $soal['id_soal'] ?>" class="hapus btn-sm btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
                                                    <br>
													<?php if($soal['jenis']==4){ ?>
													<a href="?pg=<?= enkripsi('editsoal4') ?>&id_soal=<?php echo $soal['id_soal'] ?>"><button class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<?php } ?>
													</td>
													
                                                    <td style="text-align:justify">
													
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														
                                                       <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
								                     <table width="100%" class='table table-bordered'>
													 <?php if ($soal['pilA']<>''){ ?>
													<tr>
															<td class="text-center" ><b>Pernyataan</b></td>
															<td class="text-center" width="5%" ><b>Benar</b></td>
															<td class="text-center" width="5%" ><b>Salah</b></td>
															
															</tr>
													 <?php }else{ ?>
													 <tr>
															
															<td class="text-center" width="5%" ><b>Benar</b></td>
															<td class="text-center" width="5%" ><b>Salah</b></td>
															
															</tr>
													 <?php } ?>
													  <?php if ($soal['pilA'] <>'') : ?>
															<tr>		
															<td>
															 <?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilA'] ?>
															</td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>1" <?php if($checked[0]=='B') echo 'checked'?>></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>1" <?php if($checked[0]=='S') echo 'checked'?>></td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilB'] <>'') : ?>
															<tr>										
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileB]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilB'] ?>
															</td>					
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>2" <?php if($checked[1]=='B') echo 'checked'?>></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>2" <?php if($checked[1]=='S') echo 'checked'?>></td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilC'] <>'') : ?>
															<tr>
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileC]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilC'] ?>
															</td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>3" <?php if($checked[2]=='B') echo 'checked'?>></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>3" <?php if($checked[2]=='S') echo 'checked'?>></td>															
															</tr>
															<?php endif; ?>
															
															  <?php if ($soal['pilD'] <>'') : ?>
															<tr>
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileD]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilD'] ?>
															</td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>4" <?php if($checked[3]=='B') echo 'checked'?>></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>4" <?php if($checked[3]=='S') echo 'checked'?>></td>															
															</tr>
															<?php endif; ?>
															
															 <?php if ($soal['pilE'] <>'') : ?>
															<tr>
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileE'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileE']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileE]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilE'] ?>
															</td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>5" <?php if($checked[4]=='B') echo 'checked'?>></td>
															<td class="text-center"><input type="radio" name="<?= $soal['id_soal'] ?>5" <?php if($checked[4]=='S') echo 'checked'?>></td>														
															</tr>
															<?php endif; ?>
															</table>
								                         <b> Skor Max : </b> <?= $soal['max_skor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;
														<b> Kunci : </b> <?= $soal['jawaban'] ?> 
								
														</tr>
																
															<?php endwhile; ?>
														</tbody>
													</table>
													</div>														
												</div>
								
								
								
								
								 <div class="tab-pane fade" id="pills-JODOH" role="tabpanel" aria-labelledby="pills-JODOH-tab">
                       				<div class='table-responsive'>
                                    <table id="tabelJODOH" class='table  '>
                                        <tbody>
										<?php $no=0; ?>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank' AND jenis='5' order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
												<?php 
												$checked = explode(', ', $soal['jawaban']); 
												$warna = explode(', ', $soal['warna']);
												$no++; 
												?>
                                                <tr>
                                                    <td style='width:30px;text-align:center'>
                                                        <?= $no ?>
														<br><br>
														<button data-id="<?= $soal['id_soal'] ?>" class="hapus btn-sm btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
                                                    <br>
													<?php if($soal['jenis']==5){ ?>
													<a href="?pg=<?= enkripsi('editsoal5') ?>&id_soal=<?php echo $soal['id_soal'] ?>"><button class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<?php } ?>
													</td>
													
                                                    <td style="text-align:justify">
													
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														
                                                       <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
								
								                  <table width="100%" class='table table-bordered'>
													       <tr>
														  
															<td class="text-center" ><b>Pernyataan</b></td>	
															<td class="text-center" width="5%" ><b></b></td>	
															<td class="text-center" width="5%" ><b></b></td>	
                                                            <td class="text-center" ><b>Jawaban</b></td>	
																													
															</tr>
                                                           <?php if ($soal['pilA'] <>'') : ?>
															<tr>	
																<?php if ($soal['perA'] <>''){ ?>
															<td><?= $soal['perA'] ?></td>															
															<td id="row1-5-1<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1" checked > 1</td>
															<?php }else{ ?>
															<td colspan="2"></td>
															<?php } ?>
															<td id="row2-5-1<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1"
															<?php if($checked[0]=='A'){echo "checked"; } ?> <?php if($checked[1]=='A'){echo "checked"; } ?> <?php if($checked[2]=='A'){echo "checked"; } ?>
															<?php if($checked[3]=='A'){echo "checked"; } ?> <?php if($checked[4]=='A'){echo "checked"; } ?>
															>A
															</td>
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															
															<?= $soal['pilA'] ?>
															</td>															
															</tr>
															<?php endif; ?>
															 <?php if ($soal['pilB'] <>'') : ?>
															<tr>
																<?php if ($soal['perB'] <>''){ ?>
															<td><?= $soal['perB'] ?></td>															
															<td id="row1-5-2<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1" checked> 2</td>
															<?php }else{ ?>
															<td colspan="2"></td>
															<?php } ?>
															<td id="row2-5-2<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1"
															<?php if($checked[0]=='B'){echo "checked"; } ?> <?php if($checked[1]=='B'){echo "checked"; } ?> <?php if($checked[2]=='B'){echo "checked"; } ?>
															<?php if($checked[3]=='B'){echo "checked"; } ?> <?php if($checked[4]=='B'){echo "checked"; } ?>
															>B
															</td>
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileB]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilB'] ?>
															</td>															
															</tr>
															<?php endif; ?>
															<?php if ($soal['pilC'] <>'') : ?>
															<tr>	
															<?php if ($soal['perC'] <>''){ ?>
															<td><?= $soal['perC'] ?></td>															
															<td id="row1-5-3<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1" checked> 3</td>
															<?php }else{ ?>
															<td colspan="2"></td>
															<?php } ?>
															<td id="row2-5-3<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1"
															<?php if($checked[0]=='C'){echo "checked"; } ?> <?php if($checked[1]=='C'){echo "checked"; } ?> <?php if($checked[2]=='C'){echo "checked"; } ?>
															<?php if($checked[3]=='C'){echo "checked"; } ?> <?php if($checked[4]=='C'){echo "checked"; } ?>
															>C
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileC]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilC'] ?>
															</td>															
															</tr>
															<?php endif; ?>
															 <?php if ($soal['pilD'] <>'') : ?>
															<tr>
															<?php if ($soal['perD'] <>''){ ?>
															<td><?= $soal['perD'] ?></td>															
															<td id="row1-5-4<?= $soal['id_soal'] ?>"><input type="checkbox" name="<?= $soal['id_soal'] ?>1" checked> 4</td>
															<?php }else{ ?>
															<td colspan="2"></td>
															<?php } ?>
															<td id="row2-5-4<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1"
															<?php if($checked[0]=='D'){echo "checked"; } ?> <?php if($checked[1]=='D'){echo "checked"; } ?> <?php if($checked[2]=='D'){echo "checked"; } ?>
															<?php if($checked[3]=='D'){echo "checked"; } ?> <?php if($checked[4]=='D'){echo "checked"; } ?>
															>D
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileD'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileD']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileD]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilD'] ?>
															</td>															
															</tr>
															<?php endif; ?>
															 <?php if ($soal['pilE'] <>'') : ?>
															<tr>
																<?php if ($soal['perE'] <>''){ ?>
															<td><?= $soal['perE'] ?></td>															
															<td id="row1-5-5<?= $soal['id_soal'] ?>"><input type="checkbox" name="<?= $soal['id_soal'] ?>1" checked> 5</td>
															<?php }else{ ?>
															<td colspan="2"></td>
															<?php } ?>
															<td id="row2-5-5<?= $soal['id_soal'] ?>" width="8%"><input type="checkbox" name="<?= $soal['id_soal'] ?>1"
															<?php if($checked[0]=='E'){echo "checked"; } ?> <?php if($checked[1]=='E'){echo "checked"; } ?> <?php if($checked[2]=='E'){echo "checked"; } ?>
															<?php if($checked[3]=='E'){echo "checked"; } ?> <?php if($checked[4]=='E'){echo "checked"; } ?>
															>E
															<td>
															<?php
                                                                    
                                                                    if ($soal['fileE'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileE']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$baseurl/files/$soal[fileE]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
															<?= $soal['pilE'] ?>
															</td>															
															</tr>
															<?php endif; ?>
															</table>
                                                          <b> Skor Max : </b> <?= $soal['max_skor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;
														<b> KUNCI JAWABAN &nbsp;&nbsp;&nbsp; 1.<?= $checked[0] ?> &nbsp;&nbsp;&nbsp; 2.<?= $checked[1] ?> <?php if($soal['perC']<>''){ ?> &nbsp;&nbsp;&nbsp; 3.<?= $checked[2] ?><?php } ?>
			<?php if($soal['perD']<>''){ ?> &nbsp;&nbsp;&nbsp; 4.<?= $checked[3] ?><?php } ?> <?php if($soal['perE']<>''){ ?> &nbsp;&nbsp;&nbsp; 5.<?= $checked[4] ?><?php } ?>
														</tr>
															<script>
															<?php if($soal['perA']<>''): ?>
															 document.getElementById("row1-5-1<?= $soal['id_soal'] ?>").style.backgroundColor = '#00BCD4';
															 <?php if($checked[0]=='A'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='A'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='A'){$warnamu=$warna[2]; } ?>
															 <?php if($checked[3]=='A'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='A'){$warnamu=$warna[4]; } ?>
															 document.getElementById("row2-5-1<?= $soal['id_soal'] ?>").style.backgroundColor = '<?= $warnamu ?>';
															 <?php endif; ?>
															 <?php if($soal['perB']<>''): ?>
															 document.getElementById("row1-5-2<?= $soal['id_soal'] ?>").style.backgroundColor = '#F44336';
															 <?php if($checked[0]=='B'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='B'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='B'){$warnamu=$warna[2]; } ?>
															 <?php if($checked[3]=='B'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='B'){$warnamu=$warna[4]; } ?>
															 document.getElementById("row2-5-2<?= $soal['id_soal'] ?>").style.backgroundColor = '<?= $warnamu ?>';
															 <?php endif; ?>
															 <?php if($soal['perC']<>''): ?>
															 document.getElementById("row1-5-3<?= $soal['id_soal'] ?>").style.backgroundColor = '#4CAF50';
															 <?php if($checked[0]=='C'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='C'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='C'){$warnamu=$warna[2]; } ?>
															 <?php if($checked[3]=='C'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='C'){$warnamu=$warna[4]; } ?>
															 document.getElementById("row2-5-3<?= $soal['id_soal'] ?>").style.backgroundColor = '<?= $warnamu ?>';
															 <?php endif; ?>
															  <?php if($soal['perD']<>''): ?>
															 document.getElementById("row1-5-4<?= $soal['id_soal'] ?>").style.backgroundColor = '#FF9800';
															 <?php if($checked[0]=='D'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='D'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='D'){$warnamu=$warna[2]; } ?>
															 <?php if($checked[3]=='D'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='D'){$warnamu=$warna[4]; } ?>
															 document.getElementById("row2-5-4<?= $soal['id_soal'] ?>").style.backgroundColor = '<?= $warnamu ?>';
															 <?php endif; ?>
															  <?php if($soal['perE']<>''): ?>
															 document.getElementById("row1-5-5<?= $soal['id_soal'] ?>").style.backgroundColor = '#0277BD';
															 <?php if($checked[0]=='E'){$warnamu=$warna[0]; } ?> <?php if($checked[1]=='E'){$warnamu=$warna[1]; } ?> <?php if($checked[2]=='E'){$warnamu=$warna[2]; } ?>
															 <?php if($checked[3]=='E'){$warnamu=$warna[3]; } ?> <?php if($checked[4]=='E'){$warnamu=$warna[4]; } ?>
															 document.getElementById("row2-5-5<?= $soal['id_soal'] ?>").style.backgroundColor = '<?= $warnamu ?>';
															 <?php endif; ?>
															</script>	
															<?php endwhile; ?>
														</tbody>
													</table>
													</div>					
												</div>

								
                      <div class="tab-pane fade" id="pills-ESAI" role="tabpanel" aria-labelledby="pills-ESAI-tab">
                       <div class='table-responsive'>
                                    <table id="tabelESAI" class='table  '>
                                        <tbody>
										<?php $no=0; ?>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$id_bank' AND jenis='2' order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
												<?php $no++; ?>
                                                <tr>
                                                    <td style='width:30px;text-align:center'>
                                                        <?= $no ?>
														<br><br>
														<button data-id="<?= $soal['id_soal'] ?>" class="hapus btn-sm btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons">delete</i></button>
                                                    <br>
													 <?php if($soal['jenis']==2){ ?>
													<a href="?pg=<?= enkripsi('editsoal2') ?>&id_soal=<?php echo $soal['id_soal'] ?>"><button class="btn btn-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
													<?php } ?>
													</td>
													
                                                    <td style="text-align:justify">
													
                                                        <?php
                                                        if ($soal['file'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-bottom: 5px'><img src='$baseurl/files/$soal[file]' style='max-width:100px;'/></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-bottom: 5px'><audio controls><source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														
                                                       <?= $soal['soal']; ?>
                                                        <?php
                                                        if ($soal['file1'] <> '') :
                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                            $ext = explode(".", $soal['file1']);
                                                            $ext = end($ext);
                                                            if (in_array($ext, $image)) {
                                                                echo "<p style='margin-top: 5px'><img src='$baseurl/files/$soal[file1]' style='max-width:200px;' /></p>";
                                                            } elseif (in_array($ext, $audio)) {
                                                                echo "<p style='margin-top: 5px'><audio controls><source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio></p>";
                                                            } else {
                                                                echo "File tidak didukung!";
                                                            }
                                                        endif;
                                                        ?>
														<table width="100%">
                                                            <tr>
														<td><b> Skor Max : </b> <?= $soal['max_skor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;
														<b> Kunci : </b> <?= $soal['jawaban'] ?> </td>
														 </tr>
                                                        </table>
														</tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
									</div>
                                 </div>
								</div>
								</div>


								</div>
							</div>
						</div>
					</div>					 
		
        <?php endif; ?>		 
		<script>
		var checker = document.getElementById('checkme');
 var sendbtn = document.getElementById('blo1');
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
		</script>	
		
		
<script>
    $('#formsoal').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'bank/tbanksoal.php?pg=simpan_soal',
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
              
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
    </script>
			
		
	<script>
 $('#tabelPG').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                     url: 'bank/tbanksoal.php?pg=hapussoal',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
<script>
 $('#tabelESAI').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
       swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                     url: 'bank/tbanksoal.php?pg=hapussoal',
                    method: "POST",
                    data: 'id=' + id,
                   success: function(data) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
<script>
 $('#tabelJODOH').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
       swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                     url: 'bank/tbanksoal.php?pg=hapussoal',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
<script>
 $('#tabelBS').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
       swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                     url: 'bank/tbanksoal.php?pg=hapussoal',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
<script>
 $('#tabelMULTI').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
       swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                     url: 'bank/tbanksoal.php?pg=hapussoal',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
<script>
$("#btnreset").click(function() {
        var id = $(this).data('id');
        swal({
            title: 'Konfirmasi ',
            text: 'Apakah kamu yakin akan menghapus semua soal ??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'bank/tbanksoal.php?pg=kosongsoal',
                    data: "id=" + id,
                    type: "POST",
                    success: function(respon) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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
		
		
		
		
		