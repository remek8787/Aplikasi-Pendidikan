<?php
defined('APK') or exit('No Access');

?>      
     
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">BLOKIR PRESENSI</h5>
									</div>	
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th>NO</th>
                                                    <th>NIS</th>
                                                    <th>NAMA SISWA</th>
                                                    <th>KELAS</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
										
											  $query = mysqli_query($koneksi, "SELECT * FROM siswa where blokir='1'"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											 
											$no++;
											   ?>
                                                <tr style="vertical-align:middle;">
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['nis'] ?></td>
                                                 <td><?= $data['nama'] ?></td>
												 <td><?= $data['kelas'] ?></td>
                                                 <td>
												  <button data-id="<?= $data['id_siswa'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Buka Blokir"><i class="material-icons">delete</i> </button>
												  </td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Buka Blokir',
											  text: "Hapus Blokir Presensi",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Buka',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'surat/tsurat.php?pg=pres',
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
									   										
										 <div class="mb-4">
												<p class="text-small text-muted mb-2">ALAMAT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">home</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['alamat'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">star</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['desa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">sync</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">CONTACT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">phone</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nowa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">inbox</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['email'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">language</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['server'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													 <i class="material-icons text-info" style="font-size:18px">person</i>
													</div>
												  </div>
												  <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">payment</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nip'] ?></div>
												</div>
											  </div>
											</div>
										  </div>             
										 </div>     
										</div>     
								