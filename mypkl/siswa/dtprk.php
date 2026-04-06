					<?php
					defined('APK') or exit('No accsess');
					?> 		
					 <?php

					if (empty($_GET['k'])) {
						$kelas = "";
						
					} else {
						$kelas = $_GET['k'];
						
					}
					if (empty($_GET['d'])) {
						$dudi = "";
					} else {
						$dudi = $_GET['d'];
					}
				 $per = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_dudi where id='$dudi' "));
				?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">PESERTA PRAKERIN</h5>
										</div>
                                    <div class="card-body">
										<?php if($kelas<>''): ?>
									<div>
									<a href="cetak/cetak2.php?k=<?= $kelas; ?>&d=<?= $dudi; ?>" target="_blank" class="btn btn-link kanan"><i class="material-icons">print</i> Permohonan</a>
									  <a href="cetak/cetak1.php?k=<?= $kelas; ?>&d=<?= $dudi; ?>" target="_blank" class="btn btn-link kanan"><i class="material-icons">print</i> Rekom</a>
										</div>
										<br><br><br>
										  <?php endif; ?>
										  
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                               
										  <th>NAMA SISWA</th>
                                          <th>KELAS</th>
										 										 
										 <th>PERUSAHAAN</th>
										 <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_siswa WHERE kelas='$kelas' and dudi='$dudi'");
											while ($data = mysqli_fetch_array($query)) :
											$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center"><?= $no; ?></td>                                           
											  <td><?= $sis['nama'] ?></td>
                                             <td><?= $data['kelas'] ?></td>
											
											 <td><?= $per['nama_dudi'] ?></td>
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
								  	
						<?php if ($ac == '') : ?>
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
										</div>
										<div class="h5 mb-0">PRAKERIN</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									
									 <label class="bold">KELAS</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kelas" id="kelas" required style="width: 100%">
									<option value="<?= $kelas ?>"><?= $kelas ?></option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
									</select>
									 </div>	
									<label class="bold">PERUSAHAAN</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="dudi" id="dudi" required style="width: 100%">
									<option value="<?= $dudi ?>"><?= $per['nama_dudi'] ?></option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM pkl_dudi");
										while ($d = mysqli_fetch_array($que)) {
										echo "<option value='$d[id]'>$d[nama_dudi]</option>";
										}
										?>
									</select>
                                    </div>						   
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
                                       </div>
										
					               </div>
								</div>
							</div>
						</div>
					<script type="text/javascript">
                                $('#pilih').click(function() {
                                    var k = $('#kelas').val();
                                    var d = $('#dudi').val();
                                    location.replace("?pg=<?= enkripsi('prakerin') ?>&k=" + k + "&d=" + d);
                                }); 
                            </script>
	
                 <?php endif ?>
	
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
											   url: 'siswa/tsiswa.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
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