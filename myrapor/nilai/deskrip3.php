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
										DESKRIPSI
										<?php if($ki=='KI-3'): ?>
										PENGETAHUAN
										<?php endif; ?>
										<?php if($ki=='KI-4'): ?>
										KETERAMPILAN
										<?php endif; ?>
										</h5>
										<?php if($kelasmu<>''): ?>
                                    <div class="pull-right">
                                      <a href="?pg=<?= enkripsi('deskrip3') ?>" class="btn btn-primary kanan">BACK</a>
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
												<th width="30%">KURANG</th>
												<th width="30%">TERCAPAI</th>
												 <th width="5%" ></th>
												  </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$kelasmu'");
											while ($data = mysqli_fetch_array($query)) :			
											$des = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai_k13 where ket='$ki' and idsiswa='$data[id_siswa]' and mapel='$mapelmu' and tp='$tapel' and smt='$semester'"));
											$jum = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_k13 where ket='$ki' and idsiswa='$data[id_siswa]' and mapel='$mapelmu' and tp='$tapel' and smt='$semester'"));				
											
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                <td><?= $no; ?></td>
												<td><?= $data['nama'] ?></td>
												<td><?= $des['desmin'] ?></td>
												<td><?= $des['desmax'] ?></td>							
												<td>
												<?php if($jum==0): ?>
												<a href="?pg=<?= enkripsi('deskrip3') ?>&ac=<?= enkripsi('edit') ?>&ids=<?= $data['id_siswa'] ?>&ki=<?= $ki ?>&m=<?= $mapelmu ?>
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
										 <div class="col-md-12 mb-1">
									  <label class="bold">Kompetensi</label>
                                       <select name="ki"  id="ki" class='form-select ki' style='width:100%' required="true" > 
									   <option value="">Pilih Kompetensi</option>
									    <option value="KI-3">Pengetahuan</option>
										 <option value="KI-4">Keterampilan</option>
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
										location.replace("?pg=<?= enkripsi('deskrip3') ?>&k=" + k + "&g=" + g + "&m=" + m + "&ki=" + ki);
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
									<form id='formedit' >
									<input type="hidden" name="ids" value="<?= $ids ?>" >
									<input type="hidden" name="kelas" value="<?= $k ?>" >
									<input type="hidden" name="mapel" value="<?= $m ?>" >
									<input type="hidden" name="guru" value="<?= $g ?>" >
									<input type="hidden" name="ki" value="<?= $ki ?>" >
									 <div class="row">
									<div class="col-md-6">
									<label class="bold">KURANG TERCAPAI</label><br>
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM deskripsi WHERE mapel='$m' and level='$level' and smt='$semester' and ki='$ki' and guru='$g'"); 	
									while ($data = mysqli_fetch_array($query)) :
									?>
                                   <label class="checkbox"><input class='hidden radio-label' type='radio' name="rendah" value="<?= $data['deskripsi'] ?>" /> 
								    <span class="check"></span><?= $data['deskripsi'] ?></label>
									<?php endwhile; ?>
									</div>
									
									<div class="col-md-6">
									<label class="bold">TERCAPAI</label><br>
									<?php
									$query = mysqli_query($koneksi, "SELECT * FROM deskripsi WHERE mapel='$m' and level='$level' and smt='$semester' and ki='$ki' and guru='$g'"); 	
									while ($datax = mysqli_fetch_array($query)) :
									?>
                                   <label class="checkbox"><input class='hidden radio-label' type='radio' name="tinggi" value="<?= $datax['deskripsi'] ?>" /> 
								    <span class="check"></span><?= $datax['deskripsi'] ?></label>
									<?php endwhile; ?>
									</div>
									</div>
									<div class="kanan">
									 <button type="submit" class="btn btn-primary">Simpan</button>
									 </div>
									</form>
								</div>
							</div>	
						</div>
					</div>
				
												<script>
												$('#formedit').submit(function(e) {								
														e.preventDefault();
														var data = new FormData(this);
														$.ajax({
														    type: 'POST',
														    url: 'nilai/tdes3.php',
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
															   window.location.replace("?pg=<?= enkripsi('deskrip3') ?>&k=<?= $k ?>&ki=<?= $ki ?>&g=<?= $g ?>&m=<?= $m ?>");
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
            
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					