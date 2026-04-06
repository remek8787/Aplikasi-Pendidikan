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
                                                    <th>JABATAN</th>
                                                      <th>H &nbsp;</th>
                                                    <th>I &nbsp;</th>
													<th>S &nbsp;</th>
													<th>A &nbsp;</th>
                                                   <th>DETAIL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											
											$no=0; 
											$query = mysqli_query($koneksi, "SELECT * FROM users where level<>'admin'"); 
											 while ($data = mysqli_fetch_array($query)) :
				                             
											  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='H' AND bulan='$bulan'"));
											$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='I' AND bulan='$bulan'"));
											$sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='S' AND bulan='$bulan'"));
											$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi WHERE idpeg='$data[id_user]' AND ket='A' AND bulan='$bulan'"));
											
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nama'] ?></td>
                                                     <td><?= ucfirst($data['level']); ?></td>
                                                     <td><?= $hadir; ?></td>
													   <td><?= $izin; ?></td>
													     <td><?= $sakit; ?></td>
														   <td><?= $alpha; ?></td>
                                                    <td>
													<a href="?pg=<?= enkripsi('detail') ?>&ids=<?= $data['id_user'] ?>" class="btn btn-sm btn-primary">Detail</a>
													</td>
														</tr>
														<?php endwhile; ?>
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
													 <label class="form-label">BULAN</label>                               
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
											 location.replace("?pg=<?= enkripsi('abpeg') ?>&bln=" + bln);
											}); 
											</script>
											
									        <?php if($bln!=''): ?>
                                           <div class="d-grid gap-2">                                  
                                                <a href="cetak/cetakpeg.php?bln=<?= $bln ?>" target="_blank" class="btn btn-primary flex-grow-1 m-l-xxs">CETAK REKAP PDF</a>
                                            </div>
											
											  <?php endif; ?>
                                           </div>
										
                                       </div>
                                    </div>
                            
                                </div>
                            </div>
                       
			