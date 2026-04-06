<?php 
defined('APK') or exit('No Access');
?>
<style>
.divTable {
    width: 100%;
    display: table;
  
}
.divTableRow {
    width: 100%;
    height: 100%;
    display: table-row;
}
.divTableCell{
    padding:5px;
    width: 50%;
    height: 100%;
    display: table-cell;
  
}


</style>
 <?php if ($ac == '') : ?>   
            <div class="row">
				<div class="col-xl-12">
				<div class="card">
                   <div class="card-body">
				   <div class="divTable">
					  <div class="divTableRow" >
					   <?php
				  $data = mysqli_query($koneksi,"select * from produk,kategori where kategori_id=produk_kategori order by RAND()");
						$no =0;
					while($d = mysqli_fetch_array($data)):
					$toko= fetch($koneksi,'toko',['idt'=>$d['produk_toko']]);
					$jual = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idproduk,SUM(jumlah) AS terjual,status FROM transaksi  WHERE idproduk='$d[produk_id]' AND status='2'"));
					$terjual = $jual['terjual'];
					if($terjual >1000){
						$dijual = round(($terjual/1000),2)."K";
					}elseif($terjual < 1){
						$dijual = 0;
					}else{
					$dijual = $terjual;
					}
					$no++;
				  ?>
					<div class="divTableCell text-center">
					<a href="?pg=kantin&ac=keranjang&idp=<?= $d['produk_id'] ?>">
						<?php if($d['produk_foto1'] == ""){ ?>
						<img src="../gambar/sistem/produk.png" class="responsive">
						<?php }else{ ?>
						<img src="../gambar/produk/<?php echo $d['produk_foto1'] ?>" class="responsive">
						<?php } ?>
						</a>
						<br><?php echo $d['produk_nama'] ?><br>
							<b><?php echo "Rp. ".number_format($d['produk_harga']).",-"; ?> &nbsp;<?php if($d['produk_jumlah'] == 0){?> <font style="color:red;">Habis</font> <?php } ?></b>
							<br>
							 <i class="material-icons" style="color:gold;font-size:16px">star</i>
							 5.0 &nbsp;&nbsp;<?= $dijual; ?> <small>Terjual</small>
							 <br>
							 <small><b><?= $toko['nama_toko'] ?></b></small>
					</div>
					
					  <?php if (($no % 2) == 0) : ?>
					  
               </div>
			     <?php endif; ?>
				  <?php endwhile; ?>
			   </div>
			     </div>
					   </div>
					   </div>
					   
		 <?php elseif($ac == 'keranjang'): ?>
		   <?php $data = mysqli_fetch_array(mysqli_query($koneksi,"select * from produk WHERE produk_id='$_GET[idp]'")); ?>
         <div class="row">
               <div class="col-md-6">
                  <div class="card">
                             
		
         <div class="card-body">
		 <form id="formkeranjang">
		 <input type="hidden" name="idp" class="form-control" value="<?= $_GET['idp'] ?>" required="true" >
		  <input type="hidden" name="ids" class="form-control" value="<?= $id_siswa ?>" required="true" >
		 
             <div class="divTable">
			<div class="divTableRow" >
			 <div class="divTableCell text-center">
		    <?php if($data['produk_foto1'] == ""){ ?>
				<img src="../gambar/sistem/produk.png" class="responsive">
				<?php }else{ ?>
				<img src="../gambar/produk/<?php echo $data['produk_foto1'] ?>" class="responsive">
				<?php } ?>
						<p>
					<small><?php echo $data['produk_nama'] ?></small>
						<br>	
					<b><?php echo "Rp. ".number_format($data['produk_harga']).",-"; ?> &nbsp;<?php if($data['produk_jumlah'] == 0){?> <font style="color:red;">Habis</font> <?php } ?></b>	
				<br><small>Rate</small></br>
                    <i class="material-icons" style="color:gold;font-size:16px;">star</i>											
					<i class="material-icons" style="color:gold;font-size:16px;">star</i>
					<i class="material-icons" style="color:gold;font-size:16px;">star</i>
					<i class="material-icons" style="color:gold;font-size:16px;">star</i>
					<i class="material-icons" style="color:gold;font-size:16px;">star</i>
                 <br> Sisa <?= $data['produk_jumlah'] ?>					
				</div>
            <div class="divTableCell text-center">
			<label>Masukan Jumlah</label>
		    <div class="input-group mb-1">
			
			<input type="hidden" name="harga" class="form-control" value="<?= $data['produk_harga'] ?>"  required="true" >
			</div>
			<div class="input-group">
		  <span class="input-group-btn">
			  <button type="button" class="btn btn-danger btn-sm btn-number" disabled="disabled" data-type="minus" data-field="jumlah">
				  <span class="material-icons">remove</span>
			  </button>
		  </span>
		  <input type="number" name="jumlah" class="form-control input-number" value="1" min="1" max="30">
		  <span class="input-group-btn">
			  <button type="button" class="btn btn-success btn-sm btn-number" data-type="plus" data-field="jumlah">
				  <span class="material-icons">add</span>
			  </button>
		  </span>
	  </div>
			<div class="kanan">
			<?php if($data['produk_jumlah'] == 0){?>
			<button  class="btn  btn-default" disabled><i class="material-icons">shopping_cart</i>Keranjang</button>
			<?php }else{ ?>
				<button type="submit" class="btn  btn-primary"><i class="material-icons">shopping_cart</i>Keranjang</button>
			<?php } ?>
			</div>
			</div>
			</div>
			</div>
          </form>			
		 </div>
             </div>
                 </div>
	<script>
	$('.btn-number').click(function(e){
	e.preventDefault();
	
	fieldName = $(this).attr('data-field');
	type      = $(this).attr('data-type');
	var input = $("input[name='"+fieldName+"']");
	var currentVal = parseInt(input.val());
	if (!isNaN(currentVal)) {
		if(type == 'minus') {
			
			if(currentVal > input.attr('min')) {
				input.val(currentVal - 1).change();
			} 
			if(parseInt(input.val()) == input.attr('min')) {
				$(this).attr('disabled', true);
			}
		} else if(type == 'plus') {
			if(currentVal < input.attr('max')) {
				input.val(currentVal + 1).change();
			}
			if(parseInt(input.val()) == input.attr('max')) {
				$(this).attr('disabled', true);
			}
		}
	} else {
		input.val(0);
	}
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
	
	minValue =  parseInt($(this).attr('min'));
	maxValue =  parseInt($(this).attr('max'));
	valueCurrent = parseInt($(this).val());
	
	name = $(this).attr('name');
	if(valueCurrent >= minValue) {
		$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
	} else {
		alert('Sorry, the minimum value was reached');
		$(this).val($(this).data('oldValue'));
	}
	if(valueCurrent <= maxValue) {
		$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
	} else {
		alert('Sorry, the maximum value was reached');
		$(this).val($(this).data('oldValue'));
	}
	
	
});
$(".input-number").keydown(function (e) {
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||		
			(e.keyCode == 65 && e.ctrlKey === true) || 
			(e.keyCode >= 35 && e.keyCode <= 39)) {
				 return;
		}
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});</script>
				 <script>
    $('#formkeranjang').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'tambah.php',
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
				window.location.replace('?pg=kantin&ac=mykeranjang');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
				 <div class="col-md-6">
                  <div class="card">
                     <div class="card-header">
                     Rekomendasi Untukmu      
		</div>
         <div class="card-body">
		 <div class="divTable">
					  <div class="divTableRow" >
					   <?php
				  $data = mysqli_query($koneksi,"select * from produk,kategori where kategori_id=produk_kategori order by RAND()");
						$no =0;
					while($d = mysqli_fetch_array($data)):
					$toko= fetch($koneksi,'toko',['idt'=>$d['produk_toko']]);
					$jual = mysqli_fetch_array(mysqli_query($koneksi, "SELECT idproduk,SUM(jumlah) AS terjual,status FROM transaksi  WHERE idproduk='$d[produk_id]' AND status='2'"));
					$terjual = $jual['terjual'];
					if($terjual >1000){
						$dijual = round(($terjual/1000),2)."K";
					}elseif($terjual < 1){
						$dijual = 0;
					}else{
					$dijual = $terjual;
					}
					$no++;
				  ?>
					<div class="divTableCell text-center">
					<a href="?pg=kantin&ac=keranjang&idp=<?= $d['produk_id'] ?>">
						<?php if($d['produk_foto1'] == ""){ ?>
						<img src="../gambar/sistem/produk.png" class="responsive">
						<?php }else{ ?>
						<img src="../gambar/produk/<?php echo $d['produk_foto1'] ?>" class="responsive">
						<?php } ?>
						</a>
						<br><?php echo $d['produk_nama'] ?><br>
							<b><?php echo "Rp. ".number_format($d['produk_harga']).",-"; ?> &nbsp;<?php if($d['produk_jumlah'] == 0){?> <font style="color:red;">Habis</font> <?php } ?></b>
							<br>
							 <i class="material-icons" style="color:gold;font-size:16px">star</i>
							 5.0 &nbsp;&nbsp;<?= $dijual; ?> <small>Terjual</small>
							 <br>
							 <small><b><?= $toko['nama_toko'] ?></b></small>
					</div>
					
					  <?php if (($no % 2) == 0) : ?>
					  
               </div>
			     <?php endif; ?>
				  <?php endwhile; ?>
			   </div>
		 </div>
             </div>
                 </div>
                   </div>
				   </div>
<?php elseif($ac == 'mykeranjang'): ?>	
<div class="row">
<div class="col-md-12">
   <div class="card">
    
         <div class="card-body"  id="tablekeranjang">
		   <form id="myForm">
		 <?php
			$no=0;
			$query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE idsiswa='$id_siswa'"); 
			while ($data = mysqli_fetch_array($query)) :
			$produk=fetch($koneksi,'produk',['produk_id'=>$data['idproduk']]);
			$toko= fetch($koneksi,'toko',['idt'=>$produk['produk_toko']]);
			$no++;
			?>
			
			<div class="divTable">
			<div class="divTableRow" >
             <div class="divTableCell text-center">
			 <?php if($produk['produk_foto1'] == ""){ ?>
				<img src="../gambar/sistem/produk.png" class="responsive">
				<br>
				<i class="material-icons" style="color:gold;font-size:16px">star</i>
				 5.0 &nbsp;&nbsp;<?= $dijual; ?> <small>Terjual</small>
				<br>
				<small><b><?= $toko['nama_toko'] ?></b></small>
				<?php }else{ ?>
				<img src="../gambar/produk/<?php echo $produk['produk_foto1'] ?>" class="responsive">
				<br>
				<i class="material-icons" style="color:gold;font-size:16px">star</i>
				5.0 &nbsp;&nbsp;<?= $dijual; ?> <small>Terjual</small>
				<br>
				<small><b><?= $toko['nama_toko'] ?></b></small>
				<?php } ?>
			   </div>
			   <div class="divTableCell">
			   <?= $produk['produk_nama'] ?>
			   <br><b>Rp <?= number_format($produk['produk_harga']*$data['jumlah']) ?>
			   
			   <br>
			 
			 <input type="hidden" name="id[]" value="<?= $data['id'] ?>" >
				<div class="input-group">	
			   <input type="number" name="jumlah[]" id="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required="true" >			  
			 <span class="input-group-btn">
			  <button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger">
				  <span class="material-icons">delete</span>
			  </button>
		  </span>
		  </div>
		 
			 </div>
				 </div>
				 </div>
			<?php endwhile; ?>
			
			<div class="kanan" id="kanan">
			<?php if($keranjang<>0): ?>
			<a href="?pg=kantin" class="btn btn-secondary"> <i class="material-icons">west</i><strong class="card-title"> Back</strong></a>       
		
			   <button data-idt="<?= $id_siswa ?>"  class="beli btn btn-success"><i class="material-icons">payments</i> Beli</button>
			  <?php endif; ?>
			  </div>
		 </div>
             </div>
			  </form>
			  </div>
                   </div>
				   </div>
			    <script>
    $("#myForm").change(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'myapp/proses.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			
			}, 500);
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
	
                
				
           
				   
							   <script>
									$('#tablekeranjang').on('click', '.hapus', function() {
										var id = $(this).data('id');
												
								         $.ajax({
											   url: 'hapus.php',
												method: "POST",
												data: 'id=' + id,
												
												beforeSend: function() {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
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
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
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
		 
  <?php endif; ?>		   			   