<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>

<?php elseif ($pg == enkripsi('proyek')) : ?>
	<?php include 'projek/proyek.php'; ?>	
<?php elseif ($pg == enkripsi('inputproyek')) : ?>
	<?php include 'projek/inputproyek.php'; ?>		
<?php elseif ($pg == enkripsi('raporproyek')) : ?>
	<?php include 'projek/raporproyek.php'; ?>	
<?php elseif ($pg == enkripsi('catatanproses')) : ?>
	<?php include 'projek/catatanproses.php'; ?>

	<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>

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
