					<?php
					defined('APK') or exit('No accsess');
					?> 		
					<?php include"radio.php"; ?>
					 <?php

					if (empty($_GET['k'])) {
						$kelas = "";
						
					} else {
						$kelas = $_GET['k'];
						
					}
					if (empty($_GET['d'])) {
						$d = "";
						
					} else {
						$d = $_GET['d'];
						
					}
				?>
				<?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">MONITORING DAN EVALUASI <?= $kelas ?></h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>
                                         <th>NAMA SISWA</th>								  
										  <th>KELAS</th>
                                          <th>JK</th>
										  <th></th>										 
										 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_siswa WHERE kelas='$kelas' and dudi='$d'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[idsiswa]'"));
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center"><?= $no; ?></td>                                           
											  <td><?= $siswa['nama'] ?></td>
											   <td><?= $siswa['kelas'] ?></td>
                                             <td><?= $siswa['jk'] ?></td>
											 <td>
											<a href="?pg=<?= enkripsi('monitor') ?>&ac=<?= enkripsi('edit') ?>&ids=<?= $siswa['id_siswa'] ?>&d=<?= $d ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Evaluasi"><i class="material-icons">edit</i></button></a>
											 </td>
											 
											
                                            </tr>
										<?php endwhile; ?>
										</tbody>
                                            </table>
										  </div>
										  </form>
										 </div>
										</div>
									</div>
									  	

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
										$kls = mysqli_query($koneksi, "SELECT kelas FROM pkl_siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
									</select>
									 </div>	
									  <label class="bold">LOKASI</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="dudi" id="dudi" required style="width: 100%">
									<option value="<?= $d ?>"><?= $dudi['nama_dudi'] ?></option>
									</select>
									 </div>	
									
												   
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
										
                                       </div>
										
					               </div>
								</div>
							</div>
						</div>
						
						<script>	
						$("#kelas").change(function() {
						var kelas = $(this).val();
						console.log(kelas);
						$.ajax({
						type: "POST",
						url: "siswa/ambildata.php?pg=dudi", 
						data: "kelas=" + kelas, 
						success: function(response) { 
						$("#dudi").html(response);
								}
							});
						});
						
						</script>
						
					<script type="text/javascript">
                                $('#pilih').click(function() {
                                    var k = $('#kelas').val();
                                  
									var d = $('#dudi').val(); 
                                    location.replace("?pg=<?= enkripsi('monitor') ?>&k=" + k + "&d=" + d);
                                }); 
                            </script>
							
		<?php elseif($ac == enkripsi('edit')): ?>	
		<?php
			$ids = $_GET['ids'];
		    $siswa= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$ids'"));						
            $kelas = $siswa['kelas'];
			  ?>					
	               <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title"><?= strtoupper($siswa['nama']) ?></h5>
										</div>
                                    <div class="card-body">
									<form id="formnilai">
									
									<div class="card-box table-responsive">
                                        <table  class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>
                                         <th>MONITORING</th>								  
										  <th>EVALUASI</th>
                                          
										  <th width="24%">YA - TIDAK</th>										 
										 
                                          </tr>
                                          </thead>
                                          <tbody>						
	                                     <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_monitor");
											while ($data = mysqli_fetch_array($query)) :
											$soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_evaluasi WHERE idm='$data[id]' and idsiswa='$ids'"));	
											 ($soal['jawab'] == 'T') ? $jwbT = 'checked' : $jwbT = '';
											 ($soal['jawab'] == 'Y') ? $jwbY = 'checked' : $jwbY = '';
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center"><?= $no; ?></td>                                           
											  <td><?= $data['monitoring'] ?></td>
											   <td><?= $data['evaluasi'] ?></td>
                                            <td>
											<input type="hidden" name="ids[]" value="<?= $siswa['id_siswa'] ?>">
											<input type="hidden" name="kelas[]" value="<?= $siswa['kelas'] ?>">
											<input type="hidden" name="idm[]" value="<?= $data['id'] ?>">
											<div class="row">
											<div class="col-md-6">
											 <label class="radio"><input type='radio' name='jawab[]<?= $no ?>' value='Y' required='true' <?= $jwbY ?>> 
							              <span class="check"></span>Ya</label>
										  </div><div class="col-md-6">
										  <label class="radio"><input type='radio' name='jawab[]<?= $no ?>' value='T' required='true' <?= $jwbT ?>> 
							              <span class="check"></span>Tidak</label>
											 </div> </div>
											
											</td>
											
                                            </tr>
										<?php endwhile; ?>
										</tbody>
                                            </table>
											<div class="kanan">
									  <button type="submit" class="btn btn-primary kanan">Simpan</button>
										</div>
										  </div>
										   </form>
						</div>
										
					               </div>
								</div>
							</div>
						
	<script>
    $('#formnilai').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'guru/input.php',
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
				window.location.replace("?pg=<?= enkripsi('monitor') ?>&k=<?= $kelas ?>&d=<?= $_GET['d'] ?>");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
     <?php endif ?>	