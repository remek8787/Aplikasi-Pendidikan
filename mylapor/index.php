<?php include"top.php"; ?>
<body>
<?php if($sidebar==''): ?>
<div class="app align-content-stretch d-flex flex-wrap" >
<?php else : ?>
<div class="app menu-off-canvas align-content-stretch d-flex flex-wrap">	
	<?php endif; ?>
        <div class="app-sidebar">
            <div class="logo" style="height:70px">
			 <div class="d-flex justify-content-between mb-0">
                    <div class="text-center">
                     <img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" style="max-width:40px" alt="thumb" >                      
                    </div>
                    <div class="hidden-on-mobile">
                      <?= $user['nama'] ?>
					  <p style="color:green">online</p>
                    </div>
                    <div class=" hidden-on-mobile">         
                      <?= $setting['sekolah'] ?>
					   <p style="color:blue"><?= $setting['npsn'] ?></p>
                    </div>                    
                  </div>
            </div>
			
            <?php include"menu.php"; ?>
			 <div class="logo" style="height:70px;text-align:center">
			 SISTEM APLIKASI PENDIDIK
		  </div>
		 </div>
        <div class="app-container">
            <?php include"nav.php"; ?>
            <div class="app-content">
              <?php include"pages.php"; ?>	
             </div>
            </div>
        </div>
    </div>
   <?php include"footer.php"; ?>
</body>
</html>