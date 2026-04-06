					<?php
					defined('APK') or exit('No accsess');
					?> 		
					 <?php

					if (empty($_GET['k'])) {
						$kelas = "";
						
					} else {
						$kelas = $_GET['k'];
						
					}
					if (empty($_GET['d'])) {
						$dudi = "";
					} else {
						$dudi = $_GET['d'];
					}
				 $per = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_dudi where id='$dudi' "));
				?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">
									<?php if($dudi==''): ?>
									INPUT PESERTA PRAKERIN
									<?php else: ?>
									PKL DI <?= strtoupper($per['nama_dudi']) ?>
									<?php endif; ?>
									</h5>
										</div>
                                    <div class="card-body">
									<form id="formsiswa" class="row g-2">
										<input type="hidden" name="dudi" value="<?= $dudi ?>" >
									<?php if($kelas<>''): ?>
									<div class="kanan">
									  <button type="submit" class="btn btn-primary kanan">Simpan</button>
										</div>
										  <?php endif; ?>  
									<div class="card-box table-responsive">
                                        <table  class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th># &nbsp;<input type="checkbox" id="check-all"></th>                                               
										  <th>NAMA SISWA</th>
                                          <th>KELAS</th>
										  <th>JURUSAN</th>										 
										 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas' AND NOT EXISTS(SELECT * FROM pkl_siswa WHERE siswa.id_siswa=pkl_siswa.idsiswa)");
											while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center">
											 <input type="checkbox" name="idsiswa[]" id="check<?= $no; ?>" class="checkbox" value="<?= $data['id_siswa'] ?>">
											 <input type="hidden" name="kelas[]" value="<?= $data['kelas'] ?>" >
											 <input type="hidden" name="jurusan[]" value="<?= $data['jurusan'] ?>" >
											 </td>                                           
											  <td><?= $data['nama'] ?></td>
                                             <td><?= $data['kelas'] ?></td>
											 <td><?= $data['jurusan'] ?></td>
											 
											
                                            </tr>
										<?php endwhile; ?>
										</tbody>
                                            </table>
										  </div>
										  </form>
										 </div>
										</div>
									</div>
								<script>
								$(function(){ 
								 $("#check-all").click(function(){
								 if ( (this).checked == true ){
								 $('.checkbox').prop('checked', true);
								 } else {
								 $('.checkbox').prop('checked', false);
								}
								 });
								});
								</script>	  	
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
									
									 <label class="bold">KELAS</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kelas" id="kelas" required style="width: 100%">
									<option value="<?= $kelas ?>"><?= $kelas ?></option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
									</select>
									 </div>	
									<label class="bold">PERUSAHAAN</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="dudi" id="dudi" required style="width: 100%">
									<option value="<?= $dudi ?>"><?= $per['nama_dudi'] ?></option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM pkl_dudi");
										while ($d = mysqli_fetch_array($que)) {
										echo "<option value='$d[id]'>$d[nama_dudi]</option>";
										}
										?>
									</select>
                                    </div>						   
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
                                       </div>
										
					               </div>
								</div>
							</div>
						</div>
					<script type="text/javascript">
                                $('#pilih').click(function() {
                                    var k = $('#kelas').val();
                                    var d = $('#dudi').val();
                                    location.replace("?pg=<?= enkripsi('siswa') ?>&k=" + k + "&d=" + d);
                                }); 
                            </script>
	
<?php endif ?>
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/tsiswa.php?pg=tambah',
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
     