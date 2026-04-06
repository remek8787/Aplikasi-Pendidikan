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
      $kls = fetch($koneksi,'kelas',['kelas'=>$kelas]);
	 $kuri = $kls['kuri'];
    ?>	
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">CATATAN WALAS <span class="badge badge-primary"><?= strtoupper($kelas) ?></span></h5>
										
                                    </div>
                                    <div class="card-body">
										<?php if($kuri=='1'): ?>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                   <th>NIS</th>
                                                    <th>NAMA LENGKAP</th>
													 <th>CATATAN WALAS</th>													 
													 <th>PILIH</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$no=0;										
											$query = mysqli_query($koneksi,"SELECT * FROM siswa where kelas='$kelas'");                                       
											  while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>                           
                                                     <td><?= $data['nis'] ?></td>
													 <td><?= ucwords(strtolower($data['nama'])); ?></td>							
													 <td><?= $data['catatan'] ?></td>	
													 <td>
													<a href="?pg=<?= enkripsi('catatan') ?>&ac=<?= enkripsi('input') ?>&ids=<?= $data['id_siswa'] ?>" class="btn btn-sm btn-primary"><i class="material-icons">add</i></a>												
													 </td>
													 
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
												  <?php elseif($kuri=='2'): ?>
												 <div class="alert alert-danger" role="alert">
													<b>MAAF</b><br>
													HANYA UNTUK RAPOR KURIKULUM 2013</b>
													</div>	
												 <?php endif; ?>
											</div>
										</div>
									</div>
									     
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">                                    
										<h5 class="card-title">CATATAN WALAS</h5>									
									</div>
                                    <div class="card-body">
									
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">INPUT CATATAN</span>
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
								    	<?php 
										 if($user['level']=='admin'){
										 $kls = mysqli_query($koneksi, "SELECT * FROM kelas"); 
										 }else{
										$kls = mysqli_query($koneksi, "SELECT * FROM kelas where kelas='$user[walas]'");
										 } 
										 ?>
										 <option value=''>Pilih Kelas</option>
										<?php while ($k = mysqli_fetch_array($kls)): ?>
										<option <?php if ($kelas == $k['kelas']) {
                                            echo "selected";
                                            } else {
                                            } ?> value="<?= $k['kelas'] ?>"><?= $k['kelas'] ?></option>
                                           <?php endwhile; ?>							
									 </select>                                        
									   </div>
									   
												 
									   <div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button  id="simpan" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
                                            </div>
												<script type="text/javascript">
                                $('#simpan').click(function() {
                                    var kelas = $('.kelas').val();
                                    var guru = $('.guru').val();
									
                                    location.replace("?pg=<?= enkripsi('catatan') ?>&kelas=" + kelas );
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
					
                    <?php elseif ($ac == enkripsi('input')) : ?>     
						<?php
						$ids = $_GET['ids'];
						$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
						$kelas = $siswa['kelas'];
						?>
						<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">CATATAN WALAS <span class="badge badge-primary"><?= strtoupper($kelas) ?></span></h5>
										
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
										<h5 class="card-title">INPUT CATATAN WALAS</h5>									
									</div>
                                    <div class="card-body">
									
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">INPUT CATATAN</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											<p>
                                             <div class="widget-payment-request-info-item">	
											 <form id="formpeskul">
									<label class="bold">Nama Siswa</label>
								<div class="input-group mb-2">
								<select name='ids' class='form-select' required='true' style="width: 100%">
								    <option value="<?= $siswa['id_siswa'] ?>"><?= $siswa['nama'] ?></option>									
									 </select>
							     </div>															 
                                   									
									<label class="bold">Kelas</label>
									  <div class="input-group mb-2">
                                     <select name='kelas'  class='form-select' required='true' style="width: 100%">							    	
									<option value="<?= $kelas ?>"><?= $kelas ?></option>						
									 </select>                                    
									   </div>
									   <label class="bold">Catatan</label>
								<div class="input-group mb-2">
								<textarea class="form-control" name="catat" rows="5"><?= $siswa['catatan'] ?></textarea>
							     </div>		
													   
                                       </div>
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
							
					
					 
					 
					 <?php endif ?> 
					 	
						
						
						 <script>
												$('#formpeskul').submit(function(e){
													e.preventDefault();
													var data = new FormData(this);
													$.ajax(
													{
														type: 'POST',
														 url: 'walas/tsiswa.php?pg=catat',
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
                                            															
														 setTimeout(function() {
                                                        window.location.replace('?pg=<?= enkripsi(catatan) ?>&kelas=<?= $kelas ?>');
                                                          }, 2000);
																	
															
														}															
																});
															return false;
														});
													</script>	
