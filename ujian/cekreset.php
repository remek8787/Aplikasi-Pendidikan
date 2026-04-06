 <div class="row">                   
						<div class="col-md-3"></div>
						<div class="col-md-6">
						 <div class='box box-solid' style="box-shadow: 0 1px 15px 5px rgba(0, 0, 0, 0.25);">
						   <div class='box-header with-border' >
						   </div>
							  <center>
						<div id='progressbox'></div>
							<p>
							 
						<h4 style="color:red">CEK DATA RESET</h4>
						 </center>
						 <hr>
							<div class="box-body">
							<?php 
						$renilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$_GET[idn]'")); 
						$rebank = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$renilai[id_bank]'"));
					    $remap = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE kode='$rebank[nama]'")); 	
						?>
								<form id="formcek">
               
				      <input type="hidden" class="form-control" name="idu"  value="<?= $renilai['id_ujian'] ?>" >
					  <input type="hidden" class="form-control" name="idn"  value="<?= $_GET['idn'] ?>" >
					   <input type="hidden" class="form-control" name="ids"  value="<?= $renilai['id_siswa'] ?>" >
                      <div class="form-group-sm">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" name="nama"  value="<?= $siswa['nama'] ?>" required >
                        </div> 
						 <div class="form-group-sm">
                            <label>Mapel Ujian</label>
                            <input type="text" class="form-control" name="mapel"  value="<?= $remap['nama_mapel'] ?>" required >
                        </div> 
                      
					
					<br>
				
		        <button type="submit" class="btn btn-primary btn-round form-control" id="submit" style="border-radius:20px" >CEK DATA RESET</button>
					
		      </form> 	
									
									
								</div>
							</div>
						  </div> 
						</div>		
						           
						            <script>
										$('#formcek').submit(function(e){
										e.preventDefault();
										var data = new FormData(this);
										$.ajax(
										{
											method: 'POST',
											url: 'cek.php',
											enctype: 'multipart/form-data',
											data: data,
											cache: false,
											contentType: false,
											processData: false,
											success: function(data){   
											 if (data == 'OK') {		
												iziToast.info(
												{
													title: 'Sukses!',
													message: 'Data berhasil direset',
													titleColor: '#FFFF00',
													messageColor: '#fff',
													backgroundColor: 'rgba(0, 0, 0, 0.5)',
													 progressBarColor: '#FFFF00',
													  position: 'topRight'
												});
												setTimeout(function()
												{
													window.location.replace('?pg=jadwal');
												}, 2000);
												 } else {
												 iziToast.warning(
												{
													title: 'Gagal!',
													message: 'Data Belum direset oleh Proktor',
													titleColor: '#FFFF00',
													messageColor: '#fff',
													backgroundColor: '#8b0000',
													 progressBarColor: '#FFFF00',
													  position: 'topRight'
												});
												setTimeout(function(){
													window.location.reload();
												}, 3000);	
											   }			
											}
										});
										return false;
									});
									</script>	