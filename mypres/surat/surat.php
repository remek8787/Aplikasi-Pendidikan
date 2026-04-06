<?php
defined('APK') or exit('No Access');

?>      
     
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">PENGAJUAN SURAT</h5>
									</div>	
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th>NO</th>
                                                    <th>TANGGAL</th>
                                                    <th>NAMA PEMOHON</th>
                                                    <th>PERMOHONA SURAT</th>
                                                    <th>SURAT</th>
													 <th>STATUS</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
										
											  $query = mysqli_query($koneksi, "SELECT * FROM surat ORDER BY id DESC"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											  $sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											  $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											  
											$no++;
											   ?>
                                                <tr style="vertical-align:middle;">
                                                  <td><?= $no; ?></td>
                                                  <td><?= $data['tanggal'] ?></td>
                                                  <td>
												  <?php if($data['idsiswa']<>''): ?>
												  <?= $sis['nama'] ?>
												  <?php endif; ?>
												   <?php if($data['idpeg']<>''): ?>
												  <?= $peg['nama'] ?>
												  <?php endif; ?>
												  <br><span class="badge badge-primary"><?= $data['level'] ?></span>
												  </td>
                                                  <td>
												  <?php if($data['ket']=='1'): ?>
												  Surat Keterangan Sakit
												  <?php else : ?>
												  Surat Keterangan Izin
												  <?php endif; ?>
												  
												  </td>
                                                  <td>
												  <a href="<?= $baseurl; ?>/images/fotosiswa/<?= $data['file'] ?>" target="_blank" class="btn btn-sm btn-success"><i class="material-icons">download</i></a>			  
												  </td>
												  <td>
												   <?php if($data['status']=='0'): ?>
												  <b style="color:red;">Belum di setujui</b>
												  <?php else : ?>
												   <b style="color:blue;">Di setujui</b>
												  <?php endif; ?>
												  </td>
                                                  <td>
												   <?php if($data['status']=='0'): ?>
												   <button data-idz="<?= $data['id'] ?>"  class="aprove btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Aprove"><i class="material-icons">edit</i> </button>
												  <?php else : ?>
												  <button class="btn btn-sm btm-secondary" disabled><i class="material-icons">lock</i></button>
												   <?php endif; ?>
												  <button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Surat"><i class="material-icons">delete</i> </button>
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
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Hapus Data',
											  text: "Hapus Data Pengajuan Surat",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'surat/tsurat.php?pg=hapus',
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
							<script>
									$('#datatable1').on('click', '.aprove', function() {
									var idz = $(this).data('idz');
									console.log(idz);
									swal({
											  title: 'Aprove Data',
											  text: "Data Pengajuan Surat disetujui",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Aprove',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'surat/tsurat.php?pg=aprove',
												method: "POST",
												data: 'idz=' + idz,			
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