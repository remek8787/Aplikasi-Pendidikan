<?php 
defined('APK') or exit('No Access');
$bulan = date('m');
$jsurat = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpeg FROM surat where idsiswa='$siswa[id_siswa]'"));
$jhadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi where idsiswa='$siswa[id_siswa]' and ket='H' and bulan='$bulan'"));

?>

		<div class="row">
				<div class="col-xl-4">
				<div class="card">
				  <div class="card card-header">
				   <h5 class="card-tittle">PERRMOHONAN SURAT</h5>
				   </div>
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
				   <form id='formguru' >	
				   <input type="hidden" name="idg" value="<?= $siswa['id_siswa'] ?>" >
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
									 url: 'tsurat.php',
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
												}, 2000);
															  
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
                                                <span class="widget-stats-title">HADIR</span>
                                                <span class="widget-stats-amount"><?= $jhadir; ?></span>
                                               
                                            </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </div>
						</div>
					</div>
						