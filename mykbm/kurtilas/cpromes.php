<?php
defined('APK') or exit('No Access');
?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">PROGRAM SEMESTER</h5>
							</div>
                            <div class="card-body">
								<div class="row">
								<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp group by mapel"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp WHERE guru='$id_user' group by mapel"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
								<div class="col-md-4">
								<div class="card">
								<div class="card-body">
								<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="text-muted">PROMES</div>
									<div class="h5 mb-0"><?= $mpl['kode'] ?> <?= $data['level'] ?></div>
										  <span><?= $peg['nama'] ?></span>
										</div>
									  </div>
									</div>
								</div>	
								</div>	
								<?php endwhile; ?>
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
									 <form method="GET" action="kurtilas/promes.php" target="_blank"  enctype="multipart/form-data">
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="">Pilih Semester</option>
									   <option value="1">1</option>
									   <option value="2">2</option>
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM jadwal_mengajar  GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM jadwal_mengajar WHERE guru='$id_user' GROUP BY guru");
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
					<script>
					$("#guru").change(function() {
						var guru = $(this).val();						
						console.log(guru);
						$.ajax({
							type: "POST",
							url: "adm/ambildata.php?pg=kelas", 
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
							url: "adm/ambildata.php?pg=mapel",  
							data: "kelas=" + kelas + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
					
                
            