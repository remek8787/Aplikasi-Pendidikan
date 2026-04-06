<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">DATA PRODUK</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>
													<th>TOKO</th>													
                                                    <th>NAMA PRODUK</th>
													<th>FOTO</th>
													<th>JML</th>
													<th>HARGA</th>
													 <th width="25%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_toko='$user[idtoko]'"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $toko = fetch($koneksi,'toko',['idt'=>$data['produk_toko']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $toko['nama_toko'] ?></td>
													 <td><?= $data['produk_nama'] ?></td>
                                                      <td>
													  <?php if($data['produk_foto1'] !=''): ?>
													  <img src="../gambar/produk/<?= $data['produk_foto1'] ?>" style="width:30px;">
													  <?php else : ?>
													   <img src="../gambar/sistem/produk.png" style="width:30px;">
													  <?php endif; ?>
													  </td>
													   <td><?= $data['produk_jumlah'] ?></td>
													   <td><?= number_format($data['produk_harga']) ?></td>
													 <td>
											 <a href="?pg=produktoko&ac=stok&idp=<?= $data['produk_id'] ?>"> <button class='btn btn-sm btn-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Stok"><i class="material-icons">add</i></button></a>
											  <a href="?pg=produktoko&ac=edit&idp=<?= $data['produk_id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
												<button data-id="<?= $data['produk_id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
												</td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
						<?php if ($ac == '') : ?>
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">INPUT PRODUK</h5>
										
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
									<form id='formproduk' >	
									 <label class="bold">KATEGORI</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="kategori" required style="width: 100%">
										<option value='' selected>Pilih Kategori</option>
										<?php
										$jur = mysqli_query($koneksi, "SELECT * FROM kategori");
										while ($pk = mysqli_fetch_array($jur)) {
										echo "<option value='$pk[kategori_id]'>$pk[kategori_nama]</option>";
										}
										?>
										</select> 
                                        </div>
										<label class="bold">TOKO</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="idtoko" required style="width: 100%">
										
										<?php
										$tk = mysqli_query($koneksi, "SELECT * FROM toko WHERE idt='$user[idtoko]'");
										while ($pk = mysqli_fetch_array($tk)) {
										echo "<option value='$pk[idt]'>$pk[nama_toko]</option>";
										}
										?>
										</select> 
                                        </div>
									<label class="bold">NAMA PRODUK</label>
									  <div class="input-group mb-1">
                                       <input type='text' name="nama" class='form-control' required='true' autocomplete="off" />									   
                                        </div>
											<label class="bold">JUMLAH PRODUK</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="jumlah" class='form-control' required='true' autocomplete="off" />									   
                                        </div>
										<label class="bold">HARGA JUAL</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="harga" class='form-control' required='true' />									   
                                        </div>
										<label class="bold">FOTO PRODUK (Jika Ada)</label>
									  <div class="input-group mb-1">
                                       <input type='file' name="file" class='form-control'  />									   
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
	<script>
    $('#formproduk').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'produk/tproduk.php?pg=tambah',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" ></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
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
					 <?php elseif($ac == 'edit'): ?>	
						 <?php
						 $idp = $_GET['idp'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$idp'"));
						    $kate= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$data[produk_kategori]'"));
						    $toko = fetch($koneksi,'toko',['idt'=>$data['produk_toko']]);
                            ?>
					 <div class="col-md-4">
                      
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">EDIT PRODUK</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
												<?php if($data['produk_foto1']==''): ?>
                                                    <img src="../gambar/sistem/produk.png" alt="">
                                               <?php else : ?>
											    <img src="../gambar/produk/<?= $data['produk_foto1'] ?>" alt="">
												<?php endif; ?>

											   </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $data['produk_nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formedit' >	
									<input type="hidden" class="form-control" name="idp" value="<?= $idp ?>">
									<label class="bold">TOKO</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="idtoko" required style="width: 100%">
										<option value="<?= $data['produk_toko'] ?>" selected><?= $toko['nama_toko'] ?></option>
										
										</select> 
                                        </div>
									   <label class="bold">KATEGORI</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="kategori" required style="width: 100%">
										<option value="<?= $data['produk_kategori'] ?>" selected><?= $kate['kategori_nama'] ?></option>
										<?php
										$jur = mysqli_query($koneksi, "SELECT * FROM kategori");
										while ($pk = mysqli_fetch_array($jur)) {
										echo "<option value='$pk[kategori_id]'>$pk[kategori_nama]</option>";
										}
										?>
										</select> 
                                        </div>
									<label class="bold">NAMA PRODUK</label>
									  <div class="input-group mb-1">
                                       <input type='text' name="nama" class='form-control' value="<?= $data['produk_nama'] ?>" required='true' />									   
                                        </div>
											<label class="bold">JUMLAH PRODUK</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="jumlah" class='form-control' value="<?= $data['produk_jumlah'] ?>" required='true' autocomplete="off" />									   
                                        </div>
										<label class="bold">HARGA JUAL</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="harga" class='form-control' value="<?= $data['produk_harga'] ?>" required='true' />									   
                                        </div>
										<label class="bold">FOTO PRODUK (Jika Ada)</label>
									  <div class="input-group mb-1">
                                       <input type='file' name="file" class='form-control'  />									   
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
             url: 'produk/tproduk.php?pg=edit',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" ></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace('?pg=produktoko');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>			
					<?php elseif($ac == 'stok'): ?>	
						 <?php
						 $idp = $_GET['idp'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$idp'"));
						    $kate= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$data[produk_kategori]'"));
						    $toko = fetch($koneksi,'toko',['idt'=>$data['produk_toko']]);
                            ?>
					 <div class="col-md-4">
                      
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                        <h5 class="card-title">EDIT PRODUK</h5>
										
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
												<?php if($data['produk_foto1']==''): ?>
                                                    <img src="../gambar/sistem/produk.png" alt="">
                                               <?php else : ?>
											    <img src="../gambar/produk/<?= $data['produk_foto1'] ?>" alt="">
												<?php endif; ?>

											   </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= $data['produk_nama'] ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                                </div>
                                            </div>
									<div class="widget-payment-request-info m-t-md">
									<form id='formstok' >	
									<input type="hidden" class="form-control" name="idp" value="<?= $idp ?>">
									 <label class="bold">TOKO</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="idtoko" required style="width: 100%">
										<option value="<?= $data['produk_toko'] ?>" selected><?= $toko['nama_toko'] ?></option>
										
										</select> 
                                        </div>
									   <label class="bold">KATEGORI</label>
									  <div class="input-group mb-1">
                                      <select class="form-select" name="kategori" required style="width: 100%">
										<option value="<?= $data['produk_kategori'] ?>" selected><?= $kate['kategori_nama'] ?></option>
										
										</select> 
                                        </div>
									<label class="bold">NAMA PRODUK</label>
									  <div class="input-group mb-1">
                                       <input type='text' name="nama" class='form-control' value="<?= $data['produk_nama'] ?>" readonly />									   
                                        </div>
											<label class="bold">STOK AWAL</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="jumlah" class='form-control' value="<?= $data['produk_jumlah'] ?>" readonly />									   
                                        </div>
										<label class="bold">TAMBAH STOK</label>
									  <div class="input-group mb-1">
                                       <input type='number' name="tambah" class='form-control'  required='true' autocomplete="off" />									   
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
					</div>
				</div>
			</div>
			<script>
    $('#formstok').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'produk/tproduk.php?pg=stok',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" ></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
								
			success: function(data){   		
			setTimeout(function()
				{
				window.location.replace('?pg=produktoko');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>		
<?php endif ?>
   
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'produk/tproduk.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
													  iziToast.info(
										{
											 title: 'Sukses!',
											message: 'Data berhasil dihapus',
											titleColor: '#FFFF00',
											messageColor: '#fff',
											backgroundColor: 'rgba(0, 0, 0, 0.5)',
											 progressBarColor: '#FFFF00',
											  position: 'topRight'				  
											});
													setTimeout(function() {
														window.location.replace('?pg=produk');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    