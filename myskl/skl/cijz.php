<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where ket<>''")); 
?>
<?php

    if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
    
    ?>
			<div class="row">
			 <div class="col-xl-8 mb-6">
			 <h2 class="small-title bold">CETAK DATA NILAI IJAZAH</h2>
			 <?php if($kelas<>''): ?>
			<?php if($jsiswa==0): ?>
			<a href="skl/proses_skl.php?kls=<?= $kelas ?>"> <button class="btn btn-sm btn-icon btn-success kanan" type="button"> <i class="material-icons">download</i> UPDATE SISWA</button></a>				
			<form id='formupdate' class="row g-2">
				<div class='col-md-8'>
			<input type="file" name="file" class="form-control" >
			</div>
			<div class='col-md-4'>
			 <button type='submit' name='submit1' class='btn btn-primary' >UPLOAD</button>			
			</div>
			</form>
			<?php endif; ?>
			<?php endif; ?>
			   <div class="card">
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
												 <a href="#"><img src="<?= $baseurl ?>/img/siswa.png" class="card-img rounded-xl sh-4 sw-4" alt="thumb" /></a>
												  <?php else : ?>
												    <a href="#"><img src="<?= $baseurl ?>/img/fotosiswa/<?= $data['foto'] ?>" class="card-img rounded-xl sh-4 sw-4" alt="thumb" /></a>
												  <?php endif; ?>
												  </td>
												    
												    <td>
													
													<?php if($data['ket']<>''): ?>
													<a href="skl/ijazah.php?ids=<?= $data['id_siswa'] ?>" target="_blank"> <button class="btn btn-sm btn-icon btn-icon-only btn-info mb-1" type="button"> <i class="material-icons">print</i></button></a>	
													<a href="skl/excel.php?ids=<?= $data['id_siswa'] ?>" target="_blank"> <button class="btn btn-sm btn-icon btn-icon-only btn-success mb-1" type="button"> <i class="material-icons">download</i></button></a>	
													
													<?php else : ?>
													<button class="btn btn-sm btn-icon btn-icon-only btn-light mb-1" type="button" disabled> <i class="material-icons">lock</i></button>			
													<button class="btn btn-sm btn-icon btn-icon-only btn-light mb-1" type="button" disabled> <i class="material-icons">lock</i></button>			
													
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
				
								
								
			
			<div class="col-xl-4 mb-6">
			 <div class="card">
				<div class="card-body">
                      <div class="mb-3 pb-3 border-bottom border-separator-light">
                        <div class="row g-0 sh-6">
                          <div class="col-auto">
                            <a href="#">
                              <img src="<?= $baseurl ?>/img/guru.png" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                            </a>
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-center justify-content-between">
                              <div class="d-flex flex-column">
                                <a href="#" class="body-link">CETAK NILAI IJAZAH</a>
                                <div class="text-small text-muted"><?= $setting['sekolah'] ?> </div>
                              </div>                              
                              </div>
                            </div>
                          </div>
                        </div>
						
					<div class="col-md-12">
								<label class="form-label bold">KELAS / ROMBEL</label>
						<select class="kelas form-select" name="kelas" required style="width: 100%">
							  <option value='' selected>-- Pilih Rombel --</option>
							  <?php
							        if($user['level']=='admin'):
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
									else :
									$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa WHERE kelas='$user[walas]' GROUP BY kelas");
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
                                    
                                    location.replace("?pg=<?= enkripsi('ijazah') ?>&kelas=" + kelas);
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
			$('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
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
		
			