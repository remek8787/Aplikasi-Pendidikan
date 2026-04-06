<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('rumum')) : ?>
    <?php include 'master/umum.php'; ?>
<?php elseif ($pg == enkripsi('rtunjang')) : ?>
    <?php include 'master/penunjang.php'; ?>
<?php elseif ($pg == enkripsi('rlab')) : ?>
    <?php include 'master/lab.php'; ?>
<?php elseif ($pg == enkripsi('barang')) : ?>
    <?php include 'master/barang.php'; ?>	
	
<?php elseif ($pg == enkripsi('aset')) : ?>
    <?php include 'aset/aset.php'; ?>		
<?php elseif ($pg == enkripsi('kondisi')) : ?>
    <?php include 'aset/kondisi.php'; ?>		
	
	
	
	
<?php elseif ($pg == enkripsi('csapras')) : ?>
    <?php include 'cetak/csapras.php'; ?>
<?php elseif ($pg == enkripsi('caset')) : ?>
    <?php include 'cetak/caset.php'; ?>
<?php elseif ($pg == enkripsi('dashgur')) : ?>
    <?php include 'dashgur.php'; ?>
<?php elseif ($pg == enkripsi('lemari')) : ?>
    <?php include 'arsip/lemari.php'; ?>
<?php elseif ($pg == enkripsi('arsip')) : ?>
    <?php include 'arsip/arsip.php'; ?>		
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
