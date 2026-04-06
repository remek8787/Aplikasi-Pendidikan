<?php defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!'); ?>
<?php if ($ac == '') { ?>
	
    <div class='row'>
        <div class='col-md-8'>
            <div class="card">
             <div class="card card-header">	
			 <h5 class='card-title'>TUGAS BELAJAR</h5>
               <div class='pull-right '>
					 <a href="?pg=<?= enkripsi('inputtugas') ?>" class='btn btn-primary kanan'><i class="material-icons">add</i>Tugas</a>				
                    </div>				
                </div>					
				 <div class="card-body">	
                    <div id='tablemateri' class='table-responsive'>
                       <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>MAPEL</th>
                                    <th>TANGGAL</th>
                                    <th>KELAS</th>
                                    <th>FILE</th>									
                                    <th></th>
									
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($user['level'] == 'guru') {
                                    $tugasQ = mysqli_query($koneksi, "SELECT * FROM tugas where guru='$_SESSION[id_user]'");
                                } else {
                                    $tugasQ = mysqli_query($koneksi, "SELECT * FROM tugas ");
                                }
                                ?>
                                <?php while ($tugas = mysqli_fetch_array($tugasQ)) : ?>
                                    <?php
                                    $guru = mysqli_fetch_array(mysqli_query($koneksi, "select * FROM users where id_user='$tugas[guru]'"));
                                    $mpl = mysqli_fetch_array(mysqli_query($koneksi, "select * FROM mapel where id='$tugas[mapel]'"));

									$no++
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $mpl['kode'] ?></td>
										<td><?= $tugas['tgl_mulai'] ?><br><?= $tugas['tgl_selesai'] ?></td>
                                        <td>
                                            <?php $kelas = unserialize($tugas['kelas']);
                                            foreach ($kelas as $kelas) {
                                                echo $kelas . " ";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                           <?php if ($tugas['file'] <> null) { ?>
                                                <a href="../tugas/<?= $tugas['file'] ?>" target="_blank">Lihat</a>
                                            <?php } ?>
                                        </td>										 
                                        <td style="text-align:center">                                         
                                          <a href='?pg=<?= enkripsi('tugas') ?>&ac=<?= enkripsi('jawaban') ?>&id=<?= $tugas['id_tugas'] ?>' class='btn btn-sm btn-success'><i class='material-icons'>check</i> Nilai</a>
                                          <a href='?pg=<?= enkripsi('tugas') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $tugas['id_tugas'] ?>' class='btn btn-sm btn-primary'><i class='material-icons'>edit</i></a>
                                          <button data-id='<?= $tugas['id_tugas'] ?>' class="hapus btn btn-danger btn-sm"><i class="material-icons">delete</i></button>                                          
                                        </td>
									     </tr>
                                    <?php endwhile ?>
                                 </tbody>
                          </table>
                        </div>               
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
			
   <?php } elseif ($ac == enkripsi('edit')) { ?>
    <?php $id = $_GET['id']; ?>
	<?php
	$tugas = fetch($koneksi,'tugas',['id_tugas'=>$id]);
	$mpl = fetch($koneksi,'mapel',['id'=>$tugas['mapel']]);
	 $peg=fetch($koneksi,'users',['id_user' => $tugas['guru']]);
	?>
    <div class='row'>
        <div class="col-md-8">
		<div class="card">
             <div class="card card-header">									
                  <h5 class="card-title">EDIT TUGAS BELAJAR</h5>
					</div>
                      <div class="card-body">
					 <form id="formedit" class="row g-2">
						 <input type="hidden" value="<?= $tugas['id_tugas'] ?>" name='id'>
						   <div class="col-md-6">        
						<label  class="bold">Mata Pelajaran</label>
							<select name='mapel' class='form-select' style='width:100%' required>
                               <option value="<?= $tugas['mapel'] ?>"><?= $mpl['nama_mapel'] ?></option>
							   <option value=''>Pilih Mata Pelajaran</option>
                                <?php $que = mysqli_query($koneksi, "SELECT * FROM mapel"); ?>
                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>
								<option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>
						 <div class="col-md-6">        
						<label  class="bold">Guru Pengampu</label>
							<select name='guru' class='form-select' style='width:100%' required>
                                <option value="<?= $tugas['guru'] ?>"><?= $peg['nama'] ?></option>
							   <option value=''>Pilih Guru</option>
                                <?php 
								if($user['level']=='admin'):
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE level='guru'"); 
								else :
								$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id_user'"); 
								endif;
								while ($guru = mysqli_fetch_array($query)) : 
								?>
								<option value="<?= $guru['id_user'] ?>"><?= $guru['nama'] ?></option>
								<?php endwhile ?>
                            </select>
                        </div>
						<div class="col-md-12">  
							<label  class="bold">Judul Tugas</label>
							   <input type="text" class="form-control" name="judul" value="<?= $tugas['judul'] ?>"  required>
                           </div>
                                       
						<div class="col-md-12"> 				
							<label  class="bold">Tugas Belajar</label> 
						       <textarea name='isitugas' class='editor1' rows='5' cols='80' style='width:100%;'><?= $tugas['tugas'] ?></textarea>
                            </div>
                         <div class="col-md-6">           
							<label  class="bold">Kelas</label> 
						       <select name='kelas[]'  class='form-control form-control select2' multiple='multiple' style='width:100%' required='true'>
                                <?php $lev = mysqli_query($koneksi, "SELECT kelas FROM siswa group by kelas"); ?>
                                <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                <?php if (in_array($kelas['kelas'], unserialize($tugas['kelas']))) : ?>
                                <option value="<?= $kelas['kelas'] ?>" selected><?= $kelas['kelas'] ?></option>
                                <?php else : ?>
                                <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>
                                <?php endif; ?>
                                <?php endwhile ?>
                            </select>
                        </div>
						 <div class="col-md-6">   
							<label  class="bold">Mulai</label>
						    <input type='text' name='tgl_mulai' class='tgl form-control' value="<?= $tugas['tgl_mulai'] ?>" autocomplete='off' required='true' />
                         </div>
						 <div class="col-md-6"> 
							<label  class="bold">Selesai</label>
							    <input type='text' name='tgl_selesai' class='tgl form-control' value="<?= $tugas['tgl_selesai'] ?>" autocomplete='off' required='true' />
                        </div>
                        <div class="col-md-6">
						  <label class="bold">File (Jika ada)</label> 
						    <input type="file" class="form-control" name="file" >
						</div>		
						
                       <div class='modal-footer'>
                       <div class='kanan'>
                          <button type='submit'  class='btn btn-primary'>Simpan</button>
                        </div>                     
                     </div>
					</form>
                  </div>
                </div>
            </div>
			     
 		     	   

        <script>
        $('#formedit').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
        type: 'POST',
        url: 'tugas/edit_tugas.php',
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
			window.location.replace('?pg=<?= enkripsi("tugas") ?>');
					}, 2000);

				}
			});
			return false;
			});
 
      </script>
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
	   
	            
<?php } elseif ($ac == enkripsi('jawaban')) { ?>
    <?php $id = $_GET['id']; ?>
    <div class='row'>
        <div class='col-md-8'>
            <div class="card">
             <div class="card-header">	
			 <h5 class='box-title'>TUGAS BELAJAR</h5>
					 <div class='pull-right '>
                        <button class='btn btn-primary' onclick="frames['frameresult'].print()"><i class='material-icons'>print</i>Nilai</button>
                  <a href="?pg=<?= enkripsi('tugas') ?>" class='btn btn-outline-danger' >Back</a>
				  </div>
                    </div>
               
                <div class='card-body' id="tablejawaban">
				 <div class='table-responsive'>
                   <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>File</th>
                                <th>Nilai</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $jawabx = mysqli_query($koneksi, "select * from jawaban_tugas where id_tugas='$id'");
                            $no = 0;
                            while ($jawab = mysqli_fetch_array($jawabx)) {
                                $no++;
                                $siswa = fetch($koneksi, 'siswa', ['id_siswa' => $jawab['id_siswa']]);
								$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban_tugas WHERE id_siswa='$jawab[id_siswa]' AND id_tugas='$jawab[id_tugas]' AND nilai >0 ")); 
                           
						  
						  ?>
                                <tr>
                                    <td scope="row"><?= $no ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $siswa['kelas'] ?></td>
									
                                    <td>
                                        <?php if ($jawab['file'] <> null) { ?>												
							          <a href="<?= $baseurl ?>/tugas/<?= $jawab['file'] ?>"  class="btn btn-sm btn-success" target="_blank"><i class="material-icons">download</i></a>
                                        <?php } ?>
                                    </td>
                                    <td><?= $jawab['nilai'] ?></td>

                                    <td>
                                       
                                        <?php if($jumlah==0){ ?>
										<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalnilai<?= $no ?>">
                                            <i class="material-icons">add</i> Nilai
                                        </button>
										<?php }else{ ?>
										<button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modalnilai<?= $no ?>" disabled>
                                            <i class="material-icons">lock</i> Nilai
                                        </button>
										<?php } ?>
                                        <button data-id='<?= $jawab['id_jawaban'] ?>' class="hapus btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                                      
                                        <div class="modal fade" id="modalnilai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                              <div class="modal-dialog">
										   <div class="modal-content">
											  <div class="modal-header">
												<h5 class="modal-title" id="tambahjadwal">Input Nilai</h5>
												   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														 <div class="modal-body">
                                                    <form id="formnilaitugas<?= $jawab['id_jawaban'] ?>">
                                                        
                                                            <input type="hidden" class="form-control" name="id" value="<?= $jawab['id_jawaban'] ?>">
                                                            <div class="form-group">
                                                                <label class="bold">Jawaban</label>
                                                                <p><?= $jawab['jawaban'] ?></p>
                                                            </div>
															<div class="form-group">
                                                                <label class="bold">Nilai</label>
                                                                <input type="number" class="form-control" name="nilai<?= $jawab['id_jawaban'] ?>" required="true">                                                                
                                                            </div>
                                                            
													<div class='modal-footer'>	
													<button type='submit' class='btn btn-primary kanan'> Simpan</button>
														
														</div>
														</form>
                                                       </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $("#formnilaitugas<?= $jawab['id_jawaban'] ?>").submit(function(e) {
                                                e.preventDefault();
                                                var id = '<?= $jawab['id_jawaban'] ?>';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "tugas/simpan_nilai.php",
                                                    data: $(this).serialize(),
                                                    success: function(result) {
                                                     $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
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

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<iframe id='loadframe' name='frameresult' src='tugas/print_jawaban.php?id=<?= $_GET['id'] ?>' style='display:none'></iframe>
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
<?php } ?>

<script>
   
    $('#datatable1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus tugas ini!",
            type:'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'tugas/hapus_tugas.php',
                    method: "POST",
                    data: 'id=' + id,
					 beforeSend: function() {
                    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
					$('.progress-bar').animate({
					width: "30%"
					}, 500);
            },
                    success: function(data) {
                      
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
	
    $('#tablejawaban').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus nilai ini!",
            type:'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'tugas/hapus_nilai.php',
                    method: "POST",
                    data: 'id=' + id,
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
            }
            return false;
        })

    });
</script>
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
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
</script>