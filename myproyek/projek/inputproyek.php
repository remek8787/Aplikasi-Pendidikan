<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>


<?php if ($ac == '') { ?>
<div class='row'>
	 <div class='col-md-12'>
        <div class='card' >
         <div class="card-header">
				 <h5 class="card-title">PROYEK PENGUATAN PROFIL PELAJAR PANCASILA</h5>
				<b> <span class="badge badge-secondary" style="text-align:justify">
                 Penginputan Dimensi dalam 1 Projek wajib isi sebanyak 5 Dimensi
				  </span></b>				 
			 <div class='pull-right '>
		              <a href="?pg=<?= enkripsi('inputproyek') ?>&ac=<?= enkripsi('tambah') ?>" class='btn btn-primary'><i class="material-icons">add</i> Dimensi</a>
					  <a href="." class="btn btn-light">BACK</a>	
                </div>
                  </div>
             <div class="card-body">
              
                        <table  id='datatable1' class='table table-bordered edis2' width="100%">
                            <thead >
                                <tr>
                                    <th width='5%'>No</th>
									  <th width="5%">Kelas</th>
									   <th width='10%'>Proyek</th>
          
                               		<th>Elemen</th>
									<th>Sub Elemen</th>									
									<th width="20%">Action</th>
										</tr>
									</thead>							
							<tbody>							
                                <?php
								$no = 0;
								
								 $query = mysqli_query($koneksi, "select * FROM proyek");
                            while ($p = mysqli_fetch_array($query)) {
							$pro=fetch($koneksi,'m_proyek',['id'=>$p['p_proyek']]);
							$dim=fetch($koneksi,'m_dimensi',['id_dimensi'=>$p['p_dimensi']]);
							$el=fetch($koneksi,'m_elemen',['id_elemen'=>$p['p_elemen']]);
							$sub=fetch($koneksi,'m_sub_elemen',['id_sub'=>$p['p_sub']]);
							$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai_proyek WHERE idproyek='$p[idp]'"));
							$dimensi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM proyek WHERE kelas='$p[kelas]' AND p_proyek='$p[p_proyek]'"));
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
							        <td><b style="color:blue;"><?= $p['kelas'] ?></b></td>
									<td ><b style="color:blue;"><?= $pro['ke'] ?></b></td>
									
                                   <td><?= $el['elemen'] ?></td>
								   <td><?= $sub['sub_elemen'] ?></td>
								   <td style="text-align:center">
								    <button data-id="<?= $p['idp'] ?>" class="hapus btn-sm btn btn-danger" data-bs-placement="top" data-bs-toggle="tooltip" title="Hapus Dimensi"><i class="material-icons">delete</i></button>
                                  
								   <?php if($dimensi==5): ?>
								   
                                     <?php if($nilai==0){ ?>  
										
								  <a href="?pg=<?= enkripsi('inputproyek') ?>&ac=<?= enkripsi('nilai') ?>&id=<?= enkripsi($p['idp']) ?>" class='btn btn-success btn-sm' data-bs-placement="top" data-bs-toggle="tooltip" title="Input Nilai"><i class="material-icons">add</i></a>
						         <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										   <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										  
								 <?php }else{  ?>
								  <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
								   <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										   <a href="?pg=<?= enkripsi('inputproyek') ?>&ac=<?= enkripsi('lihatnilai') ?>&id=<?= enkripsi($p['idp']) ?>" class='btn btn-success btn-sm' data-bs-placement="top" data-bs-toggle="tooltip" title="Lihat Nilai"><i class="material-icons">search</i></a>
								  <?php } ?>
								  <?php else : ?>
								  <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										  <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										  <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
										  
								  <?php endif; ?>
								   </td>
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
					</div>
                    </div>
					
					<script>
					$('#datatable1').on('click', '.hapus', function() {
					var id = $(this).data('id');
					console.log(id);
					swal({
						title: 'Are you sure?',
						text: 'Akan menghapus data ini!',
						type:'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'iya, hapus'
					}).then((result) => {
						if (result.value) {
					$.ajax({
                    url: 'projek/tproyek.php?pg=hapus_proyek',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.success({
                            title: 'Sukses!',
                              message: 'Data berhasil dihapus',
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
                });
            }
            return false;
        })

    });
	</script>
					
<?php } elseif ($ac == enkripsi('tambah')) { ?>
   <div class='row'>
	 <div class='col-md-12'>
        <div class='card' >
         <div class="card-header">
				 <h5 class="card-title">PROYEK PENGUATAN PROFIL PELAJAR PANCASILA</h5>  
				 <a href="?pg=inputproyek" class="btn btn-light pull-right">BACK</a>	
                </div>
				<div class='card-body'>
				 <span class="alert-text" style="text-align:justify">
                 Penginputan Dimensi dalam 1 Projek wajib isi sebanyak 5 Dimensi
				  </span>
				   
                        <table id='datatable1' class='table table-hover table-bordered edis2' width="100%">
                            <thead >
                                <tr>
                                    <th width='3px'>No</th>
									  <th width="5%">Kelas</th>
									    <th>Proyek</th>
                                    <th>Judul Proyek</th>  
									<th>Deskripsi</th>  
                               		<th width="5%">Jml Dimensi</th>  					  
									<th width='10%'>Action</th>
										</tr>
									</thead>							
							<tbody>							
                                <?php
								$no = 0;
								if($user['level']=='admin'):
								 $query = mysqli_query($koneksi, "select * FROM m_proyek ");
								 else:
								  $query = mysqli_query($koneksi, "select * FROM m_proyek WHERE kelas='$user[walas]' ");
								 endif;
                            while ($tjn = mysqli_fetch_array($query)) {
							$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM m_proyek WHERE kelas='$tjn[kelas]'"));
                           $dimensi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM proyek WHERE kelas='$tjn[kelas]' AND p_proyek='$tjn[id]'"));
							$no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
							        <td><?= $tjn['kelas'] ?></td>
									<td>
									<b style="color:blue;"><?= $tjn['ke'] ?></b>
									</td>
									<td ><?= $tjn['judul'] ?></td>
									<td><?= $tjn['deskripsi'] ?></td>
									<td>									
									<b style="color:blue;"><?= $dimensi ?></b>								
									</td>
                                   <td style="text-align:center">
								   <?php if($dimensi==5): ?>
								   <button type="button" class="btn btn-sm btn-secondary" disabled>
                                          <i class="material-icons" >lock</i></button>
								   <?php else: ?>
								   
                                      <a href="?pg=<?= enkripsi('inputproyek') ?>&ac=<?= enkripsi('input') ?>&id=<?= enkripsi($tjn['id']) ?>" class='btn btn-primary btn-sm' data-bs-placement="top" data-bs-toggle="tooltip" title="Pilih Proyek" ><i class="material-icons">add</i> </button></a>
								   
								   <?php endif; ?>
                                   </td>
								  
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
				</div>
                  
					
	<?php } elseif ($ac == enkripsi('input')) { ?>
	
<?php
$id= dekripsi($_GET['id']);
$proyek=fetch($koneksi,'m_proyek',['id'=>$id]);
?>
 <div class="row">
    <div class="col-md-12">
       <div class="card">
         <div class="card-header">
                 <h5 class='card-title'> INPUT DIMENSI PROYEK</h5>
				  </div>    			  
						<div class="card-body">
						<form id="formtujuan" action='' >
             
								<input type="hidden" name="proyek" value="<?= $id ?>" >	
						   <div class="row mb-3">
							<label  class="col-sm-2 control-label">Kelas</label>
							<div class="col-sm-9">
							<select name='kelas' class='form-control' style="width:30%;" readonly>
                             <option value="<?= $proyek['kelas'] ?>"><?= $proyek['kelas'] ?></option>
                               
                                                </select>
                                            </div>
                                        </div>
							 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Fase</label>
							<div class="col-sm-9">
							<select name='fase' class='form-control' style="width:30%;" readonly>
                             <option value="<?= $proyek['fase'] ?>"><?= $proyek['fase'] ?></option>
                               
                                                </select>
                                            </div>
                                        </div>
							 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Judul</label>
							<div class="col-sm-9">
							    <input type='text' name='judul' value="<?= $proyek['judul'] ?>" class='form-control' style="width:100%;" readonly />
                                            </div>
						            </div>
							 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Deskripsi</label>
							<div class="col-sm-9">
							    <input type='text' name='deskripsi' value="<?= $proyek['deskripsi'] ?>" class='form-control' style="width:100%;" readonly />
                                            </div>
						            </div>	
							
							 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Dimensi</label>
							<div class="col-sm-10">
							 <select name='dimensi' id="dimensi" class='form-select' required='true' style="width:100%;">
							 <option value=''>Pilih Dimensi</option>
							  
                                 <?php $quem = mysqli_query($koneksi, "SELECT * FROM m_dimensi"); ?>
                                     <?php while ($m = mysqli_fetch_array($quem)) : ?>
                                         <option value="<?= $m['id_dimensi'] ?>"><?= $m['dimensi'] ?></option>
                                                <?php endwhile ?>
                                                    </select>
                                                    
                                       </div>
						            </div>
								 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Elemen</label>
							<div class="col-sm-10">
							 <select name='elemen' id="elemen" class='form-select' required='true' style="width:100%;">
							 <option value=''>Pilih Elemen</option>
							  
                                </select>
                                       </div>
						            </div>
								 <div class="row mb-3">
							<label  class="col-sm-2 control-label">Sub Elemen</label>
							<div class="col-sm-10">
							 <select name='sub_elemen' id="sub_elemen" class='form-select' required='true' style="width:100%;">
							 <option value=''>Pilih Sub Elemen</option>
							  
                                </select>
                                       </div>
						            </div>
									<p>
								 <div class="row mb-3">
								<label  class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
					   <button type='submit' name='submit' class='btn btn-success kanan'><i class='fa fa-check-circle' ></i> Simpan</button>                                  
					                    </div>
										</div>
									    </form>
								            </div>
											</div>
											</div>
											
								          </div>
                                        </div>
                                    
								<script>
							  $("#dimensi").change(function() {
								var dimensi = $(this).val();
								console.log(dimensi);
								$.ajax({
									type: "POST", 
									url: "projek/tproyek.php?pg=ambil_elemen", 
									data: "dimensi=" + dimensi, 
									success: function(response) { 
										$("#elemen").html(response);
									}
								});
							});						
						</script>	
						<script>
							  $("#elemen").change(function() {
								var elemen = $(this).val();
								console.log(elemen);
								$.ajax({
									type: "POST", 
									url: "projek/tproyek.php?pg=ambil_sub_elemen", 
									data: "elemen=" + elemen, 
									success: function(response) { 
										$("#sub_elemen").html(response);
									}
								});
							});						
						</script>		
						<script>
						 $('#formtujuan').submit(function(e) {
							e.preventDefault();
							$.ajax({
								type: 'POST',
								url: 'projek/tproyek.php?pg=tambah_proyek',
								data: $(this).serialize(),
								beforeSend: function() {
								$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
								$('.progress-bar').animate({
								width: "30%"
								}, 500);	
								},
								success: function(data) {
									console.log(data);
									if (data == 'OK') {
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi("inputproyek") ?>');
										}, 2000);
									} else {
									  iziToast.info(
								{
									title: 'GAGAL!',
									message: 'Dimensi Elemen Sudah Ada',
									titleColor: '#FFFF00',
									messageColor: '#fff',
									backgroundColor: 'rgba(0, 0, 0, 0.5)',
									 progressBarColor: '#FFFF00',
									  position: 'topRight'
										});
										setTimeout(function() {
											window.location.replace('?pg=<?= enkripsi("inputproyek") ?>');
										}, 2000);
									}

								}
							});
							return false;
						});
						
						</script>
	
	<?php } elseif ($ac == enkripsi('nilai')) { ?>
	<?php 
	$id = dekripsi($_GET['id']);
	$projek=fetch($koneksi,'proyek',['idp'=>$id]); 
	$kelas=$projek['kelas'];
	$ket=fetch($koneksi,'m_proyek',['id'=>$projek['p_proyek']]);
	?>
	
   <div class="row">
    <div class="col-md-12">
       <div class="card">
         <div class="card-header">
                 <h5 class='card-title'> INPUT NILAI PROYEK <?= $kelas ?></h5>
				  </div>    			  
						<div class="card-body">
                    <h5 class='card-title'>Proyek Penguatan Profil Pelajar Pancasila <b style="color:blue;">(<?= $ket['ke'] ?>)</b></h5>                  
					<form id="formtujuan" action=''>              
                    <div class='table-responsive'>
                        <table style="font-size: 13px" id='nilai' class='table table-bordered'>
                            <thead style="background-color:#fff">
                                <tr>
                                    <th width='5%'>NO</th>
									<th>N I S</th>
									<th>NAMA SISWA</th>
									<th>ROMBEL</th>
									
								<?php
								$querys = mysqli_query($koneksi,"select * from proyek 
								JOIN m_sub_elemen ON m_sub_elemen.id_sub=proyek.p_sub
								WHERE proyek.idp='$_GET[id]' ");
								  while ($kd = mysqli_fetch_array($querys)) {
								$kelasQ = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE kelas='$kd[kelas]'"));
								
								?>
								<th style="text-align: justify;">
								<?php if($kelasQ['fase']=='A'): ?>
								<?= $kd['A'] ?>
								<?php elseif($kelasQ['fase']=='B'): ?>
								<?= $kd['B'] ?>
								<?php elseif($kelasQ['fase']=='C'): ?>
								<?= $kd['C'] ?>
								<?php elseif($kelasQ['fase']=='D'): ?>
								<?= $kd['D'] ?>
								<?php elseif($kelasQ['fase']=='E'): ?>
								<?= $kd['E'] ?>
								<?php endif; ?>
								</th>
								  <?php } ?>
							
										</tr>
									</thead>							
							<tbody>							
                                <?php
								$no = 0;
								
								 $query = mysqli_query($koneksi, "select * FROM siswa WHERE kelas='$kelas'");
                            while ($siswa = mysqli_fetch_array($query)) {
							
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
							        <td><?= $siswa['nis'] ?></td>
									<td><?= $siswa['nama'] ?></td>
									<td><?= $siswa['kelas'] ?></td>
									
									<input type="hidden" name="ids[]" value="<?= $siswa['id_siswa'] ?>">
									<input type="hidden" name="kelas[]" value="<?= $siswa['kelas'] ?>">
									<input type="hidden" name="proyek[]" value="<?= $id ?>">
									<input type="hidden" name="ketproyek[]" value="<?= $projek['p_proyek'] ?>">
									<input type="hidden" name="smt[]" value="<?= $setting['semester'] ?>">
									</td>
									<td >
									<select name='nilai[]' class='form-select' required='true'>
                                       
                                          <?php $quem = mysqli_query($koneksi, "SELECT * FROM m_nilai_proyek"); ?>
                                        <?php while ($m = mysqli_fetch_array($quem)) : ?>
                                         <option value="<?= $m['nilai'] ?>"><?= $m['ket'] ?></option>
                                         <?php endwhile ?>
                                       </select>                                            
									</td>								  
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
						<div class='kanan'>
		             <button type='submit'  class='btn btn-success'>Simpan</button>
                    </div>
					 </form>	
                    </div>
                    </div>
					</div>
                    </div>
					</div>
					<script>
	 $('#formtujuan').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
      
        $.ajax({
            type: 'POST',
            url: 'projek/tnilai.php?pg=tambah',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function() {
			$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
			$('.progress-bar').animate({
			width: "30%"
			}, 500);
			},
            success: function(data) {
               
                setTimeout(function() {
                    window.location.replace('?pg=<?= enkripsi(inputproyek) ?>');
                }, 2000);

            }
        });
        return false;
    });
	</script>
	
	<?php } elseif ($ac == enkripsi('lihatnilai')) { ?>
	<?php 
	$id= dekripsi($_GET['id']);
	$projek=fetch($koneksi,'proyek',['idp'=>$id]); 
	$kelas=$projek['kelas'];
	$ket=fetch($koneksi,'m_proyek',['id'=>$projek['p_proyek']]); 
	$dim=fetch($koneksi,'m_dimensi',['id_dimensi'=>$projek['p_dimensi']]); 
	?>
	
   <div class="row">
    <div class="col-md-12">
       <div class="card">
         <div class="card-header">
                 <h5 class='card-title'>NILAI PROYEK <?= $kelas ?></h5>
				 
                    <div class='pull-right '>
					<button id="btnkosongnilai" data-id="<?= $id ?>" class='btn btn-danger'><i class='material-icons'>delete</i> Hapus</button>   
                    <a href="?pg=<?= enkripsi('inputproyek') ?>" class="btn btn-light">BACK</a>
					</div>
               </div>    			  
						<div class="card-body">  
                    <h5 class="bold"><?= $ket['judul'] ?> <b style="color:blue;">(<?= $ket['ke'] ?>)</b> <small>Dimensi <?= $dim['dimensi'] ?></small></h5>                   
                    <div class='table-responsive'>
                        <table style="font-size: 12px" id='example1' class='table table-bordered'>
                            <thead >
                                <tr>
                                    <th width='5%'>No</th>
									<th>N I S</th>
									  <th>NAMA</th>
									  <th>ROMBEL</th>
									 
									   <?php
							$querys = mysqli_query($koneksi,"select * from proyek 
							JOIN m_sub_elemen ON m_sub_elemen.id_sub=proyek.p_sub
							WHERE idp='$id' ");
							  while ($kd = mysqli_fetch_array($querys)) {
						   $kelasQ = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa  WHERE kelas='$kd[kelas]'"));
							
							?>
							<th style="text-align: center;" >
							<?php if($kelasQ['fase']=='A'): ?>
							<?= $kd['A'] ?>
							<?php elseif($kelasQ['fase']=='B'): ?>
							<?= $kd['B'] ?>
							<?php elseif($kelasQ['fase']=='C'): ?>
							<?= $kd['C'] ?>
							<?php elseif($kelasQ['fase']=='D'): ?>
							<?= $kd['D'] ?>
							<?php elseif($kelasQ['fase']=='E'): ?>
							<?= $kd['E'] ?>
							<?php endif; ?>
							</th>
			            <?php } ?>
			            <th width="5%">Action</th>
										</tr>
									</thead>							
							<tbody>							
                                <?php
								$no = 0;
								
								 $query = mysqli_query($koneksi, "select * FROM siswa WHERE kelas='$kelas'");
                            while ($siswa = mysqli_fetch_array($query)) {
							$nl=fetch($koneksi,'nilai_proyek',['idsiswa'=>$siswa['id_siswa'],'idproyek'=>$id]);
							$keter = fetch($koneksi,'m_nilai_proyek',['nilai'=>$nl['nilai']]);
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
							        <td><?= $siswa['nis'] ?></td>
									<td><?= $siswa['nama'] ?></td>
									<td><?= $siswa['kelas'] ?></td>
									
									<td><?= $keter['nilai'] ?> ( <?= $keter['ket'] ?> )</td>
									<td>
									  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>">
                                                    <i class="material-icons">edit</i>
                                     </td>
									<div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                  <div class='modal-header'>
												  <h5 class="card-title">Edit Nilai</h5>
                                  
                                         </div>
										 <div class='modal-body'>
                                                <form id="formedit<?= $no ?>">
												<input type="hidden" name="id" value="<?= $nl['idn'] ?>" >
												
													<div class="form-group">
														  <label">Nama Siswa</label>
														<input type="text" class='form-control' value="<?= $siswa['nama'] ?>" readonly>
														 </div>   
														
														<div class="form-group">
														  <label">Kelas</label>
														<input type="text" class='form-control' value="<?= $siswa['kelas'] ?>" readonly>
														 </div>   
														
														<div class="form-group">
														  <label">Nilai Proyek</label>
														<select name='nilai' class='form-select' required='true'>
													   <option value=''></option>
														  <?php $quem = mysqli_query($koneksi, "SELECT * FROM m_nilai_proyek"); ?>
																<?php while ($m = mysqli_fetch_array($quem)) : ?>
																	<option value="<?= $m['nilai'] ?>"><?= $m['ket'] ?></option>
																<?php endwhile ?>
																	</select>
                                               
														 </div>  
											<div class="form-group">
											<label></label>
                                                <button type='submit' class='btn btn-success kanan'><i class='fa fa-check-circle'></i> Simpan</button>
                             
                                        </div>
										
                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                        $("#formedit<?= $no ?>").submit(function(e) {
                            e.preventDefault();
                          var data = new FormData(this);
      
						$.ajax({
							type: 'POST',
							url: 'projek/tproyek.php?pg=edit_nilai',
							 enctype: 'multipart/form-data',
								data: data,
								cache: false,
								contentType: false,
								processData: false,
								beforeSend: function() {
								$('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
								$('.progress-bar').animate({
								width: "30%"
								}, 500);
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
   			
								  
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
							
                    </div>
                    </div>
					</div>
                    </div>
					<script>
		$("#btnkosongnilai").click(function() {
        var id = $(this).data('id');
        swal({
            title: 'Konfirmasi ',
            text: 'Apakah akan menhapus semua nilai ini ??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'projek/tproyek.php?pg=reset',
                    data: "id=" + id,
                    type: "POST",
                    success: function(respon) {
                    $('#progressbox').html('<div><label class="sandik" style="color:blue;margin-left:80px;">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi.gif" style="width:50px;"></div>');
					$('.progress-bar').animate({
					width: "30%"
					}, 500);
                        setTimeout(function() {
                            location.replace('?pg=<?= enkripsi(inputproyek) ?>');
                        }, 2000);
                    }
                })
            }
        });
        return false;
    })
	</script>
	
	<?php } ?>