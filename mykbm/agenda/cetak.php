<?php
defined('APK') or exit('No Access');
$bulan = date('m');
$hari = date('D');
?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">CETAK AGENDA DAN JURNAL GURU</h5>
							</div>
                            <div class="card-body">
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th>  	
										<th>TANGGAL</th>
										<th>KELAS</th>
										<th>MAPEL</th>										
                                        <th>KET</th>													
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM agenda ORDER BY id DESC"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM agenda WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td><?= $data['tanggal'] ?></td>
										<td><?= $data['kelas'] ?> </td>
										<td>
										<span class="badge bg-primary"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										<td>
										<?php if($data['hadir'] >= 50): ?>
										<h5><span class="badge bg-success">Tercapai</span></h5>
										<?php else: ?>
										<span class="badge bg-danger">Tidak Tercapai</span>
										<?php endif; ?>
										</td>
										<td>
										<?php if($data['hadir'] < 50 and $data['pemecahan']==''): ?>
										<a href="?pg=<?= enkripsi('agenda') ?>&ac=<?= enkripsi('jurnal') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Buat Jurnal"><i class="material-icons">add</i> </a>
										<?php else: ?>
										<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
										<?php endif; ?>
										<?php if($data['pemecahan']==''): ?>
										<a href="?pg=<?= enkripsi('agenda') ?>&ac=<?= enkripsi('edit') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="material-icons">edit</i> </a>
										<?php else: ?>
										<button class="btn btn-sm btn-secondary" disabled><i class="material-icons">lock</i></button>
										<?php endif; ?>
										
										</td>
                                       </tr>
										<?php endwhile; ?>
                                       </tbody>
                                    </table>	
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
										<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" class="responsive" alt="thumb" />
										</div>
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form method="GET" action="cetak/ctkjur.php"  enctype="multipart/form-data">
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="">Pilih Guru</option>  
											<?php 
											if($user['level']=='admin'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM agenda GROUP BY guru");
											elseif($user['level']=='guru'):
											$sql=mysqli_query($koneksi,"SELECT guru FROM agenda WHERE guru='$id_user' GROUP BY guru");
											endif;
											while ($data=mysqli_fetch_array($sql)) { ?>	
											<?php $peg=fetch($koneksi,'users',['id_user' => $data['guru']]); ?>
											<option value="<?= $data['guru'] ?>"><?= $peg['nama'] ?></option>
											<?php } ?>				                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                                         													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
										<label class="bold">Bulan</label>
											<select  class="form-select" name="bulan" style="width: 100%;" required >
											<?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
											<option value=""> Pilih Bulan</option>
											<?php while ($mt = mysqli_fetch_array($qt)) : ?>										
											<option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
											<?php endwhile; ?>
											</select>
										</div>
										<div class="widget-payment-request-actions m-t-lg d-flex">

                                         <button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs">CETAK</button>
                                            </div>
										</form>
									 </div>
					            </div>
								</div>
							</div>
					<script>
					$("#guru").change(function() {
						var guru = $(this).val();						
						console.log(guru);
						$.ajax({
							type: "POST",
							url: "agenda/tagenda.php?pg=ambil_kelas", 
							data: "guru=" + guru, 
							success: function(response) { 
							$("#kelas").html(response);
							console.log(response);
							}
						});
					});
					</script>
					<script>
					$("#kelas").change(function() {
						var kelas = $(this).val();
						var guru = $("#guru").val();							
						console.log(kelas + guru);
						$.ajax({
							type: "POST",
							url: "agenda/tagenda.php?pg=ambil_mapel", 
							data: "kelas=" + kelas + "&guru=" + guru, 
							success: function(response) { 
							$("#mapel").html(response);
							console.log(response);
							}
						});
					});
					</script>
             
					  <?php endif ?>
					  
					  
					  
					  	  
					  
					  
					