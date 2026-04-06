<div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                     <a href="?pg=kantin" class="btn btn-secondary btn-sm"> <i class="material-icons">west</i><strong class="card-title"> Back</strong></a>       
		</div>
         <div class="card-body">
		 <table id="tablekeranjang" style="text-align:center; width:100%">
		 <?php
			$no=0;
			$query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE idsiswa='$id_siswa'"); 
			while ($data = mysqli_fetch_array($query)) :
			$produk=fetch($koneksi,'produk',['produk_id'=>$data['idproduk']]);
			$no++;
			?>
             <tr>
               <td style="text-align:center; vertical-align:center;width:40%">
			 <?php if($produk['produk_foto1'] == ""){ ?>
				<img src="../gambar/sistem/produk.png" class="responsive">
				<?php }else{ ?>
				<img src="../gambar/produk/<?php echo $produk['produk_foto1'] ?>" class="responsive">
				<?php } ?>
			   </td>
			    <td style="text-align:left; vertical-align:center;width:60%">
			   <?= $produk['produk_nama'] ?>
			   <br><b>Rp <?= number_format($produk['produk_harga']*$data['jumlah']) ?>
			   
			   <br>
			    <form id="myForm<?= $data['id'] ?>">
				<input type="hidden" name="id" value="<?= $data['id'] ?>" >
				<div class="input-group">
				
			   <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required="true" >
			  <span class="input-group-btn">
			  <button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger">
				  <span class="material-icons">delete</span>
			  </button>
		  </span>
		  </div>
			   </form>
			   <script>
			 
    $('#myForm<?= $data[id] ?>').change(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'proses.php',
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
						}, 1000);
									  
						}
					});
				return false;
			});
		</script>	
			 
			 
			   </td>
			</tr>
			<?php endwhile; ?>
			</table>
			
			<div class="kanan" id="kanan">
			<?php if($keranjang<>0): ?>
			<hr>
			   <button data-idt="<?= $id_siswa ?>"  class="beli btn btn-success"><i class="material-icons">payments</i> Beli</button>
			  <?php endif; ?>
			  </div>
		 </div>
             </div>
                 </div>
                   </div>
				   </div>
				   <script>
									$('#tablekeranjang').on('click', '.hapus', function() {
									var id = $(this).data('id');
									
											$.ajax({
											   url: 'hapus.php',
												method: "POST",
												data: 'id=' + id,
												
												beforeSend: function() {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												},			
												success: function(data) {
													 
													setTimeout(function() {
														window.location.reload();
													}, 1000);
												}
											});
										
										return false;
									
								});

							</script>  
                                 <script>
									$('#kanan').on('click', '.beli', function() {
									var id = $(this).data('id');
									
											$.ajax({
											   url: 'beli.php',
												method: "POST",
												data: 'id=' + id,
												
												beforeSend: function() {
												$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
												},			
												success: function(data) {
													 
													setTimeout(function() {
														window.location.replace('?pg=history');
													}, 1000);
												}
											});
										
										return false;
									
								});

							</script>    	