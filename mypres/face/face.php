<link rel="stylesheet" type="text/css" href="<?= $baseurl ?>/face/style.css">
  <script src="<?= $baseurl ?>/face/jquery.min.js"></script>
  <script src="<?= $baseurl ?>/face/bootstrap.min.js"></script>
  <script src="<?= $baseurl ?>/face/face-api.js"></script>
  <style>
video {
  max-width: 100%;
  height: auto;
}
canvas {
  max-width: 100%;
  height: auto;
}
</style>
<?php
defined('APK') or exit('No Access');
?>       
   
	<?php if ($ac == '') : ?>
                   <div class="row">
                       <div class="col-md-8">
                        <div class="card">
                           <div class="card card-header">
                                <h5 class="card-title">FACE RECOGNITION PEGAWAI</h5>										
                               </div>
                            <div class="card-body">									
								<div class="card-box table-responsive">
                                 <table id="datatable1" class="table table-bordered table-hover edis2" style="width:100%;font-size:12px">
                                    <thead>
                                        <tr>
                                        <th>NO</th>                                               
                                        <th>FACE ID</th>
                                        <th>NAMA LENGKAP</th>
										<th>JABATAN</th>
										
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$no=0;
										$query = mysqli_query($koneksi, "SELECT * FROM datareg WHERE folder<>'' AND level='pegawai' ORDER BY id DESC"); 
										while ($data = mysqli_fetch_array($query)) :
										$peg = fetch($koneksi,'users',['id_user'=>$data['idpeg']]);
										$no++;
										?>
                                        <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['folder'] ?></td>
                                        <td><?= $data['nama'] ?></td>
										<td><?= strtoupper($peg['level']) ?></td>
										
                                        </tr>
										<?php endwhile; ?>
									</tbody>	
                                   </table>
								</div>
							</div>
						</div>
					</div>
									
					       <div class="col-md-4">
                     
                                <div class="card widget widget-payment-request">
                                   
                                    <div class="card-body">
                                        <div class="widget-payment-request-container">
                                            <div class="widget-payment-request-author">
                                                <div class="avatar m-r-sm">
                                                    <img src="../images/user.png" alt="">
                                                </div>
                                                <div class="widget-payment-request-author-info">
                                                    <span class="widget-payment-request-author-name">REGISTRASI FACE ID</span>
                                                    <span class="widget-payment-request-author-about"><?= $setting['sekolah'] ?></span>
                                               
											   </div>
                                            </div>
											
									<div class="widget-payment-request-info m-t-md">
									
							
										<div class="d-grid gap-2">
										<a href="?pg=<?= enkripsi('face') ?>&ac=pegawai" class="btn btn-primary"><i class="material-icons">crisis_alert</i>Register</a>
										
										 </div>
										</div>
									 </div>
					              </div>
								</div>
							</div>
						</div>
					</div>
					            <script>
									$('#datatable1').on('click', '.hapus', function() {
									var id = $(this).data('id');
									console.log(id);
									swal({
											  title: 'Yakin hapus data?',
											  text: "You won't be able to revert this!",
											  type: 'warning',
											  showCancelButton: true,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'Ya, Hapus!',
											  cancelButtonText: "Batal"				  
									}).then((result) => {
										if (result.value) {
											$.ajax({
											   url: 'face/tface.php?pg=hapus',
												method: "POST",
												data: 'id=' + id,
												beforeSend: function() {
												$('#progressbox').html('<div><label class="sandik" style="color:blue">Data sedang di proses</label>&nbsp;&nbsp;&nbsp;<img src="../images/animasi1.gif" style="margin-left:100px;"></div>');
												$('.progress-bar').animate({
													width: "30%"
												}, 500);
											},
												success: function(data) {
													  
													setTimeout(function() {
														window.location.replace('?pg=face');
													}, 2000);
												}
											});
										}
										return false;
									})

								});

							</script>    
					
     
		      <?php elseif ($ac == 'pegawai') : ?>			
					<div class="row">
                          <div class="col-md-7">
                            <div class="card">
                                <div class="card card-header">
                                <h5 class="card-title">REGISTRASI PEGAWAI</h5>
							</div>
                        <div class="card-body">
									
			   <div id="parent1"  style="float:left;">   
        <video id="vidDisplay" style="display: inline-block;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
        <canvas id="overlay" style="position: absolute; top: 0; left: 0;" width = "100%" height = "100%"/>
     
			</div> 	  
			 </div>
			  </div>
			  </div>
        <div class='col-md-5'>
		  <div class="card">
            <div class="card-header">
               <h5 class="card-title">FACE RECOGNITION</h5>
				</div>
       <div class="card-body">
      <div id="parent2" >
        
        <button id="register" class="button button1" style="position:absolute;left:0px;top:-500px" hidden="true"> Register </button>  
        <button id="login" class="button button1" style="position:absolute;left:0px;top:-500px" hidden="true"> Log In</button>
        <center>
		<span style="font-size: 14px;"> Pengambilan Sample Wajah Sebanyak 5 Kali </span>
		<div id="tries" style="font-size: 16px;">Sisa Capture : </div>       
        <img id = "prof_img" style="height:150px; width: 150px; border: 3px solid green; border-radius: 10px;" ></img><br>
        </center>
		
        <div id="reg_disp" style="display: none;">
		<div class="col-md-12">
		<label class="form-label bold"> Pilih Pegawai</label>
		  <select id="idpeg" name="idpeg"  class="form-select" onchange="changeValue(this.value)" style="width:100%;" required="true">
     <option value="" selected="">Pilih</option>
     <?php 
       $sql=mysqli_query($koneksi,"SELECT * FROM users WHERE level<>'admin' AND sts='0'");
       $jsArray = "var prdName = new Array();\n";
       while ($data=mysqli_fetch_array($sql)) {
      
        echo '<option value="'.$data['id_user'].'">'.$data['nama'].'</option> ';
        $jsArray .= "prdName['" . $data['id_user'] . "'] = {fname:'" . $data['id_user'] . "'};\n";
      
       }
      ?>
    </select>		
          </div>
		 
        <input class="form-control" id="fname" name="fname" required="true" type="hidden">
            <p>
			<div class="col-md-12">
			<label class="form-label bold"> ID Face</label>                    
         <div id = "kartu"></div>
		 </div><br>
          <button id="capture" class="btn btn-primary kanan">Ambil Wajah</button><br>
          
        </div>

        <div id="log_disp">
            <br></br>
            <div id="logname" style="font-size: 35px; font-weight: bold; margin-left: 40px; width: 570px; white-space: pre-wrap; text-align: center;"></div><br>
           
        </div>
      </div>
    </div>
	<script type="text/javascript">
		$(document).ready(function(){
		setInterval(function(){
		$("#kartu").load('face/nokartu.php')
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

  //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined
  
  $("#parent1").hide();
  $("#parent2").hide();
  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('<?= $baseurl ?>/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('<?= $baseurl ?>/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('<?= $baseurl ?>/models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('<?= $baseurl ?>/models')
  ]).then(start)

  async function start() {
    $.ajax({
        datatype: 'json',
        url: "<?= $baseurl ?>/fetch.php",
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

  // Create Face Matcher
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
        
        if($("#register").hasClass('active'))
        {
          const options = getFaceDetectorOptions()
          const result = await faceapi.detectSingleFace(videoEl, options)
          if (result) {
            const dims = faceapi.matchDimensions(canvas, videoEl, true)
            dims.height = 480
            dims.width = 640
            canvas.height = 480
            canvas.width = 640
            const resizedResult = faceapi.resizeResults(result, dims)
            faceapi.draw.drawDetections(canvas, resizedResult)  
          }     
          else{
            $("#overlay").hide()
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
        url: "<?= $baseurl ?>/fetch.php",
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

    var counter = 5;
    const descriptions = [];

    // -------------Initialize---------------
    $("#register").css('background-color','yellow');
    $("#register").addClass('active');
    $("#login").css('background-color','white');
    $("#login").removeClass('active');

    if($("#register").hasClass('active')){
        $("#reg_disp").show();
        $("#log_disp").hide();
    }
    else if($("#login").hasClass('active')){
        $("#reg_disp").hide();
        $("#log_disp").show();
    }
    

    $("#register").click(function(){
      $(this).css('background-color','yellow')
      $("#login").css('background-color','white')
      $(this).addClass('active')
      $("#login").removeClass('active')
      $("#reg_disp").show()
      $("#log_disp").hide()
      $("#prof_img").removeAttr('src')
      $("#fname").val('')
      $("#lname").val('')
      $("#logname").html('')
      $("#fname").prop("readonly", false)
      $("#lname").prop("readonly", false)      
      counter = 5
      description = []                
      $("#tries").html("Sisa Capture : " + counter)
    });

    $("#tries").html("Sisa Capture : " + counter)

    $("#capture").click(async function(){
      var data = $("#fname").val() + "," + $("#lname").val();
      const label = data;

    if($("#fname").val()){
      if($("#register").hasClass('active')){
        
        if(counter <= 5 && counter >= 0 ){
          var canvas = document.createElement('canvas');
          var context = canvas.getContext('2d');
          var video = document.getElementById('vidDisplay');
          context.drawImage(video, 0, 0, 640, 480);
          var capURL = canvas.toDataURL('image/png');
          var canvas2 = document.createElement('canvas');
          canvas2.width = 640;
          canvas2.height = 480;
          var ctx = canvas2.getContext('2d');
          ctx.drawImage(video, 0, 0, 640, 480);
          var new_image_url = canvas2.toDataURL();
          var img = document.createElement('img');
          img.src = new_image_url;
          document.getElementById("prof_img").src = img.src;

          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
		  var idpeg = $("#idpeg").val();
		  var nama = $("#fname").val();
		   var nokartu = $("#lname").val();
          if( detections != null){
            descriptions.push(detections.descriptor);
            var descrip = descriptions;
            counter--;
            $("#tries").html("Sisa Capture : " + counter)
            if(counter == 0){
              // Save Image
              $.ajax({
                  type: "POST",
                  url: "<?= $baseurl ?>/ajax.php?pg=pegawai",
                  data: {image: img.src ,path: data, idpeg : idpeg, nama : nama, nokartu : nokartu}
              }).done(function(o) {
                  console.log('Image Saved'); 
              });


              waitingDialog.show('Processing data.............', {dialogSize: 'sm', progressType: 'success'})
              var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
              $.ajax({
                  url: '<?= $baseurl ?>/json.php',
                  type: 'POST',
                  data: { myData: JSON.stringify(postData) },
                  datatype: 'json'
              })
              .done(async function (data) {
                  load_neural()
                 $('#progressbox').html('<div><img src="../images/animasi.gif" style="width:50px;"></div>');
				
			setTimeout(function() {
			window.location.reload();
			}, 2000);
              })
              .fail(function (jqXHR, textStatus, errorThrown) { 
                  alert("Error due to internet connection! Please try again!");
              });
              const descriptions = [];
            }          
          }
          else{
           iziToast.info(
			{
			title: 'Gagal!',
			message: 'Wajah tidak terdeteksi',
			titleColor: '#FFFF00',
			messageColor: '#fff',
			backgroundColor: 'rgba(0, 0, 0, 0.5)',
			progressBarColor: '#FFFF00',
			position: 'topRight'				  
			});
          }
        }
        else{
          alert("Done Learning!");
          counter = 5;
          const descriptions = [];
        }
      }
    }
    
    });


});
</script>
<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(x){  
    document.getElementById('fname').value = prdName[x].fname;   
    };  
    </script> 
	
<?php endif ?>
	