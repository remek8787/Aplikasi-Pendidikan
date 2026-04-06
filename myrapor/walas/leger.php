     <?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
<?php if ($ac == '') : ?>
 
					<div class="row">
                          <div class="col-md-8">
                             <div class="card">
                                <div class="card-header">
                                     <h5 class="bold">LEGER NILAI </h5>				
                                    </div>
                                    <div class="card-body">
									
											</div>
										</div>
									</div>
									     
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    
                                    <div class="card-body">
									
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">LEGER NILAI</span>
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
									  <label class="bold">Pilih Leger</label>
									  <div class="input-group mb-1">
									  <select id='ket'  class='form-select ket' required='true' style="width: 100%">
									  <option value=''>Pilih Leger</option>
									  <option value='PTS'>PTS <?= $semester ?></option>
									  <?php if($semester=='1'): ?>
									  <option value='PAS'>PAS</option>
									  <?php else: ?>
									  <option value='PAT'>PAT</option>
									  <?php endif; ?>
									</select> 
									 </div>
									   <div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button  id="simpan" class="btn btn-primary flex-grow-1 m-l-xxs">CETAK</button>
                                            </div>
											<script type="text/javascript">
											$('#simpan').click(function() {
												var kelas = $('.kelas').val();												
												var ket = $('.ket').val();
												
												 window.open("walas/cetakleger.php?kelas=" + kelas + "&ket=" + ket,'_blank');
												
											}); 
										</script>                                             
                                                </div>                                               
                                            </div>
									   </div>
									  
					               </div>								   
								</div>
							</div>
							
						</div>
				
					
                   
					 <?php endif ?> 
					 	
						