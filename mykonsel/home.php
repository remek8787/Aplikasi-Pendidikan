<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

$kt = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_kategori"));
$skt = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sub"));
$jbk = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_pelanggaran"));
$sp1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP1' AND tapel='$setting[tp]'"));
$sp2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP2' AND tapel='$setting[tp]'"));
$sp3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_sp WHERE ket='SP3' AND tapel='$setting[tp]'"));


?>   

                      <div class="row">
							  <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">mail</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SURAT PERINGATAN 1</span>
                                                <span class="widget-stats-amount"><?= $sp1 ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-warning">
                                                <i class="material-icons-outlined">mail</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SURAT PERINGATAN 2</span>
                                                <span class="widget-stats-amount"><?= $sp2; ?></span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-danger">
                                                <i class="material-icons-outlined">mail</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">SURAT PERINGATAN 3</span>
                                                <span class="widget-stats-amount"><?= $sp3 ?> </span>
                                                <span class="widget-stats-info"></span>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
							<div class="row">
							 <?php
                            $query = mysqli_query($koneksi, "select * from bk_kategori");                          
                            while ($bk = mysqli_fetch_array($query)) {
							
                            $jml = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bk_pelanggaran
							JOIN bk_siswa ON bk_siswa.idpel=bk_pelanggaran.id
							WHERE bk_siswa.idkat='$bk[id]'"));  
							                          
                            ?>
							 
							 <div class="col-xl-4">
							  
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-success">
                                                <i class="material-icons-outlined">select_all</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title"><?= $bk['kategori'] ?></span>
                                                <span class="widget-stats-amount"><?= $jml ?></span>
                                                <span class="widget-stats-info">
												<a href="?pg=<?= enkripsi('inputbk') ?>&ac=<?= enkripsi('detail') ?>&id=<?= $bk['id'] ?>" class="btn btn-sm btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Total Pelanggaan <?= $bk['kategori'] ?>"><i class="material-icons">visibility</i></a>
												<a href="?pg=<?= enkripsi('inputbk') ?>&ac=<?= enkripsi('rincian') ?>&id=<?= $bk['id'] ?>"   class="btn btn-sm btn-danger" data-bs-placement="top" data-bs-toggle="tooltip" title="Lihat Detail"><i class="material-icons">visibility</i></a>
												</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                             </div>	
								
                           <?php } ?>
                         </div>	
						</div>
                       <div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">DATA PELANGGARAN</h5>
										<div class="pull-right">
								  <a href="?pg=<?= enkripsi('inputbk') ?>" class="btn btn-sm btn-primary kanan"><i class="material-icons">add</i> Tambah</a>		
								   </div>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                            <th>NO</th>					
											<th>TANGGAL</th>									                                                                
											<th>NAMA SISWA</th>
											 <th>KETERANGAN</th> 
											 <th>POIN</th>
											 <th width="15%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
												$query = mysqli_query($koneksi, "select * from bk_siswa WHERE tapel='$setting[tp]' ORDER BY tanggal DESC LIMIT 5");
												$no = 0;
												while ($bk = mysqli_fetch_array($query)):
												$siswa=fetch($koneksi,'siswa',['nis'=>$bk['nis']]);
												   $no++;
												  
												?>
                                                <tr>
                                                 <td><?= $no; ?></td>
												<td><?= date('d-m-Y',strtotime($bk['tanggal'])) ?>								                                
												<td><b style="color:blue"><?= $siswa['nama'] ?></b></td>
												 <td><?= $bk['ket'] ?></td>
												  <td><h5><span class="badge badge-danger"><?= $bk['poin'] ?></span></h5></td>
												<td>	
												<a href="?pg=<?= enkripsi('inputbk') ?>&ac=<?= enkripsi('edit') ?>&id=<?= enkripsi($bk['id']) ?>" class="btn btn-sm btn-success"><i class="material-icons">edit</i></a>								   
												 <button data-id="<?= $bk['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="material-icons">delete</i></button>
												</td>
                                                </tr>
												<?php endwhile; ?>
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
            title: 'Maaf Dilarang Hapus Data',
            text: 'silahkan gunakan menu Reset',
			type:'warning',
			showConfirmButton: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                   url: 'bk/crud_bk.php?pg=hapus_siswa',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                iziToast.info(
					{
					title: 'Sukses!',
					message: 'Data berhasil disimpan',
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
	  