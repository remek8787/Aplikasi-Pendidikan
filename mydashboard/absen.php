

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
	<div class="row">
       <div class="col">
	   
		
        <div class="card">
      <div class="card-body">
	  <textarea id="lat" hidden></textarea>
      <textarea id="lon" hidden></textarea>
 
		<div id="parent1"  style="float:left;">
        <video id="vidDisplay" style="display: inline-block;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
         <canvas id="overlay" style="position: absolute; top: 0; left: 0;width:640px;height:480px;" />
		</div> 	  
		<input id="idface" name="idface" type="hidden">
         <div class="col-xl-3" hidden="true">
		  
      <div id="parent2">
        <button id="register" class="button button1"  hidden="true"></button>  
        <button id="login" class="button button1" hidden="true"> </button>
        <center>
        <img id = "prof_img" style="height:200px; width: 200px; border: 1px solid blue; border-radius: 10px;" ></img>
        </center>
        </div>     
			
        <div id="log_disp">
            <div id="logname" name="logname" style="font-size: 15px; text-align: center;"></div><br>
			
             </div>
			
        </div>
      </div>
    </div>
 </div>
 </div>
<script>
 const x = document.getElementById("lat");
 const y = document.getElementById("lon");
		if(geo_position_js.init()){
			geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
		}
		else{
			alert("Functionality not available");
		}

		function success_callback(p)
		{
		
	    
		
		  x.innerHTML =  p.coords.latitude.toFixed(2); 
          y.innerHTML =  p.coords.longitude.toFixed(2); 
		   
		}
		
		
		function error_callback(p)
		{
			alert('error='+p.message);
		}		
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
                     $("#prof_img").attr('src',"<?= $baseurl ?>/data/" + str + "/image0.png")
                     var div = $('#logname').html();
                     $('#idface').val(div);
					var idface = $("#idface").val();
					var lati =  $('#lat').val();
					var loni =  $('#lon').val();
					$.ajax({
                  type: "POST",
                  url: "<?= $baseurl ?>/ajaxfacepkl.php",
                  data: {
				  idface : idface,
				  lati : lati,
				  loni : loni
				  }
              }).done(async function(data) {
                 if (data == 'OK') {		           
			setTimeout(function() {
			window.location.replace('?pg=pkl');
			}, 2000);
			 
             } else {
			 
            	
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
