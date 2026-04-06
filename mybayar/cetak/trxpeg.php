<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			 <?php 
				if (empty($_GET['b'])) {
				$bulanmu = "";
				 }else{
				$bulanmu = $_GET['b'];
								   }
			   if (empty($_GET['t'])) {
				$tgl = "";
				}else{
				$tgl = $_GET['t'];
				 }
				 $bln = fetch($koneksi,'bulan',['bln'=>$bulanmu]);
				 ?>   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PEMBAYARAN PEGAWAI 
										<?php if($tgl<>''): ?>
										BULAN <?= strtoupper($bln['ket']) ?>
										<?php endif; ?>
										</h5>							
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
                                                    <th>NAMA PEGAWAI</th>
													 <th>JABATAN</th>
                                                    <th>TOTAL RP</th>
													<th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											if($bulanmu<>''):
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level<>'admin' and level<>'awas'"); 
											while ($peg = mysqli_fetch_array($query)) :
											$dt1 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='1'")); 
												$jjm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,bulan,tahun,sum(jjm) as jml FROM absen_jjm  WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun'"));
												$ajar = $jjm['jml'] * $dt1['besar'];
											$dt2 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='2'"));
                                                $jsiang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idpeg,ket,bulan,tahun,sum(honor) as total,sum(jumlah) as jml FROM absen_tu WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='siang'"));
												$bayarstaf = $jsiang['total'];
											$dt3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='3'"));
                                                 $jmalam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_tu WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='malam' GROUP BY idpeg"));
											     $bayarmalam = $jmalam * $dt3['besar'];
											$dt4 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='4'"));
                                                 $jeskul = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absensi_les WHERE idpeg='$peg[id_user]' and bulan='$bulanmu' and tahun='$tahun' and ket='H'"));
											     $bayareskul = $jeskul * $dt4['besar'];
											$dt5 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM gaji WHERE idpeg='$peg[id_user]' and kode='5'"));
											$jumbayar = ($ajar + $bayarstaf + $bayarmalam + $bayareskul + $dt5['besar']);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $peg['nama'] ?></td>
													<td><?= $peg['jabatan'] ?></td>
													<td><?= number_format($jumbayar); ?></td>
												
													<td>
													<?php if($setting['jam']=='2'): ?>
													<?php if($peg['level']=='guru'){ ?>
													<a href="cetak/cetakabsen.php?idpeg=<?= $peg['id_user'] ?>&b=<?= $bulanmu ?>" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak KBM"><i class="material-icons">print</i></a>
													<?php }else{ ?>
													<a href="cetak/cetakabsenstaff.php?idpeg=<?= $peg['id_user'] ?>&b=<?= $bulanmu ?>" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Staff"><i class="material-icons">print</i></a>
													<?php } ?>
													<?php else: ?>
													<button class="btn btn-sm btn-light" disabled><i class="material-icons">lock</i></button>
													<?php endif; ?>
													
													<a href="cetak/cetakrinci.php?idpeg=<?= $peg['id_user'] ?>&b=<?= $bulanmu ?>&t=<?= $tgl ?>" target="_blank" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Rincian"><i class="material-icons">print</i></a>
													
												
													</td>
                                                </tr>
												<?php endwhile; ?>
												<?php endif; ?>
												<tbody>
                                                </table>
												 </div>
									          </div>
											</div>
										</div>
						<div class="col-md-4">
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
								 <form id="formbayar" action='cetak/cetakgaji.php' target="_blank" method='GET'  enctype='multipart/form-data'>	  
							   <div class="col-md-12 mb-2">
								<label class="form-label bold">BULAN</label>
									<select name="bulan"  class="form-select bulan" style="width: 100%;" required >
										<option value="<?= $bulanmu ?>"><?= $bln['ket'] ?></option>
										<option value=''>Pilih Bulan</option>
										<?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
									    <?php while ($mt = mysqli_fetch_array($qt)) : ?>
										<option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
										<?php endwhile ?>
										</select>   
								</div>				
							<div class="col-md-12 mb-2">
								<label class="form-label bold">TANGGAL BAYAR</label>
								<input type="text" name="tanggal" value="<?= $tgl ?>" class="form-control datepicker" autocomplete="off" >
							</div>
                   
						    <?php if($tgl<>''): ?>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary kanan">CETAK</button>
								</div>
								<?php endif; ?>
							</form>
						</div>
					</div>
				</div>
								
				<script type="text/javascript">
                 $('.datepicker').change(function() {
				var t = $('.datepicker').val();
				var b = $('.bulan').val();
                location.replace("?pg=<?= enkripsi('trxpeg') ?>&t=" + t + "&b=" + b);
                  }); 
               </script>