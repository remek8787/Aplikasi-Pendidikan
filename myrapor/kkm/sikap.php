<?php
defined('APK') or exit('No Access');
?>     
	
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">KKM RAPOR K-2013</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                <th>NO</th>
                                                <th>MATA PELAJARAN</th>
												<th>SIKAP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE sikap<>'' and kuri='1' GROUP BY idmapel");											
											while ($data = mysqli_fetch_array($query)) :
											$mpl = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
											 $no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
												<td><?= $mpl['nama_mapel'] ?></td>	
												<td>
												<?php if($data['sikap']=='1'): ?>
												<span class="badge badge-success">SPIRITUAL</span>
												<?php else: ?>
												<span class="badge badge-primary">SOSIAL</span>
												<?php endif; ?>
												</td>									
												
                                                </tr>
												<?php endwhile; ?>
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
										 <div class="text-muted">KURIKULUM 2013</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									  
									<form id='formguru' >	
									 <div class="col-md-12 mb-1">
									  <label class="bold">SIKAP SPIRITUAL</label>
                                        <select name='spi'  class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Mapel Agama</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE id between 1 and 2"); ?>
                                                <?php while ($mpl = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $mpl['id'] ?>"><?= $mpl['nama_mapel'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">SIKAP SOSIAL</label>
                                        <select name='sos' class='form-select' style='width:100%' required>
                                          <option value=''>Pilih Mapel PPKN</option>
                                           <?php $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE id between 1 and 2"); ?>
                                                <?php while ($m = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $m['id'] ?>"><?= $m['nama_mapel'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					
			
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'kkm/tkkm.php?pg=sikap',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								
									},
									success: function(data){   		
									setTimeout(function()
										{
										window.location.reload();
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
                        
             