<?php
defined('APK') or exit('No Access');
?>           
	<?php if ($ac == '') : ?>
                   <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                  
                                   <div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">JURNAL GURU BULAN <?= strtoupper(bulan_indo($tanggal)) ?></h5></a>
										</div>
										</div>
									<div class="card">
                                    <div class="card-body">
									<div class="alert alert-custom" role="alert">
									<strong>Perhatian ! </strong><br>
										<span>Jurnal Guru dapat diisi jika Hari sesuai Jadwal Mengajar</span>
									</div>
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                  <th>NO</th>
                                                  <th>HARI</th>													  
												  <th>KELAS</th>													                                                 
                                                  <th>MAPEL</th>
												  <th>GURU PENGAMPU</th>
												  <th>AGENDA</th>
												  <th>PENCAPAIAN</th>
												   <th>SELESAI</th>
												  <th></th>
                                                </tr>
                                            </thead>											
                                            <tbody>	
											<?php
											$no = 0;
											$hari = date('D');
											$bulan = date('m');
											$tahun = date('Y');
											if($user['level']=='admin'):
											$query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari'");
											 elseif($user['level']=='guru'):
											 $query = mysqli_query($koneksi, "SELECT * FROM jadwal_mengajar where hari='$hari' and guru='$user[id_pegawai]'");
											  endif;
											  while ($data = mysqli_fetch_array($query)) :
											  $harix = fetch($koneksi,'m_hari',['inggris'=>$data['hari']]);
											  $mapelx = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
											  $guru = fetch($koneksi,'pegawai',['id_pegawai'=>$data['guru']]);
											  $kuri = fetch($koneksi,'m_kurikulum',['idk'=>$data['kuri']]);
											  $jumdes = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM agenda where jadwal='$data[id_jadwal]' and bulan='$bulan' and tahun='$tahun'"));
											  $ket = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM agenda where jadwal='$data[id_jadwal]' and bulan='$bulan' and tahun='$tahun' and hadir<'50'"));
											  $ket2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM agenda where jadwal='$data[id_jadwal]' and bulan='$bulan' and tahun='$tahun' and hadir>='50'"));
											  $ket3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM agenda where jadwal='$data[id_jadwal]' and bulan='$bulan' and tahun='$tahun' and hambatan<>''"));
											$no++;
											   ?>
											   <tr>
                                                 <td><?= $no; ?></td>
												 <td><?= $harix['hari'] ?></td>
                                                   <td><h5><span class="badge badge-dark"><?= $data['tingkat'] ?></span> <span class="badge badge-primary"> <?= $data['kelas'] ?></span></h5></td>
													<td><?= $mapelx['kode'] ?> <span class="badge badge-secondary"><?= $kuri['nama_kurikulum'] ?></span></td>
													<td><?= $guru['nama'] ?></td>
													<td><h5><span class="badge badge-success"><?= $jumdes; ?></span></h5></td>
													<td><h5><small>Tidak</small> <span class="badge badge-danger"><?= $ket; ?></span> | <small>Ya</small> <span class="badge badge-success"><?= $ket2; ?></span></h5></td>
													</h5></td>
													<td>				
													<h5><span class="badge badge-success"><?= $ket3 ?></span>
													<?php if($ket3<>0): ?>
													<a href="cetak/ctkjur.php?j=<?= enkripsi($data['id_jadwal']) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Jurnal"><i class="material-icons">print</i> </a>
													
													<?php endif; ?>
													</td>
													<td>
													<?php if($ket<>0): ?>
													<a href="?pg=<?= enkripsi('jurnal') ?>&ac=<?= enkripsi('input') ?>&a=<?= enkripsi($data['id_jadwal']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Jurnal"><i class="material-icons">select_all</i> </a>
													<?php else: ?>
													<button class="btn btn-sm btn-light" disabled ><i class="material-icons">lock</i></button>
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
									</div>
									
				<?php elseif ($ac == enkripsi('input')): ?>
                    	<?php
							   $id = dekripsi($_GET['a']);
							   $jadwal = fetch($koneksi,'jadwal_mengajar',['id_jadwal'=>$id]);
							   $mapel = $jadwal['mapel'];
							   $tingkat = $jadwal['tingkat'];
							   $guru = $jadwal['guru'];
							   $mpl = fetch($koneksi,'mapel',['id'=>$jadwal['mapel']]);
							   $peg = fetch($koneksi,'pegawai',['id_pegawai'=>$guru]);
								?>				 
                      <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="bold">AGENDA & JURNAL GURU <?= $mpl['kode'] ?></h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="8%">#</th>  	
													<th>TANGGAL</th>
													<th>PRESENSI</th>
													<th>MATERI</th>	
													<th>TUJUAN</th>
                                                    <th>HAMBATAN</th>
                                                    <th>PEMECAHAN</th>													
													 <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM agenda where jadwal='$id' and hadir<'50' ORDER BY id DESC"); 
											while ($datax = mysqli_fetch_array($query)) :													  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $datax['tanggal'] ?> </td>
													<td><h5><span class="badge badge-primary"><?= $jadwal['kelas'] ?></span> <span class="badge badge-danger"><?= $datax['hadir'] ?>%</span></h5></td>
													<td><?= $datax['materi'] ?></td>
													<td><?= $datax['tujuan'] ?></td>
													<td><?= $datax['hambatan'] ?></td>
													<td><?= $datax['hambatan'] ?></td>
													  <td>
											<a href="?pg=<?= enkripsi('jurnal') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($datax['id']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Input Jurnal"><i class="material-icons">edit</i> </a>											
											
											</td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								</div>
							
				
                 
             <?php elseif ($ac == enkripsi('edit')): ?>
			
             <?php
			$id = dekripsi($_GET['id']);
			 $agenda = fetch($koneksi,'agenda',['id'=>$id]);
			 $jadwal = fetch($koneksi,'jadwal_mengajar',['id_jadwal'=>$agenda['jadwal']]);
			  $mapel = fetch($koneksi,'mapel',['id'=>$jadwal['mapel']]);
			  $guru = fetch($koneksi,'pegawai',['id_pegawai'=>$jadwal['guru']]);
			 ?>					 
                      <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                       AGENDA & JURNAL GURU <?= $mapel['kode'] ?>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="8%">#</th>  	
													<th width="18%">TANGGAL</th>
													<th>KELAS</th>	
                                                    <th>MATERI</th>													
													 <th>TUJUAN PEMBELAJARAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM agenda where id='$id'"); 
											while ($datax = mysqli_fetch_array($query)) :													  
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= $datax['tanggal'] ?></td>
													<td><h5><span class="badge badge-primary"><?= $jadwal['kelas'] ?><span> </h5></td>
													<td><?= $datax['materi'] ?></td>
													 <td><?= $datax['tujuan'] ?></td>
                                                </tr>
												<?php endwhile; ?>
                                               
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">INPUT JURNAL <span class="badge badge-secondary"><?= $mapel['kode'] ?></span> <span class="badge badge-primary"><?= $agenda['kelas'] ?></span> </h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">AGENDA</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formedit' >	
									 <label class="bold">Tanggal</label>
									  <div class="input-group mb-1">
                                        <input type="text" name="tgl" value="<?= $agenda['tanggal']; ?>" class="form-control" readonly="true" >
										<input type="hidden" name="id" value="<?= $agenda['id']; ?>" class="form-control"  >
										
                                        </div>
										 <label class="bold">Semester</label>
									  <div class="input-group mb-1">
                                        <select name='smt' class='form-select' style='width:100%' required>
                                                <option value="<?= $setting['semester'] ?>">Semester <?= $setting['semester'] ?></option>
                                               
												 </select>
                                        </div>
										 <label class="bold">Guru Pengampu</label>
									  <div class="input-group mb-1">
                                        <select name='guru' class='form-select' style='width:100%' required>
                                           <option value="<?= $jadwal['guru'] ?>"><?= $guru['nama'] ?></option>
                                               
												 </select>
                                        </div>
										<label class="bold">Kelas</label>
									  <div class="input-group mb-1">
                                        <select name='kelas' class='form-select' style='width:100%' required>
                                               <option value="<?= $jadwal['kelas'] ?>"><?= $jadwal['kelas'] ?></option>                                       
												 </select>
                                        </div>
										<label class="bold"><?php if($jadwal['kuri']==1){ ?>Kompetensi Dasar</label><?php } ?><?php if($jadwal['kuri']==2){ ?>Tujuan Pembelajaran</label><?php } ?></label>
									  <div class="input-group mb-1">
                                      <textarea name="materi" class="form-control" rows="2"  readonly="true"><?= $agenda['tujuan'] ?></textarea>							   
									   </div>
										<label class="bold">Materi</label>
									  <div class="input-group mb-1">
                                     <textarea name="materi" class="form-control" rows="2"  readonly="true"><?= $agenda['materi'] ?></textarea>							   
									   </div>
									   <label class="bold">Hambatan</label>
									  <div class="input-group mb-1">
                                     <textarea name="hambatan" class="form-control" rows="5" required="true" ><?= $agenda['hambatan'] ?></textarea>							   
									   </div>
							          <label class="bold">Pemecahan</label>
									  <div class="input-group mb-1">
                                     <textarea name="pemecahan" class="form-control" rows="5" required="true" ><?= $agenda['pemecahan'] ?></textarea>							   
									   </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
                 <script>
						$('#formedit').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'agenda/tagenda.php?pg=jurnal',
									enctype: 'multipart/form-data',
									data: data,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function() {
									$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
									$('.progress-bar').animate({
									width: "30%"
									}, 500);
									},
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi(jurnal) ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
	
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					