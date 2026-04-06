<?php
defined('APK') or exit('No Access');
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));

?>
<?php

    if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
    $jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where level='$skl[tingkat]' and ket<>'' and kelas='$kelas'")); 
    ?>
			<div class="row">
			 <div class="col-xl-8">
			 	<div class="card">
				<div class="card card-header">
			 <h5 class="bold">CETAK DATA SKL</h5>
			
				<?php if($kelas<>''): ?>
					<?php if($jsiswa==0): ?>
					
					<form id='formupdate'>
					<div class="row">
					<div class='col-md-6'>
					<input type="file" name="file" class="form-control" >
				</div>
				<div class='col-md-6'>
				<button type='submit' name='submit1' class='btn btn-primary' >UPLOAD</button>	
				<a href="skl/proses_skl.php?kls=<?= $kelas ?>"> <button class="btn btn-success" type="button">UPDATE</button></a>				
				</div>
				</div>
			</form>
			<?php else: ?>
			<div class='col-md-12' id="datata">
			<button data-id="<?= $kelas ?>"  class="hapus btn btn-sm btn-danger kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> RESET</button>
			</div>
			<?php endif; ?>
			<?php endif; ?>
				</div>
				<div class="card-body">
				 
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-hover" style="width:100%;font-size:12px;">
                                            <thead>
                                                <tr>
                                                   <th width="5%">NO</th>
												   <th>NIS</th>
													 <th>NISN</th>
														 <th>NAMA SISWA</th>
													 <th>FOTO</th>
													 <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas'"); 
											  while ($data = mysqli_fetch_assoc($query)) :
											 
											$no++;
											   ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
												  <td><?= $data['nis'] ?></td>							  
                                                  <td><?= $data['nisn'] ?></td>                                                 
												 <td><?= $data['nama'] ?></td>      												
												  <td>
												  <?php if($data['foto']==''): ?>
												 <a href="#"><img src="<?= $baseurl ?>/images/siswa.png" style="max-width:30px" alt=""></a>
												  <?php else : ?>
												    <a href="#"><img src="<?= $baseurl ?>/images/fotosiswa/<?= $data['foto'] ?>" style="max-width:30px" alt=""></a>
												  <?php endif; ?>
												  </td>
												    
												    <td>
													
													<?php if($data['ket']<>''): ?>
													<a href="skl/print_skl.php?ids=<?= $data['id_siswa'] ?>" target="_blank"> <button class="btn btn-sm  btn-primary mb-1" type="button"> <i class="material-icons">print</i></button></a>				
													
													<?php else : ?>
													<button class="btn btn-sm  btn-light mb-1" type="button" disabled> <i class="material-icons">lock</i></button>			
													
													<?php endif; ?>
													</td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
				
								
								
			
			<div class="col-xl-4">
			 <div class="card">
				 <div class="card">
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
					<div class="col-md-12">
								<label class="form-label bold">KELAS / ROMBEL</label>
						<select class="kelas form-select" name="kelas" required style="width: 100%">
							  <option value='' selected>Pilih Kelas</option>
							  <?php
							        if($user['level']=='admin'):
										$kls = mysqli_query($koneksi, "SELECT kelas,level FROM siswa WHERE level='$skl[tingkat]' GROUP BY kelas");
									else :
									$kls = mysqli_query($koneksi, "SELECT kelas,level FROM siswa WHERE level='$skl[tingkat]' and kelas='$user[walas]' GROUP BY kelas");
									endif;	
										while ($k = mysqli_fetch_array($kls)) {
										echo "<option value='$k[kelas]'>$k[kelas]</option>";
										}
										?>
							</select>
						</div>
						
						<div class="col-md-12">
						<button  id="cari" class="btn btn-primary kanan">Cari Data</button>
						</div>
							
                      </div>
                    </div>
                  </div>
				 </div>
                
						<script type="text/javascript">
                                $('#cari').click(function() {
                                    var kelas = $('.kelas').val();
                                    
                                    location.replace("?pg=<?= enkripsi('cskl') ?>&kelas=" + kelas);
                                }); 
                            </script>
		<script>
    $('#formupdate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'skl/import_siswa.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
			
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
									$('#datata').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'RESET',
											  text: "Upload Ulang Data Update",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Reset!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'skl/treset.php',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
											    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
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