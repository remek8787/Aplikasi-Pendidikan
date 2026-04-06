<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('jenis')) : ?>
    <?php include 'master/jenis.php'; ?>
<?php elseif ($pg == enkripsi('trx')) : ?>
    <?php include 'cetak/ctrx.php'; ?>	
<?php elseif ($pg == enkripsi('info')) : ?>
    <?php include 'pengaturan/info.php'; ?>	
<?php elseif ($pg == enkripsi('transaksi')) : ?>
    <?php include 'manual/transaksi.php'; ?>	
<?php elseif ($pg == enkripsi('honor')) : ?>
    <?php include 'pengaturan/honor.php'; ?>	
<?php elseif ($pg == enkripsi('gaji')) : ?>
    <?php include 'pengaturan/gaji.php'; ?>
<?php elseif ($pg == enkripsi('jadwaltu')) : ?>
    <?php include 'staff/jadwal.php'; ?>		
<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<?php elseif ($pg == enkripsi('trxpeg')) : ?>
    <?php include 'cetak/trxpeg.php'; ?>
	
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
