<?php include"top.php"; ?>
<body>
<?php if($sidebar==''): ?>
<div class="app align-content-stretch d-flex flex-wrap" >
<?php else : ?>
<div class="app menu-off-canvas align-content-stretch d-flex flex-wrap">	
	<?php endif; ?>
	
        <div class="app-sidebar">
            <div class="logo" >
			<img src="<?= $baseurl ?>/images/<?= $setting['logo'] ?>" style="no-repeat;max-width:40px">
                <span class="logo-text hidden-on-mobile" style="float:center;font-size:12px;font-weight:bold;color:black;"><?= $setting['sekolah'] ?></span>
            </div>
			
            <?php include"menu.php"; ?>
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