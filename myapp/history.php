<div class="row">
<div class="col-md-12">
   <div class="card">
       <div class="card-header">
          <a href="?pg=<?= enkripsi('kantin') ?>" class="btn btn-secondary btn-sm"> <i class="material-icons">west</i><strong class="card-title"> Back</strong></a>       
		<div class="kanan">
		History
		</div>
		</div>
         <div class="card-body">
		 <table id="tablehistory" style="text-align:center; width:100%">
		 <?php
			$no=0;
			$query = mysqli_query($koneksi, "SELECT * FROM transaksi_kantin WHERE idpeg='$iduser' ORDER BY id DESC LIMIT 10"); 
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
			   <?= date('d-m-Y',strtotime($data['tanggal'])) ?>
			   <br><?= $produk['produk_nama'] ?>			   
			   <br>Rp <?= number_format($data['harga']) ?> x <?= $data['jumlah'] ?> pcs		   
			   <br><b>Rp <?= number_format($data['total_harga']) ?> </b><br>		   
			   <?php if($data['status']==1): ?>
			  <span class="badge badge-danger">Belum Bayar</span>
			  <div class="kanan" >
			  <button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger">
				  <i class="material-icons">delete</i>Batal</button>
			  </div>
			  <?php elseif($data['status']==3): ?>
			  <h5><span class="badge badge-dark">Di Cancel Admin</span></h5>
			  <?php endif; ?>
			   </td>
			</tr>
			<?php endwhile; ?>
			</table>
			
		 </div>
             </div>
                 </div>
                   </div>
				  
				    <script>
									$('#tablehistory').on('click', '.hapus', function() {
									var id = $(this).data('id');
									
											$.ajax({
											   url: 'batal.php',
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