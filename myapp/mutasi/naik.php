<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$jsiswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
?>
<script src="siswa/jqury.js"></script>
<?php

    if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
    if (empty($_GET['dari'])) {
        $dari = "";
    } else {
        $dari = $_GET['dari'];
    }
    ?>
			<div class="row">  
				<div class="col-xl-8">
                 <div class="card">
			      <div class="card card-header">
					<h5 class="card-title">SISWA NAIK KELAS</h5>
						</div>
                    <div class="card-body">
						<form id="formsiswa" class="row g-2">
							<input type="hidden" name="kelas" value="<?= $kelas ?>" >
						<?php if($kelas<>''): ?>
						<div class="kanan">
						  <button type="submit" class="btn btn-primary kanan">Simpan</button>
							</div>
                              <?php endif; ?>       
									 <table  class="table table-bordered table-hover edis2" style="width:100%">
                                       <thead>
                                         <tr>                                                
                                         <th># &nbsp;<input type="checkbox" id="check-all"></th>
                                         <th>N I S</th>
                                         <th>NAMA SISWA</th>
										 <th>JK</th>
                                         </tr>
                                            </thead>
                                            <tbody>
                                               <?php
											$no=0;
											 $query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$dari'");
											 while ($data = mysqli_fetch_array($query)) :
											
											$no++;
											   ?>
                                                <tr> 
                                                  <td><?= $no; ?> &nbsp;<input type="checkbox" name="idsiswa[]" id="check<?= $no; ?>" class="checkbox" value="<?= $data['id_siswa'] ?>"></td>
                                                  <td><?= $data['nis'] ?></td>
												   <td><?= $data['nama'] ?></td>
												    <td><?= $data['jk'] ?></td>
                                                </tr>
												
												<?php endwhile; ?>
												</tbody>
                                                </table>
										</form>
                                    </div>
                                </div>
                            </div>
			<div class="col-md-4">  
				<div class="card">  	
				<div class="card-body">  
				<div class="d-flex align-items-center flex-column mb-4">
                <div class="d-flex align-items-center flex-column">
                 <div class="sw-13 position-relative mb-3">
                    <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
                    </div>
                <div class="h5" style="color:blue">SISWA NAIK KELAS</div>
				<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
                      <div class="text-muted">HIGH SCHOOL</div>
                    </div>
                  </div>		
						<div class="col-md-12 mb-1">
								<label class="form-label bold">Dari Kelas</label>
						   <select class="form-select dari" id="dari" required style="width: 100%">
							 <?php $level = mysqli_query($koneksi, "SELECT kelas FROM kelas"); ?>
                                <option value=''> Pilih Kelas</option>
                                <?php while ($kls = mysqli_fetch_array($level)) : ?>
                                    <option <?php if ($dari == $kls['kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                                <?php endwhile; ?>
							</select>
						</div>
						<div class="col-md-12 mb-1">
								<label class="form-label bold">Naik ke Kelas</label>
						   <select class="form-select kelas" id="kelas" required style="width: 100%">
							 <?php $level = mysqli_query($koneksi, "SELECT kelas FROM  kelas"); ?>
                                <option value=''> Pilih Kelas</option>
                                <?php while ($kls = mysqli_fetch_array($level)) : ?>
                                    <option <?php if ($kelas == $kls['kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                                <?php endwhile; ?>
							</select>
						</div>
						<div class="col-md-12">
										<button id="cari" class="btn btn-primary kanan">Cari</button>
										 </div>
								<script type="text/javascript">
                                $('#cari').click(function() {
									
                                    var dari = $('.dari').val();
                                   var kelas = $('.kelas').val();
                                    location.replace("?pg=<?= enkripsi('naik') ?>&kelas=" + kelas + "&dari=" + dari);
                                }); 
                            </script>
						</div>
					</div>
				</div>
			</div>
	
	<script>
    $('#formsiswa').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax(
		{
			type: 'POST',
             url: 'mutasi/tmutasi.php?pg=naik',
            data: data,
			cache: false,
			contentType: false,
			processData: false,
			 beforeSend: function() {
            $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
            },
			success: function(data){   		
				
					setTimeout(function()
						{
						window.location.replace("?pg=<?= enkripsi('naik') ?>");
						}, 2000);
									  
						}
					});
				return false;
			});
		</script>	
             
  <script>
$(function(){ 
 $("#check-all").click(function(){
 if ( (this).checked == true ){
 $('.checkbox').prop('checked', true);
 } else {
 $('.checkbox').prop('checked', false);
}
 });
});
</script>	  