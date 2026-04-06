<?php
defined('APK') or exit('No Access');
$ref = fetch($koneksi,'jadwal_refleksi',['id'=>$_GET['id']]);
$pel = fetch($koneksi,'mapel',['id'=>$ref['idmapel']]);
$peg = fetch($koneksi,'users',['id_user'=>$ref['idguru']]);
?>     
							<?php 
						   
						    if (empty($_GET['s'])) {
								$ids = "";
						   }else{
							   $ids = $_GET['s'];
						   }
						     $sis = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
							$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_refleksi where idsiswa='$ids' and tanggal='$ref[tanggal]' and mapel ='$ref[idmapel]'"));
						   ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title"><?= $sis['nama'] ?></h5>
										</div>
                                    <div class="card-body">
									<?php if($jsis==0): ?>
									<form id="formnilai">
									<input type="hidden" name="ids" value="<?= $ids ?>">
									<input type="hidden" name="tgl" value="<?= $ref['tanggal'] ?>">
									<input type="hidden" name="mapel" value="<?= $ref['idmapel'] ?>">
                                     <div class="row">
									<div class="col-md-6">
									<label class="bold">PENILAIAN TERHADAP SISWA</label>
                                        <select name='nilai'  class='form-select' style='width:100%' required>
                                              <option value=''>Pilih</option>
                                            <option value='A'>Sangat Baik</option>
											<option value='B'>Baik</option>
											<option value='C'>Cukup</option>
										     <option value='D'>Kurang</option>
										</select>
									</div>
									<div class="col-md-6">
									<br>
									 <button type="submit" class="btn btn-primary">SIMPAN</button>
									     </div>
										</div>
										</form>
										<?php endif; ?>
										<br>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
													<th>PERTANYAAN</th>
													<th>JAWABAN</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;											
											$query = mysqli_query($koneksi, "SELECT * FROM jawaban_refleksi where idmapel='$ref[idmapel]' and idsiswa='$ids' and tanggal='$ref[tanggal]'");											
											  while ($data = mysqli_fetch_array($query)) :						 
											  $soal = fetch($koneksi,'refleksi',['id'=>$data['idsoal']]);
											 
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $soal['soal'] ?></td>
												<td><?= $data['jawaban'] ?></td>
												
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
									<script>
							$('#formnilai').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'refleksi/tref.php?pg=nilai',
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
										window.location.replace("?pg=<?= enkripsi('jaref') ?>&id=<?= $_GET['id'] ?>");
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
                        
									
									
									 <?php if ($ac == '') : ?>
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
									  <label class="bold">TANGGAL</label>
                                        <select name='tgl' id='tgl' class='form-select' style='width:100%' required>
                                           <option value="<?= $ref['tanggal'] ?>"><?= $ref['tanggal'] ?></option>
											</select>
                                        </div>
										        
										<div class="col-md-12 mb-1">
									  <label class="bold">MATA PELAJARAN</label>
                                        <select name='mapel' id='mapel' class='form-select' style='width:100%' required>
                                              <option value="<?= $ref['idmapel'] ?>"><?= $pel['nama_mapel'] ?></option>
												 </select>
                                        </div>
									  <div class="col-md-12 mb-1">
									  <label class="bold">KELAS</label>
                                        <select name='kelas' id="kelas" class='form-select' style='width:100%' required>
                                             <option value="<?= $ref['kelas'] ?>"><?= $ref['kelas'] ?></option>
											</select>
                                        </div>
										<input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>" >
										  <div class="col-md-12 mb-1">
									  <label class="bold">NAMA SISWA</label>
                                        <select name='siswa' id="siswa" class='form-select' style='width:100%' required>
                                            <?php
											 $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$ref[kelas]'");
												echo "<option value=''>Pilih Siswa</option>";
											while ($data = mysqli_fetch_array($sql)) {
											echo "<option value='$data[id_siswa]'>$data[nama]</option>";
                                            }  
											?>
											</select>
                                        </div>                      
										
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
					
					<script type="text/javascript">
									 $('#siswa').change(function() {
									var s = $('#siswa').val();
									var id = $('#id').val();
									location.replace("?pg=<?= enkripsi('jaref') ?>&s=" + s + "&id=" +id);
									  }); 
								   </script>
				 <?php endif ?>
					 
							
                                 