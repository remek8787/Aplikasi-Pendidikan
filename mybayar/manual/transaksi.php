<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   <?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PEMBAYARAN</h5>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  												
                                                    <th>KODE</th>
													<th>TOTAL RP</th>
                                                    <th>MODEL</th>													 
													 <th>JML X</th>
													 <th>JML BAYAR RP</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM m_bayar"); 
											  while ($data = mysqli_fetch_array($query)) :
											  if($data['model']=='1'){
												  $model='Sekali Bayar';
											  }else{
												  $model = 'Bulanan';
											  }
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['kode'] ?></td>
													<td><?= number_format($data['total']) ?></td>
                                                     <td><?= $model ?></td>
													<td><h5><span class="badge badge-primary"><?= $data['jumlah'] ?> X</span></h5></td>
													<td><h5><span class="badge badge-dark"><?= number_format($data['angsuran']) ?></span></h5></td>
													  
                                                </tr>
												<?php endwhile; ?>
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
									<form id='formkate'>	
									 <label class="bold">Kode</label>
									  <div class="input-group mb-1">
                                      <select  name="idb" id="idb" class='form-select' style='width:100%' required>
                                        <option value="">Pilih Pembayaran</option> 									   
                                          <?php 		    
											   $sql=mysqli_query($koneksi,"SELECT * FROM m_bayar");
											   while ($data=mysqli_fetch_array($sql)) {											  
												echo '<option value="'.$data['id'].'">'.$data['nama'].'</option> ';
											   }
											  ?>
                                          </select>
                                        </div>
										<label class="bold">Model Pembayaran</label>
									  <div class="input-group mb-1">
                                       <select name="model" id="model" class="form-select" style="width:100%" required>
									 
									  </select>
                                        </div>										
										 <label class="bold">Kelas</label>
									  <div class="input-group mb-1">
                                       <select  name="kelas" class='form-select' style='width:100%' required>
                                        <option value="">Pilih Kelas</option> 									   
                                          <?php 		    
											   $sql=mysqli_query($koneksi,"SELECT kelas FROM siswa GROUP BY kelas");
											   while ($data=mysqli_fetch_array($sql)) {											  
												echo '<option value="'.$data['kelas'].'">'.$data['kelas'].'</option> ';
											   }
											  ?>
                                          </select>
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
					
						<script>
					$("#idb").change(function() {
						var idb = $(this).val();					
						console.log(idb);
						$.ajax({
							type: "POST",
							url: "manual/trx.php?pg=model", 
							data: "idb=" + idb, 
							success: function(response) { 
								$("#model").html(response);
								console.log(response);
							},
							error: function(xhr, status, error) {
								console.log(error);
							}
						});
					});
					</script>
						<script>
    $('#formkate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tjenis.php?pg=bayar',
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
				window.location.replace('?pg=<?= enkripsi(transaksi) ?>&ac=<?= enkripsi(input) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
		<?php elseif ($ac == enkripsi('input')): ?>
		<?php
		 $trx = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM k_bayar"));
         $kelas = $trx['kelas'];
		 $idb = $trx['idb'];
         $idsiswa = $_GET['ids'];
         $byr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar  WHERE id='$idb'"));
         $jumlah = $byr['jumlah'];		 
		?>
		<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">INPUT PEMBAYARAN KELAS <?= $kelas; ?></h5>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>  												
                                                    <th>NIS</th>
													<th>NAMA SISWA</th>												 
													 <th>ANGSURAN</th>
													
													 <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$blth = date('mY');
											$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE NOT EXISTS(SELECT idsiswa,blth,ke FROM trx_bayar WHERE siswa.id_siswa=trx_bayar.idsiswa AND trx_bayar.blth='$blth' AND trx_bayar.ke<>'$jumlah') AND kelas='$kelas'");
											while ($data = mysqli_fetch_array($query)) :
											  
											 $no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['nis'] ?></td>
													<td><?= $data['nama'] ?></td>
													<td><h5><span class="badge badge-primary"><?= number_format($byr['angsuran']) ?></span></h5></td>												
													  <td>				
													  <a href="?pg=<?= enkripsi('transaksi') ?>&ac=<?= enkripsi('input') ?>&ids=<?= $data['id_siswa'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Input Pembayaran"><i class="material-icons">edit</i></button></a>											
													</td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
						
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">INPUT PEMBAYARAN</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">E-PEMBAYARAN</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formbayar'>	
									 <label class="bold">Kode</label>
									  <div class="input-group mb-1">
                                      <select  name="idb" id="idb" class='form-select' style='width:100%' required>
                                   									   
                                          <?php 		    
											   $sql=mysqli_query($koneksi,"SELECT * FROM m_bayar where id='$idb'");
											   while ($data=mysqli_fetch_array($sql)) {											  
												echo '<option value="'.$data['id'].'">'.$data['nama'].'</option> ';
											   }
											  ?>
                                          </select>
                                        </div>
										<label class="bold">Jumlah dibayar RP</label>
									  <div class="input-group mb-1">
                                       <input type="text" name="besar" id="duit" class="form-control" value="<?= number_format($byr['angsuran'],0,",",".") ?>" required="true">
                                        </div>									
										 <label class="bold">Nama Siswa</label>
									  <div class="input-group mb-1">
                                       <select  name="idsiswa" class='form-select' style='width:100%' required>
                                        									   
                                          <?php 		    
											   $sql=mysqli_query($koneksi,"SELECT id_siswa,nama FROM siswa WHERE id_siswa='$idsiswa'");
											   while ($data=mysqli_fetch_array($sql)) {											  
												echo '<option value="'.$data['id_siswa'].'">'.$data['nama'].'</option> ';
											   }
											  ?>
                                          </select>
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
	<script>
    $('#formbayar').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'manual/trx.php?pg=bayar',
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
				window.location.replace('?pg=<?= enkripsi(transaksi) ?>&ac=<?= enkripsi(input) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>		
		 <?php endif ?>