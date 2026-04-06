<?php
defined('APK') or exit('No Access');
?>     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                  <div class="card card-header">
									<h5 class="card-title">PENGATURAN RAPOR</h5>
										</div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:13px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>                                               
                                                    <th class="text-center">TINGKAT</th>
													<th>KURIKULUM</th>
                                                    <th>KODE KLP</th>	
													<th>KKM</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM kelas group by level");
											  while ($data = mysqli_fetch_array($query)) :
											  $kuri = fetch($koneksi,'m_kurikulum',['idk'=>$data['kuri']]);
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>
                                               <td class="text-center"><?= $data['level'] ?></td>
												<td><?= $kuri['nama_kurikulum'] ?></td>
												 <td><?= $no; ?></td>
												  <td><?= $no; ?></td>
												<td>						
												<button data-id="<?= $data['id_jadwal'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
												</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
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
									<form id='formguru' >	
									 <div class="col-md-12 mb-1">
									  <label class="bold">Tingkat</label>
                                        <select name='level' id="level" class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Tingkat</option>
                                                <?php $query = mysqli_query($koneksi, "SELECT level FROM kelas GROUP BY level"); ?>
                                                <?php while ($kls = mysqli_fetch_array($query)) : ?>
                                                    <option value="<?= $kls['level'] ?>"><?= $kls['level'] ?></option>
                                                <?php endwhile ?>
											</select>
                                        </div>
										<div class="col-md-12 mb-1">
									  <label class="bold">Jurusan</label>
                                        <select name='pk' id="pk" class='form-select' style='width:100%' required>                                               
											</select>
                                        </div>
										
										<div class="col-md-12 mb-1">
									  <label class="bold">KURIKULUM</label>
                                        <select name='mapel' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Kurikulum</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM m_kurikulum"); ?>
                                                <?php while ($k = mysqli_fetch_array($que)) : ?>
                                                    <option value="<?= $k['idk'] ?>"><?= $k['nama_kurikulum'] ?></option>
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
					</div>
				</div>
				 <?php endif ?>
					 <script>
						$("#level").change(function() {
						var level = $(this).val();
						console.log(level);
						$.ajax({
						type: "POST",
						url: "mapel/ambildata.php?pg=pk", 
						data: "level=" + level, 
						success: function(response) { 
						$("#pk").html(response);
								}
							});
						});
									 			
							</script>							 
							<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'mapel/tmapel.php?pg=tambah',
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
                        
             
                                 <script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'jadwal/tjadwal.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
												},
												success: function(data) {
													 
													setTimeout(function() {
														window.location.reload();
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    