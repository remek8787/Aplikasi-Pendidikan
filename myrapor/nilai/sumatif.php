<?php
defined('APK') or exit('No Access');
$hari = date('D');
?>           
	<?php if ($ac == '') : ?>
	<?php
    if (empty($_GET['k'])) {
        $kelasmu = "";
    } else {
        $kelasmu = $_GET['k'];
    }
    if (empty($_GET['g'])) {
        $gurumu = "";
    } else {
        $gurumu = $_GET['g'];
    }
	 if (empty($_GET['m'])) {
        $mapelmu = "";
    } else {
        $mapelmu = $_GET['m'];
    }
	
 		$mpl = fetch($koneksi,'mapel',['id'=> $mapelmu]);
	$jnilph = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$kelasmu' and mapel='$mapelmu' and guru='$gurumu' and smt='$semester' and tp='$tapel'"));	
	?>
                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="bold">
										<?php if($_GET['kt']==''): ?>
										PENGOLAHAN NILAI PH <span class="badge badge-success"><?= $semester ?></span>
										<?php else: ?>
										INPUT <?= $_GET['kt'] ?> 
										<span class="badge badge-primary"><?= $mpl['kode'] ?></span>
										<span class="badge badge-primary"><?= $kelasmu ?></span>
										<span class="badge badge-primary"><?= $_GET['ki'] ?></span>
										<?php endif; ?>
										</h5>										
                                    </div>
                                <div class="card-body">
								
								<?php if($_GET['kt']=='PH'): ?>
									<div class="alert alert-costum" role="alert">
									<strong>Perhatian ! </strong><br>
										<span>Jika Bapak/Ibu Guru sudah menginput Nilai Harian pada Dashboard KBM, maka Bapak/Ibu bisa klik <b>Tombol Copy</b>								
										</span>
										
										<form id="formcopy">
										<input type="hidden" name="kelas" value="<?= $kelasmu ?>">
										<input type="hidden" name="mapel" value="<?= $mapelmu ?>">
										<input type="hidden" name="guru" value="<?= $gurumu ?>">
										<div class="pull-right">
										<?php if($jnilph<>0): ?>
										<button type="submit" class="btn btn-sm btn-success kanan"><i class="material-icons">file_copy</i> Copy</button>
										<?php else: ?>
										<button class="btn btn-sm btn-secondary kanan" disabled><i class="material-icons">lock</i></button>										
										<?php endif; ?>
										</div>
										</form>
									</div>
									<?php endif; ?>
									
								<form id="formnilai">
									<input type="hidden" name="kimu" value="<?= $ki ?>">
									<input type="hidden" name="kelasmu" value="<?= $kelasmu ?>">
										<input type="hidden" name="mapelmu" value="<?= $mapelmu ?>">
										<input type="hidden" name="gurumu" value="<?= $gurumu ?>">
                                        <table  style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th width="5%">NO</th>												  
												  <th>N I S</th>
												  <th>NAMA SISWA</th>
                                                  <th>NILAI <?= $_GET['kt'] ?></th>												  		 
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT id_siswa,nis,kelas,nama,level FROM siswa WHERE kelas='$kelasmu'");
											  while ($data = mysqli_fetch_array($query)) :
											 $tkt = fetch($koneksi,'kelas',['kelas'=>$data['kelas']]);
											$nil = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_sumatif  WHERE ket='PH' and idsiswa='$data[id_siswa]' and mapel='$mapelmu' and smt='$semester' and tp='$tapel'"));
											
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                 <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
													<td><?= $data['nama'] ?></td>
													<td>
													<input type="number" name="nilai[]<?php echo $no; ?>" class="form-control" value="<?= $nil['nilai'] ?>" required="true" style="width:100px;"> 									
													<input type="hidden" name="ket[]" value="<?= $_GET['kt'] ?>" >
													<input type="hidden" name="idsiswa[]" value="<?= $data['id_siswa'] ?>" >
													<input type="hidden" name="kelas[]" value="<?= $data['kelas'] ?>" >
													<input type="hidden" name="mapel[]" value="<?= $mapelmu ?>" >
													<input type="hidden" name="guru[]" value="<?= $gurumu ?>" >
													<input type="hidden" name="level[]" value="<?= $data['level'] ?>" >
													</td>
													
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												<div class="kanan">
												<?php if($kelasmu !=''): ?>
												<button type="submit" class="btn btn-primary">SIMPAN</button>
												<?php endif; ?>
												</div>
												</form>
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
									
									<?php if($kelasmu==''): ?>
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $semester ?>"><?= $semester ?></option>
									    </select>
                                       </div>
										<input type="hidden" name="ket"  id="ket" class='form-control ket' value="PH" > 
									   
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select guru' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar  GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE  guru='$id_user' GROUP BY guru");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<?php $peg=fetch($koneksi,'users',['id_user' => $data['guru']]); ?>
											<option value="<?= $data['guru'] ?>"><?= $peg['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select kelas' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select mapel' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">Pilih Kelas</button>
                             
											</div>
											<?php else: ?>
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
											
											<?php endif; ?>
										<script type="text/javascript">
										$('#pilih').click(function() {
										var kt = $('.ket').val();	
										var k = $('.kelas').val();
										var g = $('.guru').val();
										var m = $('.mapel').val();
										
										location.replace("?pg=<?= enkripsi('sumatif') ?>&k=" + k + "&g=" + g + "&m=" + m + "&kt=" + kt);
										}); 
									</script>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
					<script>
					$("#guru").change(function() {
						var guru = $(this).val();						
						console.log(guru);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=kelas2", 
							data: "guru=" + guru, 
							success: function(response) { 
							$("#kelas").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#kelas").change(function() {
						var kelas = $(this).val();
						var guru = $("#guru").val();							
						console.log(kelas + guru);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=mapel", 
							data: "kelas=" + kelas + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
				 <script>
						$('#formnilai').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'nilai/input2.php',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									setTimeout(function() {
									window.location.reload();
										}, 2000);
									}
								})
								return false;
							});
							</script>
							
						<script>
						$('#formcopy').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'nilai/copy2.php',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
									
									},
									success: function(data) {
									setTimeout(function() {
									window.location.reload();
										}, 2000);
									}
								})
								return false;
							});
							</script>	
							
									
				<?php elseif ($ac == enkripsi('lihat')): ?>
                    	<?php
							   
							   $kelas = dekripsi($_GET['k']);
							   $mapel = dekripsi($_GET['m']);
							   $guru = dekripsi($_GET['g']);
							   $tgl = dekripsi($_GET['t']);
							   $mpl = fetch($koneksi,'mapel',['id'=>$mapel]);
							   $peg = fetch($koneksi,'pegawai',['id_pegawai'=>$guru]);
								?>				 
                      <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">NILAI HARIAN <?= $mpl['kode'] ?></h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="7%">#</th>  	
													<th>TANGGAL</th>
													<th>KELAS</th>	
                                                    <th>NAMASISWA</th>
													<th>K-MAT</th>
                                                    <th>NILAI</th>													
													 <th>KET</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$kelas' and mapel='$mapel' and guru='$guru' and tanggal='$tgl'"); 
											while ($datax = mysqli_fetch_array($query)) :
											$siswa = fetch($koneksi,'siswa',['id_siswa'=>$datax['idsiswa']]);
											if($datax['nilai'] >=$datax['kkm']){
												$ket='Tuntas';
											}else{
												$ket='Tidak Tuntas';
											}
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $datax['tanggal'] ?></td>
													<td><?= $datax['kelas'] ?></td>
													<td><?= $siswa['nama'] ?></td>
													<td>
													<?php if($datax['kuri']=='1'):?>
													KD <?= $datax['materi'] ?>
													<?php else : ?>
													LM <?= $datax['materi'] ?>
													<?php endif; ?>
													</td>
													<td><?= $datax['nilai'] ?></td>
													
													  <td>
											          <?=$ket?>
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
				
                
            
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					