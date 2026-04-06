					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">SK PEGAWAI</h5>
									
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                                  
										  <th>NAMA PEGAWAI</th>
                                          <th>NAMA SK</th>
										  
										  <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM sk_peg WHERE idsk='1'"); 
											while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											$sk = fetch($koneksi,'m_sk',['id'=>$data['idsk']]);
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                            
											  <td><?= $peg['nama'] ?></td>
                                             <td><?= $sk['judul'] ?></td>
											 
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
									<form id='formguru' class="row g-1">	
									 <label class="bold">Pegawai</label>
									 <div class="input-group mb-1">
                                      <select name="idpeg" class="form-select" required='true' >
									   <option value="">Pilih Pegawai</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin'");
										while ($peg = mysqli_fetch_array($kls)) {
										echo "<option value='$peg[id_user]'>$peg[nama]</option>";
										}
										?>								 
									  </select>
									 </div>	
									
								    <label class="bold">Tempat, Tanggal Lahir</label>
									<div class="input-group mb-1">
                                       <input type='text' name='ttl' class='form-control' value="Cianjur, 12 Desember 1983" required='true' />
                                     </div>
									 <label class="bold">Jenis Kelamin</label>
									<div class="input-group mb-1">
                                      <select name="jk" class="form-select"  required='true'>
									   <option value="">Pilih JK</option>
									  	 <option value="Laki-laki">Laki-laki</option>
											 <option value="Perempuan">Perempuan</option>
									  </select>
                                    </div>
									<label class="bold">Pendidikan</label>
									<div class="input-group mb-1">
                                      <select name="pdk" class="form-select"  required='true'>
									   <option value="">Pilih Pendidikan</option>
									  	<option value="SLTA">SLTA</option>
										 <option value="D3">D3</option>
										<option value="S1">S1</option>
										<option value="S1">S2</option>
									  </select>
                                    </div>
									<label class="bold">SK</label>
									<div class="input-group mb-1">
                                      <select name="idsk" class="form-select"  >
									   <option value="">Pilih SK</option>
									  <?php
										$k = mysqli_query($koneksi, "SELECT * FROM m_sk WHERE id='1'");
										while ($sk = mysqli_fetch_array($k)) {
										echo "<option value='$sk[id]'>$sk[judul]</option>";
										}
										?>								 
									  </select>
                                    </div>
								    
									<div class="col-md-8 mb-1">
									<label class="bold">Nomor SK</label>		
                                       <input type='text' name='nosk' class='form-control' value="/YBS/SK.B/"required='true' />
                                    </div>
									<div class="col-md-4 mb-1">
								    <label class="bold">Tahun SK</label>									
                                       <input type='text' name='tahun' value="<?= $tahun ?>" class='form-control' required='true' />
                                    </div>
                                    <div class="col-md-6 mb-1">
								    <label class="bold">Tanggal SK</label>									
                                       <input type='text' name='tglsk' value="01 Juli" class='form-control' required='true' />
                                    </div>
									 <div class="col-md-6 mb-1">
								    <label class="bold">TMT Awal</label>									
                                       <input type='text' name='tmt' value="01 Juli" class='form-control' required='true' />
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
             url: 'gtt/tguru.php?pg=tambah',
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
				window.location.reload();
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
           
    <script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'user/tguru.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi("guru") ?>');
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
											   url: 'gtt/tguru.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
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