<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$hari = date('D');
?>      
     
			<?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
								<div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">PRESENSI MAPEL <?= strtoupper(date('d M Y')); ?></h5></a>
										</div>
                                    
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NAMA LENGKAP</th>                                                  
                                                    <th>ROMBEL</th>
													<th>KET</th>
                                                    <th>MAPEL</th>
													 <th>GURU</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											   $tgl = date('Y-m-d');
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM absensi_mapel where tanggal='$tgl' order by id desc"); 
											 while ($data = mysqli_fetch_assoc($query)) :
											 $sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											 $peg = fetch($koneksi,'pegawai',['id_pegawai'=>$data['guru']]);
											 $mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											$no++;
											   ?>
                                                <tr>
                                                <td><?= $no; ?></td>                                              
                                                <td><?= $sis['nama'] ?></td>
                                                <td style="text-align:center;"><?= $data['kelas'] ?></td>
												<td style="text-align:center;"> <?= $data['ket'] ?></td>
                                                <td><?= $mpl['kode'] ?></td>
												<td><?= $peg['nama'] ?></td> 
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									 <div class="col-xl-4">
                                <div class="card widget widget-payment-request">
                                   <div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">PRESENSI GURU MAPEL</h5></a>
										</div>
                                    <div class="card-body">
									 <form id="formabsen" method="POST" action="absen/cetakharian.php"  enctype="multipart/form-data">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $setting['sekolah'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= date('d M Y') ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="widget-payment-request-info m-t-md">
                                                <div class="widget-payment-request-info-item">
                                                    <span class="widget-payment-request-info-title d-block">
													<label class="form-label">ROMBEL / KELAS</label>                               
                                  <select name="kelas"  class="form-select" style="width: 100%;" required >
                              <option value=''></option>
                                 <?php $kls = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY kelas"); ?>
                                   <?php while ($Q = mysqli_fetch_array($kls)) : ?>
                                     <option value="<?= $Q['kelas'] ?>"><?= $Q['kelas'] ?></option>
                                        <?php endwhile ?>
                                           </select>  
											
											<p>
											<label class="form-label">MATA PELAJARAN</label>                               
                                  <select name="mapel"  class="form-select" style="width: 100%;" required >
                              <option value=''></option>
                                 <?php $jdw = mysqli_query($koneksi, "SELECT mapel,hari FROM jadwal_mengajar WHERE hari='$hari' GROUP BY mapel"); ?>
                                   <?php while ($mp = mysqli_fetch_array($jdw)) : ?>
								   <?php $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel  WHERE id='$mp[mapel]'")); ?>
                                     <option value="<?= $mp['mapel'] ?>"><?= $mapel['nama_mapel'] ?></option>
                                        <?php endwhile ?>
                                           </select>  
											
											<p>
											<label class="form-label">GURU PENGAMPU</label>                               
                                  <select name="guru"  class="form-select" style="width: 100%;" required >
                              <option value=''></option>
                                 <?php $pg = mysqli_query($koneksi, "SELECT guru,hari FROM jadwal_mengajar WHERE hari='$hari' GROUP BY guru"); ?>
                                   <?php while ($gr = mysqli_fetch_array($pg)) : ?>
                                    <?php $guru = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pegawai  WHERE id_pegawai='$gr[guru]'")); ?>
									<option value="<?= $gr['guru'] ?>"><?= $guru['nama'] ?></option>
                                        <?php endwhile ?>
                                           </select>  
											
											<p>
                                           <div class="d-grid gap-2">
                                             
                                                <button type="submit"  class="btn btn-primary flex-grow-1 m-l-xxs">CETAK HARIAN</button>
                                            </div>
                                        </div>
										</form>
										<p>
                                    </div>
                                </div>
                            </div>
                        </div>                            	
					</div>
				</div>		
		 </div>
		</div>
</div>		
        <?php endif; ?>		 