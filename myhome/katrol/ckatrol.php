<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>

<?php if ($ac == '') : ?>
 
    <div class='row'>
      <div class="col-md-8">
                <div class="card">
				  <div class="card-header">
                   <h5 class="card-title">DATA NILAI KATROL</small></h5> 
                   
                </div>					 
                 <div class="card-body">   
				
							<p>
                    <div id="tablenilai" class='table-responsive'>
                       <table id="datatable1" class='table table-hover edis2' style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>                                 
                                    <th>MATA PELAJARAN</th>
                                    <th>KODE</th>
									 <th>SESI</th>
                                    <th>TINGKAT</th>
                       
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
										<a href="?pg=<?= enkripsi('ckatrol') ?>&ac=<?= enkripsi('lihat') ?>&idb=<?= $data['id_bank']?>&sesi=<?= $data['sesi'] ?>" class="btn btn-sm btn-primary"><i class="material-icons">print</i></a>
										</td>
                                       
                                    </tr>
                                <?php endwhile; ?>
								
                            </tbody>
                        </table>
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
                         <div class="card-header">
                        <h5 class="card-title"> NILAI KATROL <?= strtoupper($bank['kode']); ?> | Tingkat <?= $bank['level'] ?> | <?= $kelas ?></h5>
						<div class="pull-right">
						<?php if($kelas !=''): ?>
						
						<a href="siswa/nilai_katrol.php?idb=<?= $bank['id_bank'] ?>&sesi=<?= $_GET['sesi'] ?>&kls=<?= $kelas ?>" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Nilai"><i class="material-icons">download</i>NILAI</a>			
						<?php endif; ?>
						</div>
							</div>
                 <div class="card-body">
				 <div class="card-box table-responsive">
                    <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                      <thead>
                      <tr>
                      <th width="5%">NO</th>
                      <th>NAMA SISWA</th>
                      <th>NILAI</th>
                      </tr>
                      </thead>
                      <tbody>
			   <?php
				$no=0;
				$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas' and sesi='$_GET[sesi]'"); 
				while ($data = mysqli_fetch_assoc($query)) :
				$nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_siswa,katrol FROM nilai  WHERE id_siswa='$data[id_siswa]'"));
				$no++;
				?>
                     <tr>		
					 <td><?= $no; ?>
					  <td><?= $data['nama'] ?>
					  <td><?= $nilai['katrol'] ?>
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
                        <h5 class="card-title">NILAI KATROL <?= strtoupper($bank['kode']); ?> | Tingkat <?= $bank['level'] ?></h5>
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
                     <label class="bold">KELAS</label>
						<div class="input-group mb-1">
						<select class="form-select kelas">						
                                <?php $level = mysqli_query($koneksi, "select kelas,level from siswa where level='$bank[level]' group by kelas"); ?>
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
                         <button id="cari" class="btn btn-success flex-grow-1 m-l-xxs"><i class='material-icons'>search</i>CARI NILAI</button>
                            <script type="text/javascript">
                                $('#cari').click(function() {
                                    var kelas = $('.kelas').val();
                                    var sesi = $('.sesi').val();
									var idb = <?= $_GET['idb'] ?>;
                                    location.replace("?pg=<?= enkripsi('ckatrol') ?>&ac=<?= enkripsi('lihat') ?>&kelas=" + kelas + "&sesi=" + sesi + "&idb=" + idb);
                                }); 
                            </script>

                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>		
   		

<?php endif; ?>
