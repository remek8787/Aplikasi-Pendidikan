<?php 
defined('APK') or exit('Anda tidak dizinkan mengakses langsung script ini!');
mysqli_query($koneksi,"UPDATE statustrx SET mode='2'");
?>


<div id="trx"></div>
                     
	                 <script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#trx").load('trx/trk.php')
								$("#barsiswa").load('master/kartusiswa.php')
								$("#barcode").load('master/nokartu.php')
							}, 1000);  
						});
					</script>