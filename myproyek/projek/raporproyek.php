                         
<?php
 if (empty($_GET['kelas'])) {
        $kelas = "";
    } else {
        $kelas = $_GET['kelas'];
    }
	
	?>

                             <div class="row">
								<div class="col-md-8">
									<div class="card">
										<div class="card card-header">
											<h5 class="card-title">CETAK RAPOR PROYEK <?= $kelas ?></h5>											
										</div>
										<div class="card-body">
										
										<div class="card-box table-responsive">
											<table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
												<thead>
													<tr>
														<th width="5%">NO</th>                                               
														<th>NIS</th>
														<th>NAMA SISWA</th>
														 
														 <th></th>
													</tr>
												</thead>
												<tbody>
												<?php
												
												$no=0;
												$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelas'"); 
												  while ($data = mysqli_fetch_array($query)) :												 
												   $peg = fetch($koneksi,'users',['id_user'=>$data['idguru']]);
												 $no++;
												   ?>
													<tr>
												<td><?= $no; ?></td>
												<td><?= $data['nis'] ?></td>                                                    
												<td><?= $data['nama'] ?></td>
												<td>
												
												<a href="projek/print_raport.php?nis=<?= $data['nis'] ?>" target="_blank" class="btn btn-sm btn-primary"><i class="material-icons">print</i></a>
												
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
																<div class="col-md-12">
																	<label class="form-label bold">Tingkat</label>
																<select name="level" id="level" class='form-select' required='true' style="width: 100%">
																  <option value="">Pilih Tingkat</option>
																	  <?php
																		$lev = mysqli_query($koneksi, "SELECT level,kuri FROM kelas WHERE kuri='2' GROUP BY level");
																		while ($level = mysqli_fetch_array($lev)) {
																		echo "<option value='$level[level]'>$level[level]</option>";
																		}
																		?>							
																	 </select>
																 </div>	
															   <div class="col-md-12">
																<label class="form-label bold">Rombel</label>
																<select name="kelas" id='kelas' class='form-select kelas' required='true' style="width: 100%">
																				
																	 </select>
																 </div>	<p>
																		  <div class="d-grid gap-2">
																	 <button id="cari_kelas" class="btn btn-primary flex-grow-1 m-l-xxs">CARI ROMBEL</button>
																		</div>
																		 <script type="text/javascript">
																		$('#cari_kelas').click(function() {
																		var kelas = $('.kelas').val();
																
																		location.replace("?pg=<?= enkripsi('raporproyek') ?>&kelas=" + kelas );
																		}); 
																		</script>
																		   </div>
																        </div>
																    </div>
															    </div>
															</div>
														
							<script>	
							$("#level").change(function() {
							var level = $(this).val();
							console.log(level);
							$.ajax({
							type: "POST",
							url: "projek/tnilai.php?pg=kelas", 
							data: "level=" + level, 
							success: function(response) { 
							$("#kelas").html(response);
							
									}
								});
							});
							</script>