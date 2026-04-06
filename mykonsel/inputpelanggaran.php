<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

<?php if ($ac == ''): ?>
<div class='row'>
        <div class='col-md-8'>
             <div class="card">
             <div class="card card-header">
			  <h5 class='card-title'>INPUT PELANGGARAN</h5>
			  </div>    			
				<div class="card-body">
			<form  id="forminput" class="row g-2">
                 <div class="col-md-6">
					<label  class="bold">Tahun Pelajaran</label>
					<select  class='form-select' name="tapel" required >
					<option value="<?= $setting['tp'] ?>"><?= $setting['tp'] ?></option>
					</select>   
                    </div>						
				<div class="col-md-6">
					<label class="bold">Tanggal</label>
					<input type='text' name='tanggal' class='datepicker form-control' autocomplete='off' required='true' />
                </div>						  
				<div class="col-md-6">
				<label  class="bold">Pilih Kelas</label>
					<select  class='form-select' name="kelas" id="kelas" required >
					<option value="">Pilih Kelas</option>
					<?php $qtl = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); ?>
                    <?php while ($kls = mysqli_fetch_array($qtl)) : ?>
                     <option value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
                 <?php endwhile ?>
                </select>   
                </div>						           
				<div class="col-md-6">
				  <label  class="bold">Nama Siswa</label>
					<select  class='form-select' name="nis" id="nis" required >
					</select>   
                   </div>						  								
				<div class="col-md-6">
					<label  class="bold">Kategori</label>						
						<select  class='form-select' name="kategori" id="kategori" required >
						<option value=""></option>
						<?php $ka = mysqli_query($koneksi, "SELECT * FROM bk_kategori"); ?>
                        <?php while ($k = mysqli_fetch_array($ka)) : ?>
                        <option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
                        <?php endwhile ?>
                     </select>   
                    </div>						           
					<div class="col-md-6">
					<label  class="bold">Sub Kategori</label>
						<select  class='form-select' name="sub" id="sub" required >
						</select>   
                    </div>
					<div class="col-md-6">
					<label  class="bold">Jenis Pelanggaran</label>
						<select  class='form-select' name="jenis" id="jenis" required >
						</select>   
                     </div>
					<div class="col-md-6">
					<label  class="bold">Keterangan</label>
								<textarea name="ket" rows="3" class="form-control" required ></textarea>
							</div>
					<div class="col-md-12">	        
						<button type='submit'  class='btn btn-primary kanan'>Simpan</button>										 
				     </div>				
				</form>
			</div>
		</div>
	</div>			
			<script>
              $("#kelas").change(function() {
            var kelas = $(this).val();
            console.log(kelas);
            $.ajax({
                type: "POST",
                url: "crud_bk.php?pg=ambil_kelas", 
                data: "kelas=" + kelas, 
                success: function(response) { 
                    $("#nis").html(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
		  $("#kategori").change(function() {
            var kategori = $(this).val();
            console.log(kategori);
            $.ajax({
                type: "POST",
                url: "crud_bk.php?pg=ambil_sub", 
                data: "kategori=" + kategori, 
                success: function(response) { 
                    $("#sub").html(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
		 $("#sub").change(function() {
            var sub = $(this).val();
            console.log(sub);
            $.ajax({
                type: "POST",
                url: "crud_bk.php?pg=ambil_jenis", 
                data: "sub=" + sub, 
                success: function(response) { 
                    $("#jenis").html(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
		</script>
		<script>
		$('#forminput').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_bk.php?pg=input_bk", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
			
			},
            success: function(data) {
              
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
</script>
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
					
<?php elseif($ac == enkripsi('edit')): ?>	
<?php
			$id = dekripsi($_GET['id']);
            $bks = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bk_siswa WHERE id='$id'"));
            $siswa=fetch($koneksi,'siswa',['nis'=>$bks['nis']]);
			 $sub=fetch($koneksi,'bk_pelanggaran',['id'=>$bks['idpel']]);
			
			?>
		<div class='row'>
        <div class='col-md-12'>
             <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>EDIT PELANGGARAN</h5>
			  </div>    
			 
						<div class="card-body">
				  <form  id="formedit" class="form-horizontal" enctype='multipart/form-data'>
				  <input type="hidden" name="id" value="<?= $id ?>" >   
                   <div class="row mb-2">
					<label  class="bold">Tahun Pelajaran</label>
							<div class="col-sm-5">
							<select  class='form-select' name="tapel" required >
							 <option value="<?= $setting['tp'] ?>"><?= $setting['tp'] ?></option>
							  
                                                    </select>   
                                            </div>
						            </div>
									<div class="row mb-2">
					<label  class="bold">Tanggal</label>
							<div class="col-sm-5">
							    <input type='text' name='tanggal' class='datepicker form-control' value="<?= $bks['tanggal'] ?>" autocomplete='off' required='true' />
                                            </div>
						            </div>
							<div class="row mb-2">
					<label  class="bold">Pilih Kelas</label>
							<div class="col-sm-5">
							<select  class='form-select' name="kelas"  required >
							 <option value="<?= $siswa['kelas'] ?>"><?= $siswa['kelas'] ?></option>
	
                                                    </select>   
                                            </div>
						            </div>
									<div class="row mb-2">
					<label  class="bold">Nama Siswa</label>
									<div class="col-sm-9">
									  <select  class='form-select' name="nis" id="nis" required >
									   <option value="<?= $siswa['nis'] ?>"><?= $siswa['nama'] ?></option>
									   </select>   
                                            </div>
						            </div>									
									<div class="row mb-2">
					<label  class="bold">Jenis Pelanggaran</label>
							<div class="col-sm-9">
							<select  class='form-select' name="jenis"  required >
							 <option value="<?= $sub['id'] ?>"><?= $sub['pelanggaran'] ?></option>
							  
                                                    </select>   
                                            </div>
						            </div>
									<div class="row mb-2">
					<label  class="bold">Keterangan</label>
							<div class="col-sm-9">
								<textarea name="ket" rows="5" class="form-control" required /><?= $bks['ket'] ?></textarea>
							</div>
						            </div>
							 <div class='kanan'>
									  <button type='submit'  class='btn btn-primary'>Simpan</button>										 
											</div>		
							</form>
							 </div>
						</div>
					</div>
				</div>
			</div>
		<script>
		$('#formedit').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
             url: "crud_bk.php?pg=edit_bksiswa", 
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
            $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
                setTimeout(function() {
                    window.location.replace('?');
                }, 2000);

            }
        });
        return false;
    });
</script>			
<?php elseif($ac == enkripsi('detail')): ?>
<?php $sub = fetch($koneksi,'bk_kategori',['id'=>$_GET['id']]); ?>
		<div class='row'>
        <div class='col-md-12'>
            <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>TOTAL PELANGGARAN <span class="badge badge-danger"><?= strtoupper($sub['kategori']) ?></span></h5>
			  </div>    
			 
			
						<div class="card-body">	
						<div class='table-responsive'>
                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                              
                                    <th width='5%'>NO</th>					
                                    <th>SUB KATEGORI</th>									                                                                
                                   <th>NIS</th>
                                    <th>NAMA SISWA</th>
									<th>KELAS</th>
									 <th width="10%">TOTAL</th> 
									
									 </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select idkat,nis,idpel,idsub,tapel,SUM(poin) AS jml from bk_siswa WHERE idkat='$_GET[id]' AND tapel='$setting[tp]' GROUP BY nis");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
							$siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);
							$sub=fetch($koneksi,'bk_sub',['id'=>$bk['idsub']]);
							  $no++;
                              
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $sub['sub_kategori'] ?></td>
									<td><?= $siswa['nis'] ?></td>							                                
									<td><b style="color:blue"><?= $siswa['nama'] ?></b></td>
									<td><?= $siswa['kelas'] ?></td>
									 <td class="text-center"><h5><span class="badge badge-danger"><?= $bk['jml'] ?></span></h5></td>
									
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
					 </div>
                </div>
            </div>
        </div>
						
	<?php elseif($ac == enkripsi('rincian')): ?>
<?php $sub = fetch($koneksi,'bk_kategori',['id'=>$_GET['id']]); ?>
		<div class='row'>
        <div class='col-md-12'>
            <div class="card">
             <div class="card-header">
			  <h5 class='card-title'>RINCIAN PELANGGARAN <span class="badge badge-danger"><?= strtoupper($sub['kategori']) ?></span></h5>
			  </div>    
			 
						<div class="card-body">	
						<div class='table-responsive'>
                         <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%">
                            <thead>
                            <tr>                              
                                    <th width='5%'>NO</th>
									<th>TANGGAL</th>
                                    <th>KETERANGAN</th>									                                                                
                                   <th>NIS</th>
                                    <th>NAMA SISWA</th>
									<th>KELAS</th>
									 <th width="10%">POIN</th> 
									
									 </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from bk_siswa WHERE idkat='$_GET[id]' AND tapel='$setting[tp]'");
                            $no = 0;
                            while ($bk = mysqli_fetch_array($query)) {
							$siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);
							$sub=fetch($koneksi,'bk_sub',['id'=>$bk['idsub']]);
							  $no++;
                              
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $bk['tanggal'] ?></td>
									<td><?= $bk['ket'] ?></td>
									<td><?= $siswa['nis'] ?></td>							                                
									<td><b style="color:blue"><?= $siswa['nama'] ?></b></td>
									<td><?= $siswa['kelas'] ?></td>
									 <td class="text-center"><h5><span class="badge badge-danger"><?= $bk['poin'] ?></span></h5></td>
									
									</tr>
									<?php } ?>
                        </tbody>
                    </table>
					 </div>
                </div>
            </div>
        </div>					
						
<?php endif; ?>