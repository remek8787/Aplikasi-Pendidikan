<?php
defined('APK') or exit('No Access');
$datax = http_request($setting['server'] . "/sinkron/sinsis.php?token=" . $setting['token_api']);
$r = json_decode($datax, TRUE);
if ($r <> null) {
  $konek = "TERHUBUNG KE SERVER";
} else {
   $konek = "KONEKSI TERPUTUS"; 
}
?>           

                   <div class="row">
                          <div class="col-md-8">
                                <div class="card">
                                   <div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">URL SINKRON</h5></a>
										</div>
                                    <div class="card-body">
									<div class="widget-payment-request-info m-t-md">
									 <div class="d-grid gap-2">
									 <?php if($konek=="TERHUBUNG KE SERVER"): ?>
									 <button class="btn btn-success" type="button" disabled>
												<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
												&nbsp;<?= $konek ?>
											</button>
									<?php else : ?>
									<button class="btn btn-danger" type="button" disabled>
												<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
												&nbsp;<?= $konek ?>
											</button>
											<?php endif; ?>
									
											</div>
										<p>
											</div>
										</div>
										</div>
									</div>
									
					       <div class="col-md-4">
                                <div class="card widget widget-payment-request">
                                   
                                  <div id="menu-sandik2">
									<a href="#" class="logomu"><h5 class="card-title">UPDATE URL SINKRON</h5></a>
										</div>
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/guru.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name"><?= strtoupper($user['nama']) ?></span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											
									<div class="widget-payment-request-info m-t-md">
									 
									<form id='formsinkron' class="row g-1">
									
                               <div class="col-md-12">
								<label class="form-label bold">NPSN</label>
								<input type="text" name="npsn" class="form-control" value="<?= $setting['npsn'] ?>" required="true" >
							     </div>
							<p>		
								<div class="col-md-12">
								<label class="form-label bold">URL Sinkron</label>
								<input type="text" name="server" class="form-control" value="<?= $setting['server'] ?>" required="true" >
							     </div>
							<p>		
					     <div class="d-grid gap-2"> 
							<button type="submit" class="btn btn-primary flex-grow-1 m-l-xxs" id="blockui-1"><i class="material-icons">auto_mode</i>SIMPAN</button>                     								 
								 </div>
										</form>
										
										</div>
									 </div>
					            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
							<script>
    $('#formsinkron').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax(
    {
        type: 'POST',
        url: 'tarik/seturl.php',
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
			success: function(data){ 
            setTimeout(function()
            {
                window.location.reload();
            }, 2000);
		  
        }
    });
    return false;
});
</script>	
           