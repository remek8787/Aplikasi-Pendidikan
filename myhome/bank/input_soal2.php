
<?php
if (!isset($_GET['id']) && !isset($_GET['no']) && !isset($_GET['jenis'])) :
	die("Anda tidak dizinkan mengakses langsung script ini!");
endif;
$nomor = $_GET['no'];
$jenis = $_GET['jenis'];
$id_bank = $_GET['id'];

$nom = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) AS nomer FROM soal WHERE id_bank='$id_bank'"));
if($nom['nomer']==''){
$nomor = 1;
}else{
$nomor =$nom['nomer'] + 1;
}
$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$id_bank'"));
$idmap=$mapel['kode'];

$jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' AND  nomor='$nomor' AND jenis='$jenis'"));
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$id_bank' AND  nomor='$nomor' AND jenis='$jenis'");
$soal = mysqli_fetch_array($soalQ);
($soal['jawaban'] == 'A') ? $jwbA = 'checked' : $jwbA = '';
($soal['jawaban'] == 'B') ? $jwbB = 'checked' : $jwbB = '';
($soal['jawaban'] == 'C') ? $jwbC = 'checked' : $jwbC = '';
($soal['jawaban'] == 'D') ? $jwbD = 'checked' : $jwbD = '';
if ($mapel['opsi'] == 5) {
	($soal['jawaban'] == 'E') ? $jwbE = 'checked' : $jwbE = '';
}
?>
<?php include"bank/radio.php"; ?>
 <div class="row"> 
				   <form id='formsoal' action='' method='post' enctype='multipart/form-data'>
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                      <div class='btn-group' style='margin-top:-5px'>
						<label class='btn btn-sm btn-outline-primary'>Mapel </label>
						<label class='btn btn-sm btn-outline-primary'><?= $mapel['nama'] ?> </label>
						<label class='btn btn-sm btn-danger'>No Soal :<b class="sandik"> <?= $nomor ?></b></label>					
					</div>			
                     <button type='submit' name='simpansoal' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-outline-primary kanan' > Simpan</button>
						<a href='?pg=<?= enkripsi('banksoal') ?>&ac=lihat&id=<?= $id_bank ?>' class='btn btn-sm btn-outline-danger kanan'> Kembali</a>
					
						</div>
							</div>
								</div>
									</div>										
 
					<input type='hidden' name='mapel' value='<?= $id_bank ?>'>
					<input type='hidden' name='jenis' value='<?= $jenis ?>'>
					<input type='hidden' name='nomor' value='<?= $nomor ?>'>
					
			<div class='row'>
			<div class="col-md-6">
		      <div class="card">
				<div class="card-header">
						  <h5 class="card-title">
                    SOAL PG MULTI CHOICE
					</h5>
                   
                  </div>
                    <div class="card-body">
					<textarea id='editor2' name='isi_soal' class='editor1' rows='10' cols='80' style='width:100%;' required><?= $soal['soal'] ?></textarea>
							
								<div class="row">
							<div class='col-md-6'>						
								<div class='form-group'>
									<?php
									if ($soal['file'] <> '') {
										$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
										$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
										$ext = explode(".", $soal['file']);
										$ext = end($ext);
										if (in_array($ext, $image)) {
											echo "
										<label>Gambar</label><br />
										<img src='$baseurl/files/$soal[file]' style='max-width:100px;' />
										";
										} elseif (in_array($ext, $audio)) {
											echo "
										<label>Audio</label><br />
										<audio controls>
											<source src='$baseurl/files/$soal[file]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
										";
										} else {
											echo "File tidak didukung!";
										}
										echo "<br /><a href='#'  data-id='$soal[id_soal]'  class='hapus  text-red'><i class='fa fa-times'></i> Hapus</a>";
									} else {
										echo "
										<label>Gambar / Audio</label>
										<input type='file' class='form-control' name='file' type='file'>
										";
									}
									?>
								</div>
							</div>
							<div class='col-md-6'>
								<div class='form-group'>
									<?php
									if ($soal['file1'] <> '') {
										$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
										$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
										$ext = explode(".", $soal['file1']);
										$ext = end($ext);
										if (in_array($ext, $image)) {
											echo "
										<label>Gambar</label><br />
										<img src='$baseurl/files/$soal[file1]' style='max-width:100px;' />
										";
										} elseif (in_array($ext, $audio)) {
											echo "
										<label>Audio</label><br />
										<audio controls>
											<source src='$baseurl/files/$soal[file1]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
										";
										} else {
											echo "File tidak didukung!";
										}
											echo "<br /><a href='#'  data-id='$soal[id_soal]'  class='hapusQ  text-red'><i class='fa fa-times'></i> Hapus</a>";
									} else {
										echo "
										<label>Gambar / Audio</label>
										<input type='file' class='form-control' name='file1' type='file'>
										";
									}
									?>
								</div>
							 </div>
							</div>						
						 </div>	
					</div>	
				</div>	
					
	  
			           <div class="col-md-6">
						 <div class="card">
						 <div class="card-header">
						  <h5 class="card-title">OPSI DAN KUNCI JAWABAN </h5>
						  </div>
                   <div class="card-body">
				   <div class="row mb-1">
					<label  class="col-md-4 col-form-label bold">Skor Tiap Jawaban Benar</label>
						<div class="col-md-4">
							<input type='number' name='skor' value="1" class='form-control' required="true" />
						</div>
					</div>
			       <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                     <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-A-tab" data-bs-toggle="pill" data-bs-target="#pills-A" type="button" role="tab" aria-controls="pills-A" aria-selected="true">A</button>
                        </li>
						
                   <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-B-tab" data-bs-toggle="pill" data-bs-target="#pills-B" type="button" role="tab" aria-controls="pills-B" aria-selected="false">B</button>
                     </li>
					 
                       <li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-C-tab" data-bs-toggle="pill" data-bs-target="#pills-C" type="button" role="tab" aria-controls="pills-C" aria-selected="false">C</button>
                             </li>
							<li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-D-tab" data-bs-toggle="pill" data-bs-target="#pills-D" type="button" role="tab" aria-controls="pills-D" aria-selected="false">D</button>
                             </li>
							<li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-E-tab" data-bs-toggle="pill" data-bs-target="#pills-E" type="button" role="tab" aria-controls="pills-E" aria-selected="false">E</button>
                             </li> 
                            </ul>
				   <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade active show" id="pills-A" role="tabpanel" aria-labelledby="pills-A-tab">
                        <a class="btn btn-sm btn-outline-secondary">JAWABAN A</a> 
						   <label class="checkbox kanan"><input class='hidden radio-label' type='checkbox' name='jawaban[]' value='A' <?= $jwbA ?> /> 
								<span class="check"></span></label>
                                              <p>										
												<div class='form-group'>
													<textarea name='pilA' rows='5' cols='80' class='editor1 pilihan form-control'><?= $soal['pilA'] ?></textarea>
												</div>
												<div class='form-group'>
												<?php
												if ($soal['fileA'] <> '') {
													$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
													$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
													$ext = explode(".", $soal['fileA']);
													$ext = end($ext);
													if (in_array($ext, $image)) {
														echo "
														<label>Gambar A</label><br />
														<img src='$baseurl/files/$soal[fileA]' style='max-width:80px;' />
														";
													} elseif (in_array($ext, $audio)) {
														echo "
														<label>Audio</label><br />
														<audio controls>
															<source src='$baseurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
														";
													} else {
														echo "File tidak didukung!";
													}
													echo "<br /><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=fileA&jenis=$jenis' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
												} else {
													echo "
														<label>Gambar / Audio Pil A</label>
														<input type='file' name='fileA' class='form-control' />
														";
												}
												?>
												
										</div>  
									  </div>
						 
						        
				   <div class="tab-pane fade" id="pills-B" role="tabpanel" aria-labelledby="pills-B-tab">
                     <a class="btn btn-sm btn-outline-secondary">JAWABAN B</a> 
									<label class="checkbox kanan"><input class='hidden radio-label' type='checkbox' name='jawaban[]' value='B' <?= $jwbB ?> /> 
											<span class="check"></span></label>
										<p>
								<div class='form-group'>
													<textarea name='pilB' class='editor1 pilihan form-control'><?= $soal['pilB'] ?></textarea>
												</div>
												<div class='form-group'>
												<?php
												if ($soal['fileB'] <> '') {
													$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
													$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
													$ext = explode(".", $soal['fileB']);
													$ext = end($ext);
													if (in_array($ext, $image)) {
														echo "
														<label>Gambar B</label><br />
														<img src='$baseurl/files/$soal[fileB]' style='max-width:80px;' />
														";
													} elseif (in_array($ext, $audio)) {
														echo "
														<label>Audio</label><br />
														<audio controls>
															<source src='$baseurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
														";
													} else {
														echo "File tidak didukung!";
													}
													echo "<br /><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=fileB&jenis=$jenis' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
												} else {
													echo "
														<label>Gambar / Audio Pil B</label>
														<input type='file' name='fileB' class='form-control' />
														";
												}
												?>
												</div>
											  </div> 
					                        <div class="tab-pane fade" id="pills-C" role="tabpanel" aria-labelledby="pills-C-tab">
                                                <a class="btn btn-sm btn-outline-secondary">JAWABAN C</a> 
								<label class="checkbox kanan"><input class='hidden radio-label' type='checkbox' name='jawaban[]' value='C' <?= $jwbC ?> /> 
											<span class="check"></span></label>
										<p>
											<div class='form-group'>
													<textarea name='pilC' class='editor1 pilihan form-control'><?= $soal['pilC'] ?></textarea>
												</div>
												<div class='form-group'>
												<?php
												if ($soal['fileC'] <> '') {
													$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
													$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
													$ext = explode(".", $soal['fileC']);
													$ext = end($ext);
													if (in_array($ext, $image)) {
														echo "
														<label>Gambar C</label><br />
														<img src='$baseurl/files/$soal[fileC]' style='max-width:80px;' />
														";
													} elseif (in_array($ext, $audio)) {
														echo "
														<label>Audio</label><br />
														<audio controls>
															<source src='$baseurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
														";
													} else {
														echo "File tidak didukung!";
													}
													echo "<br /><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=fileC&jenis=$jenis' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
												} else {
													echo "
														<label>Gambar / Audio Pil C</label>
														<input type='file' name='fileC' class='form-control' />
														";
												}
												?>
												</div>    	
											</div>
									<div class="tab-pane fade" id="pills-D" role="tabpanel" aria-labelledby="pills-D-tab">
								  <a class="btn btn-sm btn-outline-secondary">JAWABAN D</a>   
								<label class="checkbox kanan"><input class='hidden radio-label' type='checkbox' name='jawaban[]' value='D' <?= $jwbD ?> /> 
										<span class="check"></span></label>
										 <p>
										 <div class='form-group'>
													<textarea name='pilD' class='editor1 pilihan form-control'><?= $soal['pilD'] ?></textarea>
												</div>
												<div class='form-group'>
												<?php
												if ($soal['fileD'] <> '') {
													$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
													$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
													$ext = explode(".", $soal['fileD']);
													$ext = end($ext);
													if (in_array($ext, $image)) {
														echo "
														<label>Gambar D</label><br />
														<img src='$baseurl/files/$soal[fileD]' style='max-width:80px;' />
														";
													} elseif (in_array($ext, $audio)) {
														echo "
														<label>Audio</label><br />
														<audio controls>
															<source src='$baseurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
														";
													} else {
														echo "File tidak didukung!";
													}
													echo "<br /><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=fileD&jenis=$jenis' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
												} else {
													echo "
														<label>Gambar / Audio Pil D</label>
														<input type='file' name='fileD' class='form-control' />
														";
												}
												?>
												</div>
				                                   </div>
				   
											   <div class="tab-pane fade" id="pills-E" role="tabpanel" aria-labelledby="pills-E-tab">
											  <a class="btn btn-sm btn-outline-secondary">JAWABAN E</a>   
								<label class="checkbox kanan"><input class='hidden radio-label' type='checkbox' name='jawaban[]' value='E' <?= $jwbD ?> /> 
									<span class="check"></span></label>
										<p>
										 <div class='form-group'>
													<textarea name='pilE' class='editor1 pilihan form-control'><?= $soal['pilE'] ?></textarea>
												</div>
												<div class='form-group'>
												<?php
												if ($soal['fileE'] <> '') {
													$audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
													$image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
													$ext = explode(".", $soal['fileE']);
													$ext = end($ext);
													if (in_array($ext, $image)) {
														echo "
														<label>Gambar D</label><br />
														<img src='$baseurl/files/$soal[fileE]' style='max-width:80px;' />
														";
													} elseif (in_array($ext, $audio)) {
														echo "
														<label>Audio</label><br />
														<audio controls>
															<source src='$baseurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>
														";
													} else {
														echo "File tidak didukung!";
													}
													echo "<br /><a href='?pg=$pg&ac=hapusfile&id=$soal[id_soal]&file=fileE&jenis=$jenis' class='text-red'><i class='fa fa-times'></i> Hapus</a>";
												} else {
													echo "
														<label>Gambar / Audio Pil E</label>
														<input type='file' name='fileE' class='form-control' />
														";
												}
												?>
												</div>
				                             </div>
				                             </div>
				   
				   
                 
						              </form>
						  
						           </div>
								</div>
							</div>
						</div>
					</div>
				</div>	
						

<script>
	tinymce.init({
		selector: '.editor1',
		
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
		],

		toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		paste_data_images: true,

		images_upload_handler: function(blobInfo, success, failure) {
			success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
		},
		image_class_list: [{
			title: 'Responsive',
			value: 'img-responsive'
		}],
	});
</script>
