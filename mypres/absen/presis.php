<?php
defined('APK') or exit('No Access');
?>      
			
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
								<div class="card card-header">
									<h5 class="card-title">PRESENSI <?= strtoupper(date('d M Y')); ?></h5>
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
												<th></th> 
                                               </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											   $tgl = date('Y-m-d');
												$no=0;
												$query = mysqli_query($koneksi, "SELECT * FROM absensi where tanggal='$tgl' and level='siswa' order by id desc"); 
												while ($data = mysqli_fetch_assoc($query)) :
												$sis = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);			
												$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>                                              
                                                    <td><?= $sis['nama'] ?></td>
                                                    <td><?= $sis['kelas'] ?></td>
													 <td>
													 <?php if($data['ket']=='H'): ?>
													 HADIR
													 <?php elseif($data['ket']=='S'): ?>
													 <strong style="color:blue;">SAKIT</strong>
													 <?php elseif($data['ket']=='I'): ?>
													 <strong style="color:blue;">IZIN</strong>
													 <?php elseif($data['ket']=='A'): ?>
													 <strong style="color:red;">ALPHA</strong>
													 <?php endif; ?>
													 </td>
													 <td>
												  <a href="?pg=<?= enkripsi('presis') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($data['id']) ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
												  </td>
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									<?php if ($ac == '') : ?>
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
									<form id="formabsen" class="row g-2" method="GET" action="cetak/cetakharian.php" target="_blank" enctype="multipart/form-data">
                                        <div class="col-md-12 mb-1">
										<label class="bold">ROMBEL / KELAS</label>                               
									   <select name="kelas" id="kelas" class="form-select" style="width: 100%;" required >
										<option value=''>Pilih Kelas</option>
										<?php $kls = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); ?>
										<?php while ($Q = mysqli_fetch_array($kls)) : ?>
										<option value="<?= $Q['kelas'] ?>"><?= $Q['kelas'] ?></option>
										<?php endwhile ?>
										</select>  
										</div>
										<div class="col-md-12 mb-1">
										<label class="bold">GURU MAPEL</label>                               
									   <select name="idjadwal" id="idjadwal" class="form-select" style="width: 100%;" required >
										
										</select>  
										</div>
                                           <div class="d-grid gap-2">                                             
                                                <button type="submit"  class="btn btn-primary flex-grow-1 m-l-xxs">CETAK HARIAN</button>
                                            </div>
                                    </form>
										<p></p>
									  <div class="mb-4">
												<p class="text-small text-muted mb-2">ALAMAT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">home</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['alamat'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">star</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['desa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">sync</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">CONTACT</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
														<i class="material-icons text-info" style="font-size:18px">phone</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nowa'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													   <i class="material-icons text-info" style="font-size:18px">inbox</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['email'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">language</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['server'] ?></div>
												</div>
											  </div>
											  <div class="mb-4">
												<p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													 <i class="material-icons text-info" style="font-size:18px">person</i>
													</div>
												  </div>
												  <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
												</div>
												<div class="row g-0 mb-2">
												  <div class="col-auto">
													<div class="sw-3 me-1">
													  <i class="material-icons text-info" style="font-size:18px">payment</i>
													</div>
												  </div>
												  <div class="col text-alternate"><?= $setting['nip'] ?></div>
												</div>
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
										url: "absen/ambildata.php?pg=jadwal", 
										data: "kelas=" + kelas, 
										success: function(response) { 
										$("#idjadwal").html(response);
												}
											});
										});
										
									</script>
								<?php elseif($ac == enkripsi('edit')): ?>	
		<?php
			$id = dekripsi($_GET['id']);
		    $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id='$id'"));						
             $peg = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
			  ?>
					 <div class="col-md-4">                     
                                <div class="card">
                                  
                                    <div class="card-body">
                                    <div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/absen.png" class="responsive" alt="thumb" />
										</div>                
									<div class="text-muted"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									<form id='formedit'>	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label class="bold">TANGGAL</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nisn' value="<?= $data['tanggal'] ?>" class='form-control' readonly>
									   
                                        </div>
									<label class="bold">NAMA SISWA</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $peg['nama'] ?>" class='form-control' required='true' />
                                        </div>
										<label class="bold">KELAS</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $peg['kelas'] ?>" class='form-control' required='true' />
                                        </div>
										<label class="bold">KETERANGAN</label>
									  <div class="input-group mb-1">
                                      <select name="ket" class="form-select" required="true">
									   
									   <option value="">Pilih Keterangan</option>
										<option value="H">Hadir</option>
										<option value="S">Sakit</option>
										<option value="I">Izin</option>
										<option value="A">Alpha</option>
									  </select>
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					               </div>
								</div>
								<script>
								$('#formedit').submit(function(e){
									e.preventDefault();
									var data = new FormData(this);
									$.ajax(
									{
										type: 'POST',
										url: 'absen/edit.php?pg=siswa',
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
									
								<?php endif; ?>		 