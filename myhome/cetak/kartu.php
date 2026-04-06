<?php
defined('APK') or exit('No Access');
if (empty($_GET['k'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['k'];
    }
    if (empty($_GET['t'])) {
        $tingkat = "";
    } else {
        $tingkat = $_GET['t'];
    }
if($setting['pk_ttd']=='0'){$ttd='Tidak';}
if($setting['pk_ttd']=='1'){$ttd='Ya';}
if($setting['pk_stempel']=='0'){$stp='Tidak';}
if($setting['pk_stempel']=='1'){$stp='Ya';}
?>

<?php if ($ac == '') : ?>
                   
                   <div class="row"> 
                          <div class="col-md-7">
                                <div class="card">
                                <div class="card card-header">
									<h5 class="card-title">CETAK KARTU PESERTA </h5>
								</div> 	
				              <div class="card-body">
								<p></p>							  
								<div class="row mb-2">
                                 <label  class="col-sm-2 control-label bold">Header</label>
								 <div class="col-md-10">
								<textarea id='headerkartu' name="jawab" class='form-control text-center' onchange='kirim_form();' rows='2'><?= $setting['header_kartu'] ?></textarea>
								     </div>
									</div>
									<div class="row mb-2">
                                 <label  class="col-sm-2 control-label bold">Tingkat</label>
								 <div class="col-md-10">
                                  <select name="tingkat" id="tingkat" class="form-select tingkat" style="width: 100%;" required >
							  <option value="<?= $tingkat ?>"><?= $tingkat ?></option>
                                 <?php $kls = mysqli_query($koneksi, "SELECT level FROM siswa GROUP BY level"); ?>
                                   <?php while ($Q = mysqli_fetch_array($kls)) : ?>
                                     <option value="<?= $Q['level'] ?>"><?= $Q['level'] ?></option>
                                        <?php endwhile ?>
                                           </select> 
                                    </div>
									</div>
									<div class="row mb-2">
                                   <label  class="col-sm-2 control-label bold">Kelas</label>
								   <div class="col-md-10">
                                        <select name="kelas" id="kelas" class="form-select kelas" style="width: 100%;" required >
                                         <option value="<?= $kelas ?>"><?= $kelas ?></option>
										 <?php
										  $sql = mysqli_query($koneksi, "SELECT level,kelas FROM siswa WHERE level='" . $tingkat . "' GROUP BY kelas");
											echo "<option value=''>Pilih Kelas</option>";
										   while ($data = mysqli_fetch_array($sql)) {
												echo "<option value='$data[kelas]'>$data[kelas]</option>";
											}
											?>
                                           </select> 
                                    </div>
									</div>
                                    <div class="row mb-2">
                                       <label  class="col-sm-2 control-label bold"></label>
								   <div class="col-md-10">									
                                       <button class='btn btn-primary kanan' onclick="frames['frameresult'].print()"><i class='material-icons'>print</i>Print</button>                               
                                    <iframe id='loadframe' name='frameresult' src='cetak/cetak_kartu.php?kelas=<?= $kelas ?>' style='display:none'></iframe>
									</div>
								</div>
                               
                               </div>
							</div>
						</div>
					
					<script type="text/javascript">
					$('#kelas').change(function() {
					var k = $('.kelas').val();
					var t = $('.tingkat').val();
					location.replace("?pg=<?= enkripsi('karpes') ?>&k=" + k + "&t=" + t);
					}); 
					</script>
					<script>
					$("#tingkat").change(function() {
					var tingkat = $(this).val();
					console.log(tingkat);
					$.ajax({
					type: "POST", 
					url: "cetak/ambildata.php?pg=kelas", 
					data: "tingkat=" + tingkat, 
					success: function(response) { 
					$("#kelas").html(response);
							}
						});
					});
					</script>					
					<script>
						function kirim_form() {			
						var jawab = $('#headerkartu').val();
						$.ajax({
						type: 'POST',
						url: 'cetak/tberita.php?pg=header',
						data: 'jawab=' + jawab,
						success: function(response) {
						location.reload();
								}
							});
							}
						</script>
      
                  <div class="col-xl-5 mb-4">
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
							<div class="row mb-2">
                                 <label  class="col-sm-6 control-label bold">Gunakan TTD Kepsek</label>
								 <div class="col-md-6">
                                  <select name="ttd"  id="ttd" class="form-select" onchange='kirim1();' style="width: 100%;" required >
									<option value="<?= $setting['pk_ttd'] ?>"><?= $ttd ?></option>
										<option value="1">Ya</option>
										<option value="0">Tidak</option>
                                           </select> 
                                    </div>
								</div>
								<p>
								<div class="row mb-2">
                                 <label  class="col-sm-6 control-label bold">Gunakan Stempel</label>
								 <div class="col-md-6">
                                  <select name="stp" id="stp" class="form-select" onchange='kirim2();' style="width: 100%;" required >
							       <option value="<?= $setting['pk_stempel'] ?>"><?= $stp ?></option>
                                    <option value="1">Ya</option>
									<option value="0">Tidak</option>
                                      </select> 
                                     </div>
								   </div>										
								</div>
							</div>
						</div>
					</div>
						<script>
						function kirim1() {			
						var ttd = $('#ttd').val();
						$.ajax({
						type: 'POST',
						url: 'cetak/tberita.php?pg=ttd',
						data: 'ttd=' + ttd,
						success: function(response) {
						location.reload();
								}
							});
							}
						function kirim2() {			
						var stp = $('#stp').val();
						$.ajax({
						type: 'POST',
						url: 'cetak/tberita.php?pg=stp',
						data: 'stp=' + stp,
						success: function(response) {
						location.reload();
								}
							});
							}
						</script>		
		<?php endif; ?>
		
