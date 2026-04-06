
<?php
defined('APK') or exit('No Access');

?>
<div class="row">
            <div class="col-xl-8">
                <div class="card">
                  <div class="card card-header">                 
					<h5 class="card-title">BACKUP SOAL</h5>
                  </div>
	<div class="card-body">			  
<div class="table-responsive">
   <table id="datatable1" class="table table-hover table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>NO</th>
			<th>KODE</th>
			<th>TKT</th>
			<th>JENIS</th>
			<th>GURU</th>
			<th>JML</th>
			<th></th>
            </tr>
        </thead>
		<tbody>
		 <?php 
		 
		 $Q = mysqli_query($koneksi, "SELECT * FROM banksoal");
		 
		 ?>
           <?php while ($bank = mysqli_fetch_array($Q)) : ?>
			<?php
			$kelas = fetch($koneksi,'kelas',['level' => $bank['level']]);
				
               $guru = fetch($koneksi,'users',['id_user' => $bank['idguru']]);	
                  $jumlahsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_bank='$bank[id_bank]'"));			   
				  $no++;
                       ?>
                        <tr style="height:30px">
                         <td><?= $no ?></td>
						 <td><?= $bank['kode'] ?></td>
						 <td><?= $bank['level'] ?></td>
                         
						 <td><?= $bank['groupsoal'] ?></td>
						 <td><?= $guru['nama'] ?></td>		
                          <td><?= $jumlahsoal ?> soal</td>
						 <td style="text-align:center">
						 
						 <?php if (file_exists("pengaturan/backup/".$bank['id_bank']."-".$bank['kode'].".zip")) { ?>
						 <a href="pengaturan/backup/<?= $bank['id_bank'] ?>-<?= $bank['kode'] ?>.zip" class="btn-sm btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="File Soal Gambar"><i class="material-icons">download</i></a>
						 <?php } ?>
						 <a href="asesmen/sandik_file/proses.php?id=<?= $bank['id_bank'] ?>" class="backup btn-sm btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Backup Excel"><i class="material-icons">download</i></a>
						
						</td>								
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
				</div>
			</div>
			</div>
				</div>
				
						<script>
				$('#datatable1').on('click', '.backup', function() {
					iziToast.info(
							{
								title: 'Sukses!',
								message: 'Soal berhasil dibackup',
								titleColor: '#FFFF00',
								messageColor: '#fff',
								backgroundColor: 'rgba(0, 0, 0, 0.5)',
								 progressBarColor: '#FFFF00',
								  position: 'topRight'	
									  });
										setTimeout(function() {
											window.location.reload();
										}, 2000);
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