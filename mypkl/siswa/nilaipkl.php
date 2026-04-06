					<?php
					defined('APK') or exit('No accsess');
					?> 		
					 <?php

					if (empty($_GET['k'])) {
						$kelas = "";
						
					} else {
						$kelas = $_GET['k'];
						
					}
					if (empty($_GET['a'])) {
						$aspek = "";
						
					} else {
						$aspek = $_GET['a'];
						
					}
					if (empty($_GET['idn'])) {
						$idn = "";
						
					} else {
						$idn = $_GET['idn'];
						
					}
					$pkl = fetch($koneksi,'pkl_mnilai',['id'=>$idn]);
					 if($pkl['kode']=='A'){$keter='SIKAP';}
					if($pkl['kode']=='B'){$keter='PENGETAHUAN';}
					if($pkl['kode']=='C'){$keter='KETERAMPILAN';}
				?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
									<hr>
									<p style="font-size:14px;font-weight:bold;color:blue">Penilaian : <?= $pkl['aspek'] ?></p>
									<p>Penilaian dengan rentang 0 - 100 </p>
									<hr>
									<form id="formnilai">									
                                        <table  class="edis2" style="width:100%;font-size:12px">
                                          
                                                <tr>
                                                  <th width="5%">NO</th>												  
												  <th width="50%">NAMA SISWA</th>
												  <th>KELAS</th>
                                                  <th>NILAI</th>												 							 
                                                </tr>
                                           
											<?php
											$no = 0;
											$query = mysqli_query($koneksi,"SELECT id_siswa,kelas,nama FROM siswa WHERE kelas='$kelas'");
											  while ($data = mysqli_fetch_array($query)) :
											 $nilai = fetch($koneksi,'pkl_nilai',['idsiswa'=>$data['id_siswa'],'ida'=>$idn]);
											$no++;
											   ?>
											   <tr style="vertical-align:middle;">
                                                 <td height="15px"><?= $no; ?></td>
                                                  <td><?= $data['nama'] ?></td>
													<td><?= $data['kelas'] ?></td>
													<td>
													<input type="number" name="nilai[]<?php echo $no; ?>" class="form-control" value="<?= $nilai['nilai'] ?>" required="true" style="width:150px;"> 
													  <input type="hidden" name="tanggal[]" value="<?= $tanggal ?>" >
													  <input type="hidden" name="idsiswa[]" value="<?= $data['id_siswa'] ?>" >
													  <input type="hidden" name="kelas[]" value="<?= $data['kelas'] ?>" >						 
													  <input type="hidden" name="idn[]" value="<?= $idn ?>" >
													   
													</td>
													
                                                </tr>
												<?php endwhile; ?>
												
                                                </table>
									<?php if($kelas<>''): ?>
									<div class="kanan">
									  <button type="submit" class="btn btn-primary kanan">Simpan</button>
										</div>
										<?php endif; ?>
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
									<div class="row g-1">
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
									<label class="bold">ASPEK PENILAIAN</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="aspek" id="aspek" required style="width: 100%">
									<option value="<?= $aspek ?>"><?= $keter ?></option>
									<option value="">Pilih Aspek</option>
									  <?php
										$que = mysqli_query($koneksi, "SELECT * FROM pkl_mnilai GROUP BY kode");
										while ($d = mysqli_fetch_array($que)):
                                         if($d['kode']=='A'){$ket='SIKAP';}
										 if($d['kode']=='B'){$ket='PENGETAHUAN';}
										 if($d['kode']=='C'){$ket='KETERAMPILAN';}
										?>
										<option value="<?= $d['kode'] ?>"><?= $ket ?></option>
										<?php endwhile; ?>
									</select>
                                    </div>	
									<label class="bold">PENILAIAN</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="idn" id="idn" required style="width: 100%">
										
									</select>
									 </div>	
									</div>
									
					               </div>
								</div>
							</div>
						</div>
						<script>	
						$("#aspek").change(function() {
						var aspek = $(this).val();
						console.log(aspek);
						$.ajax({
						type: "POST",
						url: "siswa/ambildata.php?pg=nilai", 
						data: "aspek=" + aspek, 
						success: function(response) { 
						$("#idn").html(response);
								}
							});
						});
						
						</script>
					<script type="text/javascript">
                                $('#idn').change(function() {
                                    var k = $('#kelas').val();
                                    var a = $('#aspek').val();
									 var idn = $('#idn').val();
                                    location.replace("?pg=<?= enkripsi('inputnilai') ?>&k=" + k + "&a=" + a + "&idn=" + idn);
                                }); 
                            </script>
	
<?php endif ?>
	<script>
    $('#formnilai').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/input.php',
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
     