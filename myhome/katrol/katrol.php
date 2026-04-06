<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>

<?php if ($ac == '') : ?>
 
    <div class='row'>
      <div class="col-md-8">
                <div class="card">
				  <div class="card-header">
                   <h5 class="card-title">DATA NILAI</h5> 
                   
                </div>					 
                 <div class="card-body">   
                    <div id="tablenilai" class='table-responsive'>
                       <table id="datatable1" class='table table-hover edis2' style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>                                 
                                    <th>MATA PELAJARAN</th>
                                    <th>KODE</th>
									 <th>SESI</th>
                                    <th>TKT</th>                                									
                                    <th></th>
									
                                </tr>
                            </thead>
                            <tbody>
							
                                <?php $siswaQ = mysqli_query($koneksi, "SELECT * FROM ujian"); ?>
                                <?php while ($data = mysqli_fetch_array($siswaQ)) : ?>
                                    <?php
                                    $no++;
                                    $bank = fetch($koneksi,'banksoal',['id_bank'=>$data['id_bank']]);
									 $mapel = fetch($koneksi,'mapel',['kode'=>$bank['nama']]);
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>                                       
                                        <td><?= $mapel['nama_mapel'] ?></td>
                                        <td><h5><span class="badge badge-secondary"><?= $bank['kode'] ?></span></h5></td> 
										<td><h5><span class="badge badge-success"><?= $data['sesi'] ?></span></h5></td>  										
                                        <td><h5><span class="badge badge-dark"><?= $data['level'] ?></span></h5></td>
									   	<td>
										<a href="?pg=<?= enkripsi('katrol') ?>&k=<?= enkripsi($bank['level']) ?>&m=<?= enkripsi($bank['id_bank']) ?>&g=<?= enkripsi($bank['idguru']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Setting Katrol"><i class="material-icons">edit</i> </a>
										</td>									
                                       
                                    </tr>
                                <?php endwhile; ?>
								
                            </tbody>
                        </table>
					</div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
							 <?php   
								if (empty($_GET['k'])) {
									$kelasmu = "";
								} else {
									$kelasmu = dekripsi($_GET['k']);
								}
								if (empty($_GET['g'])) {
									$gurumu = "";
								} else {
									$gurumu = dekripsi($_GET['g']);
								}
								 if (empty($_GET['m'])) {
									$idbank = "";
								} else {
									$idbank = dekripsi($_GET['m']);
								}
								 $banksoal = fetch($koneksi,'banksoal',['id_bank'=>$idbank]);
									$map = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where kode='$banksoal[nama]' "));
									$peg = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM users where id_user='$gurumu'"));
								?>
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                       <h5 class="bold">SETTING KATROL NILAI</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									
									<form id="formkatrol">
									<label class="bold">Mata Pelajaran</label>
									  <div class="input-group mb-1">
                                        <select name="mapel" class='form-select' style='width:100%' required>
										 <option value="<?= $idbank ?>"><?= $map['nama_mapel'] ?></option> 
                                          </select>                                                    
                                        </div>
										<label class="bold">Guru Pengampu</label>
									  <div class="input-group mb-1">
                                        <select name="guru" class='form-select' style='width:100%' required>			   
												<option value="<?= $gurumu ?>"><?= $peg['nama'] ?></option>
                                          </select>     
                                        </div>
										<label class="bold">Kelas</label>
									  <div class="input-group mb-1">
									   <select  name="kelas" class='form-select' style='width:100%' required>
                                       <?php $level = mysqli_query($koneksi, "select kelas,level from siswa kelas where level='$kelasmu' group by kelas"); ?>
										<option value=''> Pilih Kelas</option>
										<?php while ($kls = mysqli_fetch_array($level)) : ?>
											<option <?php if ($kelas == $kls['kelas']) {
														echo "selected";
													} else {
													} ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
										<?php endwhile; ?>
                                          </select>                
                                        </div>
										
										
										 <label class="bold">Nilai Terendah yg diinginkan </label>
									  <div class="input-group mb-1">
                                       <input type="number" name="rendah" class="form-control" value="70" required="true" >                                                 
                                        </div>
										 <label class="bold">Nilai Tertinggi yg diinginkan </label>
									  <div class="input-group mb-1">
                                       <input type="number" name="tinggi" class="form-control" value="90" required="true" >                                                 
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">
										<?php if($idbank !=''): ?>
                                         <button id="pilih" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                           <?php endif; ?>
											</div>
										
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
					
				 <script>
						$('#formkatrol').submit(function(e) {
								e.preventDefault();
								var data = new FormData(this);
								$.ajax({
									type: 'POST',
									 url: 'katrol/tkatrol.php?pg=katrol',
									enctype: 'multipart/form-data',
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
									success: function(data) {
									   
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi('ckatrol') ?>');
										}, 2000);
									}
								})
								return false;
							});
							</script>
									
       
<?php endif; ?>
