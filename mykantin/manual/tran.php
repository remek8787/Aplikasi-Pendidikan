<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			<?php if ($ac == '') : ?>   
					<div class="row">
                          <div class="col-md-6">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PRODUK</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>NAMA PRODUK</th>
													  <th>HARGA</th>
													   <th>STOK</th>
													 <th width="8%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM produk"); 
											  while ($data = mysqli_fetch_array($query)) :
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $data['produk_nama'] ?></td>
                                                     <td><?= number_format($data['produk_harga']) ?></td>
													 <td><?= $data['produk_jumlah'] ?></td>
													 <td>
													<?php  if($data['produk_jumlah']<>0): ?> 
											  <a href="?pg=<?= enkripsi('tran') ?>&id=<?= $data['produk_id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah"><i class="material-icons">shopping_cart</i></button></a>											
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
								
					       <div class="col-md-3">
          
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">INPUT PENJUALAN MANUAL</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $user['nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formjual' >
									<input type="hidden" name="ids" value="1234567890">
									 <label class="bold">NAMA PRODUK</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="idp" required style="width: 100%">
										<?php
										$jur = mysqli_query($koneksi, "SELECT * FROM produk where produk_id='$_GET[id]'");
										while ($pk = mysqli_fetch_array($jur)) {
										echo "<option value='$pk[produk_id]'>$pk[produk_nama]</option>";
										}
										?>
										</select>   
                                        </div>
										<?php
										$produk = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk where produk_id='$_GET[id]'"));
										?> 
										<label class="bold">HARGA</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="harga" class='form-control' value="<?= $produk['produk_harga'] ?>" required='true' autocomplete="off" />									   
                                        </div>
											<label class="bold">JUMLAH</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="jumlah" class='form-control' required='true' autocomplete="off" />									   
                                        </div>
										<div class="widget-payment-request-actions m-t-md d-flex">
                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
							</div>
						</div>
					</div>						
							<div class="col-md-3">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">KERANJANG</h5>
										
                                    </div>
                                    <div class="card-body">
                                         <table class="table" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="3%">JML</th>                                               
                                                    <th>PRODUK</th>
													  <th>TOTAL</th>
													 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM keranjang"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $barang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk where produk_id='$data[idproduk]'"));
											$no++;
											   ?>
                                               <tr>
                                                <td><?= number_format($data['jumlah']) ?></td>
                                                <td><?= $barang['produk_nama'] ?></td>
												<td><?= number_format($data['jumlah'] * $data['harga']) ?></td> 
                                                </tr>
												<?php endwhile; ?>
												<?php
											   $total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total) AS tot FROM keranjang"));
											   ?>
												<tr>
												
												<td colspan="2">SUB TOTAL</td>
												<td><?= number_format($total['tot']) ?></td>
												</tr>
												</tbody>
                                                </table>
												<div class="kanan" id="bayar">
										<button data-id="1"  class="bayar btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar">Bayar </button>
										</div>
												 </div>
											</div>
										</div>
									</div>
						</div>
						</div>
	<script>
    $('#formjual').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'manual/tambah.php',
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
				window.location.replace('?pg=<?= enkripsi(tran) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
			<script>
									$('#bayar').on('click', '.bayar', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'PEMBAYARAN',
											  text: "Klik Ya untuk Membayar",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Bayar',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'manual/tbayar.php',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
													$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
													$('.progress-bar').animate({
													width: "30%"
													}, 500);
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(tran) ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    		 
<?php endif ?>
   
								