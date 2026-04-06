<?php
defined('APK') or exit('No accsess');
?>           
<div class="row">
  <div class="col-xl-8" >
       <div class="card" >
	   <div class="card card-header" >
         <h5 class="card-title">CETAK SURAT TUGAS & SPPD</h5>
				</div>			
    <div class="card-body">
		<div class="card-box table-responsive">
           <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px;">
               <thead>
                <tr style="vertical-align:middle">
                  <th>NO</th>                                                  
				<th>NAMA PEGAWAI</th>
                 <th>KEPERLUAN</th>
				<th>TANGGAL</th>
				<th></th>
					</tr>
				</thead>
                  <tbody>
					<?php
						$no=0;
						$query = mysqli_query($koneksi, "SELECT * FROM surat_tugas ORDER BY id DESC"); 
						while ($data = mysqli_fetch_array($query)) :
						$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
											
						$no++;
						?>
                  <tr style="vertical-align:middle">
                    <td><?= $no; ?></td>
                    <td><?= $peg['nama'] ?></td>
                    <td><?= $data['keperluan'] ?></td>
					<td><?= $data['tanggal'] ?></td>
					<td>
					<a href="cetak/cetak4.php?idp=<?= $data['id'] ?>" target="_blank" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak"><i class="material-icons">print</i> </a>
					</td>
				</tr>
				<?php endwhile; ?>
					</tbody>
                </table>
			</div>
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
                  <div class="mb-5">
                    <p class="text-small text-muted mb-2">ALAMAT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="lungs" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['alamat'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="brain" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['desa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="stomach" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['kecamatan'] ?></div>
                    </div>
                  </div>

                  <div class="mb-5">
                    <p class="text-small text-muted mb-2">CONTACT</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="phone" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nowa'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="email" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['email'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="pin" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['fax'] ?></div>
                    </div>
                  </div>

                  <div class="mb-4">
                    <p class="text-small text-muted mb-2">KEPALA INSTANSI</p>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="health" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate align-middle"><?= $setting['kepsek'] ?></div>
                    </div>
                    <div class="row g-0 mb-2">
                      <div class="col-auto">
                        <div class="sw-3 me-1">
                          <i data-acorn-icon="building" class="text-primary" data-acorn-size="17"></i>
                        </div>
                      </div>
                      <div class="col text-alternate"><?= $setting['nip'] ?></div>
                    </div>
                  </div>
					<div class="card-body border-last-none">
                      
                    <br>
                  </div>
                
                </div>
              </div>
             
            </div>
   
			 </div>
			