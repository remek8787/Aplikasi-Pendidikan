<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>           
			   <?php if ($ac == '') : ?>
					<div class="row">
                          <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">LAPORAN DATA PEMBAYARAN</h5>
										<div class="pull-right">
										<a href="?pg=<?= enkripsi('trx') ?>&ac=cetak" class="btn btn-primary"><i class="material-icons">print</i>CETAK</a>
										</div>
                                    </div>
                                    <div class="card-body">
									
									<div class="card-box table-responsive">
                                        <table id="datatable1" class="table table-bordered table-hover edis" style="width:100%;font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th width="5%">NO</th> 
                                                    <th>TANGGAL</th>													
                                                    <th>NAMA PEMBAYARAN | MODE</th>
													
                                                    <th>NAMA SISWA</th>
													  <th>KELAS</th>
													  <th>BAYAR RP</th>
													  <th>KE</th>
													 
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$no=0;
											$query = mysqli_query($koneksi, "SELECT * FROM trx_bayar ORDER BY id DESC"); 
											  while ($data = mysqli_fetch_array($query)) :
											  $siswa = fetch($koneksi,'siswa',['id_siswa'=>$data['idsiswa']]);
											   $kode = fetch($koneksi,'m_bayar',['id'=>$data['idbayar']]);
											   $jumbayar =  mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(bayar) AS jbyr FROM trx_bayar WHERE idsiswa='$data[idsiswa]' AND idbayar='$kode[id]'"));
											   $sisa = $kode['total']-$jumbayar['jbyr'];
											   if($kode['model']=='1'){
												   $model = 'Sekali Bayar';
											   }else{
												   $model = 'Bulanan';
											   }
											$no++;
											   ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
													<td><?= date('d-m-Y',strtotime($data['tanggal'])) ?></td>
                                                    <td><?= $kode['nama'] ?><h5><span class="badge badge-primary">RP. <?= number_format($kode['total']) ?></span><span class="badge badge-warning"><?= $model ?></span></h5></td>
													 
                                                     <td><?= $siswa['nama'] ?>
													 <?php if($sisa==0): ?>
													 <h5><span class="badge badge-success">LUNAS</span></h5>
													  <?php else : ?>
													  <h5><span class="badge badge-danger">SISA RP. <?= number_format($sisa) ?></span></h5>
													  <?php endif; ?>
													  </td>
													  <td><h5><span class="badge badge-primary"><?= $siswa['kelas'] ?></span></h5></td>
													  <td><h5><span class="badge badge-secondary"><?= number_format($data['bayar']) ?></span></h5></td>
													   <td><h5><span class="badge badge-dark"><?= $data['ke'] ?></span></h5></td>
                                                </tr>
												<?php endwhile; ?>
												<tbody>
                                                </table>
												 </div>
											</div>
										</div>
									</div>
								</div>
							<?php elseif($ac == 'cetak'): ?>	
								<div class="row">
                          <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">CETAK DATA PEMBAYARAN</h5>
									</div>
                                    <div class="card-body">
									<p>
			         <form id="formsiswa" action='cetak/cetakbayar.php' target="_blank" method='post' class="row g-1" enctype='multipart/form-data'>
					
						<div class="col-md-12">
								<label class="form-label bold">JENIS PEMBAYARAN</label>
						   <select class="form-select" name="jenis" required style="width: 100%">
							  <option value='' selected>Pilih Jenis</option>
							  <?php
										$lev = mysqli_query($koneksi, "SELECT * FROM m_bayar");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[id]'>$level[nama]</option>";
										}
										?>
							</select>
						</div>	   
							   <div class="col-md-12">
								<label class="form-label bold">BULAN</label>
							<select name="bulan"  class="form-select" style="width: 100%;" required >
										  <option value=''>Pilih Bulan</option>
											 <?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
											   <?php while ($mt = mysqli_fetch_array($qt)) : ?>
												 <option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
													<?php endwhile ?>
													   </select>   
						</div>
						
						<div class="col-md-12">
								<label class="form-label bold">KELAS / ROMBEL</label>
						   <select class="form-select" name="kelas" required style="width: 100%">
							  <option value='' selected>Pilih Kelas</option>
							  <?php
										$kls = mysqli_query($koneksi, "SELECT * FROM siswa group by kelas");
										while ($kelas = mysqli_fetch_array($kls)) {
										echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
										}
										?>
							</select>
						</div>
                   
						
						<div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">CETAK</button>
										 </div>
											   </form>
			                               </div>
										</div>
									</div>
								
								 <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">CETAK REKAP PEMBAYARAN</h5>
									</div>
                                    <div class="card-body">
									<p>
			         <form id="formsiswa" action='cetak/cetakrekap.php' target="_blank" method='post' class="row g-1" enctype='multipart/form-data'>
					
						<div class="col-md-12">
								<label class="form-label bold">JENIS PEMBAYARAN</label>
						   <select class="form-select" name="jenis" required style="width: 100%">
							  <option value='' selected>Pilih Jenis</option>
							  <?php
										$lev = mysqli_query($koneksi, "SELECT * FROM m_bayar");
										while ($level = mysqli_fetch_array($lev)) {
										echo "<option value='$level[id]'>$level[nama]</option>";
										}
										?>
							</select>
						</div>	   
							   <div class="col-md-12">
								<label class="form-label bold">BULAN</label>
							<select name="bulan"  class="form-select" style="width: 100%;" required >
										  <option value=''>Pilih Bulan</option>
											 <?php $qt = mysqli_query($koneksi, "SELECT * FROM bulan"); ?>
											   <?php while ($mt = mysqli_fetch_array($qt)) : ?>
												 <option value="<?= $mt['bln'] ?>"><?= $mt['ket'] ?> <?= date('Y') ?></option>
													<?php endwhile ?>
													   </select>   
						</div>
						
						
						
						<div class="col-md-12">
										<button type="submit" class="btn btn-primary kanan">CETAK</button>
										 </div>
											   </form>
			                               </div>
										</div>
									</div>
								</div>
							</div>
							</div>	
								 <?php endif; ?>		 