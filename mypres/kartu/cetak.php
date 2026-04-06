<?php
defined('APK') or exit('No Access');
$mesin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mesin_absen  WHERE id='$setting[mesin]'"));
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa where t_lahir<>''"));
?>
 <?php if ($ac == '') : ?>
  <div class="row">
     <div class="col-md-8">
        <div class="card">
			<div class="card-header">
				<h5 class="card-title">KARTU SISWA</h5>
				<div class="pull-right">
				 <a href="?pg=<?= enkripsi('cetak') ?>&ac=<?= enkripsi('update') ?>" class='btn btn-primary' data-bs-toggle="tooltip" data-bs-placement="top" title="Update Siswa"><i class="material-icons">upload</i>Update</a>
				</div>		
				 </div>
		          <div class="card-body"> 
                 <div class="row">
				   <div class="col-md-12">
				  <form id="formpengaturan" >
				  <input type="hidden" name="id" value="<?= $setting['mesin'] ?>" >
				  <div class="row mb-1">
                     <label  class="col-sm-3 col-form-label bold">Model Kartu</label>
					<div class="col-sm-9">
				    <select name='model' class='form-select' required='true' >
                     <option value="<?= $mesin['model'] ?>"><?= $mesin['model'] ?></option>
                     <option value="Landscape">Landscape</option>					 
                          </select>           
                        </div>
					</div><p>	
				    <div class="row mb-1">
					<label  class="col-sm-3 col-form-label bold">Bg Depan</label>
					<div class="col-sm-4">
					<input type='file' name='depan' class='form-control' />
                      </div>
                        <label  class="col-sm-1 col-form-label"></label>	
						<div class="col-sm-4">
                      <?php if($mesin['depan'] !=''): ?>						
                       <img src="<?= $baseurl ?>/images/kartu/<?= $mesin['depan'] ?>" height='100px' />                      
						<?php endif; ?> 
						 </div>				
					</div><p>
					
					  <div class="row mb-1">
					<label  class="col-sm-3 col-form-label bold">Bg Belakang</label>
					<div class="col-sm-4">
					<input type='file' name='belakang' class='form-control' />
                      </div>
                        <label  class="col-sm-1 col-form-label"></label>	
						<div class="col-sm-4">	
					<?php if($mesin['belakang'] !=''): ?>						
                       <img src="<?= $baseurl ?>/images/kartu/<?= $mesin['belakang'] ?>" height='100px' />   
					<?php endif; ?> 					   
						 </div>				
					</div><p>
					<div class="col-sm-12">		
                          <br><br>
                       <?php if($jsiswa==0): ?>
                        <button  class='btn btn-secondary pull-right' disabled> Simpan</button>
                      <?php else: ?>					   
                      <button type='submit' class='btn btn-primary pull-right' > Simpan</button>
					  <?php endif; ?>
					</div>
					</form>
				   </div>
				</diV>
			</div>
		</div>
	</div>
<script>
   $('#formpengaturan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
            url: 'kartu/tsetting.php',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
            $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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

			
			
			<div class="col-md-4">
       	     <div class="card">
			<div class="card-header">
			<h5 class="card-title">CETAK DEPAN</h5>
						
				 </div>
		<div class="card-body"> 
		          <?php if($mesin['model']=='Potrait'): ?>
                  <form action="kartu/potrait.php" target="_blank" method="POST" class="form-horizontal form-label-left">
                    <?php else: ?>
					<form action="kartu/landscape.php" target="_blank" method="POST" class="form-horizontal form-label-left">
                    <?php endif; ?>	
							<div class="item form-group">
						<label class="bold">Dari ID</label>
							<div class="col-md-12">
							<input type="number" name="id" required="required" class="form-control" value="1">
								</div>
							</div> 
							
							<div class="item form-group">
						<label class="bold">Sampai ID</label>
							<div class="col-md-12">
							<?php if($mesin['model']=='Potrait'): ?>
							<input type="number" name="ids" required="required" class="form-control" value="6">
							<?php else: ?>
							<input type="number" name="ids" required="required" class="form-control" value="8">
							<?php endif; ?>
								</div>
							</div> 
							  <?php if($mesin['model']=='Potrait'): ?>
							<p>Minimal 3 Orang Maximal 6 Orang per lembar</p>
							<?php else: ?>
							<p>Minimal 2 Orang Maximal 8 Orang per lembar</p>
							<?php endif; ?>
							<div class="item form-group">
								<div class="col-md-12">
								<br>
								<?php if($jsiswa==0): ?>
									<button  class='btn btn-secondary pull-right' disabled> <i class="material-icons">print</i> Cetak</button>
									<?php else: ?>			
				                   <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">print</i> Cetak</button>
							    <?php endif; ?>
								</div>
							</div>
							</form>
						 </div>
					  </div>
					 
					 <div class="col-md-12">
       	  <div class="card">
			<div class="card-header">
			<h5 class="card-title">CETAK BELAKANG</h5>
						
				 </div>
		<div class="card-body"> 
                   <?php if($mesin['model']=='Potrait'): ?>
                  <form action="kartu/potrait2.php" target="_blank" method="POST" class="form-horizontal form-label-left">
                    <?php else: ?>
					<form action="kartu/landscape2.php" target="_blank" method="POST" class="form-horizontal form-label-left">
                    <?php endif; ?>	
							<div class="item form-group">
						<label class="bold">Dari ID</label>
							<div class="col-md-12">
							<input type="number" name="id" required="required" class="form-control" value="1">
								</div>
							</div> 
							
							<div class="item form-group">
						<label class="bold">Sampai ID</label>
							<div class="col-md-12">
							<?php if($mesin['model']=='Potrait'): ?>
							<input type="number" name="ids" required="required" class="form-control" value="6">
							<?php else: ?>
							<input type="number" name="ids" required="required" class="form-control" value="8">
							<?php endif; ?>
								</div>
							</div> 
							  <?php if($mesin['model']=='Potrait'): ?>
							<p>Minimal 3 Orang Maximal 6 Orang per lembar</p>
							<?php else: ?>
							<p>Minimal 2 Orang Maximal 8 Orang per lembar</p>
							<?php endif; ?>
							<div class="item form-group">
								<div class="col-md-12">
								<br>
								<?php if($jsiswa==0): ?>
									<button  class='btn btn-secondary pull-right' disabled> <i class="material-icons">print</i> Cetak</button>
									<?php else: ?>	
				                   <button type="submit" class="btn btn-primary pull-right"><i class="material-icons">print</i> Cetak</button>
							    <?php endif; ?>
								</div>
							</div>
							</form>
						 </div>
					  </div>
					 </div>
				</div>
			</div>	
<?php elseif($ac == enkripsi('update')): ?>
 <?php
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE alamat<>''"));
?>   
			<div class="row">
     <div class="col-md-8">  
			 <div class="card">
			<div class="card-header">
				<h5 class="card-title">UPDATE DATA SISWA</h5>
				
					<a href="kartu/proses.php" class="btn btn-sm btn-link pull-right" data-toggle="tooltip" data-placement="top" title="Download Format"><i class="fa fa-download"></i> Download Format</a>
					
								</div>
				                <div class="card-body">  
								<form id='formsiswa' >								 
								    <div class='col-md-12'>
                                      <label>Pilih File</label>
									  <div class="input-group">
                                       <input type='file' name='file' class='form-control' required='true' />
									   <span class="input-group-btn">
											<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Import</button>
										</span>
                                    </div>
								</form>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">storage</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SISWA </span>
                                                <span class="widget-stats-amount"><?= $jsiswa; ?> PD</span>
                                                <span class="widget-stats-info">dari <?= $jsiswa ?> PD</span><p>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
				
			
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'kartu/import_siswa.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			 beforeSend: function() {
             $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
            },
			success: function(data){   		
				
					setTimeout(function()
						{
						window.location.replace('?pg=<?= enkripsi(cetak) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
		<?php endif; ?>
             