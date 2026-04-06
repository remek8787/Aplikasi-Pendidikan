					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">DINAS LUAR</h5>
									</div>									
                                    <div class="card-body">
									<p style="color:red"> Jika Sudah Kembali maka Wajib dihapus</p>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                                   
										  <th>N I P</th>
                                          <th>NAMA PEGAWAI</th>
										  <th>JABATAN</th>
										  <th width="15%"></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM data_luar where jenis='1'"); 
											while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											$no++;
											   ?>
                                            <tr>
                                             <td><?= $no; ?></td>                  
											  <td><?= $peg['nip'] ?></td>
                                             <td><?= $peg['nama'] ?></td>
											<td><?= $peg['jabatan'] ?></td>
											<td>
										
											<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
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
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/absen.png" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0">PRESENSI LUAR</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									<form id='formguru' >	
									 <label class="bold">PEGAWAI</label>
									 <div class="input-group mb-1">
                                    <select class="form-select" name="idpeg" required style="width: 100%">
							<option value="">Pilih Pegawai</option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin'");
										while ($k = mysqli_fetch_array($kls)) {
										echo "<option value='$k[id_user]'>$k[nama]</option>";
										}
										?>
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
					
	
											<script>
											$('#formguru').submit(function(e){
												e.preventDefault();
												var data = new FormData(this);
												$.ajax(
												{
													type: 'POST',
													 url: 'gps/tdinlu.php?pg=tambah',
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
																}, 1000);
																			  
																}
															});
														return false;
													});
												</script>	
                               <script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Hapus Data',
											  text: "Hapus Data Dinas Luar",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya,Hapus',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'gps/tdinlu.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,								
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
												},
												success: function(data) {
											   
												setTimeout(function() {
												window.location.reload();
													}, 1000);
												}
											});
										}
										return false;
									})

								});

							</script>    