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
						$d = "";
						
					} else {
						$d = $_GET['d'];
						
					}
					$dudi = fetch($koneksi,'pkl_dudi',['id'=>$d]);
					
				?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">CETAK SERTIFIKAT</h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>									  
										  <th>NAMA SISWA</th>       
										  <th>LOKASI</th>
										<th></th>										  
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_siswa WHERE kelas='$kelas'  and dudi='$d'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[idsiswa]'"));
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center"><?= $no; ?></td>                                           
											  <td><?= $dudi['nama_dudi'] ?></td>
											   <td><?= $siswa['nama'] ?></td>
                                            
											 <td>
											<a href="cetak/cetak5.php?ids=<?= $siswa['id_siswa'] ?>&d=<?= $d ?>" target="_blank"  class="btn btn-sm btn-primary"><i class="material-icons">print</i></a>
										
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
                                    location.replace("?pg=<?= enkripsi('sertifikat') ?>&k=" + k + "&d=" + d);
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
     