<?php $jreg = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pkl_reg where idsiswa='$id_siswa'")); ?>
<?php if($jreg==0): ?>

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
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>       
  
               
	<div class="row">
         
       <div class="card">      
	 			 
	<div id="parent1"  style="float:left;">   
        <video id="vidDisplay" style="display: inline-block;width:640px;height:480px;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
        <canvas id="overlay" style="position: absolute; top: 0; left: 0;width:640px;height:480px;" />
     
	</div>
	<div id="tries" style="font-size: 16px;">Sisa Capture : </div> 
	<div class="col-md-12">
		<label class="form-label bold"> Pilih Siswa</label>
		  <select id="idpeg" name="idpeg"  class="form-select" onchange="changeValue(this.value)" style="width:100%;" required="true">
     <option value="" selected="">Pilih</option>
     <?php 
       $sql=mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
       $jsArray = "var prdName = new Array();\n";
       while ($data=mysqli_fetch_array($sql)) {
      
        echo '<option value="'.$data['id_siswa'].'">'.$data['nama'].'</option> ';
        $jsArray .= "prdName['" . $data['id_siswa'] . "'] = {fname:'" . $data['id_siswa'] . "'};\n";
      
       }
      ?>
    </select>		
          </div>	 
        <input class="form-control" id="fname" name="fname" required="true" type="hidden">
          
	 <br>
     <button id="capture" class="btn btn-primary">Ambil Wajah</button>
	 <br>		
			
			</td>
			<td>
		 
      <div id="parent2" >
        
        <button id="register" class="button button1" style="position:absolute;left:0px;top:-500px" hidden="true"> Register </button>  
        <button id="login" class="button button1" style="position:absolute;left:0px;top:-500px" hidden="true"> Log In</button>
        <center hidden="true">		     
        <img id = "prof_img" style="height:150px; width: 150px; border: 3px solid green; border-radius: 10px;" ></img><br>
        </center>
		
        <div id="reg_disp" style="display: none;">
		
          
        </div>
        <input type="hidden" value="<?= $siswa['id_siswa'] ?>" id="lname" name="lname" >
        <div id="log_disp">
            <br></br>
            <div id="logname" style="font-size: 35px; font-weight: bold; margin-left: 40px; width: 570px; white-space: pre-wrap; text-align: center;"></div><br>
           
        </div>
      </div>
   
	 </div>
	
	 </div>
	 </div>
	  </div>
	   </div>
	    </div>

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
            dims.width =640
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
                  url: "<?= $baseurl ?>/ajaxpkl.php?pg=siswa",
                  data: {image: img.src ,path: data, idpeg: idpeg, nama: nama, nokartu: nokartu}
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
			window.location.replace('?pg=pkl');
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
<?php else: ?>

	
<?php endif ?>
	