 <?php
defined('APK') or exit('No Access');
$jtugas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban_refleksi WHERE idsiswa='$siswa[id_siswa]' and tanggal='$tanggal' and idmapel='$_GET[m]'"));

?>   
			 <div class="row">
			 <div class="col-xl-12">				
					<div class="card">
					<div class="card card-header">
					<h5 class="card-title">REFLEKSI SISWA</h5>
										</div>
						<div class="card-body">
						<form id='formsiswa' >
                           <table width="100%">
						   <?php
							$no=0;
							$mapel = $_GET['m'];
							$kelas = $_GET['k'];
							$query = mysqli_query($koneksi, "SELECT * FROM refleksi where idmapel='$mapel' and kelas='$kelas'");
							while ($data = mysqli_fetch_array($query)) :
							$no++;
							?>
						   <tr style="vertical-align:top">
						   <td width="3%"><?= $no; ?>. </td>
						    <td><?= $data['soal'] ?></td>
							 </tr>
							   <tr>
						    <td colspan="2">
							<input type="text" name="jawab[]" class="form-control" required="true">
							<input type="hidden" name="idsiswa[]" value="<?= $siswa['id_siswa'] ?>" class="form-control" required="true">
							<input type="hidden" name="kelas[]" value="<?= $siswa['kelas'] ?>" class="form-control" required="true">
							<input type="hidden" name="idsoal[]" value="<?= $data['id'] ?>" class="form-control" required="true">
							<input type="hidden" name="mapel[]" value="<?= $data['idmapel'] ?>" class="form-control" required="true">
							
							</td>
							 </tr>
						   <?php endwhile; ?>
						   </table>
						   <div class="kanan">
						   <?php if($jtugas==0): ?>
						   <button type="submit" class="btn btn-primary">JAWAB</button>
						   <?php else: ?>
						    <button  class="btn btn-light" disabled>SELESAI</button>
						   <?php endif; ?>
						   </div> 
						   </form>
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
									 url: 'tref.php',
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
                        
             