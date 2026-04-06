<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>


<div class='row'>
        <div class='col-md-8'>
            <div class="card">
             <div class="card-header">
                  <h5 class='box-title'>POINT PELANGGARAN</h5>
				  </div>    
			
				<div class="card-body">
                   <div class='table-responsive'>
                       <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                             
                             <th width='10%'>No</th>								                                 
                              <th>KATEGORI</th>	
                               <th>PELANGGARAN</th>
                               <th width='5%'>POIN</th>								   
						       <th width='20%'></th>
                            </tr>							
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_pelanggaran ORDER BY id DESC");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
                            $sub=fetch($koneksi,'bk_sub',['id'=>$bk['idsub']]);		
                             $kat=fetch($koneksi,'bk_kategori',['id'=>$sub['id_kat']]);									
                                $no++;                             
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
									 <td><h5><span class="badge badge-secondary"><?= $kat['kategori'] ?></span></h5> <?= $sub['sub_kategori'] ?></td>
                                    	
									<td><?= $bk['pelanggaran'] ?></td>
									<td><b><h5><span class="badge badge-primary"><?= $bk['poin'] ?></span></h5></td>
								   <td>		
								    <a href="?pg=<?= enkripsi('pelanggaran') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-success"><i class="material-icons">edit</i></a>
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
                   url: 'crud_bk.php?pg=hapus_pelanggaran',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
					$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
					$('.progress-bar').animate({
					width: "30%"
					}, 500);
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
  <div class='col-md-4'>
             <div class="card widget widget-payment-request">
             <div class="card-header">
                  <h5 class='bold'>INPUT POIN PELANGGARAN</h5>
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
				  <form  id="forminput" class="form-horizontal" enctype='multipart/form-data'>   
                   
												                       						
						     <div class="form-group">
							<label class="bold">Kategori</label>
							<select  class='form-select' name="kategori" id="kategori" required >
							 <option value=""></option>
							   <?php $qtl = mysqli_query($koneksi, "SELECT * FROM bk_kategori"); ?>
                                   <?php while ($bk = mysqli_fetch_array($qtl)) : ?>
                                      <option value="<?= $bk['id'] ?>"><?= $bk['kategori'] ?></option>
                                                <?php endwhile ?>
                                                    </select>   
                                            </div>
						           
									<div class="form-group">
									<label class="bold">Sub Kategori</label>
									  <select  class='form-select' name="sub" id="sub" required >
									  
									   </select>   
                                            </div>
						            
							<div class="form-group">
							<label class="bold">Pelanggaran</label>
								<textarea name="pelanggaran" rows="5" class="form-control" required /></textarea>
							</div>
						          
							<div class="form-group">
							<label class="bold">Poin</label>
								<input type="number" name="poin" maxlength="3" class="form-control" required />
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
              $("#kategori").change(function() {
            var kategori = $(this).val();
            console.log(kategori);
            $.ajax({
                type: "POST",
                url: "crud_bk.php?pg=ambil_sub", 
                data: "kategori=" + kategori, 
                success: function(response) { 
                    $("#sub").html(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
		</script>
		<script>
		$('#forminput').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_bk.php?pg=simpanpel", 
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
			
<?php elseif($ac == enkripsi('edit')): ?>	
<?php 
$id = dekripsi($_GET['id']); 
$bks=fetch($koneksi,'bk_pelanggaran',['id'=>$id]);
?>
 <div class='col-md-4'>
           <div class="card widget widget-payment-request">
             <div class="card-header">
                  <h5 class='bold'>EDIT POIN PELANGGARAN</h5>
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
							<label class="bold">Pelanggaran</label>
								<textarea name="pelanggaran" rows="5" class="form-control" required /><?= $bks['pelanggaran'] ?></textarea>
							</div>
						            
							<div class="form-group">
							<label class="bold">Poin</label>
								<input type="number" name="poin" value="<?= $bks['poin'] ?>"  maxlength="3" class="form-control" required />
							</div>
							<p>
						   <div class='kanan'>
				   		 <button type='submit'  class='btn btn-primary'>Simpan</button>									
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
             url: "crud_bk.php?pg=editpel", 
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
                    window.location.replace('?pg=<?= enkripsi(pelanggaran) ?>');
                }, 2000);

            }
        });
        return false;
    });
</script>



<?php endif; ?>