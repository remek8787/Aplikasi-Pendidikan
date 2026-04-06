     <?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
<?php if ($ac == '') : ?>
 <?php

    if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
     if (empty($_GET['guru'])) {
        $guru = "";
    } else {
        $guru = $_GET['guru'];
    }

    if (empty($_GET['eskul'])) {
        $guru = "";
    } else {
        $eskul = $_GET['eskul'];
    }

    ?>	
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">PESERTA ESKUL <span class="badge badge-primary"><?= strtoupper($eskul) ?></span></h5>
										
                                    </div>
                                    <div class="card-body">
										<p>Pilih Siswa yang mengikuti Eskul ini</p>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                   <th>NIS</th>
                                                    <th>NAMA LENGKAP</th>
													 <th>ROMBEL</th>
													 <th>PILIH</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$no=0;										
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE NOT EXISTS(SELECT * FROM peskul WHERE siswa.id_siswa=peskul.idsiswa AND peskul.eskul='$eskul') AND kelas='$kelas'");                                       
											  while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>                           
                                                     <td><?= $data['nis'] ?></td>
													 <td><?= ucwords(strtolower($data['nama'])); ?></td>
													 <td><?= $data['kelas'] ?></td>
													 <td>
													<a href="?pg=<?= enkripsi('peskul') ?>&ac=<?= enkripsi('input') ?>&ids=<?= $data['id_siswa'] ?>&e=<?= $eskul ?>&g=<?= $guru ?>" class="btn btn-sm btn-primary"><i class="material-icons">add</i></a>
															
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
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">                                    
										<h5 class="card-title">PESERTA ESKUL</h5>									
									</div>
                                    <div class="card-body">
									
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">INPUT PESERTA</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											<p>
                                             <div class="widget-payment-request-info-item">	
									<label class="bold">Semester</label>
								<div class="input-group mb-2">
								<select name='smt'  class='form-select' required='true' style="width: 100%">
								    <option value="<?= $setting['semester'] ?>"><?= $setting['semester'] ?></option>									
									 </select>
							     </div>															 
                                   									
									<label class="bold">Pilih Kelas</label>
									  <div class="input-group mb-2">
                                     <select id='kelas'  class='form-select kelas' required='true' style="width: 100%">
								    	 <?php $kls = mysqli_query($koneksi, "SELECT kelas FROM siswa group by kelas"); ?>
										 	<option value=''>Pilih Kelas</option>
													<?php while ($k = mysqli_fetch_array($kls)): ?>
														<option <?php if ($kelas == $k['kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $k['kelas'] ?>"><?= $k['kelas'] ?></option>
                                           <?php endwhile; ?>							
									 </select>                                    
									   </div>
									   <label class="bold">Ekstrakurikuler</label>
								<div class="input-group mb-2">
								<select id="eskul" name="eskul" class='form-select eskul' required='true' style="width: 100%">
								   <?php
													if($user['level']=='admin'){
													$esk = mysqli_query($koneksi, "SELECT * FROM m_eskul");
													}else{
													$esk = mysqli_query($koneksi, "SELECT * FROM m_eskul where guru='$user[id_user]'");
													}
													?>
													<option value=''>Pilih Eskul</option>
													<?php while ($eskuler = mysqli_fetch_array($esk)): ?>
														<option <?php if ($eskul == $eskuler['eskul']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $eskuler['eskul'] ?>"><?= $eskuler['eskul'] ?></option>
                                           <?php endwhile; ?>		
									 </select>
							     </div>		
								<label class="bold">Guru Pembina</label>
								<div class="input-group mb-2">
								<select id="guru" name="guru" class='form-select guru' required='true' style="width: 100%">
								  				
									 </select>
							     </div>									 
									   <div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button  id="simpan" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
                                            </div>
												<script type="text/javascript">
                                $('#simpan').click(function() {
                                    var kelas = $('.kelas').val();
                                    var guru = $('.guru').val();
									var eskul = $('.eskul').val();
                                    location.replace("?pg=<?= enkripsi('peskul') ?>&kelas=" + kelas + "&guru=" + guru + "&eskul=" + eskul);
                                }); 
                            </script>                                             
                                                </div>                                               
                                            </div>
									   </div>
									  
					               </div>								   
								</div>
							</div>
							
						</div>
					</div>
					<script>	
							$("#eskul").change(function() {
							var eskul = $(this).val();
							console.log(eskul);
							$.ajax({
							type: "POST",
							url: "eskul/teskul.php?pg=guru", 
							data: "eskul=" + eskul, 
							success: function(response) { 
							$("#guru").html(response);
							
									}
								});
							});
							</script>
                    <?php elseif ($ac == enkripsi('input')) : ?>     
						<?php
						$ids = $_GET['ids'];
						$eskul = $_GET['e'];
						$guru = $_GET['g'];
						$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
						$kelas = $siswa['kelas'];
						?>
						<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">PESERTA ESKUL <span class="badge badge-primary"><?= strtoupper($eskul) ?></span></h5>
										
                                    </div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                   <th>NIS</th>
                                                    <th>NAMA LENGKAP</th>
													 <th>ROMBEL</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$no=0;										
											$query = mysqli_query($koneksi,"SELECT * FROM siswa where id_siswa='$ids'");                                        
											  while ($data = mysqli_fetch_array($query)) :
											  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>                           
                                                     <td><?= $data['nis'] ?></td>
													 <td><?= ucwords(strtolower($data['nama'])); ?></td>
													 <td><?= $data['kelas'] ?></td>
													
													 
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									     
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">                                    
										<h5 class="card-title">PESERTA ESKUL</h5>									
									</div>
                                    <div class="card-body">
									
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">INPUT PESERTA</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											<p>
                                             <div class="widget-payment-request-info-item">	
											 <form id="formpeskul">
									<label class="bold">Nama Siswa</label>
								<div class="input-group mb-2">
								<select name='nis' class='form-select' required='true' style="width: 100%">
								    <option value="<?= $siswa['id_siswa'] ?>"><?= $siswa['nama'] ?></option>									
									 </select>
							     </div>															 
                                   									
									<label class="bold">Kelas</label>
									  <div class="input-group mb-2">
                                     <select name='kelas'  class='form-select' required='true' style="width: 100%">							    	
									<option value="<?= $kelas ?>"><?= $kelas ?></option>						
									 </select>                                    
									   </div>
									   <label class="bold">Ekstrakurikuler</label>
								<div class="input-group mb-2">
								<select name="eskul" class='form-select eskul' required='true' style="width: 100%">
								   <option value="<?= $eskul ?>"><?= $eskul ?></option>	
									 </select>
							     </div>		
									<input type="hidden" name="guru" value="<?= $guru ?>" > 
									   <div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button  type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                            </div>
												                          
                                                </div> 
                                               </form>												
                                            </div>
									   </div>
									  
					               </div>								   
								</div>
							</div>
							
						</div>
					</div>
						
					
					 
					 
					 <?php endif ?> 
					 	
						
						
						 <script>
												$('#formpeskul').submit(function(e){
													e.preventDefault();
													var data = new FormData(this);
													$.ajax(
													{
														type: 'POST',
														 url: 'eskul/teskul.php?pg=tambah',
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
														 setTimeout(function() {
                                                        window.location.replace('?pg=<?= enkripsi(peskul) ?>&kelas=<?= $kelas ?>&eskul=<?= $eskul ?>&guru=<?= $guru ?>');
                                                          }, 2000);
																	
															} else {
															iziToast.error(
														{
															 title: 'Gagal!',
															message: 'Data sudah ada',
															titleColor: '#FFFF00',
															messageColor: '#fff',
															backgroundColor: 'rgba(0, 0, 0, 0.5)',
															 progressBarColor: '#FFFF00',
															  position: 'topRight'				  
															});
															setTimeout(function() {
																window.location.replace('?pg=peskul&kelas=<?= $kelas ?>&eskul=<?= $eskul ?>&guru=<?= $guru ?>');
															}, 2000);
															}
														}															
																});
															return false;
														});
													</script>	
