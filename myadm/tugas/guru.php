					<?php
					defined('APK') or exit('No accsess');
					?> 		   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">SK PEMBAGIAN TUGAS</h5>
									
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>                                                  
										  <th>NAMA PEGAWAI</th>
                                          <th>TUGAS</th>
										  
										  <th></th>
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM sk_peg WHERE idsk='2'"); 
											while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											 $tgs = fetch($koneksi,'m_tugas',['idt'=>$data['kode']]);
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td><?= $no; ?></td>
                                            
											  <td><?= $peg['nama'] ?></td>
                                             <td><?= $tgs['tugas'] ?></td>
											 
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
						<?php 
						   if (empty($_GET['kode'])) {
								$kode = "";
						   }else{
							   $kode = $_GET['kode'];
						   }
						  if (empty($_GET['guru'])) {
								$guru = "";
						   }else{
							   $guru = $_GET['guru'];
						   }
						   $peg = fetch($koneksi,'users',['id_user'=>$guru]);
						   $tugas = fetch($koneksi,'m_tugas',['idt'=>$kode]);
						   $kodex = $tugas['tugas'];
						   ?>
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
										
									 <label class="bold">Pegawai</label>
									 <div class="input-group mb-1">
                                      <select name="idpeg" class="form-select idpeg"  required='true'>
									   <option value="<?= $guru ?>"><?= $peg['nama'] ?></option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin'");
										while ($peg = mysqli_fetch_array($kls)) {
										echo "<option value='$peg[id_user]'>$peg[nama]</option>";
										}
										?>								 
									  </select>
									 </div>	
									
									<label class="bold">Tugas</label>
									<div class="input-group mb-1">
                                      <select name="kode" class="form-select kode"  required='true'>
									   <option value="<?= $kode ?>"><?= $kodex ?></option>
									  	<option value="1">MENGAJAR</option>
										 <option value="2">KURIKULUM</option>
										<option value="3">BENDAHARA</option>
										<option value="4">OPERATOR</option>
										<option value="5">ESKUL</option>
										<option value="6">WALI KELAS</option>
										<option value="7">BK</option>
										<option value="8">PEMBINA OSIS</option>
									  </select>
                                    </div>
									<script type="text/javascript">
									 $('.kode').change(function() {
									var guru = $('.idpeg').val();	 
									var kode = $('.kode').val();
									location.replace("?pg=<?= enkripsi('bagi') ?>&kode=" + kode + "&guru=" + guru);
									  }); 
								   </script>
								   <?php if($kode=='1'): ?>
									<form id='formguru' class="row g-1">
									<input type="hidden" name="idpeg" value="<?= $guru ?>" >
									<input type="hidden" name="kode" value="<?= $kode ?>" >
									<input type="hidden" name="idsk" value="2" >
									<div class="col-md-6">	
										<label class="bold">Semester</label>
										 <input type='text' name='smt' value="<?= $setting['semester'] ?>" class='form-control' required="true">
										</div>
										
										<div class="col-md-6">	
										<label class="bold">Tahun Pelajaran</label>
										 <input type='text' name='tp' value="<?= $setting['tp'] ?>" class='form-control' required="true">
										</div>
										<div class="col-md-12">	
										<label class="bold">Mata Pelajaran</label>							 
                                      <select name='mapel[]' class='form-control select2' style='width:100%' multiple required='true'>
                                                <option value=''>Pilih Mapel</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM mapel"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['kode'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
										<div class="col-md-12">		
										<label class="bold">TINGKAT</label>
                                       <select name='level[]' class='form-control select2' style='width:100%' multiple required='true'>
                                               <option value=''>Pilih Tingkat</option>
											  <?php 
												$lv = mysqli_query($koneksi, "SELECT level FROM kelas GROUP BY level"); 	
												?>
                                                <?php while ($level = mysqli_fetch_array($lv)) : ?>
                                                    <option value="<?= $level['level'] ?>"><?= $level['level'] ?></option>
                                                <?php endwhile ?> 
												 </select>
                                        </div>
									<div class="col-md-12">		
										<label class="bold">KELAS / ROMBEL</label>
                                       <select name='kelas[]' class='form-control select2' style='width:100%' multiple required='true'>
                                               <option value=''>Pilih Kelas</option>
											  <?php 
												$sis = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); 	
												?>
                                                <?php while ($kl = mysqli_fetch_array($sis)) : ?>
                                                    <option value="<?= $kl['kelas'] ?>"><?= $kl['kelas'] ?></option>
                                                <?php endwhile ?> 
												 </select>
                                        </div>
										<div class="col-md-12">	
										<label class="bold">JJM Per Minggu</label>
                                       <input type='number' name='jjm'  class='form-control' required="true">
                                        </div>	
										<div class="col-md-12">	
										<label class="bold">Jenis</label>
										 <select name="jenis" class="form-select kode"  required='true'>
									  	<option value="">Pilih Jenis</option>
										
										 <option value="GM">Guru Mapel</option>
										<option value="GK">Guru Kelas</option>
										<option value="GB">Guru BK</option>
									  </select>
									  
									   </div>
									<div class="widget-payment-request-actions m-t-lg d-flex">
											<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
											
										</form>
									<?php endif; ?>
									 <?php if($kode=='5'): ?>
									<form id='formeskul' class="row g-1">
									<input type="hidden" name="idpeg" value="<?= $guru ?>" >
									<input type="hidden" name="kode" value="<?= $kode ?>" >
									<input type="hidden" name="idsk" value="2" >
									<div class="col-md-6">	
										<label class="bold">Semester</label>
										 <input type='text' name='smt' value="<?= $setting['semester'] ?>" class='form-control' required="true">
										</div>
										
										<div class="col-md-6">	
										<label class="bold">Tahun Pelajaran</label>
										 <input type='text' name='tp' value="<?= $setting['tp'] ?>" class='form-control' required="true">
										</div>
									<div class="col-md-12">	
										<label class="bold">Ekstrakurikuler</label>							 
                                      <select name='mapel[]' class='form-control select2' style='width:100%' multiple required='true'>
                                                <option value=''>Pilih Eskul</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM m_eskul"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
                                                    <option value="<?= $mapel['eskul'] ?>"><?= $mapel['eskul'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                        </div>
									<div class="col-md-12">		
										<label class="bold">Kelas</label>
                                       <select name='kelas[]' class='form-control select2' style='width:100%' multiple required='true'>
                                               <option value=''>Pilih Kelas</option>
											  <?php 
												$sis = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); 	
												?>
                                                <?php while ($kl = mysqli_fetch_array($sis)) : ?>
                                                    <option value="<?= $kl['kelas'] ?>"><?= $kl['kelas'] ?></option>
                                                <?php endwhile ?> 
												 </select>
                                        </div>
										<div class="col-md-12">	
										<label class="bold">JJM Per Minggu</label>
                                       <input type='number' name='jjm'  class='form-control' required="true">
                                        </div>	
									<div class="widget-payment-request-actions m-t-lg d-flex">
											<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
											
										</form>
										<?php endif; ?>
										 <?php if($kode=='2' OR $kode=='3' OR $kode=='3' OR $kode=='4' OR $kode=='6' OR $kode=='7'  OR $kode=='8'): ?>
									<form id='formlain' class="row g-1">
									<input type="hidden" name="idpeg" value="<?= $guru ?>" >
									<input type="hidden" name="kode" value="<?= $kode ?>" >
									<input type="hidden" name="idsk" value="2" >
									<div class="col-md-6">	
										<label class="bold">Semester</label>
										 <input type='text' name='smt' value="<?= $setting['semester'] ?>" class='form-control' required="true">
										</div>
										
										<div class="col-md-6">	
										<label class="bold">Tahun Pelajaran</label>
										 <input type='text' name='tp' value="<?= $setting['tp'] ?>" class='form-control' required="true">
										</div>
										 <?php if($kode=='3' OR $kode=='4'): ?>
									<div class="col-md-12" hidden="true">	
									<?php else: ?>
									<div class="col-md-12">	
									<?php endif; ?>
										
										<label class="bold">KELAS / ROMBEL</label>
                                       <select name='kelas[]' class='form-control select2' style='width:100%' multiple>
                                               <option value=''>Pilih Kelas</option>
											  <?php 
												$sis = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); 	
												?>
                                                <?php while ($kl = mysqli_fetch_array($sis)) : ?>
                                                    <option value="<?= $kl['kelas'] ?>"><?= $kl['kelas'] ?></option>
                                                <?php endwhile ?> 
												 </select>
                                        </div>
										 <?php if($kode=='3' OR $kode=='4'): ?>
									<div class="col-md-12" hidden="true">	
									<?php else: ?>
									<div class="col-md-12">	
									<?php endif; ?>
										<label class="bold">JJM Per Minggu</label>
                                       <input type='number' name='jjm'  <?php if($kode=='3' OR $kode=='4'): ?>  <?php else: ?> value="2" <?php endif; ?> class='form-control'>
                                        </div>	
									<div class="widget-payment-request-actions m-t-lg d-flex">
											<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
											
										</form>
										<?php endif; ?>
					               </div>
								</div>
							</div>
						</div>
					
	
<?php endif ?>
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'tugas/tguru.php?pg=tambah',
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
    $('#formeskul').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'tugas/tguru.php?pg=eskul',
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
    $('#formlain').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'tugas/tguru.php?pg=lainnya',
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
											   url: 'tugas/tguru.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
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