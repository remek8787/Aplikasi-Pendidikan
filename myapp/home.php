<?php 
defined('APK') or exit('No Access');
$jpes = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_siswa FROM siswa"));
$jpin = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket FROM alumni WHERE ket='Pindah'"));
$jtam = mysqli_num_rows(mysqli_query($koneksi, "SELECT ket FROM alumni WHERE ket='Tamat'"));
$psb = fetch($koneksi,'pdb');
$jmap = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM mapel"));
$jblok = mysqli_num_rows(mysqli_query($koneksi, "SELECT blok FROM siswa WHERE blok='1'"));
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
$hapus = mysqli_query($koneksi,"DELETE FROM absen_pesan WHERE tanggal<>'$tanggal'");
$dinlu = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg FROM data_luar WHERE idpeg='$id_user'"));
?>

<style>
.divTable {
    width: 100%;
    display: table;
  
}
.divTableRow {
    width: 100%;
    height: 100%;
    display: table-row;
}
.divTableCell{
    padding:10px;
    width: 50%;
    height: 100%;
    display: table-cell;
    
}


</style>
<?php if($user['level']=='admin'): ?>


            <div class="row">
				<div class="col-xl-4">
				<div class="card">
				  <div class="card card-header">
				   <h5 class="bold text-center">MENU ADMIN</h5>
				   </div>
                   <div class="card-body" style="height:850px;">
				   <div class="divTable">
					  <div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../mykbm/" ><img src="../images/icon/buku.ico"></a><br>E KBM </div>
					<div class="divTableCell text-center"><a href="../mypres/" ><img src="../images/icon/presensi.ico"></a><br>E Presensi </div>
					</div>
					 <div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../myhome/" ><img src="../images/icon/ujian.ico"></a><br>E Asesmen </div>
					<div class="divTableCell text-center"><a href="../mylearn/" ><img src="../images/icon/belajar.ico"></a><br>E Learning </div>
					</div>
					 <div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../myrapor/" ><img src="../images/icon/k13.ico"></a><br>E Rapor </div>
					<div class="divTableCell text-center"><a href="../myskl/" ><img src="../images/icon/amplop.ico"></a><br>E SKL </div>
					</div>
					<div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../myproyek/" ><img src="../images/icon/p5.ico"></a><br>E Rapor P5</div>
					<div class="divTableCell text-center"><a href="../mykonsel/" ><img src="../images/icon/konsel.ico"></a><br>E Konseling </div>
					</div>
					<div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../myadm/" ><img src="../images/icon/disfo.ico"></a><br>E Admninistrasi</div>
					<div class="divTableCell text-center"><a href="../myperpus/" ><img src="../images/icon/pustaka.ico"></a><br>E Pustaka</div>
					</div>
					<div class="divTableRow" >
					<div class="divTableCell text-center"><a href="../mybayar/" ><img src="../images/icon/payment.ico"></a><br>E Payment </div>
					<div class="divTableCell text-center"><a href="../mykantin/" ><img src="../images/icon/kantin.ico"></a><br>E Kantin </div>					
					</div>
					<div class="divTableRow" >			
					<div class="divTableCell text-center"><a href="../mypras/" ><img src="../images/icon/sapras.ico"></a><br>E Sapras </div>					
					<div class="divTableCell text-center"><a href="../mylapor/" ><img src="../images/icon/laporan.ico"></a><br>Laporan Bulanan </div>				
					</div>
					
					<div class="divTableRow" >	
					<div class="divTableCell text-center"><a href="?pg=<?= enkripsi('bell') ?>" ><img src="../images/icon/bel.ico"></a><br>Bell Sekolah Auto</div>				
					<?php if($setting['jenjang']=='SMK'): ?>
					<div class="divTableCell text-center"><a href="../mypkl/" ><img src="../images/icon/pkl.ico"></a><br>E Prakerin </div>
					<?php endif; ?>
					</div>
					
               </div>
			   </div>
			     </div>
					   </div>
					   <div class="col-xl-8">
					    <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">school</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA AKTIF</span>
                                                <span class="widget-stats-amount"><?= $jpes; ?> </span>
                                               
                                            </div>
                                            <a href="?pg=<?= enkripsi('siswa') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA PINDAH</span>
                                                <span class="widget-stats-amount"><?= $jpin; ?></span>
                                               
                                            </div>
                                             <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('alumni') ?>&ket=Pindah" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            
											<div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA TAMAT</span>
                                                <span class="widget-stats-amount"><?= $jtam ?> </span>
                                              
                                            </div>
                                            <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('alumni') ?>&ket=Tamat" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA BARU</span>
                                                <span class="widget-stats-amount"><?= $psb['jumlah']; ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           </div> 
						<div class="row">
								<div class="col-md-6">
										<div class="card">
											<div class="card-body">										
											<div class="d-flex align-items-center flex-column">
											 <div class="sw-13 position-relative mb-3">
												<img src="<?= $baseurl ?>/images/blast.png" class="responsive" alt="thumb" >
												</div>
											<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
												  <div class="text-muted">WA GATEWAY</div>
												</div>
											<form id="formkelas" class="row g-1">
										<div class="col-md-12">
											<label class="bold"> Pesan Masal Kelas</label>
												<select name='kelas' class='form-select' style='width:100%' required="true" >
												<option value=''>Pilih Kelas</option>
												<?php
												$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
												while ($kelas = mysqli_fetch_array($kls)) {
												echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
												}
												?>
												</select>
											</div>
										
										<div class="col-md-12">
									 <label class="bold"> Isi Pesan</label>
									 <textarea name='pesan' class='form-control'  rows="6" required="true" ></textarea>
									 </div>
									
									 <div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">KIRIM</button>
										</div>
									</form>
								   </div>
								</div>
						   </div>
				       <script>
							   $('#formkelas').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/masalsis.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 1000);

										}
									});
									return false;
								});
							   
							</script>
							
				 
							<div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">										
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/blast.png" class="responsive" alt="thumb" >
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">WA GATEWAY</div>
										</div>
                               	    <form id="formsiswa" class="row g-1">
                                <div class="col-md-12">
									<label class="bold"> Kepada Ortu Siswa</label>
										<select name='kelas' id="kelas" class='form-select' style='width:100%' required="true" >
										<option value=''>Pilih Kelas</option>
										<?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
										</select>
									</div>
                                 <div class="col-md-12">
									<label class="bold"> Pilih Siswa</label>
										<select name='siswa' id="siswa" class='form-select' style='width:100%' required="true" >
										
										</select>
									</div>
								<div class="col-md-12">
							 <label class="bold"> Isi Pesan</label>
							 <textarea name='pesan' class='form-control'  rows="3" required="true" ></textarea>
							 </div>
							
							 <div class="col-md-12">
								<button type="submit" class="btn btn-primary kanan">KIRIM</button>
								</div>
							</form>
                           </div>
                          </div>
						</div>
						
						<div class="col-md-12">
						 <div class="card">
                            <div class="card-body" style="height:150px">	
						<marquee bgcolor="#fff" scrollamount="15" scrolldelay="200" style="font-size:48px;color:#ff0000;padding:10px;text-shadow:0px 3px 5px #000;">
						Sistem Aplikasi Pendidik (Sandik All in One)</marquee>
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
									url: "masal/ambildata.php?pg=siswa", 
									data: "kelas=" + kelas, 
									success: function(response) { 
									$("#siswa").html(response);
									console.log(response);
									}
								});
							});
							</script>
							<script>
							   $('#formsiswa').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/siswa.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 1000);

										}
									});
									return false;
								});
							   
							</script>
							
							<div class="col-xl-4">
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">LOG AKTIFITAS</h5>
                                    </div>
                                    <div class="card-body" style="height:355px;">
									<?php
									$tgl= date('Y-m-d');
									$query = mysqli_query($koneksi, "SELECT * FROM log WHERE level<>'siswa' ORDER BY id_log DESC LIMIT 3"); 			
									while ($data = mysqli_fetch_array($query)) :
									$pusat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[id_user]'"));	
									$tgllog = date('Y-m-d',strtotime($data['date']));
									?>
									<?php if($tgl<>$tgllog):?>
									 <?php $exec = mysqli_query($koneksi, "truncate log"); ?>
									  <?php endif; ?>	
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author" style="background-color:#fff">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $pusat['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $data['date']; ?></span>
													<p style="color:blue;"><?= timeAgo($data['date']) ?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
										<?php endwhile; ?>
										
                                    </div>
                                </div>
							</div>
						<div class="col-md-4">
                                <div class="card">
                                    <div class="card-body" style="height:400px;">										
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/blast.png" class="responsive" alt="thumb" >
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">WA GATEWAY</div>
										   <div class="text-muted">PEGAWAI</div>
										</div>
                               	    <form id="formpegawai" class="row g-1">
								<div class="col-md-12">
							 <label class="bold"> Isi Pesan</label>
							 <textarea name='pesan' class='form-control'  rows="6" required="true" ></textarea>
							 </div>
							
							 <div class="col-md-12">
								<button type="submit" class="btn btn-primary kanan">KIRIM</button>
								</div>
							</form>
                           </div>
                        </div>
                   </div>
				   <script>
							   $('#formpegawai').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/pegawai.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 1000);

										}
									});
									return false;
								});
							   
							</script>
							
								<div class="col-md-4">
                                <div class="card">
                                    <div class="card-body edis2" style="height:400px;">										
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/blast.png" class="responsive" alt="thumb" >
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">WA GATEWAY</div>
										</div>
										 
                               	 <?php
									$tgl= date('Y-m-d');
									$query = mysqli_query($koneksi, "SELECT * FROM pesan_terkirim ORDER BY id DESC LIMIT 1"); 			
									while ($data = mysqli_fetch_array($query)) :
									$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[idpeg]'"));	
									$sis = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE id_siswa='$data[idsiswa]'"));	
									$tgllog = date('Y-m-d',strtotime($data['tgl']));
									?>
									
									  <div class="card widget widget-payment-request">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author" style="background-color:#fff">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/blast.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $peg['nama'] ?></span>
													 <span class="widget-payment-request-author-name"><?= $sis['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $data['tgl']; ?></span>
													</div>												
                                            </div>
                                           </div>
                                        </div>
										<?= $data['isi'] ?>
										
										<?php endwhile; ?>
											
                           </div>
                        </div>
                   </div>
				</div>
                       
	<?php endif; ?>				  
							
	<?php if($user['level']=='guru'): ?>
    <?php 
	$jsurat = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg FROM surat where idpeg='$user[id_user]'"));
    $jph = mysqli_num_rows(mysqli_query($koneksi, "SELECT guru FROM nilai_harian where guru='$user[id_user]'"));
	$jas = mysqli_num_rows(mysqli_query($koneksi, "SELECT idguru FROM banksoal where idguru='$user[id_user]'"));
	$r1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT guru FROM nilai_formatif where guru='$user[id_user]'"));
	$r2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT guru FROM nilai_k13 where guru='$user[id_user]'"));
	$jar = $r1 + $r2;
	?>	
		<div class="row">
				<div class="col-xl-4">
				<div class="card">
				  <div class="card card-header">
				   <h5 class="card-tittle">PERRMOHONAN SURAT</h5>
				   </div>
                   <div class="card-body" style="height:520px">
				    <div class="d-flex align-items-center flex-column mb-4">
						<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
						<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
							</div>
							
					<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
						<div class="text-muted">HIGH SCHOOL</div>
							</div>
					</div>
				   <form id='formguru' >	
				   <input type="hidden" name="idg" value="<?= $user['id_user'] ?>" >
					<div class="col-md-12 mb-1">
					<label class="bold">Surat Keterangan</label>
                     <select name='surat' id="surat" class='form-select' style='width:100%' required>
					 <option value=''>Pilih Keterangan</option>
					 <option value='I'>Surat Izin</option>
					<option value='S'>Surat Ket Sakit</option>
					</select>
					 </div>
					 <div class="col-md-12 mb-1">
					 <label class="bold">Bukti Foto / File</label>
					 <input type="file" name="file" class="form-control" required="true">
					 </div>
					  <div class="col-md-12 mb-1">
					 <button type="submit" class="btn btn-primary kanan">KIRIM</button>
					 </div>
					 </form>
					 
					</div>
               </div>
			   </div>
			 	<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'user/tsurat.php',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								
									},
									success: function(data){   		
									setTimeout(function()
										{
										window.location.reload();
												}, 1000);
															  
												}
											});
										return false;
									});
								</script>	
                        
				 <div class="col-xl-8">
					    <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">mail</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">PERMOHONAN SURAT</span>
                                                <span class="widget-stats-amount"><?= $jsurat; ?> </span>
                                               
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">LOG PENILAIAN HARIAN</span>
                                                <span class="widget-stats-amount"><?= $jph; ?></span>
                                               
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            
											<div class="widget-stats-icon widget-stats-icon-info">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">LOG ASESMEN</span>
                                                <span class="widget-stats-amount"><?= $jas ?> </span>
                                              
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                            <div class="col-xl-6">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">LOG RAPOR</span>
                                                <span class="widget-stats-amount"><?= $jar; ?></span>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
							 <div class="col-xl-12">
							 <div class="card widget widget-stats">
							 <div class="card card-header">
							   <h5 class="card-tittle">INFORMASI</h5>
							   </div>
                                    <div class="card-body">
									<?php 
									$query = mysqli_query($koneksi, "SELECT * FROM pesan_terkirim WHERE ket='pegawai' ORDER BY id DESC LIMIT 2"); 			
									while ($data = mysqli_fetch_array($query)) :
									?>
									<div class="card widget widget-payment-request">
									<div class="widget-payment-request-container">
									<div class="widget-payment-request-author">
									<div class="avatar m-r-sm">
										<img src="../images/amplop.png" alt="">
											</div>
									   <div class="widget-payment-request-author-info">
									   <p></p>
										  <span class="widget-payment-request-author-name bold">INFO : <?= $setting['sekolah'] ?> <small class="badge badge-primary"><?= date('d-m-Y',strtotime($data['tgl'])) ?></small></span>
										 <p><?= $data['isi'] ?></p>
											</div>
											  </div>
											   </div>
											    </div>
									<?php endwhile; ?>
									</div>
								</div>
							 </div>
                           </div> 
						 </div>  
 </div>  
						 
	<?php endif; ?>
	<?php if($user['level']=='staff'): ?>
	
					    <div class="row">
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
											<div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">school</i>
                                            </div>
											
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA AKTIF</span>
                                                <span class="widget-stats-amount"><?= $jpes; ?> </span>
                                               
                                            </div>
                                            <a href="?pg=<?= enkripsi('siswa') ?>" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                           
											<div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">face</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA PINDAH</span>
                                                <span class="widget-stats-amount"><?= $jpin; ?></span>
                                               
                                            </div>
                                             <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('alumni') ?>&ket=Pindah" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            
											<div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">person</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA TAMAT</span>
                                                <span class="widget-stats-amount"><?= $jtam ?> </span>
                                              
                                            </div>
                                            <a href="?pg=<?= enkripsi('siswa') ?>&ac=<?= enkripsi('alumni') ?>&ket=Tamat" class="btn btn-sm btn-link kanan">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <div class="col-xl-4">
				<div class="card">
				  <div class="card card-header">
				   <h5 class="card-tittle">PERRMOHONAN SURAT</h5>
				   </div>
                   <div class="card-body" style="height:385px">
				    <div class="d-flex align-items-center flex-column mb-4">
						<div class="d-flex align-items-center flex-column">
						<div class="sw-13 position-relative mb-3">
						<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
							</div>
							
					<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
						<div class="text-muted">HIGH SCHOOL</div>
							</div>
					</div>
				   <form id='formguru' >	
				   <input type="hidden" name="idg" value="<?= $user['id_user'] ?>" >
					<div class="col-md-12 mb-1">
					<label class="bold">Surat Keterangan</label>
                     <select name='surat' id="surat" class='form-select' style='width:100%' required>
					 <option value=''>Pilih Keterangan</option>
					 <option value='I'>Surat Izin</option>
					<option value='S'>Surat Ket Sakit</option>
					</select>
					 </div>
					 <div class="col-md-12 mb-1">
					 <label class="bold">Bukti Foto / File</label>
					 <input type="file" name="file" class="form-control" required="true">
					 </div>
					  <div class="col-md-12 mb-1">
					 <button type="submit" class="btn btn-primary kanan">KIRIM</button>
					 </div>
					 </form>
					 
					</div>
               </div>
			   </div>
			 	<script>
							$('#formguru').submit(function(e){
								e.preventDefault();
								var data = new FormData(this);
								$.ajax(
								{
									type: 'POST',
									 url: 'user/tsurat.php',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
								
									},
									success: function(data){   		
									setTimeout(function()
										{
										window.location.reload();
												}, 1000);
															  
												}
											});
										return false;
									});
								</script>	
                         <div class="col-md-8">
							 <div class="card widget widget-stats">
							 <div class="card card-header">
							   <h5 class="card-tittle">INFORMASI</h5>
							   </div>
                                    <div class="card-body">
									<?php 
									$query = mysqli_query($koneksi, "SELECT * FROM pesan_terkirim WHERE ket='pegawai' ORDER BY id DESC LIMIT 3"); 			
									while ($data = mysqli_fetch_array($query)) :
									?>
									<div class="card widget widget-payment-request">
									<div class="widget-payment-request-container">
									<div class="widget-payment-request-author">
									<div class="avatar m-r-sm">
										<img src="../images/amplop.png" alt="">
											</div>
									   <div class="widget-payment-request-author-info">
									   <p></p>
										  <span class="widget-payment-request-author-name bold">INFO : <?= $setting['sekolah'] ?> <small class="badge badge-primary"><?= date('d-m-Y',strtotime($data['tgl'])) ?></small></span>
										 <p><?= $data['isi'] ?></p>
											</div>
											  </div>
											   </div>
											    </div>
									<?php endwhile; ?>
									</div>
								</div>
							 </div>
                            </div>
								
							<div class="row">
							 
							<div class="col-xl-4">
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">LOG AKTIFITAS</h5>
                                    </div>
                                    <div class="card-body" style="height:390px;">
									<?php
									$tgl= date('Y-m-d');
									$query = mysqli_query($koneksi, "SELECT * FROM log WHERE level<>'siswa' ORDER BY id_log DESC LIMIT 3"); 			
									while ($data = mysqli_fetch_array($query)) :
									$pusat = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users  WHERE id_user='$data[id_user]'"));	
									$tgllog = date('Y-m-d',strtotime($data['date']));
									?>
									<?php if($tgl<>$tgllog):?>
									 <?php $exec = mysqli_query($koneksi, "truncate log"); ?>
									  <?php endif; ?>	
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author" style="background-color:#fff">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $pusat['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $data['date']; ?></span>
													<p style="color:blue;"><?= timeAgo($data['date']) ?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
										<?php endwhile; ?>
                                    </div>
                                </div>
							</div>
							<div class="col-md-4">
										<div class="card">
											<div class="card-body">										
											<div class="d-flex align-items-center flex-column">
											 <div class="sw-13 position-relative mb-3">
												<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" >
												</div>
											<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
												  <div class="text-muted">WA GETEWAY</div>
												</div>
											<form id="formkelas" class="row g-1">
										<div class="col-md-12">
											<label class="bold"> Pesan Masal Kelas</label>
												<select name='kelas' class='form-select' style='width:100%' required="true" >
												<option value=''>Pilih Kelas</option>
												<?php
												$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
												while ($kelas = mysqli_fetch_array($kls)) {
												echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
												}
												?>
												</select>
											</div>
										
										<div class="col-md-12">
									 <label class="bold"> Isi Pesan</label>
									 <textarea name='pesan' class='form-control'  rows="6" required="true" ></textarea>
									 </div>
									
									 <div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">KIRIM</button>
										</div>
									</form>
								   </div>
								</div>
						   </div>
				       <script>
							   $('#formkelas').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/masalsis.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 1000);

										}
									});
									return false;
								});
							   
							</script>
							
				 
							<div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">										
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" >
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">WA GETEWAY</div>
										</div>
                               	    <form id="formsiswa" class="row g-1">
                                <div class="col-md-12">
									<label class="bold"> Kepada Ortu Siswa</label>
										<select name='kelas' id="kelas" class='form-select' style='width:100%' required="true" >
										<option value=''>Pilih Kelas</option>
										<?php
										$kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
										</select>
									</div>
                                 <div class="col-md-12">
									<label class="bold"> Pilih Siswa</label>
										<select name='siswa' id="siswa" class='form-select' style='width:100%' required="true" >
										
										</select>
									</div>
								<div class="col-md-12">
							 <label class="bold"> Isi Pesan</label>
							 <textarea name='pesan' class='form-control'  rows="3" required="true" ></textarea>
							 </div>
							
							 <div class="col-md-12">
								<button type="submit" class="btn btn-primary kanan">KIRIM</button>
								</div>
							</form>
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
									url: "masal/ambildata.php?pg=siswa", 
									data: "kelas=" + kelas, 
									success: function(response) { 
									$("#siswa").html(response);
									console.log(response);
									}
								});
							});
							</script>
							<script>
							   $('#formsiswa').submit(function(e) {
									e.preventDefault();
									var data = new FormData(this);
								  
									$.ajax({
										type: 'POST',
										url: 'masal/siswa.php',
										enctype: 'multipart/form-data',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										 $('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
													},
										success: function(data) {
										 
											setTimeout(function() {
												window.location.reload();
											}, 1000);

										}
									});
									return false;
								});
							   
							</script>
				  

                             </div>
						
				   
                     
	<?php endif; ?>
		<?php if($user['level']=='awas'): ?>
		<meta content="0; url=../myhome/" http-equiv="refresh">
		<?php endif; ?>