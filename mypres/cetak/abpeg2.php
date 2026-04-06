 <?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$bulan = date('m');
$blQ = fetch($koneksi,'bulan',['bln'=>$bulan]);
 if (empty($_GET['bln'])) {
        $bln = "";
    } else {
        $bln = $_GET['bln'];
    }
?>


                        <div class="row">
                           <div class="col-xl-8">
                                <div class="card">
                                   <div class="card card-header">
									<h5 class="card-title">BULAN <?= strtoupper($blQ['ket']); ?> <?= date('Y') ?></h5>
										</div>
                                    <div class="card-body">
                                         <div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NAMA LENGKAP</th>
                                                    <th>PEMBINA</th>
                                                      <th>H &nbsp;</th>
                                                    <th>I &nbsp;</th>
													<th>S &nbsp;</th>
													<th>A &nbsp;</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$tahun = date('Y');
											$no=0; 
											$query = mysqli_query($koneksi, "SELECT * FROM m_eskul"); 
											 while ($data = mysqli_fetch_array($query)) :
				                             $peg = fetch($koneksi, 'users',['id_user'=>$data['guru']]);
											  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='H' AND bulan='$bulan' AND tahun='$tahun'"));
											$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='I' AND bulan='$bulan' AND tahun='$tahun'"));
											$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='S' AND bulan='$bulan' AND tahun='$tahun'"));
											$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$data[guru]' AND ket='A' AND bulan='$bulan' AND tahun='$tahun'"));
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $peg['nama'] ?></td>
                                                     <td><?= strtoupper($data['eskul']); ?></td>
                                                     <td><?= $hadir; ?></td>
													   <td><?= $izin; ?></td>
													     <td><?= $sakit; ?></td>
														   <td><?= $alpha; ?></td>
                                                    
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
												  
													<div class="d-flex align-items-center flex-column">
													 <div class="sw-13 position-relative mb-3">
														<img src="<?= $baseurl ?>/images/absen.png" class="responsive" alt="thumb" />
														</div>
													<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
														  <div class="text-muted">HIGH SCHOOL</div>
														</div>
													 
													<div class="col-md-12 mb-1">
													 <label class="bold">BULAN</label>                               
													  <select  class="form-select bln" id="bln" style="width: 100%;" required >
														<?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
														<option> Pilih Bulan</option>
														<?php while ($mt = mysqli_fetch_array($qt)) : ?>
														<option <?php if ($bln == $mt['bln']) {
														echo "selected";
														} else {
														} ?> value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
														<?php endwhile; ?>
														</select>                                                   
													</div>                                               
                                           
											<script type="text/javascript">
											$('#bln').change(function() {
											var bln = $('.bln').val();                                  
											location.replace("?pg=<?= enkripsi('abpeg2') ?>&bln=" + bln);
											}); 
											</script>
											
									        <?php if($bln!=''): ?>
                                           <div class="d-grid gap-2">
												<br>										   
                                                <a href="cetak/cetakpeg2.php?bln=<?= $bln ?>" target="_blank" class="btn btn-danger flex-grow-1 m-l-xxs">CETAK REKAP PDF</a>
                                            </div>											  
											  <?php endif; ?>
                                           </div>
										
                                       </div>
                                    </div>
                            
                                </div>
                            </div>
                        </div>	
					</div>
                  </div>
			  </div>
			