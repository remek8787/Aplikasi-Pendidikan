<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>           
			<?php if ($ac == '') : ?>
			
					<div class="row">
                          <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">BELUM KLIK SELESAI</h5>
									</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                 <th width="5%">#</th>
												<th>NAMA SISWA</th>
												<th>ROMBEL</th>			
												<th>MAPEL</th>							
												<th>SESI</th>
												<th>SOAL - JAWAB</th>
												<th>PAKSA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php
												$no=0;
											  $query = mysqli_query($koneksi, "SELECT * FROM nilai  WHERE browser='0'"); 
											  while ($data = mysqli_fetch_array($query)) :
											 $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$data[id_siswa]'"));
											 $bank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal  WHERE id_bank='$data[id_bank]'"));
											 
											 $no++;
											   ?>
											  
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                   <td><?= $siswa['nama'] ?></td>
                                                   <td><?= $siswa['kelas'] ?></td>                                               				
                                                    <td><?= $bank['nama'] ?></td>
													 <td><?= $siswa['sesi'] ?></td>
													  <td><h5><span class="badge badge-primary"><?= $data['jumsoal'] ?></span> <span class="badge badge-dark"><?= $data['jumjawab'] ?></span></h5></td>
													<td>
														<button data-idp="<?= $data['id_nilai'] ?>" class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai Paksa"><i class="material-icons">edit</i></a>
						
													</td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								</div>		
				           </div>	
                
        <?php endif; ?>		 
		                            <script>
									$('#datatable1').on('click', '.hapus', function() {
									var idp = $(this).data('idp');
									console.log(idp);
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
											   url: 'siswa/tsiswa.php?pg=selesai',
												method: "POST",
												data: 'idp=' + idp,
												success: function(data) {
													  iziToast.info(
										{
											 title: 'Sukses!',
											message: 'Data berhasil dihapus',
											titleColor: '#FFFF00',
											messageColor: '#fff',
											backgroundColor: 'rgba(0, 0, 0, 0.5)',
											 progressBarColor: '#FFFF00',
											  position: 'topRight'				  
											});
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