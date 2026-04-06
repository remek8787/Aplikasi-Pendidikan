<?php
defined('APK') or exit('No Access');
?>     
		 <?php if ($ac == '') : ?>
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
                                                <th>TKT</th>
												<th>KELAS</th>
												<th>MODE KKM</th>                                                    
												<th>KKM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT level,kuri,mode_kkm FROM kelas WHERE kuri='1' GROUP BY level");											
											while ($data = mysqli_fetch_array($query)) :
											 $no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
												<td>
												<h5> <span class="badge badge-success"><?= $data['level'] ?></span></h5>
												</td>
												<td>
												<?php											
												$que = mysqli_query($koneksi, "SELECT * FROM kelas WHERE level='$data[level]'");											
												while ($kls = mysqli_fetch_array($que)) :
											   ?>
												<span class="badge badge-dark"><?= $kls['kelas'] ?></span>
												<?php endwhile; ?>			
												</td>
												
												<td><?= strtoupper($data['mode_kkm']) ?></td>									
												<td>
												<?php if($data['mode_kkm']<>''): ?>
												<a href="?pg=<?= enkripsi('kkm') ?>&ac=<?= enkripsi('edit') ?>&lvl=<?= $data['level'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input KKM"><i class="material-icons">add</i> </a>
											    <?php else: ?>
												<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
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
									  <label class="bold">Tingkat</label>
                                        <select name='level' id="level" class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Tingkat</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT level,kuri FROM kelas WHERE kuri='1' GROUP BY level"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['level'] ?>"><?= $kls['level'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">MODEL KKM</label>
                                        <select name='model' class='form-select' style='width:100%' required>
                                          <option value=''>Pilih Model KKM</option>
                                           <option value='single'>SINGLE</option>
											<option value='multi'>MULTI</option>
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
									 url: 'kkm/tkkm.php?pg=edit',
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
                        
             
				 <?php elseif ($ac == enkripsi('edit')): ?>
			        <?php $kls = fetch($koneksi,'kelas',['level'=>$_GET['lvl']]); ?>
					<?php if($kls['mode_kkm']=='single'): ?>
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
												<th>JURUSAN</th>
                                                <th>MATA PELAJARAN</th>
												<th>KKM</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$_GET[lvl]'");											
											while ($data = mysqli_fetch_array($query)) :
											$mpl = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
											 $no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
												<td><?= $data['jurusan'] ?></td>
												<td><?= $mpl['nama_mapel'] ?></td>
												<td><?= $data['kkm'] ?></td>
												
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
										 <div class="text-muted">KURIKULUM 2013</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formsingle' >	
									 <div class="col-md-12 mb-1">
									  <label class="bold">Tingkat</label>
                                       <select name='level' id="level" class='form-select' style='width:100%' required>
                                          <option value="<?= $_GET['lvl'] ?>"><?= $_GET['lvl'] ?></option>
									</select>
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">KKM</label>
									  <input type="number" name="kkm" class="form-control" >
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
							
							$('#formsingle').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'kkm/tkkm.php?pg=single',
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
                        <?php else: ?>
						
							<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">KKM RAPOR K-2013 - MULTI KKM</h5>
										</div>
                                    <div class="card-body">		
									<form id='formmulti' >	
									<div class="card-box table-responsive">
                                        <table id="datata" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                <th>NO</th>
												<th>JURUSAN</th>
                                                <th>MATA PELAJARAN</th>
												<th>KKM</th>                                                
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE level='$_GET[lvl]' and jurusan='$_GET[j]'");											
											while ($data = mysqli_fetch_array($query)) :
											$mpl = fetch($koneksi,'mapel',['id'=>$data['idmapel']]);
											 $no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
												<td><?= $data['jurusan'] ?></td>
												<td><?= $mpl['nama_mapel'] ?></td>
												<td>
												<input type="number" name="kkm[]" value="<?= $data['kkm'] ?>" class="form-control" style="width:100px;" required="true" >
												<input type="hidden" name="idm[]" value="<?= $data['id'] ?>" class="form-control" style="width:100px;"  >
												
												</td>
												
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
												 <div class="kanan">
												<?php if($_GET['j']<>''): ?>
												<button type="submit" class="btn btn-primary">SIMPAN</button>
												<?php endif; ?>
												</div>
											</form>
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
									
									 <div class="col-md-12 mb-1">
									  <label class="bold">Tingkat</label>
                                       <select name='level' id="level" class='form-select level' style='width:100%' required>
                                          <option value="<?= $_GET['lvl'] ?>"><?= $_GET['lvl'] ?></option>
									</select>
                                        </div>
									 <div class="col-md-12 mb-1">
									  <label class="bold">Jurusan</label>
									   <select name='pk' id="pk" class='form-select pk' style='width:100%' required>
                                        <option value=''>Pilih Jurusan</option>
                                        <?php $query = mysqli_query($koneksi, "SELECT level,jurusan FROM kelas WHERE level='$kls[level]' GROUP BY jurusan"); ?>
                                        <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                        <option value="<?= $kls['jurusan'] ?>"><?= $kls['jurusan'] ?></option>
                                          <?php endwhile ?>
										</select>
                                        </div>
										
										<script type="text/javascript">
										$('#pk').change(function() {
										var lvl = $('.level').val();
										var j = $('.pk').val();
										location.replace("?pg=<?= enkripsi('kkm') ?>&ac=<?= enkripsi('edit') ?>&lvl=" + lvl + "&j=" + j);
										}); 
									</script>
										
									 </div>
					            </div>
								</div>
							</div>
						</div>
					
			        <script>
						$('#formmulti').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									url: 'kkm/tkkm.php?pg=multi',
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
									window.location.reload();
										}, 2000);
									}
								})
								return false;
							});
							</script>
						
				<?php endif; ?>
			 <?php endif ?>