<?php
defined('APK') or exit('No Access');
if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
$jumsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas'"));
?>


<?php if ($ac == '') { ?>
  <div class="row">
  <div class="col-md-8">
      <div class="card">
         <div class="card card-header">
         <h5 class="card-title">CATATAN PROSES <?= $kelas ?></h5>
			
           </div>
             <div class="card-body">
                    <div class='table-responsive'>
                        <table style="font-size: 13px" id='datatable1' class='table table-hover table-bordered edis2'>
                            <thead >
                                <tr>
                                    <th width='3px' class="hidden-xs">No</th>
									    <th> Proyek</th>
                                    <th>Judul Proyek</th>  
									
                               		<th width="5%">Jml Dimensi</th> 
                                    <th>Sdh Dinilai</th>  
									<th>Blm Dinilai</th>  									
									<th width='7%'></th>
										</tr>
									</thead>							
							<tbody>							
                                <?php
								$no = 0;
								
								 $query = mysqli_query($koneksi, "select * FROM m_proyek WHERE kelas='$kelas'");
                            while ($tjn = mysqli_fetch_array($query)) {
							$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM m_proyek WHERE kelas='$tjn[kelas]'"));
                            $dimensi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM proyek WHERE kelas='$tjn[kelas]' AND p_proyek='$tjn[id]'"));
							$isi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proses WHERE kelas='$kelas' AND proyek_ke='$tjn[ke]' GROUP BY idsiswa"));
                           $belum = $jumsiswa - $isi;
							$no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									<td><h5><span class="badge badge-danger"><?= $tjn['ke'] ?></span></h5></td>
									<td ><?= $tjn['judul'] ?></td>
									
									<td><h5><span class="badge badge-dark"><?= $dimensi ?></span></h5></b></td>
									<td><h5><span class="badge badge-primary"><?= $isi; ?></span></h5> siswa</td>
									<td><h5><span class="badge badge-secondary"><?= $belum; ?></span></h5> siswa</td>
                                   <td style="text-align:center">
								   <?php if($dimensi<>5): ?>
								   <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
								   <?php else: ?>
								   
                                      <a href="?pg=<?= enkripsi('catatanproses') ?>&ac=<?= enkripsi('input') ?>&id=<?= enkripsi($tjn['id']) ?>" class='btn btn-success btn-sm' data-bs-placement="top" data-bs-toggle="tooltip" title="Pilih Proyek" ><i class="material-icons">add</i></a>
								   
								   <?php endif; ?>
                                   </td>
								  
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
					</div>
                    </div>
				
					<div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                    <div class="card-header">
                                  
                                    </div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											
									<div class="widget-payment-request-info m-t-md">
									 <div class="d-grid gap-2">
									<button class="btn btn-primary" type="button" disabled>
										<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
										 CATATAN PROSES
									</button>
											</div>
								
                               <div class="col-md-12">
								<label class="form-label bold">Tingkat</label>
								<select name="level" id="level" class='form-select' required='true' style="width: 100%">
								  <option value="">Pilih Tingkat</option>
                                      <?php
										$lev = mysqli_query($koneksi, "SELECT level,kuri FROM kelas WHERE kuri='2' GROUP BY level");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[level]'>$level[level]</option>";
										}
										?>							
									 </select>
							     </div>	
                               <div class="col-md-12">
								<label class="form-label bold">Rombel</label>
								<select name="kelas" id='kelas' class='form-select kelas' required='true' style="width: 100%">
								    			
									 </select>
							     </div>	<p>
									  
								           <div class="d-grid gap-2">
                                           <button id="cari" class="btn btn-primary">SIMPAN</button>
                            <script type="text/javascript">
                                $('#cari').click(function() {
                                    var kelas = $('.kelas').val();
                                   
                                    location.replace("?pg=<?= enkripsi('catatanproses') ?>&kelas=" + kelas);
                                }); 
                            </script>
                                            </div>
									    
										</div>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <script>	
							$("#level").change(function() {
							var level = $(this).val();
							console.log(level);
							$.ajax({
							type: "POST",
							url: "projek/tnilai.php?pg=kelas", 
							data: "level=" + level, 
							success: function(response) { 
							$("#kelas").html(response);
							
									}
								});
							});
							</script>
	<?php } elseif ($ac == enkripsi('input')) { ?>
	
<?php
$id = dekripsi($_GET['id']);
$proyek=fetch($koneksi,'m_proyek',['id'=>$id]);
?>
<div class="row">
  <div class="col-md-8">
      <div class="card">
         <div class="card card-header">
         <h5 class="card-title">CATATAN PROSES <?= $kelas ?></h5>
										
           </div>
             <div class="card-body">
				<form id="formtujuan" class="row g-1" >
				<input type="hidden" name="proyek" value="<?= $id ?>">							
				  <div class="col-md-6">
					<label>Kelas</label>
					<select name='kelas' class='form-select' style="width:100%;" >
                    <option value="<?= $proyek['kelas'] ?>"><?= $proyek['kelas'] ?></option>
                       </select>
                        </div>
                             
				<div class="col-md-6">
					<label>Fase</label>
					<select name='fase' class='form-select' style="width:100%;" >
                    <option value="<?= $proyek['fase'] ?>"><?= $proyek['fase'] ?></option>
                         </select>
                      </div>
                    <div class="col-md-6">
					<label>Judul</label>
						<input type='text' name='judul' value="<?= $proyek['judul'] ?>" class='form-control' style="width:100%;" readonly />
                        </div>
					<div class="col-md-6">
					<label>Deskripsi</label>
					  <input type='text' name='deskripsi' value="<?= $proyek['deskripsi'] ?>" class='form-control' style="width:100%;" readonly />
                         </div>
					<div class="col-md-6">
					<label>Proyek</label>
						<select name='proyek'  class='form-select' required='true' style="width:100%;">
						<option value="<?= $proyek['ke'] ?>"><?= $proyek['ke'] ?></option>
							</select>
                         </div>
					<div class="col-md-6">
					 <label>Nama Siswa</label>
					   <select name='ids'  class='form-select' required='true' style="width:100%;">
							 <option value=''>--Pilih Siswa--</option>
							  <?php $query = mysqli_query($koneksi, "select id_siswa,nama,kelas FROM siswa 
                            WHERE kelas='$proyek[kelas]' AND NOT EXISTS 
							(SELECT * 
							 FROM nilai_proses 
							 WHERE siswa.id_siswa = nilai_proses.idsiswa AND nilai_proses.proyek_ke='$proyek[ke]')"); ?>
                            <?php while ($m = mysqli_fetch_array($query)) : ?>
                            <option value="<?= $m['id_siswa'] ?>"><?= $m['nama'] ?></option>
                            <?php endwhile ?>
                          </select>
                       </div>
						<div class="col-md-12">
					<label>Catatan Proses</label>
					  <textarea name="catatan" class="form-control" rows="4" required='true'></textarea>
                       </div>
						            
					<div class="kanan">							
					   <button type='submit' name='submit' class='btn btn-success kanan'><i class='fa fa-check-circle' ></i> Simpan</button>                                  
					 </div>
					</form>
				</div>
				</div>
			</div>
								         

	<script>
	 $('#formtujuan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'projek/tproyek.php?pg=tambah_catatan',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
            $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);   
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
	</script>
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
						
	<?php } ?>