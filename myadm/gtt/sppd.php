					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">SURAT TUGAS & SPPD</h5>
									
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                                  
										  <th>NAMA PEGAWAI</th>
                                          <th>KEPERLUAN</th>
										   <th>TANGGAL</th>
										  <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM surat_tugas ORDER BY id DESC"); 
											while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                            
											  <td><?= $peg['nama'] ?></td>
                                             <td><?= $data['keperluan'] ?></td>
											 <td><?= $data['tanggal'] ?></td>
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
									 <div class="col-md-12 mb-1">
								    <label class="bold">Tanggal</label>									
                                      <input type='text' name='tanggal' class='datepicker form-control' autocomplete="off" required='true' />
                                    </div>
								    <label class="bold">Keperluan</label>
									<div class="input-group mb-1">
                                       <input type='text' name='keperluan' class='form-control' required='true' />
                                     </div>
									
									<div class="col-md-12 mb-1">
									<label class="bold">Tempat Tujuan</label>		
                                       <input type='text' name='tempat' class='form-control' required='true' />
                                    </div>
									<div class="col-md-12 mb-1">
								    <label class="bold">Waktu</label>									
                                       <input type='text' name='waktu'  class='form-control' required='true' />
                                    </div>
                                    <div class="col-md-6 mb-1">
								    <label class="bold">Lama (Hari)</label>									
                                       <input type='number' name='lama' class='form-control' required='true' />
                                    </div>
									 <div class="col-md-6 mb-1">
								    <label class="bold">Tgl Berangkat</label>									
                                      <input type='text' name='tgl' class='datepicker form-control' autocomplete="off" required='true' />
                                    </div>
									 <div class="col-md-12 mb-1">
								    <label class="bold">Berangkat dari</label>									
                                      <input type='text' name='dari' class='form-control'  required='true' />
                                    </div>
									 <div class="col-md-12 mb-1">
								    <label class="bold">Kendaraan</label>									
                                      <select name='motor' class='form-select' style='width:100%' required>
                                       <option value=''>Pilih Kendaraan</option>
									<option value='Kendaraan Dinas'>Kendaraan Dinas</option>
									<option value='Kendaraan Umum'>Kendaraan Umum</option>
									<option value='Kendaraan Pribadi'>Kendaraan Pribadi</option>
									
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
             url: 'gtt/tsppd.php?pg=tambah',
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
             url: 'gtt/tsppd.php?pg=edit',
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
											   url: 'gtt/tsppd.php?pg=hapus',
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