<?php
defined('APK') or exit('No Access');
$exec = mysqli_query($koneksi, "truncate tmpbuku");
mysqli_query($koneksi,"UPDATE statustrx SET mode='3'");
$sql = mysqli_query($koneksi, "select * from statustrx");
	$datax = mysqli_fetch_array($sql);
	$mode_perpus = $datax['mode'];
							
	if($mode_perpus==1){
	$sts ="PINJAM";	
	}else if($mode_perpus==2){
	$sts = "KEMBALI";
	}else if($mode_perpus==3){
	$sts = "INPUT BUKU";
	}
?>           
			   
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA BUKU</h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>KATEGORI</th>
                                                    <th>JUDUL BUKU</th>
													  <th>JUMLAH</th>
													  
													 <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM buku"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $kate = fetch($koneksi,'m_buku',['idm'=>$data['idkategori']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $kate['kategori'] ?></td>
                                                     <td><?= $data['judul'] ?></td>
													  <td><?= $data['jumlah'] ?></td>
													  <td>
											
											  <a href="?pg=<?= enkripsi('buku') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>"> <button class='btn btn-sm btn-success' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i></button></a>
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
						<?php if ($ac == '') : ?>
					      <div class="col-md-4">
                                <div class="card">                                
                                <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formkate' >	
									 <label>Kategori Buku</label>
									  <div class="input-group mb-1">
                                      <select name="kate" class="form-select" style="width:100%" required>
									  <option value="">Pilih Kategori</option>
									   <?php $q = mysqli_query($koneksi, "select * from m_buku");
                                while ($data = mysqli_fetch_array($q)) { ?>
                                    <option value="<?= $data['idm'] ?>"><?= $data['kategori'] ?></option>
                                <?php } ?>
									  </select>
									   
                                        </div>	
										 <label>Judul Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='judul' class='form-control' required='true' />
                                        </div>
										
										<label>Pengarang</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='pengarang' class='form-control' required='true' />
                                        </div>
										<label>Penerbit</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='penerbit' class='form-control' required='true' />
                                        </div>
										<label>Jumlah Buku</label>
									  <div class="input-group mb-1">
                                       <input type='number' name='jumlah' class='form-control' required='true' />
                                        </div>
										<label>Scan Barkode Buku</label>
									  <div class="input-group mb-1" id="barcode">
                                       
                                        </div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						
						<script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#barcode").load('master/nokartu.php')
							}, 1000);  
						});
					</script>
						<script>
    $('#formkate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tbuku.php?pg=tambah',
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
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
					
					 <?php elseif($ac == enkripsi('edit')): ?>	
						 <?php
						 $id = $_GET['id'];
						   $data= mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'"));						
                            ?>
					       <div class="col-md-4">
                                <div class="card">                                
                                <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formedit' class="row g-1">	
									   <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
									 <label>Judul Buku</label>
									  <div class="input-group mb-1">
                                       <input type='text' name='judul' value="<?= $data['judul'] ?>" class='form-control' required='true' />
									   
                                        </div>	
										 <label>Jumlah Buku</label>
									  <div class="input-group mb-1">
                                       <input type='number' name='jumlah' value="<?= $data['jumlah'] ?>" class='form-control' required='true' />
                                        </div>
										
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">Simpan</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
						</div>				
					</div>
				
					
					
<?php endif ?>
					
                        
            <script>
    $('#formedit').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'master/tbuku.php?pg=edit',
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
				window.location.replace('?pg=<?= enkripsi(buku) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
                                  
								<script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'master/tbuku.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												success: function(data) {
												$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
												
													setTimeout(function() {
														window.location.replace('?pg=<?= enkripsi(buku) ?>');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    