					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">LENGKAPI DATA PEGAWAI</h5>
									
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                               
										<th>NAMA PEGAWAI</th>
										  <th>JK</th>
                                         <th>JABATAN</th>
										  <th>STATUS</th>
										 
										  <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin' and level<>'awas'"); 
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                              <td><?= $data['nama'] ?></td>
											  <td><?= $data['jk'] ?></td>
                                             <td><?= $data['jabatan'] ?></td>
											 <td><?= $data['status'] ?></td>
											 
											<td>
										
											<a href="?pg=<?= enkripsi('pegawai') ?>&iduser=<?= $data['id_user'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
											
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
						<?php $peg = fetch($koneksi,'users',['id_user'=>$_GET['iduser']]); ?>
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-header">										
                                    </div>
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
									<form id='formedit' >	
									<input type="hidden" name="ids" value="<?= $_GET['iduser'] ?>" >
								    <label class="bold">NAMA PEGAWAI</label>
									<div class="input-group mb-1">
                                      <select name="nama" class="form-select"  >
									   <option value="<?= $peg['nama'] ?>"><?= $peg['nama'] ?></option>							 
									  </select>
                                    </div>
									<label class="bold">JK</label>
									<div class="input-group mb-1">
                                      <select name="jk" class="form-select"  >
									   <option value="<?= $peg['jk'] ?>"><?= $peg['jk'] ?></option>
									   <option value="L">L</option>
										<option value="P">P</option>	
									  </select>
                                    </div>
								   <label class="bold">JABATAN</label>
									<div class="input-group mb-1">
                                      <select name="jabat" class="form-select"  >
									   <option value="<?= $peg['jabatan'] ?>"><?= $peg['jabatan'] ?></option>							 
									  </select>
                                    </div>
									<label class="bold">PENDIDIKAN</label>
									<div class="input-group mb-1">
                                      <select name="pendidikan" class="form-select" required="true" >
									   <option value="<?= $peg['pendidikan'] ?>"><?= $peg['pendidikan'] ?></option>
									    <option value="SLTA">SLTA</option>
										<option value="S1">S1</option>
										<option value="S2">S2</option>	
									  </select>
                                    </div>
									<label class="bold">STATUS KEPEGAWAIAN</label>
									<div class="input-group mb-1">
                                      <select name="status" class="form-select" required="true" >
									   <option value="<?= $peg['status'] ?>"><?= $peg['status'] ?></option>
                                         <option value="PNS/ASN">PNS/ASN</option>
										<option value="NON PNS">NON PNS</option>	
									  </select>
                                    </div>
									<label class="bold">GOLONGAN KEPEGAWAIAN</label>
									<div class="input-group mb-1">
                                      <select name="golongan" class="form-select" >
									   <option value="<?= $peg['golongan'] ?>"><?= $peg['golongan'] ?></option>
                                        <option value="-">Tidak Ada</option>
										<option value="IV/b">IV/b</option>
										<option value="IV/a">IV/a</option>
										<option value="III/d">III/d</option>
										<option value="III/c">III/c</option>	
										<option value="III/b">III/b</option>	
										<option value="III/a">III/a</option>

										
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
					
	
<?php endif ?>
	
    <script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'pegawai/tguru.php?pg=edit',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace('?pg=<?= enkripsi("pegawai") ?>');
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
											   url: 'user/tguru.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												setTimeout(function() {
												window.location.replace('?pg=<?= enkripsi("guru") ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    