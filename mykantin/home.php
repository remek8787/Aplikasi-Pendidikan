<?php
defined('APK') or exit('NO ACCESS');

?>           
	<div class="row">
       <div class="col-md-7">
     <div class="card">
     <div class="card card-header">
       <h5 class="card-title">LIVE TRANSAKSI</h5>
		</div>
        <div class="card-body">		   
          <div id="trx"></div>
		  
		 </div>
			</div>
				</div>
				
		<div class="col-md-5">
     <div class="card">
     <div class="card card-header">
       <h5 class="card-title">LIVE PEMBAYARAN</h5>
		</div>
        <div class="card-body">		   
          <div id="byr"></div>
		</div> 
		 </div>
			</div>
				</div>  
		  
		  
					<script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$("#trx").load('logtrx.php');
								$("#byr").load('logbayar.php');
							}, 2000);  
						});
					</script>					