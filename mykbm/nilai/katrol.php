<?php
defined('APK') or exit('No Access');
$hari = date('D');
 $harix = fetch($koneksi,'m_hari',['inggris'=>$hari]);
?>           
	<?php if ($ac == '') : ?>
	
                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">SETTING KATROL PH</h5>
										
                                    </div>
                                    <div class="card-body">
									<div class="alert alert-custom" role="alert">
									<strong>Hari <?= $harix['hari'] ?></strong><br>
										<span>Data Penilaian Harian akan muncul jika Hari sesuai Jadwal Mengajar</span>
									</div>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th>NO</th>
                                                 													  
												  <th>KELAS</th>													                                                 
                                                  <th>MATA PELAJARAN</th>
												  <th>GURU PENGAMPU</th>
												  <th>JML</th>
												  <th></th>
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											
											$bulan = date('m');
											$tahun = date('Y');
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari'");
											 elseif($user['level']=='guru'):
											 $query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari' and guru='$user[id_pegawai]'");
											  endif;
											 
											  while ($data = mysqli_fetch_array($query)) :
											 
											  $mapelx = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											  $guru = fetch($koneksi,'pegawai',['id_pegawai'=>$data['guru']]);
											  $kuri = fetch($koneksi,'m_kurikulum',['idk'=>$data['kuri']]);
											  $jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT kelas FROM siswa where kelas='$data[kelas]'"));
											  $jumdes = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$data[kelas]' and mapel='$data[mapel]' and guru='$data[guru]' and semester='$setting[semester]'"));
											  $jumkat = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where kelas='$data[kelas]' and mapel='$data[mapel]' and guru='$data[guru]' and semester='$setting[semester]' and katrol<>''"));
											$no++;
											   ?>
											   <tr>
                                                 <td><?= $no; ?></td>
												
                                                   <td><h5><span class="badge badge-primary"> <?= $data['kelas'] ?></span></h5></td>
													<td><?= $mapelx['nama_mapel'] ?> <span class="badge badge-secondary"><?= $kuri['nama_kurikulum'] ?></span></td>
													<td><?= $guru['nama'] ?></td>
													<td><h5><span class="badge badge-success"><?= ($jumdes/$jsiswa); ?> X</span></h5></td>
													<td>
													<?php if($jumdes<>$jumkat): ?>
													<a href="?pg=<?= enkripsi('katrol') ?>&k=<?= enkripsi($data['kelas']) ?>&m=<?= enkripsi($data['mapel']) ?>&g=<?= enkripsi($data['guru']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Setting Katrol"><i class="material-icons">edit</i> </a>
													<?php else : ?>
													<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
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
									
									<div class="col-md-4">
							 <?php   
								if (empty($_GET['k'])) {
									$kelasmu = "";
								} else {
									$kelasmu = dekripsi($_GET['k']);
								}
								if (empty($_GET['g'])) {
									$gurumu = "";
								} else {
									$gurumu = dekripsi($_GET['g']);
								}
								 if (empty($_GET['m'])) {
									$mapelmu = "";
								} else {
									$mapelmu = dekripsi($_GET['m']);
								}
								
									$map = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id='$mapelmu' "));
									$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pegawai where id_pegawai='$gurumu'"));
								?>
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">SETTING KATROL PH</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<div class="alert alert-custom" role="alert">
									<strong>Perhatian ! </strong><br>
										<span>Penilaian Harian dapat dilakukan jika Hari sesuai Jadwal Mengajar</span>
									</div>
									<form id="formkatrol">
										<label class="bold">Guru Pengampu</label>
									  <div class="input-group mb-1">
                                        <select name="guru" class='form-select' style='width:100%' required>			   
												<option value="<?= $gurumu ?>"><?= $peg['nama'] ?></option>
                                          </select>     
                                        </div>
										<label class="bold">Kelas</label>
									  <div class="input-group mb-1">
									   <select  name="kelas" class='form-select' style='width:100%' required>
                                        <option value="<?= $kelasmu ?>"><?= $kelasmu ?></option> 									                                        
                                          </select>                                        
                                        </div>
										<label class="bold">Mata Pelajaran</label>
									  <div class="input-group mb-1">
                                        <select name="mapel" class='form-select' style='width:100%' required>
										 <option value="<?= $mapelmu ?>"><?= $map['nama_mapel'] ?></option> 
                                          </select>                                                    
                                        </div>
										<?php if($kelasmu !=''): ?>
											 <label class="bold">Tanggal</label>
									  <div class="input-group mb-1">
                                       <select name="tanggal" class='form-select' style='width:100%' required>
                                        <?php
										 $sql = mysqli_query($koneksi, "SELECT tanggal,mapel,kelas,guru FROM nilai_harian WHERE mapel='$mapelmu' and guru='$gurumu' and kelas='$kelasmu' group by tanggal");           
									 echo "<option value=''>Pilih Tanggal</option>";
												while ($datax = mysqli_fetch_array($sql)) {
													echo "<option value='$datax[tanggal]'>$datax[tanggal]</option>";
												} ?>
                                          </select>     
                                        </div>
										 <label class="bold">Nilai Terendah yg diinginkan </label>
									  <div class="input-group mb-1">
                                       <input type="number" name="rendah" class="form-control" value="70" required="true" >                                                 
                                        </div>
										 <label class="bold">Nilai Tertinggi yg diinginkan </label>
									  <div class="input-group mb-1">
                                       <input type="number" name="tinggi" class="form-control" value="90" required="true" >                                                 
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                             
											</div>
										<?php endif; ?>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
					
				 <script>
						$('#formkatrol').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'nilai/tkatrol.php?pg=katrol',
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
											window.location.replace('?pg=<?= enkripsi("ckatrol") ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
									
				
            
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					