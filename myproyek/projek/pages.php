<?php if ($pg == '') : ?>
    <?php include 'sandik_projek/home.php'; ?>
<!-- /RAPOR PROJEK-->
<?php elseif ($pg == 'proyek') : ?>
	<?php include 'sandik_projek/proyek.php'; ?>	
<?php elseif ($pg == 'inputproyek') : ?>
	<?php include 'sandik_projek/inputproyek.php'; ?>		
<?php elseif ($pg == 'raporproyek') : ?>
	<?php include 'sandik_projek/raporproyek.php'; ?>	
<?php elseif ($pg == 'catatanproses') : ?>
	<?php include 'sandik_projek/catatanproses.php'; ?>

	
<?php else : ?>
 <div class="app app-error align-content-stretch d-flex flex-wrap">
        <div class="app-error-info">
            <h5>Oops!</h5>
            <span>It seems that the page you are looking for no longer exists.<br>
                We will try our best to fix this soon.</span>
            <a href="." class="btn btn-dark">Go to dashboard</a>
        </div>
        <div class="app-error-background"></div>
    </div>
<?php endif ?>
