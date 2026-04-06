<?php
$lat = $_GET['lat'];
$lon = $_GET['lon'];
?>

<html>
<head>
	<title>SANDIK ALL IN ONE</title>
	<script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script>
	<script src="../assets/js/geo.js" type="text/javascript" charset="utf-8"></script>
</head>	
<body>
	
	<script>
		if(geo_position_js.init()){
			geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
		}
		else{
			alert("Functionality not available");
		}

		function success_callback(p)
		{
			geo_position_js.showMap(<?= $lat ?>,<?= $lon ?>);
		}
		
		function error_callback(p)
		{
			alert('error='+p.message);
		}		
	</script>
	</body>
</html>