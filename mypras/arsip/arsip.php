<?php
defined('APK') or exit('No Access');

?>           
	
		 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">SAPRAS</h5>
										<div class="pull-right">
										<a href="?pg=<?= enkripsi('dashgur') ?>" class="btn btn-primary">BACK</a>
										</div>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  	
													<th>LEMARI</th>
													<th>NOMOR</th>	
													<th>NAMA ARSIP</th>													
													 <th width="30%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM arsip ORDER BY id DESC"); 
											while ($data = mysqli_fetch_array($query)) :
											$lem = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_lemari  WHERE id='$data[idlemari]'"));
																			
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $lem['nama'] ?></td>
													<td><?= $data['nomor'] ?></td>
													<td><?= $data['nama_arsip'] ?></td>
													  <td>
											<a href="../arsip/<?= $data['file'] ?>" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="material-icons">download</i></a>
											<a href="?pg=<?= enkripsi('arsip') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>											
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
											   url: 'arsip/tarsip.php?pg=hapus',
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
							<?php if ($ac == '') : ?>
							<?php
							function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
				}
				$bulan = date('n');
				$romawi = getRomawi($bulan);
				$tahun = date ('Y');
				$nomor = $romawi." / ".$tahun;
				$query = mysqli_query($koneksi, "SELECT max(left(nomor, 4)) AS kode FROM arsip WHERE DATE(tanggal) = CURDATE()"); 
							if ($query->num_rows > 0) { 
							  foreach ($query as $q) { 
								$no = ((int)$q['kode'])+1; 
								$kd = sprintf("%04s", $no);
								$kd = $kd." / ".$nomor;
							  } 
							} else { 
							  $kd = "0001 / ".$nomor; 
							}
						  ?>
					       <div class="col-md-4">
							  
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">INPUT ARSIP</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formbarang' >
									<input type="hidden" name="inputer" value="<?= $user['id_pegawai'] ?>" >
										 <label class="bold">NOMOR ARSIP</label>
									  <div class="input-group mb-1">
									 <input type="text" name="nomor" value="<?= $kd; ?>" class="form-control" readonly >
                                        </div>
										<label class="bold">LEMARI</label>
									  <div class="input-group mb-1">
									 <select name="idl" id="idl" class='form-select' required='true' style="width: 100%">
								    <option value=''>Pilih Lemari</option>
										<?php
										$kat = mysqli_query($koneksi, "SELECT * FROM m_lemari");
										while ($kate = mysqli_fetch_array($kat)) {
										echo "<option value='$kate[id]'>$kate[nama]</option>";
										}
										?>
									 </select>
                                        </div>
										
									 <label class="bold">NAMA ARSIP</label>
									  <div class="input-group mb-1">
									 <input type="text" name="nama" class="form-control" required='true' >
                                        </div>
										
										<label class="bold">FOTO / FILE ARSIP</label>
										<div class="input-group mb-1">
										<input type='file' name='file' class='form-control' required='true' />
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
				
                 <script>
						$('#formbarang').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'arsip/tarsip.php?pg=input',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
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
								})
								return false;
							});
							</script>

             <?php elseif ($ac == enkripsi('edit')): ?>
			
             <?php
			 $id = dekripsi($_GET['id']);
			 $dataz = fetch($koneksi,'arsip',['id'=>$id]);
			 $lem = fetch($koneksi,'m_lemari',['id'=>$dataz['idlemari']]);
			 ?>					 
                      
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                      <h5 class="bold">EDIT SAPRAS</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formedit' >	
									<input type="hidden" name="id" value="<?= $id; ?>" >
										 <label class="bold">NOMOR ARSIP</label>
									  <div class="input-group mb-1">
									 <input type="text" name="nomor" value="<?= $dataz['nomor'] ?>" class="form-control" readonly >
                                        </div>
										<label class="bold">LEMARI</label>
									  <div class="input-group mb-1">
									 <select name="idl" id="idl" class='form-select' required='true' style="width: 100%">
									 <option value="<?= $dataz['idlemari'] ?>"><?= $lem['nama'] ?></option>
								    <option value=''>Pilih Lemari</option>
										<?php
										$kat = mysqli_query($koneksi, "SELECT * FROM m_lemari");
										while ($kate = mysqli_fetch_array($kat)) {
										echo "<option value='$kate[id]'>$kate[nama]</option>";
										}
										?>
									 </select>
                                        </div>
										
									 <label class="bold">NAMA ARSIP</label>
									  <div class="input-group mb-1">
									 <input type="text" name="nama" class="form-control" value="<?= $dataz['nama_arsip'] ?>" required='true' >
                                        </div>
										
										<label class="bold">FOTO / FILE ARSIP</label>
										<div class="input-group mb-1">
										<input type='file' name='file' class='form-control'  />
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
                 <script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'arsip/tarsip.php?pg=edit',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									width: "30%"
									}, 500);
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi("arsip") ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					