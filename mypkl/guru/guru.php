					<?php
					defined('APK') or exit('No accsess');
					?> 		
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">GURU PEMBIMBING</h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>#</th>                                               
										  <th>NAMA PEMBIMBING</th>
                                          <th>KELAS</th>
										  <th>PERUSAHAAN</th>										 
										  <th></th> 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_pembimbing");
											while ($data = mysqli_fetch_array($query)) :
											$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											$dudi = fetch($koneksi,'pkl_dudi',['id'=>$data['dudi']]);
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;"> 
											 <td><?= $no; ?></td>
											  <td><?= $peg['nama'] ?></td>
                                             <td><?= $data['kelas'] ?></td>
											 <td><?= $dudi['nama_dudi'] ?></td>
											 <td>											
											<a href="?pg=<?= enkripsi('guru') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
									<form id="formguru" class="row g-1">
									 <label class="bold">KELAS</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kelas" id="kelas" required style="width: 100%">
									<option value="">Pilih Kelas</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM pkl_siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
									</select>
									 </div>	
									<label class="bold">PERUSAHAAN</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="dudi" id="dudi" required style="width: 100%">
									<option value="">Pilih Perusahaan</option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM pkl_dudi");
										while ($d = mysqli_fetch_array($que)) {
										echo "<option value='$d[id]'>$d[nama_dudi]</option>";
										}
										?>
									</select>
                                    </div>
										<label class="bold">GURU PEMBIMBING</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="guru"  required style="width: 100%">
									<option value="">Pilih Pembimbing</option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM users where level='guru'");
										while ($peg = mysqli_fetch_array($que)) {
										echo "<option value='$peg[id_user]'>$peg[nama]</option>";
										}
										?>
									</select>
                                    </div>	
                                    <label class="bold">INSTRUKTUR INDUSTRI</label>
									<div class="input-group mb-1">	
										<input type="text" name="instruktur" class="form-control" required="true">
										</div>
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                       </div>
										</form>
					               </div>
								</div>
							</div>
						</div>
				<?php elseif($ac == enkripsi('edit')): ?>	
		<?php
			$id = $_GET['id'];
		    $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_pembimbing WHERE id='$id'"));						
            $peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
			$dudi = fetch($koneksi,'pkl_dudi',['id'=>$data['dudi']]);
			  ?>
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
									<form id='formedit' class="row g-1">	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label class="bold">KELAS</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kelas" id="kelas" required style="width: 100%">
									<option value="<?= $data['kelas'] ?>"><?= $data['kelas'] ?></option>
									<option value="">Pilih Kelas</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM pkl_siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
									</select>
									 </div>	
									<label class="bold">PERUSAHAAN</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="dudi" id="dudi" required style="width: 100%">
									<option value="<?= $data['dudi'] ?>"><?= $dudi['nama_dudi'] ?></option>
									<option value="">Pilih Perusahaan</option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM pkl_dudi");
										while ($d = mysqli_fetch_array($que)) {
										echo "<option value='$d[id]'>$d[nama_dudi]</option>";
										}
										?>
									</select>
                                    </div>
										<label class="bold">GURU PEMBIMBING</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="guru"  required style="width: 100%">
									<option value="<?= $data['idpeg'] ?>"><?= $peg['nama'] ?></option>
									<option value="">Pilih Pembimbing</option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM users where level='guru'");
										while ($peg = mysqli_fetch_array($que)) {
										echo "<option value='$peg[id_user]'>$peg[nama]</option>";
										}
										?>
									</select>
                                    </div>	
									 <label class="bold">INSTRUKTUR INDUSTRI</label>
									<div class="input-group mb-1">	
										<input type="text" name="instruktur" value="<?= $data['instruktur'] ?>" class="form-control" required="true">
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
			</div>	
	
<?php endif ?>
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'guru/tguru.php?pg=tambah',
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
             url: 'guru/tguru.php?pg=edit',
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
											   url: 'guru/tguru.php?pg=hapus',
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