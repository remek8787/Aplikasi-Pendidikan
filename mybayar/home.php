<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');

?>


<div id="trx"></div>
                     
	                 <script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#trx").load('trx/trx.php')
								$("#barsiswa").load('master/kartusiswa.php')
								
							}, 1000);  
						});
					</script>