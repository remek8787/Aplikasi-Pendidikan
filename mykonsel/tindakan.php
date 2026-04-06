<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>


<div class='row'>
        <div class='col-md-8'>
          <div class="card">
             <div class="card card-header">
			  <h5 class='card-title'>SETTING TINDAKAN</h5>
			  </div>    
			 
						<div class="card-body">
                   <div class='table-responsive'>
                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr >                             
                             <th>NO</th>								                                 
                              <th>TINDAKAN</th>	
							  <th width='5%'>MIN</th>
							  <th width='5%'>MAX</th>
								<th>KETENTUAN</th>								  
						       <th width='5%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_tindakan");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {							
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td style="color:blue"><b><?= $bk['tindakan'] ?></b></td>
									<td style="color:red"><b><?= $bk['minpoin'] ?></b></td>
									<td style="color:red"><b><?= $bk['maxpoin'] ?></b></td>
									<td><?= $bk['ketentuan'] ?></td>									
								   <td>	
									<a href="?pg=<?= enkripsi('tindakan') ?>&id=<?= $bk['id'] ?>" class="btn btn-sm btn-success"><i class="material-icons">edit</i></a>								   
									
									</td>
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
				
            </div>
        </div>
    </div>
</div>

		
	<?php
			$id = $_GET['id'];
            $bks = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_tindakan WHERE id='$id'"));

			?>		
	 <div class='col-md-4'>
             <div class="card widget widget-payment-request">
             <div class="card card-header">
                  <h5 class='bold'>PENGATURAN TINDAKAN</h5>
				  </div>
				<div class='card-body'>
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
				 <form id="formedit">  
                    				                       						
						     <div class="form-group">
							<label class="bold">Tindakan</label>
							<div class="col-sm-12">
							  <select name='tindakan' class='form-select' required='true'>
                              <option value="<?= $bks['tindakan'] ?>"><?= $bks['tindakan'] ?></option>
							  
                                              </select> 
                                            </div>
						           
							 <div class="form-group">
							<label class="bold">Ketentuan</label>
							   <textarea name='ketentuan' class='form-control' rows="5" required='true' /><?= $bks['ketentuan'] ?></textarea>
                                            </div>
						   
							 <div class="form-group">
							<label class="bold">Min Poin</label>
							<div class="col-sm-12">
							   <input type="number" name='minpoin' value="<?= $bks['minpoin'] ?>" class='form-control'  required='true' />
                                            </div>
						            </div>
						
							 <div class="form-group">
							<label class="bold">Max Poin</label>
							<div class="col-sm-12">
							   <input type="number" name='maxpoin' value="<?= $bks['maxpoin'] ?>" class='form-control'  required='true' />
                                            </div>
						            </div>
									<p>
							 <div class='kanan'>
				   		 <button type='submit' name="submit"  class='btn btn-primary'>Simpan</button>		
							</div>
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
<script>
		$('#formedit').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_bk.php?pg=edit_tindakan", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
            $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			
            },
            success: function(data) {
             
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(tindakan) ?>');
                }, 2000);

            }
        });
        return false;
    });
</script>	
			