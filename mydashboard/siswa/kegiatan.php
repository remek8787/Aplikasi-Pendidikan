<?php
defined('APK') or exit('No Access');
$jkeg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa ='$id_siswa' and tanggal='$tanggal' and kegiatan<>''"));
$dataku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan WHERE idsiswa='$id_siswa' and tanggal='$tanggal'"));
?>      
     
	<?php if ($ac == '') : ?>
		<div class="row">
		 <div class="col-xl-4">
        <div class="card">
		<div class="card-body">
			<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/kegiatan.png" class="responsive" alt="thumb" />
                    </div>
					<div class="h5" style="color:blue;">KEGIATAN PRAKERIN HARI INI</div>
                <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                     
                    </div>
                  </div>
				  <?php if($jkeg==0): ?>
                 <form id='formsiswa' class="row g-1" >	
                     <input type="hidden" name="ids" value="<?= $id_siswa; ?>" >				 
						<div class="col-md-12">
								<label class="form-label bold">NAMA KEGIATAN</label>
							<input type='text' name='kegiatan'  class='form-control' required="true" />
						</div>	
						
						<div class="col-md-12">
								<label class="form-label bold">FOTO KEGIATAN</label>
							<input type='file' name='file'  class='form-control' required="true" />
						</div>	
					<div class="col-md-12">
							<button type="submit" class="btn btn-primary kanan">Simpan</button>
						</div>	
				  </form>
				  <?php else: ?>
				  <?php if($dataku['kegiatan']<>'' and $dataku['status']==0): ?>
				 <center> <div class="spinner-grow text-warning" role="status">
							<span class="visually-hidden">Loading...</span>
							</div> <p>Menunggu Aprove Pembimbing...</p></center>
				  <?php endif; ?>
				  <?php if($dataku['kegiatan']<>'' and $dataku['status']==2): ?>
				  <center><div class="spinner-grow text-danger" role="status">
							<span class="visually-hidden">Loading...</span>
							</div> <p>Ditolak, Silahkan Upload Ulang</p></center>
						<hr>	
					<form id='formsiswa' class="row g-1" >	
                     <input type="hidden" name="ids" value="<?= $id_siswa; ?>" >				 
						<div class="col-md-12">
								<label class="form-label bold">NAMA KEGIATAN</label>
							<input type='text' name='kegiatan'  class='form-control' required="true" />
						</div>	
						
						<div class="col-md-12">
								<label class="form-label bold">FOTO KEGIATAN</label>
							<input type='file' name='file'  class='form-control' required="true" />
						</div>	
					<div class="col-md-12">
							<button type="submit" class="btn btn-primary kanan">Simpan</button>
						</div>	
				  </form>		
							
							
				  <?php endif; ?>
				   <?php if($dataku['kegiatan']<>'' and $dataku['status']==1): ?>
				 <center> <div class="spinner-grow text-success" role="status">
							<span class="visually-hidden">Loading...</span>
							</div> <p>Data diterima</p></center>
				   <?php endif; ?>
				   <?php endif; ?>
                </div>
              </div>             
            </div>				
             <div class="col-xl-8">
               <div class="card edis2">
                 <div class="card-body">
					<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
				 <?php if($siswa['foto']==''): ?>
                    <img src="<?= $baseurl ?>/images/siswa.png" class="responsive" alt="thumb" />
					<?php else: ?>
					 <img src="<?= $baseurl ?>/images/fotosiswa/<?= $siswa['foto'] ?>" class="responsive" alt="thumb" />
					 <?php endif; ?>
                    </div>
					<div class="h5" style="color:blue;">KEGIATAN PRAKERIN</div>
                <div class="h5 mb-0"><?= $siswa['nama'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
			        <table  class="table table-bordered table-hover" style="width:100%;font-size:12px">
                        <thead>
                        <tr style="vertical-align:middle">
                       <th width="30%">TANGGAL</th>
                       <th>KEGIATAN</th>
                      
                          </tr>
                         </thead>
                        <tbody>
                          <?php
							$no=0;
							$query = mysqli_query($koneksi, "SELECT * FROM pkl_kegiatan where idsiswa='$id_siswa' and kegiatan<>''"); 
							while ($data = mysqli_fetch_assoc($query)) :
							$no++;
							?>
                            <tr style="vertical-align:middle">
                             <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['kegiatan'] ?></td>
                                         
                              </tr>
							<?php endwhile; ?>
							</tbody>
                          </table>
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
             url: 'siswa/tkegiatan.php?pg=edit',
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
				window.location.replace("?pg=pkl");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>
 
        <?php endif; ?>		 