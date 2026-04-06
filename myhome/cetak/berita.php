<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') : ?>
<div class='row'>
 <div class="col-md-12">
       <div class="card">
	<div class="card-header">
		<h5 class="card_title">BERITA ACARA</h5>
                    <a href="?pg=<?= enkripsi('berita') ?>&ac=<?= enkripsi('buatberita') ?>" class="btn btn-primary pull-right" ><i class="material-icons">add</i>BA</button></a>
						</div>
				  <div class="card-body">  
                <div id='tableberita' class='table-responsive'>
                    <table id="datatable1" class='table table-hover table-bordered edis2'>
                        <thead>
                            <tr>
                                <th width='5px'>#</th>
                                <th>Mata Pelajaran</th>
                                <th>Tingkat</th>
                                <th>Sesi</th>
                                <th>Ruang</th>
                                <th>Hadir</th>
                                <th>Tidak Hadir</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                               
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $beritaQ = mysqli_query($koneksi, "SELECT * FROM berita");
                            ?>
                            <?php while ($berita = mysqli_fetch_array($beritaQ)) : ?>
                                <?php
                                $mapel = mysqli_fetch_array(mysqli_query($koneksi, "select * from banksoal a left join mapel b ON a.nama=b.kode where a.id_bank='$berita[id_bank]'"));
                                $no++
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                       <?= $mapel['nama_mapel'] ?>
                                    </td>
                                     <td style="text-align:center">
                                      <?= $mapel['level'] ?>
                                     
                                    </td>
                                    <td style="text-align:center">
                                        <b><?= $berita['sesi'] ?></b>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $berita['ruang'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $berita['ikut'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $berita['susulan'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $berita['mulai'] ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?= $berita['selesai'] ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                        <div class=''>
                                            <button onclick="frames['frameresult<?= $berita[id_berita] ?>'].print()" class='btn btn-sm btn-primary'><i class='material-icons'>print</i></button>
                                            <button data-id='<?= $berita['id_berita'] ?>' class="hapus btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                                        <iframe id='loadframe' name='frameresult<?= $berita[id_berita] ?>' src='cetak/print_berita.php?id=<?= $berita[id_berita] ?>' style='display:none'></iframe>

										</div>
                                    </td>
                                </tr>


                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
</div>

<script>
  
    $('#tableberita').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'	
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'cetak/tberita.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                    $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
					$('.progress-bar').animate({
               
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

<?php elseif ($ac == enkripsi('buatberita')) : ?>
<div class="row">
	<div class="col-md-8">
		 <div class="card">
	<div class="card-header">
		<h5 class="card_title">BERITA ACARA</h5>
						</div>
				   <div class="card-body"> 
                      <form id="formberita" class="row g-2">
                                <div class="col-md-4">
                                 <label class="bold">Nama Ujian</label>
                                   <select name="id_ujian" id="id_ujian" class='form-select' style="width: 100%" required='true'>
                                     <?php $sql_mapel = mysqli_query($koneksi, "SELECT id_ujian,nama,level FROM ujian group by id_bank"); ?>
                                          <option value=''>Pilih Jadwal Ujian</option>
                                      <?php while ($mapel = mysqli_fetch_array($sql_mapel)) : ?>
										<option value="<?= $mapel['id_ujian'] ?>"><?php echo "$mapel[nama] $mapel[level] "; ?>                               
                                         </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                                         
						        <div class="col-md-4">											
                                    <label class="bold">Sesi</label>
                                      <select class="form-select" id="bcsesi" name="sesi" required>
                                        <option>Sesi</option>
                                        <?php $sesi = mysqli_query($koneksi, "select sesi from siswa group by sesi"); ?>
                                        <?php while ($ses = mysqli_fetch_array($sesi)) : ?>
                                        <option value="<?= $ses['sesi'] ?>"><?= $ses['sesi'] ?></option>
                                           <?php endwhile; ?>
                                       </select>
									</div>
												
								<div class="col-md-4">
                                    <label class="bold">Ruang</label>
                                       <select class="form-select" id="bcruang" name="ruang" required>
                                        <option>Ruang</option>
                                        <?php $ru = mysqli_query($koneksi, "select ruang from siswa group by ruang"); ?>
                                        <?php while ($ruang = mysqli_fetch_array($ru)) : ?>
                                        <option value="<?= $ruang['ruang'] ?>"><?= $ruang['ruang'] ?></option>
                                        <?php endwhile; ?>
                                       </select>
                                    </div>
													
								<div class="col-md-4">
									<label class="bold">Tanggal Ujian</label>
									 <input name='tgl_ujian' class='datepicker form-control' autocomplete=off />
								</div>
												
								<div class="col-md-2">
									<label class="bold">Mulai</label>
									<input id='waktumulai' type='text' name='mulai' class='timer form-control' autocomplete=off />
								</div>
													
								<div class="col-md-2">
									<label class="bold">Selesai</label>
									<input id='waktumulai' type='text' name='selesai' class='timer form-control' autocomplete=off />
								</div>
													
								<div class='col-md-2'>
                                    <label class="bold">Hadir</label>
                                      <input type='number' name='hadir' class='form-control' required='true' />
                                  </div>
                                  
                                <div class='col-md-2'>
                                   <label class="bold">Absen</label>
                                     <input type='number' name='tidakhadir' class='form-control' required='true' />
                                   </div>
                                 
								<div class="col-md-12">
									<label class="bold">Siswa Tidak Hadir</label>
										<select name='nosusulan[]' id="bcsiswaabsen" class='form-control select2' multiple='multiple' style='width:100%'>
									</select>
								</div>
															
								<div class='col-md-6'>
                                    <label class="bold">Nama Proktor</label>
                                       <input type='text' name='nama_proktor' value="<?= $setting['proktor'] ?>" class='form-control' required='true' />
                                  </div>
                                  
                                <div class='col-md-6'>
                                   <label class="bold">NIP Proktor</label>
                                      <input type='text' name='nip_proktor' value="<?= $setting['nipproktor'] ?>" class='form-control' required='true' />
                                </div>
                                    
                                <div class='col-md-6'>
                                   <label class="bold">Nama Pengawas</label>
                                      <input type='text' name='nama_pengawas' class='form-control' required='true' />
                                 </div>
                                  
                                <div class='col-md-6'>
                                   <label class="bold">NIP Pengawas</label>
                                      <input type='text' name='nip_pengawas' class='form-control' required='true' />
                                 </div>
                                  
                                <div class='col-md-12'>
                                   <label class="bold">Catatan</label>
                                      <textarea type='text' name='catatan' class='form-control' required='true'></textarea>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
			
 
			 <script>
    $('#formberita').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'cetak/tberita.php?pg=tambah',
            data: $(this).serialize(),
			beforeSend: function() {
                $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
                $('.progress-bar').animate({
               
                }, 500);
            },
            success: function(data) {
                if (data == 'oke') {
                    
                    setTimeout(function() {
                        window.location.replace('?pg=<?= enkripsi(berita) ?>');
                    }, 2000);
                } else {
                 iziToast.info({
					title: 'GAGAL!',
					message: 'Data Gagal disimpan',
					titleColor: '#FFFF00',
					messageColor: '#fff',
					backgroundColor: 'rgba(0, 0, 0, 0.5)',
					progressBarColor: '#FFFF00',
					position: 'topRight'
                    });
					setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }

            }
        });
        return false;
    });
	
    $("#bcruang").change(function() {
        var sesi = $('#bcsesi').val();
        var ruang = $(this).val();
		var iduji = $('#id_ujian').val();
        console.log(ruang + sesi + iduji);
        $.ajax({
            type: "POST", 
            url: 'cetak/tberita.php?pg=list_siswa',
            data: "ruang=" + ruang + '&sesi=' + sesi + '&iduji=' + iduji, 
            success: function(response) { 
                $("#bcsiswaabsen").html(response);
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    
</script>
<?php endif; ?>