<?php 
defined('APK') or exit('No Access');
$jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM lampu"));
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
    padding:1px;
    width: 50%;
    height: 100%;
    display: table-cell; 
}
.tengah{
	text-align:center;
}
</style>

<div class="row">
   <div class="col-md-5">
	   <div class="card">
	     <div class="card-body">
		 <?php if($jml<>0): ?>
             <div class="divTable">
			 
			 <?php
			$query = mysqli_query($koneksi, "SELECT * FROM lampu");
			while ($data = mysqli_fetch_array($query)):
			?>
			
			  <div class="divTableRow" id="data<?= $data['id'] ?>">
			  <?php if($data['status']=='OF'): ?>
				<div class="divTableCell text-center"><button data-id="<?= $data['id'] ?>" class="hidup btn btn-link"><img src="../images/off.png" style="width:90px"></button><p><?= $data['nama'] ?></p></div>
				<?php else : ?>	
					<div class="divTableCell text-center"><button data-id="<?= $data['id'] ?>" class="mati btn btn-link"><img src="../images/on.png" style="width:90px"></button><p><?= $data['nama'] ?></p></div>
				<?php endif; ?>
					<p class="tengah"><?= $data['nama'] ?> </p>
					<hr>
					</div>
								<script>
									$('#data<?= $data[id] ?>').on('click', '.hidup', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'HIDUPKAN LAMPU',
											  text: "Hidupkan <?= $data['nama'] ?>",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hidup',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'tlampu.php?pg=status',
												method: "GET",
												data: 'id=' + id,
												success: function(data) {
											  
												setTimeout(function() {
												window.location.reload();
													}, 100);
												}
											});
										}
										return false;
									})

								});

							</script>  
							<script>
									$('#data<?= $data[id] ?>').on('click', '.mati', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'MATIKAN LAMPU',
											  text: "Matikan <?= $data['nama'] ?>",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Mati',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'tlampu.php?pg=status',
												method: "GET",
												data: 'id=' + id,
												success: function(data) {
											   
												setTimeout(function() {
												window.location.reload();
													}, 100);
												}
											});
										}
										return false;
									})

								});

							</script>    							
			<?php endwhile; ?>		
					
				</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
	<?php if ($ac == '') : ?>
		  <div class="col-md-7">
			   <div class="card">
			   <div class="card card-header">
			     <h5 class="card-title">STATUS LAMPU</h5>
			       </div>
				 <div class="card-body">
				   <div class="card-box table-responsive">
					   <table id="datatable1" class="table table-hover edis2" width="100%">
                         <thead>
                             <tr>
                               <th width="13%">NO</th>                                               
								<th>NAMA LAMPU</th>
                                <th width="20%">STATUS</th>
								<th width="13%"></th> 
								</tr>
                              </thead>
                              <tbody>
							<?php
							$no=0;
							$query = mysqli_query($koneksi, "SELECT * FROM lampu"); 
							while ($data = mysqli_fetch_array($query)) :
							$no++;
							?>
                            <tr style="vertical-align:middle;">
                            <td height="20px"><?= $no; ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td>
							<?php if($data['status']=='OF'): ?>
							<h5><span class="badge badge-danger">OFF</span></h5>
							<?php else : ?>
							<h5><span class="badge badge-success">ON</span></h5>
							<?php endif; ?>
							</td>
							<td>
							<a href="?pg=<?= enkripsi('lampu') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
							</td>
						 </tr>
						<?php endwhile; ?>
						</tbody>
                       </table>
					</div>
				</div>
			</div>
		</div>
	</div>
	     				
	<?php elseif($ac == enkripsi('edit')): ?>	
		<?php
			$id = $_GET['id'];
		    $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM lampu WHERE id='$id'"));						
			  ?>
					 <div class="col-md-7">                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                    <div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/lampu.png" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formedit'>	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label class="bold">NAMA LAMPU</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='nama' value="<?= $data['nama'] ?>" class='form-control' />
									   
                                        </div>	
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
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
             url: 'tlampu.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi("lampu") ?>');
						}, 1000);
									  
						}
					});
				return false;
			});
		</script>			        
			<?php endif ?>