<?php
defined('APK') or exit('No Access');

?>      
     
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                   <div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">DATA PENGAJUAN SURAT</h5></a>
									</div>	
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th>NO</th>
                                                    <th>TANGGAL</th>
                                                    <th>NAMA PEGAWAI</th>
                                                    <th>PENGAJUAN SURAT</th>
                                                    <th>SURAT</th>
													 <th>STATUS</th>
													 <th></th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM surat where idpeg<>'' and status='0'"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											  $sis = fetch($koneksi,'pegawai',['id_pegawai'=>$data['idpeg']]);
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['tanggal'] ?></td>
                                                  <td><?= $sis['nama'] ?></td>
                                                  <td>
												  <?php if($data['ket']=='1'): ?>
												  Surat Keterangan Sakit
												  <?php else : ?>
												  Surat Keterangan Izin
												  <?php endif; ?>
												  
												  </td>
                                                  <td>
												  <a href="<?= $baseurl; ?>/files/<?= $data['file'] ?>" target="_blank" class="btn btn-sm btn-success"><i class="material-icons">download</i></a>			  
												  </td>
												  <td><b style="color:red;">Belum di setujui</b></td>
                                                  <td>
												  <button data-id="<?= $data['id'] ?>"  class="aprove btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove Surat"><i class="material-icons">check</i> </button>
												  </td>
												 
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								</div>		
							</div>	
								<script>
									$('#datatable1').on('click', '.aprove', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Aprove Data',
											  text: "Pengajuan Surat Disetujui",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Aprove',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'surat/tpeg.php',
												method: "POST",
												data: 'id=' + id,
												
												beforeSend: function() {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
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