<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>

<?php if ($ac == '') : ?>
 
    <div class='row'>
      <div class="col-xl-8">
                <div class="card">
				  <div class="card card-header">
                   <h5 class="card-title">DATA NILAI</h5>                    
                </div>					 
                 <div class="card-body">   
                    <div id="tablenilai" class='table-responsive'>
                       <table id="datatable1" class='table table-hover edis2' style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>                                 
                                    <th>MATA PELAJARAN</th>
                                    <th>KODE</th>
									 <th>SESI</th>
                                    <th>TINGKAT</th>								
                                    <th>KOREKSI</th>
									 <th>CETAK</th>
                                </tr>
                            </thead>
                            <tbody>
							
                                <?php $siswaQ = mysqli_query($koneksi, "SELECT * FROM ujian"); ?>
                                <?php while ($data = mysqli_fetch_array($siswaQ)) : ?>
                                    <?php
                                    $no++;
                                    $bank = fetch($koneksi,'banksoal',['id_bank'=>$data['id_bank']]);
									 $mapel = fetch($koneksi,'mapel',['kode'=>$bank['nama']]);
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>                                       
                                        <td><?= $mapel['nama_mapel'] ?></td>
                                        <td><h5><span class="badge badge-secondary"><?= $bank['kode'] ?></span></h5></td> 
										<td><h5><span class="badge badge-success"><?= $data['sesi'] ?></span></h5></td>  										
                                        <td><h5><span class="badge badge-dark"><?= $data['level'] ?></span> <span class="badge badge-dark"><?= $data['pk'] ?></span></h5></td>
									   	<td>
										<a href="?pg=<?= enkripsi('nilai') ?>&ac=<?= enkripsi('koreksi') ?>&idb=<?= $data['id_bank']?>&sesi=<?= $data['sesi'] ?>" class="btn btn-sm btn-primary"><i class="material-icons">search</i></a>
										</td>									
                                        <td>
										<a href="?pg=<?= enkripsi('nilai') ?>&ac=<?= enkripsi('lihat') ?>&idb=<?= $data['id_bank']?>&sesi=<?= $data['sesi'] ?>" class="btn btn-sm btn-primary"><i class="material-icons">print</i></a>
										</td>
                                       
                                    </tr>
                                <?php endwhile; ?>
								
                            </tbody>
                        </table>
						</div>
                    </div>
                </div>
            </div>
       
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
   <?php elseif ($ac == enkripsi('lihat')) : ?>
  
   <?php 
   if (empty($_GET['kelas'])) {
        $kelas = "";
   }else{
	   $kelas = $_GET['kelas'];
   }
   
   $bank = fetch($koneksi,'banksoal',['id_bank'=>$_GET['idb']]); 
   ?>
   
            <div class="row">
			<div class="col-md-8">
                      <div class="card">
                         <div class="card card-header">
                        <h5 class="card-title"> <?= strtoupper($bank['kode']); ?> | Tingkat <?= $bank['level'] ?> | <?= $kelas ?></h5>
						<div class="pull-right">
						<?php if($kelas !=''): ?>
						 <a href="siswa/prosesexcel.php?idb=<?= $bank['id_bank'] ?>&sesi=<?= $_GET['sesi'] ?>&kls=<?= $kelas ?>" class="btn btn-sm btn-primary kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Jawaban"><i class="material-icons">download</i>JAWABAN</a>		  
						<a href="siswa/nilai_excel.php?idb=<?= $bank['id_bank'] ?>&sesi=<?= $_GET['sesi'] ?>&kls=<?= $kelas ?>" class="btn btn-sm btn-success kanan" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Nilai"><i class="material-icons">download</i>NILAI</a>			
						<?php endif; ?>
						</div>
							</div>
                 <div class="card-body">
				 <div class="card-box table-responsive">
                    <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                      <thead>
                      <tr>
                      <th width="5%">NO</th>
					  <th>NO PESERTA</th>
                      <th>NAMA SISWA</th>
                      <th>NILAI</th>
                      </tr>
                      </thead>
                      <tbody>
			   <?php
				$no=0;
				$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas' and sesi='$_GET[sesi]'"); 
				while ($data = mysqli_fetch_assoc($query)) :
				$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_siswa,id_bank,nilai FROM nilai  WHERE id_siswa='$data[id_siswa]' and id_bank='$_GET[idb]'"));
				$no++;
				?>
                     <tr>		
					 <td><?= $no; ?>
					  <td><?= $data['nopes'] ?>
					  <td><?= $data['nama'] ?>
					  <td><?= $nilai['nilai'] ?>
					 </tr>
					 <?php endwhile; ?>
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
				<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                    </div>
                <div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>
				 <div class="widget-payment-request-info m-t-md">
                     <label class="bold">KELAS</label>
						<div class="input-group mb-1">
						<select class="form-select kelas">						
                                <?php $level = mysqli_query($koneksi, "select kelas,level from siswa where level='$bank[level]'  GROUP BY kelas"); ?>
                                <option value=''> Pilih Rombel</option>
                                <?php while ($kls = mysqli_fetch_array($level)) : ?>
                                    <option <?php if ($kelas == $kls['kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>	
						</div>	  
					<label class="bold">SESI</label>
						<div class="input-group mb-1">
						<select class="form-select sesi">
                          
                                <option value="<?= $_GET['sesi'] ?>"> <?= $_GET['sesi'] ?></option>
                            </select>	
						</div>
                   <div class="widget-payment-request-actions m-t-lg d-flex">
                          <button id="cari" class="btn btn-success flex-grow-1 m-l-xxs"><i class='material-icons'>search</i> CARI NILAI</button>
                            <script type="text/javascript">
                                $('#cari').click(function() {
                                    var kelas = $('.kelas').val();
                                    var sesi = $('.sesi').val();
									var idb = <?= $_GET['idb'] ?>;
                                    location.replace("?pg=<?= enkripsi('nilai') ?>&ac=<?= enkripsi('lihat') ?>&kelas=" + kelas + "&sesi=" + sesi + "&idb=" + idb);
                                }); 
                            </script>

                        </div>
					</div>
				</div>
			</div>
		</div>
         
	</div>		
   			
<?php elseif ($ac == enkripsi('koreksi')) : ?>
   <?php 
   $bank = fetch($koneksi,'banksoal',['id_bank'=>$_GET['idb']]); 
   $jsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal where id_bank='$_GET[idb]' and jenis='2'"));
   ?>
            <div class="row">
                          <div class="col-xl-8">
                                <div class="card">
								<div class="card card-header">
									<h5 class="card-title">KOREKSI JAWABAN ESAI <span class="badge badge-primary"><?= strtoupper($bank['kode']); ?></span></h5>
									</div>
									
                                    <div class="card-body">
									<?php if($jsoal <>0): ?>
									<div class="card-box table-responsive">
                                         <table id="datatable1" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>
                                                    <th>NAMA SISWA</th>
                                                    <th>KODE</th>  
                                                    <th>TINGKAT</th>													
                                                    <th>SKOR</th>
													 <th>EDIT</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
												$no=0;
											  $query = mysqli_query($koneksi, "SELECT * FROM nilai,siswa WHERE nilai.id_siswa=siswa.id_siswa and nilai.id_bank='$_GET[idb]' and siswa.sesi='$_GET[sesi]'"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $mapel = fetch($koneksi,'mapel',['kode'=>$bank['nama']]);
											 if($bank['soal_agama']==''):
											$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[id_siswa]' and level='$bank[level]'  ORDER BY id_siswa ASC")); 
											else:
											$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$data[id_siswa]' and level='$bank[level]' and agama='$bank[soal_agama]'  ORDER BY id_siswa ASC")); 
											endif;
											
											 $no++;
											   ?>
                                                <tr>
                                                   <td><?= $no; ?></td>
                                                   <td><?= $siswa['nama'] ?></td>
                                                   <td><h5><span class="badge badge-primary"><?= $bank['kode'] ?></span></h5></td>
                                                   <td><h5><span class="badge badge-dark"><?= $bank['level'] ?></span> <span class="badge badge-dark"><?= $bank['pk'] ?></span></h5></td>
                                                   
												   <td><h5><span class="badge badge-danger"><?= $data['skor_esai']; ?></span> 
												   </h5>
												   </td>
												  <td>
												  <a href="?pg=<?= enkripsi('nilai') ?>&ac=<?= enkripsi('edit') ?>&idn=<?= enkripsi($data['id_nilai']) ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Koreksi Jawaban"><i class="material-icons">edit</i></a>		  
												 
												  </td>
                                                </tr>
												<?php endwhile; ?>
                                                </table>
												 </div>
												 <?php else: ?>
												 TIDAK ADA SOAL ESAI
												 <?php endif; ?>
											</div>
										</div>
									</div>
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
								
								
	<?php elseif ($ac == enkripsi('edit')) : ?>
	 <?php
    $idn = dekripsi($_GET['idn']);
    $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$idn'"));
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM banksoal where id_bank='$nilai[id_bank]'"));
    $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$nilai[id_siswa]'"));
    ?>
	 <div class='row'>
      <div class="col-md-12">
                <div class="card">
				  <div class="card-header">
                   <h5 class="card-title">DATA NILAI DAN JAWABAN</small></h5>  
                  </div>
              
				 <div class="card-body">
                    <table class='table' style="width:100%;">
	                  <tr>
                            <th width='150'>No Induk</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['nis'] ?></td>
                           
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['nama'] ?></td>
                            
                        </tr>
                        <tr>
                            <th>Rombel</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['kelas'] ?></td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['kode'] ?></td>
                        </tr>
						 
                    </table>
					<br>
					   <table id="datatable1" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width='5px'>#</th>
                                        <th><b>Soal Esai</b></th>
                                        <th style='text-align:center' width="35%">Jawaban</th>
										 <th style='text-align:center' width="5%">Hasil</th>
										  <th style='text-align:center' width="15%">
										  <button type="button" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#modelId<?= $nilai['id_nilai'] ?>">
                                                            <i class="material-icons">edit</i> Nilai
                                                        </button>
										  </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $jawaban = unserialize($nilai['jawaban_esai']); ?>
                                      <?php foreach ($jawaban as $key => $value) : ?>
                                            <?php
                                                 $no++;
                                               $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'"));
                                                        if ($value == $soal['jawaban']) :
                                                    $status = "<span style='color:green'><i class='material-icons'>check</i></span>";
                                                     else :
                                                $status = "<span style='color:red'><i class='material-icons'>close</i></span>";
                                                     endif;
                                                                    ?>
                                       
                                        <tr>
                                            <td><?= $no ?></td>
                                              <td><?= substr($soal['soal'],0,50)."......."; ?></td>
                                            <td><?= $value ?></td>
											<td style='text-align:center'><?= $status ?></td>
											 <td>
												
																	 </td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>

										<div class="modal fade" id="modelId<?= $nilai['id_nilai'] ?>" tabindex="-1" aria-labelledby="modelId<?= $nilai['id_nilai'] ?>" aria-hidden="true">
                                                          <div class="modal-dialog modal-lg">
														   <div class="modal-content">
															  <div class="modal-header">
																<h5 class="modal-title">Nilai Esai</h5>
																   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		  <div class="modal-body">
                                                                    <form id='formnesai<?= $nilai['id_nilai'] ?>'>
                                                                        <table class='table table-bordered table-hover'>

                                                                            <tbody>
                                                                                <?php $noX = 0;
                                                                                $jawabanesai = unserialize($nilai['jawaban_esai']);
                                                                                $nesai = unserialize($nilai['nilai_esai2']); ?>
                                                                                <?php foreach ($jawabanesai as $key2 => $value2) : ?>
                                                                                    <?php
                                                                                    $noX++;
                                                                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key2'"));

                                                                                    ?>
                                                                                    <tr>
                                                                                        <td width="5%"><?= $noX ?></td>
                                                                                        <td  style='text-align:justify'><?= $soal['soal'] ?>
                                                                                            <p><b>Jawaban :</b> <?= $value2 ?></p>
																							<p><b>Kunci :</b> <?= $soal['jawaban'] ?></p>
                                                                                        </td>
                                                                                        <td width="15%">
                                                                                            <input type="hidden" class="form-control" name="id" value="<?= $nilai['id_nilai'] ?>">
                                                                                          <input type="hidden" class="form-control" name="makskor" value="<?= $soal['max_skor'] ?>">
																						
																							<?php if($value2==$soal['jawaban']): ?>
																							<input style="width: 100px" type="text" class="form-control" name="nesai<?= $nilai['id_nilai'] ?>[<?= $key2 ?>]" value="<?= $soal['max_skor'] ?>" readonly="true">
                                                                                          <?php else: ?>
																					   <input style="width: 100px" type="text" class="form-control" name="nesai<?= $nilai['id_nilai'] ?>[<?= $key2 ?>]" value="<?= $nesai[$key2] ?>">
                                                                                          <?php endif; ?>
																					   <label>Skor Maximal <?= $soal['max_skor'] ?> </label>
																					   </td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>


                                                                </div>
                                                                <div class="modal-footer">
                                 
                                                                    <button type="submit" id="simpanesai<?= $nilai['id_nilai'] ?>" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>     
											</div>
										</div>        
											<script>
                                                        $("#formnesai<?= $nilai['id_nilai'] ?>").submit(function(e) {
                                                            e.preventDefault();
                                                            var id = '<?= $nilai['id_nilai'] ?>';
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "siswa/simpanesai.php",
                                                                data: $(this).serialize(),
                                                                success: function(data){   
														 if (data == 'OK') {		
															iziToast.info(
															{
																title: 'Sukses!',
																message: 'Data berhasil disimpan',
																titleColor: '#FFFF00',
																messageColor: '#fff',
																backgroundColor: 'rgba(0, 0, 0, 0.5)',
																 progressBarColor: '#FFFF00',
																  position: 'topRight'
															});
															setTimeout(function()
															{
																window.location.replace("?pg=<?= enkripsi('nilai') ?>&ac=<?= enkripsi('koreksi') ?>&idb=<?= $mapel['id_bank']?>&sesi=<?= $siswa['sesi'] ?>");
															}, 2000);
															 } else {
															 iziToast.warning(
															{
																title: 'Gagal!',
																message: 'Pengisian skor tidak boleh melebihi yg ditentukan',
																titleColor: '#FFFF00',
																messageColor: '#fff',
																backgroundColor: '#8b0000',
																 progressBarColor: '#FFFF00',
																  position: 'topRight'
															});
															setTimeout(function(){
																window.location.reload();
															}, 2000);	
														   }			
														}
													});
													return false;
												});
											</script>
                                           
						 
   

<?php endif; ?>
