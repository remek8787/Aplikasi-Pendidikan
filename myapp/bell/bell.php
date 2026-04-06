<?php defined('APK') or exit('No accsess');?> 		
<div class="row">
  <div class="col-md-8">
     <div class="card">
        <div class="card card-header">       
            <h5  class="card-title" >BELL SEKOLAH OTOMATIS</h5>
				</div>
						<div class="card-body">
								<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                   <th>NO</th>
												   <th>HARI</th>
                                                    <th>JAM</th>
                                                    <th>NADA BEL</th>
                                                    <th>KETERANGAN</th>
                                                   <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											  
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM bell"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											  $nada = fetch($koneksi,'bell_nada',['idb'=>$data['nada']]);
											   $harix = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
												  <td><?= $harix['hari'] ?></td>
                                                  <td><?= $data['jam'] ?></td>
                                                  <td><?= $nada['nama'] ?></td>
                                                  <td><?= $data['ket'] ?></td>
												  <td>											
											<a href="?pg=<?= enkripsi('bell') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
											   url: 'user/tbell.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												setTimeout(function() {
												window.location.replace('?pg=<?= enkripsi("bell") ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    
								<?php if ($ac == '') : ?>
                            <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">INPUT BELL SEKOLAH</h5>
											
                                    </div>
                                    <div class="card-body">
									<form id='formbell' >	
									 <label class="bold">HARI</label>
									 <div class="input-group mb-1">
                                       <select name='hari' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Hari</option>
                                                <?php $hr = mysqli_query($koneksi, "SELECT * FROM m_hari"); ?>
                                                <?php while ($hari = mysqli_fetch_array($hr)) : ?>
                                                    <option value="<?= $hari['inggris'] ?>"><?= $hari['hari'] ?></option>
                                                <?php endwhile ?>
												 </select>
									 </div>	
									<label class="bold">JAM</label>
									<div class="input-group mb-1">
                                       <input type='text' name='jam' class='timer2 form-control' required='true' autocomplete="off" />
                                    </div>
								    <label class="bold">NADA BELL</label>
									<div class="input-group mb-1">
                                     <select name='nada' class='form-select' style='width:100%' required>
                                                <option value=''>Pilih Nada</option>
                                                <?php $nada = mysqli_query($koneksi, "SELECT * FROM bell_nada"); ?>
                                                <?php while ($nd = mysqli_fetch_array($nada)) : ?>
                                                    <option value="<?= $nd['idb'] ?>"><?= $nd['nama'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                    </div>
								    <label class="bold">KETERANGAN</label>
									<div class="input-group mb-1">
                                       <input type='text' name='ket' class='form-control' required='true' />
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
							$('#formbell').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'user/tbell.php?pg=tambah',
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
				<?php elseif($ac == enkripsi('edit')): ?>	
		       <?php
			$id = dekripsi($_GET['id']);
		    $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bell WHERE id='$id'"));	
			 $harix= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_hari WHERE inggris='$data[hari]'"));
			$nadax= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bell_nada WHERE idb='$data[nada]'"));			 
              ?>
			  <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">EDIT BELL SEKOLAH</h5>
							
															
                                    </div>
                                    <div class="card-body">
									<form id='formedit' >	
									<input type="hidden" class="form-control" name="id" value="<?= $id ?>" >
									 <label class="bold">HARI</label>
									 <div class="input-group mb-1">
                                       <select name='hari' class='form-select' style='width:100%' required>
									    <option value="<?= $data['hari'] ?>"><?= $harix['hari'] ?></option>
                                                <option value=''>Pilih Hari</option>
                                                <?php $hr = mysqli_query($koneksi, "SELECT * FROM m_hari"); ?>
                                                <?php while ($hari = mysqli_fetch_array($hr)) : ?>
                                                    <option value="<?= $hari['inggris'] ?>"><?= $hari['hari'] ?></option>
                                                <?php endwhile ?>
												 </select>
									 </div>	
									<label class="bold">JAM</label>
									<div class="input-group mb-1">
                                       <input type='text' name='jam' class='timer2 form-control' value="<?= $data['jam'] ?>" required='true' />
                                    </div>
								    <label class="bold">NADA BELL</label>
									<div class="input-group mb-1">
                                     <select name='nada' class='form-select' style='width:100%' required>
									 <option value="<?= $data['nada'] ?>"><?= $nadax['nama'] ?></option>
                                                <option value=''>Pilih Nada</option>
                                                <?php $nada = mysqli_query($koneksi, "SELECT * FROM bell_nada"); ?>
                                                <?php while ($nd = mysqli_fetch_array($nada)) : ?>
                                                    <option value="<?= $nd['idb'] ?>"><?= $nd['nama'] ?></option>
                                                <?php endwhile ?>
												 </select>
                                    </div>
								    <label class="bold">KETERANGAN</label>
									<div class="input-group mb-1">
                                       <input type='text' name='ket' class='form-control' value="<?= $data['ket'] ?>" required='true' />
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
							$('#formedit').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'user/tbell.php?pg=edit',
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
									success: function(data){  			
									setTimeout(function()
										{
										window.location.replace('?pg=<?= enkripsi("bell") ?>');
												}, 2000);
															  
												}
											});
										return false;
									});
								</script>	
								<?php endif ?>