					<?php
					defined('APK') or exit('No accsess');
					$id = $_GET['id'];
					$pkl = fetch($koneksi,'pkl_jurnal',['id'=>$id]);
					$pklsis = fetch($koneksi,'pkl_siswa',['idsiswa'=>$pkl['idsiswa']]);
					$siswa = fetch($koneksi,'siswa',['id_siswa'=>$pkl['idsiswa']]);
					$dudi = fetch($koneksi,'pkl_dudi',['id'=>$pklsis['dudi']]);
					$kmp = fetch($koneksi,'pkl_kompetensi',['id'=>$pkl['idkompetensi']]);
					?> 		
					
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body row g-1">
									<div class="col-md-6">
									<center><img src="../images/kegiatan.png" style="max-width:80px"></center>
									<br>
									<div class="h5 mb-0"><?= $siswa['nama'] ?></div>
									<div class="h5 mb-0"><?= $siswa['kelas'] ?></div>
									<div class="h5 mb-0"><?= $dudi['nama_dudi'] ?></div>
									<br>
									<p>Kompetensi <br><?= $kmp['deskrip'] ?></p>
									<p>Proses Lapangan <br><?= $pkl['proses'] ?></p>
									</div>
									<div class="col-md-6">
									<marquee direction="down"><img src="../images/kegiatan.png" style="width:100%;height:auto"></marquee>
										 </div>
										 </div>
										</div>
									</div>
								  	
						<?php if ($ac == '') : ?>
					       <div class="col-md-4">                   
                                <div class="card">
                                    <div class="card-body">
									<div class="d-flex align-items-center flex-column mb-4">
									<div class="d-flex align-items-center flex-column">
									 <div class="sw-13 position-relative mb-3">
										<img src="<?= $baseurl ?>/images/pkl.png" class="responsive" alt="thumb" />
										</div>
										<div class="h5 mb-0">PRAKERIN</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									  <form id="formsiswa">
									  <input type="hidden" name="id" value="<?= $id; ?>" >
									<label class="bold">NAMA SISWA</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="nama"  required style="width: 100%">
									<option value="<?= $siswa['id_siswa'] ?>"><?= $siswa['nama'] ?></option>
									 
									</select>
									 </div>	
									 <label class="bold">KELAS</label>
									 <div class="input-group mb-1">
                                       <select class="form-select" name="kelas" id="kelas" required style="width: 100%">
									<option value="<?= $siswa['kelas'] ?>"><?= $siswa['kelas'] ?></option>
									 
									</select>
									 </div>	
									<label class="bold">APROVE</label>
									<div class="input-group mb-1">
                                       <select class="form-select" name="aprove"  required style="width: 100%">
									<option value="">Pilih Aprove</option>
									  <option value="1">Disetujui</option>
									 
									</select>
                                    </div>						   
									<div class="widget-payment-request-actions m-t-lg d-flex">
										<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">SIMPAN</button>
                                       </div>
										<form>
					               </div>
								</div>
							</div>
						</div>
					
	
<?php endif ?>
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'siswa/tstatusjurnal.php',
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
				window.location.replace('.');
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
     