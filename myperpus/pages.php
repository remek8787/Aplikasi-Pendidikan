<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == enkripsi('kategori')) : ?>
    <?php include 'master/kategori.php'; ?>
<?php elseif ($pg == enkripsi('buku')) : ?>
    <?php include 'master/buku.php'; ?>	

<?php elseif ($pg == enkripsi('pinjam')) : ?>
    <?php include 'trx/pinjam.php'; ?>
<?php elseif ($pg == enkripsi('kembali')) : ?>
    <?php include 'trx/kembali.php'; ?>	
	
<?php elseif ($pg == enkripsi('cbuku')) : ?>
    <?php include 'cetak/cbuku.php'; ?>
<?php elseif ($pg == enkripsi('cpinjam')) : ?>
    <?php include 'cetak/cpinjam.php'; ?>
<?php elseif ($pg == enkripsi('ckembali')) : ?>
    <?php include 'cetak/ckembali.php'; ?>
<!-- DATABASE -->
<?php elseif ($pg == enkripsi('resetdata')) : ?>
    <?php include 'pengaturan/resetdata.php'; ?>
<!-- BUKU DIGITAL -->
<?php elseif ($pg == enkripsi('inbuku')) : ?>
    <?php include 'buku/buku.php'; ?>	
<?php elseif ($pg == enkripsi('baca')) : ?>
    <?php include 'buku/baca.php'; ?>		
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
