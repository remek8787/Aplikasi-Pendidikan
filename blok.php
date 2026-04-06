<?php
require("konek/koneksi.php");
require("konek/function.php");

?>
<!DOCTYPE html>
<html lang="en" translate="no">
<head>
  <title><?= $setting['sekolah'] ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
 <link href="images/<?php echo $setting['logo'] ?>" rel="shortcut icon" />
	<link rel="stylesheet" href="vendor/bootstrap-4/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/all.css">
	 <link rel='stylesheet' href='assets/plugins/sweetalert/css/sweetalert2.min.css'>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap-4/js/popper.min.js"></script>
	<script src="vendor/bootstrap-4/js/bootstrap.min.js"></script>
  
</head>
<style>
.edis {
  background-size: 200px;
  background-image: url("images/tutwuri2.png");
  background-repeat: no-repeat;
  background-position: top right; 
  
}

    </style>

<body>

<div class="container-fluid text-white" style="background:#326698;background-size: contain;background-image: url('vendor/bg-top.png');background-repeat: no-repeat;background-position: left; height:130px;position:fixed;top:0px;left:0px;right:0px">
	  <div class="row">
		<div class="col pl-5 pt-1">
			<table>
				<tr>
					<td>
						<img style="margin:5px;height:70px" src="images/<?php echo $setting['logo'] ?>">
					</td>
					<td>
						<div><b>SANDIK MULTI SEKOLAH</b></div>
						<div><small>SISTEM APLIKASI PENDIDIK<small></div>
					</td>
				</tr>
			</table>
		</div>
	  </div>
</div>

<div class="wrapper fadeInDown"  style="margin-top:90px;">
  <div id="formContent">
  <div class="edis">
    <div class="fadeIn text-left p-5">
	
      <div><b>OOPSS</b></div>
      <div><small>Silakan Gunakan Google Chrome</small></div>
	
		 
		  
    </div>
	 
  </div> 
</div>


</div>

<script type="text/javascript" src="vendor/assets/js/jquery.min.js"></script>
<style>
	

	.wrapper {
	  display: flex;
	  align-items: center;
	  flex-direction: column; 
	  justify-content: center;
	  width: 100%;
	  min-height: 100%;
	  padding: 10px;
	  margin-top:-80px;
	}

	#formContent {
	  -webkit-border-radius: 10px 10px 10px 10px;
	  border-radius: 10px 10px 10px 10px;
	  background: #fff;
	  padding: 5px;
	  width: 100%;
	  max-width: 550px;
	  position: relative;
	  padding: 0px;
	  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
	  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
	  text-align: center;
	}

	


	/* TABS */

	h2.inactive {
	  color: #cccccc;
	}

	h2.active {
	  color: #0d0d0d;
	  border-bottom: 2px solid #5fbae9;
	}
	
	input[type=text] {
	  border: none;
	  color: #0d0d0d;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  border-radius:0px;
	  border-bottom:2px solid #eee;
	}
	input[type=password] {
	  border: none;
	  color: #0d0d0d;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  border-radius:0px;
	  border-bottom:2px solid #eee;
	}

	/* ANIMATIONS */

	/* Simple CSS3 Fade-in-down Animation */
	.fadeInDown {
	  -webkit-animation-name: fadeInDown;
	  animation-name: fadeInDown;
	  -webkit-animation-duration: 1s;
	  animation-duration: 1s;
	  -webkit-animation-fill-mode: both;
	  animation-fill-mode: both;
	}

	@-webkit-keyframes fadeInDown {
	  0% {
		opacity: 0;
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
	  }
	  100% {
		opacity: 1;
		-webkit-transform: none;
		transform: none;
	  }
	}

	@keyframes fadeInDown {
	  0% {
		opacity: 0;
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
	  }
	  100% {
		opacity: 1;
		-webkit-transform: none;
		transform: none;
	  }
	}

	
</style>
<script src='assets/plugins/sweetalert/js/sweetalert2.min.js'></script>
<script src="dist/vendor/jquery/jquery-3.2.1.min.js"></script>

	
  

</body>
</html>
