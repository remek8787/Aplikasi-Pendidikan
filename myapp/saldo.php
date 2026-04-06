<?php
defined('APK') or exit('No accsess');
?>           
<div class="row">
  <div class="col-xl-8" >
       <div class="card" >
	   <div class="card card-header" >
         <h5 class="card-title">HISTORY PAYMENT</h5>
				</div>			
    <div class="card-body">
		<div class="card-box table-responsive">
           <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px;">
               <thead>
                <tr style="vertical-align:middle">
                  <th>NO</th>                                               
                  <th>TANGGAL</th>
                  <th>JAM</th>
				  <th>DEBET</th>
				  <th>KREDIT</th>
					</tr>
				</thead>
                  <tbody>
					<?php
					$no=0;
					$query = mysqli_query($koneksi, "SELECT * FROM saldo WHERE idpeg='$user[id_user]'"); 
					while ($data = mysqli_fetch_assoc($query)) :
					$no++;
					?>
                  <tr style="vertical-align:middle">
                    <td><?= $no; ?></td>
                    <td><?= date('d-m-Y',strtotime($data['tanggal'])) ?></td>
                    <td><?= $data['jam'] ?></td>
					<td style="text-align:right"><?= number_format($data['debet']) ?></td>
					<td style="text-align:right"><?= number_format($data['kredit']) ?></td>
				</tr>
				<?php endwhile; ?>
					</tbody>
                </table>
			</div>
		</div>
	</div>
</div>
				
		<div class="col-xl-4">
            <div class="card widget widget-payment-request">
                <div class="card-header">
					 <h5 class="card-title">SALDO KU</h5>
                    </div>
                <div class="card-body">
                    <div class="widget-payment-request-container">
                    <div class="widget-payment-request-author">
                    <div class="avatar m-r-sm">
                        <img src="../images/icon/payment.ico" alt="">
                            </div>
                       <div class="widget-payment-request-author-info">
					   <p></p>
                          <span class="widget-payment-request-author-name bold">RP. <?= number_format($user['saldo']) ?></span>
                          <span class="widget-payment-request-author-about">CARD : <?= $user['nokartu'] ?></span>
						  
                            </div>
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
					 
	