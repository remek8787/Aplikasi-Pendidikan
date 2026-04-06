<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>      
     
		<?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA TOP UP PEGAWAI</h5>										
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
											$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE debet >0 and idpeg<>'' ORDER BY tanggal DESC"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											  $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['tanggal'] ?></td>
												   <td><?= $data['jam'] ?></td>
                                                  <td><?= $peg['nama'] ?></td>
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
									$peg = fetch($koneksi,'users',['id_user'=>$ids]);
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
										<label class="form-label bold">JABATAN</label>
											<select class="form-select" name="jabatan" id="jabatan" required style="width: 100%">
												<option value="">Pilih Jabatan</option>
												<?php
										$kls = mysqli_query($koneksi, "SELECT jabatan,level FROM users WHERE level<>'admin' GROUP BY jabatan");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[jabatan]'>$kelas[jabatan]</option>";
										}
										?>
							        </select>
										</div>
									 </div>
									</div>
								</div>
							</div>
					
							<script type="text/javascript">
                                $('#jabatan').change(function() {
                                    var j = $('#jabatan').val();
                                   
                                    location.replace("?pg=<?= enkripsi('toppegawai') ?>&ac=<?= enkripsi('saldo') ?>&j=" + j );
                                }); 
                            </script>
				 <?php elseif($ac == enkripsi('saldo')): ?>
				 
				 <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA PEGAWAI</h5>										
									</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NIP</th>
                                                    <th>NAMA PEGAWAI</th>
                                                    <th>SALDO</th> 
													 <th></th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE jabatan='$_GET[j]' and nokartu<>''"); 
											  while ($data = mysqli_fetch_assoc($query)) :											 
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nip'] ?></td>
                                                  <td><?= $data['nama'] ?></td>
                                                  <td><?= number_format($data['saldo']) ?></td>
                                                   <td>
											       <a href="?pg=<?= enkripsi('toppegawai') ?>&ac=<?= enkripsi('saldo') ?>&ids=<?= $data['id_user'] ?>&j=<?= $data['jabatan'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Saldo"><i class="material-icons">edit</i></button></a>
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
									$peg = fetch($koneksi,'users',['id_user'=>$ids]);
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
									 <label class="bold">N I P</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nis' class='form-control' value="<?= $peg['nip'] ?>" >
									    <input type='hidden' name='ids' class='form-control' value="<?= $peg['id_user'] ?>"   />
									   
                                        </div>	
										 <label class="bold">Nama Lengkap</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' value="<?= $peg['nama'] ?>"  />
                                        </div>
										<label class="bold">Jabatan</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kelas' class='form-control' value="<?= $peg['jabatan'] ?>" required="true" />
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
							 url: 'siswa/tsaldopeg.php',
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
								window.location.replace('?pg=<?= enkripsi("toppegawai") ?>');
										}, 1000);
													  
										}
									});
								return false;
							});
						</script>		
				 <?php endif; ?>