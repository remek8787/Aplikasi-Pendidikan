<?php
defined('APK') or exit('No Access');
$jjurnal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa ='$id_siswa' and tanggal='$tanggal'"));

?>      
     
	<?php if ($ac == '') : ?>
		<div class="row">
		 <div class="col-xl-4">
        <div class="card">
		<div class="card-body">
			<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/jurnal.png" class="responsive" alt="thumb" />
                    </div>
					<div class="h5" style="color:blue;">JURNAL PRAKERIN HARI INI</div>
                <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                     
                    </div>
                  </div>
				  <p>Satu Aspek Kompetensi dapat diinput boleh lebih dari 1 kali sesuai proses pelaksanaan</p>
				 
                 <form id="formguru" class="row g-1" >	
                     <input type="hidden" name="ids" value="<?= $id_siswa; ?>" >
                   <input type="hidden" name="kelas" value="<?= $siswa['kelas']; ?>" >					 
						<div class="col-md-12">
						<label class="form-label bold">ASPEK KOMPETENSI</label>
							<select class="form-select" name="kompetensi"  required style="width: 100%">
									<option value="">Pilih Kompetensi</option>
									  <?php
										$kls = mysqli_query($koneksi, "SELECT * FROM pkl_kompetensi WHERE jurusan='$siswa[jurusan]'");
										while ($des = mysqli_fetch_array($kls)) {
										echo "<option value='$des[id]'>$des[deskrip]</option>";
										}
										?>
									</select>
						</div>	
						
						<div class="col-md-12">
								<label class="form-label bold">PROSES PELAKSANAAN</label>
							<textarea name='proses' rows="8" class='form-control' required="true" ></textarea>
						</div>	
					<div class="col-md-12">
							<button type="submit" class="btn btn-primary kanan">Simpan</button>
						</div>	
				  </form>
				
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
					<div class="h5" style="color:blue;">JURNAL PRAKERIN</div>
                <div class="h5 mb-0"><?= $siswa['nama'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
			        <table  class="table table-bordered table-hover" style="width:100%;font-size:12px">
                        <thead>
                        <tr style="vertical-align:middle">
                       <th width="18%">TANGGAL</th>
                       <th>ASPEK KOMPETENSI</th>
                      <th>PROSES</th>
                          </tr>
                         </thead>
                        <tbody>
                          <?php
							$no=0;
							$query = mysqli_query($koneksi, "SELECT * FROM pkl_jurnal where idsiswa='$id_siswa'"); 
							while ($data = mysqli_fetch_assoc($query)) :
							$des = fetch($koneksi,'pkl_kompetensi',['id'=>$data['idkompetensi']]);
							$no++;
							?>
                            <tr style="vertical-align:middle">
                             <td><?= $data['tanggal'] ?></td>
                            <td><?= $des['deskrip'] ?></td>
                              <td><?= $data['proses'] ?></td>            
                              </tr>
							<?php endwhile; ?>
							</tbody>
                          </table>
			        </div>
				</div>
			</div>
	    </div>
               			
 </div>				
	<script>
    $('#formguru').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/tjurnal.php?pg=tambah',
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