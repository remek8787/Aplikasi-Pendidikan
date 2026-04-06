<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
	
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">REGISTRASI KARTU PEGAWAI</h5>										
                                    </div>
                                    <div class="card-body">									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>N I P</th>
                                                    <th>NAMA PEGAWAI</th>
													 <th>JABATAN</th>
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM users WHERE nokartu is NULL and level<>'admin'"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nip'] ?></td>
                                                     <td><?= $data['nama'] ?></td>
													  <td><?= $data['jabatan'] ?></td>
													  <td>
											          <a href="?pg=<?= enkripsi('regpegawai') ?>&ids=<?= $data['id_user'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Registrasi RFID"><i class="material-icons">edit</i></button></a>
											          </td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
									
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                   
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/icon/kantin.ico" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">PAYMENT CARD</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											<?php 
											$ids = $_GET['ids'];
											$siswa = fetch($koneksi,'users',['id_user'=>$ids]);
											?>
											<div class="d-grid gap-2">
										<a href="?pg=<?= enkripsi('pelanggan') ?>" class="btn btn-primary"><i class="material-icons">crisis_alert</i>Cek Data</a>
                                    </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formkartu' >	
									 <label class="bold">N I P</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nis' class='form-control' value="<?= $siswa['nip'] ?>" required="true"/>
									    <input type='hidden' name='ids' class='form-control' value="<?= $siswa['id_user'] ?>"   />
									   
                                        </div>	
										 <label class="bold">NAMA PEGAWAI</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' class='form-control' value="<?= $siswa['nama'] ?>" required="true" />
                                        </div>
										<label class="bold">JABATAN</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='kelas' class='form-control' value="<?= $siswa['jabatan'] ?>" required="true" />
                                        </div>
										<div class="d-grid gap-2">
										<button class="btn btn-dark" type="button" disabled>
											<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
											Loading...
										</button>
										 </div>
										<label class="bold">No Kartu</label>
									  <div class="input-group mb-1" id="norfid">
                                       
                                        </div>
										<p>
										<div class="d-grid gap-2">
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
			</div>		
					<script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#norfid").load('rfid/nokartu.php')
							}, 1000);  
						});
					</script>
					
					   <script>
    $('#formkartu').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'rfid/trfidpeg.php',
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
				window.location.replace('?pg=<?= enkripsi("regpegawai") ?>');
						}, 1000);
									  
						}
					});
				return false;
			});
		</script>		
		     