<?php
defined('APK') or exit('No Access');
$hari = date('D');
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
 	$mpl = fetch($koneksi,'mapel',['id'=> $mapelmu]);
	$kls = fetch($koneksi,'kelas',['kelas'=>$kelasmu]);
	$kuri = $kls['kuri'];
	$tingkat = $kls['level'];
	?>
                   <div class="row">
				   <?php if($kelasmu==''): ?>		
                          <div class="col-md-8">
						<?php else: ?>
							  <div class="col-md-12">
							<?php endif; ?>
                                <div class="card">
                                   <div class="card card-header">
                                     <h5 class="bold">NILAI FORMATIF</h5>										
                                 </div>
                                <div class="card-body">	
								<span class="badge badge-dark"><?= $mpl['kode'] ?></span> <span class="badge badge-primary"><?= $kelasmu ?></span>
			
                                        <table id="datatable1" class="table table-bordered" style="width:100%;font-size:12px" >
                                            <thead>
                                                <tr>
                                                  <th width="5%">NO</th>												  
												  <th width="30%">NAMA SISWA</th>
                                                  <th width="30%">KURANG</th>
												  <th width="30%">TERCAPAI</th>
												   <th width="5%"></th>
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$kelasmu'");
											while ($data = mysqli_fetch_array($query)) :
											 $formatif = fetch($koneksi,'nilai_formatif',['idsiswa'=>$data['id_siswa'],'mapel=>$mapelmu','smt'=>$semester,'tp'=>$tapel,'guru'=>$gurumu]);
											$no++;
											
											$jum = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_formatif where idsiswa='$data[id_siswa]' and mapel='$mapelmu' and tp='$tapel' and smt='$semester' and guru='$gurumu'"));				
											?>
											   <tr style="vertical-align:top;">
                                                <td><?= $no; ?></td>
												<td><?= $data['nama'] ?></td>
												<td><?= $formatif['rendah'] ?></td>
												<td><?= $formatif['tinggi'] ?></td>
												<td>
												<?php if($jum==0): ?>
											<button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#example<?= $data['id_siswa'] ?>"><i class="material-icons">edit</i> </button>
											<?php else: ?>
											<button type="button" class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i> </button>
											<?php endif; ?>
											<div class="modal fade" id="example<?= $data['id_siswa'] ?>" tabindex="-1" aria-labelledby="example<?= $data['id_siswa'] ?>" aria-hidden="true">
											 <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                          <h5>NILAI FORMATIF <span class="badge badge-secondary"><?= strtoupper($data['nama']) ?></span></h5>                                                               
                                                       </div>
                                                    <div class="modal-body">
													<div class="alert alert-costum" role="alert">
													<b>Pilihan boleh lebih dari 1</b><br>
													Plihan pada TP Tercapai tidak boleh sama pada pilihan TP Kurang Tercapai, dan data ini akan Tampil pada <b>Capaian Kompetensi Rapor</b>
													</div>		
													<form id="form<?= $data['id_siswa'] ?>" action=''>	
													<input type="hidden" name="ids" value="<?= $data['id_siswa'] ?>" >
													<input type="hidden" name="kelas" value="<?= $data['kelas'] ?>" >
													<input type="hidden" name="mapel" value="<?= $mapelmu ?>" >
													<input type="hidden" name="guru" value="<?= $gurumu ?>" >
													
													<div class="row">
													<div class="col-md-6">
													<label class="form-label bold">KURANG TERCAPAI</label>
													<?php
											       $que = mysqli_query($koneksi,"SELECT * FROM tujuan WHERE level='$tingkat' and mapel='$mapelmu' and smt='$semester'");
											       while ($tuju = mysqli_fetch_array($que)) :
											       ?>
												    
													<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="rendah[]" value="<?= $tuju['tujuan'] ?>" /> 
								                    <span class="check"></span><?= $tuju['tujuan'] ?></label>
													<?php endwhile; ?> 
													 </div>
													 <div class="col-md-6">
													 <label class="form-label bold">TERCAPAI</label>
													 <?php
													$queryq = mysqli_query($koneksi,"SELECT * FROM tujuan WHERE level='$tingkat' and mapel='$mapelmu' and smt='$semester'");
													while ($tj = mysqli_fetch_array($queryq)) :
													?>
													<label class="checkbox"><input class='hidden radio-label' type='checkbox' name="tinggi[]" value="<?= $tj['tujuan'] ?>" /> 
													<span class="check"></span><?= $tj['tujuan'] ?></label>
													<?php endwhile; ?> 	
													  </div>
													   </div>
													<div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                                    </div>
												 </form>
												 </div>
                                                </div>
                                                </div>
												</div>
												</td>
												<script>
												$('#form<?= $data[id_siswa] ?>').submit(function(e) {								
														e.preventDefault();
														var data = new FormData(this);
														$.ajax({
														    type: 'POST',
														    url: 'nilai/tnilaiformatif.php',
															enctype: 'multipart/form-data',
															data: data,
															cache: false,
															contentType: false,
															processData: false,
															success: function(data) {
															if (data == 'OK') {														
															setTimeout(function()
															{
															   window.location.reload();
															}, 500);
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
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">Pilih Kelas</button>
                             
											</div>
											
										<script type="text/javascript">
										$('#pilih').click(function() {
										
										var k = $('.kelas').val();
										var g = $('.guru').val();
										var m = $('.mapel').val();
										
										location.replace("?pg=<?= enkripsi('formatif') ?>&k=" + k + "&g=" + g + "&m=" + m);
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
				 
							
						
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					