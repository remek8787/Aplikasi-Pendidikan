<?php
defined('APK') or exit('No Access');
?>       
<?php include"nilai/radio.php"; ?>    
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
	 if (empty($_GET['ki'])) {
        $ki = "";
    } else {
        $ki = $_GET['ki'];
    }
 	$mpl = fetch($koneksi,'mapel',['id'=> $mapelmu]);
	$kls = fetch($koneksi,'kelas',['kelas'=>$kelasmu]);
	$kuri = $kls['kuri'];
	$level = $kls['level'];
	?>
                   <div class="row">
				   <?php if($kelasmu==''): ?>		
                          <div class="col-md-8">
						<?php else: ?>
							  <div class="col-md-12">
							<?php endif; ?>
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="bold">
										SIKAP
										<?php if($ki=='SPI'): ?>
										SPIRITUAL
										<?php endif; ?>
										<?php if($ki=='SOS'): ?>
										SOSIAL
										<?php endif; ?>
										</h5>
										<?php if($kelasmu<>''): ?>	
									<div class="pull-right">
                                      <a href="?pg=<?= enkripsi('nsikap') ?>" class="btn btn-primary kanan">BACK</a>
                                     </div>	
									 <?php endif; ?>
                                    </div>
                                <div class="card-body">	
								<span class="badge badge-dark"><?= $mpl['kode'] ?></span> <span class="badge badge-primary"><?= $kelasmu ?></span>			
                                        <table id="datatable1" class="table table-bordered" style="width:100%;font-size:12px" >
                                            <thead>
                                                <tr style="vertical-align:middle" class="text-center">
                                                <th width="5%" >NO</th>												  
												<th width="30%">NAMA SISWA</th>
												<th width="30%">MULAI MENINGKAT</th>
												<th width="30%">SELALU DILAKUKAN</th>
												<th width="5%">PRED</th>
												 <th width="5%" ></th>
												  </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$kelasmu'");
											while ($data = mysqli_fetch_array($query)) :			
											$des = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_sikap where ket='$ki' and idsiswa='$data[id_siswa]' and mapel='$mapelmu' and tp='$tapel' and smt='$semester'"));
											$jum = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_sikap where ket='$ki' and idsiswa='$data[id_siswa]' and mapel='$mapelmu' and tp='$tapel' and smt='$semester'"));				
											
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                <td><?= $no; ?></td>
												<td><?= $data['nama'] ?></td>
												<td><?= $des['desmin'] ?></td>
												<td><?= $des['desmax'] ?></td>	
												<td><?= $des['pred'] ?></td>	
												<td>
												<?php if($jum==0): ?>
												<a href="?pg=<?= enkripsi('nsikap') ?>&ac=<?= enkripsi('edit') ?>&ids=<?= $data['id_siswa'] ?>&ki=<?= $ki ?>&m=<?= $mapelmu ?>
												&k=<?= $kelasmu ?>&g=<?= $gurumu ?>" class="btn btn-sm btn-success">
												<i class="material-icons">edit</i></a>
												<?php else: ?>
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
							<?php if($kelasmu==''): ?>			
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
									
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $semester ?>"><?= $semester ?></option>
									    </select>
                                       </div>
									
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select guru' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM jadwal_mengajar  GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM jadwal_mengajar WHERE  guru='$id_user' GROUP BY guru");
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
									  <label class="bold">Sikap</label>
                                       <select name="ki"  id="ki" class='form-select ki' style='width:100%' required="true" > 
									   <option value="">Pilih Sikap</option>
									    <option value="SPI">Spiritual</option>
										 <option value="SOS">Sosial</option>
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
										
										<script type="text/javascript">
										$('#pilih').click(function() {							
										var k = $('.kelas').val();
										var g = $('.guru').val();
										var m = $('.mapel').val();
										var ki = $('.ki').val();
										location.replace("?pg=<?= enkripsi('nsikap') ?>&k=" + k + "&g=" + g + "&m=" + m + "&ki=" + ki);
										}); 
									</script>
									 </div>
					            </div>
								</div>
								<?php endif; ?>
							</div>
						
					<script>
					$("#guru").change(function() {
						var guru = $(this).val();						
						console.log(guru);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=kelas", 
							data: "guru=" + guru, 
							success: function(response) { 
							$("#kelas").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#ki").change(function() {
						var ki = $(this).val();
						var guru = $("#kelas").val();
						console.log(ki + kelas);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=mapelsikap", 
							data: "kelas=" + kelas +  "&ki=" + ki, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>						
				<?php elseif ($ac == enkripsi('edit')): ?>
                 <?php include"nilai/radio.php"; ?>   
				             <?php
							   $ids = $_GET['ids'];
							   $k = $_GET['k'];
							   $m = $_GET['m'];
							   $g = $_GET['g'];
							   $ki = $_GET['ki'];
							   $siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
							   $level = $siswa['level'];
								?>				 
                      <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">	
									
									<?php if($ki=='SPI'): ?>
									<form id='formspi' >
									<input type="hidden" name="ids" value="<?= $ids ?>" >
									<input type="hidden" name="kelas" value="<?= $k ?>" >
									<input type="hidden" name="mapel" value="<?= $m ?>" >
									<input type="hidden" name="guru" value="<?= $g ?>" >
									<input type="hidden" name="ki" value="<?= $ki ?>" >
									 <div class="row">
									<div class="col-md-5">
										<label class="bold">MULAI MENINGKAT</label><br>
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM m_spiritual"); 	
									while ($data = mysqli_fetch_array($query)) :
									?>
                                   <label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="<?= $data['ket'] ?>" /> 
								    <span class="check"></span><?= $data['ket'] ?></label>
									<?php endwhile; ?>
									</div>
									
									<div class="col-md-5">
									<label class="bold">SELALU DILAKUKAN</label><br>
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM m_spiritual"); 	
									while ($datax = mysqli_fetch_array($query)) :
									?>
                                   <label class="checkbox"><input class='hidden radio-label' type='radio' name="tinggi" value="<?= $datax['ket'] ?>" /> 
								    <span class="check"></span><?= $datax['ket'] ?></label>
									<?php endwhile; ?>
									</div>
									<div class="col-md-2">
									<label class="bold">PREDIKAT</label><br>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="A" required="true" /> 
									<span class="check"></span>Sangat Baik</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="B" required="true" /> 
									<span class="check"></span>Baik</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="C" required="true" /> 
									<span class="check"></span>Cukup Baik</label>
									</div>
									</div>
									<div class="kanan">
									 <button type="submit" class="btn btn-primary">Simpan</button>
									 </div>
									 </form>
									 <script>
												$('#formspi').submit(function(e) {								
														e.preventDefault();
														var data = new FormData(this);
														$.ajax({
														    type: 'POST',
														    url: 'nilai/tsikap.php?pg=spi',
															enctype: 'multipart/form-data',
															data: data,
															cache: false,
															contentType: false,
															processData: false,
																		
															success: function(data) {
															if (data == 'OK') {	
															$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');			
															setTimeout(function()
															{
															   window.location.replace("?pg=<?= enkripsi('nsikap') ?>&k=<?= $k ?>&ki=<?= $ki ?>&g=<?= $g ?>&m=<?= $m ?>");
															}, 2000);
															 } else {
															 iziToast.warning(
															{
															title: 'Gagal!',
															message: 'Data Tidak boleh sama',
															titleColor: '#FFFF00',
															messageColor: '#fff',
															backgroundColor: '#8b0000',
															progressBarColor: '#FFFF00',
															position: 'topRight'
															});
																
														   }			
														}
													});
													return false;
												});																
												</script>
            
									<?php else: ?>
									<form id='formsos' >
									<input type="hidden" name="ids" value="<?= $ids ?>" >
									<input type="hidden" name="kelas" value="<?= $k ?>" >
									<input type="hidden" name="mapel" value="<?= $m ?>" >
									<input type="hidden" name="guru" value="<?= $g ?>" >
									<input type="hidden" name="ki" value="<?= $ki ?>" >
									 <div class="row">
									<div class="col-md-5">
										<label class="bold">MULAI MENINGKAT (Pilih Salah Satu)</label><br>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="jujur" /> 
									<span class="check"></span>jujur</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="disiplin" /> 
									<span class="check"></span>disiplin</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="tanggung jawab" /> 
									<span class="check"></span>tanggung jawab</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="santun" /> 
									<span class="check"></span>santun</label>			
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="percaya diri" /> 
									<span class="check"></span>percaya diri</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="peduli" /> 
									<span class="check"></span>peduli</label>	
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="toleransi" /> 
									<span class="check"></span>toleransi</label>
									</div>
									
									<div class="col-md-5">
									<label class="bold">SELALU DILAKUKAN (Boleh Lebih dari Satu)</label><br>
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="jujur" /> 
									<span class="check"></span>jujur</label>
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="disiplin" /> 
									<span class="check"></span>disiplin</label>
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="tanggung jawab" /> 
									<span class="check"></span>tanggung jawab</label>
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="santun" /> 
									<span class="check"></span>santun</label>			
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="percaya diri" /> 
									<span class="check"></span>percaya diri</label>
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="peduli" /> 
									<span class="check"></span>peduli</label>	
									<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="toleransi" /> 
									<span class="check"></span>toleransi</label>
									</div>
									<div class="col-md-2">
									<label class="bold">PREDIKAT</label><br>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="A" required="true" /> 
									<span class="check"></span>Sangat Baik</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="B" required="true" /> 
									<span class="check"></span>Baik</label>
									<label class="checkbox"><input class='hidden radio-label' type='radio' name="pred" value="C" required="true" /> 
									<span class="check"></span>Cukup Baik</label>
									</div>
									</div>
									<div class="kanan">
									 <button type="submit" class="btn btn-primary">Simpan</button>
									 </div>
									 </form>
									  <script>
												$('#formsos').submit(function(e) {								
														e.preventDefault();
														var data = new FormData(this);
														$.ajax({
														    type: 'POST',
														    url: 'nilai/tsikap.php?pg=sos',
															enctype: 'multipart/form-data',
															data: data,
															cache: false,
															contentType: false,
															processData: false,
																		
															success: function(data) {
															if (data == 'OK') {	
															$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');			
															setTimeout(function()
															{
															   window.location.replace("?pg=<?= enkripsi('nsikap') ?>&k=<?= $k ?>&ki=<?= $ki ?>&g=<?= $g ?>&m=<?= $m ?>");
															}, 2000);
															 } else {
															 iziToast.warning(
															{
															title: 'Gagal!',
															message: 'Data Tidak boleh sama',
															titleColor: '#FFFF00',
															messageColor: '#fff',
															backgroundColor: '#8b0000',
															progressBarColor: '#FFFF00',
															position: 'topRight'
															});
																
														   }			
														}
													});
													return false;
												});																
												</script>
									<?php endif; ?>
									
									
								</div>
							</div>	
						</div>
					</div>
				
												
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					