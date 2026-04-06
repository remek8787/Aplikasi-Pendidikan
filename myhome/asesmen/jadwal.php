 <?php
defined('APK') or exit('No Access');
$jfile = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM file_pendukung"));
?>

 <div class='row'>
       <div class="col-xl-8 mb-4">
          <div class="card">
			<div class="card card-header">
			<h5 class="card-title bold">AKTIFITAS JADWAL</h5>
                  </div>
				  <div class="card-body">				   
				  <form id='formaktivasi' action="" class="row g-2">
                        <div class="col-md-12">
                            <label>Pilih Jadwal Ujian</label>
                            <select class="form-control select2" name="ujian[]" style="width:100%" multiple='true' required>
                                 <?php if ($user['level'] == 'admin') {
                                    $jadwal = mysqli_query($koneksi, "SELECT * FROM ujian  ORDER BY tgl_ujian ASC, waktu_ujian ASC");
                                } else {
                                    $jadwal = mysqli_query($koneksi, "SELECT * FROM ujian where id_guru='$id_user'  ORDER BY tgl_ujian ASC, waktu_ujian ASC");
                                } ?>
                                <?php while ($ujian = mysqli_fetch_array($jadwal)) : ?>

                                    <option value="<?= $ujian['id_ujian'] ?>"><?= $ujian['kode_nama'] . " - " . $ujian['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>						
                        <div class="col-md-6">
                            <label>Pilih Kelompok Test / Sesi</label>
                                <select class="form-select" name="sesi" id="">
                                        <?php $sesi = mysqli_query($koneksi, "select sesi from siswa group by sesi"); ?>
                                        <?php while ($ses = mysqli_fetch_array($sesi)) : ?>
                                            <option value="<?= $ses['sesi'] ?>"><?= $ses['sesi'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
								
                        <div class="col-md-6">
                            <label class="bold">Action</label>
                                <select class="form-select" name="aksi" required>
                                        <option value="">Pilih Action</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Non aktif</option>
                                        <option value="hapus">Hapus</option>
                                    </select>
                                </div>
						
					 <div class="widget-info-container">
                        <button type="submit" class="btn btn-primary kanan"  >Simpan </button>
                   </div>
				  </form>
               </div>
	         </div>
			</div>
			 <script>
			 $('#formaktivasi').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'asesmen/tjadwal.php?pg=aktivasi',
                    data: $(this).serialize(),
                    success: function(data) {
				   $('#progressbox').html('<div><img src="<?= $baseurl ?>/img/animasi.gif" style="width:50px;"></div>');
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
			   <div class="col-xl-4">
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
						<?php $token = mysqli_fetch_array(mysqli_query($koneksi, "select token from token")) ?>
                                          <center>
										  <div class="spinner-grow text-danger" role="status"></div>
                                          <form id="formtoken" method='post'>
										 <h3 class="text-center" name='token' id='isi_token' style="color:red;font-weight:bold;"><?= $token['token'] ?></h3>

										<button type="submit" class="btn btn-primary" id="btntoken">Upgrade Now</button>
                                     </form>
									</center>
								</div>
							</div>
						</div>
					</div>
											<script>
										 $('#formtoken').submit(function(e) {
											e.preventDefault();
										var data = new FormData(this);
										$.ajax({
										url: "asesmen/tjadwal.php?pg=token",
											data: data,
											cache: false,
											contentType: false,
											processData: false,
											success: function(data){   		
											$('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
												$('.progress-bar').animate({
												width: "30%"
												}, 500);
													setTimeout(function()
														{
														window.location.reload();
														}, 2000);
																	  
														}
													});
												return false;
											});
									</script>
									
			  
	<div class='row'>
		<div class="col-xl-8 mb-4">
         <div class="card">
            <div class="card-header">
              <h5 class="card-title bold">JADWAL UJIAN</h5>          
                  </div>
             <div class="card-body">
		<div id='tablereset' class='table-responsive'>
			<table class='table table-hover' id="datatable1">
            <thead>
                <tr>

                    <th width='5px'>#</th>
                    <th>Bank Soal</th>
                    <th>Ujian - Level</th>                   
                    <th>Waktu Ujian</th>  
                    <th>Sesi</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM ujian  ORDER BY tgl_ujian ASC, waktu_ujian ASC");
                while ($mapel = mysqli_fetch_array($mapelQ)) : 
                $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                         <h5><span class="badge bg-dark"> <?= $mapel['kode_nama'] ?></span></h5>
                        </td>
                        <td>
						<h5><span class="badge bg-warning"> <?= $mapel['kode_ujian'] ?> &nbsp;<?= $mapel['level'] ?> &nbsp;<?= $mapel['pk'] ?></span></h5>
                        </td>
                        
                        <td>
                            <small style="color:green;"> <?= date('d-m-Y H:i',strtotime($mapel['tgl_ujian'])) ?></small><br>
                            <small style="color:red;"><?= date('d-m-Y H:i',strtotime($mapel['tgl_selesai'])) ?></small>
                        </td>

                        <td style="text-align:center">
                            <?php
                            if ($mapel['status'] == 1) { ?>
                            
                        Aktif <span class="badge bg-success m-l-xxs"><?= $mapel['sesi'] ?></span>
                        
                          <?php  } elseif ($mapel['status'] == 0) { ?>
                          
                       Non Aktif <span class="badge bg-danger m-l-xxs"><?= $mapel['sesi'] ?></span>
                       
                          <?php  } ?>
                            
							
                        </td>
                        <td style="text-align:center">
                             <?php if ($mapel['tgl_ujian'] > date('Y-m-d H:i:s') and $mapel['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
                      <div class="spinner-grow text-secondary" role="status">
							<span class="visually-hidden">Loading...</span>
							</div> <strong>Belum</strong>
                   <?php } elseif ($mapel['tgl_ujian'] < date('Y-m-d H:i:s') and $mapel['tgl_selesai'] > date('Y-m-d H:i:s')) { ?>
                       <div class="spinner-grow text-success" role="status">
						<span class="visually-hidden">Loading...</span>
							</div> <strong>Mulai</strong>
                   <?php } else { ?>
                    <div class="spinner-grow text-danger" role="status">
						<span class="visually-hidden">Loading...</span>
							</div> <strong>Habis</strong>
                   <?php } ?>
							
                        </td>
                        <td>
                         <a href="?pg=<?=enkripsi('jadwal') ?>&ac=edit&idu=<?= $mapel['id_ujian'] ?>" class="btn btn-sm btn-icon btn-icon-only btn-primary"><i class="material-icons">edit</i></a>	
							
                        </td>
                    </tr>
                <?php endwhile ?>
				</tbody>
			</table>
			</div>
		 </div>
	</div>
</div>
		  
		  <?php if ($ac == '') : ?>
	          
		<div class="col-xl-4 mb-4">
			<div class="card">
			<div class="card card-header">
				<h5 class="card-title bold">INPUT JADWAL</h5>
				</div>					
				<div class="card-body">			 
					<form id="formtambahujian" method='post' class="row g-2">
                    <div class='form-group'>
                        <label class="bold">Paket Soal</label>
                        <select name='paket' id="paket" class='form-select' required='true'>
						<option value=''>Pilih Paket Soal </option>
                           <option value='A'>Paket A (Tingkat Sulit)</option>
							<option value='B'>B (Tingkat Sedang)</option>
							<option value='C'>C (Tingkat Mudah)</option>
                        </select>
                    </div>
					<div class='form-group'>
                        <label class="bold">Nama Bank Soal</label>
                        <select name='idmapel' id="idmapel" class='form-select' required='true'>
						
                        </select>
                    </div>
					<div class='form-group'>
                        <label class="bold">Pembuat Soal</label>
                        <select name='idguru' class='form-select' required='true'>
						<?php if($user['level']=='admin'){ ?>
                            <option value=''>Pilih Pembuat Soal </option>
                            <?php
                            $nama = mysqli_query($koneksi, "SELECT * FROM users WHERE level='guru'");
                            while ($namaQ = mysqli_fetch_array($nama)) {
                                echo "<option value='$namaQ[id_user]'>$namaQ[nama] </option>";
                            }
                            ?>
                        </select>
						<?php }else{ ?>
						<?php
                            $nama = mysqli_query($koneksi, "SELECT * FROM users WHERE  id_user='$_SESSION[id_user]'");
                            while ($namaQ = mysqli_fetch_array($nama)) {
                                echo "<option value='$namaQ[id_user]'>$namaQ[nama] </option>";
                            }
                            ?>
                        </select>
						<?php } ?>
                    </div>
                    <div class='form-group'>
                        <label class="bold">Nama Jenis Ujian</label>
                        <select name='kode_ujian' class='form-select' required='true'>
                            <option value=''>Pilih Jenis Ujian </option>
                            <?php
                            $namaujianx = mysqli_query($koneksi, "SELECT * FROM jenis where status='aktif' order by nama ASC");
                            while ($ujian = mysqli_fetch_array($namaujianx)) {
                                echo "<option value='$ujian[id_jenis]'>$ujian[id_jenis] - $ujian[nama] </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class='form-group-sm'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label class="bold">Waktu Mulai</label>
                                <input type='text' name='tgl_ujian' class='tgl form-control' autocomplete='off' required='true' />
                            </div>
                            <div class='col-md-6'>
                                <label class="bold">Waktu Expired</label>
                                <input type='text' name='tgl_selesai' class='tgl form-control' autocomplete='off' required='true' />
                            </div>
                        </div>
                    </div>
                    
                        <div class='col-md-6'>
                            
                                <label class="bold">Sesi</label>
                                <select name='sesi' class='form-select' required='true'>
                                    <?php
                                    $sesix = mysqli_query($koneksi, "SELECT sesi from siswa group by sesi");
                                    while ($sesi = mysqli_fetch_array($sesix)) {
                                        echo "<option value='$sesi[sesi]'>$sesi[sesi]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        
                        <div class='col-md-6'>
                           
                                <label class="bold">Lama ujian</label>
                                <input type='number' name='lama_ujian' value="90" class='form-control' required='true' />
                            </div>
                        
						  <?php if($setting['pelanggaran']==1): ?>
								 <div class="col-md-5">
                             <span class="bold">Pelanggaran
                                <input class="form-check-input" type="checkbox" id="checkme" checked>
                                 </span>
                                </div>
								
								<div class="col-md-7">
                             <span class="bold">Durasi (detik)
                                <input class="form-control" type="number" name="langgar" id="langgar" value="5" readonly="true">
                               
								</span>
                                </div>
								<p>
								<?php endif; ?>
                      <div class="row g-2">
                        <button type="submit" class='btn btn-primary' >Simpan</button>
                    </div>
					
                </form>									
             </div>
           </div>
         </div>	
     </div>	
<script>
		$("#paket").change(function() {
		var paket = $(this).val();
		console.log(paket);
		$.ajax({
		type: "POST",
		url: "asesmen/tjadwal.php?pg=paket", 
		data: "paket=" + paket, 
	    success: function(response) { 
		$("#idmapel").html(response);
				}
			});
		});
</script>		
	<script>
		$(document).ready(function(){
    if($('#checkme:checked').length){
        $('#langgar').attr('readonly',false); 
    }

    $('#checkme').change(function(){
        if($('#checkme:checked').length){
            $('#langgar').attr('readonly',false); 
        }else{
            $('#langgar').attr('readonly',true);
        }
    });
});
		</script>	
		<script>
         $('#formtambahujian').submit(function(e) {
           	e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
            url: 'asesmen/tjadwal.php?pg=tambah',
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
 <?php elseif($ac == 'edit'): ?>
 <?php $uji = fetch($koneksi,'ujian',['id_ujian'=>$_GET['idu']]); ?>
 <div class="col-xl-4">
    <div class="card widget widget-info">
      <div class="card-body">
					
         <form id="formedit-u" method='post'>
		 <input type="hidden" name="idu" value="<?= $_GET['idu'] ?>" >
                    <div class='form-group'>
                        <label class="bold">Nama Bank Soal</label>
                        <select name='idmapel' class='form-select' required='true'>
                            <?php
                            if ($user['level'] == 'admin') {
                                $namamapelx = mysqli_query($koneksi, "SELECT * FROM banksoal where status='1' and id_bank='$uji[id_bank]' order by nama ASC");
                            } else {
                                $namamapelx = mysqli_query($koneksi, "SELECT * FROM banksoal where status='1' and idguru='$id_user' and id_bank='$uji[id_bank]' order by nama ASC");
                            }
                            while ($namamapel = mysqli_fetch_array($namamapelx)) {
                               
                                echo "<option value='$namamapel[id_bank]'>$namamapel[kode] [$namamapel[nama] [$namamapel[level] [$namamapel[groupsoal]]";
                               
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
					
                    
                    <div class='form-group-sm'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <label class="bold">Waktu Mulai</label>
                                <input type='text' name='tgl_ujian' value="<?= $uji['tgl_ujian'] ?>" class='tgl form-control' autocomplete='off' required='true' />
                            </div>
                            <div class='col-md-6'>
                                <label class="bold">Waktu Expired</label>
                                <input type='text' name='tgl_selesai' value="<?= $uji['tgl_selesai'] ?>" class='tgl form-control' autocomplete='off' required='true' />
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label class="bold">Sesi</label>
                                <select name='sesi' class='form-select' required='true'>
                                    <?php
                                    $sesix = mysqli_query($koneksi, "SELECT sesi from siswa group by sesi");
                                    while ($sesi = mysqli_fetch_array($sesix)) {
                                        echo "<option value='$sesi[sesi]'>$sesi[sesi]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group-sm'>
                                <label class="bold">Lama ujian</label>
                                <input type='number' name='lama_ujian' value="<?= $uji['lama_ujian'] ?>" class='form-control' required='true' />
                            </div>
                        </div>  
						 <p>
                      <div class="d-grid gap-2">
				  
                        <button type="submit" class='btn btn-primary' id="blockui-3">Simpan</button>
                    </div>
					
                </form>									
             </div>
           </div>
         </div>				 
		
       <script>
         $('#formedit-u').submit(function(e) {
           	e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
            url: 'asesmen/tjadwal.php?pg=ubah',
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
						window.location.replace('?pg=<?= enkripsi(jadwal) ?>');
						}, 2000);
									  
						}
					});
				return false;
			});
    </script>
 
 
 <?php endif; ?>