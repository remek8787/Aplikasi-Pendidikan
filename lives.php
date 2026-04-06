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
		<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
		 <link rel="stylesheet" href="<?= $baseurl ?>/assets/css/sweetalert2.min.css">
		<link href="assets/css/main.css" rel="stylesheet">    
		<link rel="icon" type="image/png" sizes="32x32" href="images/<?= $setting['logo'] ?>" />
       <link rel="icon" type="image/png" sizes="16x16" href="images/<?= $setting['logo'] ?>" />
<link rel="stylesheet" type="text/css" href="face/style.css">
  <script src="face/jquery.min.js"></script>
  <script src="face/bootstrap.min.js"></script>
  <script src="face/face-api.js"></script>
  <style>
video {
  max-width: 100%;
  height: auto;
}
canvas {
  max-width: 100%;
  height: auto;
}
.tengah{
	text-align:center;
	
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
            <div class="home-header" style=" background-image: url('vendor/bgk.jpg');background-repeat: no-repeat;">
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
		 
            <div class="home-banner" style="color:#fff">
               	<div class="home-banner-bg home-banner-bg-color"></div>        
				<div class="home-banner-bg home-banner-bg-img"></div>
             
				  <div class="row">
						<div class="col-md-12">
				
					<div class="card-body">
						 <div class="row">
						 <div class="col-md-6">		
		<div id="parent1"  style="float:left;">
        <video id="vidDisplay" style="display: inline-block;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
        <canvas id="overlay" style="position: absolute; top: 0; left: 0;" />
		</div> 	  
		 </div>
		 
         <div class="col-xl-3">
		 
		
      <div id="parent2">
        <button id="register" class="button button1"  hidden="true"></button>  
        <button id="login" class="button button1" hidden="true"> </button>
        <center>
        <img id = "prof_img" style="height:200px; width: 200px; border: 1px solid blue; border-radius: 10px;" ></img>
        </center>
        </div>     
			
        <div id="log_disp">
            <div id="logname" name="logname" style="font-size: 15px; text-align: center;"></div><br>
			<input id="idface" name="idface" type="hidden">
             </div>
			<div class="col-md-12">
			<label class="form-label bold">Face ID</label>                    
         <div id = "kartu"></div>
		 
       <div id='logabs' ></div>
      </div>
	   
    </div>
 
  <div class="col-xl-3">
 
           <div id='logabsen' style="color:#fff"></div>
			 <div id='jam' style="font-size:36px;font-weight:bold;text-align:center;color:gold"></div>			           
			</div>		  
					   
					  
					 
					</div>
				</div>
			  </div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
	setInterval(function(){
	$("#kartu").load('wajah/nokartu.php')
	}, 1000);  
		});
	</script>
<script>
  var waitingDialog = waitingDialog || (function ($) {
    var $dialog = $(
      );

  return {
    show: function (message, options) {
      if (typeof options === 'undefined') {
        options = {};
      }
      if (typeof message === 'undefined') {
        message = 'Loading';
      }
      var settings = $.extend({
        dialogSize: 'm',
        progressType: '',
        onHide: null 
      }, options);
      $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
      $dialog.find('.progress-bar').attr('class', 'progress-bar');
      if (settings.progressType) {
        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
      }
      $dialog.find('h3').text(message);
      if (typeof settings.onHide === 'function') {
        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
          settings.onHide.call($dialog);
        });
      }
      $dialog.modal();
    },
    hide: function () {
      $dialog.modal('hide');
    }
  };

})(jQuery);
</script>


<script>
  var faceMatcher = undefined
  
  $("#parent1").hide();
  $("#parent2").hide();
  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('models')
  ]).then(start)

  async function start() {
    $.ajax({
        datatype: 'json',
        url: "fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y])
              content.parent[x]._descriptors[y] = new Float32Array(results)
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        waitingDialog.hide()
        $('#parent1').show()
        $('#parent2').show()        
        run();
    });
  }

  async function createFaceMatcher(data) {
    const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
      const descriptors = [];
      for (var i = 0; i < className._descriptors.length; i++) {
        descriptors.push(className._descriptors[i]);
      }
      return new faceapi.LabeledFaceDescriptors(className._label, descriptors);
    }))
    return new faceapi.FaceMatcher(labeledFaceDescriptors,0.6);
  }

async function onPlay() {
      const videoEl = $('#vidDisplay').get(0)
      if(videoEl.paused || videoEl.ended )
        return setTimeout(() => onPlay())

        $("#overlay").show()
        const canvas = $('#overlay').get(0)
        
        

        if($("#login").hasClass('active'))
        {
          if(faceMatcher != undefined){
            
            const input = document.getElementById('vidDisplay')
            const displaySize = { width: 680, height: 520 }
            faceapi.matchDimensions(canvas, displaySize)
            const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
            const resizedDetections = faceapi.resizeResults(detections, displaySize)
            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            results.forEach((result, i) => {
                const box = resizedDetections[i].detection.box
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                drawBox.draw(canvas)
                var str = result.toString()
				var nokartu = $("#lname").val()
                rating = parseFloat(str.substring(str.indexOf('(') + 1,str.indexOf(')')))
                str = str.substring(0, str.indexOf('('))
                str = str.substring(0, str.length - 1)
                if(str != "unknown"){
                  if(rating < 0.5){
                  if(nokartu !=""){      
                     console.log("Match TRUE!")
                     match = true;
                     $("#logname").html(str)
                     $("#prof_img").attr('src',"data/" + str + "/image0.png")
                     var div = $('#logname').html();
                     $('#idface').val(div);
					var idface = $("#idface").val();
					$.ajax({
                  type: "POST",
                  url: "ajaxface.php",
                  data: {idface : idface, nokartu : nokartu}
              }).done(async function(data) {
                 if (data == 'OK') {		
            iziToast.success(
            {
                title: 'SUKSES!',
                message: 'FACE SESUAI',
				titleColor: '#FFFF00',
				messageColor: '#fff',
				backgroundColor: '#0000FF',
				 progressBarColor: '#FFFF00',
                  position: 'topRight'
            });
             } else {
			 iziToast.warning(
            {
                title: 'Gagal!',
                message: 'ID FACE TIDAK SESUAI',
				titleColor: '#FFFF00',
				messageColor: '#fff',
				backgroundColor: '#8b0000',
				 progressBarColor: '#FFFF00',
                  position: 'topRight'
            });
            	
           }		
              });		
							
				  }
                 }  
                }
            })
           
          }
        }

      setTimeout(() => onPlay())
    }

    
  async function run() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#vidDisplay').get(0)
      videoEl.srcObject = stream
  }
  
  // tiny_face_detector options
  let inputSize = 160
  let scoreThreshold = 0.4

  function getFaceDetectorOptions() {
    return  new faceapi.TinyFaceDetectorOptions({ inputSize, scoreThreshold });
  }

  async function load_neural(){
    waitingDialog.show('Initializing neural data....', {dialogSize: 'sm', progressType: 'success'})
    $.ajax({
        datatype: 'json',
        url: "fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          console.log(content)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y]);
              content.parent[x]._descriptors[y] = new Float32Array(results);
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        waitingDialog.hide()
    });
  }

</script>

<script>
  
  $(document).ready(async function(){

    var counter = 2;
    const descriptions = [];

    // -------------Initialize---------------
    $("#login").css('background-color','yellow');
    $("#login").addClass('active');
    $("#register").css('background-color','white');
    $("#register").removeClass('active');

    if($("#register").hasClass('active')){
        $("#reg_disp").show();
        $("#log_disp").hide();
    }
    else if($("#login").hasClass('active')){
        $("#reg_disp").hide();
        $("#log_disp").show();
    }
    

   

});
</script>
<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(x){  
    document.getElementById('fname').value = prdName[x].fname;   
    };  
    </script> 
	
<script>
var autoRefresh = setInterval(
function() {

$('#logabsen').load('logwajah/logsis.php');
$('#jam').load('waktu.php');
$('#logabs').load('log/logabsen.php');									
}, 1000
);
</script>
					
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

		