<?php
defined('APK') or exit('No Access');
$query = mysqli_query($koneksi, "SELECT max(idjari) as kodejari FROM datareg");
$data = mysqli_fetch_array($query);
$idjari = $data['kodejari'];
$idjari++;
?>        
 <?php
		$n=10;
		function getName($n) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';		 
			for ($i = 0; $i < $n; $i++) {
				$index = rand(0, strlen($characters) - 1);
				$randomString .= $characters[$index];
			}
		 
			return $randomString;
		}
		$serial = getName($n);
		?>  
	<?php if ($ac == '') : ?>
                   <div class="row">
                          <div class="col-md-8">
                            <div class="card">
                               <div class="card card-header">
                                  <h5 class="card-title">DATA FINGER PRINT</h5>										
                                    </div>
                                <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>ID</th>
													<th>SERIAL NUMBER</th>
                                                    <th>NAMA LENGKAP</th>
													 <th>STATUS</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM datareg WHERE serial<>'' ORDER BY id DESC"); 
											while ($data = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['idjari'] ?></td>
													 <td><?= $data['serial'] ?></td>
                                                     <td><?= $data['nama'] ?></td>
													  <td>
													  <?php if($data['level']=='siswa'): ?>
													  SISWA - <?= $siswa['kelas'] ?>
													  <?php else: ?>
													  PEGAWAI - <?= strtoupper($peg['jabatan']) ?>
													  <?php endif; ?>
													  
													  </td>
													  <td>
											<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus RFID"><i class="material-icons">delete</i> </button>
											</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
					      <div class="col-md-4">
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
										  <a href="?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('siswa') ?>" class="btn btn-success"><i class="material-icons">workspaces</i>Siswa</a>
										</div>
										<div class="text-center">
										 
										</div>
										<div class="text-center">
										 <a href="?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('pegawai') ?>" class="btn btn-primary"><i class="material-icons">workspaces</i>Pegawai</a>
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
									 </div>   
									
					
					            <script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Hapus Data',
											  text: "Hapus Registrasi Sidik Jari",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'finger/tfinger.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												setTimeout(function() {
												window.location.replace('?pg=<?= enkripsi("finger") ?>&ac=<?= enkripsi("temp") ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    
					
				<?php elseif ($ac == enkripsi('siswa')) : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">REGISTRASI SISWA</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                <th>NO</th>                                               
                                                <th>N I S</th>
                                                <th>NAMA SISWA</th>
												<th>ROMBEL</th>
												<th>REG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE sts='0'"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['nis'] ?></td>
                                                <td><?= $data['nama'] ?></td>
												<td><?= $data['kelas'] ?></td>
												<td>											
												<a href="?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('siswa') ?>&ids=<?= $data['id_siswa'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Registrasi Finger"><i class="material-icons">edit</i></button></a>
												</td>
                                              </tr>
											<?php endwhile; ?>
											</tbody>
                                           </table>
										</div>
									</div>
								</div>
							</div>
									
					      <div class="col-md-4">                  
                              <div class="card">
                                 <div class="card-body">
									<?php 
									$ids = $_GET['ids'];
									$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
									?>
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formkartu' class="row g-2">			
                                          <input type='hidden' name='idjari' class='form-control' value="<?= $idjari ?>"  />                                      
									  <div class="col-md-12 mb-1">
									   <label>Serial Number</label>
                                       <input type='text' name='serial' class='form-control' value="<?= $serial ?>" readonly />
									    <input type='hidden' name='id' class='form-control' value="<?= $siswa['id_siswa'] ?>"   />			   
                                        </div>	
										 
									  <div class="col-md-12 mb-1">
									  <label>Nama Lengkap</label>
                                       <input type='text' name='nama' class='form-control' value="<?= $siswa['nama'] ?>"  readonly />
                                        </div>

									  <div class="col-md-12 mb-1">
									  <label>Rombel</label>
                                       <input type='text' name='kelas' class='form-control' value="<?= $siswa['kelas'] ?>" readonly />
                                        </div>
										
										<div class="d-grid gap-2">
										<button class="btn btn-dark" type="button" disabled>
											<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
											Setelah di Register silahkan <b>Tekan Tombol Registrasi</b> di Mesin, Tempel jari lalu angkat dan tempel sekali lagi...
										</button>
										 </div>
									
										<div class="d-grid gap-2">
										<?php if($ids !=''): ?>
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Register</button>
                                             <?php endif; ?>
											</div>
										</form>
									 </div>
									</div>
								</div>
							</div>
						
					
					
					   <script>
						  $('#formkartu').submit(function(e) {
								e.preventDefault();
								$.ajax({
									type: 'POST',
									url: 'finger/tfinger.php?pg=siswa',
									data: $(this).serialize(),
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
	
									},
									success: function(data) {
										console.log(data);
										if (data == 'OK') {
											
											setTimeout(function() {
												window.location.replace("?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('siswa') ?>");
											}, 2000);
										} else {
										   iziToast.info(
									{
										title: 'Gagal!',
										message: 'Data Siswa Belum dipilih',
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
					
		     <?php elseif ($ac == enkripsi('pegawai')) : ?>			
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">REGISTRASI PEGAWAI</h5>
									</div>
                                <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                            <tr>
                                            <th>NO</th>                                               
                                            <th>N I P</th>
                                            <th>NAMA GURU</th>
											<th>JABATAN</th>
											<th>REG</th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE sts='0'"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['nip'] ?></td>
                                                <td><?= $data['nama'] ?></td>
												<td><?= $data['jabatan'] ?></td>
												<td>											
												<a href="?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('pegawai') ?>&ids=<?= $data['id_user'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Registrasi Finger"><i class="material-icons">edit</i></button></a>
												</td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								
					       <div class="col-md-4">                  
                              <div class="card">
                                 <div class="card-body">
									<?php 
									$ids = $_GET['ids'];
									$peg = fetch($koneksi,'users',['id_user'=>$ids]);
									?>
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formkarpeg' class="row g-2">			
                                          <input type='hidden' name='idjari' class='form-control' value="<?= $idjari ?>"  />                                      
									  <div class="col-md-12 mb-1">
									   <label>Serial Number</label>
                                       <input type='text' name='serial' class='form-control' value="<?= $serial ?>" readonly />
									    <input type='hidden' name='id' class='form-control' value="<?= $peg['id_user'] ?>"   />			   
                                        </div>	
										 
									  <div class="col-md-12 mb-1">
									  <label>Nama Lengkap</label>
                                       <input type='text' name='nama' class='form-control' value="<?= $peg['nama'] ?>"  readonly />
                                        </div>

									  <div class="col-md-12 mb-1">
									  <label>Jabatan</label>
                                       <input type='text' name='jabatan' class='form-control' value="<?= $peg['jabatan'] ?>" readonly />
                                        </div>
										
										<div class="d-grid gap-2">
										<button class="btn btn-dark" type="button" disabled>
											<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
											Setelah di Register silahkan <b>Tekan Tombol Registrasi</b> di Mesin, Tempel jari lalu angkat dan tempel sekali lagi...
										</button>
										 </div>
									
										<div class="d-grid gap-2">
										<?php if($ids !=''): ?>
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Register</button>
                                             <?php endif; ?>
											</div>
										</form>
									 </div>
									</div>
								</div>
							</div>
						
					   <script>
						  $('#formkarpeg').submit(function(e) {
								e.preventDefault();
								$.ajax({
									type: 'POST',
									url: 'finger/tfinger.php?pg=pegawai',
									data: $(this).serialize(),
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
										console.log(data);
										if (data == 'OK') {
											
											setTimeout(function() {
												window.location.replace("?pg=<?= enkripsi('finger') ?>&ac=<?= enkripsi('pegawai') ?>");
											}, 2000);
										} else {
										   iziToast.info(
									{
										title: 'Gagal!',
										message: 'Data Pegawai Belum di Pilih',
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
					
					
					  <?php elseif ($ac == enkripsi('temp')) : ?>	
					 <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA TEMP FINGER PRINT</h5>							
                                    </div>
                                <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                            <tr>                                               
                                            <th>ID</th>
											<th>SERIAL NUMBER</th>
                                            <th>NAMA LENGKAP</th>
											<th>STATUS</th>													
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$query = mysqli_query($koneksi, "SELECT * FROM temp_finger ORDER BY id DESC"); 
											while ($data = mysqli_fetch_array($query)) :
											?>
                                            <tr>
                                            <td><?= $data['idjari'] ?></td>
											<td><?= $data['serial'] ?></td>
                                            <td><?= $data['nama'] ?></td>
											<td><?= strtoupper($data['level']) ?></td>													 
                                            </tr>
											<?php endwhile; ?>
                                            </tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
									
					       <div class="col-md-4">
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
									<div class="widget-payment-request-info m-t-md">
									
							
										<div class="d-grid gap-2">
										<button class="btn btn-primary" type="button" disabled>
											<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
											Tekan Tombol Delete pada Mesin untuk menghapus sidik jari...
										</button>
										 </div>									
									 </div>
					            </div>
							</div>
						</div>
						
					  <?php endif ?>
					