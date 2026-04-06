<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>      
     
		<?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA TOP UP</h5>										
									</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>TANGGAL</th>
													<th>JAM</th>
                                                    <th>NAMA KONSUMEN</th>
                                                    <th>DEBET</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE debet >0 and idsiswa<>'' ORDER BY tanggal DESC"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['tanggal'] ?></td>
												   <td><?= $data['jam'] ?></td>
                                                  <td><?= $siswa['nama'] ?></td>
                                                  <td><?= number_format($data['debet']) ?></td>
                                                 
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
                                 <div class="card-body" style="height:400px">
									<?php 
									$ids = $_GET['ids'];
									$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
									?>
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									    <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									   <div class="h5 mb-2" style="text-align:center">TOP UP SALDO (Manual)</div>
									<div class="col-md-12">
										<label class="form-label bold">KELAS</label>
											<select class="form-select" name="kelas" id="kelas" required style="width: 100%">
												<option value="">Pilih Kelas</option>
												<?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
							        </select>
										</div>
									 </div>
									</div>
								</div>
							</div>
					
							<script type="text/javascript">
                                $('#kelas').change(function() {
                                    var k = $('#kelas').val();
                                   
                                    location.replace("?pg=<?= enkripsi('topup') ?>&ac=<?= enkripsi('saldo') ?>&k=" + k );
                                }); 
                            </script>
				 <?php elseif($ac == enkripsi('saldo')): ?>
				 
				 <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA SISWA</h5>										
									</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NIS</th>
                                                    <th>NAMA SISWA</th>
                                                    <th>SALDO</th> 
													 <th></th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$_GET[k]' and nokartu<>''"); 
											  while ($data = mysqli_fetch_assoc($query)) :											 
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
                                                  <td><?= $data['nama'] ?></td>
                                                  <td><?= number_format($data['saldo']) ?></td>
                                                   <td>
											       <a href="?pg=<?= enkripsi('topup') ?>&ac=<?= enkripsi('saldo') ?>&ids=<?= $data['id_siswa'] ?>&k=<?= $data['kelas'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Saldo"><i class="material-icons">edit</i></button></a>
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
                              <div class="card">
                                 <div class="card-body">
									<?php 
									$ids = $_GET['ids'];
									$siswa = fetch($koneksi,'siswa',['id_siswa'=>$ids]);
									?>
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									    <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									   <div class="h5 mb-2" style="text-align:center">TOP UP SALDO (Manual)</div>
									<form id='formkartu' >	
									 <label class="bold">N I S</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nis' class='form-control' value="<?= $siswa['nis'] ?>" required="true"/>
									    <input type='hidden' name='ids' class='form-control' value="<?= $siswa['id_siswa'] ?>"   />
									   
                                        </div>	
										 <label class="bold">Nama Lengkap</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' value="<?= $siswa['nama'] ?>" required="true" />
                                        </div>
										<label class="bold">Rombel</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kelas' class='form-control' value="<?= $siswa['kelas'] ?>" required="true" />
                                        </div>
										<div class='col-md-12 mb-1'>
											<label class="bold">Sebesar RP</label>
												<input type='text' name='besar' id="duit" class='form-control' required='true' >
											</div>
										<?php if($ids !=''): ?>
										<div class="d-grid gap-2">
										<br>
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										<?php endif; ?>
										</form>
									 </div>
									</div>
								</div>
							</div>
					<script>
					$('#formkartu').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'siswa/tsaldo.php',
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
								window.location.replace('?pg=<?= enkripsi("topup") ?>');
										}, 1000);
													  
										}
									});
								return false;
							});
						</script>		
				 <?php endif; ?>