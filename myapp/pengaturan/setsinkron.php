<?php
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>

<?php if ($user['level'] == 'admin') : ?>

<div class="row">
	
		<div class="col-md-9">
			<div class="x_panel">
			<div class="x_title">
				<h2>Pengaturan <small> Sinkron Data <b>(Server Sekolah)</b></small></h2>   
                 <div class="clearfix"></div>
					</div>
				        <div class="x_content">                    
                                <form id='formedit'   enctype='multipart/form-data'>
								<div class="form-group-sm">
                              <label  class="control-label">Tanggal Sinkron</label>     
                                   <input type='text' name='tgl_sinkron'  class='datepicker form-control' autocomplete='off' required='true' />
                                    </div>
									
									
                                    <div class='form-group'>
                                        <label>&nbsp;</label><br>
                                        <button type='submit'  class='btn btn-sm btn-primary pull-right'><i class='fa fa-sync'></i> Simpan</button>
                                    </div>
                                </form>
                                   </div>
									</div>
								</div>
							
						<script>
    $('#formedit').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax(
    {
        type: 'POST',
        url: 'pengaturan/tujian.php?pg=sinkron',
        enctype: 'multipart/form-data',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){   		
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
            setTimeout(function()
            {
                window.location.reload();
            }, 2000);
		  
        }
    });
    return false;
});
</script>		
			<div class="col-md-3   widget widget_tally_box">
                        <div class="x_panel">
                          <div class="x_content" style="height:320px">

                            <div class="flex">
                              <ul class="list-inline widget_profile_box">
                                <li>
                                  <a>
                                    <i class="fa fa-facebook"></i>
                                  </a>
                                </li>
                                <li>
                                  <img src="../images/animasi1.gif" alt="..." class="img-circle profile_img">
                                </li>
                                <li>
                                 
                                </li>
                              </ul>
                            </div>

                            <h2 class="name">Jadwal Sinkron</h2>

							<div class="text-center">
                     <h2 style="color:blue;font-weight:bold"><?= date('d M Y', strtotime($setting['tgl_sinkron'])) ?><br>
					 <small>dari jam</small> <?= $setting['darijam'] ?> <small>sampai jam</small> <?= $setting['sampaijam'] ?> </h2>
                    
					</div>
					<br>
                          </div>
                        </div>
                      </div>
                     </div>

<?php endif ?>