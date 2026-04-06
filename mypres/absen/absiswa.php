<?php
defined('APK') or exit('No Access');
 if (empty($_GET['kelas'])) {
        $kelas = "";
    }else {
        $kelas = $_GET['kelas'];
    }
?> 
<style>


.table-wrapper {
    overflow: auto;
}

.text-center {
    text-align: center;
}

.table-siswa, .table-date {
    border-collapse: collapse;
    width: 100%;
    margin: 0;
    padding: 0;
}

.table-siswa td {
    border: 1px solid silver;
    position: relative;
    padding: 5px;
}

.td-date .date {
    display: inline-block;
    width: 25px;
}

.label-checkbox {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    height: 100%;
    display: block;
    vertical-align: middle;
    background: #cecece;
}

.label-checkbox:hover {
    background: #bff8ff;
}

.label-checkbox input {
    margin: 0;
    -webkit-appearance: none;
    height: 100%;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    width: 100%;
    border: 0;
    cursor: pointer;
    outline: none;
}

.label-checkbox.active, .label-checkbox.active input, .label-checkbox input:checked {
    background: #2196F3;
}

.label-checkbox.active::before {
    content: "✓";
    display: block;
    position: absolute;
    z-index: 5;
    color: #fff;
    top: 15%;
    left: 35%;
}


.box-color {
    display: inline-block;
    width: 1em;
    height: 1em;
    vertical-align: middle;
}

.box-color.true {
   background: #2196F3;
}

.box-color.false {
   background: #cecece;
}
</style>          
	<?php if ($ac == '') : ?>
                   <div class="row">
                        <div class="col-xl-8">
							<div class="card">
							<div class="card card-header">
								<h5 class="card-title bold">INPUT MANUAL</h5>
                                </div>
                                    <div class="card-body">	
                                   	<form id="formabsen">
										<input type="hidden" name="kelasmu" value="<?= $kelas; ?>">
									<div class="table-wrapper">
                                      <table class="table-siswa">
                                            <thead>
                                            <tr>
                                            <td width="10%" class="text-center bold">NO</td>
											<td class="text-center bold">N I S</td>
                                            <td class="text-center bold">NAMA LENGKAP</td>
											<td class="text-center bold">JK</td>
											<td width="6%" class="text-center bold">S</td>  
											<td width="6%" class="text-center bold">I</td>  
											<td width="6%" class="text-center bold">A</td>  
                                            </tr>
												
                                            </thead>
                                            <tbody class="table-body-content">
											<?php
											$no=0;	
											$tgl_lusa =date('Y-m-d', strtotime("-3 day", $tanggal));
											$query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE kelas='$kelas' AND NOT EXISTS(SELECT * FROM absensi WHERE siswa.id_siswa=absensi.idsiswa AND absensi.tanggal='$tanggal') and blok='0'");
											while ($data = mysqli_fetch_array($query)) :	
											
											$no++;
											   ?>
                                                <tr>
												<input type="hidden" name="tanggal[]" value="<?= date('Y-m-d') ?>" >
													  <input type="hidden" name="kelas[]" value="<?= $data['kelas'] ?>" >
													  <input type="hidden" name="level[]" value="siswa" >
													   <input type="hidden" name="bulan[]" value="<?= date('m') ?>" >
													   <input type="hidden" name="tahun[]" value="<?= date('Y') ?>" >
													  
                                                    <td><?= $no; ?> <input type='checkbox' name='idsiswa[]' value="<?= $data['id_siswa'] ?>"  ></td>                          
                                                     <td class="text-center"><?= $data['nis'] ?></td>
                                                     <td><?= $data['nama'] ?></td>
													  <td class="text-center"><?= $data['jk'] ?></td>
													 <td><label class='label-checkbox'><input type='radio' name='ket[]<?= $data['id_siswa'] ?>' value="S" required></label></td>
													 <td><label class='label-checkbox'><input type='radio' name='ket[]<?= $data['id_siswa'] ?>'value="I"  required></label></td>
													 <td><label class='label-checkbox'><input type='radio' name='ket[]<?= $data['id_siswa'] ?>' value="A"  required></label></td>
                                                </tr>
												<?php endwhile; ?>
												
												</tbody>
                                                </table>
												<?php if($kelas<>''): ?>
												<br><div class="kanan">
												<button type="submit" class="btn btn-primary">SIMPAN</button>
												</div>
												<?php endif; ?>
												 </div>
												 </form>
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
									 <div class="col-md-12">  													
											<label class="bold">KELAS</label>                               
										   <select class="form-select kelas">
												<?php $level = mysqli_query($koneksi, "SELECT kelas FROM siswa GROUP BY kelas"); ?>
												<option value=''> Pilih Kelas</option>
												<?php while ($kls = mysqli_fetch_array($level)) : ?>
													<option <?php if ($kelas == $kls['kelas']) {
																echo "selected";
															} else {
															} ?> value="<?= $kls['kelas'] ?>"><?= $kls['kelas'] ?></option>
												<?php endwhile; ?>
														</select>
												</div>	
											<div class="col-md-12 mb-4">																								
										  <button id="pilih"  class="btn btn-primary kanan">PILIH</button>
										</div>	
										<br>
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
									
								<script type="text/javascript">
                                $('#pilih').click(function() {
                                var kelas = $('.kelas').val();
                                location.replace("?pg=<?= enkripsi('insis') ?>&kelas=" + kelas);
                                }); 
								</script>
							
								<script>
								$('#formabsen').submit(function(e){
									e.preventDefault();
									var data = new FormData(this);
									$.ajax(
									{
										type: 'POST',
										 url: 'absen/input.php',
										data: data,
										cache: false,
										contentType: false,
										processData: false,
										beforeSend: function() {
										$('#progressbox').html('<div><img src="<?= $baseurl ?>/images/animasi.gif" style="width:50px;"></div>');
										
										},
															
										success: function(data){   		
										setTimeout(function()
											{
											window.location.replace('?pg=<?=enkripsi("presis") ?>');
													}, 2000);
																  
													}
												});
											return false;
										});
									</script>				
     
							<?php endif ?>
							<script>
							$(document).ready(function(){

							  var tableDate = "";
							  var tableContent =  "";
							  var $td =  "";
							  
							  
							  for(var i=1; i<=3; i++){
									tableDate += "<td class='td-date text-center'><b class='date'>"+ i +"</b></td>";
								}
								
							  $( tableDate ).prependTo( ".table-row-head" );
								

							  for(var i=1; i<=3; i++){
									tableContent += "<td class='text-center' data-date='"+ i +"'>"+ $label +"</td>";
							  }
							 
							  $( tableContent ).appendTo( ".table-body-content tr" );
								
							  for(var td=1; td<=2; td++){
									$td += "<td class='text-center' data-info='"+ td +"'</td>";
							  }
							  
							  
							  $( document ).on( "change", ".label-checkbox", function(){
								$( this ).toggleClass( "active" );
								checkData();
							  });
								
								
							});

							function checkData(){
							  $( ".label-checkbox" ).each(function(){
								var $parents  = $( this ).parents( "tr" );
								var $checked      = $parents.find( "input:checked" ).length;
								var $no_checked   = $parents.find( "input" ).length;
								var $true = $checked;
								var $false = [ $no_checked - $checked];
							  
								$parents.find( "[data-info='1']" ).html( $true );
								$parents.find( "[data-info='2']" ).html( $false );   
							  });
							}

							$( document ).ready(function(){
							  checkData();
							});

							</script>