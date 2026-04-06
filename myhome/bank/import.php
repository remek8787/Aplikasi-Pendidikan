 <?php
	$idmapel=$_GET['id'];
	$nom = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) AS nomer FROM soal WHERE id_bank='$idmapel' "));
	$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal WHERE id_bank='$idmapel' "));
			?>
<?php if($mapel['model']=='1'): ?>
 <div class="row">
     <div class="col-md-6">
	 
                <div class="card">
            <div class="card-header">
			 <h5 class="card-title">IMPORT EXCEL MODEL 2 (AKM)</h5>
			</div>
		 <div class="card-body">
			  <form id="form-import2" action='' method="POST" enctype="multipart/form-data">
                <div class='form-group'>
                    <label>File xlsx</label>
                    <input type="file" class="form-control" name="file"  placeholder="" aria-describedby="helpfile"  required>
                     <small id="helpfile" class="form-text text-muted">File harus .xlsx</small>
                       </div>
							<input type="hidden" name="idmapel" value="<?= $idmapel ?>" >
                           
                            <input type="hidden" name="nomer" value="<?= $nom['nomer'] ?>" >							
                       
                               <div class="form-group kanan">  
							   <a href="?pg=banksoal&ac=lihat&id=<?= $idmapel ?>" class="btn btn-dark"><i class="material-icons">arrow_back</i></a>		
                                  <a href="bank/FORMAT_SOAL_2.xlsx" class="btn  btn-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Download Format soal"><i class='material-icons' >download</i> Format</a>
								<button type="submit"  class="btn btn-primary" ><i class='material-icons'>upload</i> Upload</button>
                                   </div>
								   </form>
								
                        </div>
                    </div>
                </div>
           <div class="col-md-6">
                <div class="card">
            <div class="card-header">
			 <h5 class="card-title">IMPORT EXCEL MODEL 1 (AKM)</h5>
			</div>
		 <div class="card-body">
			  <form id="form-import" action='' method="POST" enctype="multipart/form-data">
                <div class='form-group'>
                    <label>File xlsx</label>
                    <input type="file" class="form-control" name="file"  placeholder="" aria-describedby="helpfile" style="width:60%" required>
                     <small id="helpfile" class="form-text text-muted">File harus .xls</small>
                       </div>
							<input type="hidden" name="idmapel" value="<?= $idmapel ?>" >
                           
                            <input type="hidden" name="nomer" value="<?= $nom['nomer'] ?>" >							
                       
                               <div class="form-group">  
							   <a href="?pg=banksoal&ac=lihat&id=<?= $idmapel ?>" class="btn  btn-dark"><i class="material-icons">arrow_back</i></a>		
                                  <a href="bank/FORMAT_SOAL_1.xls" class="btn btn-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Download Format soal"><i class='material-icons'>download</i> Format</a>
								<button type="submit"  class="btn btn-primary" ><i class='material-icons'>upload</i> Upload</button>
                                   </div>
								   </form>
                        </div>
                    </div>
                </div>
             
             </div>
       <script>
    
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'bank/timpor.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
			beforeSend: function() {
                $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(data) {
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(banksoal) ?>&ac=lihat&id=<?= $idmapel ?>');
                }, 1500);


            }
        });
    });
   
</script>

	<script>
    
    $('#form-import2').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'bank/timpor2.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
			beforeSend: function() {
                $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 500);
            },
            success: function(data) {

                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(banksoal) ?>&ac=lihat&id=<?= $idmapel ?>');
                }, 2000);


            }
        });
    });
   
</script>
<?php else : ?>
<div class="row">
            
         <div class="col-md-8">
            <div class="card">
            <div class="card-header">
			 <h5 class="card-title">IMPORT WORD (NON AKM) </h5>
		</div>
			<div class="card-body">
                    <form id="formsoalword" action='word/word_import/import/index.php/word_import' method='post' enctype='multipart/form-data'>
                         <div class='kanan'>
                                <button type='submit' name='submit' class='btn btn-primary'><i class='material-icons'>upload</i> Import</button>
                            </div>
                              <br><br>
                                <div class='form-group'>
                                    <label>Mata Pelajaran</label>
                                    <input type='hidden' name='id_bank' class='form-control' value="<?= $mapel['id_bank'] ?>" />
                                    <input type='text' name='mapel' class='form-control' value="<?= $mapel['nama'] ?>" disabled />
                                </div>
								<input type='hidden' name='id_bank_soal' value=<?= $_REQUEST['id'] ?>>
								<input type='hidden' name='id_lokal' value='<?= $homeurl ?>'>
								<input type='hidden' name='cid' value='1'>
								<input type='hidden' name='lid' value='2'>
								<input type='hidden' name='question_split' value='/Q:[0-9]+\)/'>
								<input type='hidden' name='description_split' value='/FileQ:/'>
                                <input type='hidden' name='question_gambar' value='/Gambar:/'>
                                <input type='hidden' name='question_video' value='/Video:/'>
								<input type='hidden' name='question_audio' value='/Audio:/'>
								<input type='hidden' name='option_split' value='/[A-Z]:\)/'>
                                <input type='hidden' name='option_file' value='/FileO:/'>
								<input type='hidden' name='correct_split' value='/Kunci:/'>
                                
                                <div class='form-group'>
                                    <label>Pilih File</label>
                                    <input type='file' name='word_file' class='form-control' required='true' />
                                </div>
                                <p>
                                   Ms. Word (.docx) 
                                </p>
                           
                            <div class='form-group'>
                                <a href='bank/FORMAT_WORD.docx' class="btn btn-sm btn-link"><i class='material-icons'>download</i> Download Format</a>
                            </div>
							</form>
                        </div>
					</div>                   
                </div>
               <div class="col-xl-4 mb-4">
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
                <div class="d-flex justify-content-between mb-2">
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">NPSN</p>
                      <p><?= $setting['npsn'] ?></p>
                    </div>
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">SMT</p>
                      <p><?= $setting['semester'] ?></p>
                    </div>
                    <div class="text-center">
                      <p class="text-small text-muted mb-1">TP</p>
                      <p><?= $setting['tp'] ?></p>
                    </div>                    
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">ALAMAT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">home</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['alamat'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">star</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['desa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">sync</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">CONTACT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                            <i class="material-icons text-info" style="font-size:18px">phone</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nowa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                           <i class="material-icons text-info" style="font-size:18px">inbox</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['email'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">language</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['server'] ?></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">KEPALA SEKOLAH</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                         <i class="material-icons text-info" style="font-size:18px">person</i>
                        </div>
                      </div>
                      <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i class="material-icons text-info" style="font-size:18px">payment</i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nip'] ?></div>
                    </div>
                  </div>
                </div>
              </div>             
            </div>					
			</div>
		
<?php endif; ?>
