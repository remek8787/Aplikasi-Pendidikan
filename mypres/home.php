<?php 
defined('APK') or exit('No Access');
?>
 <div id='data' ></div> 
	<div class="row">
        <div class="col-xl-4">
            <div id='logabsen' ></div>                    
            </div>
			<div class="col-xl-4">
            <div id='logis' ></div>                    
            </div>
			<div class="col-xl-4">
            <div id='log' ></div>                    
            </div>
        </div>  

	<script>
	var autoRefresh = setInterval(
	function() {
	$('#data').load('log/data.php');
	$('#logis').load('log/logis.php');	
	$('#log').load('log/logpegawai.php');
	$('#logabsen').load('log/logabsen.php');								
	}, 3000
	);
	</script>
					
                        