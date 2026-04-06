<?php
defined('APK') or exit('No Access');
$hari = date('D');
?>           
	<?php if ($ac == '') : ?>
	
                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="bold">CETAK NILAI HARIAN</h5>										
                                    </div>
                                <div class="card-body">									
									<div class="card-box table-responsive">
                                          <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                											  
												  <th>KODE</th>
												  <?php
													$query = mysqli_query($koneksi,"SELECT * FROM kelas");
													while ($data = mysqli_fetch_array($query)) :											 
													?>
												  <th><?= $data['kelas'] ?></th>
												  <?php endwhile; ?>
                                                 						 
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT * FROM mapel");
											  while ($data = mysqli_fetch_array($query)) :											 
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                
                                                  <td><?= $data['kode'] ?></td>
													 <?php
													$queryx = mysqli_query($koneksi,"SELECT * FROM kelas");
													while ($datax = mysqli_fetch_array($queryx)) :
													$jum = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_harian where mapel='$data[id]' and kelas ='$datax[kelas]'"));
													?>
												  <td>
												  <?php if($jum<>0): ?>
												  <?= $jum ?> data
												  <?php endif; ?>
												  </td>
												  <?php endwhile; ?>
													
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
									  <form method="GET" action="cetak/ctnilai.php" target="_blank"  enctype="multipart/form-data">
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE hari='$hari' GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT hari,guru FROM jadwal_mengajar WHERE hari='$hari' and guru='$id_user' GROUP BY guru");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<?php $peg=fetch($koneksi,'users',['id_user' => $data['guru']]); ?>
											<option value="<?= $data['guru'] ?>"><?= $peg['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">CETAK</button>                           
										</div>
										</form>
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
							url: "agenda/tagenda.php?pg=kelas", 
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
							url: "agenda/tagenda.php?pg=mapel", 
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
									url: 'nilai/input.php',
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
									window.location.replace('?pg=<?= enkripsi("nilai") ?>');
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
					  
					  
					  
					  	  
					  
					  
					