<?php
defined('APK') or exit('No accsess');
?>           
<div class="row">
  <div class="col-xl-8" >
       <div class="card" >
	   <div class="card card-header" >
         <h5 class="card-title">MATA PELAJARAN</h5>
				</div>			
    <div class="card-body">
		<div class="card-box table-responsive">
           <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px;">
               <thead>
                <tr style="vertical-align:middle">
                  <th>NO</th>                                               
                  <th>KODE</th>
                  <th>MATA PELAJARAN</th>
				  <th>#</th>
					</tr>
				</thead>
                  <tbody>
					<?php
					$no=0;
					$query = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY id DESC"); 
					while ($data = mysqli_fetch_assoc($query)) :
					$no++;
					?>
                  <tr style="vertical-align:middle">
                    <td><?= $no; ?></td>
                    <td><?= $data['kode'] ?></td>
                    <td><?= $data['nama_mapel'] ?></td>
					<td>
					<button data-id="<?= $data['id'] ?>"  class="hapus btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="material-icons">delete</i> </button>
					</td>
				</tr>
				<?php endwhile; ?>
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
						title: 'Hapus Data',
						text: "Hapus Data Mapel",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya, Hapus!',
						cancelButtonText: "Batal"				  
					}).then((result) => {
						if (result.value) {
						$.ajax({
						url: 'mapel/hapus.php',
						method: "POST",
						data: 'id=' + id,
						success: function(data) {
						$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
						$('.progress-bar').animate({
						
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

   		
		<div class="col-xl-4">
            <div class="card widget widget-payment-request">
                <div class="card-header">
					 <h5 class="card-title">INPUT MAPEL</h5>
                    </div>
                <div class="card-body">
                    <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                    <div class="avatar m-r-sm">
                        <img src="../images/buku.png" alt="">
                            </div>
                       <div class="widget-payment-request-author-info">
					   <p></p>
                          <span class="widget-payment-request-author-name bold"><?= $setting['sekolah'] ?></span>
                          <span class="widget-payment-request-author-about">HIGH SCHOOL</span>
						  
                            </div>
                              </div>
							  
					 <form id='formtambah'>			  
					<div class="widget-payment-request-info m-t-md">                     
						<label class="bold">Kode Mapel</label>
						<div class="input-group mb-1">
							<input type='text' name='kode' class='form-control' required='true' autocomplete="off" />
                              </div>
						<label class="bold">Nama Mapel</label>
						<div class="input-group mb-1">
							<input type='text' name='nama' class='form-control' required='true' autocomplete="off" />
                              </div>  
                           </div> 
                   <div class="kanan">
                       <button type="submit" class="btn btn-primary">Simpan</button>
								</div>
						  </form>
                        </div>
                    </div>
                </div>
           
			<div class="card widget widget-payment-request">
                <div class="card-header">
					 <h5 class="card-title">IMPOR MAPEL</h5>
                    </div>
                <div class="card-body">
                    <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                    <div class="avatar m-r-sm">
                        <img src="../images/buku.png" alt="">
                            </div>
                       <div class="widget-payment-request-author-info">
					   <p></p>
                          <span class="widget-payment-request-author-name bold"><?= $setting['sekolah'] ?></span>
                          <span class="widget-payment-request-author-about">HIGH SCHOOL</span>
                            </div>
                              </div>
						 
					<div class="widget-payment-request-info m-t-md"> 						      
				<form id='formmapel' >	
					<label class="bold">Pilih File</label>
					<a href="mapel/M_MAPEL.xlsx" class="btn btn-link kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Format"> <i class="material-icons">download</i> Format</a>	   				            
					<div class="input-group mb-2">
                   <input type='file' name='file' class='form-control' required='true' />
						<span class="input-group-text">
							<button type="submit" class="btn btn-sm btn-primary"><i class="material-icons">upload</i></button>
							</span>
                              </div>	
					       </form>
                           </div> 
                 
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <script>
    $('#formtambah').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
            url: 'mapel/tambah_mapel.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
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
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	                    
                   		
<script>
    $('#formmapel').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
            url: 'mapel/import_mapel.php',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
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
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	

	