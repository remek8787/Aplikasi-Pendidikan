<?php
defined('APK') or exit('No Access');
 if (empty($_GET['id'])) {
$id = "";
	}else{
 $id = $_GET['id'];
	}
	$dt = fetch($koneksi,'rpp',['id'=>$id]);
	$peg = fetch($koneksi,'users',['id_user'=>$dt['guru']]);
	$plj = fetch($koneksi,'mapel',['id'=>$dt['mapel']]);
?>           
	
                   <div class="row">
                      <div class="col-md-8">
                        <div class="card">
                             <div class="card card-header">       
							<h5 class="card-title">CETAK RPP MODEL 1</h5>
							</div>
                            <div class="card-body">
								<div class="card-box table-responsive">
                                    <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                       <thead>
                                       <tr>
                                        <th>#</th> 
										<th>SMT-MAPEL</th>
										<th>KD-3</th>
										<th>KD-4</th>										                                      													
										<th></th>
                                       </tr>
                                       </thead>
                                       <tbody>
										<?php
										$no=0;
										if($user['level']=='admin'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp"); 
										elseif($user['level']=='guru'):
										$query = mysqli_query($koneksi, "SELECT * FROM rpp WHERE guru='$id_user'"); 
										endif;
										while ($data = mysqli_fetch_array($query)) :
										$mpl = fetch($koneksi,'mapel',['id'=>$data['mapel']]);
										$peg = fetch($koneksi,'users',['id_user'=>$data['guru']]);
										$no++;
										?>
                                       <tr>
                                        <td><?= $no; ?></td>
										<td>
										<span class="badge bg-primary"><?= $data['smt'] ?></span>
										<span class="badge bg-success"><?= $mpl['kode'] ?></span>
										<span class="badge bg-dark"><?= $peg['nama'] ?></span>
										</td>
										
										<td>3.<?= $data['kd'] ?> <?= $data['des3'] ?></td>
										<td>4.<?= $data['kd'] ?> <?= $data['des4'] ?></td>
										<td>										
										<a href="?pg=<?= enkripsi('crpp1') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak"><i class="material-icons">print</i> </a>
										</td>
                                       </tr>
										<?php endwhile; ?>
                                       </tbody>
                                    </table>	
								</div>
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
									<div class="h5 mb-0"><?= $setting['sekolah'] ?></div>
										  <div class="text-muted">HIGH SCHOOL</div>
										</div>
									  </div>
									<form id='formcp'  method="GET" target="_blank" action="kurtilas/rpp1.php"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?= $id; ?>" >
									<div class="col-md-12 mb-1">
									  <label class="bold">Semester</label>
                                       <select name="smt"  id="smt"  class='form-select' style='width:100%' required="true" > 
									   <option value="<?= $dt['smt'] ?>"><?= $dt['smt'] ?></option>
									  
									    </select>
                                       </div>
										
									<div class="col-md-12 mb-1">
									   <label class="bold">Guru</label>
											<select name="guru" id="guru" class='form-select' style='width:100%' required="true" >                                         
											<option value="<?= $dt['guru'] ?>"><?= $peg['nama'] ?></option>  
												                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Tingkat</label>
											<select name="level" id="level" class='form-select' style='width:100%' required="true" >                           
											<option value="<?= $dt['level'] ?>"><?= $dt['level'] ?></option>
												                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Mapel</label>
											<select name="mapel" id="mapel" class='form-select' style='width:100%' required="true" >                           
										<option value="<?= $dt['mapel'] ?>"><?= $plj['nama_mapel'] ?></option>
													                                           
											 </select>
                                        </div>
										<div class="col-md-12 mb-1">
											<label class="bold">Kelas</label>
											<select name="kelas" id="kelas" class='form-select' style='width:100%' required="true" >                           
											
											<?php 
											$que=mysqli_query($koneksi,"SELECT level,kelas FROM kelas WHERE level='$dt[level]'");
											while ($lev=mysqli_fetch_array($que)) { ?>										
											<option value="<?= $lev['kelas'] ?>"><?= $lev['kelas'] ?></option>
											<?php } ?>				                                           
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
					  
					