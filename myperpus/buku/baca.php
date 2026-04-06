<?php
defined('APK') or exit('No Access');
?>           
		<?php if ($ac == '') : ?>	   
		<div class="row">
           <?php
			$query = mysqli_query($koneksi, "SELECT * FROM digital"); 
			while ($data = mysqli_fetch_array($query)) :
			$jbaca = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM digital_baca WHERE idbuku='$data[id]'"));
		 ?> 
          <div class="col-md-3">
            <div class="card">                                
            <div class="card-body">
			<div class="d-flex align-items-center flex-column">
				<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">
					<img src="<?= $baseurl ?>/buku/images/<?= $data['ikon'] ?>" style="max-width:190px;" alt="thumb" />
				</div>
			<div class="h5 mb-0"><?= $data['judul'] ?></div>
			<div class="text-muted">DIBACA <?= $jbaca ?> X</div>
			
                 <a href="?pg=<?= enkripsi('baca') ?>&ac=<?= enkripsi('lihat') ?>&id=<?= $data['id'] ?>" class="btn btn-sm btn-link"><i class="material-icons">visibility</i> Lihat</a>
               		 
				</div>
			</div>
			</div>
			</div>
			</div>
        <?php endwhile; ?>
    </div>		
	 <?php elseif($ac == enkripsi('lihat')): ?>	
	  <?php $buku = fetch($koneksi,'digital',['id'=>$_GET['id']]);?> 
					<div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                    <div class="card card-header">
                                        <h5 class="card-title">PEMBACA BUKU <?= strtoupper($buku['judul']) ?></h5>
										
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th>                                               
                                                    <th>NAMA SISWA</th>
													<th>KELAS</th>
                                                    <th>TANGGAL</th>
													  <th>JAM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM digital_baca WHERE idbuku='$_GET[id]' ORDER BY id DESC"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $siswa['nama'] ?></td>
													 <td><?= $siswa['kelas'] ?></td>
                                                     <td><?= $data['tanggal'] ?></td>
													  <td><?= $data['jam'] ?></td>
													  
                                                </tr>
												<?php endwhile; ?>
												</tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
	       
          <div class="col-md-4">
                                     
            <div class="card-body">
			<div class="d-flex align-items-center flex-column">
				<div class="d-flex align-items-center flex-column">
				<div class="sw-13 position-relative mb-3">
					<img src="<?= $baseurl ?>/buku/images/<?= $buku['ikon'] ?>" style="max-width:250px;" alt="thumb" />
				</div>
				
			<div class="h5 mb-0"><?= $buku['judul'] ?></div>
			<div class="text-muted"><?= $buku['deskripsi'] ?></div>
			<div class="text-muted"><?= $buku['guru'] ?> <?= $buku['tanggal'] ?> <?= $buku['jam'] ?></div>
			
			 </div>
			</div>
		</div>
	   </div>
    </div>		
	 
								<?php endif ?>
				