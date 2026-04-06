<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>


<div class='row'>
        <div class='col-md-7'>
           <div class="card">
             <div class="card card-header">
                 <h5 class="card-title">KATEGORI PELANGGARAN</h5>										
				  </div>    
						<div class="card-body">
                   <div class='table-responsive'>
                       <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                             
                             <th width='15%'>NO</th>								                                 
                              <th>KATEGORI</th>												
						       <th width='25%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_kategori ORDER BY id DESC");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {							
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $bk['kategori'] ?></td>									                                    
								   <td>	
									<a href="?pg=<?= enkripsi('kategori') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-success"><i class="material-icons">edit</i></a>								   
									 <button data-id="<?= $bk['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="material-icons">delete</i></button>
									</td>
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
				
            </div>
        </div>
    </div>
</div>
<script>
	 $('#datatable1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
			type:'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                   url: 'crud_bk.php?pg=hapus_kat',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
					
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
	</script>	
<?php if ($ac == ''): ?>
  <div class='col-md-5'>
      <div class="card widget widget-payment-request">
         <div class="card-header">
             <h5 class="bold">INPUT KATEGORI</h5>
				</div>
    <div class="card-body">
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
				 <form  id="forminput" class="form-horizontal" enctype='multipart/form-data'>  
                   					                       						
						     <div class="form-group">
							<label class="bold">Kategori</label>						
							   <input type='text' name='kategori'  class='form-control' autocomplete="off" required='true' />
                              </div>
							  <p>
						          <div class="widget-payment-request-actions m-t-lg d-flex">
								   <button type='submit' name="submit"  class='btn btn-primary flex-grow-1 m-l-xxs'>Simpan</button>							
							 </div>
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
			<script>
		$('#forminput').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_bk.php?pg=tambah_kategori", 
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
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
</script>
			
<?php elseif($ac == enkripsi('edit')): ?>				
	<?php
			$id = dekripsi($_GET['id']);
            $bks = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_kategori WHERE id='$id'"));
			?>
	<div class='col-md-5'>
         <div class="card widget widget-payment-request">
             <div class="card-header">
                  <h5 class='bold'>EDIT KATEGORI</h5>
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
				 <form  id="formedit" class="form-horizontal" enctype='multipart/form-data'>  
                          <input type="hidden" name="id" value="<?= $id ?>" >                						
						     <div class="form-group">
							<label class="bold">Kategori</label>
							   <input type='text' name='kategori' value="<?= $bks['kategori'] ?>" class='form-control' autocomplete="off" required='true' />
                                            </div>
											<p>
						         <div class="widget-payment-request-actions m-t-lg d-flex">
								   <button type='submit' name="submit"  class='btn btn-primary flex-grow-1 m-l-xxs'>Simpan</button>							
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
             url: "crud_bk.php?pg=edit_kategori", 
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
                    window.location.replace('?pg=<?= enkripsi(kategori) ?>');
                }, 2000);

            }
        });
        return false;
    });
</script>			
<?php endif; ?>