<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jsis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE no_peserta<>''"));
$jlaki = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE jk='L' AND no_peserta<>''"));
$jper = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE jk='P' AND no_peserta<>''"));
?>
<div class="row"> 
        <div class="col-md-8">
            <div class="card">
			<div class="card card-header">
			<h5 class="card-title">DAFTAR HADIR PESERTA </h5>
			 </div>
              <div class="card-body">
				<p></p>			  
                    <div class="row mb-2">
                       <label  class="col-sm-3 control-label bold">Pilih Mapel</label>
                        <div class="col-sm-9">
						<select id='absenmapel' class='form-select' required='true' onchange="printabsen();" >
                            <?php $sql_mapel = mysqli_query($koneksi, "SELECT * FROM ujian"); ?>
                            <option value=''>Pilih Jadwal Ujian</option>
                            <?php while ($mapel = mysqli_fetch_array($sql_mapel)) : ?>
                                <option value="<?= $mapel['id_bank'] ?>">
								<?php echo "$mapel[nama] $mapel[level]";
                                   $dataArray = unserialize($mapel['kelas']);
                                    foreach ($dataArray as $key => $value) {
                                       echo " $value ";
                                       }
                                ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                   </div>
				 
                  <div class="row mb-2">
                       <label  class="col-sm-3 control-label bold">Pilih Ruang</label>
						<div class="col-sm-9">
                        <select id='absenruang' class='form-select' onchange="printabsen();" >

                        </select>
                    </div>
					</div>
					 <div class="row mb-2">
                       <label  class="col-sm-3 control-label bold">Pilih Sesi</label>
						<div class="col-sm-9">
                        <select id='absensesi' class='form-select' onchange="printabsen();" >
                        </select>
                    </div>
					</div>
					 <div class="row mb-2">
                       <label  class="col-sm-3 control-label bold">Pilih Kelas</label>
						<div class="col-sm-9">
                        <select id='absenkelas' class='form-select' onchange="printabsen();" >
                        </select>
                    </div>
					</div>
					<div class="row mb-2">
                        <label  class="col-sm-2 control-label bold"></label>
				         <div class="col-md-10">	
					  <button id='btnabsen' class='btn btn-primary kanan' onclick="frames['frameresult'].print()"><i class='material-icons'>print</i>Print</button>
					 <iframe id='loadabsen' name='frameresult' src='cetak/print_absen.php' style='border:none;width:0px;height:0px;'></iframe>		 
					 </div>
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
			
	      
	
<script>
    function printabsen() {
        var idsesi = $('#absensesi option:selected').val();
        var idmapel = $('#absenmapel option:selected').val();
        var idruang = $('#absenruang option:selected').val();
        var idkelas = $('#absenkelas option:selected').val();
        if (!idkelas) {
            idkelas = '';
        }
        if (!idsesi) {
            idsesi = '';
        }
        $('#loadabsen').attr('src', 'cetak/print_absen.php?id_sesi=' + idsesi + '&id_ruang=' + idruang + '&id_bank=' + idmapel + '&id_kelas=' + idkelas);
    }
    $("#absenmapel").change(function() {
        var mapel_id = $(this).val();
        console.log(mapel_id);
        $.ajax({
            type: "POST", 
            url: "cetak/ambildata.php?pg=ambil_ruang", 
            data: "mapel_id=" + mapel_id, 
            success: function(response) { 
                $("#absenruang").html(response);
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $("#absensesi").change(function() {
        var sesi = $(this).val();
        var mapel_id = $("#absenmapel").val();
        var ruang = $("#absenruang").val();
        console.log(sesi + ruang + mapel_id);
        $.ajax({
            type: "POST",
            url: "cetak/ambildata.php?pg=ambilkelas", 
            data: "mapel_id=" + mapel_id + '&sesi=' + sesi + '&ruang=' + ruang, 
            success: function(response) { 
                $("#absenkelas").html(response);
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $("#absenruang").change(function() {

        var ruang = $(this).val();
        console.log(ruang);
        $.ajax({
            type: "POST", 
            url: "cetak/ambildata.php?pg=ambil_sesi", 
            data: "ruang=" + ruang, 
            success: function(response) { 
                $("#absensesi").html(response);
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>