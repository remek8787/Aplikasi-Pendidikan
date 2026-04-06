					<?php
					defined('APK') or exit('No accsess');
					?> 		
					 <?php

					if (empty($_GET['k'])) {
						$kelas = "";
						
					} else {
						$kelas = $_GET['k'];
						
					}
					if (empty($_GET['b'])) {
						$b = "";
						
					} else {
						$b = $_GET['b'];
						
					}
					if (empty($_GET['d'])) {
						$d = "";
						
					} else {
						$d = $_GET['d'];
						
					}
					$dudi = fetch($koneksi,'pkl_dudi',['id'=>$d]);
					$bulanmu = fetch($koneksi,'bulan',['bln'=>$b]);
				?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
									<h5 class="card-title">CETAK PRESENSI <?= $kelas ?></h5>
										</div>
                                    <div class="card-body">
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                        <thead>
                                         <tr>
                                          <th>NO</th>
                                         <th>WAKTU</th>									  
										  <th>NAMA SISWA</th>
                                         
										  <th>KET</th>										 
										 
                                          </tr>
                                          </thead>
                                          <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE kelas='$kelas' and bulan='$b' and dudi='$d'");
											while ($data = mysqli_fetch_array($query)) :
											$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[idsiswa]'"));
											$no++;
											   ?>
                                            <tr style="vertical-align:middle;">
                                             <td class="text-center"><?= $no; ?></td>                                           
											  <td><?= $data['tanggal'] ?> <?= $data['jam'] ?></td>
											   <td><?= $siswa['nama'] ?></td>
                                            
											 <td>
											H
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
									 <label class="bold">BULAN</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="bulan" id="bulan" required style="width: 100%">
									<option value="<?= $b ?>"><?= $bulanmu['ket'] ?></option>
									<option value="">Pilih Bulan</option>
									  <?php
										$bln = mysqli_query($koneksi, "SELECT bulan FROM pkl_kegiatan GROUP BY bulan");
										while ($bl = mysqli_fetch_array($bln)):
                                        $bulane = fetch($koneksi,'bulan',['bln'=>$bl['bulan']]);
										?>
										<option value="<?= $bl[bulan] ?>"><?= $bulane['ket'] ?></option>
										<?php endwhile; ?>
									</select>
									 </div>					   
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">PILIH</button>
										<?php if($b<>''): ?>
										<a href="cetak/cetakabsen.php?kls=<?= $_GET['k'] ?>&b=<?= $b ?>&d=<?= $d ?>" target="_blank"  class="btn btn-success flex-grow-1 m-l-xxs">CETAK</a>
										<?php endif; ?>
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
                                    var b = $('#bulan').val(); 
									var d = $('#dudi').val(); 
                                    location.replace("?pg=<?= enkripsi('cetakpresensi') ?>&k=" + k + "&b=" + b + "&d=" + d);
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
     