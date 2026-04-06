<?php
defined('APK') or exit('No Access');
$skl = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM skl  WHERE id_skl='1'"));
?>
<?php

    if (empty($_GET['k'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['k'];
    }
    if (empty($_GET['m'])) {
        $mapel = "";
    } else {
        $mapel = $_GET['m'];
    }
	if (empty($_GET['j'])) {
        $jurusan = "";
    } else {
        $jurusan = $_GET['j'];
    }
	$lvl = fetch($koneksi,'kelas',['kelas'=>$kelas]);
 $pel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id='$mapel' "));

    ?>
			<div class="row">
			 <div class="col-xl-8">
			  <div class="card">
				<div class="card card-header">
					<h5 class="card-title bold">DATA NILAI UJIAN SEKOLAH <?php if($kelas<>''): ?> | <?= $pel['kode'] ?> | <?= $kelas ?><?php endif; ?></h5>						
						</div>
							<div class="card-body">				 
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-hover" style="width:100%;font-size:12px;">
                                            <thead>
                                                <tr>
                                                   <th width="5%" rowspan="2">NO</th>
													 <th rowspan="2">NAMA</th>
													 <th rowspan="2">KELAS</th>
													<th colspan="2" class="text-center">UJIAN</th>
													 </tr>
													 <tr>
													<th>PRAKTEK</th>
													<th>TEORI</th>									
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM siswa where kelas='$kelas'"); 
											while ($siswa = mysqli_fetch_assoc($query)) :
											$no++;
											 ?>
                                                <tr>
                                                  <td><?= $no; ?></td>
                                                  <td><?= $siswa['nama'] ?></td>                                                 
												  <td><?= $siswa['kelas'] ?></td>
											<?php
											$que = mysqli_query($koneksi, "SELECT * FROM nilai_skl where idsiswa='$siswa[id_siswa]' and mapel='$mapel' and ket='US'"); 
											while ($data = mysqli_fetch_assoc($que)){
											 ?>	  
												 <td><?= $data['nilai'] ?></td>
											<?php } ?>	 
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
				
			<?php if ($ac == '') : ?>
			
			<div class="col-xl-4">
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
                        
						<?php if($kelas<>''): ?>
						<form id="formupload"  class="row g-1">
							 <div class="col-md-12">
						<a href="nilai/proses2.php?m=<?= $mapel ?>&k=<?= $kelas ?>&j=<?= $jurusan ?>" class="btn btn-sm btn-icon btn-link kanan"><i class="material-icons">download</i>FORMAT</a>
						</div>	
                      
                        <input type="hidden" name="kuri" value="<?= $lvl['kuri'] ?>" >	
							
                        <div class="col-md-12">
								<label class="form-label bold">FILE XLSX</label>
                                 <input type='file' name='file' class='form-control' />
						</div>							
						<div class="col-md-12">
						<button type="submit" class="btn btn-primary kanan">IMPORT</button>
						</div>
						</form>
						 <?php endif; ?>
						
						<?php if($kelas==''): ?>
					   
					<div class="col-md-12">
								<label class="form-label bold">KELAS</label>
						<select class="kelas form-select" name="kelas" id="kelas" required style="width: 100%">
							  <option value='' selected>Pilih Kelas</option>
							  <?php
							  if($user['level']=='admin'):
										$kls = mysqli_query($koneksi, "SELECT * FROM kelas WHERE level='$skl[tingkat]'");
								else:
								$kls = mysqli_query($koneksi, "SELECT * FROM kelas WHERE  level='$skl[tingkat]' and kelas='$user[walas]'");
								endif;
										while ($kl = mysqli_fetch_array($kls)) {
										echo "<option value='$kl[kelas]'>$kl[kelas]</option>";
										}
										?>
							</select>
						</div>
						<div class="col-md-12">
								<label class="form-label bold">JURUSAN</label>
						<select class="pk form-select" name="pk" id="pk" required style="width: 100%">
							  
							</select>
						</div>
						<div class="col-md-12">
						<label class="form-label bold">MATA PELAJARAN</label>
							<select class="mapel form-select" name="mapel" id="mapel" required style="width: 100%">
							 
							</select>
						</div>
						<div class="col-md-12">
										<button  id="cari" class="btn btn-primary kanan">Cari Data</button>
										 </div>
									<?php endif; ?>
									  </div>
									</div>
								  </div>
								 </div>
					<script>
					$("#kelas").change(function() {
						var kelas = $(this).val();						
						console.log(kelas);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=pk", 
							data: "kelas=" + kelas, 
							success: function(response) { 
							$("#pk").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#pk").change(function() {
						var pk = $(this).val();	
						var kelas = $('#kelas').val();	
						console.log(pk + kelas);
						$.ajax({
							type: "POST",
							url: "nilai/ambildata.php?pg=mapel", 
							data: "kelas=" + kelas + "&pk=" + pk, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script type="text/javascript">
                                $('#cari').click(function() {
                                    var k = $('.kelas').val();
                                    var m = $('.mapel').val();
									 var j = $('.pk').val();
                                    location.replace("?pg=<?= enkripsi('ujian') ?>&k=" + k + "&m=" + m + "&j=" + j);
                                }); 
                            </script>
		
					<script>
					$('#formupload').submit(function(e){
						e.preventDefault();
						var data = new FormData(this);
						$.ajax(
						{
							type: 'POST',
							 url: 'nilai/import_nilai2.php',
							data: data,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function() {
							$('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
							$('.progress-bar').animate({
							width: "30%"
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
						
		<?php endif; ?>