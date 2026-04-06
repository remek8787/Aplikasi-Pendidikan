 <?php 
defined('APK') or exit('No Access');
$bulan = date('m');
$blQ = fetch($koneksi,'bulan',['bln'=>$bulan]);
?>


                        <div class="row">
                           <div class="col-xl-8">
                                <div class="card">
                                   <div class="card card-header">
								<h5 class="card-title">DATA PRESENSI</h5>
										</div>
                                    <div class="card-body">
                                         <div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>NO</th>
                                                <th>BULAN</th>
                                                <th>SISWA</th>
                                                <th>PEGAWAI</th>
												<th>TOTAL</th>												
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php											
											$no=0; 											
											$query = mysqli_query($koneksi, "SELECT * FROM bulan"); 
											while ($data = mysqli_fetch_array($query)) :
				                            $absis = mysqli_num_rows(mysqli_query($koneksi, "SELECT bulan,level FROM absensi_les WHERE bulan='$data[bln]' AND level='siswa'"));
											$abpeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT bulan,level FROM absensi_les WHERE bulan='$data[bln]' AND level='pegawai'"));
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $data['ket'] ?></td>
                                                    <td>
													<?php if($absis<>0): ?>
													<?= $absis; ?> 
													<?php endif; ?>
													</td>
													<td>
													<?php if($abpeg<>0): ?>
													<?= $abpeg; ?> 
													<?php endif; ?>
													</td>
													<td class="bold">
													<?php if(($absis + $abpeg)<>0): ?>
													<?= ($absis + $abpeg); ?> 
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
									 <form id="formabsen">
									 <div class="col-md-12 mb-2">
                                       <label>BULAN</label>
                                        <select name="bulan"  class="form-select" style="width: 100%;" required >
										<option value=''></option>
										<?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
										<?php while ($mt = mysqli_fetch_array($qt)) : ?>
										<option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
										<?php endwhile ?>
										</select>   
									</div>                                               
                                     <div class="d-grid gap-2">
                                        <button type="submit"  class="btn btn-danger flex-grow-1 m-l-xxs">HAPUS PRESENSI</button>
                                       </div>
                                      </form>
										
                                    </div>
                                </div>
                            </div>
                        </div>                            	
					</div>
				 <script>
					$('#formabsen').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'hapus/hapusles.php',
							data: data,
							cache: false,
							contentType: false,
							processData: false,
							 beforeSend: function() {
							  $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
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
