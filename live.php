<?php
require("konek/koneksi.php");
require("konek/function.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8" />
       <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
       <title><?= $setting['sekolah'] ?></title>
		<meta name="description" content="Sandik All in One">
		<meta name="keywords" content="sandik"/>
		<meta name="msapplication-navbutton-color" content="#4285f4">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">
		<link href="font/material.css" rel="stylesheet">
		<link rel='stylesheet' href='vendor/fontawesome/css/all.css' />
        <link href="botstrap-login/css/front.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="botstrap-login/css/1.css">
		<link rel="stylesheet" href="botstrap-login/css/2.css">
		<link rel="stylesheet" href="botstrap-login/css/3.css">
		<link rel="stylesheet" href="botstrap-login/css/components2.css">
		<link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
		<link href="assets/plugins/pace/pace.css" rel="stylesheet">
		<link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">
		<link href="assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
		<link rel='stylesheet' href="assets/izitoast/css/iziToast.min.css">
		 <link rel="stylesheet" href="<?= $baseurl ?>/assets/css/sweetalert2.min.css">
		<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
		<link href="assets/css/main.css" rel="stylesheet">    
		<link rel="icon" type="image/png" sizes="32x32" href="images/<?= $setting['logo'] ?>" />
       <link rel="icon" type="image/png" sizes="16x16" href="images/<?= $setting['logo'] ?>" />
<style type="text/css">
	   .bold { font-weight: bold; }
	   .pull-right{
		float: right;
		display: block;
		margin-top:-30px;
	  }
</style> 	
	<style>
body {

  overflow: hidden; /* Hide scrollbars */
}
</style>	

</head>
<body>

   
       <div class="home-wrapper" id="home">
             <div class="home-header" style="background-image: url('vendor/bgk.jpg');background-repeat: no-repeat;">
                <div class="container p-0" >
                     <nav class="navbar navbar-expand-lg navbar-light" id="navbar-header" style="background:none;" >
                        <a class="navbar-brand" href="javascript:;" >
                            <img src="images/<?= $setting['logo'] ?>" height="65" />
                            <div class="home-header-text d-none d-sm-block" >
                                <h5 style="color:#fff;">SISTEM APLIKASI PENDIDIK</h5>
                                <h6 style="color:#fff;"><?= $setting['sekolah'] ?></h6>
                                <h6 style="color:#fff;">TAHUN PELAJARAN <?= $setting['tp'] ?></h6>
                            </div>
                            <span class="logo-mini d-block d-md-none" style="color:#fff;">SANDIK</span>
                            <span class="logo-mini d-block d-md-none" style="color:#fff;">&nbsp;&nbsp;<?= $setting['tp'] ?></span>
                        </a>
                         <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                       
                    </nav>
                </div>
            </div>
		 
            <div class="home-banner">
               
				<div class="home-banner-bg home-banner-bg-color"></div>        
				<div class="home-banner-bg home-banner-bg-img"></div>
				  <div class="row">
						<div class="col-md-12">
				
					<div class="card-body">
						 <div class="row">
						 <div class="col-md-4">
						<div class="card" >
					<div class="card-body" style="background-color:#556;color:#fff;height:220px">
					    	<div  style="overflow-y:scroll; height:180px;">
						 <div id='log' ></div>
						  </div>
						   </div>
				</div>
				</div>
				 <div class="col-md-4">
				 <div class="card" >
					<div class="card-body" style="background-color:#556;color:#fff;height:220px">
				   <div id='logkbm' ></div>
				 </div>
				  </div>
				</div>
				 <div class="col-md-4">
				 <div class="card" >
					<div class="card-body" style="background-color:#556;color:#fff;height:220px">
				   <div id='byr' ></div>
				 </div>
				</div>
				  </div>
				</div>
				</div>
				</div>
				</div>
                <div class="row">
						<div class="col-md-12">				
					<div class="card-body">
                     <div class="row">
						<div class="col-md-4">
						
                            <div id='logabs' ></div> 
                            </div>
							
                        
                       <div class="col-md-4">
							
                              <div id='logabsen' ></div>
                                 
                           
                                </div>
                           
							 <div class="col-md-4">
							 <div class="card" >
							<div class="card-body" style="background-color:#556;color:#fff">
							<div  style="overflow-y:scroll; height:310px;">
                              <div id='trx' ></div>
                                 </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			</div>
		</div>
	
		 <script src="botstrap-login/js/jquery.form.min.js"></script>
        <script src="botstrap-login/js/bootstrap.min.js"></script>
        <script src="botstrap-login/js/popper.min.js"></script>	
		<script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/plugins/pace/pace.min.js"></script>
        <script src="botstrap-login/js/wow.min.js"></script>
        <script src='assets/izitoast/js/iziToast.min.js'></script>
        <script src="botstrap-login/js/front.min.js"></script>
		<script src="assets/js/main.min.js"></script>
         <script src="assets/js/custom.js"></script>
		 <script src="<?= $baseurl ?>/assets/js/sweetalert2.min.js"></script>
<script>
var autoRefresh = setInterval(
function() {
$('#log').load('log/log.php');
$('#logkbm').load('log/logkbm.php');
$('#logabs').load('log/logabsen.php');
$('#logabsen').load('log/logsis.php');
$("#trx").load('log/logtrx.php');
$("#byr").load('log/logbayar.php');									
}, 1000
);
</script>
    
 <script type="text/javascript">
   var elem = document.documentElement;

        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
               
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
            
                elem = window.top.document.body; 
                elem.msRequestFullscreen();
            }
        }
		swal({
            title: 'LIVE PRESENSI',
            html: 'BUKA FULL SCREEN',
           
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen();
            }
        })
</script> 
 
    </body>
</html>

		