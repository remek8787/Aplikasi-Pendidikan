<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<div class='row'>
 <div class='col-md-3'></div>
       <div class='col-md-6'>
          <div class="card">
			<div class="card-header">
				<h5 class="card-title">WA GATEWAY INFORMASI PEMBAYARAN</h5>				
						</div>
						
				            <div class="card-body">            
						 	<form id="formpengaturan" action='' method='post' class="row g-1" enctype='multipart/form-data'>
							
                             <div class="col-md-6">
								<label class="form-label bold"> Tanggal Informasi</label>
								<input type="text" name="tgl" class="form-control" value="<?= $setting['tgltrx'] ?>" maxlength="2" required="true" >
							     </div>	
		                  <div class="col-md-6">
								<label class="form-label bold"> Jenis Pembayaran</label>
								<?php $byr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_bayar WHERE id='$setting[idbayar]'")); ?>
								<select name="idbayar" class="form-select" style="width:100%" required>
									  <option value="<?= $setting['idbayar'] ?>"><?= $byr['nama'] ?></option>
									    <?php
										$lev = mysqli_query($koneksi, "SELECT * FROM m_bayar");
										while ($bayar = mysqli_fetch_array($lev)) {
										echo "<option value='$bayar[id]'>$bayar[nama]</option>";
										}
										?>
									  </select>
								 </div>	
									<div class="col-md-12">
								<label class="form-label bold"> Jam Kirim Informasi</label>
								<input type="text" name="jamkirim" class="form-control" value="<?= $setting['jamkirim'] ?>"  required="true" >
							     </div>	
						                <div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">Simpan</button>
										 </div>
									           </form>
								            	</div> 
											</div>
										</div>
									</div>
									 
<script>
   $('#formpengaturan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
            url: 'pengaturan/tsetting.php',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
							$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" style="width:50px;"></div>');
							$('.progress-bar').animate({
								width: "30%"
							}, 500);
						},
            success: function(data) {
             
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
   
</script>
